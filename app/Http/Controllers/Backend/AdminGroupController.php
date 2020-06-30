<?php

namespace App\Http\Controllers\Backend;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AdminGroupController\CreateRequest;
use App\Http\Requests\Backend\AdminGroupController\UpdateRequest;
use App\Models\Admins\Admin;
use App\Models\Admins\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminGroupController extends Controller
{
    public function __construct()
    {
        HelpDisk::checkIfExists("groups");
    }

    public function groups()
    {

        $groups = Group::with('supervisor')->get();
        $users = Admin::all();

        return view('backend.admins.groups')->with([
            'groups' => $groups,
            'users' => $users,
            'editgroup' => null,
        ]);

    }

    public function group(Group $group)
    {

        $users = Admin::all();

        return view('backend.admins.groups.edit')->with([
            'users' => $users,
            'group' => $group,
        ]);


    }

    public function getCreate()
    {

        $users = Admin::all();

        return view('backend.admins.groups.create')->with([
            'users' => $users,
        ]);

    }

    public function create(CreateRequest $request)
    {

        $group = Group::create($request->except('logo'));

        if ($request->hasFile('logo')) {

            $file = $request->file('logo');
            $filename = Str::slug($group->name) . '_' . time() . '.' . $file->extension();
            $file->storeAs('group-logos', $filename);

            $group->logo = $filename;
            $group->save();

        }

        return Redirect::route('get.admin-groups');

    }

    public function update(Group $group, UpdateRequest $request)
    {

        $group->update($request->except('logo'));

        if ($request->hasFile('logo')) {

            if ($group->logo) {

                Storage::delete('group-logos/' . $group->logo);

            }

            $file = $request->file('logo');
            $filename = Str::slug($group->name) . '_' . time() . '.' . $file->extension();

            $file->storeAs('group-logos', $filename);

            $group->logo = $filename;
            $group->save();

        }

        return Redirect::route('get.admin-groups');

    }

    public function getLogo(Group $group)
    {

        if ($group->logo) {

            $storedImage = Storage::disk('local')->get('group-logos/' . $group->logo);

            return Image::make($storedImage)->response();

        } else {

            $storedImage = Storage::disk('local')->get('group-logos/scata.png');

            return Image::make($storedImage)->response();

        }

    }

}
