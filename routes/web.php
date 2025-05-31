<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'dashboard'])->name('home');
Route::get('/home', [TaskController::class, 'dashboard'])->name('tasks.dashboard');

Route::prefix('tasks')->group(function () {
    // Public routes (no middleware)
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/{task}', [TaskController::class, 'create'])->name('tasks.show');
    // Authenticated routes (only auth middleware)
    Route::get('/create', [TaskController::class, 'create'])->middleware(['auth'])->name('tasks.create');
    Route::post('/store', [TaskController::class, 'store'])->middleware(['auth'])->name('tasks.store');
    // Authenticated and task ownership restricted routes
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->middleware(['auth', 'verify.user.task'])->name('tasks.edit');
    Route::put('/{task}/update', [TaskController::class, 'update'])->middleware(['auth', 'verify.user.task'])->name('tasks.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->middleware(['auth', 'verify.user.task'])->name('tasks.destroy');
    Route::put('/{task}/done', [TaskController::class, 'markDone'])->name('tasks.markDone');
});
Auth::routes();
