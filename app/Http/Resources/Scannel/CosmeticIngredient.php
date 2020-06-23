<?php

namespace App\Http\Resources\Scannel;

use Illuminate\Http\Resources\Json\JsonResource;

class CosmeticIngredient extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->ingredient_id;
    }
}
