<?php

namespace App\Modules\Authorization\Domain\Policies;

use App\Modules\Authentication\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    public function browse(User $user): bool
    {
        return $user->hasPermissionTo('browse_role');
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo('view_role');
    }

    public function store(User $user): bool
    {
        return $user->hasPermissionTo('create_role');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update_role');
    }

    public function destroy(User $user, Role $role): bool
    {
        return $user->hasPermissionTo('delete_role');
    }

    public function assign(User $user): bool
    {
        return $user->hasPermissionTo('assign_role');
    }
}
