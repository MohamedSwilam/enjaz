<?php

namespace App\Modules\Authentication\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'user_type_id' => [
                'required',
                'exists:user_types,id'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'avatar' => [
                'string',
                'max:255',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
            'role' => [
                'string',
                'required',
                'in:shopper',
            ],
            'password' => [
                'required',
                'confirmed'
            ],
        ];
    }
}
