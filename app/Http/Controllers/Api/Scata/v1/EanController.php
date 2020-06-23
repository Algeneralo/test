<?php

namespace App\Http\Controllers\Api\Scata\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Scata\v1\Ean\Ean as EanResource;
use App\Models\Scata\Products\ProductEan;
use Illuminate\Http\Request;

class EanController extends Controller
{

    public function getEans() {

        return EanResource::collection(ProductEan::all());

    }

}
