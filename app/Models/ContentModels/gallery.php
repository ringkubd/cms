<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class gallery extends Model
{
  // Table Name
  protected $table = 'galleries';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamps
  public $timestamps = true;

  protected $fillable = [
    'is_active', 'filename', 'filePath', 'caption', 'caption_bn', 'post_status', 'schedule_time', 'user_id'
  ];


  public function user()
  {
    return $this->belongsTo('App\User')->where('active', 1);
  }

  public function categories()
  {
    return $this->belongsToMany('App\Models\ContentModels\Taxonomy', 'gallery_relation', 'picture_id', 'category_id')
      ->wherePivot('visibility', 1)
      ->where('is_delete', 0)
      ->where('active', 1);
  }


  public static function save_data($data, $id = 0)
  {
    $pic = new gallery();
    if ($id) {
      $pic = gallery::find($id);
    }
    $pic->is_active = 1;
    $pic->caption = $data["caption"];
    $pic->caption_bn = $data["caption_bn"];
    $pic->post_status = $data["post_status"];
    $pic->schedule_time = $data["scheduleTime"];
    $pic->user_id = auth()->user()->id;
    $pic->save();
    return $pic->id;
  }

  public static function save_relation_data($taxoArray, $pic_id, $visibility = 1)
  {
    foreach ($taxoArray as $key => $item) {
      GalleryRelation::updateOrCreate(
        ['category_id' => $item, 'picture_id' => $pic_id],
        [
          "visibility" => $visibility,
          "date" => Carbon::now()->toDateString(),
        ]
      );
    }
    return true;
  }

  public static function get_photo_categories_by_date($date)
  {
    $date = Carbon::parse($date)->toDateString();

    return GalleryRelation::with('category')
      ->where('date', $date)
      ->where('visibility', 1)
      ->select('category_id')
      ->groupBy('category_id')
      ->groupBy('date')
      ->orderByDesc('date')
      ->get();
  }

  public static function get_galaries($cat_id, $date)
  {
    return gallery::where('is_active', 1)
      ->whereIn('id', function ($query) use ($date, $cat_id) {
        $query->select('picture_id')->from('gallery_relation')->where('date', $date)->where('category_id', $cat_id)->groupBy('picture_id');
      })
      ->orderByDesc('created_at')
      ->get();
  }


  public static function get_pictures_cats($pic_id)
  {
    return DB::table("gallery_relation as gr")
      ->where("gr.visibility", 1)
      ->where("gr.picture_id", $pic_id)
      ->join("taxonomies as t", "t.id", "gr.category_id")
      ->select("t.*")
      ->get();
  }


  public static function get_pictures_by_cat_id($cat_id, $date)
  {
    $date = Carbon::parse($date)->format("Y-m-d");
    $pictures = DB::table("gallery_relation as gr")
      ->where("gr.category_id", $cat_id)
      ->where("gr.date", $date)
      ->where("gr.visibility", 1)
      ->join("galleries as g", "g.id", "gr.picture_id")
      ->where("g.is_active", 1)
      ->where("g.post_status", "publish")
      ->orderby("gr.date", "desc");
    return $pictures->get()->groupBy("category_id");
  }

  public static function photo_cat_info($id = null, $slug = null)
  {
    $category = DB::table("taxonomies");
    if ($id) {
      $category = $category->where("id", $id)->first();
      return $category;
    }
    if ($slug && $slug !== "all") {
      $category = $category->where("slug", $slug)
        ->where("term", "photo-category")
        ->where("is_delete", 0)
        ->where("active", 1)
        ->first();
      return $category;
    }
  }

  public static function pic_cats_id_by_date($date)
  {
    $date = Carbon::parse($date)->format("Y-m-d");
    $cats = DB::table("gallery_relation as gr")
      ->where("gr.date", $date)
      ->where("gr.visibility", 1)
      ->select(DB::raw("category_id"))
      ->groupBy("category_id");
    return $cats->get();
  }


  public static function gallery_relation_invisible($id)
  {
    return DB::table("gallery_relation")
      ->where("picture_id", $id)
      ->update([
        'visibility' => 0
      ]);
  }

}
