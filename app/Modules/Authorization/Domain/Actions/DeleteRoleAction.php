<?php

namespace App\Modules\Authorization\Domain\Actions;

use Spatie\Permission\Models\Role;

class DeleteRoleAction
{
    public function __invoke(Role $role): ?bool
    {
        return $role->delete();
    }
}
