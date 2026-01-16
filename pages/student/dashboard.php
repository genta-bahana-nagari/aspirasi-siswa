<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <span class="navbar-brand">Student Dashboard</span>
        <a href="../../auth/logout.php" class="btn btn-light btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="alert alert-success">
        Welcome, Student!
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Your Dashboard</h5>
            <p class="text-muted">You can submit and view aspirations here.</p>
        </div>
    </div>
</div>

</body>
</html>

