<?php

use App\Http\Controllers\SellerAuth\AuthenticatedSessionController;
use App\Http\Controllers\SellerAuth\ConfirmablePasswordController;
use App\Http\Controllers\SellerAuth\EmailVerificationNotificationController;
use App\Http\Controllers\SellerAuth\EmailVerificationPromptController;
use App\Http\Controllers\SellerAuth\NewPasswordController;
use App\Http\Controllers\SellerAuth\PasswordController;
use App\Http\Controllers\SellerAuth\PasswordResetLinkController;
use App\Http\Controllers\SellerAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:seller')->group(function () {

    Route::get('seller/login', [AuthenticatedSessionController::class, 'create'])
                ->name('seller.login');

    Route::post('seller/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('seller/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('seller.password.request');

    Route::post('seller/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('seller.password.email');

    Route::get('seller/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('seller.password.reset');

    Route::post('seller/reset-password', [NewPasswordController::class, 'store'])
                ->name('seller.password.store');
});

Route::middleware('auth:seller')->group(function () {
    Route::get('seller/verify-email', EmailVerificationPromptController::class)
                ->name('seller.verification.notice');

    Route::get('seller/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('seller.verification.verify');

    Route::post('seller/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('seller.verification.send');

    Route::get('seller/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('seller.password.confirm');

    Route::post('seller/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('seller/password', [PasswordController::class, 'update'])->name('seller.password.update');

    Route::post('seller/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('seller.logout');
});
