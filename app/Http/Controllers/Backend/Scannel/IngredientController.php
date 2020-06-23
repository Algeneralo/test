<?php

namespace App\Http\Controllers\Backend\Scannel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scata\Ingredient;
use App\Models\Scata\IngredientGroup;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class IngredientController extends Controller
{
    public $errors;
    public $message;

    public function ingredients($category = null, Request $request)
    {

        $message = "";
        if ($request->del != '') {

            Ingredient::where('id', $request->del)->delete();
            $message = "Zutat " . $request->del . " wurde gelöscht";
        }

        return view('backend.scannel.ingredient.ingredients')->with([
            'category' => $category
        ])->with('message', $message);
    }

    public function ingredientsAjax($category = null)
    {

        if ($category == null) {

            return \App\Http\Resources\Scata\Ingredient::collection(Ingredient::all());

        } else {

            return \App\Http\Resources\Scata\Ingredient::collection(Ingredient::where('type', $category)->get());

        }

    }

    public function ingredientsSearchAjax($category = null, Request $request) {

        if ($category == null) {

            return \App\Http\Resources\Scata\Ingredient::collection(Ingredient::where('name', 'like', '%"de":"' . $request->get('q') . '%')->get());

        } else {

            return \App\Http\Resources\Scata\Ingredient::collection(Ingredient::where('type', $category)->where('name', 'like', '%"de":"' . $request->get('q') . '%')->get());

        }

    }

    public function createAjax(Request $request) {

        if(!Ingredient::where('name', Str::slug($request->input('name')))->first()) {

            $ingredient = new Ingredient;

            $ingredient->name = ['de' => $request->input('name')];
            $ingredient->slug = Str::slug($request->input('name'));

            $ingredient->save();

            return new \App\Http\Resources\Scata\Ingredient($ingredient);

        }

        return new \App\Http\Resources\Scata\Ingredient(Ingredient::where('slug', Str::slug($request->input('name')))->first());

    }

    public function split($ingredientid, Request $request)
    {
        $ingredient = Ingredient::where('id', $ingredientid)->firstOrFail();
        $splitToIngre = "";
        if ($request->newsplit != '') {

            foreach ($request->newsplit as $_split) {
                if($splitIngredient = Ingredient::where('name', 'like', '%"de":"' . $_split . '"%')->first())
                {
                    foreach ($ingredient->products()->get() as $product) {
                        $product->addIngredient($splitIngredient);
                    }
                    $splitToIngre .= '<br>' . $_split;
                }
            }

            $ingredient->delete();

            return Redirect::route('get.scannel.ingredients', $ingredient->type)->with('message', "Split durchgeführt!!!<br>Zutat <b>" .
                $ingredient->slug . '</b> wurde zu folgenden Zutaten gesplittet:' . $splitToIngre
            );

        }

        return view('backend.scannel.ingredient.split')->with([
            'ingredient' => $ingredient,
            //'ingredients' => Ingredient::where('type', $ingredient->type)->get()
        ]);

    }

    public function ingredient($id = null, Request $request)
    {
        if ($id != null) {
            $ingredient = Ingredient::where('id', $id)->firstOrFail();
            return view('backend.scannel.ingredient.ingredient')->with([
                'ingredient' => $ingredient,
                'ingredientGroups' => IngredientGroup::where('type', $ingredient->type)->get(),
                'ingredients' => Ingredient::where('type', $ingredient->type)->get()
            ]);
        } else {
            $ingredient = new Ingredient;
            $ingredient->id = "new";
            return view('backend.scannel.ingredient.createingredient')->with([
                'ingredient' => $ingredient
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
            'editgroup' => null
        ]);

    }

    public function delete($id,Request $request)
    {
        if ($id) {
            $tmp = Ingredient::where('id', $id)->first();
            $_type = $tmp->type;
            $message = "Zutat '" . $tmp->name['de'] . "' wurde gelöscht";
            $tmp->delete();

            return Redirect::route('get.scannel.ingredients',$_type)
            ->with('message', $message);
        }
        return Redirect::route('get.scannel.ingredients','food');
    }

    public function save(Request $request)
    {

        if ($request->id) {
            $ingredient = Ingredient::where('id', $request->id)->firstOrFail();
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:ingredients|max:255',
                'type' => 'required',
            ]);
            $validator->after(function ($validator) {
                if (request('name') != '' && Ingredient::where('slug', request('name'))->count() > 0)
                    $validator->errors()->add('field', 'Zutat mit diesem Namen existiert bereits!');
            });
            if ($validator->fails()) {
                return redirect('scannel/ingredient/ingredient')
                    ->withErrors($validator)->withInput();
            }
            $ingredient = new Ingredient;

            $ingredient->slug = Str::slug($request->input('name'));

        }


        $name = $ingredient->name;
        $name['de'] = $request->input('name');
        $ingredient->name = $name;
        //$ingredient->slug = $request->input('name');

        $description = $ingredient->description;
        $description['de'] = $request->input('description');

        $ingredient->description = $description;

        /**
         * Manage Groups
         */

        $ingredient->ingredientGroups()->sync($request->input('groups'));

        /**
         * Manage Aliase
         */

        $ingredient->aliase()->sync($request->input('aliase'));

        /**
         * Replace
         */

        if($request->input('replacewith') != null) {    // this wird in allen Produkten ersetzt durch ein anderes ingredienz

            $replaceIngredient = Ingredient::find($request->input('replacewith'));

            foreach ($ingredient->products as $product) {

                $product->removeIngredient($ingredient);
                $product->addIngredient($replaceIngredient);
            }
            $ingredient->delete();
            $ingredient = $replaceIngredient;
        }

        if($request->input('replacethis') != null) { // this ersetzt in allen Produkten anderes ingredienz

            $replaceIngredient = Ingredient::find($request->input('replacethis'));

            foreach ($replaceIngredient->products as $product) {

                $product->removeIngredient($replaceIngredient);
                $product->addIngredient($ingredient);
            }
            $replaceIngredient->delete();

        }


        if ($request->type != '')
            $ingredient->type = implode(',', $request->type);

        if ($this->errors == "") {
            if ($request->id) {
                $this->message = 'Zutat wurde gespeichert!';
                $ingredient->update();
            } else {
                $this->message = 'Zutat wurde gespeichert!';
                $ingredient->save();
            }
        }

        return Redirect::route('get.scannel.ingredient', $ingredient->id)
            ->withErrors(["your_custom_error" => $this->errors])
            ->withInput()
            ->with('message', $this->message);

    }
}
