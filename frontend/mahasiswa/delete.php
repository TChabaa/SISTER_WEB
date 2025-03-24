<?php
require_once '../../routing/config.php';

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];

    try {
        $stmt = $pdo->prepare('DELETE FROM Mahasiswa WHERE NIM = ?');
        $stmt->execute([$nim]);

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

header('Location: index.php');