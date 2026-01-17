<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$feedback_id = (int) $_GET['id'];

$stmt = $conn->prepare("
    SELECT aspiration_id
    FROM aspiration_feedbacks
    WHERE id = ?
");
$stmt->bind_param("i", $feedback_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Feedback tidak ditemukan");
}

$data = $result->fetch_assoc();
$aspiration_id = $data['aspiration_id'];


$delete = $conn->prepare("
    DELETE FROM aspiration_feedbacks
    WHERE id = ?
");
$delete->bind_param("i", $feedback_id);

if ($delete->execute()) {
    header("Location: index.php");
    exit;
} else {
    die("Gagal menghapus feedback");
}
