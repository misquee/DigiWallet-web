<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DigiWallet - Transfer</title>
    <link rel="stylesheet" href="style/kirim.css?version=5">
</head>
<body>
    <div class="container">
        <div class="kotak-1">
            <div class="content1">
                <img src="Img/kirim1.png" alt="kirim" class="logo2" style="width:150px;">
                <h2>Kirim DigiWallet</h2>
            </div>
        </div>

        <div class="kotak-2">
            <form id="transferForm" method="post" action="proseskirim3.php">
                
               <input type="tel"  name="recipientNumber" pattern="[0-9]+" placeholder="Nomor Tujuan" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

                <input type="text" name="amount" pattern="[0-9]+" required maxlength="8" placeholder="Jumlah Kirim" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

                <input type="text" id="description" placeholder="Catatan" name="description">

                <input type="password" id="password" name="password" placeholder="Password" required>

                <center><button type="submit">Konfirmasi</button></center>

            </form>
        </div>
    </div>
    
</body>
</html>
