<?php

namespace App\Http\Controllers\AccessControllers;

use App\Admin;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\AccessModels\AdminMenu;
use App\Models\AccessModels\Role;
use App\Models\AccessModels\UserPermission;
use Illuminate\View\View;

class SetupAccessController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $mainmenus = AdminMenu::where('is_delete', 0)
      ->where('parent_id', 0)
      ->where('active', 1)
      ->where('visibility', 1)
      ->where('method', 'get')
      ->orderByDesc('order')
      ->get();
    return view('admin.pages.access-control.alignment-access', compact('mainmenus'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    $roles = Role::where('is_delete', 0)->where('active', 1)->get();
    $mainmenus = AdminMenu::where('is_delete', 0)
      ->where('parent_id', 0)
      ->where('active', 1)
      ->get();
    return view('admin.pages.access-control.create-access', compact('mainmenus', 'roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return string
   */
  public function store(Request $request)
  {
    $active = $request->input('active');
    $menuId = $request->input('menuId');
    $roleId = $request->input('roleId');

    UserPermission::updateOrCreate(
      ['menu_id' => $menuId, 'role_id' => $roleId],
      [
        'is_permission' => $active == 1 ? 1 : 0,
        'user_id' => Auth::id()
      ]
    );

    Admin::admin_menu_cache_reset();

    return 'Permission Updated';
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   */
  public function save_alignment(Request $request)
  {
    $menu1 = $request->menu1;
    $menu2 = $request->menu2;
    $menu3 = $request->menu3;
    $menu4 = $request->menu4;


    if (!empty($menu1)) {
      $menu1Parent = $request->menu1Parent;
      foreach ($menu1 as $key => $id) {
        $menu = AdminMenu::find($id);
        $menu->order = $key;
        $menu->save();
      }
    }

    if (!empty($menu2)) {
      $menu2Parent = $request->menu2Parent;
      foreach ($menu2 as $key => $id) {
        $menu = AdminMenu::find($id);
        $menu->order = $key;
        $menu->save();
      }
    }

    if (!empty($menu3)) {
      $menu3Parent = $request->menu3Parent;
      foreach ($menu3 as $key => $id) {
        $menu = AdminMenu::find($id);
        $menu->order = $key;
        $menu->save();
      }
    }

    if (!empty($menu4)) {
      $menu4Parent = $request->menu4Parent;
      foreach ($menu4 as $key => $id) {
        $menu = AdminMenu::find($id);
        $menu->order = $key;
        $menu->save();
      }
    }

    //clear reset
    Admin::admin_menu_cache_reset();

    return back()->with('success', 'Alignment save successfully');
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
    //
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
    // update
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }


  /**
   * find the admin menu by ajax find
   */
  public function find_menu_by_ajax(Request $request)
  {
    $this->validate($request, [
      'menuId' => 'numeric|nullable|max:999',
      'roleId' => 'numeric|max:99',
    ]);
    $menuId = $request->input('menuId');
    $roleId = $request->input('roleId');
    $menus = AdminMenu::with(['permission' => function ($q) use ($roleId) {
      $q->where('role_id', $roleId);
    }])
      ->where('is_delete', 0)
      ->where('parent_id', $menuId)
      ->where('active', 1)
      ->orderBy('order', 'ASC')
      ->get();

    return view('admin.pages.access-control.ajax-load-data-table', compact('menus'));
  }

  /**
   * find the admin menu by ajax find
   */
  public function find_alignment_ajax(Request $request)
  {
    $this->validate($request, [
      'menuId' => 'numeric|nullable|max:999',
      'menuDepth' => 'string|required|max:55',
    ]);

    $menuId = $request->menuId;
    $menuDepth = $request->menuDepth;

    $menus = AdminMenu::where('is_delete', 0)
      ->where('parent_id', $menuId)
      ->where('active', 1)
      ->where('visibility', 1)
      ->where('method', 'get')
      ->orderBy('order', 'ASC')
      ->get();

    // return dump($menus);

    return view('admin.pages.access-control.ajax-load-alignment-data-table', compact('menus', 'menuDepth'));
  }
}
