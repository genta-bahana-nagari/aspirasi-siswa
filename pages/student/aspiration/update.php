<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

$stmt = $conn->prepare("
    UPDATE aspirations
    SET title = ?, category_id = ?, description = ?, updated_at = NOW()
    WHERE id = ? AND user_id = ? AND status = 'Terkirim'
");

$stmt->execute([
    $_POST['title'],
    $_POST['category_id'],
    $_POST['description'],
    $_POST['id'],
    $_SESSION['user_id']
]);

header("Location: index.php");
