<?php

namespace App\Http\Controllers\Backend\Scata;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use App\Jobs\OCR\StartOCR;
use App\Models\Scata\Ingredient;
use App\Models\Scata\Producer;
use App\Models\Scata\Products\Product;
use App\Models\Scata\Products\ProductImage;
use App\Models\Scata\QualitySeal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function __construct()
    {
        if (request()->route('category'))
            HelpDisk::checkIfExists("scata_products" . request()->route('category'));
    }

    public function products($category = null, Request $request)
    {

        if ($category == null) {

            if ($request->user()->can('products_all')) {

                $products = Product::orderby('product_id', 'DESC')->where('status', '!=', 'active')->get();

            } else {

                $products = Product::where('admin_id', $request->user()->admin_id)->orderby('product_id', 'DESC')->where('status', '!=', 'active')->get();

            }

        } else {

            if ($request->user()->can('products_all')) {

                $products = Product::orderby('product_id', 'DESC')->where('status', '!=', 'active')->where('type', $category)->get();

            } else {

                $products = Product::where('admin_id', $request->user()->admin_id)->orderby('product_id', 'DESC')->where('status', '!=', 'active')->where('type', $category)->get();

            }

        }

        return view('backend.scata.products.products')->with([
            'products' => $products,
        ]);

    }

    public function product(Product $product, Request $request)
    {

        $product->load(['images', 'producer', 'qualitySeals', 'nutrients', 'nutrients.nutrients']);

        return view('backend.scata.products.product')->with([
            'product' => $product,
            'producers' => Producer::all(),
            'qualityseals' => QualitySeal::all(),
        ]);

    }

    public function ocr(ProductImage $image)
    {

        $image->save();

        StartOCR::dispatch($image);

        return response()->json([
            'status' => 'started',
        ]);

    }

    public function update(Product $product, Request $request)
    {

        $product->update([
            'product_name' => $request->input('productname'),
            'regulated_name' => $request->input('regulated_name'),
        ]);

        $ingredients = explode(',', $request->input('ingredients'));

        $dbIngredients = [];

        foreach ($ingredients as $ingredient) {

            $dbIngredient = Ingredient::firstOrCreate([
                'slug' => Str::slug($ingredient),
            ]);

            $dbIngredient->name = [
                'de' => $ingredient,
            ];
            $dbIngredient->type = $product->type;
            $dbIngredient->save();

            array_push($dbIngredients, $dbIngredient->id);

        }

        if ($producer = Producer::find($request->input('producer'))) {

            $product->setProducer($producer);

        } elseif ($request->input('producer') != '') {

            $producer = new Producer;

            $producer->name = $request->input('producer');
            $producer->type = $product->type;
            $producer->provides_data = false;
            $producer->provides_data_vip = false;

            $producer->save();

            $product->setProducer($producer);

        }

        /* Nutrients */

        $nutrientGroup = $product->nutrients()->firstOrCreate([

            'servingsizeVal' => $request->nutrientgroup['value'],
            'servingsizeUnit' => $request->nutrientgroup['unit'],
            'preparationstate' => $request->nutrientgroup['state'],

        ]);

        foreach ($request->nutrients as $nutrient => $data) {

            if ($data['value'] != null) {

                $nutrientGroup->nutrients()->updateOrCreate([

                    'group_id' => $nutrientGroup->group_id,
                    'nutrient' => $nutrient,
                ], [
                    'precision' => $data['precision'],
                    'val' => $data['value'],
                    'unit' => $data['unit'],
                ]);

            }

        }

        $product->syncIngredient($dbIngredients);
        $product->syncQualitySeals($request->input('quality'));


        return Redirect::back();

    }

    public function editImage(Product $product, $type, Request $request)
    {

        $productImage = $product->images()->where('type', $type)->first();

        $image = Image::make(Storage::disk('products')->get($productImage->product_id . '/' . $productImage->type . '.jpg'));

        $image->contrast(round(($request->contrast - 100) * 0.39));
        $image->brightness(round(($request->brightness - 100) * 0.39));
        $image->rotate(round($request->crop['rotate'] * -1, 0));
        $image->crop(
            round($request->crop['width'], 0),
            round($request->crop['height'], 0),
            round($request->crop['x'], 0),
            round($request->crop['y'], 0)
        );

        Storage::disk('products')->put($productImage->product_id . '/' . $productImage->type . '.jpg', $image->encode());

        $productImage->updated_at = Carbon::now();
        $productImage->save();

        return response()->json([
            'return' => true,
        ]);

    }
}
