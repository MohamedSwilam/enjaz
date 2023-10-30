<?php

namespace App\Modules\Authorization\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authorization\App\Requests\RolePermissionsRequest;
use App\Modules\Authorization\App\Transformers\RoleTransformer;
use App\Modules\Authorization\Domain\Actions\UpdateRolePermissionsAction;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class RolePermissionsController extends Controller
{
    public function __invoke(
        UpdateRolePermissionsAction $updateRolePermissionsAction,
        RolePermissionsRequest $request,
        Role $role
    ): JsonResponse {
        $this->authorize('update', $role);

        $updateRolePermissionsAction($role, $request->validated());

        return ApiResponse::updateResponse($role, RoleTransformer::class);
    }
}
