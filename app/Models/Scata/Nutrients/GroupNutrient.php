<?php

namespace App\Models\Scata\Nutrients;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class GroupNutrient extends Model
{


    protected $table = 'group_nutrients';
    protected $primaryKey = ['group_id', 'nutrient'];

    public $incrementing = false;

    protected $fillable = [
        'nutrient',
        'precision',
        'val',
        'unit'
    ];

    public function getKey()
    {
        $attributes = [];

        foreach ($this->getKeyName() as $key) {
            $attributes[$key] = $this->getAttribute($key);
        }

        return $attributes;
    }

    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->where('group_id', $this->getAttribute('group_id'))
            ->where('nutrient', $this->getAttribute('nutrient'));
    }

}
