<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VtApiController extends Controller
{

  public function api_token_form()
  {
    $token = Auth::user()->api_token;
    return view('admin.pages.api-token.token-form', compact('token'));
  }

  public function api_token_save(Request $request)
  {
    Auth::user()->generateToken();
    return back()->with('success', 'Generate new api token');
  }


  public function get_trainee_picture_url(Request $request)
  {
    $trainee_id = $request->input('trainee_id', null);
    $round = $request->input('round', null);
    $applyDate = $request->input('applyDate', null);

    $dateBoundary = Carbon::parse('2019-12-24');
    $now = Carbon::parse($applyDate);

    if ($now->greaterThan($dateBoundary)) {
      if (Storage::disk('shares')->exists("vocation-apply/round-{$round}/{$trainee_id}.jpg")) {
        return asset("photos/shares/vocation-apply/round-{$round}/{$trainee_id}.jpg");
      } else {
        return asset('img/default-avatar.png');
      }
    } else {
      if (Storage::disk('shares')->exists("vocation-apply/trainee/{$trainee_id}.jpg")) {
        return asset("photos/shares/vocation-apply/trainee/{$trainee_id}.jpg");
      } else {
        return asset('img/default-avatar.png');
      }
    }
  }
}
