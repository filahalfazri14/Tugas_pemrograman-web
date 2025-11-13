<?php
require_once 'Database.php';

class Prodi {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Ambil semua data Prodi
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM prodi ORDER BY nama_prodi ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil data berdasarkan ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM prodi WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah data baru
    public function insert($data) {
        $stmt = $this->db->prepare("
            INSERT INTO prodi (kode_prodi, nama_prodi, jenjang, kaprodi, fakultas, status)
            VALUES (:kode_prodi, :nama_prodi, :jenjang, :kaprodi, :fakultas, :status)
        ");
        return $stmt->execute($data);
    }

    // Update data
    public function update($data) {
        $stmt = $this->db->prepare("
            UPDATE prodi SET 
                kode_prodi = :kode_prodi,
                nama_prodi = :nama_prodi,
                jenjang = :jenjang,
                kaprodi = :kaprodi,
                fakultas = :fakultas,
                status = :status
            WHERE id = :id
        ");
        return $stmt->execute($data);
    }

    // Hapus data
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM prodi WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Ambil data dengan filter, search, dan pagination
    public function getFilteredPaginated($search = '', $status = '', $limit = 5, $offset = 0) {
        $sql = "SELECT * FROM prodi WHERE 1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nama_prodi LIKE :search OR kaprodi LIKE :search)";
            $params[':search'] = "%$search%";
        }

        if (!empty($status)) {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }

        $sql .= " ORDER BY nama_prodi ASC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);
        foreach ($params as $key => $val) $stmt->bindValue($key, $val);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hitung total data hasil filter
    public function countFiltered($search = '', $status = '') {
        $sql = "SELECT COUNT(*) FROM prodi WHERE 1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (nama_prodi LIKE :search OR kaprodi LIKE :search)";
            $params[':search'] = "%$search%";
        }

        if (!empty($status)) {
            $sql .= " AND status = :status";
            $params[':status'] = $status;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    }
}
?>
