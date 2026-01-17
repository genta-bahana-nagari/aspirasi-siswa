<?php
require_once "../../../config/db.php";
require_once "../../../includes/auth_check.php"; 

if (!isset($_GET['id'])) {
    die("ID aspirasi tidak ditemukan.");
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("DELETE FROM aspirations WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    die("Gagal menghapus aspirasi.");
}
