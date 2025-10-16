<?php
require_once 'User.php';
require_once 'Login.php';

class Mahasiswa extends User implements Login {
    public function __construct($nama) {
        parent::__construct($nama);
        $this->role = "Mahasiswa";
    }

    public function getRole() {
        return $this->role;
    }

    public function login($username, $password) {
        if ($password === "1234") {
            echo "Login berhasil untuk Mahasiswa {$this->username}.<br>";
        } else {
            echo "Login gagal untuk Mahasiswa {$this->username}.<br>";
        }
    }
}
