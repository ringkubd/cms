<?php

namespace App\Http\Controllers\ContentControllers;

use App\Admin;
use App\Models\ContentModels\Module;
use App\Models\ContentModels\Taxonomy;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContentModels\Attachment;
use App\Models\ContentModels\Comments;
use App\Models\ContentModels\TermRelation;
use foo\bar;
use App\Models\ContentModels\TermTaxonomy;
use App\Models\ContentModels\Post;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
  /**
   * @param Request $request
   * @return Factory|View
   */
  public function index(Request $request)
  {
    $module = $request->input('module');
    $author = $request->input('author');
    $status = $request->input('status');
    $start = $request->input('start');
    $end = $request->input('end');
    $order = $request->input('order');
    $search = $request->input('search');

    $posts = Post::get_module_page_by_filter($module, $author, $status, $start, $end, $order, $search);
    $modules = Module::where('is_delete', 0)->whereNotIn('slug', ["photo-category"])->where("active", 1)->get();
    $authors = User::where('active', 1)->get();
    return view("admin.pages.page.show-page", compact('posts', 'modules', 'authors'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $modules = Module::where("is_delete", 0)->where("active", 1)->get();
    return view("admin.pages.page.create-page", compact("modules"));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'post_module' => 'required|string|max:99',
      'post_type' => 'required|string|max:55',
      'titleEnglish' => 'required|string|max:400',
      'titleBangla' => 'nullable|string|max:400',
      'post_slug' => 'required|string|max:255|unique:posts',
      'articleEnglish' => 'nullable|string',
      'articleBangla' => 'nullable|string',
      'excerpt' => 'nullable|string|max:55',
      'created_at' => 'nullable|string|max:155',
      'attached' => 'nullable|string|max:55',
      'comment_status' => 'nullable|string|max:55',
      'option' => 'nullable|string|max:55',
      'excerptEnglish' => 'nullable|string|max:400',
      'excerptBangla' => 'nullable|string|max:400',

      'video' => 'nullable|string|max:55',
      'localVideo' => 'nullable|string|max:255',
      'youtubeVideo' => 'nullable|string|max:255',
      'audio' => 'nullable|string|max:55',
      'localAudio' => 'nullable|string|max:255',
      'otherAudio' => 'nullable|string|max:255',
      'file' => 'nullable|string|max:55',
      'localFile' => 'nullable|string|max:255',
      'otherFile' => 'nullable|string|max:255',
      'comments' => 'nullable|string|max:400',

      'post_status' => 'required|string|max:55',
      'scheduleTime' => 'nullable|string|max:91',
      'upload_type' => 'nullable|string|max:45',
      'picture' => 'nullable|string|max:255',
      'newPicture' => 'nullable|max:1536|mimes:jpeg,jpg,png,gif',
    ]);

    $post = new Post();

    // Handle File Upload
    if ($request->hasFile('newPicture') && $request->upload_type == "new") {
      $imgName = Str::slug(Str::limit($request->titleEnglish, 60)) . "-" . date("m-Y");
      $images = Admin::store_image($request->newPicture, "pages/{$request->post_format}", $imgName);
      $post->post_thumb = $images['thumb'];
      $post->post_thumb_original = $images['original'];
    } elseif ($request->upload_type == "from_old") {
      $post->post_thumb = $request->picture;
    }

    $post->post_title = $request->titleEnglish;
    $post->post_title_bn = $request->titleBangla;
    $post->post_slug = $request->post_slug;
    $post->post_content = $request->articleEnglish;
    $post->post_content_bn = $request->articleBangla;
    $post->post_excerpt = $request->excerptEnglish;
    $post->post_excerpt_bn = $request->excerptBangla;
    $post->post_status = $request->post_status;
    if ($request->post_status == "schedule") {
      $post->schedule_time = Carbon::parse($request->scheduleTime);
    }
    $post->post_type = "page";
    $post->post_format = $request->post_module;
    $post->upload_type = $request->upload_type;
    $post->comments_status = $request->comment_status;
    $post->attachment_status = $request->attached;
    $post->option_status = $request->option;
    $post->user_id = auth()->user()->id;
    $post->created_at = Carbon::parse($request->created_at)->toDateTimeString();
    $post->save();
    $post_id = $post->id;

    //add the attachment information
    $attached = $request->attached;
    if (!empty($attached)) {
      $attachTypes = $request->attachType ?? array();
      foreach ($attachTypes as $attachType) {
        $attachment = new Attachment();
        if ($attachType == "video") {
          $attachment->attachment_type = "video";
          $attachment->attachment_path_type = $request->video;
          if ($request->video == "local") {
            $attachment->attachment_path = $request->localVideo;
          } elseif ($request->video == "youtube") {
            $attachment->attachment_path = $request->youtubeVideo;
          }
        } elseif ($attachType == "audio") {
          $attachment->attachment_type = "audio";
          $attachment->attachment_path_type = $request->audio;
          if ($request->audio == "localAudio") {
            $attachment->attachment_path = $request->localAudio;
          } elseif ($request->audio == "otherAudio") {
            $attachment->attachment_path = $request->otherAudio;
          }
        } elseif ($attachType == "file") {
          $attachment->attachment_type = "file";
          $attachment->attachment_path_type = $request->file;
          if ($request->file == "localFile") {
            $attachment->attachment_path = $request->localFile;
          } elseif ($request->file == "otherFile") {
            $attachment->attachment_path = $request->otherFile;
          }
        }
        $attachment->post_id = $post_id;
        $attachment->user_id = auth()->user()->id;
        $attachment->save();
      }
    }

    //add the comments information
    if ($request->comment_status) {
      $comments = new Comments();
      $comments->active = 1;
      $comments->comments = $request->comments ?? "";
      $comments->post_id = $post_id;
      $comments->user_id = auth()->user()->id;
      $comments->save();
    }

    return redirect("admin/page/{$post_id}/edit")->with("success", "Page created successfully");
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Factory|View
   */
  public function show($page_slug)
  {
    $getURL = \Request::route()->getName();
    $moduleArr = explode("/", $getURL);
    //  return dump($moduleArr);
    // #TODO can be change specific module page specific design
    $post = Post::where('post_slug', $page_slug)->first();
    return view('admin.pages.page.single-page', compact('post'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Factory|View
   */
  public function edit($id)
  {
    $post = Post::find($id);
    $modules = Module::where('is_delete', 0)->where('active', 1)->get();
    return view('admin.pages.page.edit-page', compact('modules', 'post'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return Response
   * @throws ValidationException
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'post_module' => 'required|string|max:99',
      'post_type' => 'required|string|max:55',
      'titleEnglish' => 'required|string|max:400',
      'titleBangla' => 'nullable|string|max:400',
      'post_slug' => 'required|string|max:255|unique:posts,post_slug,' . $id,
      'articleEnglish' => 'nullable|string',
      'articleBangla' => 'nullable|string',
      'excerpt' => 'nullable|string|max:55',
      'created_at' => 'nullable|string|max:155',
      'attached' => 'nullable|string|max:55',
      'comment_status' => 'nullable|string|max:55',
      'option' => 'nullable|string|max:55',
      'excerptEnglish' => 'nullable|string|max:400',
      'excerptBangla' => 'nullable|string|max:400',

      'video' => 'nullable|string|max:55',
      'localVideo' => 'nullable|string|max:255',
      'youtubeVideo' => 'nullable|string|max:255',
      'audio' => 'nullable|string|max:55',
      'localAudio' => 'nullable|string|max:255',
      'otherAudio' => 'nullable|string|max:255',
      'file' => 'nullable|string|max:55',
      'localFile' => 'nullable|string|max:255',
      'otherFile' => 'nullable|string|max:255',
      'comments' => 'nullable|string|max:400',

      'post_status' => 'required|string|max:55',
      'scheduleTime' => 'nullable|string|max:91',
      'upload_type' => 'nullable|string|max:45',
      'picture' => 'nullable|string|max:255',
      'newPicture' => 'nullable|max:1536|mimes:jpeg,jpg,png,gif',
    ]);

    $post = Post::find($id);

    // Handle File Upload
    if ($request->hasFile('newPicture') && $request->upload_type == "new") {
      $imgName = Str::slug(Str::limit($post->post_title, 60)) . "-" . date("m-Y");
      $images = Admin::store_image($request->newPicture, "pages/{$request->post_format}", $imgName);
      $post->post_thumb = $images['thumb'];
      $post->post_thumb_original = $images['original'];
    } elseif ($request->upload_type == "from_old") {
      $post->post_thumb = $request->picture;
    }

    $post->post_title = $request->titleEnglish;
    $post->post_title_bn = $request->titleBangla;
    $post->post_slug = $request->post_slug;
    $post->post_content = $request->articleEnglish;
    $post->post_content_bn = $request->articleBangla;
    $post->post_excerpt = $request->excerptEnglish;
    $post->post_excerpt_bn = $request->excerptBangla;
    $post->post_status = $request->post_status;
    if ($request->post_status == "schedule") {
      $post->schedule_time = Carbon::parse($request->scheduleTime);
    }
    $post->post_type = $request->post_type;
    $post->post_format = $request->post_module;
    $post->upload_type = $request->upload_type;
    $post->comments_status = $request->comment_status;
    $post->attachment_status = $request->attached;
    $post->option_status = $request->option;
    $post->user_id = auth()->user()->id;
    $post->created_at = Carbon::parse($request->created_at)->toDateTimeString();
    $post->save();

    //        add the attachment information
    $attached = $request->attached;
    if (!empty($attached)) {
      $attachTypes = $request->attachType ?? array();
      Attachment::where("post_id", $id)->update([
        "active" => 0,
      ]);
      foreach ($attachTypes as $attachType) {
        if ($attachType == "video") {
          $AttRelation = Attachment::where("attachment_type", $attachType)->where("post_id", $id)->first();
          if (!empty($AttRelation)) {
            Attachment::where("attachment_type", $attachType)->where("post_id", $id)->update([
              "active" => 1,
              "attachment_type" => "video",
              "attachment_path_type" => $request->video,
              "attachment_path" => $request->video == "local" ? $request->localVideo : $request->youtubeVideo,
            ]);
          } else {
            $attachment = new Attachment();
            $attachment->post_id = $id;
            $attachment->attachment_type = "video";
            $attachment->attachment_path_type = $request->video;
            $attachment->attachment_path = $request->video == "local" ? $request->localVideo : $request->youtubeVideo;
            $attachment->user_id = auth()->user()->id;
            $attachment->save();
          }
        } elseif ($attachType == "audio") {
          $AttRelation = Attachment::where("attachment_type", $attachType)->where("post_id", $id)->first();
          if (!empty($AttRelation)) {
            Attachment::where("attachment_type", $attachType)->where("post_id", $id)->update([
              "active" => 1,
              "attachment_type" => "audio",
              "attachment_path_type" => $request->audio,
              "attachment_path" => $request->audio == "localAudio" ? $request->localAudio : $request->otherAudio,
            ]);
          } else {
            $attachment = new Attachment();
            $attachment->post_id = $id;
            $attachment->attachment_type = "audio";
            $attachment->attachment_path_type = $request->audio;
            $attachment->attachment_path = $request->audio == "local" ? $request->localAudio : $request->otherAudio;
            $attachment->user_id = auth()->user()->id;
            $attachment->save();
          }
        } elseif ($attachType == "file") {
          $AttRelation = Attachment::where("attachment_type", $attachType)->where("post_id", $id)->first();
          if (!empty($AttRelation)) {
            Attachment::where("attachment_type", $attachType)->where("post_id", $id)->update([
              "active" => 1,
              "attachment_type" => "file",
              "attachment_path_type" => $request->file,
              "attachment_path" => $request->file == "localFile" ? $request->localFile : $request->otherFile,
            ]);
          } else {
            $attachment = new Attachment();
            $attachment->post_id = $id;
            $attachment->attachment_type = "file";
            $attachment->attachment_path_type = $request->file;
            $attachment->attachment_path = $request->file == "localFile" ? $request->localFile : $request->otherFile;
            $attachment->user_id = auth()->user()->id;
            $attachment->save();
          }
        }
      }
    }

    //        add the comments information
    if ($request->comment_status) {
      $oldComment = Comments::find($request->comment_id);
      if (!empty($oldComment)) {
        $comment = $oldComment;
      } else {
        $comment = new Comments();
      }
      $comment->active = 1;
      $comment->comments = $request->comments ?? "";
      $comment->post_id = $id;
      $comment->user_id = auth()->user()->id;
      $comment->save();
    }
    return back()->with("success", "Page Updated successfully");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
    Post::find($id)->update(['is_delete' => 1]);
    return back()->with("success", "Page Trashed successfully");
  }
}
