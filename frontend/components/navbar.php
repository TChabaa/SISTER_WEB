<?php
$current_page = basename(dirname($_SERVER['PHP_SELF']));
?>
<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/sister2/frontend/index.php" class="text-xl font-bold text-gray-800">UMS</a>
                </div>
                <div class="hidden md:ml-6 md:flex md:space-x-8">
                    <a href="/sister2/frontend/mahasiswa/index.php"
                        class="inline-flex items-center px-1 pt-1 <?= $current_page === 'mahasiswa' ? 'border-b-2 border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' ?>">
                        Mahasiswa
                    </a>
                    <a href="/sister2/frontend/dosen/index.php"
                        class="inline-flex items-center px-1 pt-1 <?= $current_page === 'dosen' ? 'border-b-2 border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' ?>">
                        Dosen
                    </a>
                    <a href="/sister2/frontend/matakuliah/index.php"
                        class="inline-flex items-center px-1 pt-1 <?= $current_page === 'matakuliah' ? 'border-b-2 border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700' ?>">
                        Mata Kuliah
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>