<?php

namespace App\Http\Resources\Api\Scannel\v1\Product\NutrientGroup\Nutrient;

use Illuminate\Http\Resources\Json\JsonResource;

class Nutrient extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'nutrient' => $this->nutrient,
            'precision' => $this->precision,
            'value' => $this->val,
            'unit' => $this->unit

        ];
    }
}
