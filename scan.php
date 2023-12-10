<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Code Scanner</title>
</head>
<body>

<div id="qr-result"></div>
<center><h1>Digi Scan</h1></center>
<div style="display: flex; justify-content: center;">
    <div id="qr-reader" style="width: 500px;">
        
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

  domReady(function() {
      var myqr = document.getElementById('qr-result')
      var lastResult,countResult = 0;

      // jika menemukan qr code
      function onScanSucces(decodeText,decodeResult){
        if (decodeText !== lastResult) {
            ++countResult;
            lastResult = decodeText;

            // allert qrcode
            alert("You QR is : " + decodeText,decodeResult)

            myqr.innerHTML = ' you scan ${countResult} : ${decodeText}'


        }
      }

      // render kamera
      var htmlscanner = new Html5QrcodeScanner(
        "qr-reader",{fps:10,qrbox:250})

      htmlscanner.render(onScanSucces)
  })

</script>

</body>
</html>
