<?php
include './src/koneksi.php';

if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

if (empty($_SESSION['id'])) {
    header('location:./loginfirst.php');
}

$query = "SELECT idkriteria FROM tbkriteria ORDER BY idkriteria DESC LIMIT 1";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastidkriteria = $row["idkriteria"];
    // Generate the next idkriteria
    $nextidkriteria = "C" . ($row["idkriteria"] + 1);
    $Idkriteria = ($row["idkriteria"] + 1);
} else {
    // If no data exists, default to A1
    $nextidkriteria = "C1";
    $Idkriteria = "1";
}

$vnamakriteria = "";
$vjeniskriteria = "";
$vbobotkriteria = "";

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbkriteria WHERE idkriteria = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);

        if ($data) {
            $Idkriteria = $data['idkriteria'];
            $nextidkriteria = 'C' . $data['idkriteria'];
            $vnamakriteria = $data['namakriteria'];
            $vjeniskriteria = $data['jeniskriteria'];
            $vbobotkriteria = $data['bobot'];
        }
    }

    if ($_GET['hal'] == "hapus") {
        $cek = mysqli_query($koneksi, "SELECT * FROM tbkriteria WHERE idkriteria = '$_GET[id]'");
        $data = mysqli_fetch_array($cek);

        if ($data) {
            $hapus = mysqli_query($koneksi, "DELETE FROM tbkriteria WHERE idkriteria = '$_GET[id]'");
            $hapus1 = mysqli_query($koneksi, "DELETE FROM tbsubkriteria WHERE idkriteria = '$_GET[id]'");
            $n = 'C' . $_GET['id'];
            $hapus2 = mysqli_query($koneksi, "UPDATE tbhitung set $n = 0 WHERE $n != 0");


            if ($hapus) {
                session_start();
                $_SESSION['pesan'] = 'hapus()';
                header('location:./kriteria.php');
            } else {
                session_start();
                $_SESSION['pesan'] = 'gagalhapus()';
                header('location:./kriteria.php');
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | Metode MOOSRA</title>
    <?php include './src/header.php'; ?>
</head>

<body onload="<?= @$pesan ?>" class="select-none">
    <?php include './src/navbar.php'; ?>

    <section id="isi">
        <form action="./src/aksicrud.php" method="post" class="max-w-5xl mx-auto mt-12">
            <div class="text-3xl text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-secondary font-bold">Data Kriteria</div>
            <hr class="w-12 h-1 outline-none border-none bg-gradient-to-r from-primary via-primary to-secondary rounded-full mb-4">
            <div class="grid grid-cols-2 items-center justify-between gap-4 rounded-sm">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Kode Kriteria<div class="text-red-600">*</div></span>
                    </label>
                    <input type="text" name="tkode" readonly class="input input-bordered input-disabled bg-gray-800 border-2 border-gray-700" value="<?= $nextidkriteria; ?>" />
                    <input type="text" name="tkode1" readonly class="input input-bordered hidden" value="<?= $Idkriteria; ?>" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Nama Kriteria<div class="text-red-600">*</div></span>
                    </label>
                    <input type="text" name="tnamakriteria" required value="<?= $vnamakriteria ?>" class="input input-bordered" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Jenis Kriteria<div class="text-red-600">*</div></span>
                    </label>
                    <select name="tjeniskriteria" required class="select select-bordered">
                        <option value="<?= $vjeniskriteria ?>"><?= $vjeniskriteria ?></option>
                        <option>Benefit</option>
                        <option>Cost</option>
                    </select>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Bobot<div class="text-red-600">*</div></span>
                    </label>
                    <input type="number" name="tbobot" required value="<?= $vbobotkriteria ?>" class="input input-bordered" />
                </div>
                <div class="col-span-2 w-full mx-auto flex items-center justify-center gap-3">
                    <button type="submit" name="bkriteria" class="btn btn-primary">Simpan</button>
                    <a href="./kriteria.php" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </section>

    <section id="tabel">
        <div class="overflow-x-auto max-w-5xl my-8 mx-auto dark:bg-base-300 shadow-md shadow-gray-700 p-8 rounded-lg">
            <table class="table text-center" id="myTable">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Kode Kriteria</th>
                        <th>Name Kriteria</th>
                        <th>Jenis Kriteria</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = "SELECT * FROM tbkriteria";
                    $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) > 0) {
                        // Menampilkan data jika ada
                        while ($data = mysqli_fetch_array($query)) :
                    ?>
                            <tr>
                                <th><?= "C" . $data['idkriteria'] ?></th>
                                <th><?= $data['namakriteria'] ?></th>
                                <th><?= $data['jeniskriteria'] ?></th>
                                <th><?= $data['bobot'] ?></th>
                                <th>
                                    <a href="./kriteria.php?hal=edit&id=<?= $data['idkriteria'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="./kriteria.php?hal=hapus&id=<?= $data['idkriteria'] ?>" class="btn btn-sm btn-secondary">Hapus</a>
                                </th>
                            </tr>
                    <?php
                        endwhile;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            if (typeof jQuery !== 'undefined') {
                // jQuery is loaded, you can proceed with DataTables initialization
                $('#myTable').DataTable();
            } else {
                console.error('jQuery is not loaded!');
            }
        });
    </script>

</body>

</html>