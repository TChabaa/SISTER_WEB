<?php
require_once '../../routing/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    try {
        // Check if NIM already exists
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM Mahasiswa WHERE NIM = ?');
        $stmt->execute([$nim]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            // Update existing record
            $stmt = $pdo->prepare('UPDATE Mahasiswa SET Nama = ?, Alamat = ? WHERE NIM = ?');
            $stmt->execute([$nama, $alamat, $nim]);
        } else {
            // Insert new record
            $stmt = $pdo->prepare('INSERT INTO Mahasiswa (NIM, Nama, Alamat) VALUES (?, ?, ?)');
            $stmt->execute([$nim, $nama, $alamat]);
        }

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

header('Location: index.php');