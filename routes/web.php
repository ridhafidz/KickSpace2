<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute untuk Tamu (yang belum login) ---
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    // Menambahkan nama 'login.submit' untuk form action
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    // Mengubah nama rute agar sesuai dengan view
    Route::get('register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('register', [AuthController::class, 'register'])->name('register.submit');
});


// --- Rute untuk Pengguna yang Sudah Login ---
Route::middleware('auth')->group(function () {
    // Rute utama setelah login
    Route::get('/', function () {
        return view('layouts.main');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return view('layouts.main');
    })->name('layouts.main');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Menggunakan Route::resource untuk CRUD yang lebih rapi
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('venues', VenueController::class);
    Route::resource('events', EventController::class);
    Route::resource('bookings', BookingController::class);

    // Rute khusus untuk Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');
});
