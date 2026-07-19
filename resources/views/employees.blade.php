<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasth Suite - Manajemen Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded shadow-sm">
            <div>
                <h1 class="h3 mb-1 text-dark fw-bold">👥 Manajemen Karyawan</h1>
                <p class="text-muted mb-0">Kelola hak akses tim operasional tokomu</p>
            </div>
            <a href="/" class="btn btn-outline-primary fw-bold">⬅️ Kembali ke Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <!-- Form Tambah Karyawan -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-3 text-secondary">Tambah Karyawan Baru</h5>
                    <form action="/employees" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Nama Karyawan</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Email Login</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Password Sementara</label>
                            <input type="password" name="password" class="form-control" required minlength="8">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Daftarkan Karyawan</button>
                    </form>
                </div>
            </div>

            <!-- Daftar Karyawan Aktif -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-3 text-secondary">Daftar Tim Toko</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $emp)
                                <tr>
                                    <td class="fw-bold">{{ $emp->name }}</td>
                                    <td>{{ $emp->email }}</td>
                                    <td>
                                        <span class="badge {{ $emp->role === 'owner' ? 'bg-danger' : 'bg-info' }}">
                                            {{ strtoupper($emp->role) }}
                                        </span>
                                    </td>
                                    <td><span class="badge bg-success">Aktif</span></td>
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