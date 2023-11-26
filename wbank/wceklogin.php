<?php
// wceklogin.php

session_start();
include('../koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['pw']);

    $query = "SELECT * FROM wbank WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        echo "Login successful";
    } else {
        echo "Login failed. Please try again.";
    }
}
?>
