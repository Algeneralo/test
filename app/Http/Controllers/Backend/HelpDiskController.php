<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\HelpDisk;
use App\Http\Requests\Backend\HelpDiskController\CreateRequest;
use App\Http\Requests\Backend\HelpDiskController\UpdateRequest;

class HelpDiskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $articles = HelpDisk::query()->with("page")->get();
        return view("backend.helpdisk.index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $pages = Page::query()->doesntHave("helpDisk")->get();
        return view("backend.helpdisk.create", compact("pages"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        HelpDisk::query()->create($request->all());
        return redirect()->route("helpDisk.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param HelpDisk $helpDisk
     * @return Response
     */
    public function edit(HelpDisk $helpDisk)
    {
        $pages = Page::query()->doesntHave("helpDisk")->get();
        return view("backend.helpdisk.edit", compact("helpDisk", "pages"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param HelpDisk $helpDisk
     * @return Response
     */
    public function update(UpdateRequest $request, HelpDisk $helpDisk)
    {
        $helpDisk->update($request->only($helpDisk->getFillable()));
        return redirect()->route("helpDisk.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param HelpDisk $helpDisk
     * @return Response
     * @throws \Exception
     */
    public function destroy(HelpDisk $helpDisk)
    {
        $helpDisk->delete();
        return redirect()->back();
    }
}
