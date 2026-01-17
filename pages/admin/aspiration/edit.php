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

$stmt = $conn->prepare("SELECT * FROM aspirations WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Aspirasi tidak ditemukan.");
}
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="main">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
    
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        Edit Status Aspirasi
                    </div>
    
                    <div class="card-body">
                        <form action="update.php" method="POST">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
    
                            <div class="mb-3">
                                <label class="form-label">Status Aspirasi</label>
                                <select name="status" class="form-select" required>
                                    <?php foreach ($statuses as $status): ?>
                                        <option value="<?= $status ?>"
                                            <?= ($data['status'] === $status) ? 'selected' : '' ?>>
                                            <?= $status ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
    
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>

<?php include '../../../includes/footer.php'; ?>
