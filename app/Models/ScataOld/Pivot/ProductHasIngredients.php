<?php

namespace App\Models\ScataOld\Pivot;

use Illuminate\Database\Eloquent\Model;

class ProductHasIngredients extends Model
{

    protected $connection = 'scata';

    protected $table = 'product_has_ingredients';

    public $incrementing = false;
    public $timestamps = false;

}
