<?php

namespace App\Modules\Authorization\Domain\Actions;

use App\Modules\Authentication\Domain\Models\User;
use Spatie\Permission\Models\Role;

class RemoveUserRoleAction
{
    public function __invoke(User $user, Role $role): User
    {
        return $user->removeRole($role);
    }
}
