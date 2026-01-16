<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaduan Sarana Sekolah | SMKN 1 XX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">SMKN 1 XX</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#alur">Alur</a></li>
                <li class="nav-item">
                    <a class="btn btn-light btn-sm mt-1 " href="auth/login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="py-5 bg-white">
    <div class="container text-center">
        <h1 class="fw-bold mb-3">Pengaduan Sarana Sekolah</h1>
        <p class="text-muted mb-4">
            Laporkan kerusakan fasilitas sekolah dengan mudah, cepat, dan transparan.
        </p>
        <a href="auth/login.php" class="btn btn-primary btn-lg me-2">Buat Pengaduan</a>
        <a href="auth/register.php" class="btn btn-outline-secondary btn-lg">Daftar Akun</a>
    </div>
</section>

<!-- Fitur -->
<section id="fitur" class="py-5">
    <div class="container">
        <div class="row text-center mb-4">
            <h2 class="fw-bold">Fitur Utama</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center p-3">
                    <h5 class="fw-bold">Mudah Digunakan</h5>
                    <p class="text-muted">
                        Siswa dapat mengirim pengaduan hanya dalam beberapa langkah.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center p-3">
                    <h5 class="fw-bold">Transparan</h5>
                    <p class="text-muted">
                        Status pengaduan dapat dipantau secara real-time.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center p-3">
                    <h5 class="fw-bold">Respons Cepat</h5>
                    <p class="text-muted">
                        Pihak sekolah dapat langsung menindaklanjuti laporan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Alur Pengaduan -->
<section id="alur" class="py-5 bg-white">
    <div class="container">
        <div class="row text-center mb-4">
            <h2 class="fw-bold">Alur Pengaduan</h2>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <p class="fw-bold">1. Login</p>
                <p class="text-muted">Masuk menggunakan akun siswa</p>
            </div>
            <div class="col-md-3">
                <p class="fw-bold">2. Isi Laporan</p>
                <p class="text-muted">Jelaskan kerusakan fasilitas</p>
            </div>
            <div class="col-md-3">
                <p class="fw-bold">3. Proses</p>
                <p class="text-muted">Laporan diverifikasi petugas</p>
            </div>
            <div class="col-md-3">
                <p class="fw-bold">4. Selesai</p>
                <p class="text-muted">Sarana diperbaiki</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white py-3">
    <div class="container text-center">
        <small>
            © 2026 SMKN 1 XX | Sistem Pengaduan Sarana Sekolah
        </small>
    </div>
</footer>

<script src="
