<?php

namespace App\Http\Resources\Scannel;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FoodIngredientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
