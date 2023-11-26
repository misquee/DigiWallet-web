function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

document.getElementById('amount').addEventListener('input', function (event) {
    var inputElement = event.target;
    var inputValue = inputElement.value;
    var numericValue = inputValue.replace(/\D/g, '');
    inputElement.value = formatNumber(numericValue);
});

function confirmTransfer() {
    var recipientNumber = document.getElementById('recipientNumber').value;
    var amount = document.getElementById('amount').value;
    var description = document.getElementById('description').value;

    if (recipientNumber === '' || amount === '' || description === '') {
        alert('Mohon lengkapi semua input sebelum melanjutkan.');
        return;
    }

    document.getElementById('popupContent').innerHTML =
        `Anda akan mentransfer ${amount} kepada ${recipientNumber} dengan keterangan: ${description}`;
    
    document.getElementById('confirmationPopup').style.display = 'block';
}

function closePopup() {
    document.getElementById('confirmationPopup').style.display = 'none';
}

function sendTransfer() {
    var password = document.getElementById('password').value;
    var recipientNumber = document.getElementById('recipientNumber').value;
    var amount = document.getElementById('amount').value.replace(/\D/g, '');
    var description = document.getElementById('description').value;

    fetch('proseskirim2.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'recipientNumber=' + recipientNumber + '&amount=' + amount + '&description=' + description + '&password=' + password,
    })
    .then(response => {
    console.log('Server Response:', response);
    return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Transfer berhasil: ' + data.message);
        } else {
            alert('Transfer gagal. ' + data.message);
        }

        closePopup();
    })

    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan pada server.');
    });
}
