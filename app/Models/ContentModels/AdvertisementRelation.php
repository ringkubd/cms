<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class AdvertisementRelation extends Model
{
  // Table Name
  protected $table = 'advertisement_relations';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamps
  public $timestamps = true;


  public function advertisements()
  {
    return $this->hasMany('App\Models\ContentModels\Advertisement', 'advertise_id', 'id')
      ->where('is_delete', 0)
      ->where('post_status', 'publish');
  }
}
