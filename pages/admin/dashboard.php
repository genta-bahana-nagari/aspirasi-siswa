<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Admin Dashboard</span>
        <a href="../../auth/logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="alert alert-info">
        Welcome, School Admin 
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Admin Controls</h5>
            <p class="text-muted">Manage students and aspirations.</p>
        </div>
    </div>
</div>

</body>
</html>

