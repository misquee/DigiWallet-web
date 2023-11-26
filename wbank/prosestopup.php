<?php
include('../koneksi.php');
// Ambil data dari formulir
$phone_number = $_POST['phone_number'];
$amount = $_POST['amount'];
$password = $_POST['password'];

// Periksa apakah password wbank benar
$sql = "SELECT * FROM wbank WHERE password = '$password'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Ambil id_user berdasarkan nomor telepon
    $sql = "SELECT id_user, saldo FROM user WHERE no_hp = '$phone_number'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_user = $row['id_user'];
        $user_saldo = $row['saldo'];

        // Lakukan transaksi top up
        $new_saldo = $user_saldo + $amount;
        $sql = "UPDATE user SET saldo = $new_saldo WHERE id_user = $id_user";
        $con->query($sql);

        // Kurangi saldo di wbank
        $sql = "UPDATE wbank SET saldo = saldo - $amount";
        $con->query($sql);

        $sql = "INSERT INTO transaksi (id_transaksi, id_user, id_bank, keterangan, amount, jenis_transaksi, timestamp) VALUES ('10000000',$id_user, '10000000', 'topup' ,$amount, 'topup', now())";
        $con->query($sql);

        echo "Top up berhasil.";
    } else {
        echo "Nomor telepon tidak ditemukan.";
    }
} else {
    echo "Password wbank salah.";
}

$con->close();
?>
