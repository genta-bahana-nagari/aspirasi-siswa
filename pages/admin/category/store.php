<?php
require '../../../includes/auth_check.php';
require '../../../config/db.php';

$stmt = $conn->prepare("
    INSERT INTO categories (name)
    VALUES (?)
");

$stmt->execute([
    $_POST['name'],
]);

header("Location: index.php");
