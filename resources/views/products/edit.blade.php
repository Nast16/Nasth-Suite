<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasth Suite - Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 fw-bold text-primary">Edit Menu Kopi</h4>
                        <a href="/products" class="text-decoration-none small text-muted">⬅️ Kembali</a>
                    </div>

                    <form action="/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nama Kopi</label>
                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Stok</label>
                            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                        </div>
                        
                        <button type="submit" class="btn btn-warning w-100 fw-bold text-white">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>