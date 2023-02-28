<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $users = User::paginate(5);
        $roles = Role::all();
        //    dd($users->first()->roles[0]->name);

        return view('admin.users_new.index', compact('users', 'roles'));
    }
    /////==============================================================
    public function changerole($id, $value)
    {
        $user = User::find($id);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($value);
        return response()->json(['message' => 'success']);
    }
    /////================================================================
    public function search_user(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter_roles;
        $users = [];
        if ($search) {
            if ($filter != 0) {
                $users = DB::table('users')->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->where(function ($q) use ($search, $filter) {
                    $q->where('model_has_roles.role_id', $filter)
                        ->where('first_name', 'LIKE', '%' . $search . '%');
                })->orWhere(function ($q) use ($search, $filter) {
                    $q->where('model_has_roles.role_id', $filter)
                        ->where('last_name', 'LIKE', '%' . $search . '%');
                })->orWhere(function ($q) use ($search, $filter) {
                    $q->where('model_has_roles.role_id', $filter)
                        ->where('email', 'LIKE', '%' . $search . '%');
                })->orWhere(function ($q) use ($search, $filter) {
                    $q->where('model_has_roles.role_id', $filter)
                        ->where('username', 'LIKE', '%' . $search . '%');
                })->get();
            } else {
                $users = User::where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('username', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->get();
            }
        } elseif ($filter != 0) {
            $users = DB::table('users')->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')->where('model_has_roles.role_id', $filter)->get();
        }

        $roles = Role::all();




        return view('admin.users_new.search', compact('users', 'roles'));
    }

    ///////////////////////////////////create new user//////////////////////////////////////////

    public function create()
    {
        $roles = Role::all();
        $users = User::all();
        $count = count($users) + 1;

        return view('admin.users_new.create', compact('roles', 'count'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|alpha_dash|unique:users,username',
            'phone' => 'required|numeric|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password',
            'roles' => 'required'

        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['google_id'] = 'qe';

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        session()->push('message', ['type' => 'success', 'message' => 'User created successfully']);
        return redirect('admin/users');
    }

    //////////////////////////////////////edit user//////////////////////////////////////////

    public function edit($id)
    {  //pluck('name','name')->
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->first();

        return view('admin.users_new.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'phone' => 'required|numeric|unique:users,phone,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,

            'roles' => 'required'
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $input = $request->all();


        $user = User::find($id);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        User::where('id', $user->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
        ]);
        $user->assignRole($request->input('roles'));

        return redirect('admin/users')
            ->with('success', 'User updated successfully');
    }
    ////////////////////////////////////////////////////////////////////////////////
    public function destroy($id)
    {
        User::find($id)->delete();
        $users = User::all();
        $roles = Role::all();


        // session()->push('message', ['type' => 'success', 'message' => 'User deleted successfully']);
        echo "<script>alert('User Deleted');</script>";
        return redirect('admin/users');
    }
}
