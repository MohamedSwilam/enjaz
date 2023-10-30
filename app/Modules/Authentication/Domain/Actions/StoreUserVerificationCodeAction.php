<?php


namespace App\Modules\Authentication\Domain\Actions;


use App\Modules\Authentication\App\Mails\ResetPassword;
use App\Modules\Authentication\App\Mails\VerifyEmail;
use App\Modules\Authentication\Domain\DataTransferObjects\CreateUserVerificationCodeDto;
use App\Modules\Authentication\Domain\Models\User;
use Illuminate\Support\Facades\Mail;

class StoreUserVerificationCodeAction
{
    private CreateUserVerificationCodeAction $createUserVerificationCodeAction;

    public function __construct(
        CreateUserVerificationCodeAction $createUserVerificationCodeAction,
    ) {
        $this->createUserVerificationCodeAction = $createUserVerificationCodeAction;
    }

    public function __invoke(CreateUserVerificationCodeDto $createUserVerificationCodeDto): User
    {
        ($this->createUserVerificationCodeAction)($createUserVerificationCodeDto);

        $user = User::where('email', $createUserVerificationCodeDto->email)->first();

        if ($createUserVerificationCodeDto->user_verification_code_type_id === 1) {
            Mail::to($user->email)->send(
                new VerifyEmail(
                    $user->name,
                    $createUserVerificationCodeDto->code
                )
            );
        } else if ($createUserVerificationCodeDto->user_verification_code_type_id === 2) {
            Mail::to($user->email)->send(
                new ResetPassword(
                    $user->name,
                    $createUserVerificationCodeDto->code
                )
            );
        }

        return $user;
    }
}
