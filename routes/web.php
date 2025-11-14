<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Gudang\GudangController;
use App\Http\Controllers\Kasir\KasirController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Root redirect
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/konfigurasi', [AdminController::class, 'konfigurasi'])->name('admin.konfigurasi');
    Route::get('/kelola-akun', [AdminController::class, 'akun'])->name('admin.akun');

    // User Management (AJAX)
    Route::post('/user-management', [AdminController::class, 'storeUser'])->name('admin.user.store');
    Route::put('/user-management/{id}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('/user-management/{id}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
});

/*
|--------------------------------------------------------------------------
| FINANCE ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:finance'])->prefix('finance')->group(function () {
    Route::get('/kas', [FinanceController::class, 'kas'])->name('finance.kas');
    Route::get('/laporan', [FinanceController::class, 'laporan'])->name('finance.laporan');
    Route::get('/rekonsiliasi', [FinanceController::class, 'rekonsiliasi'])->name('finance.rekonsiliasi');
});

/*
|--------------------------------------------------------------------------
| GUDANG ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:gudang'])->prefix('gudang')->group(function () {
    Route::get('/barang', [GudangController::class, 'barang'])->name('gudang.barang');
    Route::get('/laporan-stok', [GudangController::class, 'laporan'])->name('gudang.laporan');
    Route::get('/manajemen', [GudangController::class, 'manajemen'])->name('gudang.manajemen');
});

/*
|--------------------------------------------------------------------------
| KASIR ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {
    Route::get('/transaksi', [KasirController::class, 'transaksi'])->name('kasir.transaksi');
    Route::get('/retur', [KasirController::class, 'retur'])->name('kasir.retur');
    Route::get('/laporan', [KasirController::class, 'laporan'])->name('kasir.laporan');
});