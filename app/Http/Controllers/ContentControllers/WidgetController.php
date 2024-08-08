<?php

namespace App\Http\Controllers\ContentControllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContentModels\Widget;
use App\Models\ContentModels\WidgetGroup;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class WidgetController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $groups = WidgetGroup::where('is_delete', 0)->where('active', 1)->orderByDesc('created_at')->get();
    $widgets = Widget::where('is_delete', 0)->orderByDesc('created_at')->get();
    return view('admin.pages.widget.manage-widget', compact('groups', 'widgets'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return RedirectResponse|Redirector
   */
  public function create()
  {
    return redirect('admin/widget');
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
      'title' => 'required|string|max:255|unique:widgets',
      'description' => 'nullable|string|max:1200',
    ]);
    $data['slug'] = Str::slug($request->input('title'), '-');
    $data['user_id'] = Auth::id();

    Widget::create($data);

    return back()->with('success', 'saved successfully');
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
   * @return Response
   */
  public function edit($id)
  {
    $wiget = Widget::where('is_delete', 0)->find($id);
    $groups = WidgetGroup::where('is_delete', 0)->where('active', 1)->orderByDesc("created_at")->get();
    $wigets = Widget::where('is_delete', 0)->orderByDesc("created_at")->get();
    return view('admin.pages.widget.manage-widget', compact('groups', 'wigets', 'wiget'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Widget $Widget
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request, Widget $Widget)
  {
    $data = $this->validate($request, [
      'active' => 'nullable|numeric|max:1',
      'title' => 'required|string|max:255|unique:widgets,title,' . $Widget->id,
      'description' => 'nullable|string|max:1200',
    ]);
    $data['slug'] = Str::slug($request->input('title'), '-');
    $data['user_id'] = Auth::id();

    $Widget->update($data);

    return back()->with('success', 'saved successfully');
  }

  public function widget_set(Request $request)
  {
    $widget = $request->input('widget');
    $widGroup = $request->input('widGroup');

    $group = WidgetGroup::find($widGroup);
    $data = explode(',', $group->widget_collection);
    if (in_array($widget, $data)) {
      return back()->with('error', 'Already Added');
    }
    $data[] = $widget;
    $data = array_filter($data);

    $group->update([
      'widget_collection' => implode(',', $data),
    ]);

    return back()->with('success', 'Added successfully');
  }

  public function widget_get(Request $request)
  {
    $group_id = $request->input('group_id');
    $group = WidgetGroup::find($group_id);
    $widgets = Widget::whereIn('id', explode(',', $group->widget_collection))->get();
    return view('admin.pages.widget.group-widget', compact('widgets'));
  }

  public function widget_remove(Request $request)
  {
    $widID = $request->input('widID');
    $group = $request->input('group');
    $group = WidgetGroup::find($group);
    $data = explode(',', $group->widget_collection);
    if (in_array($widID, $data)) {
      $newWidget = array_diff($data, [$widID]);
      $group->update(['widget_collection' => implode(',', $newWidget)]);
      return redirect('admin/widget')->with('success', 'widget removed');
    }
    return redirect('admin/widget')->with('error', 'widget not removed');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse|Redirector
   */
  public function destroy($id)
  {
    Widget::find($id)->update([
      'is_delete' => 1
    ]);
    return redirect('admin/widget')->with('success', 'Moved to trashed');
  }
}
