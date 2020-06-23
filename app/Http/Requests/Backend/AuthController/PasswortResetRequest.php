<?php

namespace App\Http\Requests\Backend\AuthController;

use Illuminate\Foundation\Http\FormRequest;

class PasswortResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !$this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => [
                'confirmed',
                'required'
            ],
            'token' => [
                'required'
            ],
            'adminid' => [
                'required'
            ]
        ];
    }
}
