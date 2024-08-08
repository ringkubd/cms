<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */

  protected $redirectTo = '/dashboard';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function showLoginForm()
  {
    return view('themes.default.auth.login');
  }


  protected function authenticated(Request $request, $user)
  {
    Admin::get_permitted_menus();
  }

  /**
   * @param Request $request
   * @return RedirectResponse|Redirector
   */
  public function logout(Request $request)
  {
    $unique_user = unique_user();
    Session::forget($unique_user);
    $this->guard()->logout();
    $request->session()->invalidate();
    return $this->loggedOut($request) ?: redirect('/login');
  }

  /**
   * The user has logged out of the application.
   *
   * @param Request $request
   * @return mixed
   */
  protected function loggedOut(Request $request)
  {
    $unique_user = Admin::unique_user();
    Cache::forget($unique_user);
  }


}
