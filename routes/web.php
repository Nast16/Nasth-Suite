<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Middleware\DisableHeadersCache;

// Sekarang halaman utama root (/) akan menampilkan Dashboard Terpusat
Route::get('/', [DashboardController::class, 'index'])->middleware(DisableHeadersCache::class);

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CashbookController;
use App\Http\Controllers\TaskController;

Route::get('/products', [ProductController::class, 'index']);
// Route untuk memproses data yang dikirim dari form (method-nya POST)
Route::post('/products', [ProductController::class, 'store']);
// {id} adalah parameter dinamis, artinya URL-nya akan berubah sesuai ID produk (misal: /products/1, /products/2)
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
// Route untuk menampilkan halaman edit (Method GET)
Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
// Route untuk memproses update data (Method PUT)
Route::put('/products/{id}', [ProductController::class, 'update']);
// Route untuk memproses tombol Jual 1
Route::post('/products/{id}/sell', [ProductController::class, 'sell']);
// Route untuk melihat halaman buku kas
Route::get('/cashbook', [CashbookController::class, 'index']);
// Route untuk menyimpan transaksi kas manual
Route::post('/cashbook', [CashbookController::class, 'store']);
// Halaman utama daftar tugas
Route::get('/tasks', [TaskController::class, 'index']);

// Proses tambah tugas
Route::post('/tasks', [TaskController::class, 'store']);

// Proses menandai tugas selesai
Route::post('/tasks/{id}/complete', [TaskController::class, 'complete']);