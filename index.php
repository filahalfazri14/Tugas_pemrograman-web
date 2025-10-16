<?php
require_once 'Mahasiswa.php';
require_once 'Dosen.php';
require_once 'Staff.php';
require_once 'Notifikasi.php';
require_once 'Login.php';

// Buat beberapa object
$mahasiswa = new Mahasiswa('Budi');
$dosen = new Dosen('Dr. Siti');
$staff = new Staff('Slamet', 'Keuangan');

// Fungsi util untuk menampilkan info user (menerima User)
function tampilkanInfoUser(User $user) {
    echo "Polymorphism: " . $user->getUsername() . " memiliki peran sebagai " . $user->getRole() . "<br>";
    // Jika Staff, tampilkan departemen juga
    if ($user instanceof Staff) {
        echo "Departemen: " . $user->getDepartemen() . "<br>";
    }
}

// Simpan ke array dan loop
$users = [$mahasiswa, $dosen, $staff];

foreach ($users as $u) {
    tampilkanInfoUser($u);

    // Jika mengimplementasikan Login, panggil login()
    if ($u instanceof Login) {
        // contoh: gunakan username yang sama dan password "1234"
        $u->login($u->getUsername(), "1234");
    }

    // Jika mengimplementasikan Notifikasi (contoh pada Dosen), kirim notifikasi demo
    if ($u instanceof Notifikasi) {
        $u->kirimNotifikasi("Jadwal kuliah besok dibatalkan.");
    }

    echo "<hr>";
}
?>