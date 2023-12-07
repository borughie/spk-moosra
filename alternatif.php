<?php
include './src/koneksi.php';

if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

if (empty($_SESSION['id'])) {
    header('location:./loginfirst.php');
}

$query = "SELECT idalternatif FROM tbalternatif ORDER BY idalternatif DESC LIMIT 1";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastIdAlternatif = $row["idalternatif"];
    $nextIdAlternatif = "A" . ($row["idalternatif"] + 1);
    $IdAlternatif = ($row["idalternatif"] + 1);
} else {
    $nextIdAlternatif = "A1";
    $IdAlternatif = "1";
}

$vnama = "";
$vketerangan = "";

if (isset($_GET['hal'])) {

    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbalternatif WHERE idalternatif = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);

        if ($data) {
            $IdAlternatif = $data['idalternatif'];
            $nextIdAlternatif = 'A' . $data['idalternatif'];
            $vnama = $data['namaalternatif'];
            $vketerangan = $data['keteranganalternatif'];
        }
    }

    if ($_GET['hal'] == "hapus") {
        $cek = mysqli_query($koneksi, "SELECT * FROM tbalternatif WHERE idalternatif = '$_GET[id]'");
        $data = mysqli_fetch_array($cek);

        if ($data) {
            $hapus = mysqli_query($koneksi, "DELETE FROM tbalternatif WHERE idalternatif = '$_GET[id]'");
            $hapus1 = mysqli_query($koneksi, "DELETE FROM tbhitung WHERE idalternatif = '$_GET[id]'");

            if ($hapus && $hapus1) {
                session_start();
                $_SESSION['pesan'] = 'hapus()';
                header('location:./alternatif.php');
            } else {
                session_start();
                $_SESSION['pesan'] = 'gagalhapus()';
                header('location:./alternatif.php');
            }
        }
    }
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

<body onload="<?= @$pesan ?>" class="select-none">
    <?php include './src/navbar.php'; ?>

    <section id="isi" class="max-w-7xl mx-auto">
        <form action="./src/aksicrud.php" method="post" class="max-w-5xl mx-auto mt-12">
            <div class="text-3xl text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-secondary font-bold">Data Alternatif</div>
            <hr class="w-12 h-1 outline-none border-none bg-gradient-to-r from-primary via-primary to-secondary rounded-full mb-4">
            <div class="grid grid-cols-2 items-center justify-between gap-4">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text flex">Kode Alternatif<div class="text-red-600">*</div></span>
                    </label>
                    <input type="text" name="tkode" readonly class="input input-bordered input-disabled bg-gray-800 border-2 border-gray-700" value="<?= $nextIdAlternatif; ?>" />
                    <input type="text" name="tkode1" readonly class="input input-bordered hidden" value="<?= $IdAlternatif; ?>" />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Keterangan</span>
                    </label>
                    <input type="text" name="tketeranganalternatif" value="<?= $vketerangan ?>" class="input input-bordered" />
                </div>
                <div class="form-control col-span-2">
                    <label class="label">
                        <span class="label-text flex">Nama Alternatif<div class="text-red-600">*</div></span>
                    </label>
                    <input type="text" name="tnamaalternatif" required value="<?= $vnama ?>" class="input input-bordered" />
                </div>
                <div class="col-span-2 w-full mx-auto flex items-center justify-center gap-3">
                    <button type="submit" name="balternatif" class="btn btn-primary">Simpan</button>
                    <a href="./alternatif.php" class="btn btn-secondary">Reset</a>
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
                        <th>Kode Alternatif</th>
                        <th>Name Alternatif</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = "SELECT * FROM tbalternatif";
                    $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) > 0) {
                        // Menampilkan data jika ada
                        while ($data = mysqli_fetch_array($query)) :
                    ?>
                            <!-- row 1 -->
                            <tr>
                                <th><?= "A" . $data['idalternatif'] ?></th>
                                <th><?= $data['namaalternatif'] ?></th>
                                <th><?= $data['keteranganalternatif'] ?></th>
                                <th>
                                    <a href="./alternatif.php?hal=edit&id=<?= $data['idalternatif'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="./alternatif.php?hal=hapus&id=<?= $data['idalternatif'] ?>" class="btn btn-sm btn-secondary">Hapus</a>
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
            // Inisialisasi DataTables
            $('#myTable').DataTable();
        });
    </script>

</body>

</html>