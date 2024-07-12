<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "projek1";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if(!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

