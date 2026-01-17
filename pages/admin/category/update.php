<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

$stmt = $conn->prepare("
    UPDATE categories
    SET name = ?
    WHERE id = ?
");

$stmt->execute([
    $_POST['name'],
    $_POST['id'],
]);

header("Location: index.php");
