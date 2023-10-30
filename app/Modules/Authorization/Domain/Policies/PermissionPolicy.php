<?php

namespace App\Modules\Authorization\Domain\Policies;

use App\Modules\Authentication\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Permission;

class PermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('browse_permission');
    }

    public function grant(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('grant_permission');
    }

    public function revoke(User $user, Permission $permission): bool
    {
        return $user->hasPermissionTo('revoke_permission');
    }
}
