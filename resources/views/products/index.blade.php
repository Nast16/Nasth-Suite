<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasth Suite - Dashboard Toko</title>
    <!-- Kita panggil Bootstrap CSS dari internet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <!-- Header Aplikasi -->
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded shadow-sm">
            <div>
                <h1 class="h3 mb-1 text-primary fw-bold">Nasth Suite</h1>
                <p class="text-muted mb-0">Asisten Digital Coffee Shop</p>
            </div>
            <a href="/cashbook" class="btn btn-outline-success fw-bold">
                💰 Buka Buku Kas
            </a>
        </div>

        <div class="row g-4">
            <!-- Kolom Kiri: Form Tambah Menu -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="h5 mb-3 fw-bold text-secondary">Tambah Menu Baru</h4>
                    
                    <form action="/products" method="POST">
                        @csrf 
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nama Kopi</label>
                            <input type="text" name="name" class="form-control" placeholder="Misal: Caramel Latte" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" placeholder="25000" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Stok Awal</label>
                            <input type="number" name="stock" class="form-control" placeholder="50" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Simpan Menu</button>
                    </form>
                </div>
            </div>

            <!-- Kolom Kanan: Tabel Daftar Menu -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="h5 mb-3 fw-bold text-secondary">Daftar Menu Kopi</h4>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $product->name }}</td>
                                    <td class="text-muted">Rp {{ number_format($product->price) }}</td>
                                    <td class="text-center">
                                        <!-- Jika stok menipis, kasih warna merah -->
                                        <span class="badge {{ $product->stock < 5 ? 'bg-danger' : 'bg-secondary' }}">
                                            {{ $product->stock }} pcs
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <!-- Tombol Jual 1 -->
                                        <form action="/products/{{ $product->id }}/sell" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success fw-bold me-1" {{ $product->stock < 1 ? 'disabled' : '' }}>
                                                Jual 1
                                            </button>
                                        </form>

                                        <!-- Tombol Edit -->
                                        <a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning fw-bold text-white me-1">
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE') 
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin mau hapus menu ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Opsional untuk fitur interaktif) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>