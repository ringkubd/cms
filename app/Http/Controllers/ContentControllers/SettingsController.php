<?php

namespace App\Http\Controllers\ContentControllers;

use App\Admin;
use App\Models\ContentModels\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.settings";
  }

  // index or default load method
  public function index()
  {
    return view("$this->path.general-settings");
  }

  //general_settings_save
  public function general_settings_save(Request $request)
  {
    $settings = $this->validate($request, [
      'site_title' => 'required|string|max:255',
      'tagline' => 'nullable|string|max:255',
      'logo_preview' => 'required|string|max:255',
      'logo_picture' => 'nullable|max:512|mimes:jpeg,jpg,png,gif',

      'home_url' => 'nullable|active_url|max:155',
      'meta_title' => 'nullable|string|max:255',
      'meta_key' => 'nullable|string|max:900',
      'meta_desc' => 'nullable|string|max:900',
      'meta_picture' => 'nullable|max:1024|mimes:jpeg,jpg,png,gif',
      'date_format' => 'nullable|string|max:45',
      'time_format' => 'nullable|string|max:45',

      'facebook_url' => 'nullable|string|max:155',
      'linkedid_url' => 'nullable|string|max:155',
      'youtube_url' => 'nullable|string|max:155',

      'vt_api_base_url' => 'nullable|string|max:400',
      'vt_api_token' => 'nullable|string|max:400',

      'tranding_now' => 'nullable|array|max:1200',
    ]);

    $this->validate($request, [
      'facebook_active' => 'nullable|numeric|max:1',
      'linkedin_active' => 'nullable|numeric|max:1',
      'youtube_active' => 'nullable|numeric|max:1',
    ]);

    $settings['tranding_now'] = implode(',', $request->input('tranding_now'));

    $active_fb = $request->facebook_active ?? 0;
    Setting::active_setting("facebook_url", $active_fb);
    $active_linkedin = $request->linkedin_active ?? 0;
    Setting::active_setting("linkedin_url", $active_linkedin);
    $active_yt = $request->youtube_active ?? 0;
    Setting::active_setting("youtube_url", $active_yt);

    if ($request->hasFile("logo_picture")) {
      $imgName = Str::slug(Str::limit($request->site_title, 60)) . "-" . date("m-Y");
      $logo = Admin::store_image($request->logo_picture, "Logos", $imgName);
      $settings["logo_picture"] = $logo['original'];
    }
    if ($request->hasFile("meta_picture")) {
      $imgName = Str::slug(Str::limit($request->site_title, 60)) . "-" . date("m-Y");
      $metaPicture = Admin::store_image($request->meta_picture, "Meta-Picture", $imgName);
      $settings["meta_picture"] = $metaPicture['original'];
    }

    $status = Setting::save_website_settings($settings);

    if ($status) {
      return back()->with("success", "Settings Save Successfully");
    }
    return back()->with("error", "Settings Not Save");
  }

  public function save_page_path(Request $request)
  {
    $path = $this->validate($request, [
      'page_name' => 'nullable|string|max:255',
      'page_path' => 'nullable|string|max:400',
    ]);

    $function = base_path("app/helpers/functions.php");

    if (file_exists($function)) {
      $search = "//trending_now_option";
      $raplace = "'{$path['page_path']}' => '{$path['page_name']}', \r\n //trending_now_option";
      file_put_contents($function, str_replace($search, $raplace, file_get_contents($function)));
    }
    return back()->with('success', 'saved successfully');
  }

  public function theme_settings()
  {
    return view("$this->path.themes-settings");
  }

  public function theme_settings_save(Request $request)
  {
    $this->validate($request, [
      'theme' => 'required|string|max:155',
    ]);
    $data = [
      "default_theme" => $request->theme,
    ];
    Setting::save_website_settings($data);
    return back()->with("success", "Theme Actived successfully");
  }
}
