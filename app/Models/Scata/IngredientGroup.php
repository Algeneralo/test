<?php

namespace App\Models\Scata;

use Illuminate\Database\Eloquent\Model;

class IngredientGroup extends Model
{
    protected $table = 'ingredient_groups';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
        'type'
    ];

    protected $casts = [
        'name' => 'array'
    ];

    protected $appends = [
        'currentName'
    ];

    public function getCurrentNameAttribute() {

        return $this->name ?? '';

    }


    public function getParentSlug()
    {
        if ($this->parentid != "" && IngredientGroup::where('id', $this->parentid)->get()->count() > 0) {
            return IngredientGroup::where('id', $this->parentid)->firstOrFail()->slug;
        }
        return "";
    }

    public function chieldGroups()
    {
        return IngredientGroup::where('parentid', $this->id);
    }

    public function ingredients()
    {
        return HasIngredientGroups::where("ingredient_group_id", $this->id);
    }

}
