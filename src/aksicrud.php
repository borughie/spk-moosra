<?php

// Panggil Koneksi Database
include "./koneksi.php";
date_default_timezone_set('Asia/Kuala_Lumpur');
session_start();

if (isset($_POST['balternatif'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM tbalternatif WHERE idalternatif = '$_POST[tkode1]'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        $edit = mysqli_query($koneksi, "UPDATE tbalternatif set namaalternatif = '$_POST[tnamaalternatif]', keteranganalternatif = '$_POST[tketeranganalternatif]' WHERE idalternatif = '$_POST[tkode1]'");
        if ($edit) {
            session_start();
            $_SESSION['pesan'] = 'update()';
            header('location:../alternatif.php');
        } else {
            session_start();
            $_SESSION['pesan'] = 'gagalupdate()';
            header('location:../alternatif.php');
        }
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO tbalternatif (idalternatif, namaalternatif, keteranganalternatif) VALUES ('$_POST[tkode1]','$_POST[tnamaalternatif]','$_POST[tketeranganalternatif]')");
        if ($simpan) {
            session_start();
            $_SESSION['pesan'] = 'simpan()';
            header('location:../alternatif.php');
        } else {
            session_start();
            $_SESSION['pesan'] = 'gagalsimpan()';
            header('location:../alternatif.php');
        }
    }
}

if (isset($_POST['bkriteria'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM tbkriteria WHERE idkriteria = '$_POST[tkode1]'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        $edit = mysqli_query($koneksi, "UPDATE tbkriteria set namakriteria = '$_POST[tnamakriteria]', jeniskriteria = '$_POST[tjeniskriteria]', bobot = '$_POST[tbobot]' WHERE idkriteria = '$_POST[tkode1]'");
        if ($edit) {
            session_start();
            $_SESSION['pesan'] = 'update()';
            header('location:../kriteria.php');
        } else {
            session_start();
            $_SESSION['pesan'] = 'gagalupdate()';
            header('location:../kriteria.php');
        }
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO tbkriteria (idkriteria, namakriteria, jeniskriteria, bobot) VALUES ('$_POST[tkode1]','$_POST[tnamakriteria]','$_POST[tjeniskriteria]','$_POST[tbobot]')");
        if ($simpan) {
            session_start();
            $_SESSION['pesan'] = 'simpan()';
            header('location:../kriteria.php');
        } else {
            session_start();
            $_SESSION['pesan'] = 'gagalsimpan()';
            header('location:../kriteria.php');
        }
    }
}

if (isset($_POST['bsubkriteria'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM tbsubkriteria WHERE idsubkriteria = '$_POST[tidsubkriteria]'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        $edit = mysqli_query($koneksi, "UPDATE tbsubkriteria set idkriteria = '$_POST[tidkriteria]', namasubkriteria = '$_POST[tnamasubkriteria]', keterangansubkriteria = '$_POST[tketerangan]', bobotsubkriteria = '$_POST[tbobot]' WHERE idsubkriteria = '$_POST[tidsubkriteria]'");
        if ($edit) {
            session_start();
            $_SESSION['pesan'] = 'update()';
            header('location:../subkriteria.php');
        } else {
            session_start();
            $_SESSION['pesan'] = 'gagalupdate()';
            header('location:../subkriteria.php');
        }
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO tbsubkriteria (idkriteria, idsubkriteria, namasubkriteria, keterangansubkriteria, bobotsubkriteria) VALUES ('$_POST[tidkriteria]','$_POST[tidsubkriteria]','$_POST[tnamasubkriteria]','$_POST[tketerangan]','$_POST[tbobot]')");
        if ($simpan) {
            session_start();
            $_SESSION['pesan'] = 'simpan()';
            header('location:../subkriteria.php');
        } else {
            session_start();
            $_SESSION['pesan'] = 'gagalsimpan()';
            header('location:../subkriteria.php');
        }
    }
}

if (isset($_POST['binput'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM tbhitung WHERE idalternatif = '$_POST[tidalternatif]'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        $edit = mysqli_query($koneksi, "UPDATE tbhitung set C1 = '$_POST[C1]', C2 = '$_POST[C2]', C3 = '$_POST[C3]', C4 = '$_POST[C4]', C5 = '$_POST[C5]', C6 = '$_POST[C6]', C7 = '$_POST[C7]', C8 = '$_POST[C8]', C9 = '$_POST[C9]', C10 = '$_POST[C10]', C11 = '$_POST[C11]', C12 = '$_POST[C12]' WHERE idalternatif = '$_POST[tidalternatif]'");
        if ($edit) {
            session_start();
            $_SESSION['pesan'] = 'update()';
            header('location:../input.php');
        } else {
            session_start();
            $_SESSION['pesan'] = 'gagalupdate()';
            header('location:../input.php');
        }
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO tbhitung (idhitung, idalternatif, C1, C2, C3, C4, C5, C6, C7, C8, C9, C10, C11, C12) VALUES ('$_POST[tidhitung]','$_POST[tidalternatif]','$_POST[C1]','$_POST[C2]','$_POST[C3]','$_POST[C4]','$_POST[C5]','$_POST[C6]','$_POST[C7]','$_POST[C8]','$_POST[C9]','$_POST[C10]','$_POST[C11]','$_POST[C12]')");
        if ($simpan) {
            session_start();
            $_SESSION['pesan'] = 'simpan()';
            header('location:../input.php');
        } else {
            session_start();
            $_SESSION['pesan'] = 'gagalsimpan()';
            header('location:../input.php');
        }
    }
}


if (isset($_POST['blogin'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE nim = '$_POST[tnim]'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        if (md5($_POST['tpassword']) == $data['password']) {
            $_SESSION['id'] = $data['iduser'];
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
