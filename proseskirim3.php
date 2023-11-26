<?php
session_start();
include('koneksi.php');

$nohp_pengirim = $_SESSION['nohp'];
$nohp_penerima = $_POST['recipientNumber'];
$amount = $_POST['amount'];
$keterangan = $_POST['description'];
$password = $_POST['password'];

// Dapatkan ID pengirim dan ID penerima berdasarkan nomor telepon
$query_pengirim = "SELECT id_user, saldo FROM user WHERE no_hp = '$nohp_pengirim'";
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

    // Lakukan pembaruan saldo di tabel user
    $update_pengirim_query = "UPDATE user SET saldo = saldo - $amount WHERE id_user ='$id_pengirim'";
    $update_penerima_query = "UPDATE user SET saldo = saldo + $amount WHERE id_user ='$id_penerima'";

    if ($con->query($update_pengirim_query) === TRUE && $con->query($update_penerima_query) === TRUE) {
        // Isi tabel transaksi dengan ID pengirim dan penerima
        $insert_query = "INSERT INTO transaksi (id_pengirim, id_penerima, amount, jenis_transaksi, keterangan) VALUES ('$id_pengirim', '$id_penerima', -$amount, 'transfer', '$keterangan'), ('$id_penerima', '$id_pengirim', $amount, 'transfer', '$keterangan')";

        if ($con->multi_query($insert_query) === TRUE) {
            // Update riwayat transaksi pengirim
            $update_riwayat_pengirim = "UPDATE user SET riwayat_transaksi = CONCAT(riwayat_transaksi, ', ', NOW(), ' - Transfer ke $nohp_penerima sejumlah $amount') WHERE id_user ='$id_pengirim'";
            $con->query($update_riwayat_pengirim);

            // Update riwayat transaksi penerima
            $update_riwayat_penerima = "UPDATE user SET riwayat_transaksi = CONCAT(riwayat_transaksi, ', ', NOW(), ' - Transfer dari $nohp_pengirim sejumlah $amount') WHERE id_user ='$id_penerima'";
            $con->query($update_riwayat_penerima);

            // Redirect ke proseskirim3.php dengan pesan keberhasilan
            header('Location: proseskirim3.php?success=true');
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $con->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $con->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nomor penerima tidak ditemukan.']);
}

$con->close();
?>
