<?php

namespace App\Http\Controllers\ContentControllers;

use App\Admin;
use App\Models\ContentModels\Module;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContentModels\Taxonomy;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TaxonomyController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    return view('admin.pages.taxonomies.create-taxonomies');
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
    $data = $this->validate($request, [
      'active' => 'nullable|numeric|max:1',
      'name' => 'required|string|max:255',
      'slug' => 'nullable|string|max:191|unique:taxonomies',
      'parent_id' => 'nullable|numeric|max:999',
      'description' => 'nullable|string|max:1200',
      'term' => 'required|string|max:191',
      'module' => 'nullable|string|max:191',
      'picture' => 'nullable|string|max:255',
    ]);
    $data['active'] = $request->has('active') ? 1 : 0;
    $data['slug'] = Str::slug($request->input('name'));
    $data['user_id'] = Auth::id();
    Taxonomy::create($data);
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
   * @param $id
   * @return Factory|View
   */
  public function edit($id)
  {
    $edit = true;
    $taxonomy = Taxonomy::where('is_delete', 0)->find($id);
    return view('admin.pages.taxonomies.create-taxonomies', compact('edit', 'taxonomy'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Taxonomy $taxonomy
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request, Taxonomy $taxonomy)
  {
    $data = $this->validate($request, [
      'active' => 'nullable|numeric|max:1',
      'name' => 'nullable|string|max:255',
      'slug' => 'nullable|string|max:191|unique:taxonomies,slug,' . $taxonomy->id,
      'parent_id' => 'nullable|numeric|max:999',
      'description' => 'nullable|string|max:1200',
      'term' => 'required|string|max:191',
      'module' => 'nullable|string|max:191',
      'picture' => 'nullable|string|max:255',
    ]);

    $data['active'] = $request->has('active') ? 1 : 0;
    $data['user_id'] = Auth::id();
    $taxonomy->update($data);
    return back()->with('success', $data['name'] . 'Updated successfully');

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Taxonomy $taxonomy
   * @return RedirectResponse
   */
  public function destroy(Taxonomy $taxonomy)
  {
    $taxonomy->update(['is_delete' => 1]);
    return back()->with('success', 'Trashed successfully');
  }
}
