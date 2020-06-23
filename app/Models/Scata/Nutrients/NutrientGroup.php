<?php

namespace App\Models\Scata\Nutrients;

use Illuminate\Database\Eloquent\Model;

class NutrientGroup extends Model
{

    protected $table = 'nutrient_groups';
    protected $primaryKey = 'group_id';

    protected $fillable = [
        'servingsizeVal',
        'servingsizeUnit',
        'preparationstate'
    ];

    public function nutrients() {

        return $this->hasMany(GroupNutrient::class, 'group_id', 'group_id');

    }

}
