<?php

namespace App\Http\Controllers\Api\Scata\v1;

use App\Http\Controllers\Controller;
use App\Jobs\OCR\StartOCR;
use App\Models\Scata\Products\Product;
use App\Models\Scata\Products\ProductEan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function createProduct(Request $request)
    {

        if($ean = ProductEan::where('ean', $request->ean)->first()) {


            return response()->json([
                'data' => [
                    'product_id' => $ean->product->product_id
                ]
            ]);


        }
        else {

            $product = new Product;
            $product->type = $request->type;
            $product->shop_id = $request->shop;
            $product->status = 'creating';
            $product->isscata = true;
            $product->admin_id = $request->user()->admin_id;

            $product->save();

            $product->eans()->create([
                'ean' => $request->ean
            ]);

        }



        return response()->json([
            'data' => [
                'product_id' => $product->product_id
            ]
        ]);

    }

    public function addImage(Product $product, $imageType, Request $request)
    {

        $image = Image::make($request->base64);

        Storage::disk('public')->put('products/' . $product->product_id . '/' . $imageType . '.jpg', $image->encode());



        $productImage = $product->images()->create([
            'type' => $imageType,
            'extension' => $image->mime(),
        ]);

        if($imageType == "ingredients_1") {

            StartOCR::dispatch($productImage);

        }

        Artisan::call('storage:link');

        return response()->json([
           'data' => [
               'status' => 'success'
           ]
        ]);

    }

}
