<?php
require_once "../../../config/db.php";
include "../../../includes/header.php";
include "../../../includes/sidebar.php";

$stmt = $conn->prepare("SELECT * FROM categories");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="main">
    <div class="container-fluid py-4">
    
        <!-- Header -->
        <div class="mb-4">
            <h1 class="h3">Kategori Aspirasi</h1>
            <p>Atur kategori disini.</p>
        </div>
    
        <!-- Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
    
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Nama Kategori</th>
                            <th style="width:160px;">Dibuat</th>
                            <th style="width:160px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $i => $c): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="fw-semibold">
                                <?= htmlspecialchars($c['name']) ?>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <?= date('d-m-Y', strtotime($c['created_at'])) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $c['id'] ?>"
                                   class="btn btn-sm btn-warning me-1">
                                    Edit
                                </a>
                                <a href="delete.php?id=<?= $c['id'] ?>"
                                   onclick="return confirm('Yakin ingin menghapus kategori ini?');"
                                   class="btn btn-sm btn-danger">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
    
                    <?php if (empty($data)): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Belum ada kategori
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
    
            </div>
        </div>
    </div>
</div>

<?php include "../../../includes/footer.php"; ?>
