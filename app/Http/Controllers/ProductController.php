<?php

namespace App\Http\Controllers;

use App\Models\Product; // Jangan lupa import Model Product yang tadi dibuat
use Illuminate\Http\Request;
use App\Models\Cashbook;

class ProductController extends Controller
{
    public function index()
    {
        $userOrgId = auth()->user()->organization_id;
        
        // HANYA ambil produk milik organisasi si user
        $products = Product::where('organization_id', $userOrgId)->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        // Otomatis suntikkan organization_id saat menyimpan menu baru
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'organization_id' => auth()->user()->organization_id // 👈 Kunci isolasi data
        ]);

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
        $product = Product::findOrFail($id);

        // Proteksi keamanan: pastikan produk yang mau dijual membeberkan ID organisasi yang cocok
        if ($product->organization_id !== auth()->user()->organization_id) {
            abort(403, 'Aksi tidak sah.');
        }

        if ($product->stock < 1) {
            return redirect('/products')->with('error', 'Stok kopi sudah habis!');
        }

        $product->update([
            'stock' => $product->stock - 1
        ]);

        // Otomatis catat kas masuk dengan menyertakan organization_id
        Cashbook::create([
            'organization_id' => auth()->user()->organization_id, // 👈 Kunci isolasi kas otomatis
            'type' => 'income',
            'amount' => $product->price,
            'description' => 'Penjualan: ' . $product->name,
        ]);

        return redirect('/products');
    }
}