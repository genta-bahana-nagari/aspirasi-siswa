<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    ? 'https'
    : 'http';

define('BASE_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . '/aspirasi-siswa');
define('BASE_PATH', realpath(__DIR__ . '/..'));
