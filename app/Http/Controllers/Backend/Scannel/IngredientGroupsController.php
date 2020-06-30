<?php

namespace App\Http\Controllers\Backend\Scannel;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scata\IngredientGroup;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class IngredientGroupsController extends Controller
{
    public $errors;
    public $message;

    public function __construct()
    {
        if (request()->route('category'))
        HelpDisk::checkIfExists( "ingredientgroups_" . request()->route('category'));

    }

    public function ingredientgroups($category = null, Request $request)
    {

        $message = "";
        if ($request->del != '') {

            IngredientGroup::where('id', $request->del)->delete();
            $message = "Ingredienz-Gruppe " . $request->del . " wurde gelöscht";
        }
        if ($category == null) {
            $groups = IngredientGroup::orderby('slug', 'DESC')->where('parentid', '=', '')
                ->get();
        } else {
            $groups = IngredientGroup::where('type', $category)->where('parentid', '=', '')
                ->get();
        }

        return view('backend.scannel.ingredient.ingredientgroups')->with([
            'groups' => $groups,
        ])->with('message', $message);
    }

    public function ingredientgroup($id = null, Request $request)
    {

        if ($id != null) {
            $group = IngredientGroup::where('id', $id)->firstOrFail();
            return view('backend.scannel.ingredient.ingredientgroup')->with([
                'ingredientgroup' => $group,
                'allingredientgroup' => IngredientGroup::where('type', $group->type)->get(),
                'allchieldingredientgroups' => IngredientGroup::where('parentid', $id)->get(),
            ]);
        } else {
            $group = new IngredientGroup;
            $group->id = "new";
            return view('backend.scannel.ingredient.createingredientgroup')->with([
                'ingredientgroup' => $group,
                'parentid' => $request->parentid,
                'allingredientgroup' => IngredientGroup::orderby('id', 'DESC')->get(),

            ]);
        }
    }

    public function save(Request $request)
    {

        if ($request->id) {
            $ingredientgrp = IngredientGroup::where('id', $request->id)->firstOrFail();
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:ingredients|max:255',
                'type' => 'required',
            ]);
            $validator->after(function ($validator) {
                if (request('name') != '' && IngredientGroup::where('slug', request('name'))->count() > 0)
                    $validator->errors()->add('field', 'Zutat mit diesem Namen existiert bereits!');
            });
            if ($validator->fails()) {
                return redirect('scannel/ingredient/ingredientgroup')
                    ->withErrors($validator)->withInput();
            }
            $ingredientgrp = new IngredientGroup;
        }

        $ingredientgrp->parentid = $request->parentgrp;


        $ingredientgrp->name = ['de' => $request->input('name')];
        $ingredientgrp->slug = $request->input('name');
        $ingredientgrp->description = $request->input('description');

        if ($request->type != '')
            $ingredientgrp->type = implode(',', $request->type);

        if ($this->errors == "") {
            $this->message = 'Gruppe wurde gespeichert!';
            if ($request->id) {
                $ingredientgrp->update();
            } else {
                $ingredientgrp->save();
            }
        }

        return Redirect::route('get.scannel.ingredientgroup', $ingredientgrp->id)
            ->withErrors(["your_custom_error" => $this->errors])
            ->withInput()
            ->with('message', $this->message);

    }
}
