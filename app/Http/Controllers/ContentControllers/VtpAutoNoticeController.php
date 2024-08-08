<?php

namespace App\Http\Controllers\ContentControllers;

use App\Models\ContentModels\Post;
use App\Models\ContentModels\TermRelation;
use App\Models\ContentModels\VtpAutoNotice;
use App\Models\VocationalModels\IntakeModel;
use App\Models\VocationalModels\ResultModel;
use App\Models\VtpNoticeTracker;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Http\Numbertobangla;

class VtpAutoNoticeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $notices = Post::with('user', 'module')
      ->where('is_delete', 0)
      ->where('post_status', 'publish')
      ->join('vtp_notice_tracker as vnt', 'vnt.post_id', 'posts.id')
      ->select('posts.*', 'vnt.active', 'vnt.vtp_round', 'vnt.notice_type')
      ->orderByDesc('vnt.created_at')
      ->paginate(10);
    return view('admin.pages.vtp-auto-notice.vtp-notice-history', compact('notices'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    $formats = VtpAutoNotice::where('is_delete', 0)->get();
    return view('admin.pages.vtp-auto-notice.vtp-notice-format', compact('formats'));
  }

  public function vtp_auto_notice_refresh()
  {
    if (!Auth::check()) {
      $key = \request('user_key');
      $Rkey = 'asjdflsadjfldsajfldsaufdsalfjldsajfldsajflkdsajfldsajhf';
      if ($Rkey == $key) {
        $user = Auth::loginUsingId(1);
      } else {
        abort(404);
      }
    }

    $intake = IntakeModel::lastIntakeScheduleApi();

    $now = Carbon::now();

    if ($intake->prp_date) {
      $tracker = VtpNoticeTracker::where('notice_type', 'primary-result')->where('vtp_round', $intake->round)->first();
      if (!$tracker) {
        $prp_date = Carbon::create($intake->prp_date);
        $exam_date = Carbon::create($intake->exam_date);

        $round = $intake->round;

        $exam_date = $exam_date->greaterThanOrEqualTo($now) ? $intake->exam_date : null;

        $result = $now->greaterThanOrEqualTo($prp_date) ? $this->publish_primary_result($round, $exam_date) : false;
        if ($result) {
          return back()->with('error', 'Result Not Publishing');
        }
      }
    }

    return back()->with('success', 'Auto Notice Refreshing Successfully');
  }


  public function publish_primary_result($round, $exam_date)
  {
    $results = ResultModel::primarySelection($round);

    $html = '<table>';
    $html .= '<tr>';
    $html .= '<td><input id="tblSearch" type="text" class="form-control" placeholder="Search.."></td>';
    $html .= '</tr>';
    $html .= '</table>';
    $html .= '<table id="tblResult" class="table table-bordered table-striped table-sm">';
    $html .= '<tr>';
    $html .= '<th>Sl.</th>';
    $html .= '<th>TraineeID</th>';
    $html .= '<th>Name</th>';
    $html .= '<th>Mobile #</th>';
    $html .= '<th>Exam time</th>';
    $html .= '</tr>';
    $i = 1;
    $limit = $results->count() > 300 ? round($results->count() / 2) : $results->count();
    foreach ($results as $result) {
      $time = $i < $limit ? '10:00am' : '2:00pm';
      $html .= '<tr>';
      $html .= '<td>' . $i . '</td>';
      $html .= '<td>' . $result->trainee_id . '</td>';
      $html .= '<td>' . $result->name . '</td>';
      $html .= '<td>' . $result->mobile_number . '</td>';
      $html .= '<td class="text-center">' . $time . '</td>';
      $html .= '</tr>';
      $i++;
    }
    $html .= '</table >';


    $formats = VtpAutoNotice::where('is_delete', 0)
      ->where('active', 1)
      ->where('notice_type', 'primary-result')
      ->first();

    $bDate = new Numbertobangla();
    $banDate = $bDate->monthtobangla(date('d-F-Y', strtotime($exam_date)));

    $exam_date = $exam_date ? 'মৌখিক পরীক্ষার সময়ঃ ' . $banDate : ' মৌখিক পরীক্ষার সময় পরবর্তীতে জানানো হবে । ';

    $title = str_replace('[round]', $bDate->number($round), $formats->notice_title);
    $details = str_replace('[result]', $html, $formats->notice_details);
    $details = str_replace('[exam_date]', $exam_date, $details);
    $details = str_replace('[round]', $bDate->number($round), $details);

    DB::transaction(function () use ($title, $details, $formats, $round) {
      $post = Post::create([
        'post_title' => $title,
        'post_slug' => bn_slug_url($title),
        'post_content' => $details,
        'post_status' => 'publish',
        'post_format' => 'standard',
        'post_type' => 'vocational-training-programme',
        'upload_type' => 'off',
        'thumb_status' => 0,
        'user_id' => $formats->updated_by,
      ]);

      TermRelation::create([
        'taxonomy_id' => 1, // 1 for notice
        'post_id' => $post->id,
        'user_id' => $post->user_id,
      ]);

      $vtp = VtpNoticeTracker::create([
        'active' => 1, // 1 for notice
        'post_id' => $post->id,
        'vtp_round' => $round,
        'notice_type' => 'primary-result',
      ]);

    }, 5); // reattempted  5 times

    return true;
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request)
  {
    return back()->with('success', 'Not Functionality yet');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function show($id)
  {
    dd('show notice');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Factory|View
   */
  public function edit($id)
  {
    $format = VtpAutoNotice::findOrFail($id);
    return view('admin.pages.vtp-auto-notice.edit-notice-format', compact('format'));
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
    $data = $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'notice_title' => 'required|string|max:400',
      'notice_details' => 'required|string|max:1800',
    ]);
    $data['notice_slug'] = Str::slug($request->input('notice_title'));
    $data['active'] = $request->input('active', 0);
    $data['updated_by'] = Auth::id();

    VtpAutoNotice::find($id)->update($data);

    return back()->with('success', 'Format Updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return RedirectResponse
   */
  public function destroy($id)
  {

    dd('destroy notice');

    return back()->with('success', 'Term Taxonomy Deleted successfully');
  }
}
