<?php
require_once '../../routing/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare('DELETE FROM KRS WHERE ID_KRS = ?');
        $stmt->execute([$id]);

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

header('Location: index.php');