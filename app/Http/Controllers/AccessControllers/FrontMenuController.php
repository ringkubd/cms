<?php

namespace App\Http\Controllers\AccessControllers;

use App\Home;
use App\Models\ContentModels\Taxonomy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\AccessModels\FrontMenu;
use App\Models\AccessModels\MenuGroup;
use App\Models\ContentModels\Module;

class FrontMenuController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.front-menus";
  }

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index()
  {
    $pages = Home::get_pages(false, 25);
    $posts = Home::get_posts(false, 25);
    $modules = Module::where("is_delete", 0)->where("active", 1)->get();
    $groups = MenuGroup::where("is_delete", 0)->get();
    $taxonomies = Taxonomy::where("is_delete", 0)->where("active", 1)->get();
    $parents = FrontMenu::orderBy("parent_id")->get();
    return view("$this->path.show-menu", compact('parents', 'modules', 'groups', 'taxonomies', 'pages', 'posts'));
  }

  public function add_to_front_menu(Request $request)
  {
    $pages = Home::get_pages(true, 0);
    $posts = Home::get_posts(true, 0);

    $menus = $request->dataKey;

    $parent_id = $request->parent_id;
    $group_id = $request->group_id;

    FrontMenu::where("parent_id", $parent_id)->where("group_id", $group_id)->update(["active" => 0]);

    if (!empty($menus)) {
      $menu_id = 0;
      foreach ($menus as $key => $menu) {
        $data = [
          "menu_id" => $menus[$key]['menu_id'],
          "name" => $menus[$key]['name'],
          "url" => $menus[$key]['url'],
          "order" => $key,
          "menu_class" => $menus[$key]['menu_class'],
          "menu_title" => $menus[$key]['menu_title'],
          "menu_window" => $menus[$key]['menu_window'],
          "menu_icon" => $menus[$key]['menu_icon'],
          "menu_type" => $menus[$key]['menu_type'],
          "parent_id" => $parent_id,
          "group_id" => $group_id,
        ];
        $menu_id = FrontMenu::save_front_menu_ajax_data($data);
      }
      if ($menu_id > 0) {
        return "Menu data saved successfully !";
      }
    }
    return "Menu data not saved !";
  }


  public function get_active_front_menu(Request $request)
  {
    $pages = Home::get_pages(true, 0);
    $posts = Home::get_posts(true, 0);

    $group_id = $request->group_id;
    $parent_id = $request->parent_id;

    Cache::put('group_id', $group_id, 60);
    Cache::put('parent_id', $parent_id, 60);

    $menus = FrontMenu::where("group_id", $group_id)
      ->where("active", 1)
      ->where("parent_id", $parent_id)
      ->orderby('order')
      ->get();
    return view("$this->path.ajax-load-menu-data", compact('menus'));
  }
}
