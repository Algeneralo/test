<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class IngredientName extends Model
{

    protected $connection = "importer";

    protected $table = "ingredient_names";

}
