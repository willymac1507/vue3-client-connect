<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/**
 * <strong>Dashboard route</strong>
 * @uses HomeController
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
})->name('home');

/**
 * <strong>Messages routes</strong>
 * @uses MessageController
 */
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

/**
 * <strong>Bookings routes</strong>
 * @uses BookingController
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bookings/all', [BookingController::class, 'index'])->name('allBookings');
    Route::get('/booking/{booking:id}/show', [BookingController::class, 'show'])->name('showBooking');
})->name('bookings');

/**
 * <strong>Profile routes</strong>
 * @uses ProfileController
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
})->name('profile');

/**
 * <strong>Calendar routes</strong>
 * @uses CalendarController
 */
Route::middleware('auth')->group(function () {
    Route::get('/calendar/edit', [CalendarController::class, 'edit'])->name('calendar.edit');
    Route::post('/calendar/{calendar:id}/store', [CalendarController::class, 'store'])->name('calendar.store');
})->name('calendar');

/**
 * <strong>Search routes</strong>
 * @uses SearchController
 */
Route::middleware('auth')->group(function () {
    Route::get('/search', [SearchController::class, 'search'])->name('search.search');
})->name('search');

/**
 * <strong>Users routes</strong>
 * @uses UserController
 */
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/{user:id}/show', [UserController::class, 'show'])->name('user.show')->can('view', 'user');
    Route::get('/user/create', [UserController::class, 'create'])->name('users.create')->can('create', User::class);
    Route::post('/users', [UserController::class, 'store'])->name('users.store')->can('create', User::class);
    Route::post('/user/{user:id}/update', [UserController::class, 'update'])->name('user.update')->can('update', 'user');
    Route::get('/user/{user:id}/edit', [UserController::class, 'edit'])->name('user.edit')->can('edit', 'user');
})->name('users');

/**
 * <strong>Services routes</strong>
 * @uses ServiceController
 */
Route::middleware('auth')->group(function () {
    Route::get('/services/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::post('/services/update', [ServiceController::class, 'update'])->name('services.update');
})->name('services');

/**
 * <strong>Organisations routes</strong>
 * @uses OrganisationController
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/organisations', [OrganisationController::class, 'index'])->name('organisations');
    Route::get('/organisation/{organisation:id}/show', [OrganisationController::class, 'show'])->name('organisation.show');
    Route::get('/organisations/create', [OrganisationController::class, 'create'])->name('organisation.create');
    Route::get('/organisation/{organisation:id}/edit', [OrganisationController::class, 'edit'])->name('organisation.edit');
    Route::post('/organisations', [OrganisationController::class, 'store'])->name('organisation.store');
    Route::post('/organisations/delete', [OrganisationController::class, 'destroy'])->name('organisations.destroy');
    Route::patch('/organisation/{organisation:id}/update', [OrganisationController::class, 'update'])->name('organisation.update');
})->name('organisations');

/**
 * <strong>Admin routes</strong>
 * @uses AdminController
 */
Route::middleware(['auth', 'verified', IsAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

/**
 * <strong>Superuser routes</strong>
 * @uses SuperController
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/super/dashboard', [SuperController::class, 'index'])->name('super.dashboard');
});

require __DIR__ . '/auth.php';
