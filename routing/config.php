<?php
$host = "localhost";
$dbname = "STB_1"; // Ganti dengan nama database yang benar
$username = "root"; // Gunakan 'root' jika pakai XAMPP
$password = ""; // Kosongkan jika tidak ada password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>