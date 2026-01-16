<?php
require_once "../../../config/db.php";
require_once "../../../includes/auth_check.php"; 

if (!isset($_GET['id'])) {
    die("ID kategori tidak ditemukan.");
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM aspirations WHERE category_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['total'] > 0) {
    die("Kategori ini tidak bisa dihapus karena masih ada aspirasi yang menggunakan kategori ini.");
}

$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    header("Location: index.php"); 
    exit;
} else {
    die("Gagal menghapus kategori.");
}
