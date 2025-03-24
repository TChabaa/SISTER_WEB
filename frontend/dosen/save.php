<?php
require_once '../../routing/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    try {
        // Check if NIP already exists
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM Dosen WHERE NIP = ?');
        $stmt->execute([$nip]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            // Update existing record
            $stmt = $pdo->prepare('UPDATE Dosen SET Nama = ?, Alamat = ? WHERE NIP = ?');
            $stmt->execute([$nama, $alamat, $nip]);
        } else {
            // Insert new record
            $stmt = $pdo->prepare('INSERT INTO Dosen (NIP, Nama, Alamat) VALUES (?, ?, ?)');
            $stmt->execute([$nip, $nama, $alamat]);
        }

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

header('Location: index.php');