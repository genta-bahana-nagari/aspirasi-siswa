<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function checkRole($role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header("Location: ../auth/login.php");
        exit;
    }
}
