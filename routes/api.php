<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Finance\CashflowController;
use App\Http\Controllers\Api\Finance\LaporanKeuanganController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * Ini Route API buat Cash Flow dan Rekonsiliasi Validasi
 */
Route::get('/cash-flow', [CashflowController::class, 'index']);
Route::post('/cash-flow/', [CashflowController::class, 'store']);
Route::get('/cash-flow/{id}', [CashflowController::class, 'show']);
Route::put('/cash-flow/{id}', [CashflowController::class, 'update']);
Route::delete('/cash-flow/{id}', [CashflowController::class, 'destroy']);

/**
 * ini Route API buat laporan keuangan
 */
Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index']);
Route::post('/laporan-keuangan', [LaporanKeuanganController::class, 'store']);
Route::get('/laporan-keuangan/{id}', [LaporanKeuanganController::class, 'show']);
Route::delete('/laporan-keuangan/{id}', [LaporanKeuanganController::class, 'update']);
Route::put('/laporan-keuangan/{id}', [LaporanKeuanganController::class, 'destroy']);
