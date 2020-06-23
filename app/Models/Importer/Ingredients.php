<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{

    protected $connection = 'importer';

    protected $table = 'ingredients';

    public function products() {

        return $this->hasManyThrough(Products::class, ProductHasIngredients::class, 'ingredient', 'id', 'id', 'product');

    }

    public function names() {

        return $this->hasMany(IngredientName::class, 'ingredient', 'id');

    }

    public function groups() {

        return $this->hasManyThrough(IngredientGroups::class, IngredientGroupIngredients::class, 'ingredient', 'id', 'id', 'ingredient_group');

    }

}
