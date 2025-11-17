<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Detail Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card">
    <div class="card-header bg-info text-white">Detail Mahasiswa</div>
    <div class="card-body">
      <p><strong>NPM:</strong> <?= htmlspecialchars($data['mahasiswa']['npm'] ?? '', ENT_QUOTES); ?></p>
      <p><strong>Nama:</strong> <?= htmlspecialchars($data['mahasiswa']['nama'] ?? '', ENT_QUOTES); ?></p>
      <p><strong>Jurusan:</strong> <?= htmlspecialchars($data['mahasiswa']['jurusan'] ?? '', ENT_QUOTES); ?></p>
      <a href="/mvc_app/public/mahasiswa" class="btn btn-secondary mt-2">Kembali</a>
    </div>
  </div>
</div>
</body>
</html>
