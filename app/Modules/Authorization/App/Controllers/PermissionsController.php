<?php

namespace App\Modules\Authorization\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authorization\App\Transformers\PermissionTransformer;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Permission::class);

        return ApiResponse::indexResponse(Permission::all(), PermissionTransformer::class);
    }
}
