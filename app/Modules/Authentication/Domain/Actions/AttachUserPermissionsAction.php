<?php

namespace App\Modules\Authentication\Domain\Actions;

use App\Modules\Authentication\Domain\Models\User;

class AttachUserPermissionsAction
{
    public function __invoke(User $user, ?array $permissions): User
    {
        if ($permissions) {
            return $user->syncPermissions($permissions);
        } else {
            return $user;
        }
    }
}
