<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}
include 'includes/db.php';

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$agama = $_POST['agama'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$gambarName = 'default.png'; // fallback
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $gambarName = basename($_FILES['gambar']['name']);
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $gambarName);
}

mysqli_query($conn, "INSERT INTO tempat_ibadah (nama, alamat, agama, lat, lng, gambar) VALUES ('$nama', '$alamat', '$agama', '$lat', '$lng', '$gambarName')");

header('Location: admin.php');

?>
