<?php
include './src/koneksi.php';

if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

if (empty($_SESSION['id'])) {
    header('location:./loginfirst.php');
}

$query = "SELECT idsubkriteria FROM tbsubkriteria ORDER BY idsubkriteria DESC LIMIT 1";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastidsubkriteria = $row["idsubkriteria"];
    // Generate the next idsubkriteria
    $nextidsubkriteria = "C" . ($row["idsubkriteria"] + 1);
    $idsubkriteria = ($row["idsubkriteria"] + 1);
} else {
    // If no data exists, default to A1
    $nextidsubkriteria = "C1";
    $idsubkriteria = "1";
}

$data['namarombel'] = "";
$vnamakriteria = "";
$vnamasubkriteria = "";
$vketerangan = "";
$vbobotsubkriteria = "";

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbsubkriteria WHERE idsubkriteria = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);

        if ($data) {
            $Idkriteria = $data['idkriteria'];
            $idsubkriteria = $data['idsubkriteria'];
            $vnamasubkriteria = $data['namasubkriteria'];
            $vketerangan = $data['keterangansubkriteria'];
            $vbobotsubkriteria = $data['bobotsubkriteria'];
        }
    }

    if ($_GET['hal'] == "hapus") {
        $cek = mysqli_query($koneksi, "SELECT * FROM tbsubkriteria WHERE idsubkriteria = '$_GET[id]'");
        $data = mysqli_fetch_array($cek);

        if ($data) {
            $hapus = mysqli_query($koneksi, "DELETE FROM tbsubkriteria WHERE idsubkriteria = '$_GET[id]'");

            if ($hapus) {
                session_start();
                $_SESSION['pesan'] = 'hapus()';
                header('location:./subkriteria.php');
            } else {
                session_start();
                $_SESSION['pesan'] = 'gagalhapus()';
                header('location:./subkriteria.php');
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

<body onload="<?= @$pesan ?>">
    <?php include './src/navbar.php'; ?>

    <section id="isi">
        <form action="./src/aksicrud.php" method="post" class="max-w-5xl mx-auto mt-12">
            <div class="text-3xl text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-secondary font-bold">Data Sub Kriteria</div>
            <hr class="w-12 h-1 outline-none border-none bg-gradient-to-r from-primary via-primary to-secondary rounded-full mb-4">
            <div class="grid grid-cols-3 items-center justify-between gap-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Kode Kriteria<div class="text-red-600">*</div></span>
                        <input type="text" name="tidsubkriteria" class="input input-bordered hidden" value="<?= $idsubkriteria ?>" />
                    </label>
                    <select name="tidkriteria" id="tidkriteria" required class="select select-bordered" onchange="populateNamaKriteria()">
                        <option value=""></option>
                        <?php
                        $query = "SELECT * FROM tbkriteria";
                        $result = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $idKriteria = $row['idkriteria'];
                            $namaKriteria = $row['namakriteria'];
                            // Membuat opsi untuk combo box
                            echo "<option value='$idKriteria' data-nama='$namaKriteria' >C$idKriteria</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-control col-span-2">
                    <label class="label">
                        <span class="label-text flex">Nama Kriteria<div class="text-red-600">*</div></span>
                    </label>
                    <input type="text" name="tnamakriteria" id="tnamakriteria" readonly class="input input-bordered input-disabled bg-gray-800 border-2 border-gray-700" />
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Nama Sub Kriteria<div class="text-red-600">*</div></span>
                    </label>
                    <input type="text" name="tnamasubkriteria" required value="<?= $vnamasubkriteria ?>" class="input input-bordered" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Keterangan</span>
                    </label>
                    <input type="text" name="tketerangan" value="<?= $vketerangan ?>" class="input input-bordered" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Bobot<div class="text-red-600">*</div></span>
                    </label>
                    <input type="number" name="tbobot" required value="<?= $vbobotsubkriteria ?>" class="input input-bordered" />
                </div>
                <div class="col-span-3 w-full mx-auto flex items-center justify-center gap-3">
                    <button type="submit" name="bsubkriteria" class="btn btn-primary">Simpan</button>
                    <a href="./subkriteria.php" class="btn btn-secondary">Reset</a>
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
                        <th class="hidden">Kode Sub Kriteria</th>
                        <th>Nama Sub Kriteria</th>
                        <th>Keterangan</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = "SELECT * FROM tbsubkriteria";
                    $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) > 0) {
                        // Menampilkan data jika ada
                        while ($data = mysqli_fetch_array($query)) :
                    ?>
                            <!-- row 1 -->
                            <tr>
                                <th><?= "C" . $data['idkriteria'] ?></th>
                                <th class="hidden"><?= $data['idsubkriteria'] ?></th>
                                <th><?= $data['namasubkriteria'] ?></th>
                                <th><?= $data['keterangansubkriteria'] ?></th>
                                <th><?= $data['bobotsubkriteria'] ?></th>
                                <th>
                                    <a href="./subkriteria.php?hal=edit&id=<?= $data['idsubkriteria'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="./subkriteria.php?hal=hapus&id=<?= $data['idsubkriteria'] ?>" class="btn btn-sm btn-secondary">Hapus</a>
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

        function populateNamaKriteria() {
            // Mendapatkan nilai terpilih dari dropdown
            var selectedKriteria = document.getElementById("tidkriteria");
            var selectedOption = selectedKriteria.options[selectedKriteria.selectedIndex];
            var selectedNamaKriteria = selectedOption.getAttribute("data-nama");

            // Mengisi nilai ke dalam input dengan id "tnamakriteria"
            document.getElementById("tnamakriteria").value = selectedNamaKriteria;
        }
    </script>
</body>

</html>