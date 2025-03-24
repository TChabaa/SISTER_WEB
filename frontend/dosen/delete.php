<?php
require_once '../../routing/config.php';

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    try {
        $stmt = $pdo->prepare('DELETE FROM Dosen WHERE NIP = ?');
        $stmt->execute([$nip]);

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

header('Location: index.php');