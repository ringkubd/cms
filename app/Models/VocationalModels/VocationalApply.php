<?php

namespace App\Models\VocationalModels;

use App\Home;
use App\Models\ContentModels\Post;
use App\Models\ContentModels\TermRelation;
use App\Models\ContentModels\VtpAutoNotice;
use App\Models\VtpNoticeTracker;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VocationalApply extends Model
{
  protected $connection= 'pis_isdb_vtp';

  protected $table = 'tbl_application';

  public $primaryKey = 'id';

  protected $guarded = ['id'];

  public $timestamps = true;


  public static function newTraineeID() {
    return self::select('trainee_id')->orderByDesc('id')->first()->trainee_id + 1 ?? null;
  }



  public function vtp_circular_notice($intake)
  {
    $today = Carbon::today(); // current date
    $cirData = Carbon::parse($intake->start_date);
    if (!$today->greaterThanOrEqualTo($cirData)) {
      return false;
    }
    $tracker = VtpNoticeTracker::where('active', 1)->where('vtp_round', $intake->round)->where('notice_type', 'circular')->first();
    if (!$tracker) {
      $round = $intake->round;
      $endDate = Carbon::parse($intake->end_date)->format('d F, Y');
      $notice = VtpAutoNotice::where('active', 1)->where('notice_type', 'circular')->first();
      $title = str_replace('[round]', $round, $notice->notice_title);
      $details = str_replace('[round]', $round, $notice->notice_details);
      $details = str_replace('[lastdate]', $endDate, $details);
      $post_slug = Str::slug($title);
      $postData = [
        'post_title' => $title,
        'post_content' => $details,
        'post_status' => 'publish',
      ];
      $post = Post::updateOrCreate(
        ['post_slug' => $post_slug, 'user_id' => 0, 'post_type' => 'vocational-training-programme'],
        $postData
      );
      TermRelation::updateOrCreate(
        ['taxonomy_id' => 1, 'post_id' => $post->id],
        ['user_id' => 0, 'is_active' => 1]
      ); // post as notice
      TermRelation::updateOrCreate(
        ['taxonomy_id' => 2, 'post_id' => $post->id],
        ['user_id' => 0, 'is_active' => 1]
      ); // post as notice
      VtpNoticeTracker::updateOrCreate(
        ['vtp_round' => $round, 'notice_type' => 'circular', 'post_id' => $post->id],
        ['active' => 1]
      );
      return 'notice published';
    }
    return false;
  }

  public function vtp_primary_result_notice($intake)
  {
    $now = Carbon::parse('2019-11-03'); // current date
    $prp_date = Carbon::parse($intake->prp_date); // primary result published date
    if (!$now->greaterThanOrEqualTo($prp_date)) {
      return false;
    }
    $tracker = VtpNoticeTracker::where('active', 1)->where('vtp_round', $intake->round)->where('notice_type', 'primary-result')->first();
    if (!$tracker) {
      $round = $intake->round;
      $endDate = Carbon::parse($intake->end_date)->format('d F, Y');
      $notice = VtpAutoNotice::where('active', 1)->where('notice_type', 'primary-result')->first();
      $title = str_replace('[round]', $round, $notice->notice_title);
      $details = str_replace('[round]', $round, $notice->notice_details);
      $details = str_replace('[lastdate]', $endDate, $details);
      $post_slug = Str::slug($title);
      $postData = [
        'post_title' => $title,
        'post_content' => $details,
        'post_status' => 'publish',
      ];
      $post = Post::updateOrCreate(
        ['post_slug' => $post_slug, 'user_id' => 0, 'post_type' => 'vocational-training-programme'],
        $postData
      );
      TermRelation::updateOrCreate(
        ['taxonomy_id' => 1, 'post_id' => $post->id],
        ['user_id' => 0, 'is_active' => 1]
      ); // post as notice
      TermRelation::updateOrCreate(
        ['taxonomy_id' => 2, 'post_id' => $post->id],
        ['user_id' => 0, 'is_active' => 1]
      ); // post as notice
      VtpNoticeTracker::updateOrCreate(
        ['vtp_round' => $round, 'notice_type' => 'primary-result', 'post_id' => $post->id],
        ['active' => 1]
      );
      return 'notice published';
    }
    return false;
  }



  public function vt_students_primary_result($round = false)
  {
    $fullUrl = $this->vt_base_url . "/api/v1/result";
    $Query = [
      'headers' => [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
      ],
      'query' => [
        'api_token' => $this->vt_api,
      ]
    ];
    if ($round) {
      $Query['query']['round'] = $round;
    }
    $client = new Client();
    $response = $client->get($fullUrl, $Query);
    return json_decode($response->getBody());
  }



  public static function vt_apply_study_label()
  {
    return array(
      "VIII" => "VIII",
      "JSC" => "JSC",
      "JDC" => "JDC",
      "SSC" => "SSC",
      "Dakhil" => "Dakhil",
      "SSC-VOC" => "SSC-VOC",
      "Dakhil-VOC" => "Dakhil-VOC",
      "HSC" => "HSC",
      "Alim" => "Alim",
      "Bachelor" => "Bachelor",
      "Fazil" => "Fazil",
      "BA(Hons)" => "BA (Hons)",
      "Masters" => "Masters",
      "Kamil" => "Kamil",
      "Diploma" => "Diploma",
    );
  }
}
