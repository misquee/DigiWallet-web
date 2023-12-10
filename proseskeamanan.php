<?php
session_start();
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nohp = $_SESSION['nohp'];
    $old_password = $_POST['old_password'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Ambil sandi lama dari database berdasarkan nomor telepon
    $query_get_password = "SELECT password FROM user WHERE no_hp='$nohp'";
    $result_get_password = mysqli_query($con, $query_get_password);

    if ($result_get_password) {
        $row = mysqli_fetch_assoc($result_get_password);
        $hashed_old_password = $row['password'];

        // Verifikasi sandi lama
        if (password_verify($old_password, $hashed_old_password)) {
            // Pengecekan sandi lama berhasil, lanjutkan dengan mengganti sandi baru
            if ($password === $confirm_password) {
                // Hash sandi baru sebelum menyimpannya
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Melakukan query SQL untuk memperbarui sandi di database
                $query_update_password = "UPDATE user SET password='$hashed_password' WHERE no_hp='$nohp'";
                $result_update_password = mysqli_query($con, $query_update_password);

                if ($result_update_password) {
                    echo "<script>alert('Sandi berhasil di ubah.'); window.location.href='beranda.php';</script>";
                exit();
                } else {
                    echo "<script>alert('Terjadi kesalahan saat mengubah sandi.'); window.location.href='beranda.php';</script>";
                exit();
                }
            } else {
                echo "<script>alert('Sandi baru dan konfirmasi sandi tidak cocok.'); window.location.href='beranda.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Sandi lama tidak valid.'); window.location.href='beranda.php';</script>";
                exit();
        }
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengubah sandi'); window.location.href='beranda.php';</script>";
                exit();
    }

    mysqli_close($con);
}
?>
