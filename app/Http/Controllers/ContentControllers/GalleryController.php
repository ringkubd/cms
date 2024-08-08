<?php

namespace App\Http\Controllers\ContentControllers;

use App\Admin;
use App\Home;
use App\Http\Controllers\Controller;
use App\Models\ContentModels\gallery;
use App\Models\ContentModels\ImageUploadRelation;
use App\Models\ContentModels\Module;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.gallery";
  }

  /**
   * @param Request $request
   * @return Factory|View
   */
  public function index(Request $request)
  {
    $cats = DB::table("taxonomies")
      ->where('module', 'photo-gallery')
      ->get();
    $pictures = gallery::with('categories', 'user')->where('is_active', 1)
      ->orderByDesc('created_at')
      ->paginate(10);
    return view('admin.pages.gallery.show-gallery', compact("pictures", "cats"));
  }

  /**
   * @param Request $request
   * @return Factory|View
   */
  public function create(Request $request)
  {
    if (Session::has('picture')) {
      $array = Session::get('picture');
      foreach ($array as $pic_id) {
        $post = gallery::find($pic_id);
        $path = public_path($post->filePath);
        $thumbs = public_path(thumbs_url($post->filePath));
        file_exists($path) == TRUE ? unlink($path) : null;
        file_exists($thumbs) == TRUE ? unlink($thumbs) : null;
        $post->delete();
      }
      Session::forget('picture');
    }

    $moduleSlug = $request->segment(3);
    $module = Module::where('is_delete', 0)
      ->where('slug', $moduleSlug)
      ->firstOrFail();
    $terms = Admin::get_module_terms($module->id);
    return view('admin.pages.gallery.create-gallery', compact('module', 'terms'));
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $data = $this->validate($request, [
      'post_status' => 'required|string|max:99',
      'scheduleTime' => 'nullable|string|max:99',
      'caption' => 'nullable|string|max:255',
      'caption_bn' => 'nullable|string|max:255',
      'taxonomy' => 'nullable|array|max:255',
    ]);
    $taxonomy = $request->input('taxonomy') ?? array();
    if (Session::has('picture')) {
      $array = Session::get('picture');
      foreach ($array as $pic_id) {
        gallery::find($pic_id)->update($data);
        gallery::save_relation_data($taxonomy, $pic_id);
      }
      Session::forget("picture");
      return back()->with("success", "Uploaded successfully");
    }
    return back()->with("error", "Uploaded Error");
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'active' => 'nullable|numeric|max:1',
      'post_status' => 'nullable|string|max:99',
      'scheduleTime' => 'nullable|string|max:99',
      'caption' => 'nullable|string|max:255',
      'caption_bn' => 'nullable|string|max:255',
    ]);

    $oldTaxonomy = $request->oldTaxonomy ?? array();
    $taxonomy = $request->taxonomy ?? array();
    $difference = array_diff($oldTaxonomy, $taxonomy) ?? $oldTaxonomy;
    $pic_id = gallery::save_data($request->all(), $id);
    gallery::save_relation_data($difference, $pic_id, 0);
    gallery::save_relation_data($taxonomy, $pic_id);

    return back()->with("success", "Uploaded save successfully");
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse
   */
  public function destroy($id)
  {
    $post = gallery::find($id);
    $path = public_path($post->filePath);
    $thumbs = public_path(thumbs_url($post->filePath));
    file_exists($path) == TRUE ? unlink($path) : null;
    file_exists($thumbs) == TRUE ? unlink($thumbs) : null;
    $post->delete();
    $relation = gallery::gallery_relation_invisible($id);
    return back()->with("success", "Picture Deleted Successfully");
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function fileStore(Request $request)
  {
    ini_set('memory_limit', '256M');
    ini_set('upload_max_filesize', '256M');
    ini_set('post_max_size', '256M');

    $image = $request->file('file');
    $imageName = $image->getClientOriginalName();

    $dir_path = "photos/shares/gallery/" . date('Y-m');
    $pathDir = Admin::create_public_directory($dir_path);
    Image::make($image)
      ->resize(1200, null, function ($c) {
        $c->aspectRatio();
      })->save("{$pathDir}/{$imageName}", 95);

    $thumbs_path = "{$dir_path}/thumbs";
    $pathThumbsDir = Admin::create_public_directory($thumbs_path);
    Image::make($image)
      ->resize(400, null, function ($c) {
        $c->aspectRatio();
      })->save("{$pathThumbsDir}/{$imageName}", 90);

    $data['filename'] = $imageName;
    $data['filePath'] = "{$dir_path}/{$imageName}";
    $data['user_id'] = Auth::id();
    $picture = gallery::create($data);
    $this->set_to_session($picture->id);
    return response()->json(['success' => $data['filePath']]);
  }


  /**
   * @param $id
   */
  public function set_to_session($id)
  {
    if (!Session::has('picture')) {
      Session::put('picture', array());
    }
    Session::push('picture', $id);
  }

  /**
   * @param Request $request
   * @return mixed
   */
  public function fileDestroy(Request $request)
  {
    $filename = $request->get('filename');
    $picture = gallery::where('filename', $filename)->first();
    gallery::where('filename', $filename)->delete();

    $organized_path = $picture->filePath;
    $path = public_path($organized_path);
    $thumbs = public_path(thumbs_url($organized_path));
    if (file_exists($path)) {
      unlink($path);
    }
    if (file_exists($thumbs)) {
      unlink($thumbs);
    }
    $del_id = array($picture->id);
    $array = Session::get('picture');

    $new_array = array_diff($array, $del_id);
    Session::put('picture', $new_array);
    return $filename;
  }
}
