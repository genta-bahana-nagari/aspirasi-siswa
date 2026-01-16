<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

$stmt = $pdo->prepare("
    INSERT INTO aspirations (user_id, category_id, title, description)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([
    $_SESSION['user_id'],
    $_POST['category_id'],
    $_POST['title'],
    $_POST['description']
]);

header("Location: index.php");
