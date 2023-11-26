<?php
session_start(); // Pastikan session sudah dimulai
// Cek apakah pengguna sudah login

$nohp = $_SESSION['nohp'];

// Membuat path untuk file QR Code
$qrCodePath = "qrcodes/" . $nohp . ".png";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
     <link rel="stylesheet" type="text/css" href="terima.css?version=4">
</head>
</head>
<body>
    <div class="container">
        <div class="kotak">
            <!-- Menampilkan QR Code -->
            <img src="<?php echo $qrCodePath; ?>" alt="QR Code">
            <h2>DigiCode</h2>
        </div>
    </div>
</body>
</html>
