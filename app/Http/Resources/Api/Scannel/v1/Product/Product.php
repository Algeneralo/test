<?php

namespace App\Http\Resources\Api\Scannel\v1\Product;

use App\Http\Resources\Api\Scannel\v1\Product\Image\Image;
use App\Http\Resources\Api\Scannel\v1\Product\Ingredient\Ingredient;
use App\Http\Resources\Api\Scannel\v1\Product\NutrientGroup\NutrientGroup;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $profiles = array();
        $exclusions = array();

        $locale = App::getLocale();

        $productIngredients = $this->product->ingredients->pluck('id');
        $user = $request->user()->load(['profiles']);

        $profiles['placeholder'] = '';

        foreach ($user->profiles as $profile) {

            $profileData = $productIngredients->intersect($profile->exclusionsFood->pluck('ingredient_id'));

            $profiles[$profile->id] = $profileData->isEmpty();

            if(count($exclusions) == 0) {
                $exclusions = $profileData->flatten();
            } else {
                $exclusions = $exclusions->merge($profileData->flatten());
            }

            $exclusions = $exclusions->merge($profileData->flatten());

            //array_merge($exclusions, $profileData->flatten());

        }



        return [
            'ean' => $this->ean,
            'type' => $this->product->type,
            'name' => $this->product->product_name,
            'ingredients' => Ingredient::collection($this->product->ingredients),
            'images' => Image::collection($this->product->images),
            'nutrientgroups' => NutrientGroup::collection($this->product->nutrients),
            'profiles' => $profiles,
            'excludeIngredients' => $exclusions
        ];
    }
}
