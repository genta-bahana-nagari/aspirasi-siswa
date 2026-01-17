<?php
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../includes/auth_check.php';
include "../../includes/header.php";
include "../../includes/sidebar.php";
?>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="mb-4">
        <h1 class="h3">Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Student') ?>!</h1>
        <p class="text-muted">Use the sidebar to navigate between your aspirations and other sections.</p>
    </div>

    <!-- Dashboard Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4 col-sm-6">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Aspirations</h5>
                    <h3 class="card-text">
                        <?php
                        $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM aspirations WHERE user_id = ?");
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $res = $stmt->get_result()->fetch_assoc();
                        echo $res['total'] ?? 0;
                        ?>
                    </h3>
                </div>
                <div class="card-footer bg-primary-light text-white">
                    <a href="aspiration/index.php" class="text-white text-decoration-none">View My Aspirations →</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Pending Aspirations</h5>
                    <h3 class="card-text">
                        <?php
                        $stmt = $conn->prepare("SELECT COUNT(*) AS pending FROM aspirations WHERE user_id = ? AND status = 'Terkirim'");
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $res = $stmt->get_result()->fetch_assoc();
                        echo $res['pending'] ?? 0;
                        ?>
                    </h3>
                </div>
                <div class="card-footer bg-success-light text-white">
                    <a href="aspiration/index.php" class="text-white text-decoration-none">View Pending →</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Completed Aspirations</h5>
                    <h3 class="card-text">
                        <?php
                        $stmt = $conn->prepare("SELECT COUNT(*) AS completed FROM aspirations WHERE user_id = ? AND status = 'Selesai'");
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $res = $stmt->get_result()->fetch_assoc();
                        echo $res['completed'] ?? 0;
                        ?>
                    </h3>
                </div>
                <div class="card-footer bg-warning-light text-white">
                    <a href="aspiration/index.php" class="text-white text-decoration-none">View Completed →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Aspirations Table (Optional) -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Recent Aspirations</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Dikirim</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->prepare("
                            SELECT a.*, c.name AS kategori 
                            FROM aspirations a
                            JOIN categories c ON a.category_id = c.id
                            WHERE a.user_id = ?
                            ORDER BY a.created_at DESC
                            LIMIT 5
                        ");
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $res = $stmt->get_result();
                        $aspirations = $res->fetch_all(MYSQLI_ASSOC);
                        foreach ($aspirations as $i => $a):
                        ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td class="p-2 border"><?= htmlspecialchars($a['kategori']) ?></td>
                            <td><?= htmlspecialchars($a['title']) ?></td>
                            <td><?= htmlspecialchars($a['description']) ?></td>
                            <td><?= date('d-m-Y', strtotime($a['created_at'])) ?></td>
                            <td>
                                <span class="badge bg-<?= match($a['status']) {
                                    'Terkirim' => 'secondary',
                                    'Diproses' => 'primary',
                                    'Selesai' => 'success',
                                    default => 'dark'
                                } ?>">
                                    <?= $a['status'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($aspirations)): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No aspirations submitted yet</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include "../../includes/footer.php"; ?>
