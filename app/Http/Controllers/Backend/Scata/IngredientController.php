<?php

namespace App\Http\Controllers\Backend\Scata;

use App\Http\Controllers\Controller;
use App\Models\Scata\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IngredientController extends Controller
{

    public function ingredients($category = null, Request $request) {

        if ($category == null) {

            $ingredients = Ingredient::orderby('id', 'DESC')->get();

        } else {

            $ingredients = Ingredient::where('type', $category)->get();

        }

        return view('backend.scata.ingredients.ingredients')->with([
            'ingredients' => $ingredients
        ]);

    }

    public function ingredient(Ingredient $ingredient, Request $request) {

        return view('backend.scata.ingredients.ingredient')->with([
            'ingredient' => $ingredient
        ]);

    }

    public function update(Ingredient $ingredient, Request $request) {

        $name = $ingredient->name;

        $name[app()->getLocale()] = $request->name;

        $ingredient->update([
            'name' => $name
        ]);

        return Redirect::back();

    }
}
