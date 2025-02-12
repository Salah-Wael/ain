<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Head\HeadHomeController;
use App\Http\Controllers\Head\Auth\PasswordController;
use App\Http\Controllers\Head\Auth\NewPasswordController;
use App\Http\Controllers\Head\Auth\VerifyEmailController;
use App\Http\Controllers\Head\HeadOfDepartmentController;
use App\Http\Controllers\Head\Auth\RegisteredUserController;
use App\Http\Controllers\Head\Auth\PasswordResetLinkController;
use App\Http\Controllers\Head\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Head\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Head\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Head\Auth\EmailVerificationNotificationController;

Route::prefix('/head-of-department')->name('head.')->group(function () {
    Route::get('home', HeadHomeController::class)->middleware('guardauth:head')->name('index');
});

Route::prefix('/head-of-department')->name('head.')->middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

});

Route::controller(HeadOfDepartmentController::class)->group(function () {
    Route::get('/head_of_departments', 'index')->name('head_of_departments.index');
    Route::get('/head_of_department/create', 'create')->name('head_of_departments.create');
    Route::post('/head_of_department', 'store')->name('head_of_departments.store');
    Route::get('/head_of_department/{head_of_department}/edit', 'edit')->name('head_of_departments.edit');
    Route::put('/head_of_department/{head_of_department}', 'update')->name('head_of_departments.update');
    Route::delete('/head_of_department/{head_of_department}', 'destroy')->name('head_of_departments.destroy');
});
