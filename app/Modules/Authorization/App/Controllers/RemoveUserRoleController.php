<?php

namespace App\Modules\Authorization\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Authorization\Domain\Actions\RemoveUserRoleAction;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class RemoveUserRoleController extends Controller
{
    public function __invoke(
        RemoveUserRoleAction $removeUserRoleAction,
        User $user,
        Role $role
    ): JsonResponse {
        $this->authorize('remove_role', $role);

        $removeUserRoleAction($user, $role);

        return ApiResponse::setMessage('Role removed successfully')->execute();
    }
}
