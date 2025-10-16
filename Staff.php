<?php
require_once 'User.php';

class Staff extends User {
    private $departemen;

    public function __construct($nama, $departemen) {
        parent::__construct($nama);
        $this->role = "Staff";
        $this->departemen = $departemen;
    }

    public function getRole() {
        return $this->role;
    }

    public function getDepartemen() {
        return $this->departemen;
    }
}
