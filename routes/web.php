<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\BlindController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

// 1. Root: Halaman Cover
Route::get('/', function () {
    return view('welcome'); 
});

// 2. Auth: Login & Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Mengizinkan login baik via GET (jika redirect) maupun POST
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Lupa Password
Route::get('/lupa-password', [ForgotPasswordController::class, 'tampilkanFormReset'])->name('password.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'prosesReset'])->name('password.update');

// 3. Auth: Setup Profile (Step 2)
Route::get('/setup-profile', function () {
    return view('auth.setup-profile');
})->name('setup.profile');
Route::post('/setup-profile', [AuthController::class, 'updateProfile']);

// --- SEMUA ROUTE DI BAWAH INI WAJIB LOGIN ---
Route::middleware('auth')->group(function () {
    
    // Pilih Teman Tunanetra
    Route::get('/select-device', [DashboardController::class, 'selectDevice'])->name('select.device');
    Route::post('/add-device', [DashboardController::class, 'addDevice'])->name('add.device');
    
    // ROUTE HAPUS
    Route::delete('/delete-device/{id}', [DashboardController::class, 'destroy'])->name('delete.device');

    // Dashboard Monitoring
    Route::get('/dashboard/{id}', [DashboardController::class, 'index'])->name('dashboard');

    // --- FITUR BARU: API UNTUK LOG NOTIFIKASI REAL-TIME ---
    // Route ini menangani request fetch('/api/latest-sensor/...') dari JavaScript dashboard
    Route::get('/api/latest-sensor/{id}', function ($id) {
        // Mengambil data terbaru dari database. 
        // Pastikan nama model 'SensorData' sesuai dengan yang kamu pakai di project.
        $data = \App\Models\SensorData::where('device_id', $id)
                    ->latest()
                    ->first();

        return response()->json([
            'latest' => $data
        ]);
    });

    // Profile User
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');

    // KEAMANAN (Fitur Baru)
    Route::get('/security', [SecurityController::class, 'index'])->name('security.index');
    Route::put('/security', [SecurityController::class, 'updatePassword'])->name('security.update');

    Route::get('/blind-profile', [BlindController::class, 'index'])->name('blind.profile');
    Route::put('/blind-profile', [BlindController::class, 'update'])->name('blind.update');

    // SETTINGS
    Route::get('/settings', function () {
        $tunanetra = \App\Models\BlindUser::where('user_id', auth()->id())->first();
        return view('settings', compact('tunanetra'));
    })->name('settings');
    
    // PUSAT BANTUAN
    Route::get('/faq', function () {
        return view('faq'); 
    })->name('bantuan');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact.us');

    Route::get('/terms', function () {
        return view('terms');
    })->name('terms.conditions');
    
    Route::get('/guide', function () {
        return view('guide'); // Nama file: guide.blade.php
    })->name('guide.index');

    Route::get('/about', function () {
        return view('about');
    })->name('about.index');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});