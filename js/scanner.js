Quagga.init({
    inputStream: {
        name: "Live",
        type: "LiveStream",
        target: document.querySelector("#interactive"),
        constraints: {
            width: 480,
            height: 320,
            facingMode: "environment"
        }
    },
    locator: {
        patchSize: "medium",
        halfSample: true
    },
    numOfWorkers: 2,
    frequency: 10,
    decoder: {
        readers: ["code_128_reader"]
    },
    locate: true
}, function(err) {
    if (err) {
        console.error(err);
        return;
    }
    Quagga.start();
});

Quagga.onDetected(function(data) {
    var barcodeData = data.codeResult.code;
    console.log("Barcode detected and processed:", data);
    document.getElementById("barcode-data").innerText = "Data Barcode: " + barcodeData;
    document.getElementById("barcode-data-popup").style.display = "block";
});

function konfirmasiAksi() {
    var jumlahKirim = document.getElementById("jumlahKirim").value;
    var password = document.getElementById("password").value;

    // Lakukan apa yang diperlukan dengan jumlahKirim dan password
    // Misalnya, kirim ke server untuk verifikasi

    // Setelah selesai, sembunyikan popup
    document.getElementById("barcode-data-popup").style.display = "none";
}
