<?php

namespace App\Http\Resources\Scannel;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'email' => $this->email,
            'profiles' => Profile::collection($this->whenLoaded('profiles')),
        ];
    }
}
