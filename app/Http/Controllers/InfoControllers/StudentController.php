<?php

namespace App\Http\Controllers\InfoControllers;

use App\Http\Controllers\Controller;
use App\Models\ContentModels\Module;
use App\Models\InfoModel\Company;
use App\Models\InfoModel\Course;
use App\Models\InfoModel\Position;
use App\Models\InfoModel\Round;
use App\Models\InfoModel\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin.pages.student";
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $students = Student::with(["module", "round", "subject", "position", "company", "user"])
      ->where("active", 1)
      ->where("is_delete", 0)
      ->orderByDesc('id')
      ->paginate(20);
    return view($this->path . ".show-student", compact("students")
    );
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $modules = Module::where("active", 1)->where("is_delete", 0)->get();
    $rounds = Round::where("active", 1)->where("is_delete", 0)->get();
    $subjects = Course::where("active", 1)->where("is_delete", 0)->get();
    $positions = Position::where("active", 1)->where("is_delete", 0)->get();
    $companies = Company::where("active", 1)->where("is_delete", 0)->get();
    return view($this->path . ".create-student",
      compact("modules", "rounds", "subjects", "positions", "companies")
    );
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
      'studentName' => 'required|string|max:191',
      'fatherName' => 'nullable|string|max:191',
      'motherName' => 'nullable|string|max:191',
      'email' => 'nullable|email|unique:students|max:191',
      'phone' => 'nullable|string|unique:students|max:20',
      'address' => 'nullable|string|max:300',
      'module_id' => 'required|numeric|max:99',
      'round_id' => 'required|numeric|max:99',
      'course_id' => 'required|numeric|max:99',
      'position_id' => 'required|numeric|max:99',
      'company_id' => 'nullable|numeric|max:99',
      'profile_image' => 'nullable|string'
    ]);
    $student = new Student();
    $student->active = $request->active ?? 0;
    $student->name = $request->studentName;
    $student->father_name = $request->fatherName;
    $student->mother_name = $request->motherName;
    $student->address = $request->address;
    $student->email = $request->email;
    $student->phone = $request->phone;
    $student->module_id = $request->module_id;
    $student->round_id = $request->round_id;
    $student->subject_id = $request->course_id;
    $student->position_id = $request->position_id;
    $student->company_id = $request->company_id;
    $student->user_id = auth()->user()->id;
    
    $student->profile_link =  $request->profile_link;
    $student->expertise =  $request->expertise;
    $student->job_type =  $request->job_type;
    $student->is_success_stories =  $request->is_success_stories;
    $student->profile_image =  $request->profile_image;
    $student->save();

    return back()->with("success", "Student Register successfully");
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
    $student = Student::find($id);
    $modules = Module::where("active", 1)->where("is_delete", 0)->get();
    $rounds = Round::where("active", 1)->where("is_delete", 0)->get();
    $subjects = Course::where("active", 1)->where("is_delete", 0)->get();
    $positions = Position::where("active", 1)->where("is_delete", 0)->get();
    $companies = Company::where("active", 1)->where("is_delete", 0)->get();
    return view($this->path . ".edit-student",
      compact("student", "modules", "rounds", "subjects", "positions", "companies")
    );
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
      'studentName' => 'required|string|max:191',
      'fatherName' => 'nullable|string|max:191',
      'motherName' => 'nullable|string|max:191',
      // 'email' => 'required|email|max:191|unique:students,email,' . $id,
      // 'phone' => 'required|string|max:20|unique:students,phone,' . $id,
      'address' => 'nullable|string|max:300',
      'module_id' => 'required|numeric|max:99',
      'round_id' => 'required|numeric|max:99',
      'course_id' => 'required|numeric|max:99',
      'position_id' => 'required|numeric|max:99',
      'company_id' => 'nullable|numeric|max:99',
    ]);
    $student = Student::find($id);
    $student->active = $request->active ?? 0;
    $student->name = $request->studentName;
    $student->father_name = $request->fatherName;
    $student->mother_name = $request->motherName;
    $student->address = $request->address;
    $student->email = $request->email;
    $student->phone = $request->phone;
    $student->module_id = $request->module_id;
    $student->round_id = $request->round_id;
    $student->subject_id = $request->course_id;
    $student->position_id = $request->position_id;
    $student->company_id = $request->company_id;
    $student->user_id = auth()->user()->id;

    $student->profile_link =  $request->profile_link;
    $student->expertise =  $request->expertise;
    $student->job_type =  $request->job_type;
    $student->is_success_stories =  $request->is_success_stories;
    $student->profile_image =  $request->profile_image;
    $student->save();

    return back()->with("success", "Student Information updated successfully");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $student = Student::find($id);
    $student->is_delete = 1;
    $student->save();
    return back()->with("success", "Student Deleted Successfully");
  }
}
