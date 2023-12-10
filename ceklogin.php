<?php
session_start();
include('koneksi.php');

$nohp = mysqli_real_escape_string($con, $_POST['nohp']);
$password = mysqli_real_escape_string($con, $_POST['pw']);

$query = "SELECT * FROM user WHERE no_hp='$nohp'";
$result = mysqli_query($con, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Verifikasi password dengan password_verify
    if (password_verify($password, $row['password'])) {
        // Password valid, simpan nomor hp dalam sesi
        $_SESSION['nohp'] = $nohp;
       echo "<script>alert('Login berhasil'); window.location.href='index.php';</script>";
                exit();
        exit();
    } else {
        echo "<script>alert('Login gagal. username atau password salah'); window.location.href='login.php';</script>";
                exit();
    }
} else {
    echo "<script>alert('Login gagal. username atau password salah'); window.location.href='login.php';</script>";
                exit();
}
?>
