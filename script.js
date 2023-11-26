// script.js

document.addEventListener("DOMContentLoaded", function() {
    loadContent('beranda2.php');
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

function loadScanPage() {
    // Gunakan AJAX untuk memuat konten scan.php di dalam beranda2.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;

            // Panggil fungsi untuk menambahkan event listener ke halaman yang baru dimuat
            addEventListenersToNewContent();
            initCamera();
        }
    };
    xhttp.open('GET', 'scan.php', true);
    xhttp.send();
}

// Tambahkan panggilan fungsi ini untuk menambahkan event listener ke halaman awal
addEventListenersToNewContent();

    function loadKirim() {
        // Gunakan AJAX untuk memuat konten kirim.php di dalam beranda2.php
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('content').innerHTML = this.responseText;
            }
        };
        xhttp.open('GET', 'kirim3.php', true);
        xhttp.send();
    }

    function loadTerima() {
        // Gunakan AJAX untuk memuat konten kirim.php di dalam beranda2.php
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('content').innerHTML = this.responseText;
            }
        };
        xhttp.open('GET', 'terima.php', true);
        xhttp.send();
    }



    function loadUbahProfil() {
    // Gunakan AJAX untuk memuat konten ubah_profil.php di dalam beranda2.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET', 'ubah_profil.php', true);
    xhttp.send();
    }

        function loadPengaturanKeamanan() {
    // Gunakan AJAX untuk memuat konten ubah_profil.php di dalam beranda2.php
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('content').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET', 'pengaturankeamanan.php', true);
    xhttp.send();
    }
    
    

