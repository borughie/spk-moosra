<?php
// Koneksi Database
$server = "localhost";
$user = "root";
$password = "";
$database = "dbmoosra1";

// Buat Koneksi Database
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));
