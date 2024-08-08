<?php

namespace App\Http\Controllers\InfoControllers;

use App\Models\ContentModels\Module;
use App\Models\InfoModel\Round;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoundController extends Controller
{
    protected $path;

    public function __construct()
    {
        $this->path = "admin.pages.round";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rounds = Round::with("module", "user")
            ->where("is_delete", 0)
            ->orderBy("id", "desc")
            ->paginate(15);
        return view($this->path.".show-round",compact('rounds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::where("active", 1)
            ->where("is_delete", 0)
            ->get();
        return view($this->path.".create-round",compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'active' => 'numeric|nullable|max:1',
            'roundName' => 'required|string|max:155',
            'module_id' => 'required|nullable|max:99',
            'start_date' => 'nullable|string|max:191',
            'end_date' => 'nullable|string|max:191',
            'description' => 'nullable|string|max:400',
        ]);

        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $round = new Round();
        $round->active = $request->active ?? 0;
        $round->name = $request->roundName;
        $round->description = $request->description;
        $round->start_time = $start_date;
        $round->end_time = $end_date;
        $round->module_id = $request->module_id;
        $round->user_id = auth()->user()->id;
        $round->save();
        $round_id = $round->id;

        return redirect("admin/round/{$round_id}/edit")->with("success", "Round save successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modules = Module::where("active", 1)->where("is_delete", 0)->get();
        $round = Round::find($id);
        return view($this->path.".edit-round",compact('modules', 'round'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'active' => 'numeric|nullable|max:1',
            'roundName' => 'required|string|max:155',
            'module_id' => 'required|nullable|max:99',
            'start_date' => 'nullable|string|max:191',
            'end_date' => 'nullable|string|max:191',
            'description' => 'nullable|string|max:400',
        ]);
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $round = Round::find($id);
        $round->active = $request->active ?? 0;
        $round->name = $request->roundName;
        $round->description = $request->description;
        $round->start_time = $start_date;
        $round->end_time = $end_date;
        $round->module_id = $request->module_id;
        $round->user_id = auth()->user()->id;
        $round->save();

        return back()->with("success", "Round Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $round = Round::find($id);
        $round->is_delete = 1;
        $round->save();
        return back()->with("success", "Round Deleted Successfully");
    }
}
