<?php
/*

Sesuaikan dengan database anda. Format sebagai berikut:

$conn = new mysqli("localhost", "user_database", "password", "nama_database"); 

*/

$conn = new mysqli("localhost", "root", "genta", "aspirasi_db"); 


if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
