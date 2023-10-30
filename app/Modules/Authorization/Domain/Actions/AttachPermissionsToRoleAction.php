<?php

namespace App\Modules\Authorization\Domain\Actions;

use Spatie\Permission\Models\Role;

class AttachPermissionsToRoleAction
{
    public function __invoke(Role $role, array $permissions)
    {
        $role->givePermissionTo($permissions);
    }
}
