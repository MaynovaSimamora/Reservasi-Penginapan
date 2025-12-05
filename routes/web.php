<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', [HomeController::class, 'landing'])->name('landing');
Route::get('/rooms/{room:slug}', [HomeController::class, 'showRoom'])->name('rooms.show');

// Auth (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// USER: booking & riwayat (harus login dan role user)
Route::middleware(['auth', 'can:isUser'])->group(function () {
    Route::post('/rooms/{room:slug}/reserve', [ReservationController::class, 'store'])
        ->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])
        ->name('reservations.show');
    Route::get('/my-reservations', [ReservationController::class, 'myReservations'])
        ->name('reservations.my');
    Route::post('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])
        ->name('reservations.cancel');

});

// ADMIN: kelola kamar & reservasi
Route::middleware(['auth', 'can:isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.rooms.index');
        });

        Route::resource('rooms', RoomController::class);

        Route::get('reservations', [ReservationController::class, 'adminIndex'])
            ->name('reservations.index');
        Route::post('reservations/{reservation}/status',
            [ReservationController::class, 'updateStatus'])
            ->name('reservations.updateStatus');
    });
