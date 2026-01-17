<?php
require_once __DIR__ . '/../../config/app.php';
require_once BASE_PATH . '/includes/auth_check.php';
require_once BASE_PATH . '/config/db.php';

include BASE_PATH . '/includes/header.php';
include BASE_PATH . '/includes/sidebar.php';
?>

<div class="main">
    <div class="container-fluid py-4">

        <!-- Header Halaman -->
        <div class="mb-4">
            <h1 class="h3">
                Selamat Datang, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Siswa') ?>!
            </h1>
            <p class="text-muted">
                Gunakan menu di samping untuk mengelola aspirasi dan melihat informasi lainnya.
            </p>
        </div>

        <!-- Kartu Ringkasan -->
        <div class="row g-4 mb-4">

            <!-- Total Aspirasi -->
            <div class="col-md-4 col-sm-6">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total Aspirasi</h5>
                        <h3 class="card-text">
                            <?php
                            $stmt = $conn->prepare(
                                "SELECT COUNT(*) AS total FROM aspirations WHERE user_id = ?"
                            );
                            $stmt->bind_param("i", $_SESSION['user_id']);
                            $stmt->execute();
                            $res = $stmt->get_result()->fetch_assoc();
                            echo $res['total'] ?? 0;
                            ?>
                        </h3>
                    </div>
                    <div class="card-footer bg-primary-light text-white">
                        <a href="aspiration/index.php" class="text-white text-decoration-none">
                            Lihat Semua Aspirasi →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Aspirasi Terkirim -->
            <div class="col-md-4 col-sm-6">
                <div class="card text-white bg-success h-100">
                    <div class="card-body">
                        <h5 class="card-title">Aspirasi Terkirim</h5>
                        <h3 class="card-text">
                            <?php
                            $stmt = $conn->prepare(
                                "SELECT COUNT(*) AS pending 
                                 FROM aspirations 
                                 WHERE user_id = ? AND status = 'Terkirim'"
                            );
                            $stmt->bind_param("i", $_SESSION['user_id']);
                            $stmt->execute();
                            $res = $stmt->get_result()->fetch_assoc();
                            echo $res['pending'] ?? 0;
                            ?>
                        </h3>
                    </div>
                    <div class="card-footer bg-success-light text-white">
                        <a href="aspiration/index.php" class="text-white text-decoration-none">
                            Lihat Aspirasi Terkirim →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Aspirasi Selesai -->
            <div class="col-md-4 col-sm-6">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body">
                        <h5 class="card-title">Aspirasi Selesai</h5>
                        <h3 class="card-text">
                            <?php
                            $stmt = $conn->prepare(
                                "SELECT COUNT(*) AS completed 
                                 FROM aspirations 
                                 WHERE user_id = ? AND status = 'Selesai'"
                            );
                            $stmt->bind_param("i", $_SESSION['user_id']);
                            $stmt->execute();
                            $res = $stmt->get_result()->fetch_assoc();
                            echo $res['completed'] ?? 0;
                            ?>
                        </h3>
                    </div>
                    <div class="card-footer bg-warning-light text-white">
                        <a href="aspiration/index.php" class="text-white text-decoration-none">
                            Lihat Aspirasi Selesai →
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tabel Aspirasi Terbaru -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Aspirasi Terbaru</h5>
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
                        $aspirations = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        ?>

                        <?php foreach ($aspirations as $i => $a): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= htmlspecialchars($a['kategori']) ?></td>
                                <td><?= htmlspecialchars($a['title']) ?></td>
                                <td><?= htmlspecialchars($a['description']) ?></td>
                                <td><?= date('d-m-Y', strtotime($a['created_at'])) ?></td>
                                <td>
                                    <span class="badge bg-<?= match ($a['status']) {
                                        'Terkirim' => 'secondary',
                                        'Diproses' => 'primary',
                                        'Selesai'   => 'success',
                                        default     => 'dark'
                                    } ?>">
                                        <?= $a['status'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($aspirations)): ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">
                                    Belum ada aspirasi yang dikirim
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

<?php include BASE_PATH . '/includes/footer.php'; ?>
