function showPopup(event) {
    event.preventDefault(); // Mencegah perilaku default tombol dalam bentuk formulir
    var phone = document.getElementById('phone').value;
    var amount = document.getElementById('amount').value;
    document.getElementById('popup-phone').textContent = phone;
    document.getElementById('popup-amount').textContent = amount;
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup').style.display = 'none';
}

function confirmTopUp() {
    var password = document.getElementById('popup-password').value;
    // Kirim data ke server untuk verifikasi password dan lanjutkan proses top-up
    var formData = new FormData();
    formData.append('phone', document.getElementById('phone').value);
    formData.append('amount', document.getElementById('amount').value);
    formData.append('popup-password', password);

    fetch('prosestopup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Menampilkan pesan dari server
    })
    .catch(error => {
        console.error('Error:', error);
    });

    closePopup();
}
