<?php

namespace App\Http\Controllers\AccessControllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessModels\MenuGroup;

class MenuGroupController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.menu-group";
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $groupMenus = MenuGroup::with('user')->where("is_delete", 0)->orderBy('id', "desc")->get();
    return view("$this->path.show-menu-group", compact('groupMenus'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view("$this->path.create-menu-group");
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'groupname' => 'required|string|max:155|unique:menu_groups,name',
      'mstyle' => 'required|string|max:155',
      'description' => 'string|nullable|max:400',
    ]);

    //id, name, slug_name, description, style, user_id, created_at, updated_at
    $menu = new MenuGroup();
    $menu->name = $request->input('groupname');
    $menu->slug_name = slug_url($request->input('groupname'));
    $menu->description = $request->input('description');
    $menu->style = $request->input('mstyle');
    $menu->user_id = Auth()->user()->id;
    $menu->save();

    return redirect("admin/group-menu")->with("success", "Front Menu Group created successfully");
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $groupMenu = MenuGroup::find($id);
    return view("$this->path.edit-menu-group", compact('groupMenu'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'groupname' => 'required|string|max:155|unique:menu_groups,name,' . $id,
      'mstyle' => 'required|string|max:155',
      'description' => 'string|nullable|max:400',
    ]);

    //id, name, slug_name, description, style, user_id, created_at, updated_at
    $menu = MenuGroup::find($id);
    $menu->name = $request->groupname;
    $menu->slug_name = slug_url($request->groupname);
    $menu->description = $request->description;
    $menu->style = $request->mstyle;
    $menu->user_id = Auth()->user()->id;
    $menu->save();

    return redirect("admin/group-menu")->with("success", "Front Menu Group Updated successfully");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $menu = MenuGroup::find($id);
    $menu->is_delete = 1;
    $menu->save();

    return redirect("admin/group-menu")->with("success", "Deleted Menu Group successfully");
  }
}
