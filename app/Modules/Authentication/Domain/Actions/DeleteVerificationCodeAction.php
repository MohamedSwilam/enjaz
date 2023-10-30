<?php

namespace App\Modules\Authentication\Domain\Actions;

use App\Modules\Authentication\Domain\Models\UserVerificationCode;

class DeleteVerificationCodeAction
{
    public function __invoke(UserVerificationCode $userVerificationCode): ?bool
    {
        return $userVerificationCode->delete();
    }
}
