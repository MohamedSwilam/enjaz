<?php
namespace App\Modules\Authentication\Domain\Actions;

use App\Modules\Authentication\Domain\DataTransferObjects\ResetPasswordDto;
use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Authentication\Domain\Models\UserVerificationCode;
use Illuminate\Support\Facades\Hash;

class ResetPasswordAction
{
    private DeleteVerificationCodeAction $deleteVerificationCodeAction;

    public function __construct(
        DeleteVerificationCodeAction $deleteVerificationCodeAction
    ) {
        $this->deleteVerificationCodeAction = $deleteVerificationCodeAction;
    }

    public function __invoke(ResetPasswordDto $resetPasswordDto): bool
    {
        $user = User::where('email', $resetPasswordDto->email)->first();

        $userVerifyCode = UserVerificationCode::where([
            ['user_id', '=', $user->id],
            ['code', '=', $resetPasswordDto->code],
            ['user_verification_code_type_id', '=', 2]
        ])->first();

        $user->password = Hash::make($resetPasswordDto->password);

        $user->save();

        ($this->deleteVerificationCodeAction)($userVerifyCode);

        return true;
    }
}
