<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasth Suite - Tugas Harian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-4 rounded shadow-sm">
            <div>
                <h1 class="h3 mb-1 text-warning fw-bold">📋 Tugas Operasional (Tasks)</h1>
                <p class="text-muted mb-0">Manajemen Checklist Harian Karyawan</p>
            </div>
            <div>
                <a href="/products" class="btn btn-outline-primary fw-bold me-2">☕ Menu Kopi</a>
                <a href="/cashbook" class="btn btn-outline-success fw-bold">💰 Buku Kas</a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Form Tambah Tugas -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="h5 mb-3 fw-bold text-secondary">Buat Tugas Baru</h4>
                    <form action="/tasks" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Deskripsi Tugas</label>
                            <input type="text" name="title" class="form-control" placeholder="Misal: Lap meja outdoor" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Prioritas</label>
                            <select name="priority" class="form-select" required>
                                <option value="low">Low (Biasa)</option>
                                <option value="medium">Medium (Penting)</option>
                                <option value="high">High (Darurat!)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 fw-bold text-white">Tambah Tugas</button>
                    </form>
                </div>
            </div>

            <!-- Daftar Tugas -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm p-4">
                    <h4 class="h5 mb-3 fw-bold text-secondary">Checklist Tugas Hari Ini</h4>
                    
                    <ul class="list-group list-group-flush">
                        @forelse($tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                                <div>
                                    <!-- Jika selesai, teks dicoret -->
                                    <span class="{{ $task->is_completed ? 'text-decoration-line-through text-muted' : 'fw-semibold text-dark' }}">
                                        {{ $task->title }}
                                    </span>
                                    
                                    <!-- Badge Prioritas -->
                                    <span class="badge rounded-pill mx-2 small 
                                        {{ $task->priority == 'high' ? 'bg-danger' : ($task->priority == 'medium' ? 'bg-warning' : 'bg-info') }}">
                                        {{ $task->priority }}
                                    </span>
                                </div>

                                <div>
                                    @if(!$task->is_completed)
                                        <!-- Form untuk Tandai Selesai -->
                                        <form action="/tasks/{{ $task->id }}/complete" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success fw-bold">✓ Selesai</button>
                                        </form>
                                    @else
                                        <span class="text-success small fw-bold">✓ Done</span>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted py-4">Belum ada tugas untuk hari ini.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>
</html>