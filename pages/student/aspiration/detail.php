<?php
require_once "../../../config/db.php";
require_once "../../../includes/auth_check.php"; 
include "../../../includes/header.php";
include "../../../includes/sidebar.php";

if (!isset($_GET['id'])) {
    die("ID aspirasi tidak ditemukan.");
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("
    SELECT a.*, u.name AS siswa, c.name AS kategori
    FROM aspirations a
    JOIN users u ON a.user_id = u.id
    JOIN categories c ON a.category_id = c.id
    WHERE a.id = ?
    LIMIT 1
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$aspirasi = $result->fetch_assoc();

if (!$aspirasi) {
    die("Aspirasi tidak ditemukan.");
}

$feedbackStmt = $conn->prepare("
    SELECT af.*, u.name AS admin_name
    FROM aspiration_feedbacks af
    JOIN users u ON af.admin_id = u.id
    WHERE af.aspiration_id = ?
    ORDER BY af.id DESC
");
$feedbackStmt->bind_param("i", $id);
$feedbackStmt->execute();
$feedbacks = $feedbackStmt->get_result();
?>

<div class="main">
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="h3">Detail Aspirasi</h1>
            <p class="text-muted">Informasi lengkap aspirasi siswa.</p>
        </div>

        <!-- Card Detail -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th style="width:150px;">Nama Siswa</th>
                            <td><?= htmlspecialchars($aspirasi['siswa']) ?></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td><?= htmlspecialchars($aspirasi['kategori']) ?></td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td><?= htmlspecialchars($aspirasi['title']) ?></td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td><?= nl2br(htmlspecialchars($aspirasi['description'])) ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php
                                $badge = match ($aspirasi['status']) {
                                    'Terkirim' => 'secondary',
                                    'Diproses' => 'primary',
                                    'Dalam Perbaikan' => 'warning',
                                    'Selesai' => 'success',
                                    default => 'dark'
                                };
                                ?>
                                <span class="badge bg-<?= $badge ?>"><?= $aspirasi['status'] ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Dikirim</th>
                            <td><?= date('d-m-Y H:i', strtotime($aspirasi['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Diperbarui</th>
                            <td>
                                <?= $aspirasi['updated_at'] 
                                    ? date('d-m-Y H:i', strtotime($aspirasi['updated_at'])) 
                                    : 'Belum Diperbarui' 
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-3">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Aspirasi
                    </a>
                    <?php if ($aspirasi['status'] === 'Terkirim'): ?>
                        <a href="edit.php?id=<?= $aspirasi['id'] ?>" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <a href="delete.php?id=<?= $aspirasi['id'] ?>" 
                           onclick="return confirm('Yakin ingin menghapus aspirasi ini?');"
                           class="btn btn-danger">
                            <i class="bi bi-trash"></i> Hapus
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white fw-bold">
                Feedback Admin
            </div>

            <div class="card-body">

                <?php if ($feedbacks->num_rows === 0): ?>
                    <!-- Fallback -->
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-chat-square-text fs-1 mb-2 d-block"></i>
                        <p class="mb-0">Belum ada feedback dari admin.</p>
                    </div>
                <?php else: ?>
                    <?php while ($fb = $feedbacks->fetch_assoc()): ?>
                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1 fw-bold">
                                        <?= htmlspecialchars($fb['title']) ?>
                                    </h6>
                                    <small class="text-muted">
                                        Oleh <?= htmlspecialchars($fb['admin_name']) ?>
                                    </small>
                                </div>

                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <a href="../feedback/delete.php?id=<?= $fb['id'] ?>"
                                    onclick="return confirm('Hapus feedback ini?')"
                                    class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <hr class="my-2">

                            <p class="mb-0">
                                <?= nl2br(htmlspecialchars($fb['feedback'])) ?>
                            </p>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php include "../../../includes/footer.php"; ?>
