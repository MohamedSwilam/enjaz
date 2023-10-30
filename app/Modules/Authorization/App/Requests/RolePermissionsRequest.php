<?php

namespace App\Modules\Authorization\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissions' => [
                'required',
                'array',
            ],
            'permissions.*' => [
                'required',
                'exists:permissions,name',
            ],
        ];
    }
}
