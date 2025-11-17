<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>

    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Tambah Mahasiswa</h3>
        </div>

        <div class="card-body">

            <form method="POST">
                
                <div class="mb-3">
                    <label class="form-label">NPM</label>
                    <input type="text" name="npm" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" required>
                </div>

                <button class="btn btn-success">Simpan</button>
                <a href="/mvc_app/public/mahasiswa" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
