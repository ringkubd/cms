<?php

namespace App\Models\ContentModels;

use App\Admin;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Module extends Model
{
  protected $table = 'modules';

  public $primaryKey = 'id';

  public $timestamps = true;

  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public static function save_module($data, $picture = null, $id = null)
  {
    $module = new Module;
    if ($id) {
      $module = Module::find($id);
    }
    $module->active = $data["active"] ?? 0;
    $module->name = $data["name"];
    $module->slug = $data["slug"];
    if ($picture) {
      $module->picture = $picture;
    }
    $module->start_form = Carbon::parse($data["start_form"])->format("Y-m-d");
    $module->description = $data["description"];
    $module->user_id = auth()->user()->id;
    $module->save();
    return $module->id;
  }

  public static function control_route_controller_model($routeName)
  {
    $routeName = slug_url($routeName);
    $routeArray = explode("-", $routeName);
    $routeVariable = implode(" ", $routeArray);
    $ucwords = ucwords($routeVariable);
    $UcName = str_replace(" ", "", $ucwords);

    $routes = base_path("routes/web.php");
    if (file_exists($routes)) {
      $search = "//==newroute==";
      $route = $routeName;
      $controller = "PostController";
      $replace = "Route::resource('" . $route . "', '" . $controller . "'); \r\n //==newroute==";
      file_put_contents($routes, str_replace($search, $replace, file_get_contents($routes)));
      Artisan::call("route:clear");
    }
    return $routeName;
  }

  public static function unlink_module_file($routeName)
  {
    $routeName = slug_url($routeName);
    $routeArray = explode("-", $routeName);
    $routeVariable = implode(" ", $routeArray);
    $ucwords = ucwords($routeVariable);
    $UcName = str_replace(" ", "", $ucwords);
    $routes = base_path("routes/web.php");
    if (file_exists($routes)) {
      $file = base_path("routes/web.php");
      $route = $routeName;
      $controller = "ModuleControllers\\" . $UcName . "Controller";
      $search = "Route::resource('" . $route . "', '" . $controller . "');";
      $raplace = "//==remove==";
      file_put_contents($file, str_replace($search, $raplace, file_get_contents($file)));
      Artisan::call("route:clear");
    }
    $controller = base_path("app/Http/Controllers/ModuleControllers/{$UcName}Controller.php");
    $model = base_path("app/Models/ModuleModels/{$UcName}.php");
    if (file_exists($controller)) {
      unlink($controller);
    }
    if (file_exists($model)) {
      unlink($model);
    }
    return true;
  }

  public static function module_menus($name, $parent_id)
  {
    $rdata = explode("-", $name);
    $variable = implode("_", $rdata);
    $array = [
      [
        "active" => 1,
        "name" => "All {$name}",
        "icon" => "fa-list",
        "route_uri" => "admin/type/" . $name,
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 1,
        "description" => "Data Tables! " . $name,
      ],
      [
        "active" => 1,
        "name" => "Save {$name}",
        "icon" => "",
        "route_uri" => "admin/type/" . $name,
        "route_method" => "POST",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Store! " . $name,
      ],
      [
        "active" => 1,
        "name" => "Add {$name}",
        "icon" => "fa-pencil-square-o",
        "route_uri" => "admin/type/" . $name . "/create",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 1,
        "description" => "Create! " . $name,
      ],
      [
        "active" => 1,
        "name" => "Update {$name}",
        "icon" => "",
        "route_uri" => "admin/type/" . $name . "/{" . $variable . "}",
        "route_method" => "PUT",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Update! " . $name,
      ],
      [
        "active" => 1,
        "name" => "Show {$name}",
        "icon" => "",
        "route_uri" => "admin/type/" . $name . "/{" . $variable . "}",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Show! " . $name,
      ],
      [
        "active" => 1,
        "name" => "Destroy {$name}",
        "icon" => "",
        "route_uri" => "admin/type/" . $name . "/{" . $variable . "}",
        "route_method" => "DELETE",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Destroy! " . $name,
      ],
      [
        "active" => 1,
        "name" => "Edit {$name}",
        "icon" => "",
        "route_uri" => "admin/type/" . $name . "/{" . $variable . "}/edit",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Edit! " . $name,
      ],
    ];
    return $array;
  }
}
