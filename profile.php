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
$query = "SELECT nama_asli FROM user WHERE no_hp='$nohp'";

$result = mysqli_query($con, $query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil data dari hasil query
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama_asli'];
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiWallet - Transfer</title>
    <link rel="stylesheet" href="profile.css?version=5">
</head>
<body>
    <div class="container">
        <div class="kotak-1">
            <div class="user-info1">
                    <div class="logo-container">
                        <img src="Img/profile.png" alt="Logo" class="logo">
                    </div>
                    <div class="user-details">
                        <h2><?php echo $nama; ?></h2>
                        <p><?php echo $nohp_tampil; ?></p>
                    </div>
                </div> 
            <div class="content1">   
                <div class="additional-box">
                    <div class="pengaturan">
                        <div class="logo-profil">
                            <img src="Img/profile.png" alt="Logo" class="lprofil">
                        </div>
                        <div class="keterangan">
                            <a href="#" onclick="loadUbahProfil()">Pengaturan Profil</a>
                        </div>
                        <div class="logo-profil-right">
                            <img src="Img/kanan.png" alt="Logo" class="lprofil1">
                        </div>
                    </div>
                    <hr>
                    <div class="pengaturan">
                        <div class="logo-profil">
                            <img src="Img/profile.png" alt="Logo" class="lprofil">
                        </div>
                        <div class="keterangan">
                            <a href="#" onclick="loadPengaturanKeamanan()">Pengaturan Keamanan</a>
                        </div>
                        <div class="logo-profil-right">
                            <img src="Img/kanan.png" alt="Logo" class="lprofil1">
                        </div>
                    </div>
                </div>      
            </div>
        </div>
        
        <div class="kotak-2">
            <!-- Konten untuk kotak-2 -->
        </div>
    </div>

</body>
</html>
