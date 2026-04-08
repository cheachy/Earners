<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CatchLogController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\InventoryController;

// Change the default route to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('/catch-log', [CatchLogController::class, 'index'])->name('catch-log.index');
    Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
});