<?php

namespace App\Http\Resources\Api\Scannel\v1\Product\NutrientGroup;

use App\Http\Resources\Api\Scannel\v1\Product\NutrientGroup\Nutrient\Nutrient;
use Illuminate\Http\Resources\Json\JsonResource;

class NutrientGroup extends JsonResource
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
            'preparationstate' => $this->preparationstate,
            'servingsizeVal' => $this->servingsizeVal,
            'servingsizeUnit' => $this->servingsizeUnit,
            'nutrients' => Nutrient::collection($this->nutrients)
        ];
    }
}
