<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcuseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__ . '/student.php';
require __DIR__ . '/doctor.php';
require __DIR__ . '/head.php';
require __DIR__ . '/admin.php';

Route::get('/', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

Route::controller(ExcuseController::class)->name('excuses.')->group(function () {
    Route::get('excuses/create','create')->name('create');
    Route::post('excuses','store')->name('store');
    Route::get('student-excuses', 'studentExcuses')->name('student');
    Route::get('all-excuses','index')->name('index');
    Route::get('excuses/{id}/edit','edit')->name('edit');
    Route::put('excuses/{id}','update')->name('update');
    Route::patch('excuses/{id}/status', 'updateStatus')->name('update-status');
    Route::delete('excuses/{id}','destroy')->name('destroy');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
