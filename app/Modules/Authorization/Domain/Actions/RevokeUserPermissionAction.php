<?php

namespace App\Modules\Authorization\Domain\Actions;

use App\Modules\Authentication\Domain\Models\User;
use Spatie\Permission\Models\Permission;

class RevokeUserPermissionAction
{
    public function __invoke(User $user, Permission $permission): User
    {
        return $user->revokePermissionTo($permission);
    }
}
