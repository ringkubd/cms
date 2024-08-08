<?php

namespace App\Http\Controllers\ContentControllers;

use App\Models\ContentModels\Advertisement;
use App\Models\ContentModels\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Admin;

class AdvertisementController extends Controller
{
  /**
   * @var string
   */
  protected $path;

  /**
   * AdvertisementController constructor.
   */
  public function __construct()
  {
    $this->path = "admin.pages.advertisement";
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $adverts = Advertisement::get_advertisement_data_table();
    $modules = Module::where("active", 1)->get();
    $authors = Advertisement::get_advertisement_post_authors();
    return view($this->path . ".show-table", compact("adverts", "modules", "authors"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $modules = Module::where("active", 1)->get();
    return view($this->path . ".create-form", compact("modules"));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'title_en' => 'required|string|max:191',
      'title_bn' => 'nullable|string|max:191',
      'article_en' => 'nullable|string|max:1200',
      'article_bn' => 'nullable|string|max:1200',
      'post_status' => 'nullable|string|max:55',
      'scheduleTime' => 'nullable|string|max:99',
      'start_time' => 'nullable|string|max:99',
      'end_time' => 'nullable|string|max:99',
      'home_page' => 'nullable|numeric|max:99',
      'upload_type' => 'nullable|string|max:99',
      'newPicture' => 'nullable|max:1536|mimes:jpeg,jpg,png,gif',
      'picture' => 'nullable|string|max:99',
    ]);

    if ($request->has("newPicture") && $request->upload_type == "new") {
      $imgName = Str::slug(Str::limit($request->title_en, 60)) . "-" . date("m-Y");
      $new_pictures = Admin::store_image($request->newPicture, "news", $imgName);
      $new_picture = $new_pictures['original'];
    } elseif ($request->upload_type == "from_old") {
      $new_picture = $request->picture;
    } else {
      $new_picture = false;
    }
    $add_id = Advertisement::save_advertisement($request->all(), $new_picture);
    if ($add_id > 0) {
      $relations = Advertisement::save_adertisement_relation($request->modules, $add_id);
      return redirect("admin/advertisement")->with("success", "Advertisement save successfully");
    }
    return back()->with("error", "Advertisement not saved");
  }


  public function filter_advertisement(Request $request)
  {
    $filters = [
      "author_id" => $request->author,
      "module_id" => $request->module,
      "status" => $request->status,
      "dateFilter" => $request->dateFilter,
      "dateRange" => $request->dateRange,
    ];
    $modules = Module::where("active", 1)->get();
    $authors = Advertisement::get_advertisement_post_authors();
    return view($this->path . ".show-table", compact("filters", "modules", "authors"));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $modules = Module::where("active", 1)->get();
    $advert = Advertisement::find($id);
    $ad_Module = Advertisement::get_advertisement_module_array($id, true);
    return view($this->path . ".edit-form", compact("advert", "modules", "ad_Module"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'title_en' => 'required|string|max:191',
      'title_bn' => 'nullable|string|max:191',
      'article_en' => 'nullable|string|max:1200',
      'article_bn' => 'nullable|string|max:1200',
      'post_status' => 'nullable|string|max:55',
      'scheduleTime' => 'nullable|string|max:99',
      'start_time' => 'nullable|string|max:99',
      'end_time' => 'nullable|string|max:99',
      'home_page' => 'nullable|numeric|max:99',
      'upload_type' => 'nullable|string|max:99',
      'newPicture' => 'nullable|max:1536|mimes:jpeg,jpg,png,gif',
      'picture' => 'nullable|string|max:99',
    ]);

    if ($request->has("newPicture") && $request->upload_type == "new") {
      $imgName = Str::slug(Str::limit($request->title_en, 60)) . "-" . date("m-Y");
      $new_pictures = Admin::store_image($request->newPicture, "news", $imgName);
      $new_picture = $new_pictures['original'];
    } elseif ($request->upload_type == "from_old") {
      $new_picture = $request->picture;
    } else {
      $new_picture = false;
    }
    $add_id = Advertisement::save_advertisement($request->all(), $new_picture, true, $id);
    if ($add_id > 0) {
      $relations = Advertisement::update_adertisement_relation($request->modules, $id);
      return redirect("admin/advertisement")->with("success", "Advertisement save successfully");
    }
    return back()->with("error", "Advertisement not saved");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $advert = Advertisement::find($id);
    $advert->is_delete = 1;
    $advert->save();
    return back()->with("warning", "Advertisement deleted");
  }
}
