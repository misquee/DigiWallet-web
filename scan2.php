<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Scanner</title>
  <link rel="stylesheet" type="text/css" href="style/scan.css">
</head>
<body>

<div id="qr-result"></div>
<h1>Digi Scan</h1>
<div style="display: flex; justify-content: center;">
    <div id="qr-reader"></div>
</div>

<div id="modal">
  <div id="modal-content">
    <form id="transferForm" method="post" action="proseskirim3.php">
      <span id="close-modal" onclick="closeModal()">×</span>
      <p>Kirim Uang Ke: <span id="qr-data"></span></p>
      <input type="hidden" id="recipientNumber" name="recipientNumber">

      <label for="amount">Jumlah Kirim:</label>
      <input type="text" id="amount" name="amount" pattern="[0-9]+" required maxlength="8" placeholder="Jumlah Kirim" required maxlength="13" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>

      <br>
      <label for="keterangan">Keterangan:</label>
      <input type="text" id="keterangan" placeholder="Catatan" name="description">
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Password" required>
      <br>
      <button id="submit-btn" type="submit" >Kirim</button>
    </form> 
  </div>
</div>

<!-- library untuk scan -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script type="text/javascript">
  function domReady(fn){
    if (document.readyState === "complete" || document.readyState === "interactive"){
        setTimeout(fn,1)
    } else {
        document.addEventListener("DOMContentLoaded",fn)
    }
  }

  function openModal(qrData) {
    document.getElementById('qr-data').innerText = qrData;
    document.getElementById('modal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('modal').style.display = 'none';
  }

  function kirimData() {
    var amount = document.getElementById('amount').value;
    var password = document.getElementById('password').value;
    var recipientNumber = document.getElementById('recipientNumber').value;

    // Handle the data as needed (e.g., send it to a server using AJAX)
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "proseskirim3.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // Handle the server response if needed
        alert(xhr.responseText);
      }
    };

    var data = "amount=" + amount + "&password=" + password + "&recipientNumber=" + recipientNumber;
    xhr.send(data);

    // Close the modal after processing
    closeModal();
  }


  domReady(function() {
      var myqr = document.getElementById('qr-result');
      var lastResult, countResult = 0;

      // jika menemukan qr code
      function onScanSuccess(decodeText, decodeResult) {
        if (decodeText !== lastResult) {
          ++countResult;
          lastResult = decodeText;

          // Set nilai input hidden untuk nomor penerima
          document.getElementById('recipientNumber').value = decodeText;

          // Open modal with QR data
          openModal(decodeText);
        }
      }


      // render kamera
      var htmlScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 250 }
      );

      htmlScanner.render(onScanSuccess);
  });
</script>

</body>
</html>