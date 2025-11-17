<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <!-- Bootstrap 5 -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Data Mahasiswa</h3>
        </div>

        <div class="card-body">

            <a href="/mvc_app/public/mahasiswa/tambah" class="btn btn-success mb-3">
                + Tambah Mahasiswa
            </a>

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="60">ID</th>
                        <th width="120">NPM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($data['mahasiswa'])): ?>
                        <?php foreach ($data['mahasiswa'] as $m): ?>
                        <tr>
                            <td><?= $m['id']; ?></td>
                            <td><?= $m['npm']; ?></td>
                            <td><?= $m['nama']; ?></td>
                            <td><?= $m['jurusan']; ?></td>
                            <td>
                                <a href="/mvc_app/public/mahasiswa/detail/<?= $m['id']; ?>" 
                                   class="btn btn-info btn-sm text-white">Detail</a>

                                <a href="/mvc_app/public/mahasiswa/edit/<?= $m['id']; ?>" 
                                   class="btn btn-warning btn-sm">Edit</a>

                                <a href="/mvc_app/public/mahasiswa/hapus/<?= $m['id']; ?>"
                                   onclick="return confirm('Yakin ingin menghapus?')"
                                   class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada data mahasiswa
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>
