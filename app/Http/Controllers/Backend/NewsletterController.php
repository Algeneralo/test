<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\NewsletterController\CreateRequest;
use App\Http\Requests\Backend\NewsletterController\UpdateRequest;
use App\Models\Admins\Group;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NewsletterController extends Controller
{

    public function newsletters() {

        $newsletters = Newsletter::all();

        return view('backend.newsletter.newsletters')->with([
            'newsletters' => $newsletters
        ]);

    }

    public function newsletter(Newsletter $newsletter) {

        $groups = Group::all();

        return view('backend.newsletter.edit')->with([
            'groups' => $groups,
            'newsletter' => $newsletter
        ]);

    }

    public function getCreate() {

        $groups = Group::all();

        return view('backend.newsletter.create')->with([
           'groups' => $groups
        ]);

    }

    public function create(CreateRequest $request) {

        $newsletter = $request->user()->newsletters()->create($request->except(['send_now']));

        if($request->input('send_now')) {

            $newsletter->send();

        }

        return Redirect::route('get.newsletters');

    }

    public function update(Newsletter $newsletter, UpdateRequest $request) {

        $newsletter->update($request->except(['send_now']));

        if($request->input('send_now')) {

            $newsletter->send();

        }

        return Redirect::route('get.newsletters');

    }

    public function send(Newsletter $newsletter) {

        $newsletter->send();

        return Redirect::route('get.newsletters');

    }

    public function delete(Newsletter $newsletter) {

        $newsletter->forceDelete();

        return Redirect::route('get.newsletters');

    }

}
