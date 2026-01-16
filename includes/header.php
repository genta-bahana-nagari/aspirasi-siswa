<?php
if (session_status() == PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['role'])) {
    header("Location: ../auth/login.php");
    exit;
}

$role = $_SESSION['role'];
$user_name = $_SESSION['name'] ?? ucfirst($role);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    margin:0;
    background:#f4f6f9;
}


.sidebar {
    width:250px;
    height:100vh;
    position:fixed;
    top:0;
    left:0;
    background:#111827;
    color:white;
    padding-top:20px;
}


.sidebar a {
    color:#cbd5e1;
    text-decoration:none;
    display:block;
    padding:12px 20px;
    border-radius:8px;
    margin:4px 10px;
}

.sidebar a:hover,
.sidebar a.active {
    background:#1f2937;
    color:white;
}


.main {
    margin-left:250px;   
    padding:30px;
    min-height:100vh;
}
</style>
</head>
<body>
