// login.js
function validateLogin() {
  var username = document.getElementsByName("username")[0].value;
  var password = document.getElementsByName("pw")[0].value;

  // Periksa apakah input telah diisi
  if (username === "" || password === "") {
    alert("Harap lengkapi semua inputan.");
    return; // Tidak melanjutkan jika input belum lengkap
  }

  // Kirim data ke PHP menggunakan AJAX
  $.ajax({
    type: "POST",
    url: "wceklogin.php",
    data: { username: username, pw: password },
    success: function (response) {
      if (response.includes("Login failed. Please try again.")) {
        alert("Username atau password salah. Silahkan login ulang.");
      } else {
        window.location.href = "wbank.php";
      }
    },
    error: function (error) {
      console.log("Error: " + error);
    }
  });
}
