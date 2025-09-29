<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->controller(TaskController::class)->group(function () {

    Route::get('/tasks', 'index')->name('tasks.index');
    Route::get('/tasks/create', 'create')->name('tasks.create');
    Route::post('/tasks', 'store')->name('tasks.store');
    Route::get('/tasks/{task}', 'show')->name('tasks.show');
    Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit');
    Route::put('/tasks/{task}', 'update')->name('tasks.update');
    Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'user' => Auth::user(),
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
