<?php

namespace App\Http\Controllers\ContentControllers;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Models\AccessModels\AdminMenu;
use App\Models\AccessModels\UserPermission;
use App\Models\ContentModels\Module;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ModuleController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.module";
  }

  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $modules = Module::where('is_delete', 0)->paginate(10);
    return view("$this->path.show-module", compact("modules"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    return view("$this->path.create-module");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse|Redirector
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'name' => 'required|string|max:191',
      'slug' => 'required|string|max:191|unique:modules,slug',
      'start_form' => 'string|nullable|max:55',
      'description' => 'string|nullable|max:1800',
      'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048',
    ]);

    if ($request->hasFile("picture")) {
      $imgName = Str::slug(Str::limit($request->input('name'), 60)) . "-" . date("m-Y");
      $pictures = Admin::store_image($request->file('picture'), "modules", $imgName);
      $picture = $pictures['original'];
    } else {
      $picture = null;
    }
    $module_id = Module::save_module($request->all(), $picture);
    $data = [
      "active" => 1,
      "name" => $request->input('name'),
      "icon" => "fa-pencil-square-o",
      "route_uri" => "#",
      "route_method" => "GET",
      "parent_id" => 0,
      "visibility" => 1,
      "description" => "This is the parent menu of ",
    ];
    $menu_id = AdminMenu::save_menu($data);
    $save_permission = AdminMenu::save_permission($menu_id);
    $moduleName = $request->input('name');
    $routeName = Module::control_route_controller_model($request->input('slug'));
    $menus = Module::module_menus($routeName, $menu_id);
    $menugroup[] = $menu_id;
    foreach ($menus as $key => $value) {
      $data = [
        "active" => $menus[$key]["active"],
        "name" => $menus[$key]["name"],
        "icon" => $menus[$key]["icon"],
        "route_uri" => $menus[$key]["route_uri"],
        "route_method" => $menus[$key]["route_method"],
        "parent_id" => $menu_id,
        "visibility" => $menus[$key]["visibility"],
        "description" => $menus[$key]["description"],
      ];
      $newMenu_id = AdminMenu::save_menu($data);
      $save_permission = AdminMenu::save_permission($newMenu_id);
      $menugroup[] = $newMenu_id;
    }
    $module = Module::find($module_id);
    $module->menugroup = implode(",", $menugroup);
    $module->save();

    //clear reset
    Admin::admin_menu_cache_reset();

    return redirect("admin/module")->with('success', 'Module created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return void
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Factory|View
   */
  public function edit($id)
  {
    $module = Module::find($id);
    return view("$this->path.edit-module", compact("module"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return RedirectResponse|Redirector
   * @throws ValidationException
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'name' => 'required|string|max:191',
      'slug' => 'required|string|max:191|unique:modules,slug,' . $id,
      'start_form' => 'string|nullable|max:55',
      'description' => 'string|nullable|max:1800',
      'picture' => 'string|nullable|max:255',
      'newPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048',
    ]);
    if ($request->hasFile("newPicture")) {
      $imgName = Str::slug(Str::limit($request->name, 60)) . "-" . date("m-Y");
      $pictures = Admin::store_image($request->newPicture, "modules", $imgName);
      $picture = $pictures['original'];
    } else {
      $picture = $request->picture;
    }
    $module_id = Module::save_module($request->all(), $picture, $id);

    return redirect("admin/module")->with('success', 'Module Updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse|Redirector
   */
  public function destroy($id)
  {
    $module = Module::find($id);
    AdminMenu::whereIn("id", explode(',', $module->menuGroup))->delete();
    UserPermission::whereIn("menu_id", explode(',', $module->menuGroup))->delete();
    //    $ulinkFile = Module::unlink_module_file($module->slug);
    $module = Module::destroy($id);

    //clear reset
    Admin::admin_menu_cache_reset();
    return redirect("admin/module")->with('success', 'Module Deleted successfully');
  }
}
