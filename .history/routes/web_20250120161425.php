<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcuseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

require __DIR__ . '/student.php';
require __DIR__ . '/doctor.php';
require __DIR__ . '/head.php';
require __DIR__ . '/admin.php';

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

Route::controller(SubjectController::class)->group(function () {
    Route::get('subjects', 'index')->name('subjects.index');

    // Create - Show the form to create a new subject
    Route::get('subjects/create', 'create')->name('subjects.create');

    // Store - Save a new subject
    Route::post('subjects', 'store')->name('subjects.store');

    // Show - Display a specific subject
    Route::get('subjects/{subject}', 'show')->name('subjects.show');

    // Edit - Show the form to edit a specific subject
    Route::get('subjects/{subject}/edit', 'edit')->name('subjects.edit');

    // Update - Update a specific subject
    Route::put('subjects/{subject}', 'update')->name('subjects.update');

    // Destroy - Delete a specific subject
    Route::delete('subjects/{subject}', 'destroy')->name('subjects.destroy');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
