<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Buat Kategori</h1>

    <form action="store.php" method="POST" class="space-y-4">
        <input type="text" name="name" required
               placeholder="Nama Kategori"
               class="w-full border p-2 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Kirim
        </button>
    </form>
</div>

<?php include '../../../includes/footer.php'; ?>
