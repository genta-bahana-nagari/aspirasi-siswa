<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

$stmt = $conn->prepare("
    SELECT * FROM categories
");
$stmt->execute();
$result = $stmt->get_result();
$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Kirim Aspirasi</h1>

    <form action="store.php" method="POST" class="space-y-4">
        <input type="text" name="title" required
               placeholder="Judul Aspirasi"
               class="w-full border p-2 rounded">

        <select name="category_id" required class="w-full border p-2 rounded">
            <option value="">Pilih Kategori</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <textarea name="description" required
                  placeholder="Deskripsi Aspirasi"
                  class="w-full border p-2 rounded"></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Kirim
        </button>
    </form>
</div>

<?php include '../../../includes/footer.php'; ?>
