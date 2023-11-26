<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemindai Barcode</title>
    <link rel="stylesheet" href="scan.css">
</head>
<body>
    <div id="reader-container">
        <div id="interactive" class="viewport"></div>
        <div id="barcode-data-popup" class="popup">
            <span id="barcode-data"></span>
            <label for="jumlahKirim">Jumlah Kirim:</label>
            <input type="number" id="jumlahKirim" name="jumlahKirim" required>
            <label for="password">Kata Sandi:</label>
            <input type="password" id="password" name="password" required>
            <button onclick="konfirmasiAksi()">Konfirmasi</button>
        </div>
    </div>
    <script src="quaggaJS/dist/quagga.js"></script>
    <script src="scanner.js"></script>
</body>
</html>
