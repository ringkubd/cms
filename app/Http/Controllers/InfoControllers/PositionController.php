<?php

namespace App\Http\Controllers\InfoControllers;

use App\Models\InfoModel\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.position";
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $positions = Position::with("user")->where("is_delete", 0)->orderby('id', 'desc')->paginate(15);
    return view($this->path . ".show-position", compact('positions'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view($this->path . ".create-position");
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
      'active' => 'numeric|nullable|max:1',
      'position_name' => 'required|string|max:191|unique:positions',
      'description' => 'nullable|string|max:400',
    ]);

    $position = new Position();
    $position->active = $request->active ?? 0;
    $position->position_name = $request->position_name;
    $position->description = $request->description;
    $position->user_id = auth()->user()->id;
    $position->save();

    return back()->with("success", "Position Register successfully");
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
    $position = Position::find($id);
    return view($this->path . ".edit-position", compact('position'));
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
      'active' => 'numeric|nullable|max:1',
      'position_name' => 'required|string|max:191|unique:positions,position_name,' . $id,
      'description' => 'nullable|string|max:400',
    ]);

    $position = Position::find($id);
    $position->active = $request->active ?? 0;
    $position->position_name = $request->position_name;
    $position->description = $request->description;
    $position->user_id = auth()->user()->id;
    $position->save();

    return back()->with("success", "Position Updated successfully");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $position = Position::find($id);
    $position->is_delete = 1;
    $position->save();
    return back()->with("success", "Position Deleted Successfully");
  }
}
