<?php
$servername = "localhost:3307";
$database = "crudflutter";
$username = "root";
$password = "";

    // Create connection

$koneksi = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($koneksi);
