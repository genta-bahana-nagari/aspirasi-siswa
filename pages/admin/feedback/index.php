<?php
require_once "../../../config/db.php";
include "../../../includes/header.php";
include "../../../includes/sidebar.php";

// Ambil semua feedback dengan info aspirasi dan admin
$stmt = $conn->prepare("
    SELECT af.id AS feedback_id,
           af.title AS feedback_title,
           af.feedback AS feedback_text,
           a.title AS aspiration_title,
           u1.name AS aspirasi_owner,
           u2.name AS admin_name
    FROM aspiration_feedbacks af
    JOIN aspirations a ON af.aspiration_id = a.id
    JOIN users u1 ON a.user_id = u1.id
    JOIN users u2 ON af.admin_id = u2.id
    ORDER BY af.id DESC
");
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="main">
    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3">Feedback Aspirasi</h1>
                <p>Kelola feedback yang diberikan oleh admin untuk aspirasi pengguna.</p>
            </div>
            <div>
                <a href="create.php" class="btn btn-primary">
                    + Tambah Feedback
                </a>
            </div>
        </div>

        <!-- Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">No</th>
                            <th>Judul Feedback</th>
                            <th>Aspirasi</th>
                            <th>Aspirasi Dari</th>
                            <th>Admin</th>
                            <th>Isi Feedback</th>
                            <th style="width:160px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $i => $f): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($f['feedback_title']) ?></td>
                                <td><?= htmlspecialchars($f['aspiration_title']) ?></td>
                                <td><?= htmlspecialchars($f['aspirasi_owner']) ?></td>
                                <td><?= htmlspecialchars($f['admin_name']) ?></td>
                                <td><?= nl2br(htmlspecialchars($f['feedback_text'])) ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $f['feedback_id'] ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                                    <a href="delete.php?id=<?= $f['feedback_id'] ?>" onclick="return confirm('Yakin ingin menghapus feedback ini?');" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada feedback aspirasi
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
