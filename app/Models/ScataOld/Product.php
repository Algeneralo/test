<?php

namespace App\Models\ScataOld;

use App\Models\ScataOld\Pivot\ProductHasIngredients;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $connection = "scata";
    protected $table = "products";

    public $timestamps = false;

    public function ingredients() {

        return $this->morphToMany('App\Models\Scata\Ingredient', 'hasIngredient');

    }

    public function names() {

        return $this->hasMany(ProductName::class, 'product', 'id');

    }

    public function images() {

        return $this->hasMany(ProductImage::class, 'product', 'id');

    }

    public function nutrientGroups() {

        return $this->hasMany(ProductNutrientGroup::class, 'product', 'id');

    }

    /* Ingredient Control */

    public function removeIngredient(Ingredient $ingredient) {

        $this->ingredients()->detach($ingredient->id);

    }

    public function addIngredient(Ingredient $ingredient) {

        $this->ingredients()->attach($ingredient->id);

    }

    public function syncIngredient(Ingredient $ingredient) {

        $this->ingredients()->sync($ingredient->id);

    }

}
