<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class NewRoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $roles = Role::paginate(5);
        //    dd($users->first()->roles[0]->name);

        return view('admin.roles_new.index', compact('roles'));
    }


    public function search_role(Request $request)
    {

        $roles = Role::where('name', 'LIKE', '%' . $request->search2 . '%')->paginate(5);




        return view('admin.roles_new.index', compact('roles'));
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        $roles = Role::all();
        return redirect()->route('roles')
            ->with('status', 'Role deleted successfully');
    }


    public function create()
    {
        $user_permissions = Permission::where('name', 'LIKE', '%user%')->get();
        $role_permissions = Permission::where('name', 'LIKE', '%role%')->get();
        $image_slider_permissions = Permission::where('name', 'LIKE', '%image%')->get();
        $media_permissions = Permission::where('name', 'LIKE', '%article%')->get();
        $feed_permissions = Permission::where('name', 'LIKE', '%feed%')->get();


        return view('admin.roles_new.create', compact('user_permissions', 'role_permissions', 'image_slider_permissions', 'media_permissions', 'feed_permissions'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $role = Role::create(['name' => $request->input('role_name')]);
        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('roles')
            ->with('status', 'Role created successfully');
    }


    public function edit($id)
    {
        //edit_function
        $role = Role::find($id);
        $user_permissions = Permission::where('name', 'LIKE', '%user%')->get();
        $role_permissions = Permission::where('name', 'LIKE', '%role%')->get();
        $image_slider_permissions = Permission::where('name', 'LIKE', '%image%')->get();
        $media_permissions = Permission::where('name', 'LIKE', '%article%')->get();
        $feed_permissions = Permission::where('name', 'LIKE', '%feed%')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles_new.edit', compact('role', 'user_permissions', 'role_permissions', 'image_slider_permissions', 'media_permissions', 'feed_permissions', 'rolePermissions'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $role = Role::find($id);
        $role->name = $request->input('role_name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('roles')
            ->with('status', 'Role updated successfully');
    }
}
