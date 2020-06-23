<?php

namespace App\Http\Resources\Scata;

use App\Models\Scannel\AppUser;
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

        $productIngredients = $this->ingredients->pluck('id');
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
            'type' => $this->type,
            'name' => $this->whenLoaded('names', function() use ($locale) {
                $nameItem = $this->names->where('lang', $locale)->first();
                return ($nameItem) ? trim(str_replace($this->replaceSearch, '', $nameItem->name)) : null;
            }),
            'ingredients' => Ingredient::collection($this->whenLoaded('ingredients')),
            'images' => ProductImage::collection($this->whenLoaded('images')),
            'nutrientgroups' => NutrientGroup::collection($this->whenLoaded('nutrientGroups')),
            'profiles' => $profiles,
            'excludeIngredients' => $exclusions
        ];
    }
}
