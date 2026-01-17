<?php
require_once __DIR__ . '/../../../includes/auth_check.php';
require_once __DIR__ . '/../../../config/db.php';

$statuses = [
    'Terkirim',
    'Diproses',
    'Dalam Perbaikan',
    'Selesai'
];

$id = (int)$_GET['id'];

$stmt = $conn->prepare("
    SELECT * FROM aspirations
    WHERE id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Aspirasi tidak bisa diedit.");
}
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Edit Aspirasi</h1>

    <form action="update.php" method="POST" class="space-y-4">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div>
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" required
                    class="w-full border p-2 rounded">
                <?php foreach ($statuses as $status): ?>
                    <option value="<?= $status ?>"
                        <?= ($data['status'] === $status) ? 'selected' : '' ?>>
                        <?= $status ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>

<?php include '../../../includes/footer.php'; ?>
