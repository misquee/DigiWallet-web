<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style/login.css?version=4">
  <title>Log-In</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="js/login.js"></script>
</head>
<body>
  <div class="container">
    <div class="center">
      <img src="img/wbank.png" alt="Logo">
      <h1 class="judul">W-BANK</h1>
      <p class="login-text">LOGIN</p>
      <form action="wceklogin.php" method="POST" id="loginForm">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" required>
        </div>
        <div class="form-group">
          <label for="pw">Password</label>
          <input type="password" name="pw" maxlength="8" required>
        </div>
        <button class="button" type="button" onclick="validateLogin()">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
