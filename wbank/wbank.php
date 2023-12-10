<?php
session_start();
include('../koneksi.php');

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, arahkan kembali ke halaman login
    header("Location: wlogin.php");
    exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Ambil saldo dari tabel wbank berdasarkan username
$check_query = "SELECT saldo FROM wbank WHERE username = ?";
$stmt = $con->prepare($check_query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Tampilkan saldo dalam elemen h2
    $row = $result->fetch_assoc();
    $saldo = $row['saldo'];
} else {
    $saldo = "Saldo tidak ditemukan.";
}

$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiWallet</title>
    <link rel="stylesheet" type="text/css" href="../style/style5.css?version=4">
</head>
<body>
    <div class="container">
        <div class="kiri">
           <div class="user-info">
            <div class="logo-container beranda-logo-container">
                <img src="img/wprofil.png" alt="Logo" class="logo">
            </div>
            <div class="user-details">
                <p>Selamat Datang</p>
                <h2><?php echo $username; ?></h2>
            </div>
        </div>
        <hr class="underline">
        <div class="icons">
            <div class="icon-item">
                <a href="#" onclick="loadContent('wtopup.php')">
                    <img src="img/wberanda.png" alt="Home Icon">
                    <p style="margin-bottom: -8px; color: #0D5C46;">Beranda</p>
                </a>
            </div>
            <div class="icon-item">
                <a href="wlogin.php">
                    <img src="img/wexit.png" alt="Logout Icon" style="height: 23px; width: 17px; margin-top: 350px;">
                </a>
            </div>
        </div>
    </div>
    <div class="kanan" id="content">

        <div class="hal">
         
        </div>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>
