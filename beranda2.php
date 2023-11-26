<?php
// Membuat koneksi ke database
include('koneksi.php');

// Mulai sesi
session_start();

// Ambil nomor telepon dari sesi
$nohp = $_SESSION['nohp'];

// Query SQL untuk mendapatkan nama
$query = "SELECT saldo FROM user WHERE no_hp='$nohp'";
$result = mysqli_query($con, $query);

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil data dari hasil query
    $row = mysqli_fetch_assoc($result);
    $saldo = $row['saldo'];
    $saldo = number_format($row['saldo'], 0, ',', '.');
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
	<title>beranda2</title>
	<link rel="stylesheet" type="text/css" href="beranda.css?version=2">
</head>
<body>
	<div class="container" >
		<div class="kotak-1">
			<div class="content1">
				<div class="text1">
					<h3>Saldo Anda</h3>
				</div>
				<div class="logo1">
					<img src="Img/berandaw.png" alt="Logo" class="logo2">
				</div>
				<div class="saldo">
						<h3>Rp <?php echo $saldo; ?></h3>
					</div>
				<div class="button1">
					<a href="wbank/wlogin.php"><button class="button" >Isi Saldo</button></a>
					<a href="#" onclick="loadKirim()"><button class="button">Kirim</button></a>
					<a href="#" onclick="loadTerima()"><button class="button">Terima</button></a>
				</div>
			</div>
		</div>
		<div class="kotak-2">
			<!-- Konten dari kotak kedua -->
			<hr>	
			<hr>
			<hr>
			<hr>	
			<hr>
			<hr>
			<hr>
			<hr>
		</div>
	</div>

	
</body>
</html>
