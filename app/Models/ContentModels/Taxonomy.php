<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
  protected $table = 'taxonomies';

  public $primaryKey = 'id';

  public $timestamps = true;

  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function ParentMenu()
  {
    return $this->hasOne(Taxonomy::class, 'id', 'parent_id');
  }


  public function termRelation()
  {
    return $this->hasOne("App\Models\ContentModels\TermRelation", "taxonomy_id", "id")
      ->where('is_active', 1);
  }

  public function posts()
  {
    return $this->belongsToMany('App\Models\ContentModels\Post', 'term_relations', 'taxonomy_id', 'post_id')
      ->wherePivot('is_active', 1)
      ->where('is_delete', 0)
      ->where('post_status', 'publish');
  }



  public function pictures()
  {
    return $this->belongsToMany('App\Models\ContentModels\gallery', 'gallery_relation', 'category_id', 'picture_id')
      ->wherePivot('visibility', 1)
      ->where('is_active', 1)
      ->where('post_status', 'publish')
      ->orderBy('created_at', 'DESC');
  }

  public function GalleryRelation()
  {
    return $this->hasMany('App\Models\ContentModels\GalleryRelation', 'category_id', 'id')
      ->where('visibility', 1)
      ->orderBy('date', 'DESC');
  }
}
