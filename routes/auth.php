<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('user-register', [RegisteredUserController::class, 'createUser'])
                ->name('user-register');

    Route::post('user-register', [RegisteredUserController::class, 'storeUser'])->name('register-user');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::get('login-riset', [AuthenticatedSessionController::class, 'createRiset'])->name('login-riset');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::post('login-riset', [AuthenticatedSessionController::class, 'storeRiset']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {

    Route::get('api/users', [RegisteredUserController::class, 'loadUsers']);
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('users', [RegisteredUserController::class, 'index']);
    Route::post('activate/{id}', [RegisteredUserController::class, 'activateUser']);
    Route::post('deactivate/{id}', [RegisteredUserController::class, 'deactivateUser']);
    Route::get('edit-profile/{id}', [RegisteredUserController::class, 'edit']);
    Route::post('edit/profile/{id}', [RegisteredUserController::class, 'update'])
                ->name('update.profile');

    
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::get('change-password', [PasswordResetLinkController::class, 'changePassword'])
                ->name('password.change');
    Route::post('change-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.change.email');
});
