<?php
namespace App\Modules\Authentication\Domain\Actions;

use App\Modules\Authentication\Domain\DataTransferObjects\UpdateUserDto;
use App\Modules\Authentication\Domain\DataTransferObjects\VerifyUserCodeDto;
use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Authentication\Domain\Models\UserVerificationCode;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class VerifyUserCodeAction
{
    private DeleteVerificationCodeAction $deleteVerificationCodeAction;

    public function __construct(
        DeleteVerificationCodeAction $deleteVerificationCodeAction
    ) {
        $this->deleteVerificationCodeAction = $deleteVerificationCodeAction;
    }

    public function __invoke(VerifyUserCodeDto $verifyUserCodeDto): bool
    {
        $userVerifyCode = UserVerificationCode::where([
            ['user_id', '=', $verifyUserCodeDto->user_id],
            ['code', '=', $verifyUserCodeDto->code],
            ['user_verification_code_type_id', '=', 1]
        ])->first();

        $user = User::where('id', $verifyUserCodeDto->user_id)->first();
        $user->email_verified_at = now();
        $user->save();

        ($this->deleteVerificationCodeAction)($userVerifyCode);

        return true;
    }
}
