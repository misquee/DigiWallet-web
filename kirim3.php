
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiWallet - Transfer</title>
    <link rel="stylesheet" href="kirim.css?version=3">
</head>
<body>
    <div class="container">
        <div class="kotak-1">
            <div class="content1">
                <h2>Kirim DigiWallet</h2>
                <h2><?php echo $nama; ?></h2>
            </div>
        </div>

        <div class="kotak-2">
            <form id="transferForm" method="post" action="proseskirim3.php">
                
                <input type="tel" id="recipientNumber" name="recipientNumber" pattern="[0-9]+" placeholder="Nomor Tujuan" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

                <input type="text" id="amount" name="amount" pattern="[0-9]+" required maxlength="8" placeholder="Jumlah Kirim" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

                <input type="text" id="description" placeholder="Catatan" name="description">

                <input type="password" id="password" name="password" placeholder="Password" required>

                <center><button type="submit">Konfirmasi</button></center>
            </form>
        </div>
    </div>

    <script>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            echo "alert('Transfer berhasil dilakukan.');";
        } elseif (isset($_GET['success']) && $_GET['success'] == 'false') {
            echo "alert('Error: " . $_GET['message'] . "');";
        }
        ?>
    </script>
    
</body>
</html>
