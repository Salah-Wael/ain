<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExcuseController;
use App\Http\Controllers\Api\TaskAnswerController;
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
        Route::get('/create', 'create');
        Route::post('/', 'store');
        Route::get('/{excuse_id}', 'showMyExcuse');
        Route::put('/{id}', 'update');
        Route::delete('/{excuse}', 'destroy');
        Route::get('/{id}/edit', 'edit');
    });

Route::middleware('auth:sanctum')
    ->controller(TaskAnswerController::class)
    ->group(function () {
        Route::get('/get-student-tasks', 'getStudentAnswers');
        Route::post('/task-answer', 'store');
    });
