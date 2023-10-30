<?php
namespace App\Modules\Authentication\Domain\Actions;

use App\Models\User;
use App\Modules\Authentication\Domain\DataTransferObjects\CreateUserVerificationCodeDto;
use App\Modules\Authentication\Domain\Models\UserVerificationCode;

class CreateUserVerificationCodeAction
{
    public function __invoke(CreateUserVerificationCodeDto $createUserVerificationCodeDto): UserVerificationCode
    {
        $user = User::where('email', $createUserVerificationCodeDto->email)->first();

        return UserVerificationCode::create([
            'user_id' => $user->id,
            'code' => $createUserVerificationCodeDto->code,
            'user_verification_code_type_id' => $createUserVerificationCodeDto->user_verification_code_type_id,
        ]);
    }
}
