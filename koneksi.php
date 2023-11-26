<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "DigiWallet";

// Koneksi ke database
$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
	die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
