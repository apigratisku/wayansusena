<?php
// Detail koneksi database
$host = "apigratis.my.id"; // Server database (misalnya: localhost)
$user = "blip2681_ptamgm";  // Username database
$password = "Semogalancar123#"; // Password database
$database = "blip2681_ptamgm"; // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

echo "Koneksi berhasil!";
?>
