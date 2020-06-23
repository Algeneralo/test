<?php

namespace App\Http\Resources\Scannel;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class Profile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'personalData' => [
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'date_of_birth' => $this->date_of_birth,
                'gender' => $this->gender,
                'phone' => $this->phone,
                'bodyweight' => $this->bodyweight,
                'height' => $this->height,
                'avatar' => URL::signedRoute('profile-avatar', ['profile' => $this->id]),
                'main' => $this->main
            ],
            'excludeionFoodIngredients' => FoodIngredient::collection($this->whenLoaded('exclusionsFood')),
            'excludeionCosmeticIngredients' => CosmeticIngredient::collection($this->whenLoaded('exclusionsCosmetic')),
        ];
    }
}
