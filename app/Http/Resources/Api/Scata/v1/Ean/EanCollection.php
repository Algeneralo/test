<?php

namespace App\Http\Resources\Api\Scata\v1\Ean;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
