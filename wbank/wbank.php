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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wbank</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?></h2>
    <h2>Your Saldo: <?php echo $saldo; ?></h2>
    <a href="wtopup.php">Top Up</a>
</body>
</html>
