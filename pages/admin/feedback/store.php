<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $aspiration_id = (int) $_POST['aspiration_id'];
    $title         = trim($_POST['title']);
    $feedback      = trim($_POST['feedback']);

    // admin_id dari session (relasi ke users.id)
    $admin_id = $_SESSION['user_id'];

    if ($aspiration_id && $admin_id && $title && $feedback) {

        $stmt = $conn->prepare("
            INSERT INTO aspiration_feedbacks
            (aspiration_id, admin_id, title, feedback)
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "iiss",
            $aspiration_id,
            $admin_id,
            $title,
            $feedback
        );

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            die("Gagal menyimpan feedback");
        }

    } else {
        die("Data tidak lengkap");
    }
}
