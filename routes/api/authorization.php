<?php

use App\Modules\Authorization\App\Controllers\AssignUserRoleController;
use App\Modules\Authorization\App\Controllers\GrantUserPermissionController;
use App\Modules\Authorization\App\Controllers\PermissionsController;
use App\Modules\Authorization\App\Controllers\RemoveUserRoleController;
use App\Modules\Authorization\App\Controllers\RevokeUserPermissionController;
use App\Modules\Authorization\App\Controllers\RolePermissionsController;
use App\Modules\Authorization\App\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RolesController::class)
    ->middleware('auth:api')
    ->except(['create', 'edit']);

Route::resource('permissions', PermissionsController::class)
    ->middleware('auth:api')
    ->only(['index']);

Route::put('roles/{role}/permissions', RolePermissionsController::class)
    ->middleware('auth:api');

Route::post('users/{user}/roles/{role}', AssignUserRoleController::class)
    ->middleware('auth:api');

Route::delete('users/{user}/roles/{role}', RemoveUserRoleController::class)
    ->middleware('auth:api');

Route::post('users/{user}/permissions/{permission}', GrantUserPermissionController::class)
    ->middleware('auth:api');

Route::delete('users/{user}/permissions/{permission}', RevokeUserPermissionController::class)
    ->middleware('auth:api');