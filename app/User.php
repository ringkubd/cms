<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\AccessModels\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable;

  protected $table = 'users';

  public $primaryKey = 'id';

  public $timestamps = true;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'active', 'firstName', 'LastName', 'gender', 'role_id', 'is_delete', 'picture', 'email', 'password'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];


  public function role()
  {
    return $this->belongsTo('App\Models\AccessModels\Role');
  }


  public function generateToken()
  {
    $this->api_token = str_random(60);
    $this->save();

    return $this->api_token;
  }
}
