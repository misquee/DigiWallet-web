// script.js

document.addEventListener("DOMContentLoaded", function() {
    loadContent('wtopup.php');
});



function loadContent(page) {
    // Gunakan AJAX untuk memuat konten baru di sebelah kanan
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;

            // Panggil fungsi untuk menambahkan event listener ke halaman yang baru dimuat
            addEventListenersToNewContent();
        }
    };
    xhttp.open('GET', page, true);
    xhttp.send();
}

// Tambahkan fungsi ini untuk menambahkan event listener ke halaman yang baru dimuat
function addEventListenersToNewContent() {
    // Misalnya, tambahkan event listener untuk icon scan
    var scanIcon = document.getElementById('scan-icon');
    if (scanIcon) {
        scanIcon.addEventListener('click', function() {
            loadScanPage();
        });
    }
}

