<?php

namespace App\Http\Resources\Api\Scannel\v1\Product\Ingredient;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class Ingredient extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $locale = App::getLocale();

        return [
            'id' => $this->id,
            'name' => $this->name[$locale]
        ];
    }
}
