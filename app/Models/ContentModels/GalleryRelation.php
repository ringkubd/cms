<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class GalleryRelation extends Model
{
  // Table Name
  protected $table = 'gallery_relation';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamps
  public $timestamps = true;

  protected $fillable = [
    'visibility', 'category_id', 'picture_id', 'date'
  ];

  public function categories()
  {
    return $this->hasMany('App\Models\ContentModels\Taxonomy', 'id', 'category_id');
  }

  public function category()
  {
    return $this->hasOne('App\Models\ContentModels\Taxonomy', 'id', 'category_id');
  }

  public function picture()
  {
    return $this->hasOne('App\Models\ContentModels\gallery', 'id', 'picture_id');
  }

}
