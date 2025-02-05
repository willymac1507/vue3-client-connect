<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsClient;
use App\Http\Middleware\IsStudent;
use App\Http\Middleware\IsSuper;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/admin', [AdminController::class, 'index'])->middleware('can:admin, App\Models\User')->name('admin');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/messages/all', [MessageController::class, 'index'])->name('allMessages');
    Route::get('/messages/unread', [MessageController::class, 'unread'])->name('unreadMessages');
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('sentMessages');
    Route::get('/messages/flagged', [MessageController::class, 'flagged'])->name('flaggedMessages');
    Route::get('/message/{message:id}/show', [MessageController::class, 'show'])->name('showMessage');
    Route::patch('/message/{message:id}/read', [MessageController::class, 'toggleRead'])->name('toggleMessageRead');
    Route::patch('/message/{message:id}/flag', [MessageController::class, 'toggleFlag'])->name('toggleMessageFlag');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('createMessage');
    Route::post('/messages', [MessageController::class, 'store'])->name('storeMessage');
})->name('messages');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bookings/all', [BookingController::class, 'index'])->name('allBookings');
    Route::get('/booking/{booking:id}/show', [BookingController::class, 'show'])->name('showBooking');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', IsStudent::class])->group(function () {
    Route::get('/calendar/edit', [CalendarController::class, 'edit'])->name('calendar.edit');
    Route::post('/calendar/store', [CalendarController::class, 'store'])->name('calendar.store');
});

Route::middleware(['auth', IsClient::class])->group(function () {
    Route::get('/search', [SearchController::class, 'search'])->name('search.search');
});

Route::middleware(['auth', IsStudent::class])->group(function () {
    Route::get('/services/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::post('/services/update', [ServiceController::class, 'update'])->name('services.update');
});

Route::middleware(['auth', 'verified', IsAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::middleware(['auth', 'verified', IsSuper::class])->group(function () {
    Route::get('/super', [SuperController::class, 'index'])->name('superAdmin');
    Route::get('/super/users', [UserController::class, 'index'])->name('superUsers');
});

require __DIR__ . '/auth.php';
