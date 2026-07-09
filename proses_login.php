<?php
session_start();
include 'includes/db.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
$data = mysqli_fetch_assoc($query);

if ($data && password_verify($password, $data['password'])) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    header("Location: home.php");
    exit;
} else {
    echo "<script>alert('Login gagal! Username atau password salah.'); window.location='login.php';</script>";
}
?>
