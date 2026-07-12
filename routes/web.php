<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
// Route untuk memproses data yang dikirim dari form (method-nya POST)
Route::post('/products', [ProductController::class, 'store']);
// {id} adalah parameter dinamis, artinya URL-nya akan berubah sesuai ID produk (misal: /products/1, /products/2)
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
// Route untuk menampilkan halaman edit (Method GET)
Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
// Route untuk memproses update data (Method PUT)
Route::put('/products/{id}', [ProductController::class, 'update']);