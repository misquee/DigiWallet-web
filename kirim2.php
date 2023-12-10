<?php 
// Membuat koneksi ke database
include('koneksi.php');

// Mulai sesi
session_start();

// Ambil nomor telepon dari sesi
$nohp = $_SESSION['nohp'];

// Query SQL untuk mendapatkan nama
$query = "SELECT nama FROM user WHERE no_hp='$nohp'";
$result = mysqli_query($con, $query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil data dari hasil query
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama'];
    $nohp = $row['nohp'];
} else {
    $saldo = "Nama tidak ditemukan";
    echo "Data tidak ditemukan";
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiWallet - Transfer</title>
    <link rel="stylesheet" href="style/kirim.css?version=3">
</head>
<body>
    <div class="container">
        <div class="kotak-1">
            <div class="content1">
                <h2>Transfer DigiWallet</h2>
                <h2><?php echo $nama; ?></h2>
            </div>
        </div>

        <div class="kotak-2">
            <form id="transferForm">
                <label for="recipientNumber">Nomor Tujuan:</label>
                <input type="tel" id="recipientNumber" name="recipientNumber" pattern="[0-9]+" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

                <label for="amount">Jumlah Kirim:</label>
                <input type="text" id="amount" name="amount" pattern="[0-9]+" required maxlength="8" required>

                <label for="description">Keterangan:</label>
                <input type="text" id="description" name="description">

                <button type="button" onclick="confirmTransfer()">Konfirmasi</button>
            </form>
        </div>
    </div>

    <div id="confirmationPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <p id="popupContent"></p>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button onclick="sendTransfer()">Kirim</button>
        </div>
    </div>

    <script src="kirim2.js"></script>
</body>
</html>
