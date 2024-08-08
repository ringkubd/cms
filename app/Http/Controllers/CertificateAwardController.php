<?php

namespace App\Http\Controllers;

use App\CertificateAwardModel;
use App\Models\InfoModel\Course;
use App\Models\InfoModel\Round;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;
use PDF;

class CertificateAwardController extends Controller
{
  private $connection;

  public function __construct()
  {
    $this->connection = DB::connection('certificate_award');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $search = request('search');
    $course = request('course');
    $round = request('round');
    $batch = request('batch');
    $order = request('order');

    $register = $search ? CertificateAwardModel::where('name', 'LIKE', "%$search%") : new CertificateAwardModel();
    $register = $course ? $register->where('course', $course) : $register;
    $register = $course ? $register->where('course', $course) : $register;
    $register = $round ? $register->where('round', $round) : $register;
    $register = $batch ? $register->where('batch_id', $batch) : $register;
    $register = $order ? $register->orderBy('created_at', $order) : $register->orderByDesc('created_at');
    $register = $register->get();

    if (\request()->ajax()) {
      return view('admin.pages.certificate-award.info-table', compact('register'));
    }

    $lastRound = CertificateAwardModel::select('round')->orderByDesc('created_at')->first();
    $totalApplicant = CertificateAwardModel::where('round', $lastRound->round)->count();

    $rounds = CertificateAwardModel::select('round')->groupBy('round')->orderByDesc('round')->get();
    $courses = CertificateAwardModel::select('course')->groupBy('course')->get();
    $batches = CertificateAwardModel::select('batch_id')->groupBy('batch_id')->orderByDesc('batch_id')->get();
    return view('admin.pages.certificate-award.award-registration-table', compact('register', 'lastRound', 'totalApplicant', 'rounds', 'courses', 'batches'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $search = request('search');
    $course = request('course');
    $round = request('round');
    $batch = request('batch');
    $order = request('order');

    $register = $search ? CertificateAwardModel::where('name', 'LIKE', "%$search%") : new CertificateAwardModel();
    $register = $course ? $register->where('course', $course) : $register;
    $register = $course ? $register->where('course', $course) : $register;
    $register = $round ? $register->where('round', $round) : $register;
    $register = $batch ? $register->where('batch_id', $batch) : $register;
    $register = $order ? $register->orderBy('created_at', $order) : $register->orderByDesc('created_at');
    $register = $register->get();

    $pdf = PDF::loadView('admin.pages.certificate-award.print-table', compact('register'));
    // $pdf = PDF::loadView('admin.pages.certificate-award.print-table', compact('register'))->setPaper('a4', 'landscape');

    return $pdf->download('invoice.pdf');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Factory|View
   */
  public function show($id)
  {
    $register = CertificateAwardModel::find($id);
    return view('admin.pages.certificate-award.student-details', compact('register'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return void
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param int $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
    //
  }
}
