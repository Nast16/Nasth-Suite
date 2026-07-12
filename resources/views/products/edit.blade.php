<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nasth Suite - Edit Menu</title>
</head>
<body>
    <h1>Edit Menu Kopi</h1>
    <a href="/products">⬅️ Kembali ke Daftar Menu</a>
    <br><br>

    <!-- Form mengarah ke URL update dengan method PUT -->
    <form action="/products/{{ $product->id }}" method="POST">
        @csrf
        @method('PUT') <!-- Wajib untuk proses update di Laravel -->

        <label>Nama Kopi:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>
        <br><br>
        
        <label>Harga:</label>
        <input type="number" name="price" value="{{ $product->price }}" required>
        <br><br>
        
        <label>Stok:</label>
        <input type="number" name="stock" value="{{ $product->stock }}" required>
        <br><br>
        
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>