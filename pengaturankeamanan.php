<!-- Contoh pengaturan_keamanan.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Keamanan - DigiWallet</title>
    <link rel="stylesheet" href="pengaturankeamanan.css">
</head>
<body>
    <div class="container">
        <div class="form-keamanan">
            <h2>Pengaturan Keamanan</h2>
            <div class="ganti-password">
                <h3>Ganti Password</h3>
                <form action="proses_ganti_password.php" method="POST">
                    <label for="password-lama">Password Lama:</label>
                    <input type="password" id="password-lama" name="password-lama" required>

                    <label for="password-baru">Password Baru:</label>
                    <input type="password" id="password-baru" name="password-baru" required>

                    <label for="konfirmasi-password">Konfirmasi Password Baru:</label>
                    <input type="password" id="konfirmasi-password" name="konfirmasi-password" required>

                    <button type="submit">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
