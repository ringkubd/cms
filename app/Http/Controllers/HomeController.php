<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  protected $path;

  public function __construct()
  {
    $this->path = "admin";
  }

  /**
   * Show the application dashboard.
   *
   * @return Renderable
   */
  public function index()
  {

    // $analytics = (new \App\ApiModel)->vt_intakeSchedule();

    // dd($analytics); #TODO


    return view('admin.index');
  }


  public function api_testing()
  {
    $intake = (new \App\ApiModel)->vt_intakeSchedule();
    $mgt =  (new \App\ApiModel)->vt_intakeSchedule_management($intake);
    dd($mgt);
    //    $check = ApiModel::vt_students_result();
    //    $intake = ApiModel::intakeschedule();
    //    dd($intake);
  }
}
