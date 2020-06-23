<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *
     * TODO: Implement Max Profile
     *
     * public function authorize()
     * {
     * return !$this->user()->userProfile()->count();
     * }
     */
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
