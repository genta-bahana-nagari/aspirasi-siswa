<?php
session_start();
session_destroy();
header("Location:  /aspirasi-siswa/auth/login.php");
exit;
