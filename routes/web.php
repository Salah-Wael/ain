<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ExcuseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TaskAnswerController;
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

            // middleware(['role:Super-Admin|Admin,admin'])
            // middleware('role:Doctor,doctor')
            // middleware('role:Student')

Route::controller(SubjectController::class)->group(function () {
    Route::get('subjects', 'index')->middleware(['role:Super-Admin|Admin,admin'])->name('subjects.index');
    Route::get('doctor/subjects', 'doctorSubject')->middleware('role:Doctor,doctor')->name('subjects.doctor');
    Route::get('student/subjects', 'studentSubject')->middleware('role:Student')->name('subjects.student');
    Route::post('subjects/student/register', 'storeStudentRegisterSubjects')->middleware('role:Student')->name('subjects.student.register');
    Route::get('get/subjects/student/register', 'subjectsStudentMayRegister')->middleware('role:Student')->name('subjects.student.may.register');
    Route::get('subject/create', 'create')->middleware(['role:Super-Admin|Admin,admin'])->name('subjects.create');
    Route::post('subject', 'store')->middleware(['role:Super-Admin|Admin,admin'])->name('subjects.store');
    Route::get('subject/{subject}', 'show')->name('subjects.show');
    Route::get('subject/{subject}/edit', 'edit')->middleware(['role:Super-Admin|Admin,admin'])->name('subjects.edit');
    Route::put('subject/{subject}', 'update')->middleware(['role:Super-Admin|Admin,admin'])->name('subjects.update');
    Route::delete('subject/{subject}', 'destroy')->middleware(['role:Super-Admin|Admin,admin'])->name('subjects.destroy');
});

Route::controller(LectureController::class)->group(function () {
    Route::post('/lectures', 'store')->name('lectures.store');
    Route::get('/lectures/create', 'create')->name('lectures.create'); // Changed to GET
    Route::get('/lectures/{lecture}/edit', 'edit')->name('lectures.edit'); // Corrected to include {lecture}
    Route::delete('/lectures/{lecture}', 'destroy')->name('lectures.destroy');
});

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index')->name('tasks.index');
    Route::post('/task', 'store')->name('tasks.store');
    Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit');
    Route::put('/tasks/{task}', 'update')->name('tasks.update');
    Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
});

Route::controller(TaskAnswerController::class)->name('task-answers.')->group(function () {
    Route::post('/taskddd-answers', 'store')->middleware('role:Student')->name('store');
});

Route::post('/lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('changeLang');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
