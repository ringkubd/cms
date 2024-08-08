<?php

namespace App\Http\Controllers\InfoControllers;

use App\Http\Controllers\Controller;
use App\Models\ContentModels\Module;
use App\Models\InfoModel\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $path;

    public function __construct()
    {
        $this->path = "admin.pages.subject";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Course::with("user", "module")->where("is_delete", 0)->orderby('id', 'desc')->paginate(15);
        return view($this->path.".show-subject",compact('subjects'));
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
        return view($this->path . ".create-subject", compact("modules"));
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
            'module_id' => 'required|numeric|max:99',
            'subjectName' => 'required|string|max:155',
            'description' => 'nullable|string|max:400',
        ]);
        $subject = new Course();
        $subject->active = $request->active ?? 0;
        $subject->subject_name = $request->subjectName;
        $subject->description = $request->description;
        $subject->module_id = $request->module_id;
        $subject->user_id = auth()->user()->id;
        $subject->save();

        return back()->with("success", "Subject Register successfully");
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
        $modules = Module::where("active", 1)
        ->where("is_delete", 0)
        ->get();
        $subject = Course::find($id);
        return view($this->path.".edit-subject",compact('subject', 'modules'));
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
            'module_id' => 'required|numeric|max:99',
            'subjectName' => 'required|string|max:155',
            'description' => 'nullable|string|max:400',
        ]);
        $subject = Course::find($id);
        $subject->active = $request->active ?? 0;
        $subject->subject_name = $request->subjectName;
        $subject->description = $request->description;
        $subject->module_id = $request->module_id;
        $subject->user_id = auth()->user()->id;
        $subject->save();

        return back()->with("success", "Subject Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Course::find($id);
        $subject->is_delete = 1;
        $subject->save();
        return back()->with("success", "Subject Deleted Successfully");
    }
}
