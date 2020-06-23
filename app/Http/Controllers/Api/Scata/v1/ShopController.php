<?php

namespace App\Http\Controllers\Api\Scata\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Scata\v1\Shop\Shop as ShopResource;
use App\Models\Scata\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function getShops() {

        return ShopResource::collection(Shop::where('active', true)->get());

    }

    public function create(Request $request) {

        $shop = new Shop;

        $shop->name = $request->name;
        $shop->street = $request->street;
        $shop->zipcode = $request->zipcode;
        $shop->country = $request->country;
        $shop->city = $request->city;
        $shop->active = true;

        $shop->save();

        return ShopResource::collection(Shop::where('active', true)->get());

    }

}
