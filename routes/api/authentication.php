<?php
use App\Modules\Authentication\App\Controllers\UsersController;
use App\Modules\Authentication\App\Controllers\VerificationsController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UsersController::class)
    ->except(['edit', 'create'])
    ->middleware(['auth:api', 'verified']);

Route::post('register', [UsersController::class, 'register']);

Route::post('reset-password', [UsersController::class, 'resetPassword']);

Route::post('send-verify-code', [VerificationsController::class, 'sendVerifyCode']);

Route::post('verify-email-code', [VerificationsController::class, 'verifyEmailCode']);

Route::get('personal-data', [UsersController::class, 'personalInformation'])
    ->middleware(['auth:api', 'verified']);
