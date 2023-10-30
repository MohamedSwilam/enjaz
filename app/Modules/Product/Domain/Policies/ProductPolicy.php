<?php

namespace App\Modules\Product\Domain\Policies;

use App\Modules\Authentication\Domain\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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
        return $user->hasPermissionTo('browse_product');
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo('view_product');
    }

    public function store(User $user): bool
    {
        return $user->hasPermissionTo('create_product');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('update_product');
    }

    public function destroy(User $user): bool
    {
        return $user->hasPermissionTo('delete_product');
    }
}
