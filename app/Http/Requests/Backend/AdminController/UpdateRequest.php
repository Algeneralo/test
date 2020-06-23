<?php

namespace App\Http\Requests\Backend\AdminController;

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
            'firstname' => [
                'required'
            ],
            'lastname' => [
                'required'
            ],
            'lang' => [
                'required'
            ],
            'roles' => [
                'required'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('admins', 'email')->ignore($this->route('admin'), 'admin_id')
            ],
            'password' => [
                'confirmed'
            ],
        ];
    }
}
