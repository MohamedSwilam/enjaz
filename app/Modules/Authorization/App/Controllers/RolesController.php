<?php

namespace App\Modules\Authorization\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authorization\App\Requests\RoleRequest;
use App\Modules\Authorization\App\Transformers\RoleTransformer;
use App\Modules\Authorization\Domain\Actions\DeleteRoleAction;
use App\Modules\Authorization\Domain\Actions\SaveRoleAction;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('browse', Role::class);

        return ApiResponse::indexResponse(Role::with('permissions')->get(), RoleTransformer::class);
    }

    public function show(Role $role): JsonResponse
    {
        $this->authorize('view', Role::class);

        return ApiResponse::showResponse($role->load('permissions'), RoleTransformer::class);
    }

    public function store(SaveRoleAction $saveRoleAction, RoleRequest $request): JsonResponse
    {
        $this->authorize('store', Role::class);

        $role = $saveRoleAction($request->validated());

        return ApiResponse::createResponse($role, RoleTransformer::class);
    }

    public function destroy(DeleteRoleAction $deleteRoleAction, Role $role): JsonResponse
    {
        $this->authorize('destroy', $role);

        $deleteRoleAction($role);

        return ApiResponse::deleteResponse();
    }
}
