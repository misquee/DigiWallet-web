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
$query = "SELECT nama_asli, saldo FROM user WHERE no_hp='$nohp'";

$result = mysqli_query($con, $query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil data dari hasil query
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama_asli'];
    $saldo = $row['saldo'];

    // Query untuk menghitung total uang masuk
    $query_total_masuk = "SELECT SUM(jumlah_transaksi) AS total_masuk FROM transaksi WHERE id_penerima = (SELECT id_user FROM user WHERE no_hp = '$nohp')";
    $result_total_masuk = mysqli_query($con, $query_total_masuk);
    $row_total_masuk = mysqli_fetch_assoc($result_total_masuk);
    $total_masuk = $row_total_masuk['total_masuk'];

    // Query untuk menghitung total uang keluar
    $query_total_keluar = "SELECT SUM(jumlah_transaksi) AS total_keluar FROM transaksi WHERE id_pengirim = (SELECT id_user FROM user WHERE no_hp = '$nohp')";
    $result_total_keluar = mysqli_query($con, $query_total_keluar);
    $row_total_keluar = mysqli_fetch_assoc($result_total_keluar);
    $total_keluar = $row_total_keluar['total_keluar'];
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiWallet - Transfer</title>
    <link rel="stylesheet" href="style/profile.css?version=4">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="kotak-1">
            <div class="user-info1">
                    <div class="logo-container1">
                        <img src="Img/profile.png" alt="Logo" class="logo">
                    </div>
                    <div class="user-details1">
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
            <div class="transaction">
                <img src="Img/wallet.png" alt="Wallet Logo" class="wallet-logo">
                <div class="balance"><?php echo 'Rp ', number_format($saldo, 0, ',', '.'); ?></div>
                <div class="transaction-summary">
                <div class="total-info">
                    <div class="total-masuk">
                        <div class="logomasuk">
                            <i class="fas fa-arrow-circle-up green-icon"></i>
                        </div>
                        <div>
                            <div>Total Masuk</div>
                            <div class="rp-amount"><?php echo 'Rp ', number_format($total_masuk, 0, ',', '.'); ?></div>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="total-keluar">
                        <div class="logokeluar">
                            <i class="fas fa-arrow-circle-down red-icon"></i>
                        </div>
                        <div>
                            <div>Total Keluar</div>
                            <div class="rp-amount"><?php echo 'Rp ', number_format($total_keluar, 0, ',', '.'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
