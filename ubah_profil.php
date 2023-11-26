<?php
// Membuat koneksi ke database
include('koneksi.php');

// Mulai sesi
session_start();

// Ambil nomor telepon dari sesi
$nohp = $_SESSION['nohp'];

// Mengganti karakter dari digit ke-5 hingga ke-10 dengan bintang
$nohp_tampil = substr_replace($nohp, str_repeat('*', 6), 4, 6);

// Query SQL untuk mendapatkan nama
$query = "SELECT nama_asli, nama, email FROM user WHERE no_hp='$nohp'";

$result = mysqli_query($con, $query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil data dari hasil query
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama_asli'];
    $username = $row['nama'];
    $email = $row['email'];

} 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - DigiWallet</title>
    <link rel="stylesheet" href="ubahprofil.css?version=7">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Pengaturan Profil</h2>
            <form action="proses_profil.php" method="POST">
                <label for="nama">Nama Asli:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

                <label for="nohp">Nomor Ponsel:</label>
                <input type="tel" id="nohp" name="nohp" pattern="[0-9]{10,14}" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 14)" value="<?php echo $nohp; ?>" required>
                <small>Format: 10-14 digit angka</small>


                <label for="email">Alamat Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required title="Masukkan alamat email yang valid, contoh: user@example.com">

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>
