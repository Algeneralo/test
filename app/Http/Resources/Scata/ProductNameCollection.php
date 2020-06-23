<?php

namespace App\Http\Resources\Scata;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductNameCollection extends ResourceCollection
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
