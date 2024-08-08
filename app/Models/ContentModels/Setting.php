<?php

namespace App\Models\ContentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
  // Table Name
  protected $table = 'settings';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamps
  public $timestamps = true;

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public static function active_setting($active_key, $active = 1)
  {
    DB::table("settings")->where("key", $active_key)->update([
      "active" => $active,
      "user_id" => auth()->user()->id,
    ]);
  }

  public static function save_website_settings($arras)
  {
    foreach ($arras as $key => $value) {
      Setting::updateOrInsert(
        ['key' => $key],
        [
          'value' => $value,
          'user_id' => Auth::id(),
        ]
      );
    }
    return true;
  }
}
