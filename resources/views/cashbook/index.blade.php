<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasth Suite - Buku Kas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <!-- Header Aplikasi -->
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded shadow-sm">
            <div>
                <h1 class="h3 mb-1 text-success fw-bold">💰 Buku Kas (Cashbook)</h1>
                <p class="text-muted mb-0">Catatan Keuangan Real-time Nasth Suite</p>
            </div>
            <a href="/products" class="btn btn-outline-primary fw-bold">
                ☕ Kembali ke Menu Kopi
            </a>
        </div>

        <!-- Ringkasan Saldo (Card Info Keuangan) -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-white p-3 text-center">
                    <span class="text-muted small fw-bold text-uppercase">Total Pemasukan</span>
                    <h3 class="text-success fw-bold mt-1">Rp {{ number_format($totalIncome) }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-white p-3 text-center">
                    <span class="text-muted small fw-bold text-uppercase">Total Pengeluaran</span>
                    <h3 class="text-danger fw-bold mt-1">Rp {{ number_format($totalExpense) }}</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-success text-white p-3 text-center">
                    <span class="text-white-50 small fw-bold text-uppercase">Saldo Saat Ini</span>
                    <h3 class="fw-bold mt-1">Rp {{ number_format($currentBalance) }}</h3>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Kolom Kiri: Form Catat Transaksi Manual -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="h5 mb-3 fw-bold text-secondary">Catat Transaksi Manual</h4>
                    
                    <form action="/cashbook" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Jenis Transaksi</label>
                            <select name="type" class="form-select" required>
                                <option value="income">Uang Masuk (Pemasukan)</option>
                                <option value="expense">Uang Keluar (Pengeluaran)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Jumlah Uang (Rp)</label>
                            <input type="number" name="amount" class="form-control" placeholder="Contoh: 50000" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Keterangan</label>
                            <input type="text" name="description" class="form-control" placeholder="Misal: Beli Es Watu / Bayar Listrik" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 fw-bold">Catat Transaksi</button>
                    </form>
                </div>
            </div>

            <!-- Kolom Rencana: Tabel Riwayat Keuangan -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="h5 mb-3 fw-bold text-secondary">Riwayat Transaksi Keuangan</h4>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $tx)
                                <tr>
                                    <td class="text-muted small">{{ $tx->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        <span class="badge {{ $tx->type == 'income' ? 'bg-light-success text-success bg-opacity-10' : 'bg-light-danger text-danger bg-opacity-10' }} px-3 py-2 fw-bold text-uppercase" style="background-color: {{ $tx->type == 'income' ? '#e2f0d9' : '#fce4d6' }}">
                                            {{ $tx->type == 'income' ? 'Masuk' : 'Keluar' }}
                                        </span>
                                    </td>
                                    <td class="fw-semibold {{ $tx->type == 'income' ? 'text-success' : 'text-danger' }}">
                                        {{ $tx->type == 'income' ? '+' : '-' }} Rp {{ number_format($tx->amount) }}
                                    </td>
                                    <td class="text-dark small">{{ $tx->description }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>