<?php
require_once 'Database.php';
$pdo = Database::getInstance();

// Ambil daftar jurusan
$jurusan_stmt = $pdo->query("SELECT * FROM jurusan ORDER BY nama_jurusan");
$jurusan_list = $jurusan_stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil filter dari user
$filter_jurusan = isset($_GET['jurusan']) ? $_GET['jurusan'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : 'nama_asc';

// Mapping urutan
$order_map = [
    'nama_asc' => 'm.nama ASC',
    'nama_desc' => 'm.nama DESC',
    'nim_asc' => 'm.nim ASC',
    'nim_desc' => 'm.nim DESC'
];
$order_sql = $order_map[$order] ?? 'm.nama ASC';

// Query join
$sql = "SELECT m.nim, m.nama, j.nama_jurusan
        FROM mahasiswa m
        JOIN jurusan j ON m.jurusan = j.id";
if (!empty($filter_jurusan)) {
    $sql .= " WHERE j.id = :jurusan";
}
$sql .= " ORDER BY $order_sql";

$stmt = $pdo->prepare($sql);
if (!empty($filter_jurusan)) {
    $stmt->bindParam(':jurusan', $filter_jurusan, PDO::PARAM_INT);
}
$stmt->execute();
$mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Mahasiswa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2 class="mb-4">Data Mahasiswa</h2>
    <form class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Filter Jurusan:</label>
            <select name="jurusan" class="form-select">
                <option value="">Semua Jurusan</option>
                <?php foreach ($jurusan_list as $j): ?>
                    <option value="<?= $j['id']; ?>" <?= ($filter_jurusan == $j['id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($j['nama_jurusan']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Urutkan By:</label>
            <select name="order" class="form-select">
                <option value="nama_asc" <?= ($order == 'nama_asc') ? 'selected' : ''; ?>>Nama (A-Z)</option>
                <option value="nama_desc" <?= ($order == 'nama_desc') ? 'selected' : ''; ?>>Nama (Z-A)</option>
                <option value="nim_asc" <?= ($order == 'nim_asc') ? 'selected' : ''; ?>>NIM (A-Z)</option>
                <option value="nim_desc" <?= ($order == 'nim_desc') ? 'selected' : ''; ?>>NIM (Z-A)</option>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($mahasiswa): ?>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <tr>
                        <td><?= htmlspecialchars($mhs['nim']); ?></td>
                        <td><?= htmlspecialchars($mhs['nama']); ?></td>
                        <td><?= htmlspecialchars($mhs['nama_jurusan']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">Tidak ada data mahasiswa.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
