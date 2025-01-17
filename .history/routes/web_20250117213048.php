<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcuseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\Back\PermissionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__ . '/auth.php';
require __DIR__ . '/adminAuth.php';
require __DIR__ . '/headAuth.php';
require __DIR__ . '/doctorAuth.php';

Route::prefix('/front')->name('front.')->group(function () {
    Route::get('/user', FrontHomeController::class)->middleware('auth')->name('index');
});



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
