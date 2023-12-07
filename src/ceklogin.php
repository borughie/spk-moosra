<?php

if (isset($_POST['blogin'])) {
    session_start();
    // Koneksi Database
    // $server = "sql205.infinityfree.com";
    // $user = "if0_35516921";
    // $password = "rWJ9i2ZuWu";
    // $database = "if0_35516921_moosra";
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "dbmoosra1";

    // Buat Koneksi Database
    $koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));
    $tampil = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE nim = '$_POST[tnim]'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        if (md5($_POST['tpassword']) == $data['password']) {
            session_start();
            $_SESSION['id'] = $data['iduser'];
            $_SESSION['database'] = $database;
            $_SESSION['pesan'] = 'login()';
            header('location:../beranda.php');
        } else {
            $_SESSION['pesan'] = 'password()';
            header('location:../index.php');
        }
    } else {
        $_SESSION['pesan'] = 'username()';
        header('location:../index.php');
    }
}

if (isset($_POST['bguest'])) {
    session_start();
    $_SESSION['id'] = "Guest";
    // $_SESSION['database'] = "if0_35516921_moosra_public";
    $_SESSION['database'] = "dbmoosra1";
    $_SESSION['pesan'] = 'login()';
    header('location:../beranda.php');
}
