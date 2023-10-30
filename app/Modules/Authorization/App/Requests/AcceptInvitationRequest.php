<?php

namespace App\Modules\Authorization\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptInvitationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => [
                'required',
                'confirmed',
                'min:6'
            ]
        ];
    }
}
