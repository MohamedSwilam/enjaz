<?php

namespace App\Modules\Authentication\Domain\Actions;

use App\Modules\Authentication\Domain\Models\User;

class AttachUserRolesAction
{
    public function __invoke(User $user, array $roles): User
    {
        return $user->syncRoles($roles);
    }
}
