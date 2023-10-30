<?php

namespace App\Modules\Authorization\Domain\Actions;

use App\Modules\Authentication\Domain\Models\User;
use Spatie\Permission\Models\Role;

class AssignUserRoleAction
{
    public function __invoke(User $user, Role $role): User
    {
        return $user->assignRole($role);
    }
}
