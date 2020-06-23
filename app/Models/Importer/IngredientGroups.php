<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class IngredientGroups extends Model
{

    protected $connection = "importer";

    public function group() {

        return $this->hasOne(self::class, 'id', 'ingredient_id');

    }

}
