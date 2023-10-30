<?php

namespace App\Modules\Authentication\App\Rules;

use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Authentication\Domain\Models\UserVerificationCode;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CanSendVerifyCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = User::where('email', request()->email)->first();

        if ($user) {
            $userCode = UserVerificationCode::where([
                ['user_id', $user->id],
                ['user_verification_code_type_id', request()->user_verification_code_type_id],
            ])->whereBetween('created_at', [now()->subMinutes(1), now()])->first();

            if($userCode) {
                $fail('Cannot resend verification code before passing 60 seconds');
            }

            if (request()->user_verification_code_type_id === 1) {
                if ($user->email_verified_at !== NULL) {
                    $fail('User already has verified his email');
                }
            }
        }
    }
}
