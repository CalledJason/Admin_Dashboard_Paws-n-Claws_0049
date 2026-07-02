<?php
// host, user, dan nama database
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "pet_grooming";
$port = 3307;

$conn = mysqli_connect($host, $user, $password, $database, $port);

//Check koneksi apakah berhasil atau gagal
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
