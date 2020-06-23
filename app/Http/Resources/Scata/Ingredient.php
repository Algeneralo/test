<?php

namespace App\Http\Resources\Scata;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class Ingredient extends JsonResource
{

    private $replaceSearch = [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '0',
        '(',
        ')',
        '%',
        '.'
        ];

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
            'name' => $this->name[$locale],
            'type' => $this->type,
            'updated_at' => \Carbon\Carbon::parse($this->updated_at)->format('d.m.Y H:i')
        ];

    }
}
