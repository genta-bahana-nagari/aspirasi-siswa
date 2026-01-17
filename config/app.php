<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
define('BASE_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . '/aspirasi-siswa');

$role = $_SESSION['role'] ?? 'siswa';  
$base = BASE_URL . '/pages/' . $role;
