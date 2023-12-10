<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Digiwallet</title>
    <link rel="stylesheet" href="style/wtopup.css?version=4">
</head>
<body>
    <div class="container">
        <div class="kotak">
            <h1>Top Up Digiwallet</h1>
            <form action="prosestopup.php" method="post">
                <input type="text" name="phone_number" pattern="[0-9]+" placeholder="Nomor Tujuan" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

                <input type="text" name="amount" pattern="[0-9]+" required maxlength="8" placeholder="Jumlah Kirim" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

                <input type="password" name="password" placeholder="Password" required>

                <input type="submit" value="Top Up">
            </form>
        </div>
    </div>
</body>
</html>
