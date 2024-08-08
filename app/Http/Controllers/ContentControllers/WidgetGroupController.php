<?php

namespace App\Http\Controllers\ContentControllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContentModels\WidgetGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WidgetGroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $WiGroups = WidgetGroup::where('is_delete', 0)->orderByDesc("created_at")->paginate(10);
    return view('admin.pages.widget-group.show-widget-group', compact('WiGroups'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    return view('admin.pages.widget-group.create-widget-group');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function store(Request $request)
  {
    $data = $this->validate($request, [
      'active' => 'nullable|numeric|max:1',
      'name' => 'required|string|max:255|unique:widget_groups',
      'description' => 'nullable|string|max:1200',
    ]);
    $data['slug'] = Str::slug($request->input('name'), '-');
    $data['user_id'] = Auth::id();

    WidgetGroup::create($data);

    return redirect('admin/widget-group')->with('success', 'saved successfully');
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
    $WiGroup = WidgetGroup::where('is_delete', 0)->find($id);
    return view('admin.pages.widget-group.edit-widget-group', compact('WiGroup'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return RedirectResponse|\Illuminate\Routing\Redirector
   */
  public function update(Request $request, $id)
  {
    $data = $this->validate($request, [
      'active' => 'nullable|numeric|max:1',
      'name' => 'required|string|max:255|unique:widget_groups,name,' . $id,
      'description' => 'nullable|string|max:1200',
    ]);
    $data['active'] = $request->input('active') == 1 ? 1 : 0;
    $data['slug'] = Str::slug($request->input('name'), '-');
    $data['user_id'] = Auth::id();

    WidgetGroup::find($id)->update($data);

    return redirect('admin/widget-group')->with('success', 'Updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse
   */
  public function destroy($id)
  {
    WidgetGroup::find($id)->update([
      'is_delete' => 1
    ]);
    return back()->with('success', 'Delete successfully');
  }
}
