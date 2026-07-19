@extends('layouts.guest')
@section('content')

<h4 class="fw-bold text-dark text-center mb-4">Masuk ke Nasth Suite</h4>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label text-muted small fw-bold">Alamat Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <!-- Password -->
    <div class="mb-4">
        <label class="form-label text-muted small fw-bold">Password</label>
        <input type="password" name="password" class="form-control" required>
        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-primary w-100 fw-bold mb-3">Masuk</button>
    
    <div class="text-center">
        <a class="text-decoration-none small" href="{{ route('register') }}">Belum punya akun? Daftar di sini</a>
    </div>
</form>

@endsection