<?php

namespace App\Http\Controllers\AccessControllers;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\AccessModels\Role;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Factory|View
   */
  public function index()
  {
    $users = User::with('role')
      ->where('is_delete', 0)
      ->orderBy('id', 'ASC')
      ->paginate(10);
    return view('admin.pages.users.show-user', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Factory|View
   */
  public function create()
  {
    $role_id = Auth::user()->role_id ?? 0;
    $roles = Role::where('is_delete', 0)->where('active', 1)->get();
    return view('admin.pages.users.create-user', compact('roles'));
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
    $userData = $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'firstName' => 'string|nullable|max:255',
      'lastName' => 'string|nullable|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
      'role_id' => 'required|numeric|max:99',
      'gender' => 'nullable|string|max:55',
    ]);

    if ($request->hasFile("picture")) {
      $this->validate($request, [
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048',
      ]);
      $imgName = Str::slug(Str::limit($request->input('firstName'), 60)) . "-" . date("m-Y");
      $userPicture = Admin::store_image($request->file('picture'), "avatar", $imgName);
      $userData['picture'] = $userPicture['original'];
    } else {
      $userData['picture'] = "img/default-avatar.png";
    }
    $userData['password'] = Hash::make($request->input('password'));
    User::create($userData);

    return back()->with('success', 'User created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Factory|View
   */
  public function show($id)
  {
    $user = User::find($id);
    return view('admin.pages.users.single-user', compact('user'));
  }

  /**
   * @param User $user
   * @return Factory|View
   */
  public function edit(User $user)
  {
    $roles = Role::where('is_delete', 0)->where('active', 1)->get();
    return view('admin.pages.users.edit-user', compact('user', 'roles'));
  }

  /**
   * @param Request $request
   * @param $id
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request, $id)
  {
    $data = $this->validate($request, [
      'active' => 'numeric|nullable|max:1',
      'firstName' => 'nullable|string|max:95',
      'LastName' => 'nullable|string|max:95',
      'gender' => 'string|required|max:55',
      'role_id' => 'required|numeric|max:99',
      'email' => 'required|email|max:255|unique:users,email,' . $id,
      'picKey' => 'nullable|string|max:20',
      'newPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'picture' => 'nullable|string|max:255',
    ]);
    $user = User::find($id);
    if ($request->has("changedPassword")) {
      $this->validate($request, [
        'oldPassword' => 'required|string|min:6',
        'password' => 'required|string|min:6|confirmed',
      ]);
      if (Hash::check($request->input('oldPassword'), $user->password)) {
        $data['password'] = Hash::make($request->input('password'));
      } else {
        return back()->with('error', 'password not updated')->withInput();
      }
    }

    if ($request->hasFile('newPicture')) {
      $this->validate($request, [
        'newPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:800',
      ]);
      if ($request->hasFile('newPicture')) {
        $imgName = Str::slug(Str::limit($request->input('firstName'), 60)) . '-' . date('m-Y');
        $images = Admin::store_image($request->file('newPicture'), "avatar", $imgName);
        $data['picture'] = $images['original'];
      }
    }

    if ($request->input('picKey') == 'old') {
      $data['picture'] = str_replace(env('APP_URL'), '', $request->input('picture'));
    }

    $user->update($data);

    return back()->with('success', 'User updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return RedirectResponse
   */
  public function destroy(User $user)
  {
    $user->update(['is_delete' => 1]);
    return back()->with('success', 'User Deleted successfully');
  }
}
