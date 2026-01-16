<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM aspirations
    WHERE id = ? AND user_id = ? AND status = 'Terkirim'
");
$stmt->execute([$id, $_SESSION['user_id']]);
$data = $stmt->fetch();

if (!$data) die("Aspirasi tidak bisa diedit.");

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Edit Aspirasi</h1>

    <form action="update.php" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <input type="text" name="title" required
               value="<?= htmlspecialchars($data['title']) ?>"
               class="w-full border p-2 rounded">

        <select name="category_id" class="w-full border p-2 rounded">
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"
                    <?= $c['id'] == $data['category_id'] ? 'selected' : '' ?>>
                    <?= $c['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <textarea name="description" required
                  class="w-full border p-2 rounded"><?= htmlspecialchars($data['description']) ?></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>

<?php include '../../../includes/footer.php'; ?>
