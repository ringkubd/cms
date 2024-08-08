<?php

namespace App\Http\Controllers\ContentControllers;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContentModels\Attachment;
use App\Models\ContentModels\CaseStudyRelation;
use App\Models\ContentModels\Comments;
use App\Models\ContentModels\Module;
use App\Models\ContentModels\Post;
use App\Models\ContentModels\Taxonomy;
use App\Models\ContentModels\TermRelation;
use App\Models\ContentModels\TermTaxonomy;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PostController extends Controller
{

  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.posts";
  }

  /**
   * @param Request $request
   * @return Factory|View
   */
  public function index(Request $request)
  {
    $moduleSlug = $request->segment(3);
    $module = Module::where('is_delete', 0)
      ->where('slug', $moduleSlug)
      ->firstOrFail();

    $author = $request->input('author');
    $category = $request->input('category');
    $status = $request->input('status');
    $start = $request->input('start');
    $end = $request->input('end');
    $order = $request->input('order');
    $search = $request->input('search');

    $posts = Post::get_module_post_by_filter($moduleSlug, $author, $category, $status, $start, $end, $order, $search);

    if (\request()->ajax()) {
      return view('admin.pages.posts.post-table', compact('module', 'posts'));
    }

    $moduleCats = Taxonomy::where('is_delete', 0)->whereNotIn('term', ['photo-category'])->where('active', 1)->get();
    $authors = User::where('active', 1)->get();

    //dd($posts);

    return view('admin.pages.posts.show-post', compact('module', 'posts', 'moduleCats', 'authors'));
  }

  /**
   * @param Request $request
   * @return Factory|View
   */
  public function create(Request $request)
  {
    $moduleSlug = $request->segment(3);
    $module = Module::where("is_delete", 0)
      ->where("slug", $moduleSlug)
      ->firstOrFail();
    $globalTerms = Admin::get_module_terms(0);
    $moduleTerms = Admin::get_module_terms($module->id);
    $terms = $globalTerms->merge($moduleTerms);

    return view("admin.pages.posts.create-post", compact('module', "terms"));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'module_id' => 'required|numeric|max:99',
      'post_type' => 'required|string|max:55',
      'titleEnglish' => 'required|string|max:400',
      'titleBangla' => 'nullable|string|max:400',
      'post_slug' => 'required|string|max:255|unique:posts',
      'articleEnglish' => 'nullable|string',
      'articleBangla' => 'nullable|string',
      'excerpt' => 'nullable|string|max:55',
      'created_at' => 'required|string|max:155',
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

      'stories' => 'nullable|string|max:25',
      'subject_id' => 'required_with:stories|numeric|max:99',
      'round_id' => 'required_with:stories|numeric|max:99',
      'student_id' => 'required_with:stories|numeric|max:99',

      'post_status' => 'required|string|max:55',
      'scheduleTime' => 'nullable|string|max:91',
      'postFormat' => 'required|string|max:55',
      'upload_type' => 'nullable|string|max:45',
      'picture' => 'nullable|string|max:255',
      'thumb_status' => 'nullable|numeric|max:1',
      'newPicture' => 'nullable|max:1536|mimes:jpeg,jpg,png,gif',
    ]);

    $module = $request->input('post_type');
    $post = new Post();

    // Handle File Upload
    if ($request->hasFile('newPicture') && $request->input('upload_type') == 'new') {
      $imgName = Str::slug(Str::limit($request->input('titleEnglish'), 60)) . "-" . date("m-Y");

      $storeImage = Admin::store_image($request->newPicture, "posts/{$module}", $imgName);
      $post->post_thumb = $storeImage['thumb'];
      $post->post_thumb_original = $storeImage['original'];
    } elseif ($request->upload_type == "from_old") {
      $post->post_thumb = $request->input('picture');
    }

    $post->post_title = $request->input('titleEnglish');
    $post->post_title_bn = $request->input('titleBangla');
    $post->post_slug = $request->post_slug;
    $post->post_content = $request->articleEnglish;
    $post->post_content_bn = $request->articleBangla;
    $post->post_excerpt = $request->excerptEnglish;
    $post->post_excerpt_bn = $request->excerptBangla;
    $post->post_status = $request->post_status;
    $post->created_at = Carbon::parse($request->created_at)->toDateTimeString();
    if ($request->post_status == "schedule") {
      $post->schedule_time = Carbon::parse($request->scheduleTime);
    }
    $post->post_type = $module;
    $post->post_format = $request->postFormat;
    $post->upload_type = $request->upload_type;
    $post->comments_status = $request->comment_status;
    $post->attachment_status = $request->attached;
    $post->option_status = $request->option;
    $post->user_id = auth()->user()->id;
    $post->save();
    $post_id = $post->id;

    $stories = $request->stories;
    if ($stories) {
      $story_relation = new CaseStudyRelation();
      $story_relation->is_active = 1;
      $story_relation->post_id = $post_id;
      $story_relation->round_id = $request->round_id;
      $story_relation->subject_id = $request->subject_id;
      $story_relation->student_id = $request->student_id;
      $story_relation->module_id = $request->module_id;
      $story_relation->user_id = auth()->user()->id;
      $story_relation->save();
    }

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
    $tags = $request->tags ?? array();
    $taxonomy = $request->taxonomy ?? array();
    if (!empty($tags)) {
      $mergeTaxonomy = array_merge($tags, $taxonomy);
    } else {
      $mergeTaxonomy = $taxonomy;
    }
    if (!empty($mergeTaxonomy)) {
      foreach ($mergeTaxonomy as $taxonomy) {
        $taxoRelation = new TermRelation();
        $taxoRelation->taxonomy_id = $taxonomy;
        $taxoRelation->post_id = $post_id;
        $taxoRelation->user_id = Auth::id();
        $taxoRelation->save();
      }
    }
    return redirect("admin/type/{$module}/{$post_id}/edit")->with("success", "Post created successfully");
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function show($post_slug)
  {
    $getURL = request()->route()->getName();
    $moduleArr = explode("/", $getURL);
    //        return dump($moduleArr);
    $post = Post::where("post_slug", $post_slug)->first();
    if (!empty($post)) {
      return view("$this->path.single-post", compact("post"));
    }
    return back()->with("error", "Post not found");
  }

  /**
   * @param Request $request
   * @param $id
   * @return Factory|View
   */
  public function edit(Request $request, $id)
  {
    $moduleSlug = $request->segment(3);
    $module = Module::where("is_delete", 0)
      ->where("slug", $moduleSlug)
      ->firstOrFail();
    $globalTerms = Admin::get_module_terms(0);
    $moduleTerms = Admin::get_module_terms($module->id);
    $terms = $globalTerms->merge($moduleTerms);
    $post = Post::where("is_delete", 0)->findOrFail($id);

    return view("$this->path.edit-post", compact("module", "terms", "post"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'module_id' => 'required|numeric|max:99',
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

      'stories' => 'nullable|string|max:25',
      'subject_id' => 'required_with:stories|numeric|max:99',
      'round_id' => 'required_with:stories|numeric|max:99',
      'student_id' => 'required_with:stories|numeric|max:99',

      'post_status' => 'required|string|max:55',
      'scheduleTime' => 'nullable|string|max:91',
      'postFormat' => 'required|string|max:55',
      'upload_type' => 'nullable|string|max:45',
      'picture' => 'nullable|string|max:255',
      'newPicture' => 'nullable|max:1536|mimes:jpeg,jpg,png,gif',
    ]);

    $module = $request->post_type;
    $post = Post::find($id);
    // Handle File Upload
    if ($request->hasFile('newPicture') && $request->upload_type == "new") {
      $imgName = Str::slug(Str::limit($post->post_title, 60)) . "-" . date("m-Y");
      $storeImage = Admin::store_image($request->newPicture, "posts/{$module}", $imgName);
      $post->post_thumb = $storeImage['thumb'];
      $post->post_thumb_original = $storeImage['original'];
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
    $post->post_format = $request->postFormat;
    $post->upload_type = $request->upload_type;
    $post->comments_status = $request->comment_status ?? Null;
    $post->attachment_status = $request->attached ?? Null;
    $post->option_status = $request->option ?? Null;
    $post->created_at = Carbon::parse($request->created_at)->toDateTimeString();
    $post->user_id = auth()->user()->id;
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

    $stories = $request->stories;
    if ($stories) {
      $story_id = $request->stories_id;
      $story = CaseStudyRelation::find($story_id);
      if (!empty($story)) {
        $story_relation = $story;
      } else {
        $story_relation = new CaseStudyRelation();
      }
      $story_relation->is_active = 1;
      $story_relation->post_id = $id;
      $story_relation->round_id = $request->round_id;
      $story_relation->subject_id = $request->subject_id;
      $story_relation->student_id = $request->student_id;
      $story_relation->module_id = $request->module_id;
      $story_relation->user_id = auth()->user()->id;
      $story_relation->save();
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

    $tags = $request->tags ?? array();
    $taxonomy = $request->taxonomy ?? array();
    if (!empty($tags)) {
      $mergeTaxonomy = array_merge($tags, $taxonomy);
    } else {
      $mergeTaxonomy = $taxonomy;
    }

    //        $post_taxonomy = get_post_taxonomy($id);
    //        $old_taxonomies = object_to_array($post_taxonomy);

    if (!empty($mergeTaxonomy)) {
      TermRelation::where("post_id", $id)->update([
        "is_active" => 0,
      ]);
      foreach ($mergeTaxonomy as $taxonomy) {
        $relation = TermRelation::where("taxonomy_id", $taxonomy)->where("post_id", $id)->first();
        if (!empty($relation)) {
          TermRelation::where("taxonomy_id", $taxonomy)->where("post_id", $id)->update([
            "is_active" => 1,
          ]);
        } else {
          $taxoRelation = new TermRelation();
          $taxoRelation->taxonomy_id = $taxonomy;
          $taxoRelation->post_id = $id;
          $taxoRelation->user_id = auth()->user()->id;
          $taxoRelation->save();
        }
      }
    }
    return back()->with("success", "Post Updated successfully");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
    $post = Post::find($id);
    $post->is_delete = 1;
    $post->save();
    TermRelation::where("post_id", $id)->update([
      "is_active" => 0
    ]);
    return back()->with("success", "Post Deleted Successfully");
  }

  /**
   * Get ajax slug url .
   *
   * @param int $id
   * @return Response
   */
  public function get_slug_menu(Request $request)
  {
    $title = $request->input('title');
    return slug_url($title);
  }

  //get_case_study_info
  public function get_case_study_info(Request $request)
  {
    $method_id = $request->input('method_id');
    $subject = $request->input('subject');
    $round = $request->input('round');
    $student_id = $request->input('select_student_id') ?? null;

    $students = Post::get_case_study_info_by_filter($method_id, $subject, $round);

    $option = null;
    foreach ($students as $student) {
      $selected = $student->id == $student_id ? "selected" : null;
      $option .= "<option value='" . $student->id . "' " . $selected . ">" . $student->name . "</option>";
    }
    return $option;
  }
}
