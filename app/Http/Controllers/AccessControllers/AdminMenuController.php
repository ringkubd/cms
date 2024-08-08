<?php

namespace App\Http\Controllers\AccessControllers;

use App\Admin;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessModels\AdminMenu;
use App\Models\AccessModels\UserPermission;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminMenuController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.admin-menus";
  }

  public function index()
  {
    $search = request('search');
    $menus = AdminMenu::with(['user', 'ParentMenu'])
      ->where('is_delete', 0)
      ->orderByDesc('id');
    $menus = $search ? $menus->where('name', 'like', "%$search%") : $menus; // filter serach
    $menus = $menus->paginate(10);

    if (\request()->ajax()) {
      return view('admin.pages.admin-menus.admin-menu-table', compact('menus'));
    }

    return view('admin.pages.admin-menus.show-menu', compact('menus'));
  }

  public function get_admin_menu()
  {
    $menus = AdminMenu::with(['user', 'ParentMenu'])->where('is_delete', 0)->orderby('id', 'desc')->get();
    return response()->json(['data' => $menus]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    $parents = AdminMenu::where('method', 'get')->where('is_delete', 0)->get();
    return view("$this->path.create-menu", compact('parents'));
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
    Cache::put("menu_tab", "routeMenu", 150);
    $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'visibility' => 'numeric|nullable|max:1',
      'name' => 'required|string|max:155',
      'icon' => 'nullable|string|max:255',
      'route_uri' => 'required|string|max:255',
      'route_method' => 'required|string|max:999',
      'parent_id' => 'nullable|numeric|max:999',
      'description' => 'string|nullable|max:400',
    ]);

    $menu = AdminMenu::where('route_uri', $request->input('route_uri'))->where('method', $request->input('rmethod'))->first();
    if (!empty($menu) && $request->input('route_uri') !== "#") {
      return back()->with("error", "Menu Created before");
    }

    $menu_id = AdminMenu::save_menu($request->all());
    $save_permission = AdminMenu::save_permission($menu_id);

    Cache::forget("menu_tab");
    Admin::admin_menu_cache_reset();

    return redirect("admin/admin-menu")->with("success", "Admin single menu created successfully");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse|Redirector
   * @throws ValidationException
   */
  public function resourceStore(Request $request)
  {
    Cache::put("menu_tab", "resourceMenu", 150);
    $this->validate($request, [
      'name' => 'required|string|max:155',
      'icon' => 'nullable|string|max:155',
      'group' => 'nullable|string|max:155',
      'parent_id' => 'nullable|numeric|max:999',
      'description' => 'nullable|string|max:400',
    ]);

    $descriptoin = $request->descriptoin;
    $group = $request->group;
    $name = $request->name;
    $parentMenu = AdminMenu::where("name", $name)->where("route_uri", "#")->where("method", "GET")->first();
    if (!empty($parentMenu)) {
      return back()->with("error", "Resource menu created before!");
    }
    $parent = [
      "active" => 1,
      "name" => $name,
      "icon" => $request->icon,
      "route_uri" => "#",
      "route_method" => "GET",
      "parent_id" => $request->parent_id,
      "visibility" => 1,
      "description" => "Parent Menu! {$descriptoin}",
    ];
    $insertId = AdminMenu::save_menu($parent);
    $save_permission = AdminMenu::save_permission($insertId);
    $parent_id = $insertId ?? $request->resourceParent;

    $resource = AdminMenu::make_resource_menu_array($group, $parent_id, $descriptoin);
    foreach ($resource as $key => $value) {
      $route_uri = $resource[$key]["route_uri"];
      $method = $resource[$key]["route_method"];
      $menu = AdminMenu::where("route_uri", $route_uri)->where("method", $method)->first();
      if (empty($menu)) {
        $parent = [
          "active" => $resource[$key]["active"],
          "name" => $resource[$key]["name"],
          "icon" => $resource[$key]["icon"],
          "route_uri" => $resource[$key]["route_uri"],
          "route_method" => $resource[$key]["route_method"],
          "parent_id" => $resource[$key]["parent_id"],
          "visibility" => $resource[$key]["visibility"],
          "description" => $resource[$key]["description"],
        ];
        $insertId = AdminMenu::save_menu($parent);
        $save_permission = AdminMenu::save_permission($insertId);
      }
    }
    Cache::forget("menu_tab");
    Admin::admin_menu_cache_reset();

    return redirect("admin/admin-menu")->with("success", "Admin Resource menu created successfully");
  }


  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function edit($id)
  {
    $menu = AdminMenu::find($id);
    $parents = AdminMenu::where('is_delete', 0)->where('method', 'get')->get();
    return view("$this->path.edit-menu", compact('menu', 'parents'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function clone($id)
  {
    $menu = AdminMenu::find($id);
    $parents = AdminMenu::where('is_delete', 0)->where('method', 'GET')->get();
    return view("$this->path.clone-menu", compact('menu', 'parents'));
  }


  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'visibility' => 'numeric|nullable|max:1',
      'name' => 'required|string|max:155',
      'icon' => 'nullable|string|max:255',
      'route_uri' => 'required|string|max:255',
      'route_method' => 'required|string|max:999',
      'parent_id' => 'nullable|numeric|max:999',
      'description' => 'string|nullable|max:400',
    ]);

    $menu = AdminMenu::where("id", "!=", $id)
      ->where("route_uri", $request->route_uri)
      ->where("method", $request->rmethod)
      ->first();
    if (!empty($menu) && $request->route_uri !== "#") {
      return back()->with("error", "Request menu already exists");
    }

    $menu_id = AdminMenu::save_menu($request->all(), $id);
    Admin::admin_menu_cache_reset();

    return redirect("admin/admin-menu")->with("success", "Admin menu updated successfully");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse
   */
  public function destroy($id)
  {
    $menu = AdminMenu::find($id);
    $menu->is_delete = 1;
    $menu->save();

    // cache reset
    Admin::admin_menu_cache_reset();

    return back()->with('success', 'Menu Deleted successfully');
  }
}
