<?php
require_once __DIR__ . '/../../../includes/auth_check.php';
require_once __DIR__ . '/../../../config/db.php';

$id = (int)$_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT * FROM aspirations
    WHERE id = ? AND user_id = ? AND status = 'Terkirim'
");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Aspirasi tidak bisa diedit.");
}
$result = $conn->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $result->fetch_all(MYSQLI_ASSOC);
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
                    <?= htmlspecialchars($c['name']) ?>
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
