<?php
require_once "../../../config/db.php";
include "../../../includes/header.php";
include "../../../includes/sidebar.php";

$stmt = $conn->prepare("SELECT * FROM categories");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Kategori Aspirasi</h1>

    <div class="flex justify-end mb-4">
        <a href="create.php"
        class="inline-flex items-center gap-2
                bg-blue-600 hover:bg-blue-700
                text-white px-4 py-2 rounded shadow">
            <span class="text-lg">+</span>
            <span>Buat Kategori</span>
        </a>
    </div>

    <table class="w-full bg-white border mt-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">No</th>
                <th class="p-2 border">Nama Kategori</th>
                <th class="p-2 border">Dibuat</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $i => $c): ?>
            <tr>
                <td class="p-2 border"><?= $i + 1 ?></td>
                <td class="p-2 border"><?= htmlspecialchars($c['name']) ?></td>
                <td class="p-2 border">
                    <?= date('d-m-Y', strtotime($c['created_at'])) ?>
                </td>
                <td class="p-2 border text-center">
                    <a href="edit.php?id=<?= $c['id'] ?>" class="text-blue-600 mr-2">Edit</a>
                    <a href="delete.php?id=<?= $c['id'] ?>"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');"
                    class="text-red-600">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include "../../../includes/footer.php"; ?>
