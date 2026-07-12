<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nasth Suite - Menu Kopi</title>
</head>
<body>
    <h1>Daftar Menu Coffee Shop</h1>
    
    <h3>Tambah Menu Baru</h3>
    <form action="/products" method="POST">
        <!-- @csrf ini WAJIB di Laravel untuk keamanan dari hacker -->
        @csrf 
        
        <label>Nama Kopi:</label>
        <input type="text" name="name" required>
        
        <label>Harga:</label>
        <input type="number" name="price" required>
        
        <label>Stok Awal:</label>
        <input type="number" name="stock" required>
        
        <button type="submit">Simpan Menu</button>
    </form>

    <hr>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th> <!-- Tambah kolom ini -->
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>Rp {{ number_format($product->price) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <!-- Tombol Edit (Berupa Link biasa yang mengarah ke halaman edit) -->
                    <a href="/products/{{ $product->id }}/edit">
                        <button type="button">Edit</button>
                    </a>
                    <!-- Form untuk Hapus Data -->
                    <!-- Kita mengirim ID produk yang mau dihapus lewat URL -->
                    <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
                        @csrf
                        <!-- Browser normal tidak bisa baca method DELETE, jadi Laravel mengakalinya dengan kode di bawah ini -->
                        @method('DELETE') 
                        <button type="submit" onclick="return confirm('Yakin mau hapus menu ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>