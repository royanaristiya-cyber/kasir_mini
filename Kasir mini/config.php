<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kasir_mini";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal");
}
