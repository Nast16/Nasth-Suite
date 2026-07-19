<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CashbookController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\DisableHeadersCache;
use Illuminate\Support\Facades\Route;

// 1. Route bawaan Breeze (Login, Register, Logout, dll)
require __DIR__.'/auth.php';

// 2. KELOMPOK ROUTE NASTH SUITE (Wajib Login)
Route::middleware(['auth'])->group(function () {
    
    // Halaman Dashboard Utama Nasth Suite
    Route::get('/', [DashboardController::class, 'index'])->middleware(DisableHeadersCache::class);

    // Modul Produk / Inventory
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::post('/products/{id}/sell', [ProductController::class, 'sell']);
    Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Modul Buku Kas / Cashbook
    Route::get('/cashbook', [CashbookController::class, 'index']);
    Route::post('/cashbook', [CashbookController::class, 'store']);

    // Modul Tugas / Tasks
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::post('/tasks/{id}/complete', [TaskController::class, 'complete']);

    // Route Pengaturan Modul Organisasi
    Route::get('/settings', [DashboardController::class, 'settings']);
    Route::put('/settings', [DashboardController::class, 'updateSettings']);

    // Route Manajemen Karyawan (Hanya untuk Owner)
    Route::get('/employees', [DashboardController::class, 'employees']);
    Route::post('/employees', [DashboardController::class, 'storeEmployee']);
});