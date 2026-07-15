<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasth Suite - Authentication</title>
    <!-- Kita panggil Bootstrap agar halaman login langsung rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-5">
                <!-- Logo / Nama Aplikasi -->
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Nasth Suite</h2>
                    <p class="text-muted small">Asisten Digital Operasional UMKM</p>
                </div>

                <!-- Box Putih Tempat Form Login / Register -->
                <div class="card border-0 shadow-sm p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</body>
</html>