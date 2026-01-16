<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("
    SELECT a.*, c.name AS kategori
    FROM aspirations a
    JOIN categories c ON a.category_id = c.id
    WHERE a.user_id = ?
    ORDER BY a.created_at DESC
");
$stmt->execute([$user_id]);
$data = $stmt->fetchAll();
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Aspirasi Saya</h1>

    <a href="create.php"
       class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
       + Kirim Aspirasi
    </a>

    <table class="w-full bg-white border mt-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Judul</th>
                <th class="p-2 border">Kategori</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $a): ?>
            <tr>
                <td class="p-2 border"><?= date('d-m-Y', strtotime($a['created_at'])) ?></td>
                <td class="p-2 border"><?= htmlspecialchars($a['title']) ?></td>
                <td class="p-2 border"><?= $a['kategori'] ?></td>
                <td class="p-2 border font-semibold"><?= $a['status'] ?></td>
                <td class="p-2 border text-center">
                    <?php if ($a['status'] === 'Terkirim'): ?>
                        <a href="edit.php?id=<?= $a['id'] ?>"
                           class="text-blue-600">Edit</a>
                    <?php else: ?>
                        <span class="text-gray-400">—</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../../../includes/footer.php'; ?>
