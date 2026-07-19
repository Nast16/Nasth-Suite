<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasth Suite - Pengaturan Modul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded shadow-sm">
            <div>
                <h1 class="h3 mb-1 text-dark fw-bold">⚙️ Pengaturan Bisnis</h1>
                <p class="text-muted mb-0">Kustomisasi Modul Aktif untuk <strong>{{ $organization->name }}</strong></p>
            </div>
            <a href="/" class="btn btn-outline-primary fw-bold">⬅️ Kembali ke Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm p-4">
            <h4 class="h5 mb-4 fw-bold text-secondary">Pilih Modul yang Ingin Diaktifkan</h4>
            
            <form action="/settings" method="POST">
                @csrf
                @method('PUT')

                <!-- Kontrol Modul Inventory -->
                <div class="form-check form-switch mb-4 p-3 bg-light rounded d-flex align-items-center justify-content-between">
                    <div class="ms-2">
                        <label class="form-check-label fw-bold d-block text-primary">☕ Modul Inventori & Produk</label>
                        <small class="text-muted">Mengelola stok produk, menu, dan melakukan transaksi penjualan langsung.</small>
                    </div>
                    <input class="form-check-input" type="checkbox" name="has_inventory" value="1" {{ $organization->has_inventory ? 'checked' : '' }} style="transform: scale(1.5); margin-right: 15px;">
                </div>

                <!-- Kontrol Modul Cashbook -->
                <div class="form-check form-switch mb-4 p-3 bg-light rounded d-flex align-items-center justify-content-between">
                    <div class="ms-2">
                        <label class="form-check-label fw-bold d-block text-success">💰 Modul Buku Kas Keuangan</label>
                        <small class="text-muted">Pencatatan otomatis uang masuk/keluar beserta kalkulasi saldo secara real-time.</small>
                    </div>
                    <input class="form-check-input" type="checkbox" name="has_cashbook" value="1" {{ $organization->has_cashbook ? 'checked' : '' }} style="transform: scale(1.5); margin-right: 15px;">
                </div>

                <!-- Kontrol Modul Tasks -->
                <div class="form-check form-switch mb-4 p-3 bg-light rounded d-flex align-items-center justify-content-between">
                    <div class="ms-2">
                        <label class="form-check-label fw-bold d-block text-warning">📋 Modul Tugas Operasional (Tasks)</label>
                        <small class="text-muted">Manajemen daftar checklist tugas harian karyawan untuk standarisasi kerja.</small>
                    </div>
                    <input class="form-check-input" type="checkbox" name="has_tasks" value="1" {{ $organization->has_tasks ? 'checked' : '' }} style="transform: scale(1.5); margin-right: 15px;">
                </div>

                <button type="submit" class="btn btn-primary fw-bold px-4 py-2 mt-2 shadow-sm">Simpan Konfigurasi</button>
            </form>
        </div>
    </div>

</body>
</html>