<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\DoctorHomeController;
use App\Http\Controllers\Doctor\Auth\PasswordController;
use App\Http\Controllers\Doctor\Auth\NewPasswordController;
use App\Http\Controllers\Doctor\Auth\VerifyEmailController;
use App\Http\Controllers\Doctor\Auth\RegisteredUserController;
use App\Http\Controllers\Doctor\Auth\PasswordResetLinkController;
use App\Http\Controllers\Doctor\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Doctor\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Doctor\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Doctor\Auth\EmailVerificationNotificationController;

Route::prefix('/doctor')->name('doctor.')->group(function () {
    Route::get('home', DoctorHomeController::class)->middleware('guardauth:doctor')->name('index');
});

Route::prefix('/doctor')->name('doctor.')->middleware('guest')->group(function () {

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

Route::controller(DoctorController::class)->group(function () {
    Route::get('doctors', 'index')->name('doctors.index'); // Show all doctors
    Route::get('doctor/create', 'create')->name('doctors.create'); // Show form to create a doctor
    Route::post('doctor', 'store')->name('doctors.store'); // Store new doctor
    Route::get('doctor/{id}/edit', 'edit')->name('doctors.edit'); // Show form to edit a doctor
    Route::put('doctor/{id}', 'update')->name('doctors.update'); // Update a doctor's details
    Route::delete('doctor/{id}', 'destroy')->name('doctors.destroy'); // Delete a doctor
});
