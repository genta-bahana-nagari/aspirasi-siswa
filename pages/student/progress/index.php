<?php
require_once "../../../includes/auth_check.php";
require_once "../../../config/db.php";

if ($_SESSION['role'] !== 'student') {
    die("Akses ditolak");
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT 
        a.id,
        a.title,
        a.status,
        a.created_at,
        c.name AS kategori,
        af.title AS feedback_title,
        af.feedback AS feedback_text,
        af.id AS feedback_id
    FROM aspirations a
    JOIN categories c ON a.category_id = c.id
    LEFT JOIN aspiration_feedbacks af ON af.aspiration_id = a.id
    WHERE a.user_id = ?
    ORDER BY a.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include "../../../includes/header.php"; ?>
<?php include "../../../includes/sidebar.php"; ?>

<div class="main">
    <div class="container-fluid py-4">

        <div class="mb-4">
            <h1 class="h3">Progress Aspirasi Saya</h1>
            <p class="text-muted">
                Pantau status dan feedback dari aspirasi yang telah Anda ajukan.
            </p>
        </div>

        <?php if ($result->num_rows === 0): ?>
            <!-- Fallback jika belum pernah mengajukan -->
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center text-muted py-5">
                    <i class="bi bi-inbox fs-1 mb-3 d-block"></i>
                    <p class="mb-0">Anda belum mengajukan aspirasi.</p>
                </div>
            </div>
        <?php else: ?>

            <?php while ($row = $result->fetch_assoc()): ?>

                <?php
                $badge = match ($row['status']) {
                    'Terkirim' => 'secondary',
                    'Diproses' => 'primary',
                    'Dalam Perbaikan' => 'warning',
                    'Selesai' => 'success',
                    default => 'dark'
                };
                ?>

                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">
                                    <?= htmlspecialchars($row['title']) ?>
                                </h5>
                                <small class="text-muted">
                                    Kategori: <?= htmlspecialchars($row['kategori']) ?>
                                </small>
                            </div>

                            <span class="badge bg-<?= $badge ?>">
                                <?= $row['status'] ?>
                            </span>
                        </div>

                        <hr>

                        <!-- Feedback Admin -->
                        <h6 class="fw-bold mb-2">Feedback Admin</h6>

                        <?php if ($row['feedback_id'] === null): ?>
                            <p class="text-muted mb-0">
                                Belum ada feedback dari admin.
                            </p>
                        <?php else: ?>
                            <div class="border rounded p-3 bg-light">
                                <strong><?= htmlspecialchars($row['feedback_title']) ?></strong>
                                <p class="mb-0 mt-2">
                                    <?= nl2br(htmlspecialchars($row['feedback_text'])) ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <small class="text-muted d-block mt-3">
                            Dikirim pada <?= date('d-m-Y H:i', strtotime($row['created_at'])) ?>
                        </small>

                    </div>
                </div>

            <?php endwhile; ?>

        <?php endif; ?>

    </div>
</div>

<?php include "../../../includes/footer.php"; ?>
