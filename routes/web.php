<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsSuper;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/admin', [AdminController::class, 'index'])->middleware('can:admin, App\Models\User')->name('admin');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', IsSuper::class])->group(function () {
    Route::get('/super', [SuperController::class, 'index'])->name('superAdmin');
    Route::get('/super/users', [UserController::class, 'index'])->name('superUsers');
});

require __DIR__ . '/auth.php';
