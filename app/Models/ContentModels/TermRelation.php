<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class TermRelation extends Model
{
  protected $table = 'term_relations';

  public $primaryKey = 'id';

  public $timestamps = true;

  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function taxonomy()
  {
    return $this->hasMany('App\Models\ContentModels\Taxonomy', 'id', 'taxonomy_id');
  }

  public function post()
  {
    return $this->hasMany('App\Models\ContentModels\Post', 'id', 'post_id');
  }


}
