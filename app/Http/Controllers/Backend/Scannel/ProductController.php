<?php

namespace App\Http\Controllers\Backend\Scannel;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Scata\Products\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\Scata\Ingredient;
use App\Models\Scata\Products\ProductImage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public $errors;
    public $message;

    public function __construct()
    {
        if (request()->route('category')) {
            $prefix = \request()->is("scannel/products/*") ? "products_" : "openproducts_";
            HelpDisk::checkIfExists($prefix . request()->route('category'));
        }
    }

    public function openproducts($category = null, Request $request)
    {

        if ($request->del != '') {

            Product::where('product_id', $request->del)->delete();
            $this->message = "Produkt " . $request->del . " wurde gelöscht";
        }

        $products = Product::where('type', $category)
            ->where('status', '!=', 'active')
            ->orderby('product_id', 'DESC')->get();

        return view('backend.scannel.openproducts')->with([
            'products' => $products,
        ])->with('message', $this->message);
    }

    public function products($category = null, Request $request)
    {

        if ($request->del != '') {

            Product::where('product_id', $request->del)->delete();
            $this->message = "Produkt " . $request->del . " wurde gelöscht";
        }

        $products = Product::where('type', $category)
            ->where('status', 'active')
            ->orderby('product_id', 'DESC')->get();

        return view('backend.scannel.products')->with([
            'products' => $products,
        ])->with('message', $this->message);

    }

    public function get_nutrients_precision()
    {
        return [
            'APPROXIMATELY' => 'ca.',
            'EXACT' => 'exakt',
            'LESS_THAN' => 'weniger als',

        ];
    }

    public function get_nutrients()
    {
        return [
            'ENER-' => 'Energie / Brennwert',
            'FAT' => 'Fett',
            'FASAT' => ' -gesättigte Fettsäuren',
            'FAMSCIS' => '-einfach ungesättigte Fettsäuren',
            'FAPUCIS' => '-mehrfach ungesättigte Fettsäuren',
            'CHOAVL' => 'Kohlenhydrate',
            'SUGAR-' => '-davon Zucker',
            'PRO-' => 'Eiweiß',
            'SALTEQ' => 'Salz',
            'FIBTG' => 'Ballaststoffe',
            'POLYL' => 'mehrwertige Alkohole',
            'STARCH' => 'Stärke',
            'BIOT' => 'Biotin',
            'CA' => 'Calcium',
            'CLD' => 'Chlor',
            'CR' => 'Chrom',
            'CU' => 'Kupfer',
            'FD' => 'Fluor',
            'FE' => 'Eisen',
            'FOLDFE' => 'Folsäure',
            'ID' => 'Jod',
            'K' => 'Kalium',
            'MG' => 'Magnesium',
            'MN' => 'Mangan',
            'MO' => 'Molybdän',
            'NA' => 'Natrium',
            'NIA' => 'Niacin',
            'P' => 'Phosphor',
            'PANTAC' => 'Pantothensäure',
            'RIBF' => 'Vitamin B2, Riboflavin',
            'SE' => 'Selen',
            'THIA' => 'Vitamin B1, Thiamin',
            'VITA-' => 'Vitamin A',
            'VITB12' => 'Vitamin B12, Cyanocobalamin',
            'VITB6-' => 'Vitamin B6, Pyridoxin',
            'VITC-' => 'Vitamin C',
            'VITD-' => 'Vitamin D',
            'VITE-' => 'Vitamin E',
            'VITK' => 'Vitamin K',
            'ZN' => 'Zink',
            'FRUCTOSE' => 'Fructose',
            'LACTOSE' => 'Lactose',
            'GLC' => 'Glukose',
            'MALTOSE' => 'Maltose',
            'SUCROSE' => 'Saccharose',
            'CARNITIN' => 'Carnitin',
            'CHLORID' => 'Chlorid',
            'FLUORID' => 'Fluorid',
            'INOSITOL' => 'Inositol',
            'LCP' => 'LCPs',
            'CHOLIN' => 'Cholin',
            'ALA' => 'Alpha-Linolensäure',
            'AA' => 'Arachidonsäure',
            'DHA' => 'Docosahexaensäure (DHA)',
            'LINOLEIDACID' => 'Linolsäure',
            'TAURIN' => 'Taurin',
            'OMEGA-3' => 'Omega-3-Fettsäuren',
            'OMEGA-6' => 'Omega-6-Fettsäuren',
            'BETA-CAROTIN' => 'Beta-Carotin, Provitamin A',
            'GLUCOMANNAN' => 'Glucomannan',
            'EPA' => 'Eicosapentaensäure',
            'G_HC' => 'Hydrogencarbonat',
            'S4+' => 'Sulfat',
            'NACL' => 'Kochsalz',
            'EDTA' => 'Calciumdinatrium-ethylendiamin-tetraacetat',
        ];
    }

    public function get_nutritional_value_unit()
    {
        return [
            'EA' => 'Each',
            'GR' => 'Gram',
            'GRM' => 'Gram',
            'KG' => 'Kilogram',
            'LT' => 'Litre',
            'MC' => 'Microgram',
            'MGM' => 'Milligram',
            'ME' => 'Milligram',
            'ML' => 'Millilitre',
            'PTN' => 'Portion',
            'MLT' => 'Millilitre',
            'KJO' => 'Kilojoule',
            'E14' => 'Kilokalorien'];
    }

    public function openproduct($productid = null, Request $request)
    {

        if ($request->edit != '') {
            $productid = $request->edit;
        }
        $allunits = $this->get_nutritional_value_unit();
        $allnutrients = $this->get_nutrients();
        $allprecision = $this->get_nutrients_precision();

        if ($productid != null) {
            $product = Product::where('product_id', $productid)->firstOrFail();
            if ($request->edit != '') {
                $product->status = 'inactive';
                $this->message = "Produktstatus wurde auf Inaktiv gesetzt";
                $product->update();
            }
            return view('backend.scannel.openproduct')->with([
                'product' => $product,
                'allunits' => $allunits,
                'allnutrients' => $allnutrients,
                'allprecision' => $allprecision,
                'message' => $this->message,
            ]);

        } else {      //neues Produkt erstellen
            $product = new Product;
            $product->product_id = "new";
            return view('backend.scannel.productcreate')->with([
                'product' => $product,
                'allunits' => $allunits,
                'allnutrients' => $allnutrients,
                'allprecision' => $allprecision,
            ]);
        }
    }

    public function product($productid = null, Request $request)
    {

        if ($request->release != '')
            $productid = $request->release;

        $allunits = $this->get_nutritional_value_unit();
        $allnutrients = $this->get_nutrients();
        $allprecision = $this->get_nutrients_precision();

        if ($productid != null) {
            $product = Product::where('product_id', $productid)->firstOrFail();

            if ($request->release != '') {
                $product->status = 'active';
                $this->message = "Produktstatus wurde auf Aktiv gesetzt";
                $product->update();
            }
            return view('backend.scannel.product')->with([
                'product' => $product,
                'allunits' => $allunits,
                'allnutrients' => $allnutrients,
                'allprecision' => $allprecision,
                'message' => $this->message,
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

        if ($request->id) {
            Product::where('product_id', $request->id)->delete();
            return Redirect::route('get.scannel.products');
        }

        return Redirect::route('get.scannel.products');
    }

    public function addImage(Product $product, $imageType, $file)
    {
        if ($file != null) {
            $extension = $file->getClientOriginalExtension(); // getting image extension

            if ($extension == 'jpeg') {
                $extension = 'jpg';
            }

            $filename = $imageType . '.' . $extension;
            $image = Image::make($file);
            Storage::disk('products')->put($product->product_id . '/' . $filename, $image->encode());
            $product->images()->updateOrCreate([
                'type' => $imageType,
            ], [
                'extension' => $image->mime(),
            ]);

            /*            $file->move('storage/products/' . $product->product_id . '/', $filename);

                        if( ProductImage::Where('product_id','=',$product->product_id)->where('type','=',$imageType)->first()  === null)
                        {
                            DB::insert('insert into product_images (product_id, type,extension) values (?, ?,?)', [$product->product_id, $imageType,$extension]);
                        }else{
                            $image = ProductImage::Where('product_id','=',$product->product_id)->where('type','=',$imageType)->first();
                            $image->type = $imageType;
                            $image->extension = $extension;
                            $image->update();
                        }*/
        }
    }

    public function save(Request $request)
    {

        if ($request->id) {

            $product = Product::where('product_id', $request->id)->firstOrFail();

            $product->product_name = $request->input('name');
            $product->regulated_name = $request->input('regulated_name');

            $product->eans()->delete();
            $product->eans()->create(['ean' => $request->ean]);

            $product->pzn = $request->input('pzn');
            $product->ingredienz_text_orig = $request->input('ingredienz_text_orig');
            if ($request->type != '')
                $product->type = implode(',', $request->type);

            //Bilder 'ean','ingredients_1','ingredients_2','ingredients_3','nutrients_1','nutrients_2','nutrients_3','product','photo','company','qualitySealer_1','qualitySealer_2'
            $this->addImage($product, 'product', $request->file('file_main'));
            $this->addImage($product, 'ean', $request->file('file_ean'));
            $this->addImage($product, 'ingredients_1', $request->file('file_ingredients_1'));
            $this->addImage($product, 'ingredients_2', $request->file('file_ingredients_2'));
            $this->addImage($product, 'ingredients_3', $request->file('file_ingredients_3'));
            $this->addImage($product, 'nutrients_1', $request->file('file_nutrients_1'));
            $this->addImage($product, 'nutrients_2', $request->file('file_nutrients_2'));
            $this->addImage($product, 'nutrients_3', $request->file('file_nutrients_3'));

            $allNewIngredients = $request->input('tosaveindb');

            if ($allNewIngredients != "") {
                $arr = explode(";", $allNewIngredients);

                // delete alle zuordnung zu prdoukt
                //Product_Ingredient::where('product_id',$product->product_id)->delete();
                $product->ingredients()->delete();
                foreach ($arr as &$value) {
                    if ($value == '')
                        continue;
                    $tmp_ingredient = Ingredient::where('slug', $value)
                        ->Where('type', '=', $product->type)
                        ->firstOrNew();
                    if ($tmp_ingredient->slug == '') {
                        $tmp_ingredient->name = ['de' => $value];
                        $tmp_ingredient->description = ['de' => ''];
                        $tmp_ingredient->slug = $value;
                        $tmp_ingredient->type = $product->type;
                        $tmp_ingredient->save();
                    }

                    //add alle neu
                    $product->addIngredient($tmp_ingredient);
                }
            }

            $product->update();
            return Redirect::route('get.scannel.openproduct', $product->product_id)
                ->with('message', 'Produkt wurde gespeichert!');

        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'ean' => 'required',
                'type' => 'required',
            ]);

            $validator->after(function ($validator) {
                if (request('name') != '' && Product::where('product_name', request('name'))->count() > 0)
                    $validator->errors()->add('field', 'Produkt mit diesem Namen existiert bereits!');
            });


            if ($validator->fails()) {
                return redirect('scannel/openproduct')
                    ->withErrors($validator)->withInput();
            }
            $product = new Product;

            $product->product_name = $request->input('name');
            $product->regulated_name = $request->input('regulated_name');
            $product->status = 'creating';
            $product->pzn = $request->input('pzn');
            $product->ingredienz_text_orig = $request->input('ingredienz_text_orig');

            if ($request->type != '')
                $product->type = implode(',', $request->type);

            $product->src_type = 'manuell';
            $product->bot_scan_source = $request->input('src_scan');
            $product->product_url = $request->input('url');


            $product->save();
            $product->eans()->create(['ean' => $request->ean]);
            return Redirect::route('get.scannel.openproduct', $product->product_id);
        }
    }

}
