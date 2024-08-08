<?php

namespace App\Models\AccessModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserPermission extends Model
{
  protected $table = 'user_permissions';

  public $primaryKey = 'id';

  public $timestamps = true;

  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

}
