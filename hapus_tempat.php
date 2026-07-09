<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}
include 'includes/db.php';

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit;
}

$id = intval($_GET['id']);

// Hapus data dari database saja, gambar tetap di folder
mysqli_query($conn, "DELETE FROM tempat_ibadah WHERE id = $id");

header('Location: admin.php');
exit;
?>
