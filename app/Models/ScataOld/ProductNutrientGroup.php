<?php

namespace App\Models\ScataOld;

use Illuminate\Database\Eloquent\Model;

class ProductNutrientGroup extends Model
{

    protected $table = "product_nutrient_groups";

    public function nutrients()
    {

        return $this->hasMany(NutrientGroupNutrient::class, 'nutrient_group', 'id');

    }

}
