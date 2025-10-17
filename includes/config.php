<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kết nối database
$con = mysqli_connect("localhost","root","","post_verse");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
