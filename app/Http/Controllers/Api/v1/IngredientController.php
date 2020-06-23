<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Scata\IngredientCollection;
use App\Models\Scata\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class IngredientController extends Controller
{

    public function list($type) {

        return new IngredientCollection(Ingredient::where('type', 'like', '%' . $type. '%')->get());

    }

}
