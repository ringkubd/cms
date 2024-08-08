<?php

namespace App\Models\ContentModels;

use App\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class TermTaxonomy extends Model
{
  // Table Name
  protected $table = 'term_taxonomies';

  // Primary Key
  public $primaryKey = 'id';

  // Timestamps
  public $timestamps = true;

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function module()
  {
    return $this->belongsTo('App\Models\ContentModels\Module');
  }

  public static function save_term($data, $id = 0)
  {
    $term = new TermTaxonomy();
    if ($id) {
      $term = TermTaxonomy::find($id);
    }
    $term->active = $data["active"];
    $term->name = $data["name"];
    $term->slug = $data["slug"];
    $term->module_id = $data["module_id"] ?? 0;
    $term->description = $data["description"];
    $term->user_id = auth()->user()->id;
    $term->save();
    return $term->id;
  }

  public static function control_term_route($slug, $module)
  {
    $route = slug_url($slug);
    $termVariable = str_replace("-", "_", $slug);
    $routes = base_path("routes/web.php");

    if (file_exists($routes)) {
      $search = "//==newTaxonomuRoute==";
      $createController = "ContentControllers\\TaxonomyController@create";
      $editController = "ContentControllers\\TaxonomyController@edit";
      $raplace = "Route::get('" . $route . "/create', '" . $createController . "'); \r\n";
      $raplace2 = "Route::get('" . $route . "/{" . $termVariable . "}/edit', '" . $editController . "'); \r\n //==newTaxonomuRoute==";
      $replace = $raplace . $raplace2;
      if ($module) {
        $raplace = "Route::get('" . $module . '/' . $route . "/create', '" . $createController . "'); \r\n";
        $raplace2 = "Route::get('" . $module . '/' . $route . '/{' . $termVariable . "}/edit', '" . $editController . "'); \r\n //==newTaxonomuRoute==";
        $replace = $raplace . $raplace2;
      }
      file_put_contents($routes, str_replace($search, $replace, file_get_contents($routes)));
      Artisan::call("route:clear");
    }
    return $route;
  }

  public static function destroy_term_route($slug, $module_slug = null)
  {
    $termVariable = str_replace("-", "_", $slug);
    $routes = base_path("routes/web.php");
    $replace = "//==removeTaxonomy";
    if (file_exists($routes)) {
      if ($module_slug) {
        $search = "Route::get('" . $module_slug . '/' . $slug . "/create', 'ContentControllers\TaxonomyController@create');";
        file_put_contents($routes, str_replace($search, $replace, file_get_contents($routes)));
        $search = "Route::get('" . $module_slug . '/' . $slug . '/{' . $termVariable . "}/edit', 'ContentControllers\TaxonomyController@edit');";
        file_put_contents($routes, str_replace($search, $replace, file_get_contents($routes)));
      } else {
        $search = "Route::get('" . $slug . "/create', 'ContentControllers\TaxonomyController@create');";
        file_put_contents($routes, str_replace($search, $replace, file_get_contents($routes)));
        $search = "Route::get('" . $slug . "/{" . $termVariable . "}/edit', 'ContentControllers\TaxonomyController@edit'); ";
        file_put_contents($routes, str_replace($search, $replace, file_get_contents($routes)));
      }
      Artisan::call("route:clear");
    }
    return true;
  }

  public static function set_taxonomy_menus($termName, $termSlug, $module, $parent_id)
  {
    if ($module) {
      $module = $module . "/";
    }
    $termVariable = str_replace("-", "_", $termSlug);
    $array = [
      [
        "active" => 1,
        "name" => $termName,
        "icon" => "fa-list-alt",
        "route_uri" => "admin/term/" . $module . $termSlug . "/create",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 1,
        "description" => "Create!" . $termName,
      ],
      [
        "active" => 1,
        "name" => "Edit " . $termName,
        "icon" => "",
        "route_uri" => "admin/term/" . $module . $termSlug . "/{" . $termVariable . "}/edit",
        "route_method" => "GET",
        "parent_id" => $parent_id,
        "visibility" => 0,
        "description" => "Edit ! taxonomy " . $termName,
      ]
    ];
    return $array;
  }
}
