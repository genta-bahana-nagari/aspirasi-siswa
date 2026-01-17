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

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">
                    <?= isset($data) ? 'Edit Aspirasi' : 'Kirim Aspirasi' ?>
                </div>

                <div class="card-body">
                    <form action="<?= isset($data) ? 'update.php' : 'store.php' ?>" method="POST" class="space-y-3">
                        <?php if (isset($data)): ?>
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label">Judul Aspirasi</label>
                            <input type="text" name="title" required
                                   value="<?= $data['title'] ?? '' ?>"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" required class="form-select">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($categories as $c): ?>
                                    <option value="<?= $c['id'] ?>"
                                        <?= isset($data) && $c['id'] == $data['category_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($c['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" required class="form-control" rows="5"><?= $data['description'] ?? '' ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">
                                <?= isset($data) ? 'Update' : 'Kirim' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include '../../../includes/footer.php'; ?>
