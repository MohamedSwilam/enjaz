<?php

namespace App\Modules\Authentication\Domain\Policies;

use App\Modules\Authentication\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function browse(User $user): bool
    {
        return $user->hasPermissionTo('browse_user');
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo('view_user');
    }

    public function store(User $user): bool
    {
        return $user->hasPermissionTo('create_user');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update_user');
    }

    public function destroy(User $user): bool
    {
        return $user->hasPermissionTo('delete_user');
    }
}
