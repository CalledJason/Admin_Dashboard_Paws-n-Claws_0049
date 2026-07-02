<?php 

include 'admin_dashboard/db.php';

$nama_owner      = $_POST['nama_owner'];
$no_whatsapp     = $_POST['no_whatsapp'];
$tanggal_booking = $_POST['tanggal_booking'];
$catatan         = $_POST['catatan'];

if($nama_owner == "" || $no_whatsapp == "" || $tanggal_booking == ""){
    header("location:index.php?pesan=gagal");
} else {
    // Validasi double booking
    $cek = mysqli_query($conn, "SELECT * FROM reservasi WHERE no_whatsapp='$no_whatsapp' AND tanggal_booking='$tanggal_booking'");
    
    if(mysqli_num_rows($cek) > 0){
        header("location:index.php?pesan=double");
    } else {
        // Masukkan data baru dengan status bawaan 'Pending'
        mysqli_query($conn, "INSERT INTO reservasi VALUES('', '$nama_owner', '$no_whatsapp', '$tanggal_booking', '$catatan', 'Pending')");
        header("location:index.php?pesan=sukses");
    }
}
?>