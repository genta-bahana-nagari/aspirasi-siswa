<?php
require_once __DIR__ . '/../../../includes/auth_check.php';
require_once __DIR__ . '/../../../config/db.php';

$stmt = $conn->prepare("
    SELECT a.*, u.name AS siswa, c.name AS kategori 
    FROM aspirations a
    JOIN users u ON a.user_id = u.id
    JOIN categories c ON a.category_id = c.id
    ORDER BY a.created_at DESC
");

$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Aspirasi Siswa</h1>

    <table class="w-full bg-white border mt-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">No.</th>
                <th class="p-2 border">Nama Siswa</th>
                <th class="p-2 border">Kategori</th>
                <th class="p-2 border">Judul</th>
                <th class="p-2 border">Deskripsi</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $i => $a): ?>
            <tr>
                <td class="p-2 border"><?= $i + 1 ?></td>
                <td class="p-2 border"><?= $a['siswa'] ?></td>
                <td class="p-2 border"><?= $a['kategori'] ?></td>
                <td class="p-2 border"><?= htmlspecialchars($a['title']) ?></td>
                <td class="p-2 border"><?= htmlspecialchars($a['description']) ?></td>
                <td class="p-2 border"><?= date('d-m-Y', strtotime($a['created_at'])) ?></td>
                <td class="p-2 border font-semibold"><?= $a['status'] ?></td>
                <td class="p-2 border text-center">
            
                <a href="edit.php?id=<?= $a['id'] ?>"
                    class="text-blue-600">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../../../includes/footer.php'; ?>
