<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'personalData.firstname' => [
                'required'
            ],
            'personalData.lastname' => [
                'required'
            ],
            'personalData.gender' => [
                'required'
            ]
        ];
    }
}
