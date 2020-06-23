<?php

namespace App\Models\Importer;

use Illuminate\Database\Eloquent\Model;

class ProductHasIngredients extends Model
{

    protected $table = 'product_ingredients';

    public $incrementing = false;
    public $timestamps = false;

}
