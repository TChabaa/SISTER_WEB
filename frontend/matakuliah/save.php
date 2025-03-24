<?php
require_once '../../routing/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodemk = $_POST['kodemk'];
    $namamk = $_POST['namamk'];
    $sks = $_POST['sks'];
    $semester = $_POST['semester'];

    try {
        // Check if Kode MK already exists
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM MataKuliah WHERE KodeMataKuliah = ?');
        $stmt->execute([$kodemk]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            // Update existing record
            $stmt = $pdo->prepare('UPDATE MataKuliah SET NamaMataKuliah = ?, SKS = ?, Semester = ? WHERE KodeMataKuliah = ?');
            $stmt->execute([$namamk, $sks, $semester, $kodemk]);
        } else {
            // Insert new record
            $stmt = $pdo->prepare('INSERT INTO MataKuliah (KodeMataKuliah, NamaMataKuliah, SKS, Semester) VALUES (?, ?, ?, ?)');
            $stmt->execute([$kodemk, $namamk, $sks, $semester]);
        }

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

header('Location: index.php');