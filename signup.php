<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style3.css?v=2">
	<title>Register</title>
</head>
<body>

	<div class="container">
		<div class="left">
			<h1 style="color: white; font-size: 55px;">DigiWallet</h1>
			<img src="Img/bg1.png" alt="" style="max-height: 100%; max-width: 120%">

		</div>
		<div class="right">
			<form action="regis.php" method="POST">
				<h1 class="judul">REGISTER</h1>
				<div class="form-group">
					<label for="nohp">Nomor Hp</label>
					<input type="tel" name="nohp" id="nohp" pattern="[0-9]+" required maxlength="13">
				</div>
				<div class="form-group">
					<label for="pw">Password</label>
					<input type="password" name="pw" maxlength="8" required>
				</div>
				<div class="form-group">
					<label for="pw_confirm">Konfirmasi Password</label>
					<input type="password" name="pw_confirm" maxlength="8" required>
				</div>
				<button class="button">Daftar</button>
				<p class="text">Login <a href="login.php">Disini</a></p>
			</form>
		</div>
	</div>

</body>
</html>
