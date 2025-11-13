<?php
require_once 'Prodi.php';
$prodi = new Prodi();

// Ambil ID dari URL (jika edit)
$id = $_GET['id'] ?? null;

// Data default
$data = [
    'kode_prodi' => '',
    'nama_prodi' => '',
    'jenjang' => '',
    'kaprodi' => '',
    'fakultas' => '',
    'status' => 'aktif'
];

// Jika edit, ambil data dari database
if ($id) {
    $data = $prodi->getById($id);
    if (!$data) {
        die("<h3>Data tidak ditemukan!</h3>");
    }
}

// Proses saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form = [
        'kode_prodi' => $_POST['kode_prodi'],
        'nama_prodi' => $_POST['nama_prodi'],
        'jenjang' => $_POST['jenjang'],
        'kaprodi' => $_POST['kaprodi'],
        'fakultas' => $_POST['fakultas'],
        'status' => $_POST['status']
    ];

    if ($id) {
        $form['id'] = $id;
        $prodi->update($form);
    } else {
        $prodi->insert($form);
    }

    header("Location: Tampil_Prodi.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $id ? 'Edit Prodi' : 'Tambah Prodi' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4><?= $id ? 'Edit Data Program Studi' : 'Tambah Program Studi Baru' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Kode Prodi</label>
                    <input type="text" name="kode_prodi" class="form-control" value="<?= htmlspecialchars($data['kode_prodi']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Prodi</label>
                    <input type="text" name="nama_prodi" class="form-control" value="<?= htmlspecialchars($data['nama_prodi']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenjang</label>
                    <select name="jenjang" class="form-select" required>
                        <option value="">-- Pilih Jenjang --</option>
                        <option value="D3" <?= $data['jenjang']=='D3'?'selected':'' ?>>D3</option>
                        <option value="S1" <?= $data['jenjang']=='S1'?'selected':'' ?>>S1</option>
                        <option value="S2" <?= $data['jenjang']=='S2'?'selected':'' ?>>S2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kaprodi</label>
                    <input type="text" name="kaprodi" class="form-control" value="<?= htmlspecialchars($data['kaprodi']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Fakultas</label>
                    <input type="text" name="fakultas" class="form-control" value="<?= htmlspecialchars($data['fakultas']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="aktif" <?= $data['status']=='aktif'?'selected':'' ?>>Aktif</option>
                        <option value="tidak aktif" <?= $data['status']=='tidak aktif'?'selected':'' ?>>Tidak Aktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success"><?= $id ? 'Update' : 'Simpan' ?></button>
                <a href="Tampil_Prodi.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
