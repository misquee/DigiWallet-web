<?php
// Ambil data dari form login
session_start();
include('koneksi.php');
$nohp = mysqli_real_escape_string($con, $_POST['nohp']);
$password = mysqli_real_escape_string($con, $_POST['pw']);

// Query SQL
$query = "SELECT * FROM user WHERE no_hp='$nohp' AND password='$password'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 1) {
    // Login berhasil, alihkan ke halaman lain atau lakukan tindakan lain yang sesuai.
    $_SESSION['nohp'] = $nohp;
	header("Location: beranda.php");
	exit();
} else {
    // Login gagal, tampilkan pesan kesalahan atau alihkan ke halaman login kembali.
	echo "Login gagal. Silakan coba lagi.";
}

?>
