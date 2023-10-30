<?php

namespace App\Modules\Authorization\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Authorization\Domain\Actions\GrantUserPermissionAction;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;

class GrantUserPermissionController extends Controller
{
    public function __invoke(
        GrantUserPermissionAction $grantUserPermissionAction,
        User $user,
        Permission $permission
    ): JsonResponse {
        $this->authorize('grant', $permission);

        $grantUserPermissionAction($user, $permission);

        return ApiResponse::setMessage('Permission granted successfully')->execute();
    }
}
