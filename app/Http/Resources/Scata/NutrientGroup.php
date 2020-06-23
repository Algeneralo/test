<?php

namespace App\Http\Resources\Scata;

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
            'nutrients' => Nutrient::collection($this->whenLoaded('nutrients'))
        ];
    }
}
