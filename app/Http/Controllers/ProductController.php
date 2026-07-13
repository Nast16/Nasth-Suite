<?php

namespace App\Http\Controllers;

use App\Models\Product; // Jangan lupa import Model Product yang tadi dibuat
use Illuminate\Http\Request;
use App\Models\Cashbook;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel products (seperti SELECT * FROM products)
        $products = Product::all();

        // Mengirim data tersebut ke file tampilan bernama 'products.index'
        return view('products.index', compact('products'));
    }

    // Tambahkan fungsi baru ini di dalam class ProductController
    public function store(Request $request)
    {
        // 1. Validasi data agar tidak ada yang kosong
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        // 2. Simpan ke database menggunakan Model Product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // 3. Setelah sukses, balikkan halaman ke daftar produk lagi
        return redirect('/products');
    }

    // Fungsi ini menangkap ID produk yang dikirim dari tombol hapus
    public function destroy($id)
    {
        // 1. Cari produk berdasarkan ID-nya di database
        $product = Product::findOrFail($id);
        
        // 2. Hapus produk tersebut
        $product->delete();

        // 3. Kembalikan ke halaman daftar produk
        return redirect('/products');
    }

    // 1. Fungsi untuk menampilkan halaman form edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // 2. Fungsi untuk memproses perubahan data ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        
        // Update data dengan data baru dari form
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect('/products');
    }

    public function sell($id)
    {
        // 1. Cari produk yang dijual
        $product = Product::findOrFail($id);

        // 2. Validasi: Cek apakah stok masih ada
        if ($product->stock < 1) {
            return redirect('/products')->with('error', 'Stok kopi sudah habis!');
        }

        // 3. Kurangi stok produk sebanyak 1, lalu simpan perubahan
        $product->update([
            'stock' => $product->stock - 1
        ]);

        // 4. KEAJAIBAN INTEGRASI: Otomatis catat uang masuk ke tabel Cashbook!
        Cashbook::create([
            'type' => 'income',
            'amount' => $product->price,
            'description' => 'Penjualan: ' . $product->name,
        ]);

        // 5. Kembalikan ke halaman daftar produk
        return redirect('/products');
    }
}