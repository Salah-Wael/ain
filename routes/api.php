<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExcuseController;
use App\Http\Controllers\Api\StudentAuthController;

Route::post('login', [StudentAuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [StudentAuthController::class, 'logout']);
    Route::post('change-password', [StudentAuthController::class, 'changePassword']);
});

Route::middleware('auth:sanctum')
    ->controller(ExcuseController::class)
    ->prefix('excuses')
    ->group(function () {
        Route::get('/', 'studentExcuses');
        Route::post('/', 'store');
        Route::get('/{excuse}', 'show');
        Route::put('/{id}', 'update');
        Route::delete('/{excuse}', 'destroy');
        Route::get('/{id}/edit', 'edit');
    });
