<?php

namespace App\Http\Controllers\VocationalControllers;

use App\Admin;
use App\helpers\SMS\SmsSender;
use App\Http\Controllers\Controller;
use App\Models\ContentModels\Module;
use App\Models\VocationalModels\IntakeModel;
use App\Models\VocationalModels\VocationalApply;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ApplyController extends Controller
{

  public function vt_intakeSchedule()
  {
    $apiModel = new ApiModel();
    $vtp_intake = $apiModel->vt_intakeSchedule();
    if (is_numeric($vtp_intake) && ($vtp_intake == 401 || $vtp_intake == 404)) {
      return view("themes.default.apply-form.api-error", compact('vtp_intake'));
    }
    return $vtp_intake;
  }

  public function apply()
  {
    $vtpIntake = IntakeModel::lastIntakeScheduleApi();

    $now = Carbon::now();
    $end_date = Carbon::create($vtpIntake->end_date)->addHour(23)->addMinute(59);
    $isIntake = $now->lessThanOrEqualTo($end_date);

    if ($isIntake) {
      return view('themes.default.apply-form.vocational-apply-instructions', compact('vtpIntake'));
    }

    return view('themes.default.apply-form.apply-expired', compact('vtpIntake'));
  }

  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $vtpIntake = IntakeModel::lastIntakeScheduleApi();
    $now = Carbon::now();
    $end_date = Carbon::create($vtpIntake->end_date)->addHour(23)->addMinute(59);
    $isIntake = $now->lessThanOrEqualTo($end_date);

    if (!$isIntake) {
      abort(404);
    }

    $module = Module::where('slug', request()->segment(1))->where('is_delete', 0)->firstOrFail();
    return view('themes.default.apply-form.vocational-apply', compact('module', 'vtpIntake'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    $vtpIntake = IntakeModel::lastIntakeScheduleApi();
    $now = Carbon::now();
    $end_date = Carbon::create($vtpIntake->end_date)->addHour(23)->addMinute(59);
    $isIntake = $now->lessThanOrEqualTo($end_date);

    $module = Module::where('slug', request()->segment(1))->where('is_delete', 0)->firstOrFail();
    return view('themes.default.apply-form.vocational-admit-card', compact('module', 'vtpIntake','isIntake'));
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
    $database_connection = 'pis_isdb_vtp';
    $round = IntakeModel::lastIntakeScheduleApi()->round;
    $applyData = Validator::make($request->all(), [
      'name' => ['required','string','max:255', Rule::unique("{$database_connection}.tbl_application")->where(function ($q) use($request, $round){
        $q->where('father_name', $request->father_name)
        ->where('round', $round)
        ->where('mother_name', $request->mother_name);
      })],
      'mobile_number' => ['required','string','min:10','max:11', Rule::unique("{$database_connection}.tbl_application")->where(function ($q) use($request, $round){
        $q->where('mobile_number', trim($request->mobile_number))
          ->where('round', $round);
      })],
      'birth_date' => 'required|date|before:16 years ago|after:27 years ago',
      'guardian_mobile' => 'required|string|min:10|max:191',
      'father_name' => 'required|string|min:2|max:255',
      'mother_name' => 'required|string|min:2|max:255',
      'education' => 'required|string|min:1|max:191',
      'gpa' => 'required|numeric|min:1|max:191',
      'roll' => 'required|numeric',
      'passing_year' => 'required|numeric|min:1|max:9999',
      'present_status' => 'required|string|min:1|max:191',
      'studying_level' => 'required_if:present_status,Studying',
      'religion' => 'required|string|min:1|max:55',
      'gender' => 'required|string|min:1|max:55',
      'martial_status' => 'required|string|min:1|max:191',
      'reference' => 'nullable|string|min:1|max:255',
      'pres_address' => 'required|string|min:1|max:600',
      'perm_address' => 'required|string|min:1|max:600',
      'photo' => 'required|max:150|mimes:jpg,jpeg', // max file size 150kb
    ], $this->validation_messages());
    $applyData = $applyData->after(function ($validator) use ($request, $round) {
      $dateOfBirth = $request->input('birth_date');
      if (strpos($request->input('birth_date'), '/')) {
        $dateOfBirth = explode('/', $request->input('birth_date'));
        $dateOfBirth = $dateOfBirth[2] . "-" . $dateOfBirth[1] . "-" . $dateOfBirth[0];
      }
      $birth_date = Carbon::parse($dateOfBirth)->toDateString(); // Y-m-d
      $mobile_number = $request->input('mobile_number');
      
    })->validate();

    unset($applyData['photo']);

    $applyData['mobile_number'] = trim(str_replace('-', '', $applyData['mobile_number']));
    $applyData['birth_date'] = Carbon::parse($applyData['birth_date'])->toDateString();
    $applyData['religion'] = $request->input('religion') == 'islam' ? 0 : 1;
    $applyData['gender'] = $request->input('gender') == 'male' ? 0 : 1;
    $applyData['martial_status'] = $request->input('religion') == 'unmarried' ? 1 : 0;
    

    DB::beginTransaction();
    try {
      $applyData['ip'] = $request->getClientIp();
      $applyData['round'] = IntakeModel::lastIntakeScheduleApi()->round;
      $applyData['trainee_id'] = VocationalApply::newTraineeID();
      $path = 'photos/shares/vocation-apply/round-' . $applyData['round'];
      $applyData['photo'] = $this->vtp_apply_image_store($request->file('photo'), $path, $applyData['trainee_id']);
      $storeData = VocationalApply::create($applyData); // store data
      Session::put('vtp_apply_data', $storeData);

      $sms = new SmsSender();
      $taineeId = $applyData['trainee_id'];
      $mobile = $applyData['mobile_number'];
      $send = $sms->sendSms($mobile, "Your application for the Vocational Training has been submitted successfully. Your application ID: {$taineeId}");
    } catch (\Exception $e) {
      DB::rollback();
      return back()
        ->with('error', 'Application Not Applied, Server Error!')
        ->withInput();
    }

    return redirect('vocational-training-programme/apply/show');
  }

  public function validation_messages()
  {
    return [
      "birth_date.required" => "Your date of birth is required.",
      "birth_date.date" => "The birth date is not a valid date. Valid date format are (2020-10-20 or 20-10-2020)",
      "birth_date.before" => "Minimum allowable age for this training is 17",
      "birth_date.after" => "Maximum allowable age for this training is 27",
      "father_name.required" => "Your father name is required",
      "mother_name.required" => "Your mother name is required",
      "pres_address.required" => "Your present address is required",
      "perm_address.required" => "Your permanent address is required",
      "present_status.required" => "Your present status is required",
      "passing_year.required" => "Your passing year is required",
      "martial_status.required" => "Your marital status is required",
      "mobile_number.required" => "Your mobile number is required",
      "guardian_mobile.required" => "Your guardian mobile number is required",
      "studying_level.required" => "Your present studying level is required",
    ];
  }


  public static function vtp_apply_image_store($image, $dir_path, $name)
  {
    $pathDir = Admin::create_public_directory($dir_path);
    $image = Image::make($image);
    if ($image->width() > 300) {
      $image->resize(300, null, function ($c) {
        $c->aspectRatio();
      })->save("{$pathDir}/{$name}.jpg", 95, 'jpg');
    } else {
      $image->save("{$pathDir}/{$name}.jpg", 95, 'jpg');
    }

    return "{$dir_path}/{$name}.jpg";
  }


  /**
   * Display the specified resource.
   *
   * @return Factory|View
   */
  public function show()
  {
    $module = Module::where('slug', request()->segment(1))->where('is_delete', 0)->firstOrFail();
    if (session()->has('vtp_apply_data')) {
      $applyData = session('vtp_apply_data');
      $candidateImage = $this->get_candidate_valid_picture($applyData->round, $applyData->trainee_id, $applyData->created_at);
    } else {
      $vtpIntake = IntakeModel::lastIntakeScheduleApi();
      return view('themes.default.apply-form.vocational-admit-card', compact('module', 'vtpIntake'));
    }
    return view('themes.default.apply-form.vocational-admit-card-print', compact('module', 'applyData', 'candidateImage'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Request $request
   * @return Factory|View
   * @throws ValidationException
   */
  public function admin_card_show(Request $request)
  {
    $data = $this->validate($request, [
      'mobile_number' => 'required|string|min:1|max:191', //mobile number required
      'birth_date' => "required|date",
    ]);
    $data['birth_date'] = Carbon::parse($data['birth_date'])->toDateString(); // Y-m-d
    $applyData = VocationalApply::where('birth_date', $data['birth_date'])
      ->where('mobile_number', $data['mobile_number'])
      ->orderByDesc('id')
      ->first();
    if (is_null($applyData)) {
      return back()->with('error', 'your data not matched');
    }
    $date = $applyData->timestamp ? $applyData->timestamp : $applyData->created_at;
    $candidateImage = $this->get_candidate_valid_picture($applyData->round, $applyData->trainee_id, $date);
    $module = Module::where('slug', request()->segment(1))->where('is_delete', 0)->firstOrFail();

    return view('themes.default.apply-form.vocational-admit-card-print', compact('module', 'applyData', 'candidateImage'));
  }


  public function download_admin_card(Request $request)
  {
    $module = Module::where('slug', request()->segment(1))->where('is_delete', 0)->firstOrFail();
    $data = $this->validate($request, [
      'trainee_id' => 'required|string|min:1|max:191',
    ]);
    $applyData = VocationalApply::where('trainee_id', $data['trainee_id'])->first();

    if (is_null($applyData)) {
      return back()->with('error', 'your data not matched');
    }
    $date = $applyData->timestamp ? $applyData->timestamp : $applyData->created_at;
    $candidateImage = $this->get_candidate_valid_picture($applyData->round, $applyData->trainee_id, $date);
    $download = true;
    return view('themes.default.apply-form.vocational-admit-card-print', compact('module', 'applyData', 'candidateImage', 'download'));
  }


  public function get_candidate_valid_picture($round, $trainee_id, $applyDate)
  {
    $dateBoundary = Carbon::parse('2019-12-24')->toDateTimeString();
    $now = Carbon::parse($applyDate)->toDateTimeString();
    $default = asset('img/default-avatar.png');

    if ($now > $dateBoundary) {
      $file = "photos/shares/vocation-apply/round-{$round}/{$trainee_id}.jpg";
      return File::isFile(public_path($file)) ? asset($file) : $default;
    }

    $file = "photos/shares/vocation-apply/trainee/{$trainee_id}.jpg";
    return File::isFile(public_path($file)) ? asset($file) : $default;
  }
}
