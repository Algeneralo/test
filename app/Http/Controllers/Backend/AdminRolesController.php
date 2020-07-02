<?php

namespace App\Http\Controllers\Backend;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminRolesController\CreateRequest;
use App\Http\Requests\Backend\AdminRolesController\UpdateRequest;
use App\Models\Admins\Group;
use App\Models\Admins\Permission;
use App\Models\Admins\PermissionGroup;
use App\Models\Admins\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminRolesController extends Controller
{

    public function __construct()
    {
        $this->middleware("concurrent.operations:App\Models\Admins\Role")->only("role", "update");

        HelpDisk::checkIfExists("roles");
    }

    public function roles(Request $request)
    {


        if ($request->user()->can('admins.role.manager')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('group_id', $request->user()->group_id)->get();
        }


        $permissions = Permission::all();

        return view('backend.admins.roles')->with([
            'roles' => $roles,
            'permissions' => $permissions,
            'editrole' => null,
        ]);

    }

    public function role(Role $role, Request $request)
    {

        $permissionGroups = PermissionGroup::with('permissions')->get();

        if ($request->user()->can('admins.group.manager')) {

            $groups = Group::all();

        } else {

            $groups = Group::where('group_id', $request->user()->group_id)->get();

        }

        return view('backend.admins.roles.edit')->with([
            'permissionGroups' => $permissionGroups,
            'role' => $role,
            'groups' => $groups,
        ]);

    }

    public function getCreate(Request $request)
    {

        $permissionGroups = PermissionGroup::with('permissions')->get();

        if ($request->user()->can('admins.group.edit')) {

            $groups = Group::all();

        } else {

            $groups = Group::where('group_id', $request->user()->group_id)->get();

        }

        return view('backend.admins.roles.create')->with([
            'permissionGroups' => $permissionGroups,
            'groups' => $groups,
        ]);

    }

    public function create(CreateRequest $request)
    {


        $role = Role::create([
            'name' => $request->input('name'),
            'group_id' => $request->input('group_id'),
        ]);


        if ($request->has('permissions')) {

            foreach ($request->input('permissions') as $permission) {

                $role->givePermissionTo($permission);

            }

        }

        return Redirect::route('get.admin-roles');

    }

    public function update(Role $role, UpdateRequest $request)
    {

        $role->update([
            'name' => $request->input('name'),
        ]);

        $role->syncPermissions($request->input('permissions'));

        return Redirect::route('get.admin-roles');

    }

}
