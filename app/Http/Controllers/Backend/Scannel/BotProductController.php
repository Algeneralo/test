<?php

namespace App\Http\Controllers\Backend\Scannel;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Bot\Bot_Product;
use App\Models\Bot\Bot_Seals;
use App\Models\Bot\Bot_Food_Values;
use App\Models\Bot\Bot_Food_Val_Scheme;
use App\Models\Bot\Bot_Country;

class BotProductController extends Controller
{
    public function __construct()
    {
        $this->middleware("concurrent.operations:App\Models\Bot\Bot_Product")->only("save", "product");

        if (request()->route('category')){
            $category = is_numeric(request()->route('category')) ? Bot_Product::where('id', request()->route('category'))->firstOrFail()->productType : request()->route('category');
            HelpDisk::checkIfExists("bot_products_" . $category);
        }
    }

    public function products($category = null, Request $request)
    {

        if ($category == null) {
            $products = Bot_Product::orderby('id', 'DESC')
                ->where('display_name', '<>', '')
                ->where('ingredients', '<>', '')
                ->limit(20)
                ->get();

        } else {
            $products = Bot_Product::where('productType', $category)
                ->whereNull('transfer')
                ->where('display_name', '<>', '')
                ->where('ingredients', '<>', '')
                ->limit(20)
                ->get();
        }

        return view('backend.scannel.bot.products')->with([
            'products' => $products,
        ]);

    }

    public function product($productid = null, Request $request)
    {

        if ($productid != null) {
            $product = Bot_Product::where('id', $productid)->firstOrFail();

            $seals = Bot_Seals::where('ean', $product->ean)->where('source', '=', $product->source)->get();
            $foodvals = Bot_Food_Values::where('ean', $product->ean)->where('source', '=', $product->source)->get();
            $foodvalscheme = Bot_Food_Val_Scheme::where('ean', $product->ean)->where('source', '=', $product->source)->get();
            $country = Bot_Country::where('ean', $product->ean)->where('source', '=', $product->source)->get();

            return view('backend.scannel.bot.product')->with([
                'product' => $product,
                'seals' => $seals,
                'foodvals' => $foodvals,
                'foodvalscheme' => $foodvalscheme,
                'country' => $country,
            ]);

        }
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

    public function delete(Request $request)
    {

    }

    public function save(Request $request)
    {


        if ($request->id) {

            $product = Bot_Product::where('id', $request->id)->firstOrFail();
            $seals = Bot_Seals::where('ean', $product->ean)->where('source', '=', $product->source)->get();
            $foodvals = Bot_Food_Values::where('ean', $product->ean)->where('source', '=', $product->source)->get();
            $foodvalscheme = Bot_Food_Val_Scheme::where('ean', $product->ean)->where('source', '=', $product->source)->get();
            $country = Bot_Country::where('ean', $product->ean)->where('source', '=', $product->source)->get();

            $product->display_name = $request->input('name');
            $product->regulated_name = $request->input('regulated_name');
            $product->ean = $request->input('ean');
            $product->pzn = $request->input('pzn');
            $product->company = $request->input('company');
            $product->ingredients = $request->input('ingredients');
            $product->source = $request->input('source');

            $product->update();
            return $this->product($product->id, $request);
//            return Redirect::route('get.scannel.bot.product')->with([
            //              'productid'           => $product->id
            //        ]);
        }


    }
}
