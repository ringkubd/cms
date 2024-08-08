<?php

namespace App\Http\Controllers\ContentControllers;

use App\Admin;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccessModels\AdminMenu;
use App\Models\AccessModels\UserPermission;

use App\Models\ContentModels\TermTaxonomy;
use App\Models\ContentModels\Module;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TermTaxonomyController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.term-taxonomies";
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $termTaxonomies = TermTaxonomy::with(["user", "module"])->where("is_delete", 0)->paginate(10);
    return view("$this->path.show-taxonomies", compact("termTaxonomies"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    $modules = Module::where("is_delete", 0)->where("active", 1)->get();
    return view("$this->path.create-taxonomies", compact("modules"));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'name' => 'required|string|max:55',
      'slug' => 'required|string|max:55|unique:term_taxonomies,slug',
      'module_id' => 'numeric|string|max:20',
      'description' => 'string|nullable|max:400',
    ]);

    $insert_id = TermTaxonomy::save_term($request->all());
    $name = $request->name;
    $slug = $request->slug;
    $module_id = $request->module_id;

    if ($request->module_id == 0) {
      $menuParent = 0;
      $module = null;
    } else {
      $module = Module::find($module_id);
      $menuParent = explode(",", $module->menugroup);
      $menuParent = $menuParent[0];
      $module = $module->slug;
    }
    $routeName = TermTaxonomy::control_term_route($slug, $module);
    $menus = TermTaxonomy::set_taxonomy_menus($routeName, $slug, $module, $menuParent);

    $menugroup = [];
    foreach ($menus as $key => $value) {
      $data = [
        "active" => $menus[$key]['active'],
        "name" => $menus[$key]['name'],
        "icon" => $menus[$key]['icon'],
        "route_uri" => $menus[$key]['route_uri'],
        "route_method" => $menus[$key]['route_method'],
        "parent_id" => $menus[$key]['parent_id'],
        "visibility" => $menus[$key]['visibility'],
        "description" => $menus[$key]['description'],
      ];
      $newMenu_id = AdminMenu::save_menu($data);
      $save_permission = AdminMenu::save_permission($newMenu_id);
      $menugroup[] = $newMenu_id;
    }

    $taxonomy = TermTaxonomy::find($insert_id);
    $taxonomy->menugroup = implode(",", $menugroup);
    $taxonomy->save();

    //clear reset
    Admin::admin_menu_cache_reset();

    return back()->with('success', 'Taxonomy Created successfully');
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
    $termTaxonomies = TermTaxonomy::with(["module"])->find($id);
    $modules = Module::where("is_delete", 0)->where("active", 1)->get();
    return view("$this->path.edit-taxonomies", compact("termTaxonomies", "modules"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'name' => 'required|string|max:55',
      'slug' => 'required|string|max:55|unique:term_taxonomies,slug,' . $id,
      'module_id' => 'numeric|string|max:20',
      'description' => 'string|nullable|max:400',
    ]);

    $insert_id = TermTaxonomy::save_term($request->all(), $id);

    return back()->with('success', 'Taxonomy Updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse
   */
  public function destroy($id)
  {
    $term = TermTaxonomy::find($id);

    AdminMenu::whereIn("id", explode(',', $term->menugroup))->update([
      'is_delete' => 1,
    ]);
    UserPermission::whereIn("menu_id", explode(',', $term->menugroup))->update([
      'is_permission' => 0,
    ]);

    $module_slug = Module::find($term->module_id);
    if (!empty($module_slug)) {
      $module_slug = $module_slug->slug;
    }

    TermTaxonomy::destroy_term_route($term->slug, $module_slug);
    $term->delete();
    Admin::admin_menu_cache_reset();

    return back()->with('success', 'Term Taxonomy Deleted successfully');
  }
}
