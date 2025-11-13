<?php
require_once 'Prodi.php';
$prodi = new Prodi();

// Ambil parameter URL
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$data = $prodi->getFilteredPaginated($search, $status, $limit, $offset);
$total = $prodi->countFiltered($search, $status);
$totalPages = ceil($total / $limit);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Program Studi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Program Studi</h2>
        <a href="Form_Prodi.php" class="btn btn-primary">+ Tambah Prodi</a>
    </div>

    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari nama prodi / kaprodi..." value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="aktif" <?= $status == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="tidak aktif" <?= $status == 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100">Filter</button>
        </div>
        <div class="col-md-2">
            <a href="Tampil_Prodi.php" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Prodi</th>
                <th>Jenjang</th>
                <th>Kaprodi</th>
                <th>Fakultas</th>
                <th>Status</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data): ?>
                <?php foreach ($data as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['kode_prodi']) ?></td>
                        <td><?= htmlspecialchars($p['nama_prodi']) ?></td>
                        <td><?= htmlspecialchars($p['jenjang']) ?></td>
                        <td><?= htmlspecialchars($p['kaprodi']) ?></td>
                        <td><?= htmlspecialchars($p['fakultas']) ?></td>
                        <td>
                            <?php if ($p['status'] == 'aktif'): ?>
                                <span class="badge bg-success">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Tidak Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="Form_Prodi.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="Hapus_Prodi.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center text-muted">Tidak ada data.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&status=<?= urlencode($status) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
</body>
</html>
