<?php

namespace App\Models\Scata;

use App\Models\Scata\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;

    protected $table = 'ingredients';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'type'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array'
    ];

    protected $appends = [
        'currentName'
    ];

    public function getCurrentNameAttribute() {

        return $this->name['de'];

    }

    public function products() {
        return $this->morphedByMany(Product::class, 'hasIngredient');
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    // Aliase
    public function aliase() {
        return $this->morphToMany(Ingredient::class, 'hasAliase');
    }
    public function removeAliase(Ingredient $ingredient) {
        $this->aliase()->detach($ingredient->id);
    }
    public function addAliase(Ingredient $ingredient) {
        $this->aliase()->attach($ingredient->id);
    }

    // ingredientGroups
    public function ingredientGroups() {
        return $this->morphToMany(IngredientGroup::class, 'hasIngredientGroup');
    }
    public function addIngredientGroup(IngredientGroup $group) {
        $this->ingredientGroups()->attach($group->id);
    }

}
