<?php

namespace App\Http\Controllers\AccessControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\AccessModels\Role;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    protected $path;

    public function __construct()
    {
        $this->path = "admin.pages.roles";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('user')->where('is_delete', 0)->paginate(10);
        return view("$this->path.show-role", compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("$this->path.create-role");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request,[
            'active' => 'numeric|nullable|max:1',
            'roleName' => 'required|string|max:55',
            'description' => 'string|nullable|max:400',
        ]);

        $role = new Role;
        $role->active = $request->active ?? 0;
        $role->name = $request->roleName;
        $role->description = $request->description;
        $role->user_id = auth()->user()->id;
        $role->save();

        return Redirect("admin/role")->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view("$this->path.edit-role", compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate( $request,[
            'active' => 'numeric|nullable|max:1',
            'roleName' => 'required|string|max:55',
            'description' => 'string|nullable|max:400',
        ]);

        $role = Role::find($id);
        $role->active = $request->active ?? 0;
        $role->name = $request->roleName;
        $role->description = $request->description;
        $role->user_id = auth()->user()->id;
        $role->save();

        return back()->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Role::find($id);
        $user->is_delete = 1;
        $user->save();
        return back()->with('success','Role Deleted successfully');
    }
}
