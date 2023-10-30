<?php
namespace App\Modules\Authentication\Domain\Actions;

use App\Modules\Authentication\Domain\DataTransferObjects\CreateUserVerificationCodeDto;
use App\Modules\Authentication\Domain\DataTransferObjects\RegisterUserDto;
use App\Modules\Authentication\Domain\Models\User;
use Exception;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RegisterUserAction
{
    private AttachUserRolesAction $attachUserRolesAction;

    private StoreUserVerificationCodeAction $storeUserVerificationCodeAction;

    public function __construct(
        AttachUserRolesAction $attachUserRolesAction,
        StoreUserVerificationCodeAction $storeUserVerificationCodeAction
    ) {
        $this->attachUserRolesAction = $attachUserRolesAction;
        $this->storeUserVerificationCodeAction = $storeUserVerificationCodeAction;
    }

    /**
     * @throws UnknownProperties
     * @throws Exception
     */
    public function __invoke(RegisterUserDto $registerUserDto) : User
    {
        $user = User::create($registerUserDto->toArray());

        ($this->attachUserRolesAction)($user, [$registerUserDto->role]);

        ($this->storeUserVerificationCodeAction)(new CreateUserVerificationCodeDto(
            email: $user->email,
            user_verification_code_type_id: 1,
            code: random_int(100000, 999999),
        ));

        return $user;
    }
}
