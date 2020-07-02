<?php

namespace App\Http\Controllers\Backend;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminController\CreateRequest;
use App\Http\Requests\Backend\AdminController\UpdateRequest;
use App\Mail\Backend\Admins\NewAccount;
use App\Models\Admins\Admin;
use App\Models\Admins\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("concurrent.operations:App\Models\Admins\Admin")->only("user", "update");

        HelpDisk::checkIfExists("users");
    }

    public function users(Request $request)
    {

        if ($request->user()->can('admins.user.manager')) {
            $users = Admin::with('group')->get();
        } else {
            $users = Admin::where('group_id', $request->user()->group_id)->with('group')->get();
        }

        return view('backend.admins.users')->with([
            'users' => $users,
        ]);

    }

    public function user(Admin $admin, Request $request)
    {

        if ($request->user()->can('admins.role.manager')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('group_id', $request->user()->group_id)->get();
        }

        if ($request->user()->can('admins.group.manager')) {
            $groups = Group::all();
        } else {
            $groups = Group::where('group_id', $request->user()->group_id)->get();
        }

        return view('backend.admins.users.edit')->with([
            'roles' => $roles,
            'groups' => $groups,
            'user' => $admin,
        ]);

    }

    public function getCreate(Request $request)
    {

        if ($request->user()->can('admins.role.manager')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('group_id', $request->user()->group_id)->get();
        }

        if ($request->user()->can('admins.group.manager')) {
            $groups = Group::all();
        } else {
            $groups = Group::where('group_id', $request->user()->group_id)->get();
        }
        return view('backend.admins.users.create')->with([
            'roles' => $roles,
            'groups' => $groups,
        ]);
    }

    public function create(CreateRequest $request)
    {

        $admin = Admin::create($request->except(['password_confirmation', 'role', 'send-credentials']));

        $admin->syncRoles($request->input('roles'));
        $admin->status = true;


        if ($request->input('send-credentials')) {

            $admin->password = Str::random(32);

            $token = Str::random(16);

            Cache::put('resetpassword:' . $admin->admin_id, $token);

            Mail::to($admin)->send(new NewAccount($admin, $token));

        }

        $admin->save();

        return Redirect::route('get.admin-users');

    }

    public function update(Admin $admin, UpdateRequest $request)
    {

        if ($request->has('password') && ($request->input('password') != null)) {

            $updateData = $request->except(['password_confirmation', 'role', 'send-credentials']);

        } else {

            $updateData = $request->except(['password', 'password_confirmation', 'role', 'send-credentials']);

        }

        $admin->update($updateData);

        $admin->syncRoles($request->input('roles'));

        return Redirect::route('get.admin-users');

    }

    public function softDelete(Admin $admin, Request $request)
    {

        $admin->forceDelete();

        return Redirect::back();

    }


}
