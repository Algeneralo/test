<?php

namespace App\Http\Resources\Api\Scata\v1\Ean;

use Illuminate\Http\Resources\Json\JsonResource;

class Ean extends JsonResource
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
            'ean' => $this->ean
        ];
    }
}
