<?php

namespace App\Modules\Authentication\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
                'unique:users,email,' . request()->user->id,
            ],
            'avatar' => [
                'string',
                'max:255',
            ],
            'is_active' => [
                'required',
                'boolean',
            ],
            'password' => [
                'required',
                'confirmed'
            ],
            'roles' => [
                'required',
                'array'
            ],
            'roles.*' => [
                'required',
                'exists:roles,name'
            ],
            'permissions' => [
                'nullable',
                'array'
            ],
            'permissions.*' => [
                'required',
                'exists:permissions,name'
            ],
        ];
    }
}
