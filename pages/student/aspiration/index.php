<?php
require_once __DIR__ . '/../../../includes/auth_check.php';
require_once __DIR__ . '/../../../config/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT a.*, c.name AS kategori
    FROM aspirations a
    JOIN categories c ON a.category_id = c.id
    WHERE a.user_id = ?
    ORDER BY a.created_at DESC
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="main">
    <div class="container-fluid py-4">
    
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3">Aspirasi Saya</h1>
                <p class="text-muted">Daftar aspirasi yang sudah diajukan.</p>
            </div>
            <div>
                <a href="create.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Kirim Aspirasi
                </a>
            </div>
        </div>
    
        <!-- Table Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px;">No</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width:130px;">Tanggal</th>
                                <th style="width:120px;">Status</th>
                                <th style="width:200px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $i => $a): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($a['kategori']) ?></td>
                                <td><?= htmlspecialchars($a['title']) ?></td>
                                <td class="text-muted"><?= htmlspecialchars($a['description']) ?></td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?= date('d-m-Y', strtotime($a['created_at'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $badge = match ($a['status']) {
                                        'Terkirim' => 'secondary',
                                        'Diproses' => 'primary',
                                        'Dalam Perbaikan' => 'warning',
                                        'Selesai' => 'success',
                                        default => 'dark'
                                    };
                                    ?>
                                    <span class="badge bg-<?= $badge ?>"><?= $a['status'] ?></span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Aksi Aspirasi">
                                        <a href="detail.php?id=<?= $a['id'] ?>" 
                                        class="btn btn-sm btn-info" 
                                        title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <?php if ($a['status'] === 'Terkirim'): ?>
                                        <a href="edit.php?id=<?= $a['id'] ?>" 
                                        class="btn btn-sm btn-warning" 
                                        title="Edit Aspirasi">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <?php else: ?>
                                        <button class="btn btn-sm btn-warning disabled" title="Tidak bisa diedit">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <?php endif; ?>

                                        <?php if ($a['status'] === 'Terkirim'): ?>
                                        <a href="delete.php?id=<?= $a['id'] ?>" 
                                        onclick="return confirm('Yakin ingin menghapus aspirasi ini?');"
                                        class="btn btn-sm btn-danger" 
                                        title="Hapus Aspirasi">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <?php else: ?>
                                        <button class="btn btn-sm btn-danger disabled" title="Tidak bisa dihapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                            <?php if (empty($data)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada aspirasi
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    
    </div>
</div>

<?php include '../../../includes/footer.php'; ?>
