<?php
require_once '../../routing/config.php';

// Fetch all mata kuliah
$stmt = $pdo->query('SELECT * FROM MataKuliah');
$matakuliah = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100" x-data="{
    showModal: false,
    formData: {
        kodemk: '',
        namamk: '',
        sks: '',
        semester: ''
    }
}">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="../index.php" class="text-xl font-bold text-gray-800">UMS</a>
                    </div>
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="../mahasiswa/index.php"
                            class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-gray-700">
                            Mahasiswa
                        </a>
                        <a href="../dosen/index.php"
                            class="inline-flex items-center px-1 pt-1 text-gray-500 hover:text-gray-700">
                            Dosen
                        </a>
                        <a href="../matakuliah/index.php"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-gray-900">
                            Mata Kuliah
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Daftar Mata Kuliah</h2>
                <button @click="showModal = true; formData = {kodemk: '', namamk: '', sks: '', semester: ''}"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Create Mata Kuliah
                </button>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode MK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                SKS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Semester</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($matakuliah as $mk): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?= htmlspecialchars($mk['KodeMataKuliah']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?= htmlspecialchars($mk['NamaMataKuliah']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?= htmlspecialchars($mk['SKS']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?= htmlspecialchars($mk['Semester']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button @click="showModal = true; formData = {
                                            kodemk: '<?= $mk['KodeMataKuliah'] ?>', 
                                            namamk: '<?= $mk['NamaMataKuliah'] ?>', 
                                            sks: '<?= $mk['SKS'] ?>',
                                            semester: '<?= $mk['Semester'] ?>'
                                        }" class="text-yellow-600 hover:text-yellow-900">Edit</button>
                                <a href="delete.php?kodemk=<?= $mk['KodeMataKuliah'] ?>"
                                    class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Are you sure you want to delete this course?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Mata Kuliah Modal -->
    <div x-show="showModal" class="fixed z-10 inset-0 overflow-y-auto" style="display: none;">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="save.php" method="POST">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="kodemk">Kode Mata
                                Kuliah</label>
                            <input type="text" name="kodemk" x-model="formData.kodemk" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="namamk">Nama Mata
                                Kuliah</label>
                            <input type="text" name="namamk" x-model="formData.namamk" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="sks">SKS</label>
                            <input type="number" name="sks" x-model="formData.sks" required min="1" max="6"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">Semester</label>
                            <input type="number" name="semester" x-model="formData.semester" required min="1" max="8"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Save
                        </button>
                        <button type="button" @click="showModal = false"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>