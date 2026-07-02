<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
}
include 'db.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM reservasi WHERE id='$id'");
header("location:dashboard.php");
?>