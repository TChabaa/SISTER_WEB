<?php
require_once '../../routing/config.php';

$id = $_GET['id'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nilai = $_POST['nilai'];

    try {
        $stmt = $pdo->prepare('UPDATE KRS SET Nilai = ? WHERE ID_KRS = ?');
        $stmt->execute([$nilai, $id]);
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

if ($id) {
    $stmt = $pdo->prepare('SELECT k.*, m.NamaMataKuliah, d.Nama as NamaDosen 
                          FROM KRS k 
                          JOIN MataKuliah m ON k.KodeMataKuliah = m.KodeMataKuliah 
                          JOIN Dosen d ON k.NIP = d.NIP 
                          WHERE k.ID_KRS = ?');
    $stmt->execute([$id]);
    $krs = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit KRS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit KRS Grade</h2>
                <?php if (isset($krs)): ?>
                <form action="edit_krs.php" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Mata Kuliah</label>
                        <div class="text-gray-900"><?= htmlspecialchars($krs['NamaMataKuliah']) ?></div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Dosen</label>
                        <div class="text-gray-900"><?= htmlspecialchars($krs['NamaDosen']) ?></div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nilai">Nilai</label>
                        <select name="nilai" required
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select Grade</option>
                            <?php
                            $grades = ['A', 'B', 'C', 'D', 'E'];
                            foreach ($grades as $grade):
                            ?>
                            <option value="<?= $grade ?>" <?= ($krs['Nilai'] === $grade ? 'selected' : '') ?>>
                                <?= $grade ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update Grade
                        </button>
                        <a href="index.php" class="text-gray-600 hover:text-gray-800">Cancel</a>
                    </div>
                </form>
                <?php else: ?>
                <div class="text-red-600">KRS record not found.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>