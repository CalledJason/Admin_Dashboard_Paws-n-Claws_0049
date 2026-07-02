<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
}
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">&#x1F43E;PAWS & CLAWS DASHBOARD</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Keluar</a>
    </div>
</nav>
<div class="container my-5">
    <div class="admin-box">
        <h2 class="fw-bold mb-4">Daftar Antrean Reservasi Masuk</h2>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>No. WhatsApp</th>
                    <th>Tanggal Janji</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $data = mysqli_query($conn, "SELECT * FROM reservasi");
                while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><strong><?php echo $d['nama_owner']; ?></strong></td>
                        <td><?php echo $d['no_whatsapp']; ?></td>
                        <td><?php echo $d['tanggal_booking']; ?></td>
                        <td><?php echo $d['catatan']; ?></td>
                        <td><span class="badge bg-secondary"><?php echo $d['status']; ?></span></td>
                        <td>
                            <a href="edit_reservasi.php?id=<?php echo $d['id']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                            <a href="hapus_reservasi.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>