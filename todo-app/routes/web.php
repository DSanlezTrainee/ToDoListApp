<?php

use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
