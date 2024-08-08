<?php

namespace App\Models\AccessModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontMenu extends Model
{
  // Table Name
  protected $table = 'front_menus';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamps
  public $timestamps = true;

  public static function save_front_menu_ajax_data($data)
  {
    $menu_id = $data["menu_id"];
    $parent_id = $data["parent_id"];
    $group_id = $data["group_id"];
    $options = '{"menu_class":"' . $data["menu_class"] . '","menu_title":"' . $data["menu_title"] . '","menu_window":"' . $data["menu_window"] . '","menu_icon":"' . $data["menu_icon"] . '"}';
    if ($menu_id > 0) {
      $menu = FrontMenu::find($menu_id);
    } else {
      $menu = new FrontMenu();
    }
    $menu->active = 1;
    $menu->name = $data["name"];
    $menu->url = $data["url"];
    $menu->options = $options;
    $menu->order = $data["order"];
    $menu->parent_id = $parent_id;
    $menu->group_id = $group_id;
    $menu->menu_type = $data["menu_type"];
    $menu->user_id = auth()->user()->id;
    $menu->save();
    return $menu->id;
  }

  /**
   * @param int $menu_id
   * @param int $group_id
   * @return bool
   */
  public static function check_in_group(int $menu_id, int $group_id)
  {
    $group = DB::table("front_menu_groupings")
      ->where("menu_id", $menu_id)
      ->where("group_id", $group_id)
      ->where("is_permission", 1)
      ->first();
    if (!empty($group)) {
      return TRUE;
    }
    return FALSE;
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function ParentMenu()
  {
    return $this->hasOne(FrontMenu::class, 'id', 'parent_id');
  }

  public function permission()
  {
    return $this->hasOne(FrontMenuGrouping::class, 'menu_id', 'id');
  }

  public function menuOrder()
  {
    return $this->hasOne(FrontMenuAlignment::class, 'menu_id', 'id');
  }
}
