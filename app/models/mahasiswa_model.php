<?php
require_once __DIR__ . '/../../core/database.php';

class Mahasiswa_model {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conn;
    }

    public function getAllMahasiswa() {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMahasiswaById($id) {
        $stmt = $this->db->prepare("SELECT * FROM mahasiswa WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahMahasiswa($data) {
        $stmt = $this->db->prepare("INSERT INTO mahasiswa (npm, nama, jurusan) VALUES (?, ?, ?)");
        return $stmt->execute([$data['npm'], $data['nama'], $data['jurusan']]);
    }

    public function updateMahasiswa($data) {
        $stmt = $this->db->prepare("UPDATE mahasiswa SET npm = ?, nama = ?, jurusan = ? WHERE id = ?");
        return $stmt->execute([$data['npm'], $data['nama'], $data['jurusan'], $data['id']]);
    }

    public function hapusMahasiswa($id) {
        $stmt = $this->db->prepare("DELETE FROM mahasiswa WHERE id = ?");
        return $stmt->execute([$id]);
    }
}