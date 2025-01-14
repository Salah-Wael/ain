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

Route::prefix('/front')->name('front.')->group(function () {
    Route::get('/user', FrontHomeController::class)->middleware('auth')->name('index');
});

Route::prefix('/back')->name('back.')->middleware('admin')->group(function () {

    Route::get('/admin', BackHomeController::class)->name('index');
    Route::resource('admins', AdminController::class);

    Route::resource('permissions', PermissionController::class)->except(['show']);

    Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{role}/edit', 'edit')->name('edit');
        Route::put('/{role}', 'update')->name('update');
        Route::delete('/{role}', 'destroy')->name('destroy');
    });
});

Route::get('/', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

Route::prefix('/back')->name('excuses.')->middleware('admin')->group(
    function () {});

Route::get('excuses/create', [ExcuseController::class, 'create'])->name('create');
Route::post('excuses', [ExcuseController::class, 'store'])->name('store');
Route::get('all-excuses', [ExcuseController::class, 'index'])->name('index');
Route::get('excuses/{id}', [ExcuseController::class, 'show'])->name('excuses.show');
Route::get('excuses/{id}/edit', [ExcuseController::class, 'edit'])->name('excuses.edit');
Route::put('excuses/{id}', [ExcuseController::class, 'update'])->name('excuses.update');
Route::delete('excuses/{id}', [ExcuseController::class, 'destroy'])->name('excuses.destroy');



// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
