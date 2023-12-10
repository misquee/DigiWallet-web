<?php
session_start();
include('koneksi.php');

$nohp_pengguna = $_SESSION['nohp'];

// Dapatkan ID pengguna berdasarkan nomor telepon
$query_pengguna = "SELECT id_user FROM user WHERE no_hp = '$nohp_pengguna'";
$result_pengguna = $con->query($query_pengguna);

if ($result_pengguna->num_rows == 1) {
    $row_pengguna = $result_pengguna->fetch_assoc();
    $id_pengguna = $row_pengguna['id_user'];

    // Query riwayat transaksi
    $query_riwayat = "SELECT *, 
                            CASE
                                WHEN id_pengirim = '$id_pengguna' THEN 'Uang Keluar'
                                WHEN id_penerima = '$id_pengguna' THEN 'Uang Masuk'
                                ELSE 'Tidak Diketahui'
                            END AS jenis_transaksi
                      FROM transaksi
                      WHERE id_pengirim = '$id_pengguna' OR id_penerima = '$id_pengguna'
                      ORDER BY waktu_transaksi DESC";

    $result_riwayat = $con->query($query_riwayat);

    // Tampilkan data di halaman web
    if ($result_riwayat->num_rows > 0) {
        while ($row_riwayat = $result_riwayat->fetch_assoc()) {
            // Tampilkan data, termasuk jenis transaksi dan nomor penerima/pengirim
            echo '<div class="transaction-item ' . ($row_riwayat['jenis_transaksi'] == 'Uang Keluar' ? 'outcome' : 'income') . '">';
            echo '<div class="transaction-details">';
            echo '<div class="transaction-amount">' . ($row_riwayat['jenis_transaksi'] == 'Uang Keluar' ? '-' : '+') . 'Rp ' . number_format($row_riwayat['jumlah_transaksi'], 0, ',', '.') . '</div>';

             // Format waktu transaksi
            $formattedTime = date("d F Y H:i:s", strtotime($row_riwayat['waktu_transaksi']));
            
            echo '<div class="transaction-time">';
            echo '<div class="transaction-date">' . date("d F Y", strtotime($row_riwayat['waktu_transaksi'])) . '</div>';
            echo '<div class="transaction-clock">' . date("H:i:s", strtotime($row_riwayat['waktu_transaksi'])) . '</div>';
            echo '</div>';

            // nomor telepon
            echo '<div class="transaction-number">';
            
            if ($row_riwayat['jenis_transaksi'] == 'Uang Keluar') {
                // Ambil nomor telepon penerima dari tabel user
                $query_penerima = "SELECT no_hp FROM user WHERE id_user = '" . $row_riwayat['id_penerima'] . "'";
                $result_penerima = $con->query($query_penerima);
                $row_penerima = $result_penerima->fetch_assoc();

                // Ganti angka ke-5 hingga ke-8 menjadi bintang
                $nomor_penerima = substr_replace($row_penerima['no_hp'], '******', 4, 6);
                
                echo '<span class="transaction-contact">Penerima</span> ' . $nomor_penerima;
            } elseif ($row_riwayat['jenis_transaksi'] == 'Uang Masuk') {
                // Ambil nomor telepon pengirim dari tabel user
                $query_pengirim = "SELECT no_hp FROM user WHERE id_user = '" . $row_riwayat['id_pengirim'] . "'";
                $result_pengirim = $con->query($query_pengirim);
                $row_pengirim = $result_pengirim->fetch_assoc();

                // Ganti angka ke-5 hingga ke-8 menjadi bintang
                $nomor_pengirim = substr_replace($row_pengirim['no_hp'], '******', 4, 6);
                
                echo '<span class="transaction-contact">Pengirim</span> ' . $nomor_pengirim;
            } else {
                echo 'Nomor Penerima/Pengirim: Tidak Diketahui';
            }
            
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'Tidak ada riwayat transaksi.';
    }
} else {
    echo 'Pengguna tidak ditemukan.';
}

// Fungsi untuk memformat waktu
function formatWaktu($waktu) {
    $timestamp = strtotime($waktu);
    $formattedTime = date('d M Y', $timestamp) . '<br>' . date('H:i:s', $timestamp);
    return $formattedTime;
}

$con->close();
?>
