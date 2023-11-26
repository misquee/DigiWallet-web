<?php
session_start();
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method");
}

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$nohp_pengirim = $_SESSION['nohp'];
$nohp_penerima = $_POST['recipientNumber']; // Nomor telepon penerima
$amount = $_POST['amount'];
$keterangan = $_POST['description'];

// Dapatkan ID pengirim dan ID penerima berdasarkan nomor telepon
$query_pengirim = "SELECT id_user FROM user WHERE no_hp = '$nohp_pengirim'";
$query_penerima = "SELECT id_user FROM user WHERE no_hp = '$nohp_penerima'";

$result_pengirim = $con->query($query_pengirim);
$result_penerima = $con->query($query_penerima);

if ($result_pengirim->num_rows == 1 && $result_penerima->num_rows == 1) {
    $row_pengirim = $result_pengirim->fetch_assoc();
    $row_penerima = $result_penerima->fetch_assoc();

    $id_pengirim = $row_pengirim['id_user'];
    $id_penerima = $row_penerima['id_user'];

    // Lakukan pembaruan saldo di tabel user
    $update_pengirim_query = "UPDATE user SET saldo = saldo - $amount WHERE id_user ='$id_pengirim'";
    $update_penerima_query = "UPDATE user SET saldo = saldo + $amount WHERE id_user ='$id_penerima'";

    if ($con->query($update_pengirim_query) === TRUE && $con->query($update_penerima_query) === TRUE) {
        // Isi tabel transaksi dengan ID pengirim dan penerima
        $insert_query = "INSERT INTO transaksi (id_pengirim, id_penerima, amount, jenis_transaksi, keterangan) VALUES ('$id_pengirim', '$id_penerima', -$amount, 'transfer', '$keterangan'), ('$id_penerima', '$id_pengirim', $amount, 'transfer', '$keterangan')";

        if ($con->multi_query($insert_query) === TRUE) {
            echo json_encode(['success' => true, 'message' => 'Transfer berhasil dilakukan.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $con->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $con->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nomor telepon pengirim atau penerima tidak ditemukan.']);
}

$con->close();
?>
