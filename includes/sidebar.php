<?php
$role = $_SESSION['role'];
$base = $role === 'admin' ? '/aspirasi-siswa/pages/admin' : '/aspirasi-siswa/pages/student';
?>

<div class="sidebar">
    <h5 class="text-center mb-4"><?= ucfirst($role) ?> Menu</h5>

    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    function active($page) {
        global $current_page;
        return $current_page === $page ? 'active' : '';
    }
    ?>

    <a href="<?=  $base ?>/index.php ?>" class="<?= active('<?=  $base ?>/index.php ?>') ?>">Dashboard</a>
    <a href="<?=  $base ?>/aspiration/index.php ?>" class="<?= active('<?=  $base ?>/aspiration/index.php ?>') ?>">Aspirasi</a>
    <a href="<?=  $base ?>/history/index.php ?>" class="<?= active('<?=  $base ?>/history/index.php ?>') ?>">Histori</a>
    
    <?php if ($role === 'admin'): ?>
        <a href="<?=  $base ?>/category/index.php ?>" class="<?=  $base ?>/category/index.php ?>">Kategori Aspirasi</a>
        <a href="<?=  $base ?>/user/index.php ?>" class="<?= active('<?=  $base ?>/user/index.php ?>') ?>">Pengguna</a>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../../auth/logout.php" class="btn btn-danger btn-sm w-75">
            Logout
        </a>
    </div>
</div>

<div class="main">
