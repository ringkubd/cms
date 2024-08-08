<?php

namespace App\Models\AccessModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminMenu extends Model
{
  protected $table = 'admin_menus';

  public $primaryKey = 'id';

  public $timestamps = true;
  protected  $guarded = [];

  public static function save_menu($data, $id = 0)
  {
    $menu = new AdminMenu();
    if ($id) {
      $menu = AdminMenu::find($id);
    }
    $menu->active = $data["active"] ?? 0;
    $menu->name = $data["name"];
    $menu->icon = $data["icon"] ?? "";
    $menu->route_uri = $data["route_uri"];
    $menu->method = $data["route_method"];
    $menu->parent_id = $data["parent_id"];
    $menu->visibility = $data["visibility"] ?? 0;
    $menu->description = $data["description"];
    $menu->user_id = Auth()->user()->id;
    $menu->save();
    return $menu->id;
  }

  public static function save_permission($menu_id, $role_id = 1)
  {
    UserPermission::updateOrCreate(
        ['menu_id' => $menu_id, 'role_id' => $role_id],
        [
          'is_permission' => 1,
          'user_id' => Auth::id(),
        ]
      );
    return true;
  }


  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function ParentMenu()
  {
    return $this->hasOne(AdminMenu::class, 'id', 'parent_id');
  }

  public function permission()
  {
    return $this->hasOne(UserPermission::class, 'menu_id', 'id');
  }


  public static function make_resource_menu_array($resourceName, $parent_id = 0, $descriptoin = "")
  {
    $rdata = explode("-", $resourceName);
    $rvariable = implode("_", $rdata);
    $array = [
      [
        "active" => 1,
        "name" => "All {$resourceName}",
        "icon" => "fa-list",
        "route_uri" => "admin/{$resourceName}",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 1,
        "description" => "Data Tables! " . $descriptoin,
      ],
      [
        "active" => 1,
        "name" => "Save {$resourceName}",
        "icon" => "",
        "route_uri" => "admin/{$resourceName}",
        "route_method" => "POST",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Store! " . $descriptoin,
      ],
      [
        "active" => 1,
        "name" => "Add {$resourceName}",
        "icon" => "fa-pencil-square-o",
        "route_uri" => "admin/{$resourceName}/create",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 1,
        "description" => "Create! " . $descriptoin,
      ],
      [
        "active" => 1,
        "name" => "Update {$resourceName}",
        "icon" => "",
        "route_uri" => "admin/{$resourceName}/" . "{" . $rvariable . "}",
        "route_method" => "PUT",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Update! " . $descriptoin,
      ],
      [
        "active" => 1,
        "name" => "Show {$resourceName}",
        "icon" => "",
        "route_uri" => "admin/{$resourceName}/" . "{" . $rvariable . "}",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Show! " . $descriptoin,
      ],
      [
        "active" => 1,
        "name" => "Destroy {$resourceName}",
        "icon" => "",
        "route_uri" => "admin/{$resourceName}/" . "{" . $rvariable . "}",
        "route_method" => "DELETE",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Destroy! " . $descriptoin,
      ],
      [
        "active" => 1,
        "name" => "Edit {$resourceName}",
        "icon" => "",
        "route_uri" => "admin/{$resourceName}/" . "{" . $rvariable . "}/edit",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Edit! " . $descriptoin,
      ],
    ];
    return $array;
  }
}
