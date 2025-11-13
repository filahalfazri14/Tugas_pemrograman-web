<?php
require_once 'Prodi.php';
$prodi = new Prodi();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $prodi->delete($id);
}

header("Location: Tampil_Prodi.php");
exit;
?>
