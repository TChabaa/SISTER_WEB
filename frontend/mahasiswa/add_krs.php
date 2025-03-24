<?php
require_once '../../routing/config.php';

// Get available courses and lecturers
$stmt = $pdo->query('SELECT * FROM MataKuliah');
$matakuliah = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query('SELECT * FROM Dosen');
$dosen = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $kodemk = $_POST['kodemk'];
    $nip = $_POST['nip'];

    try {
        $stmt = $pdo->prepare('INSERT INTO KRS (NIM, KodeMataKuliah, NIP) VALUES (?, ?, ?)');
        $stmt->execute([$nim, $kodemk, $nip]);
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

$nim = $_GET['nim'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add KRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New KRS</h2>
                <form action="add_krs.php" method="POST">
                    <input type="hidden" name="nim" value="<?= htmlspecialchars($nim) ?>">

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="kodemk">Mata Kuliah</label>
                        <select name="kodemk" required
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select Mata Kuliah</option>
                            <?php foreach ($matakuliah as $mk): ?>
                            <option value="<?= htmlspecialchars($mk['KodeMataKuliah']) ?>">
                                <?= htmlspecialchars($mk['NamaMataKuliah']) ?> (<?= htmlspecialchars($mk['SKS']) ?> SKS)
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nip">Dosen</label>
                        <select name="nip" required
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select Dosen</option>
                            <?php foreach ($dosen as $d): ?>
                            <option value="<?= htmlspecialchars($d['NIP']) ?>">
                                <?= htmlspecialchars($d['Nama']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save KRS
                        </button>
                        <a href="index.php" class="text-gray-600 hover:text-gray-800">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>