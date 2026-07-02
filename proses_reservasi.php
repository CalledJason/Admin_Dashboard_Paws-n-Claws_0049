<?php 

include 'admin_dashboard/db.php';

$nama_owner      = $_POST['nama_owner'];
$no_whatsapp     = $_POST['no_whatsapp'];
$tgl_booking = $_POST['tgl_booking'];
$note        = $_POST['note'];

if($nama_owner == "" || $no_whatsapp == "" || $tgl_booking == ""){
    header("location:index.php?pesan=gagal");
} else {
    // Validasi double booking
    $cek = mysqli_query($conn, "SELECT * FROM reservasi WHERE no_whatsapp='$no_whatsapp' AND tgl_booking='$tgl_booking'");
    
    if(mysqli_num_rows($cek) > 0){
        header("location:index.php?pesan=double");
    } else {
        // Masukkan data baru dengan status bawaan 'Pending'
        mysqli_query($conn, "INSERT INTO reservasi VALUES('', '$nama_owner', '$no_whatsapp', '$tgl_booking', '$note', 'Pending')");
        header("location:index.php?pesan=sukses");
    }
}
?>