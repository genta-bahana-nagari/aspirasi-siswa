<?php
require_once "../../../config/db.php";
include "../../../includes/header.php";
include "../../../includes/sidebar.php";

$aspirasiStmt = $conn->prepare("SELECT id, title FROM aspirations ORDER BY created_at DESC");
$aspirasiStmt->execute();
$aspirasiResult = $aspirasiStmt->get_result();
$aspirasiList = $aspirasiResult->fetch_all(MYSQLI_ASSOC);

$adminStmt = $conn->prepare("SELECT id, name FROM users WHERE role = 'admin' ORDER BY name ASC");
$adminStmt->execute();
$adminResult = $adminStmt->get_result();
$adminList = $adminResult->fetch_all(MYSQLI_ASSOC);
?>

<div class="main">
    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="mb-4">
            <h1 class="h3">Tambah Feedback Aspirasi</h1>
            <p>Isi form berikut untuk menambahkan feedback baru.</p>
        </div>

        <!-- Form Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form action="store.php" method="POST">

                    <!-- Dropdown Aspirasi -->
                    <div class="mb-3">
                        <label for="aspiration_id" class="form-label">Pilih Aspirasi</label>
                        <select name="aspiration_id" id="aspiration_id" class="form-select" required>
                            <option value="">-- Pilih Aspirasi --</option>
                            <?php foreach ($aspirasiList as $a): ?>
                                <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Dropdown Admin -->
                    <div class="mb-3">
                        <label for="admin_id" class="form-label">Pilih Admin</label>
                        <select name="admin_id" id="admin_id" class="form-select" required>
                            <option value="">-- Pilih Admin --</option>
                            <?php foreach ($adminList as $adm): ?>
                                <option value="<?= $adm['id'] ?>"><?= htmlspecialchars($adm['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Judul Feedback -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Feedback</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <!-- Isi Feedback -->
                    <div class="mb-3">
                        <label for="feedback" class="form-label">Isi Feedback</label>
                        <textarea name="feedback" id="feedback" class="form-control" rows="5" required></textarea>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary">Simpan Feedback</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>

                </form>

            </div>
        </div>

    </div>
</div>

<?php include "../../../includes/footer.php"; ?>
