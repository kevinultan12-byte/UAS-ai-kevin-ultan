<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}
include 'includes/db.php';

if (!isset($_POST['id'])) {
    header('Location: admin.php');
    exit;
}

$id = intval($_POST['id']);
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$agama = $_POST['agama'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

// Ambil data lama dulu untuk nama gambar lama
$result = mysqli_query($conn, "SELECT gambar FROM tempat_ibadah WHERE id = $id");
$data = mysqli_fetch_assoc($result);
$oldGambar = $data['gambar'];

$gambarName = $oldGambar; // default pakai gambar lama

// Cek apakah upload gambar baru
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    // Jangan hapus gambar lama, biarkan tetap di folder

    // Upload gambar baru
    $gambarName = basename($_FILES['gambar']['name']);
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/' . $gambarName);
}

$query = "UPDATE tempat_ibadah SET 
            nama = '".mysqli_real_escape_string($conn, $nama)."',
            alamat = '".mysqli_real_escape_string($conn, $alamat)."',
            agama = '".mysqli_real_escape_string($conn, $agama)."',
            lat = '".mysqli_real_escape_string($conn, $lat)."',
            lng = '".mysqli_real_escape_string($conn, $lng)."',
            gambar = '".mysqli_real_escape_string($conn, $gambarName)."'
            WHERE id = $id";

mysqli_query($conn, $query);

header('Location: admin.php');
exit;
?>
