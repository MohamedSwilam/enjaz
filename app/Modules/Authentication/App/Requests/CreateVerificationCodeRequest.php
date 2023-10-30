<?php

namespace App\Modules\Authentication\App\Requests;

use App\Modules\Authentication\App\Rules\CanSendVerifyCode;
use Illuminate\Foundation\Http\FormRequest;

class CreateVerificationCodeRequest extends FormRequest
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
            'user_verification_code_type_id' => [
                'required',
                'exists:user_verification_code_types,id'
            ],
            'email' => [
                'required',
                'exists:users,email',
                new CanSendVerifyCode()
            ],
        ];
    }
}
