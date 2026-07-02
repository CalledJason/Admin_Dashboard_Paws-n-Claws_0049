<?php 
// Memulai session penyimpanan status login
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    
    if(mysqli_num_rows($query) > 0){
        $_SESSION['username'] = $username;
        $_SESSION['status']   = "login";
        header("location:dashboard.php");
    } else {
        header("location:login.php?pesan=gagal");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin_style.css">
</head>
<body class="body-login">
<div class="box-login">
    <h3 class="text-center fw-bold mb-4">LOGIN ADMIN PAWS&CLAWS</h3>
    
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal") echo "<div class='alert alert-danger text-center'>Username/password salah!</div>";
        if($_GET['pesan'] == "logout") echo "<div class='alert alert-success text-center'>Berhasil log out.</div>";
        if($_GET['pesan'] == "belum_login") echo "<div class='alert alert-warning text-center'>Silakan login terlebih dahulu!</div>";
    }
    ?>

    <form action="login.php" method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required autocomplete="off">
        </div>
        <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-dark w-100">MASUK</button>
    </form>
</div>
</body>
</html>