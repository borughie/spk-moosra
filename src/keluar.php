<?php

session_start();
session_unset();
session_destroy();

session_start();
$_SESSION['pesan'] = "logout()";
header('location:../index.php');
