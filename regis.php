<?php
// Membuat koneksi ke database
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('koneksi.php');

// Include the QR Code library
include "phpqrcode/qrlib.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nohp = $_POST['nohp'];
    $password = $_POST['pw'];
    $password_confirm = $_POST['pw_confirm'];

    // Memeriksa apakah semua bidang telah diisi
    if (!empty($nohp) && !empty($password) && !empty($password_confirm)) {
        // Memastikan bahwa password dan konfirmasi password cocok
        if ($password === $password_confirm) {
            // Memeriksa apakah nomor telepon sudah terdaftar
            $query_check = "SELECT * FROM user WHERE no_hp='$nohp'";
            $result_check = mysqli_query($con, $query_check);
            if (mysqli_num_rows($result_check) > 0) {
                echo '<script>alert("Nomor telepon sudah terdaftar. Silakan gunakan nomor telepon lain.");</script>';
            } else {
                // Melakukan query SQL untuk memasukkan data ke dalam database
                $query = "INSERT INTO user (no_hp, password) VALUES ('$nohp', '$password')";
                $result = mysqli_query($con, $query);
                if ($result) {
                    // Generate a unique filename for the QR Code
                    $filename = "qrcodes/" . $nohp . ".png";

                    // Generate the QR Code
                    QRcode::png($nohp, $filename, QR_ECLEVEL_L, 10, 2);


                    echo '<script>alert("Pendaftaran berhasil!");</script>';
                    header("Location: login.php");
                    exit();
                } else {
                    echo '<script>alert("Terjadi kesalahan saat mendaftar. Silakan coba lagi.");</script>';
                }
            }
        } else {
            echo '<script>alert("Password dan konfirmasi password tidak cocok. Silakan coba lagi.");</script>';
        }
    } else {
        echo '<script>alert("Harap isi semua bidang. Silakan coba lagi.");</script>';
    }
}
?>
