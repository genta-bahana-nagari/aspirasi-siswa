<?php
if (!defined('BASE_URL')) {
    require_once __DIR__ . '/../config/app.php';
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$role = $_SESSION['role'] ?? 'student';

$base = ($role === 'admin')
    ? BASE_URL . '/pages/admin'
    : BASE_URL . '/pages/student';

$current_path = $_SERVER['PHP_SELF'];

function activePath($path)
{
    global $current_path;
    return str_contains($current_path, $path) ? 'active' : '';
}
?>

<div class="sidebar">
    <h5 class="text-center mb-4"><?= ucfirst($role) ?> Menu</h5>

    <a href="<?= $base ?>/index.php">
        Dashboard
    </a>

    <?php if ($role === 'admin'): ?>
        <a href="<?= $base ?>/category/index.php"
           class="<?= activePath('/category/') ?>">
            Kategori Aspirasi
        </a>
    <?php endif; ?>

    <a href="<?= $base ?>/aspiration/index.php"
       class="<?= activePath('/aspiration/') ?>">
        Aspirasi
    </a>

    <?php if ($role === 'student'): ?>
    <a href="<?= $base ?>/history/index.php"
       class="<?= activePath('/history/') ?>">
        Histori
    </a>
    <?php endif; ?>
    
    <?php if ($role === 'admin'): ?>
        <a href="<?= $base ?>/feedback/index.php"
           class="<?= activePath('/feedback/') ?>">
            Feedback
        </a>
    <?php endif; ?>

    <?php if ($role === 'admin'): ?>
        <a href="<?= $base ?>/student-user/index.php"
           class="<?= activePath('/student-user/') ?>">
            Siswa
        </a>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= BASE_URL ?>/auth/logout.php"
           class="btn btn-danger btn-sm w-75">
            Logout
        </a>
    </div>
</div>
