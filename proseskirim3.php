<?php
session_start();
include('koneksi.php');

$nohp_pengirim = $_SESSION['nohp'];
$nohp_penerima = $_POST['recipientNumber'];
$amount = $_POST['amount'];
$keterangan = $_POST['description'];
$password = $_POST['password'];

// Dapatkan ID pengirim dan ID penerima berdasarkan nomor telepon
$query_pengirim = "SELECT id_user, saldo, password FROM user WHERE no_hp = '$nohp_pengirim'";
$query_penerima = "SELECT id_user, saldo FROM user WHERE no_hp = '$nohp_penerima'";

$result_pengirim = $con->query($query_pengirim);
$result_penerima = $con->query($query_penerima);

if ($result_pengirim->num_rows == 1 && $result_penerima->num_rows == 1) {
    $row_pengirim = $result_pengirim->fetch_assoc();
    $row_penerima = $result_penerima->fetch_assoc();

    $id_pengirim = $row_pengirim['id_user'];
    $id_penerima = $row_penerima['id_user'];
    $saldo_pengirim = $row_pengirim['saldo'];
    $saldo_penerima = $row_penerima['saldo'];
    $password_pengirim = $row_pengirim['password'];

    // Validasi password
    if (password_verify($password, $password_pengirim)) {
        // Lakukan pembaruan saldo di tabel user
        $update_pengirim_query = "UPDATE user SET saldo = saldo - $amount WHERE id_user ='$id_pengirim'";
        $update_penerima_query = "UPDATE user SET saldo = saldo + $amount WHERE id_user ='$id_penerima'";

        if ($con->query($update_pengirim_query) === TRUE && $con->query($update_penerima_query) === TRUE) {
            // Isi tabel transaksi dengan ID pengirim dan penerima
            $insert_query = "INSERT INTO transaksi (id_pengirim, id_penerima, jumlah_transaksi, tipe_transaksi, keterangan, waktu_transaksi) VALUES ('$id_pengirim', '$id_penerima', '$amount', 'transfer', '$keterangan', CURRENT_TIMESTAMP)";
            
            if ($con->query($insert_query) === TRUE) {
                // Transfer berhasil
                echo "<script>alert('Transfer berhasil dilakukan.'); window.location.href='beranda.php';</script>";
                exit();
            } else {
                echo "<script>alert('Transaksi gagal.'); window.location.href='beranda.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Transaksi gagal.'); window.location.href='beranda.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Password tidak valid.'); window.location.href='beranda.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Nomor penerima tidak ditemukan.'); window.location.href='beranda.php';</script>";
    exit();
}

$con->close();
?>
