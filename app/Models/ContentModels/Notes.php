<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
  protected $table = 'notes';
  public $primaryKey = 'id';
  public $timestamps = true;
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\User')->where('active', 1);
  }

}
