<?php
require_once __DIR__ . '/../models/mahasiswa_model.php';

class Mahasiswa {
    private $model;

    public function __construct() {
        $this->model = new Mahasiswa_model();
    }

    public function index() {
        $data['mahasiswa'] = $this->model->getAllMahasiswa();
        require __DIR__ . '/../views/mahasiswa/index.php';
    }

    public function detail($id = null) {
        if (!$id) {
            header("Location: /mvc_app/public/mahasiswa");
            exit;
        }
        $data['mahasiswa'] = $this->model->getMahasiswaById($id);
        if (!$data['mahasiswa']) {
            echo "Data tidak ditemukan";
            exit;
        }
        require __DIR__ . '/../views/mahasiswa/detail.php';
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->tambahMahasiswa($_POST);
            header("Location: /mvc_app/public/mahasiswa");
            exit;
        }
        require __DIR__ . '/../views/mahasiswa/tambah.php';
    }

    public function edit($id = null) {
        if (!$id) {
            header("Location: /mvc_app/public/mahasiswa");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Pastikan id dikirimkan ke model
            $data = $_POST;
            $data['id'] = $id;
            $this->model->updateMahasiswa($data);
            header("Location: /mvc_app/public/mahasiswa");
            exit;
        }

        // GET: tampilkan form dengan data awal
        $data['mahasiswa'] = $this->model->getMahasiswaById($id);
        if (!$data['mahasiswa']) {
            echo "Data tidak ditemukan";
            exit;
        }
        require __DIR__ . '/../views/mahasiswa/edit.php';
    }

    public function hapus($id = null) {
        if ($id) {
            $this->model->hapusMahasiswa($id);
        }
        header("Location: /mvc_app/public/mahasiswa");
        exit;
    }
}
