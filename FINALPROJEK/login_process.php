<?php
// Mulai sesi
session_start();

// Koneksi database
require 'db.php';

// Ambil data dari form
$username_or_email = $_POST['username_or_email'];
$password = $_POST['password'];

// Cek apakah email atau username ada di database
$query = "SELECT * FROM users WHERE email = '$username_or_email' OR username = '$username_or_email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Email atau Username tidak ditemukan.";
    exit();
}

// Ambil data pengguna dari database
$user = mysqli_fetch_assoc($result);

// Verifikasi password
if (password_verify($password, $user['password'])) {
    // Simpan email dan username di sesi
    $_SESSION['email'] = $user['email'];
    $_SESSION['username'] = $user['username'];  // Menyimpan username di sesi
    header("Location: index.php"); // Arahkan ke halaman utama
    exit();
} else {
    echo "Password salah.";
}

mysqli_close($conn);
?>
