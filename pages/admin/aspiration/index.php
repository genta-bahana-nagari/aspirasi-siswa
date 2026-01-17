<?php
require_once __DIR__ . '/../../../includes/auth_check.php';
require_once __DIR__ . '/../../../config/db.php';

$tanggal   = $_GET['tanggal'] ?? '';
$bulan     = $_GET['bulan'] ?? '';
$siswa     = $_GET['siswa'] ?? '';
$kategori  = $_GET['kategori'] ?? '';

$where = [];
$params = [];
$types = '';

if ($tanggal) {
    $where[] = "DATE(a.created_at) = ?";
    $params[] = $tanggal;
    $types .= 's';
}

if ($bulan) {
    $where[] = "DATE_FORMAT(a.created_at, '%Y-%m') = ?";
    $params[] = $bulan;
    $types .= 's';
}

if ($siswa) {
    $where[] = "a.user_id = ?";
    $params[] = $siswa;
    $types .= 'i';
}

if ($kategori) {
    $where[] = "a.category_id = ?";
    $params[] = $kategori;
    $types .= 'i';
}

$sql = "
    SELECT a.*, u.name AS siswa, c.name AS kategori
    FROM aspirations a
    JOIN users u ON a.user_id = u.id
    JOIN categories c ON a.category_id = c.id
";

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY a.created_at DESC";

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();

$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$siswaList = $conn->query("SELECT id, name FROM users WHERE role = 'student' ORDER BY name")->fetch_all(MYSQLI_ASSOC);
$kategoriList = $conn->query("SELECT id, name FROM categories ORDER BY name")->fetch_all(MYSQLI_ASSOC);
?>


<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Daftar Aspirasi Siswa</h3>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">

                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                        value="<?= htmlspecialchars($tanggal) ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Bulan</label>
                    <input type="month" name="bulan" class="form-control"
                        value="<?= htmlspecialchars($bulan) ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Siswa</label>
                    <select name="siswa" class="form-select">
                        <option value="">Semua</option>
                        <?php foreach ($siswaList as $s): ?>
                            <option value="<?= $s['id'] ?>"
                                <?= ($siswa == $s['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($s['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua</option>
                        <?php foreach ($kategoriList as $k): ?>
                            <option value="<?= $k['id'] ?>"
                                <?= ($kategori == $k['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($k['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-end gap-2">
                    <a href="index.php" class="btn btn-secondary">
                        Reset
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Filter
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Card -->
    <div class="card shadow-sm border-0">
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
                                <a href="edit.php?id=<?= $a['id'] ?>"
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
</div>

<?php include '../../../includes/footer.php'; ?>
