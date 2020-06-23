<?php

namespace App\Http\Controllers\Backend\Scata;

use App\Http\Controllers\Controller;
use App\Models\Scata\Producer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProducerController extends Controller
{

    public function producers(Request $request)
    {

        $producer = Producer::all();

        return view('backend.scata.producers.producers')->with([
            'producers' => $producer
        ]);

    }

    public function producer(Producer $producer, Request $request)
    {

        return view('backend.scata.producers.producer')->with([
            'producer' => $producer
        ]);

    }

    public function update(Producer $producer, Request $request)
    {

        $producer->update([
            'name' => $request->name,
            'gln' => $request->gln,
            'street' => $request->street,
            'zipcode' => $request->zipcode,
            'city' => $request->city,
            'phone' => $request->phone,
            'fax' => $request->fax,
            'email' => $request->email,
            'website' => $request->website
        ]);

        return Redirect::back();

    }

    public function getCreate(Request $request)
    {

        return view('backend.scata.producers.create');

    }

    public function create(Request $request)
    {

        $producer = new Producer;

        $producer->name = $request->name;
        $producer->gln = $request->gln;
        $producer->provides_data = false;
        $producer->provides_data_vip = false;
        $producer->street = $request->street;
        $producer->zipcode = $request->zipcode;
        $producer->city = $request->city;
        $producer->phone = $request->phone;
        $producer->fax = $request->fax;
        $producer->email = $request->email;
        $producer->website = $request->website;

        $producer->save();

        return Redirect::route('get.scata.producers');

    }
}
