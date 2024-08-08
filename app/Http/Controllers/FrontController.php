<?php

namespace App\Http\Controllers;

use App\ApiModel;
use App\Home;
use App\Models\Contact;
use App\Models\ContentModels\GalleryRelation;
use App\Models\ContentModels\Module;
use App\Models\ContentModels\Post;
use App\Models\ContentModels\Taxonomy;
use App\Models\ContentModels\gallery;
use App\Models\InfoModel\Student;
use App\Models\VocationalModels\IntakeModel;
use App\VideoStream;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{

  public function index()
  {
    return view('themes.default.welcome');
  }

  public function isdb_bisew_programme()
  {
    $programmes = Module::where('active', 1)->where('is_delete', 0)->paginate(6);
    return view('themes.default.isdb-bisew-programme', compact('programmes'));
  }

  public function about_us()
  {
    $programmes = Module::where('active', 1)->where('is_delete', 0)->get();
    $post = Home::get_module_post_by_slug(null, 'page', 'about');
    return view('themes.default.about', compact('programmes', 'post'));
  }

  public function download_forms()
  {
    $posts = Post::with('attachment')
      ->where('post_type', 'page')
      ->where('is_delete', 0)
      ->where('post_status', 'publish')
      ->where('post_format', 'download-forms')
      ->orderByDesc('created_at')
      ->paginate(10);
    return view('themes.default.forms', compact('posts'));
  }

  public function latest_notice(Request $request)
  {
    $option = [
      'module' => $request->input('type'),
      'start' => $request->input('start'),
      'end' => $request->input('end'),
    ];
    $latestNotice = Home::get_posts_by_multiple_category(['notice'], null, 10, $option);
    $programmes = Module::where('active', 1)->where("is_delete", 0)->get();
    return view('themes.default.notice', compact('latestNotice', 'programmes'));
  }

  public function tender_notice(Request $request)
  {
    $option = [
      'module' => $request->input('type'),
      'start' => $request->input('start'),
      'end' => $request->input('end'),
    ];
    $latestNotice = Home::get_posts_by_multiple_category(['tender'], null, 10, $option);
    $programmes = Module::where('active', 1)->where("is_delete", 0)->get();
    return view('themes.default.tender_notice', compact('latestNotice', 'programmes'));
  }

  public function tender(Request $request)
  {
    $option = [
      'module' => $request->input('type'),
      'start' => $request->input('start'),
      'end' => $request->input('end'),
    ];
    $latestNotice = Home::get_posts_by_multiple_category(['tender'], null, 10, $option);
    $programmes = Module::where('active', 1)->where("is_delete", 0)->get();
    return view('themes.default.tender', compact('latestNotice', 'programmes'));
  }


  public function latest_updates(Request $request)
  {
    $option = [
      'module' => $request->input('type'),
      'start' => $request->input('start'),
      'end' => $request->input('end'),
    ];
    $latestNews = Home::get_posts_by_multiple_category(['latest-update'], null, 5, $option);
    $programmes = Module::where('active', 1)->where("is_delete", 0)->get();
    return view("themes.default.latest-updates-page", compact('latestNews', 'programmes'));
  }

  // single_page
  public function single_page($post_slug)
  {
    $home = new Home();

    $module = Module::where('slug', $post_slug)->first();
    if ($module) {
      $story = $home->get_success_stories_post("success-stories", 10, $module->slug);
      switch ($post_slug) {
        case "it-scholarship-programme":
          return view("themes.default.module-pages.it-scholarship", compact("module", 'story'));
          break;
        case "vocational-training-programme":
          $intake = IntakeModel::lastIntakeScheduleApi();
          return view("themes.default.module-pages.vocational-training", compact("module", 'story', 'intake'));
          break;
        case "madrasah-education-programme":
          return view("themes.default.module-pages.madrasah-project", compact("module"));
          break;
        case "four-year-diploma-scholarship":
          return view("themes.default.module-pages.diploma-four-year", compact("module"));
          break;
        case "orphanage-programme":
          return view("themes.default.module-pages.orphanage-project", compact("module"));
          break;
        case "idb-bhaban":
          return view("themes.default.module-pages.idb-bhaban", compact("module"));
          break;
      }
    }
    $post = Post::where('post_slug', $post_slug)->where('is_delete', 0)->where('post_type', 'page')->where('post_status', 'publish')->firstOrFail();
    return view('themes.default.single-page', compact('post'));
  }

  public function module_page(Request $request, $module_slug, $post_slug)
  {
    $module = Module::where('slug', $module_slug)->where('is_delete', 0)->firstOrFail();

    $post = Post::where('post_slug', $post_slug)->where('post_type', 'page')->where("post_status", "publish")->firstOrFail();
    return view("themes.default.single-page", compact("post", "module"));
  }


  public function module_post(Request $request, $module_slug, $post_id, $post_slug)
  {
    $module = Module::where('slug', $module_slug)->first();
    $post = Post::where('id', $post_id)
      ->where("post_type", $module_slug)
      ->where("is_delete", 0)
      ->where("post_status", "publish")
      ->with(['user', 'attachment', 'module', 'case_study' => function ($caseStudy) {
        $caseStudy->with(['student' => function ($student) {
          $student->with('round', 'subject', 'position', 'company');
        }]);
      }])->firstOrFail();
    return view("themes.default.single-post", compact("post", "module"));
  }

  public function module_category_post(Request $request, $module_slug, $category, $post_id, $post_slug)
  {
    $module = Module::where('slug', $module_slug)->first();
    $post = Post::where('id', $post_id)->where("post_type", $module_slug)->where("post_status", "publish")->first();
    if (!empty($post)) {
      if ($post->post_type == "page") {
        return view("themes.default.single-page", compact("post"));
      } elseif ($post->post_type == $module_slug) {
        return view("themes.default.single-post", compact("post"));
      }
    }
    abort(404);
  }


  // filter_post
  public function filter_post(Request $request)
  {
    $var1 = $request->id;
    return $var1;
  }


  public function photo_gallery(Request $request)
  {
    $slug = $request->input('collection');
    $startDate = $request->input('date-from');
    $endDate = $request->input('date-to');
    if ($slug && $slug !== "all") {
      $cat = Taxonomy::where('slug', $slug)->first();
    } else {
      $cat = null;
    }
    $start = Carbon::parse($startDate)->toDateTimeString();
    $end = Carbon::parse($endDate)->addHours(23)->addMinutes(59)->toDateTimeString();

    $timelines = GalleryRelation::with('category')
      ->where('visibility', 1)
      ->select('date')
      ->groupBy('date')
      ->orderByDesc('date')
      ->paginate(2);
    $picCats = DB::table("taxonomies")
      ->where("term", "photo-category")
      ->where("is_delete", 0)
      ->where("active", 1)
      ->get();
    return view("themes.default.photo-gallery", compact("timelines", "picCats", "slug", "startDate", "endDate"));
  }

  public function top_job_placement()
  {
    $topPlacements = \App\Models\InfoModel\Student::where('is_success_stories', 1)->where('job_type', 'it')->with(['module', 'round', 'subject', 'position', 'company'])->paginate(20);
    $notices = Home::get_posts_by_multiple_category(['notice', 'events', 'update'], 5);
    return view('themes.default.top-job-placement', compact('topPlacements', 'notices'));
  }

  public function top_freelancer()
  {
    $topPlacements = \App\Models\InfoModel\Student::where('is_success_stories', 1)->where('job_type', 'freelancer')->with(['module', 'round', 'subject', 'position', 'company'])->paginate(20);
    $notices = Home::get_posts_by_multiple_category(['notice', 'events', 'update'], 5);
    return view('themes.default.top-job-placement', compact('topPlacements', 'notices'));
  }


  public function streaming_video(Request $request)
  {
    $key = $request->input('v');
    $stream = new VideoStream();
    $streamData = null;
    if ($key == 'about') {
      $video = public_path("files/shares/about-Isdb-BISEW.mp4");
      $streamData = $stream->VideoStream($video);
      return $stream->start();
    } elseif ($key == 'intro') {
      $video = public_path("files/shares/IDB-BISEW-for-home.mp4");
      $streamData = $stream->VideoStream($video);
      return $stream->start();
    }
  }


  public function download()
  {
    $file = \request('form');
    $pathToFile = public_path($file);
    return response()->download($pathToFile);
  }
}
