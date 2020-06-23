<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EanSeachRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ean' => 'required'
        ];
    }
}
