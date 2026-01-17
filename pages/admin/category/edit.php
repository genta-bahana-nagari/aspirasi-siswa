<?php
require_once __DIR__ . '/../../../includes/auth_check.php';
require_once __DIR__ . '/../../../config/db.php';

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Kategori tidak ditemukan.");
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
                        Edit Kategori
                    </div>
    
                    <div class="card-body">
                        <form action="update.php" method="POST">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
    
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text"
                                       name="name"
                                       value="<?= htmlspecialchars($data['name']) ?>"
                                       class="form-control"
                                       required>
                            </div>
    
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update
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
