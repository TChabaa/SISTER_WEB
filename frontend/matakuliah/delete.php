<?php
require_once '../../routing/config.php';

if (isset($_GET['kodemk'])) {
    $kodemk = $_GET['kodemk'];

    try {
        $stmt = $pdo->prepare('DELETE FROM MataKuliah WHERE KodeMataKuliah = ?');
        $stmt->execute([$kodemk]);

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

header('Location: index.php');