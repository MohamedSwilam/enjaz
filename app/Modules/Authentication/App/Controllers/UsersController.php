<?php

namespace App\Modules\Authentication\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authentication\App\QueryBuilders\UserQueryBuilder;
use App\Modules\Authentication\App\Requests\CreateUserRequest;
use App\Modules\Authentication\App\Requests\RegisterUserRequest;
use App\Modules\Authentication\App\Requests\ResetPasswordRequest;
use App\Modules\Authentication\App\Requests\UpdateUserRequest;
use App\Modules\Authentication\App\Transformers\CustomTransformer;
use App\Modules\Authentication\App\Transformers\UserTransformer;
use App\Modules\Authentication\Domain\Actions\DeleteUserAction;
use App\Modules\Authentication\Domain\Actions\EditUserAction;
use App\Modules\Authentication\Domain\Actions\RegisterUserAction;
use App\Modules\Authentication\Domain\Actions\ResetPasswordAction;
use App\Modules\Authentication\Domain\Actions\StoreUserAction;
use App\Modules\Authentication\Domain\DataTransferObjects\CreateUserDto;
use App\Modules\Authentication\Domain\DataTransferObjects\RegisterUserDto;
use App\Modules\Authentication\Domain\DataTransferObjects\ResetPasswordDto;
use App\Modules\Authentication\Domain\DataTransferObjects\UpdateUserDto;
use App\Modules\Authentication\Domain\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UsersController extends Controller
{
    /**
     * @throws AuthorizationException
     */
    public function index(Request $request, UserQueryBuilder $userQueryBuilder): JsonResponse
    {
        $this->authorize('browse', User::class);

        return ApiResponse::indexResponse(
            $userQueryBuilder->paginate($request->input('paginate')?? 15),
            UserTransformer::class
        );
    }

    /**
     * @throws AuthorizationException
     */
    public function show(User $user): JsonResponse
    {
        $this->authorize('view', $user);

        return ApiResponse::showResponse($user->load(['roles', 'permissions']), UserTransformer::class);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(StoreUserAction $storeUserAction, CreateUserRequest $request): JsonResponse
    {
        $this->authorize('store', User::class);

        $user = $storeUserAction(CreateUserDto::fromRequest($request));

        return ApiResponse::createResponse($user, UserTransformer::class);
    }

    /**
     * @throws UnknownProperties
     */
    public function register(RegisterUserAction $registerUserAction, RegisterUserRequest $request): JsonResponse
    {
        $user = $registerUserAction(RegisterUserDto::fromRequest($request));

        return ApiResponse::createResponse($user, UserTransformer::class);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(EditUserAction $editUserAction, UpdateUserRequest $request, User $user): JsonResponse
    {
        $this->authorize('update', User::class);

        $user = $editUserAction($request->user(), $user, UpdateUserDto::fromRequest($request));

        return ApiResponse::updateResponse($user, UserTransformer::class);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(DeleteUserAction $deleteUserAction, User $user): JsonResponse
    {
        $this->authorize('destroy', $user);

        $deleteUserAction($user);

        return ApiResponse::deleteResponse();
    }

    public function personalInformation(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->allPermissions = $user->getAllPermissions();
        $user->mainRole = $user->roles[0];
        return ApiResponse::showResponse($user, UserTransformer::class);
    }

    public function resetPassword(ResetPasswordAction $resetPasswordAction, ResetPasswordRequest $request): JsonResponse
    {
        $resetPasswordAction(ResetPasswordDto::fromRequest($request));

        return ApiResponse::response([['success' => true]], CustomTransformer::class, 'Password updated successfully');
    }
}
