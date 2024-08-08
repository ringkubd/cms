<?php

namespace App;

use App\Models\ContentModels\Advertisement;
use App\Models\ContentModels\Module;
use App\Models\ContentModels\Post;
use App\Models\ContentModels\Taxonomy;
use App\Models\InfoModel\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
  public static function get_settings($key, $status = FALSE)
  {
    $setting = DB::table("settings")->where("key", $key);
    if ($status) {
      $setting = $setting->where("active", 1);
    }
    $setting = $setting->first();
    if ($setting) {
      return $setting->value;
    }
    return null;
  }

  public static function check_settings_active($key)
  {
    $setting = DB::table("settings")->where("key", $key)->first();
    return $setting->active;
  }

  public static function get_post_keywords($post_id)
  {
    $tags = Post::get_post_taxonomies($post_id, "tags");
    $cats = Post::get_post_taxonomies($post_id, "category");
    $data = $cats->merge($tags);
    $keywords = array();
    foreach ($data as $key => $item) {
      $keywords[$key] = $item->name;
    }
    return implode(",", $keywords);
  }

  public static function get_group_menu_by_parent($groupSlug, $parentId)
  {
    return DB::table("menu_groups as fmg")
      ->where("fmg.slug_name", $groupSlug)
      ->where("fmg.is_delete", 0)
      ->join("front_menus as fm", "fm.group_id", "fmg.id")
      ->where("fm.parent_id", $parentId)
      ->where("fm.active", 1)
      ->select("fm.*")
      ->orderBy("fm.order", "asc")
      ->get();
  }


  public static function get_success_stories_post($cat_slug, $paginate = 15, $module_slug = null, $template = null)
  {
    $post_ids = Home::taxonomies_post_ids($cat_slug);
    $post = Post::whereIn('id', $post_ids)
      ->where('is_delete', 0)
      ->where('post_status', 'publish')
      ->with(['user', 'attachment', 'module', 'case_study' => function ($caseStudey) {
        $caseStudey->with(['student' => function ($student) {
          $student->with('round', 'subject', 'position', 'company');
        }]);
      }]);
    if ($module_slug) {
      $post = $post->where('post_type', $module_slug);
    }
    if ($template) {
      $post = $post->where('post_format', $template);
    }
    return $post->orderByDesc('created_at')->paginate($paginate);
  }

  public static function get_success_stories_new(){
    return Student::where('is_success_stories', 1)->get();
  }

  public static function get_module_for_display($limit = 10)
  {
    return Module::where('active', 1)
      ->where('is_delete', 0)
      ->orderBy('created_at')
      ->limit($limit)
      ->get();
  }

  public static function get_posts_by_type($post_type = [], $limit = 10)
  {
    return DB::table("posts")
      ->where("post_status", "publish")
      ->where("is_delete", 0)
      ->whereIn("post_type", $post_type)
      ->orderBy("created_at", "desc")
      ->limit($limit)
      ->get();
  }

  public static function get_case_study_attachment($postId, $limit = 10)
  {
    return DB::table("attachments")
      ->where("active", 1)
      ->where("post_id", $postId)
      ->orderBy("created_at", "asc")
      ->get();
  }

  public static function get_post_by_categories($categories = [], $module = null, $limit = null, $paginate = null)
  {
    return Taxonomy::whereIn('slug', $categories)
      ->where("is_delete", 0)
      ->where("active", 1)
      ->with(["posts" => function ($post) use ($module, $paginate, $limit) {
        if ($module) {
          $post->with('user', 'module')->where('post_type', $module);
        }
        if ($limit) {
          $post->with('user', 'module')->limit($limit);
        }
        if ($paginate) {
          $post->with('user', 'module')->paginate($paginate);
        }
        $post->with('user', 'module');
      }])
      ->get();
  }

  public function get_posts_by_single_cats($cat_slug, $limit = 15, $module_slug = null)
  {
    $posts = DB::table('posts as p')
      ->where('p.post_status', 'publish')
      ->where('p.is_delete', 0);
    if ($module_slug) {
      $posts = $posts->where('p.post_type', $module_slug);
    }
    return $posts->join('modules as m', 'm.slug', 'p.post_type')
      ->where('m.active', 1)
      ->where('m.is_delete', 0)
      ->join('term_relations as tr', 'tr.post_id', 'p.id')
      ->where('tr.is_active', 1)
      ->join('taxonomies as t', 't.id', 'tr.taxonomy_id')
      ->where('t.active', 1)
      ->where('t.is_delete', 0)
      ->where('t.slug', $cat_slug)
      ->select('p.*', 't.id as cat_id', 't.name as cat_name', 't.slug as cat_slug', 'm.name as module_name', 'm.slug as module_slug', 'm.picture as module_picture')
      ->orderByDesc('p.created_at')
      ->limit($limit)
      ->get();
  }

  public static function taxonomies_post_ids($cat_slug)
  {
    if (!is_array($cat_slug)) {
      $cat_slug = array($cat_slug);
    }
    $taxonomies = DB::table('taxonomies as t')
      ->where('t.active', 1)
      ->where('t.is_delete', 0)
      ->whereIn('t.slug', $cat_slug)
      ->join('term_relations as tr', 'tr.taxonomy_id', 't.id')
      ->where('tr.is_active', 1)
      ->select('tr.post_id')
      ->groupBy('tr.post_id')
      ->get()
      ->toArray();

    return array_column($taxonomies, 'post_id');
  }

  public static function get_posts_by_multiple_category($cat_group = [], $limit = null, $paginate = null, $option = array())
  {
    $module = $option['module'] ?? null;
    $start = $option['start'] ?? null;
    $end = $option['end'] ?? null;

    $post_ids = Home::taxonomies_post_ids($cat_group);

    $posts = DB::table('posts as p')
      ->whereIn('p.id', $post_ids)
      ->where('p.is_delete', 0)
      ->where('p.post_status', 'publish');
    if ($module) {
      $posts = $posts->where("p.post_type", $module);
    }
    $posts = $posts->join("modules as m", "p.post_type", "m.slug");
    if ($start || $end) {
      $start = Carbon::parse($start ?? null)
        ->startOfDay() // 2018-09-29 00:00:00.000000
        ->toDateTimeString(); // 2018-09-29 00:00:00
      $end = Carbon::parse($end ?? null)
        ->endOfDay() // 2018-09-29 23:59:59.000000
        ->toDateTimeString(); // 2018-09-29 23:59:59
      $posts = $posts->whereBetween('p.created_at', [$start, $end]);
    }
    $posts = $posts->select('p.*', 'm.name as module_name')
      ->orderByDesc('p.created_at');
    if ($limit) {
      $posts = $posts->limit($limit)->get();
    }
    if ($paginate) {
      $posts = $posts->paginate($paginate);
    }
    return $posts;
  }

  public static function get_case_study_video($post_id, $attach_type, $attach_path_type)
  {
    return DB::table("attachments")
      ->where("active", 1)
      ->where("post_id", $post_id)
      ->where("attachment_type", $attach_type)
      ->where("attachment_path_type", $attach_path_type)
      ->first();
  }


  public static function get_case_study_related_data($post_id, $limit = 10)
  {
    return DB::table("case_study_relations as csr")
      ->where("csr.is_active", 1)
      ->where("csr.post_id", $post_id)
      ->join("rounds as r", "r.id", "csr.round_id")
      ->join("subjects as sub", "sub.id", "csr.subject_id")
      ->join("students as st", "st.id", "csr.student_id")
      ->where("st.active", 1)
      ->leftJoin("companies as c", "c.id", "st.company_id")
      ->join("positions as p", "p.id", "st.position_id")
      ->join("modules as m", "m.id", "csr.module_id")
      ->select("r.name as round_name", "sub.subject_name", "st.*", "m.name as module_name", "p.position_name", "c.name as company_name")
      ->first();
  }

  public static function get_single_post($id = null, $postSlug = null, $postType = null)
  {
    $post = DB::table("posts")
      ->where("is_delete", 0)
      ->where("post_status", "publish");
    if ($id) {
      $post = $post->where('id', $id);
    } elseif ($postSlug) {
      $post = $post->where("post_slug", $postSlug);
    }
    if ($postType) {
      $post = $post->where("post_type", $postType);
    }
    return $post->first();
  }


  public static function get_module_courses_by_module_slug($moduleSlug, $order = null, $limit = null)
  {
    $courses = DB::table("modules as m")
      ->where("m.slug", $moduleSlug)
      ->where("m.active", 1)
      ->where("m.is_delete", 0)
      ->join("subjects as c", "c.module_id", "m.id")
      ->select("c.*", "m.slug as module_slug");
    if ($order) {
      $courses = $courses->orderBy("created_at", $order);
    }
    if ($limit) {
      $courses = $courses->limit($limit);
    }
    return $courses->get();
  }

  public static function get_related_post($post_id, $postType = false, $limit = 6)
  {
    $posts = DB::table("term_relations")
      ->where("is_active", 1)
      ->where("post_id", $post_id)
      ->select("taxonomy_id")
      ->get();
    $taxo_id = array();
    foreach ($posts as $key => $post) {
      $taxo_id[$key] = $post->taxonomy_id;
    }
    $relations = DB::table("term_relations")
      ->where("is_active", 1)
      ->whereIn("taxonomy_id", $taxo_id)
      ->select("post_id")
      ->get();
    $post_arr = array();
    foreach ($relations as $rkey => $rpost) {
      $post_arr[$rkey] = $rpost->post_id;
    }
    $posts = DB::table("posts")
      ->whereIn("id", $post_arr)
      ->where("is_delete", 0)
      ->where("post_status", "publish");
    if ($postType) {
      $posts = $posts->where("post_type", $postType);
    }
    $posts = $posts->where("id", "!=", $post_id)
      ->limit($limit)
      ->orderBy("created_at", "desc")
      ->get();
    return $posts;
  }

  public static function get_related_page($postType, $limit = 6)
  {
    return DB::table("posts")
      ->where("is_delete", 0)
      ->where("post_status", "publish")
      ->where("post_type", "page")
      ->where("post_format", $postType)
      ->orderBy("created_at")
      ->limit($limit)
      ->get();
  }

  public static function get_popup_modal_info($slug, $limit = 5)
  {
    $today = Carbon::now()->timezone('Asia/Dhaka')->toDateTimeString();
    if ($slug) {
      return DB::table("advertisement_relations as adr")
        ->where("adr.active", 1)
        ->where("adr.module_id", function ($module) use ($slug) {
          $module->select('id')->from('modules')->where("active", 1)->where('is_delete', 0)->where('slug', $slug);
        })
        ->join("advertisements as ad", "ad.id", "adr.advertise_id")
        ->where("ad.status", "publish")
        ->where("ad.is_delete", 0)
        ->where("ad.start_time", "<=", $today)
        ->where("ad.end_time", ">=", $today)
        ->orderByDesc("ad.created_at")
        ->limit($limit)
        ->get();
    }
    if (is_null($slug)) {
      return Advertisement::where('home_page', 1)
        ->where("status", "publish")
        ->where("is_delete", 0)
        ->where("start_time", "<=", $today)
        ->where("end_time", ">=", $today)
        ->orderByDesc("created_at")
        ->limit($limit)
        ->get();
    }

    return null;
  }

  public static function count_images($category)
  {
    if ($category == "all") {
      return DB::table("gallery_relation as gr")
        ->where("gr.visibility", 1)
        ->join("galleries as g", "g.id", "gr.picture_id")
        ->where("g.is_active", 1)
        ->where("g.post_status", "publish")
        ->count();
    }
    $taxonomy = DB::table("taxonomies as t")
      ->where("t.is_delete", 0)
      ->where("t.active", 1)
      ->where("t.module", "photo-gallery");
    if ($category) {
      $taxonomy->where("t.slug", $category);
    }
    $taxonomy = $taxonomy->join("gallery_relation as gr", "gr.category_id", "t.id")
      ->where("gr.visibility", 1)
      ->join("galleries as g", "g.id", "gr.picture_id")
      ->where("g.is_active", 1)
      ->where("g.post_status", "publish")
      ->count();
    return $taxonomy;
  }

  public static function count_posts($category, $module = null)
  {
    $posts = DB::table("taxonomies as t")
      ->where("t.is_delete", 0)
      ->where("t.active", 1);
    if ($category && $category !== "all") {
      $posts->where("t.slug", $category);
    }
    $posts = $posts->join("term_relations as tr", "tr.taxonomy_id", "t.id")
      ->where("is_active", 1)
      ->join('posts as p', 'p.id', 'tr.post_id')
      ->where('p.post_status', 'publish');
    if ($module) {
      $posts = $posts->where("p.post_type", $module);
    } else {
      $posts = $posts->where("p.post_type", "!=", "page");
    }
    return $posts->count();
  }


  public static function get_module_post_by_slug($moduleSlug = null, $type = null, $postSlug = null, $paginate = null)
  {
    $posts = DB::table("posts as p")
      ->where("p.is_delete", 0)
      ->where("p.post_status", "publish");
    if ($moduleSlug) {
      $posts = $posts->where("p.post_format", $moduleSlug);
    }
    if ($type) {
      $posts = $posts->where("p.post_type", $type);
    }
    if ($postSlug) {
      $posts = $posts->where("p.post_slug", $postSlug)->first();
      return $posts;
    }
    if ($paginate) {
      return $posts->paginate($paginate);
    } else {
      return $posts->get();
    }
  }

  public static function get_module_page_by_module_slug($moduleSlug)
  {
    return Post::where('post_type', 'page')
      ->where('post_format', $moduleSlug)
      ->where('post_status', 0)
      ->where('is_delete', 0)
      ->get();
  }

  public function get_page_by_id($page_id, $module)
  {
    return Post::with('user')
      ->where('is_delete', 0)
      ->where('post_status', 'publish')
      ->where('id', $page_id)
      ->where('post_type', 'page')
      ->where('post_format', $module)
      ->first();
  }


  public static function get_pages($cashReset = false, $limit = null)
  {
    if ($cashReset) {
      Cache::forget("pages");
    }
    $value = Cache::rememberForever('pages', function () use ($limit) {
      $pages = DB::table('posts')
        ->where("post_type", "page")
        ->where("post_status", "publish")
        ->where("is_delete", "0")
        ->orderByDesc("created_at");
      if ($limit) {
        $pages = $pages->limit(10);
      }
      return $pages->get();
    });
    return $value;
  }

  public static function get_posts($cashReset = false, $limit = 10)
  {
    if ($cashReset) {
      Cache::forget("posts");
    }
    $value = Cache::rememberForever('posts', function () use ($limit) {
      $pages = DB::table('posts')
        ->where("post_type", "!=", "page")
        ->where("post_status", "publish")
        ->where("is_delete", "0")
        ->orderByDesc("created_at");
      if ($limit) {
        $pages = $pages->limit($limit);
      }
      return $pages->get();
    });
    return $value;
  }
}
