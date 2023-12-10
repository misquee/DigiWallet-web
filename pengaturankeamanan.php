<!-- Contoh pengaturan_keamanan.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Keamanan - DigiWallet</title>
    <link rel="stylesheet" href="style/pengaturankeamanan.css?version=4">
</head>
<body>
    <div class="container">
        <div class="form-keamanan">
            <h2>Pengaturan Keamanan</h2>
            <div class="ganti-password">
                <h3>Ganti Password</h3>
                <form action="proseskeamanan.php" method="post">
                    <label for="old_password">Sandi Lama:</label>
                    <input type="password" id="old_password" name="old_password" required>

                    <label for="password">Sandi Baru:</label>
                    <input type="password" id="password" name="password" required>

                    <label for="confirm_password">Konfirmasi Sandi Baru:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>

                    <button type="submit" class="button">Ganti Sandi</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
