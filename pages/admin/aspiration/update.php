<?php
require_once __DIR__ . '/../../../includes/auth_check.php';
require_once __DIR__ . '/../../../config/db.php';

$id = (int)$_POST['id'];
$description = trim($_POST['description']);
$status = $_POST['status'];

$allowed_status = [
    'Terkirim',
    'Diproses',
    'Dalam Perbaikan',
    'Selesai'
];

if ($_SESSION['role'] !== 'admin') {
    die('Akses ditolak');
}

if (!in_array($status, $allowed_status)) {
    die('Status tidak valid');
}


$stmt = $conn->prepare("
    UPDATE aspirations
    SET status = ?, updated_at = NOW()
    WHERE id = ?
");


$stmt->bind_param("si", $status, $id);
$stmt->execute();

header('Location: index.php');
exit;
