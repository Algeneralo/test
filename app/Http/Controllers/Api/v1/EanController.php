<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\EanSeachRequest;
use App\Models\Scata\Products\ProductEan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EanController extends Controller
{

    public function searchEan(EanSeachRequest $eanSeachRequest)
    {

        try {
            $ean = ProductEan::where('ean', $eanSeachRequest->input('ean'))->get();

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'data' => [
                    'msg' => __('error-messages.product-not-found')
                ]
            ], 404);

        }


        return \App\Http\Resources\Api\Scannel\v1\Product\Product::collection($ean->load(['product', 'product.ingredients', 'product.nutrients', 'product.images', 'product.nutrients.nutrients']));

    }

}
