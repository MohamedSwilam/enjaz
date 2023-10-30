<?php


namespace App\Modules\Authentication\Domain\Actions;


use App\Modules\Authentication\Domain\DataTransferObjects\CreateUserDto;
use App\Modules\Authentication\Domain\Models\User;

class StoreUserAction
{
    private CreateUserAction $createUserAction;

    private AttachUserRolesAction $attachUserRolesAction;

    private AttachUserPermissionsAction $attachUserPermissionsAction;

    public function __construct(
        CreateUserAction $createUserAction,
        AttachUserRolesAction $attachUserRolesAction,
        AttachUserPermissionsAction $attachUserPermissionsAction
    ) {
        $this->createUserAction = $createUserAction;
        $this->attachUserRolesAction = $attachUserRolesAction;
        $this->attachUserPermissionsAction = $attachUserPermissionsAction;
    }

    public function __invoke(CreateUserDto $createUserDto) : User
    {
        $user = ($this->createUserAction)($createUserDto);

        ($this->attachUserRolesAction)($user, $createUserDto->roles);

        ($this->attachUserPermissionsAction)($user, $createUserDto->permissions);

        return $user;
    }
}
