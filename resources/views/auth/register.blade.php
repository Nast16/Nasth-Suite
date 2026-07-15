@extends('layouts.guest')
@section('content')

<h4 class="fw-bold text-dark text-center mb-4">Daftar Akun Baru</h4>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Nama Toko / UMKM -->
    <div class="mb-3">
        <label class="form-label text-muted small fw-bold">Nama Toko / UMKM</label>
        <input type="text" name="organization_name" class="form-control" required autofocus>
    </div>

    <!-- Jenis Bisnis -->
    <div class="mb-3">
        <label class="form-label text-muted small fw-bold">Jenis Bisnis</label>
        <select name="organization_type" class="form-select" required>
            <option value="Coffee Shop">Coffee Shop</option>
            <option value="Laundry">Laundry</option>
            <option value="Toko Kelontong">Toko Kelontong/Kelontong</option>
        </select>
    </div>

    <!-- Nama -->
    <div class="mb-3">
        <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label text-muted small fw-bold">Alamat Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label class="form-label text-muted small fw-bold">Password</label>
        <input type="password" name="password" class="form-control" required>
        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Konfirmasi Password -->
    <div class="mb-4">
        <label class="form-label text-muted small fw-bold">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100 fw-bold mb-3">Daftar Sekarang</button>
    
    <div class="text-center">
        <a class="text-decoration-none small" href="{{ route('login') }}">Sudah punya akun? Login di sini</a>
    </div>
</form>

@endsection