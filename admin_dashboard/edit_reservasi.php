<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
}
include 'db.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM reservasi WHERE id='$id'");
$d = mysqli_fetch_array($query);

if(isset($_POST['update'])){
    $status_baru = $_POST['status'];
    mysqli_query($conn, "UPDATE reservasi SET status='$status_baru' WHERE id='$id'");
    header("location:dashboard.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ubah Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body class="bg-light">
<div class="container my-5" style="max-width: 500px;">
    <div class="admin-box">
        <h4 class="fw-bold mb-4">Edit Status Antrean</h4>
        <p>Nama Klien: <strong><?php echo $d['nama_owner']; ?></strong></p>
        <form action="" method="POST">
            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Pending" <?php if($d['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Diterima" <?php if($d['status'] == 'Diterima') echo 'selected'; ?>>Diterima</option>
                    <option value="Selesai" <?php if($d['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                    <option value="Dibatalkan" <?php if($d['status'] == 'Dibatalkan') echo 'selected'; ?>>Dibatalkan</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary w-100 mb-2">Simpan</button>
            <a href="dashboard.php" class="btn btn-light w-100">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>