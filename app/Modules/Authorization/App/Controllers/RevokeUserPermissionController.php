<?php

namespace App\Modules\Authorization\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authentication\Domain\Models\User;
use App\Modules\Authorization\Domain\Actions\RevokeUserPermissionAction;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Permission;

class RevokeUserPermissionController extends Controller
{
    public function __invoke(
        RevokeUserPermissionAction $revokeUserPermissionAction,
        User $user,
        Permission $permission
    ): JsonResponse {
        $this->authorize('revoke', $permission);

        $revokeUserPermissionAction($user, $permission);

        return ApiResponse::setMessage('Permission revoked successfully')->execute();
    }
}
