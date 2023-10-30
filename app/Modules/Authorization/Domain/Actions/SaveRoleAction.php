<?php

namespace App\Modules\Authorization\Domain\Actions;

use Spatie\Permission\Models\Role;

class SaveRoleAction
{
    private CreateRoleAction $createRoleAction;

    private AttachPermissionsToRoleAction $attachPermissionsToRoleAction;

    public function __construct(
        CreateRoleAction $createRoleAction,
        AttachPermissionsToRoleAction $attachPermissionsToRoleAction
    ) {

        $this->createRoleAction = $createRoleAction;
        $this->attachPermissionsToRoleAction = $attachPermissionsToRoleAction;
    }

    public function __invoke($data): Role
    {
        $role = ($this->createRoleAction)($data);

        ($this->attachPermissionsToRoleAction)($role, $data['permissions']);

        return $role;
    }
}
