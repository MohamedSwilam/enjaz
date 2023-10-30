<?php

namespace App\Modules\Authentication\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyUserCodeRequest extends FormRequest
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
            'user_id' => [
                'required',
                'exists:users,id'
            ],
            'code' => [
                'required',
                'exists:user_verification_codes,code,user_id,'.$this->user_id.',user_verification_code_type_id,1',
            ],
        ];
    }
}
