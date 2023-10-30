<?php

namespace App\Modules\Authorization\Domain\Actions;

use Spatie\Permission\Models\Role;

class UpdateRolePermissionsAction
{
    public function __invoke(Role $role, array $permissions): Role
    {
        return $role->syncPermissions($permissions);
    }
}
