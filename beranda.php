<?php
include './src/koneksi.php';

session_start();
if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

if (empty($_SESSION['id'])) {
    header('location:./loginfirst.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | Metode MOOSRA</title>
    <?php include './src/header.php'; ?>
</head>

<body onload="<?= @$pesan ?>">
    <?php include './src/navbar.php'; ?>

    <div class="max-w-5xl mx-auto flex flex-col items-center justify-center h-screen -mt-20">
        <div class="text-center font-bold text-4xl">Aplikasi Pengambilan Keputusan <br> Dengan Menggunakan
            <span class="text-transparent pl-1 bg-clip-text bg-gradient-to-r from-primary via-secondary to-secondary">Metode MOOSRA</span>
        </div>
        <hr class="w-48 h-2 outline-none mx-auto border-none bg-gradient-to-r from-primary via-primary to-secondary rounded-full my-4">
        <div class="text-center mb-24">Multi Objective Optimazation on the basis of Simple Ratio Analysis (MOOSRA) adalah metode yang digunakan untuk mengevaluasi alternatif-alternatif dalam sistem multi-kriteria dengan menentukan pilihan terbaik yang dioptimalkan berdasarkan kriteria yang diinginkan</div>

        <div class="grid grid-cols-3 gap-4 justify-center items-center w-[46rem]">
            <a href="./alternatif.php" class="card bg-gray-900 hover:bg-gray-950 transition-all duration-300 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Alternatif</h2>
                    <?php
                    $query = "SELECT COUNT(*) as total FROM tbalternatif";
                    $result = $koneksi->query($query);
                    if ($result) {
                        $row = $result->fetch_assoc();
                    ?>
                        <div class="card-actions justify-end text-5xl font-semibold text-transparent bg-clip-text bg-gradient-to-br from-primary via-primary to-secondary"><?= $row['total'] ?></div>
                    <?php }
                    ?>
                </div>
            </a>
            <a href="./kriteria.php" class="card bg-gray-900 hover:bg-gray-950 transition-all duration-300 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Kriteria</h2>
                    <?php
                    $query = "SELECT COUNT(*) as total FROM tbkriteria";
                    $result = $koneksi->query($query);
                    if ($result) {
                        $row = $result->fetch_assoc();
                    ?>
                        <div class="card-actions justify-end text-5xl font-semibold text-transparent bg-clip-text bg-gradient-to-br from-primary via-primary to-secondary"><?= $row['total'] ?></div>
                    <?php }
                    ?>
                </div>
            </a>
            <a href="./subkriteria.php" class="card bg-gray-900 hover:bg-gray-950 transition-all duration-300 shadow-xl">
                <div class="card-body">
                    <h2 class="card-title">Sub Kriteria</h2>
                    <?php
                    $query = "SELECT COUNT(*) as total FROM tbsubkriteria";
                    $result = $koneksi->query($query);
                    if ($result) {
                        $row = $result->fetch_assoc();
                    ?>
                        <div class="card-actions justify-end text-5xl font-semibold text-transparent bg-clip-text bg-gradient-to-br from-primary via-primary to-secondary"><?= $row['total'] ?></div>
                    <?php }
                    ?>
                </div>
            </a>
        </div>

        <div class=""></div>

    </div>

</body>

</html>