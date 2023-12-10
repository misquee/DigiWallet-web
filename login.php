<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style/style3.css?version=2">
	<title>Log-In</title>
</head>
<body>

	<div class="container">
		<div class="left">
			<h1 style="color: white; font-size: 55px;">DigiWallet</h1>
			<img src="Img/bg1.png" alt="" style="max-width: 100%;">

		</div>
		<div class="right">
			<form action="ceklogin.php" method="POST">
				<h1 class="judul">LOGIN</h1>
				<div class="form-group">
					<label for="nohp">Nomor Hp</label>
					<input type="tel" name="nohp" pattern="[0-9]+" required>
				</div>
				<div class="form-group">
					<label for="pw">Password</label>
					<input type="password" name="pw" maxlength="8" required> <br>
				</div>
				<button class="button">Login</button>
				<p class="text">Belum punya akun? <a href="signup.php">Daftar</a></p>
			</form>
		</div>
	</div>

</body>
</html>
