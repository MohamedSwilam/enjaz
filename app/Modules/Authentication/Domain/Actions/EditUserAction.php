<?php


namespace App\Modules\Authentication\Domain\Actions;

use App\Modules\Authentication\Domain\DataTransferObjects\UpdateUserDto;
use App\Modules\Authentication\Domain\Models\User;

class EditUserAction
{
    private UpdateUserAction $updateUserAction;

    private AttachUserRolesAction $attachUserRolesAction;

    private AttachUserPermissionsAction $attachUserPermissionsAction;

    public function __construct(
        UpdateUserAction $updateUserAction,
        AttachUserRolesAction $attachUserRolesAction,
        AttachUserPermissionsAction $attachUserPermissionsAction
    ) {
        $this->updateUserAction = $updateUserAction;
        $this->attachUserRolesAction = $attachUserRolesAction;
        $this->attachUserPermissionsAction = $attachUserPermissionsAction;
    }

    public function __invoke(User $actionOwner, User $user, UpdateUserDto $updateUserDto) : User
    {
        ($this->updateUserAction)($user, $updateUserDto);

        if ($actionOwner->hasPermissionTo('update_user_permissions')) {

            ($this->attachUserRolesAction)($user, $updateUserDto->roles);

            ($this->attachUserPermissionsAction)($user, $updateUserDto->permissions);

        }

        return $user;
    }
}
