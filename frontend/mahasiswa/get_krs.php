<?php
require_once '../../routing/config.php';

if (isset($_GET['nim'])) {
    $stmt = $pdo->prepare('SELECT k.ID_KRS, k.NIM, k.KodeMataKuliah, k.NIP, k.Nilai, m.NamaMataKuliah, d.Nama as NamaDosen 
                          FROM KRS k 
                          JOIN MataKuliah m ON k.KodeMataKuliah = m.KodeMataKuliah 
                          JOIN Dosen d ON k.NIP = d.NIP 
                          WHERE k.NIM = ?');
    $stmt->execute([$_GET['nim']]);
    $krs_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<div class="krs-table-container">';
    if (count($krs_list) > 0) {
        echo '<table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">';
        
        foreach ($krs_list as $krs) {
            echo '<tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' . htmlspecialchars($krs['NamaMataKuliah']) . '</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' . htmlspecialchars($krs['NamaDosen']) . '</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">' . htmlspecialchars($krs['Nilai']) . '</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="edit_krs.php?id=' . $krs['ID_KRS'] . '" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                        <a href="delete_krs.php?id=' . $krs['ID_KRS'] . '" class="text-red-600 hover:text-red-900" onclick="return confirm(\'Are you sure you want to delete this KRS?\');">Delete</a>
                    </td>
                </tr>';
        }
        
        echo '</tbody></table>';
    } else {
        echo '<p class="text-gray-500 text-center py-4">No KRS records found.</p>';
    }
    echo '</div>';
}
?>