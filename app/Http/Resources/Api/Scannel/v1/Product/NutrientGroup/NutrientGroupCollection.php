<?php

namespace App\Http\Resources\Api\Scannel\v1\Product\NutrientGroup;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NutrientGroupCollection extends ResourceCollection
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
