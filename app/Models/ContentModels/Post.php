<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

  protected $table = 'posts';
  public $primaryKey = 'id';
  public $timestamps = true;
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\User')->where('active', 1);
  }

  public function attachment()
  {
    return $this->hasOne('App\Models\ContentModels\Attachment', 'post_id', 'id')
      ->where('active', 1);
  }

  public function attachments()
  {
    return $this->hasMany('App\Models\ContentModels\Attachment', 'post_id', 'id')
      ->where('active', 1);
  }

  public function module()
  {
    return $this->hasOne("App\Models\ContentModels\Module", "slug", "post_type")
      ->where('is_delete', 0);
  }

  public function pageModule()
  {
    return $this->hasOne("App\Models\ContentModels\Module", "slug", "post_format")
      ->where('is_delete', 0);
  }


  public function case_study()
  {
    return $this->hasOne("App\Models\ContentModels\CaseStudyRelation", "post_id", "id")
      ->where('is_active', 1);
  }

  public function categories()
  {
    return $this->belongsToMany('App\Models\ContentModels\Taxonomy', 'term_relations', 'post_id', 'taxonomy_id')
      ->wherePivot('is_active', 1)
      ->where('is_delete', 0)
      ->where('active', 1);
  }


  public static function get_module_rounds($module_id = null)
  {
    return DB::table("rounds")
      ->where("active", 1)
      ->where("is_delete", 0)
      ->orWhere("module_id", $module_id)
      ->orderBy("id", "desc")
      ->get();
  }


  public static function get_module_subjects($module_id = 0)
  {
    return DB::table("subjects")
      ->where("active", 1)
      ->where("is_delete", 0)
      ->where("module_id", $module_id)
      ->orderBy("id", "asc")
      ->get();
  }


  public static function get_case_study_info_by_filter($method_id, $subject, $round)
  {
    return DB::table("students")
      ->where("active", 1)
      ->where("is_delete", 0)
      ->where("module_id", $method_id)
      ->where("subject_id", $subject)
      ->where("round_id", $round)
      ->orderBy("id", "asc")
      ->get();
  }


  public static function get_post_first_comment_by_author($post_id)
  {
    return DB::table("comments")
      ->where("is_delete", 0)
      ->where("active", 1)
      ->where("post_id", $post_id)
      ->where("user_id", auth()->user()->id)
      ->first();
  }


  public static function get_module_post_by_filter($module, $author, $category, $status, $start, $end, $order, $search = null)
  {
    $post = Post::with('categories')->where('is_delete', 0);
    if ($category) {
      $post = $post->whereIn('id', function ($q) use ($category) {
        $q->select('tr.post_id')
          ->from('term_relations as tr')
          ->where('tr.is_active', 1)
          ->join('taxonomies as t', 't.id', 'tr.taxonomy_id')
          ->where('t.active', 1)
          ->where('t.is_delete', 0)
          ->where('t.slug', $category)
          ->groupBy('tr.post_id');
      });
    }

    $post = $author ? $post->where('user_id', $author) : $post; // filter author
    $post = $search ? $post->where('post_title', 'like', "%$search%") : $post; // filter serach
    $post = $module ? $post->where('post_type', $module) : $post; // filter post module
    $post = $status ? $post->where('post_status', $status) : $post; // filter post status

    $post = $start ? $post->where('created_at', '>=', Carbon::parse($start)->toDateTimeString()) : $post;
    $post = $end ? $post->where('created_at', '<=', Carbon::parse($end)->addHours(23)->addMinutes(59)->toDateTimeString()) : $post;
    $post = $order ? $post->orderBy('created_at', $order) : $post->orderByDesc('created_at');

    return $post->paginate(10);
  }


  public static function get_module_page_by_filter($module, $author, $status, $start, $end, $order, $search = null)
  {
    $post = Post::with(
      [
        'user' => function ($user) use ($author) {
          if ($author && $author !== "all") {
            $user->where('id', $author);
          }
        }, 'pageModule'
      ]
    )->where("post_type", "page");
    if ($search) {
      $post = $post->where("post_title", "like", "%$search%");
    }
    if ($module) {
      $post = $post->where("post_format", $module);
    }
    if ($status) {
      $post = $post->where("post_status", $status);
    }
    if ($start) {
      $start = Carbon::parse($start)->startOfDay()->toDateTimeString();
      $post = $post->where("created_at", ">=", $start);
    }
    if ($end) {
      $end = Carbon::parse($end)->endOfDay()->toDateTimeString();
      $post = $post->where("created_at", "<=", $end);
    }
    if ($order) {
      $post = $post->orderBy("created_at", $order);
    } else {
      $post = $post->orderByDesc("created_at");
    }
    return $post->where("is_delete", 0)->paginate(15);
  }

  public static function get_module_post_authors($module)
  {
    $posts = Post::with(["user"])
      ->where("post_type", $module)
      ->where("is_delete", 0)
      ->orderBy('id', 'desc')
      ->get();
    $authors = array();
    foreach ($posts as $post) {
      $auth_id = $post->user->id;
      $auth = $post->user->firstName . " " . $post->user->LastName;
      $authors[$auth_id] = $auth;
    }
    return $authors;
  }

  public static function get_post_taxonomies($post_id, $term)
  {
    return DB::table("term_relations as tr")
      ->where("tr.post_id", $post_id)
      ->where("tr.is_active", 1)
      ->join("taxonomies as tax", "tax.id", "tr.taxonomy_id")
      ->where("tax.term", $term)
      ->where("tax.active", 1)
      ->where("tax.is_delete", 0)
      ->select("tax.*")
      ->orderby("tr.id", "asc")
      ->get();
  }
}
