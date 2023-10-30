<?php

namespace App\Modules\Authorization\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Authorization\Domain\Actions\AssignUserRoleAction;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class AssignUserRoleController extends Controller
{
    public function __invoke(AssignUserRoleAction $assignUserRoleAction, User $user, Role $role): JsonResponse
    {
        $this->authorize('assign', $role);

        $assignUserRoleAction($user, $role);

        return ApiResponse::setMessage('Role assigned successfully')->execute();
    }
}
