<?php
$conn = new mysqli("localhost", "root", "genta", "aspirasi_db");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
