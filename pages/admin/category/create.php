<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';
?>

<?php include '../../../includes/header.php'; ?>
<?php include '../../../includes/sidebar.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white fw-bold">
                    Buat Kategori
                </div>

                <div class="card-body">
                    <form action="store.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="Masukkan nama kategori"
                                   required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">
                                Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include '../../../includes/footer.php'; ?>
