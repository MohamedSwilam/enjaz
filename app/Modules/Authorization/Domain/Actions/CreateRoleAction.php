<?php

namespace App\Modules\Authorization\Domain\Actions;

use Spatie\Permission\Models\Role;

class CreateRoleAction
{
    public function __invoke(array $data): Role
    {
        return Role::create($data);
    }
}
