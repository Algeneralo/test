<?php

namespace App\Http\Resources\Api\Scata\v1\Shop;

use Illuminate\Http\Resources\Json\JsonResource;

class Shop extends JsonResource
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
            'shop_id' => $this->shop_id,
            'name' => $this->name,
            'street' => $this->street,
            'zipcode' => $this->zipcode,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }
}
