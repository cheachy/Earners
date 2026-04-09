<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatchLogController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\SmsWebhookController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// SMS Webhook (Inbound from Keypad Phones)
Route::post('/api/sms/incoming', [SmsWebhookController::class, 'handle']);

// Protected App
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Catch Logs (The "Sea-to-Dock" logic)
    Route::get('/catch-log', [CatchLogController::class, 'index'])->name('catch-log.index');
    Route::post('/catch-log/acknowledge/{id}', [CatchLogController::class, 'acknowledgeSms'])->name('catch-log.acknowledge');
    Route::post('/catch-log/finalize/{id}', [CatchLogController::class, 'finalize'])->name('catch-log.finalize');

    // Payouts (The Ledger and SMS Receipts)
    Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::post('/payouts/notify/{id}', [PayoutController::class, 'notify'])->name('payouts.notify');
    
});