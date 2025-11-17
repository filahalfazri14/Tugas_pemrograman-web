<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Edit Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card">
    <div class="card-header bg-warning">Edit Mahasiswa</div>
    <div class="card-body">
      <form method="post" action="">
        <div class="mb-3">
          <label class="form-label">NPM</label>
          <input type="text" name="npm" class="form-control" required value="<?= htmlspecialchars($data['mahasiswa']['npm'] ?? '', ENT_QUOTES); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" required value="<?= htmlspecialchars($data['mahasiswa']['nama'] ?? '', ENT_QUOTES); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Jurusan</label>
          <input type="text" name="jurusan" class="form-control" required value="<?= htmlspecialchars($data['mahasiswa']['jurusan'] ?? '', ENT_QUOTES); ?>">
        </div>
        <button class="btn btn-warning">Update</button>
        <a href="/mvc_app/public/mahasiswa" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
