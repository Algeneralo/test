<?php

namespace App\Http\Requests\Backend\AppUserController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'scannelid' => [
                'required',
                Rule::unique('app_users', 'scannelid')->ignore($this->route('user'), 'id')
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('app_users', 'email')->ignore($this->route('user'), 'id')
            ],
        ];
    }
}
