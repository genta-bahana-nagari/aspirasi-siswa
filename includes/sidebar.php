<div class="sidebar">
    <h5 class="text-center mb-4"><?= ucfirst($role) ?> Menu</h5>

    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    function active($page) {
        global $current_page;
        return $current_page === $page ? 'active' : '';
    }
    ?>

    <a href="dashboard.php" class="<?= active('dashboard.php') ?>">Dashboard</a>
    <a href="create.php" class="<?= active('create.php') ?>">Create</a>
    <a href="read.php" class="<?= active('read.php') ?>">Read</a>

    <div class="text-center mt-4">
        <a href="../../auth/logout.php" class="btn btn-danger btn-sm w-75">
            Logout
        </a>
    </div>
</div>

<div class="main">
