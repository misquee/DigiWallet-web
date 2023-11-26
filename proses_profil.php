<?php
// Membuat koneksi ke database
include('koneksi.php');

// Mulai sesi
session_start();

// Ambil data dari formulir
$nama = $_POST['nama'];
$username = $_POST['username'];
$nohp = $_POST['nohp'];
$email = $_POST['email'];

// Ambil nomor telepon dari sesi
$nohp_session = $_SESSION['nohp'];

// Perbarui data pengguna di database
$query = "UPDATE user SET nama_asli='$nama', nama='$username', no_hp='$nohp', email='$email' WHERE no_hp='$nohp_session'";
$result = mysqli_query($con, $query);

if ($result) {
    // Data berhasil diperbarui
    header("Location: beranda.php"); // Redirect ke halaman profil
} else {
    // Gagal memperbarui data
    echo "Gagal memperbarui data pengguna.";
}

// Tutup koneksi
mysqli_close($con);
?>
