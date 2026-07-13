<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nasth Suite - Buku Kas</title>
</head>
<body>
    <h1>Buku Kas Pembukuan (Cashbook)</h1>
    <a href="/products">Menu Utama (Manajemen Produk)</a>
    <hr>

    <!-- Ringkasan Saldo -->
    <table border="1" cellpadding="10" style="background-color: #f9f9f9;">
        <tr>
            <td><strong>Total Pemasukan:</strong> <br> Rp {{ number_format($totalIncome) }}</td>
            <td><strong>Total Pengeluaran:</strong> <br> Rp {{ number_format($totalExpense) }}</td>
            <td style="background-color: #e2f0d9;"><strong>Saldo Saat Ini:</strong> <br> <strong>Rp {{ number_format($currentBalance) }}</strong></td>
        </tr>
    </table>

    <br>
    <h3>Catat Transaksi Manual (Pemasukan/Pengeluaran)</h3>
    <form action="/cashbook" method="POST">
        @csrf
        <label>Jenis:</label>
        <select name="type" required>
            <option value="income">Uang Masuk (Pemasukan)</option>
            <option value="expense">Uang Keluar (Pengeluaran)</option>
        </select>

        <label>Jumlah Uang (Rp):</label>
        <input type="number" name="amount" required>

        <label>Keterangan:</label>
        <input type="text" name="description" placeholder="Misal: Beli Es Batu" required>

        <button type="submit">Catat Transaksi</button>
    </form>

    <br>
    <h3>Riwayat Transaksi Buku Kas</h3>
    <table border="1" cellpadding="10" width="100%">
        <thead>
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
                <td>{{ $tx->created_at->format('d M Y, H:i') }}</td>
                <td style="color: {{ $tx->type == 'income' ? 'green' : 'red' }}">
                    <strong>{{ $tx->type == 'income' ? 'MASUK' : 'KELUAR' }}</strong>
                </td>
                <td>Rp {{ number_format($tx->amount) }}</td>
                <td>{{ $tx->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>