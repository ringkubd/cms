<?php

namespace App;

use App\Models\ContentModels\Module;
use App\Models\ContentModels\Taxonomy;
use App\Models\ContentModels\TermTaxonomy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Jenssegers\Agent\Agent;
use phpDocumentor\Reflection\Types\Self_;

class Admin extends Model
{

  public static function get_post_attachment($post_id, $attachment_type)
  {
    return DB::table("attachments")
      ->where("post_id", $post_id)
      ->where("attachment_type", $attachment_type)
      ->first();
  }

  public static function get_post_stories_info($post_id)
  {
    return DB::table("case_study_relations")
      ->where("is_active", 1)
      ->where("post_id", $post_id)
      ->first();
  }


  public static function get_module_by_slug($module_slug)
  {
    return Module::where("is_delete", 0)
      ->where("slug", $module_slug)
      ->first();
  }

  public static function get_module_terms($module_id = 0)
  {
    return TermTaxonomy::where('is_delete', 0)
      ->where('active', 1)
      ->where('module_id', $module_id)
      ->orderby('id')
      ->get();
  }

  public static function get_post_taxonomy($post_id)
  {
    return DB::table('term_relations as tr')
      ->where('tr.post_id', $post_id)
      ->where('tr.is_active', 1)
      ->join('taxonomies as t', "t.id", "tr.taxonomy_id")
      ->select('t.*')
      ->get();
  }


  public static function find_post_taxonomies($term, $module, $parent = null)
  {
    return Taxonomy::where('is_delete', 0)
      ->where('active', 1)
      ->where('parent_id', $parent)
      ->where('term', $term)
      ->where('module', $module)
      ->get();
  }

  public static function get_taxonomy_parent($term, $module = null)
  {
    $taxonomy = Taxonomy::with('ParentMenu')
      ->where('is_delete', 0)
      ->where('term', $term);
    if ($module) {
      $taxonomy = $taxonomy->where('module', $module);
    }
    return $taxonomy->orderByDesc('created_at')->paginate(10);
  }

  public static function store_image($image, $dir_path = "/", $name = null)
  {
    $imageName = $image->getClientOriginalName();
    if ($name) {
      $imageName = $name . "." . $image->getClientOriginalExtension();
    }

    $image->storeAs("{$dir_path}", $imageName, 'shares');

    $pathDir = public_path("photos/shares/{$dir_path}/thumbs");
    if (!File::isDirectory($pathDir)) {
      File::makeDirectory($pathDir, 0777, true, true);
    }
    $OriginalFile = Image::make($image->getRealPath());

    $img = Image::make($OriginalFile);
    $img->resize(400, null, function ($c) {
      $c->aspectRatio();
    });
    $resource = $img->stream()->detach();
    $path = Storage::disk('shares')->put("{$dir_path}/thumbs/{$imageName}", $resource);
    $data = [
      'original' => "photos/shares/{$dir_path}/{$imageName}",
      'thumb' =>  "photos/shares/{$dir_path}/thumbs/{$imageName}"
    ];
    return $data;
  }


  public static function create_public_directory($path)
  {
    $pathThumbsDir = public_path($path);
    if (!File::isDirectory($pathThumbsDir)) {
      File::makeDirectory($pathThumbsDir, 0777, true, true);
    }
    return $pathThumbsDir;
  }


  public static function unique_user()
  {
    $user = Auth::id();
    $ip = request()->ip();
    $agent = new Agent();
    $browser = $agent->browser();
    $bVersion = $agent->version($browser);
    return $user . '_' . $bVersion . '_' . $ip;
  }


  public static function get_permitted_menu_by_role_id($role_id)
  {
    return DB::table('user_permissions as up')
      ->where('up.role_id', $role_id)
      ->where('up.is_permission', 1)
      ->join('admin_menus as am', 'up.menu_id', 'am.id')
      ->where('am.is_delete', 0)
      ->select('am.*', 'up.role_id')
      ->orderBy('am.order')
      ->get();
  }

  public static function get_permitted_menus()
  {
    $unique_user = unique_user();
    if (Cache::has($unique_user)) {
      return Cache::get($unique_user);
    }
    $minutes = 7200; // 20 min ( 20 x 60  )
    return Cache::remember($unique_user, $minutes, function () {
      $role_id = auth_role_id();
      return self::get_permitted_menu_by_role_id($role_id);
    });
  }


  public static function admin_menu_cache_reset()
  {
    $unique_user = unique_user();
    Cache::forget($unique_user);
    return true;
  }

  public static function find_sidebar_menu($parent_id = 0)
  {
    return self::get_permitted_menus()
      ->where('method', 'GET')
      ->where('visibility', 1)
      ->where('parent_id', $parent_id);
  }
}
