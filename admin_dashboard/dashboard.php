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
    <nav class="navbar navbar-expand-lg navbar-admin">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">&#x1F43E;PAWS & CLAWS DASHBOARD</a>
        <a href="logout.php" class="btn btn-danger btn-sm rounded-pill px-3">Keluar</a>
    </div>
</nav>
<div class="container my-5">
    <div class="admin-box">
        <h2 class="fw-bold mb-4">Daftar Antrean Reservasi Masuk</h2>
        
        <div class="table-responsive table-responsive-custom">
            <table class="table table-custom align-middle text-center">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nama Pemilik</th>
                        <th>No. WhatsApp</th>
                        <th>Tanggal Janji</th>
                        <th>Keterangan / Catatan</th>
                        <th>Status</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    // Mengambil data terupdate dari database
                    $data = mysqli_query($conn, "SELECT * FROM reservasi ORDER BY id DESC");
                    while($d = mysqli_fetch_array($data)){
                        
                        // Logika pembagian warna status berdasarkan input database
                        $status_text = strtolower($d['status']);
                        $badge_class = "";

                        if($status_text == "pending") {
                            $badge_class = "status-pending"; // Kuning
                        } else if($status_text == "diterima") {
                            $badge_class = "status-diterima"; // Biru
                        } else if($status_text == "sukses" || $status_text == "selesai") {
                            $badge_class = "status-selesai"; // Hijau
                        } else if($status_text == "dibatalkan") {
                            $badge_class = "status-dibatalkan"; // Merah
                        }
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><strong><?php echo htmlspecialchars($d['nama_owner']); ?></strong></td>
                        <td><?php echo htmlspecialchars($d['no_whatsapp']); ?></td>
                        <td><?php echo date('d-m-Y', strtotime($d['tgl_booking'])); ?></td>
                        <td class="text-muted"><em><?php echo htmlspecialchars($d['note'] ? $d['note'] : '-'); ?></em></td>
                        <td>
                            <span class="badge-status <?php echo $badge_class; ?>">
                                <?php echo ucfirst($d['status']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="edit_reservasi.php?id=<?php echo $d['id']; ?>" class="btn btn-warning btn-sm rounded-pill px-3 fw-semibold me-1">Ubah</a>
                            <a href="hapus_reservasi.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm rounded-pill px-3 fw-semibold" onclick="return confirm('Yakin ingin menghapus antrean ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>