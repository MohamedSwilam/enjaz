<?php

namespace App\Modules\Authentication\App\Requests;

use App\Modules\Authentication\Domain\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
        $userId = null;
        if ($this->email) {
            $user = User::where('email', $this->email)->first();
            if ($user) {
                $userId = $user->id;
            }
        }
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
            'code' => [
                'required',
                'exists:user_verification_codes,code,user_id,'.$userId.',user_verification_code_type_id,2',
            ],
            'password' => [
                'required',
                'confirmed'
            ],
        ];
    }
}
