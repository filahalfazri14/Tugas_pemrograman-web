<?php
require_once 'User.php';
require_once 'Login.php';
require_once 'Notifikasi.php';

class Dosen extends User implements Login, Notifikasi {
    public function __construct($nama) {
        parent::__construct($nama);
        $this->role = "Dosen";
    }

    public function getRole() {
        return $this->role;
    }

    // Implementasi Notifikasi
    public function kirimNotifikasi($pesan) {
        echo "Mengirim notifikasi ke Dosen {$this->username}: {$pesan}<br>";
    }

    // Implementasi Login
    public function login($username, $password) {
        if ($password === "1234") {
            echo "Login berhasil untuk Dosen {$this->username}.<br>";
        } else {
            echo "Login gagal untuk Dosen {$this->username}.<br>";
        }
    }
}
