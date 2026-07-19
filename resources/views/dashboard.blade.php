<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasth Suite - Main Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <!-- Header Utama -->
        <div class="bg-white p-5 rounded shadow-sm mb-5 text-center">
            <h1 class="display-5 text-primary fw-bold">Nasth Suite</h1>
            <p class="lead text-muted">Asisten Digital Operasional UMKM yang Sederhana, Efisien, dan Terintegrasi</p>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <span class="badge bg-primary px-3 py-2">Mode: Single-Tenant MVP</span>
                <!-- Tombol Logout Bawaan Breeze agar User Bisa Keluar -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger fw-bold px-3">Logout</button>
                </form>
                @if(auth()->user()->role === 'owner')
                    <a href="/settings" class="btn btn-sm btn-outline-secondary fw-bold px-3">⚙️ Pengaturan Modul Bisnis</a>
                    <a href="/employees" class="btn btn-sm btn-outline-dark fw-bold px-3">👥 Kelola Karyawan</a>
                @endif
            </div>
        </div>

        <!-- Baris Ringkasan Data (Metrik Toko) -->
        <div class="row g-4 mb-5">
            <!-- Card Uang Kas -->
            @if($organization->has_cashbook)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <div class="text-muted small fw-bold text-uppercase">Total Saldo Kas</div>
                    <h2 class="text-success fw-bold my-2">Rp {{ number_format($currentBalance) }}</h2>
                    <a href="/cashbook" class="btn btn-sm btn-outline-success mt-auto fw-bold">Kelola Buku Kas ➡️</a>
                </div>
            </div>
            @endif

            <!-- Card Total Produk -->
            @if($organization->has_inventory)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <div class="text-muted small fw-bold text-uppercase">Daftar Menu Kopi</div>
                    <h2 class="text-primary fw-bold my-2">{{ $totalProducts }} Jenis</h2>
                    <a href="/products" class="btn btn-sm btn-outline-primary mt-auto fw-bold">Kelola Produk & Stok ➡️</a>
                </div>
            </div>
            @endif

            <!-- Card Tugas Menggantung -->
            @if($organization->has_tasks)
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 p-4">
                    <div class="text-muted small fw-bold text-uppercase">Tugas Belum Selesai</div>
                    <h2 class="text-danger fw-bold my-2">{{ $pendingTasks }} Tugas</h2>
                    <a href="/tasks" class="btn btn-sm btn-outline-danger mt-auto fw-bold">Buka Checklist Tugas ➡️</a>
                </div>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <p class="text-center text-muted small">Nasth Suite &copy; 2026. Build for users, not developers.</p>
    </div>

</body>
</html>