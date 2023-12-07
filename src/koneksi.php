<?php
session_start();
// Koneksi Database
$server = "localhost";
$user = "root";
$password = "";
// $server = "sql205.infinityfree.com";
// $user = "if0_35516921";
// $password = "rWJ9i2ZuWu";
$database = $_SESSION['database'];

// Buat Koneksi Database
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));
