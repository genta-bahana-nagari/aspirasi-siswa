<?php
require_once __DIR__ . '/../../../includes/auth_check.php';
require_once __DIR__ . '/../../../config/db.php';

$id = (int)$_GET['id'];

$stmt = $conn->prepare("
    SELECT * FROM categories
    WHERE id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Kategori tidak bisa diedit.");
}
$result = $conn->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Edit Kategori</h1>

    <form action="update.php" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <input type="text" name="name" required
               value="<?= htmlspecialchars($data['name']) ?>"
               class="w-full border p-2 rounded">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>

<?php include '../../../includes/footer.php'; ?>
