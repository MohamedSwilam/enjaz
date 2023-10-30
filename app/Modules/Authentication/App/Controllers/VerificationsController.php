<?php

namespace App\Modules\Authentication\App\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\Facades\ApiResponse;
use App\Modules\Authentication\App\Requests\CreateVerificationCodeRequest;
use App\Modules\Authentication\App\Requests\VerifyUserCodeRequest;
use App\Modules\Authentication\App\Transformers\CustomTransformer;
use App\Modules\Authentication\App\Transformers\UserTransformer;
use App\Modules\Authentication\Domain\Actions\StoreUserVerificationCodeAction;
use App\Modules\Authentication\Domain\Actions\VerifyUserCodeAction;
use App\Modules\Authentication\Domain\DataTransferObjects\CreateUserVerificationCodeDto;
use App\Modules\Authentication\Domain\DataTransferObjects\VerifyUserCodeDto;
use Illuminate\Http\JsonResponse;

class VerificationsController extends Controller
{
    public function sendVerifyCode(
        StoreUserVerificationCodeAction $storeUserVerificationCodeAction,
        CreateVerificationCodeRequest $request
    ): JsonResponse
    {
        $user = $storeUserVerificationCodeAction(CreateUserVerificationCodeDto::fromRequest($request));

        return ApiResponse::createResponse($user, UserTransformer::class, ['success' => true], [], 'Verification code sent successfully');
    }

    public function verifyEmailCode(VerifyUserCodeAction $verifyUserCodeAction, VerifyUserCodeRequest $request): JsonResponse
    {
        $verifyUserCodeAction(VerifyUserCodeDto::fromRequest($request));

        return ApiResponse::response([['success' => true]], CustomTransformer::class, 'Verification code is valid');
    }
}
