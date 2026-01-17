<?php
include "../../includes/header.php";
include "../../includes/sidebar.php";
?>

<?php
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../config/db.php';

$stmt = $conn->prepare("
    SELECT a.*, u.name AS siswa, c.name AS kategori 
    FROM aspirations a
    JOIN users u ON a.user_id = u.id
    JOIN categories c ON a.category_id = c.id
    ORDER BY a.created_at DESC
    LIMIT 5
");

$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="main">
    <div class="container-fluid py-4">
        <!-- Header Halaman -->
        <div class="mb-4">
            <h1 class="h3">Selamat Datang, Admin!</h1>
            <small class="text-muted">Kelola siswa dan aspirasi sekolah di sini.</small>
        </div>
    
        <!-- Kartu Dashboard -->
        <div class="row g-4 mb-4">
            <div class="col-md-4 col-sm-6">
                <div class="card text-white bg-primary h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Siswa</h5>
                            <h3 class="card-text">120</h3>
                        </div>
                        <i class="bi bi-people-fill fs-1"></i>
                    </div>
                    <div class="card-footer bg-primary-light text-white">
                        <a href="student-user/index.php" class="text-white text-decoration-none">Lihat Siswa →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card text-white bg-success h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Kategori</h5>
                            <h3 class="card-text">8</h3>
                        </div>
                        <i class="bi bi-tags-fill fs-1"></i>
                    </div>
                    <div class="card-footer bg-success-light text-white">
                        <a href="category/index.php" class="text-white text-decoration-none">Kelola Kategori →</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card text-white bg-warning h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Aspirasi Menunggu</h5>
                            <h3 class="card-text">15</h3>
                        </div>
                        <i class="bi bi-hourglass-split fs-1"></i>
                    </div>
                    <div class="card-footer bg-warning-light text-white">
                        <a href="aspiration/index.php" class="text-white text-decoration-none">Lihat Aspirasi →</a>
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
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px;">No</th>
                                <th>Nama Siswa</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width:130px;">Tanggal</th>
                                <th style="width:140px;">Status</th>
                                <th style="width:90px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data as $i => $a): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td class="fw-semibold"><?= htmlspecialchars($a['siswa']) ?></td>
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
                                    <span class="badge bg-<?= $badge ?>">
                                        <?= $a['status'] ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="./aspiration/edit.php?id=<?= $a['id'] ?>"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
    
                        <?php if (empty($data)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada aspirasi
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <!-- Aksi Cepat -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <i class="bi bi-person-plus-fill fs-1 mb-3 text-primary"></i>
                        <h5 class="card-title">Lihat Aspirasi Siswa</h5>
                        <a href="aspiration/index.php" class="btn btn-primary mt-2">Lihat Aspirasi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <i class="bi bi-plus-square-fill fs-1 mb-3 text-success"></i>
                        <h5 class="card-title">Tambah Kategori Baru</h5>
                        <a href="category/create.php" class="btn btn-success mt-2">Tambah Kategori</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center h-100">
                    <div class="card-body d-flex flex-column justify-content-center">
                        <i class="bi bi-journal-text fs-1 mb-3 text-warning"></i>
                        <h5 class="card-title">Beri Feedback</h5>
                        <a href="feedback/create.php" class="btn btn-warning mt-2">Beri Feedback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../../includes/footer.php"; ?>
