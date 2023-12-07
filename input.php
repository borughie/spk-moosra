<?php
include './src/koneksi.php';

if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

if (empty($_SESSION['id'])) {
    header('location:./loginfirst.php');
}

$query = "SELECT idhitung FROM tbhitung ORDER BY idhitung DESC LIMIT 1";
$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastidsubkriteria = $row["idhitung"];
    // Generate the next idsubkriteria
    $idhitung = ($row["idhitung"] + 1);
} else {
    // If no data exists, default to A1
    $idhitung = "1";
}


if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "hapus") {
        $cek = mysqli_query($koneksi, "SELECT * FROM tbhitung WHERE idalternatif = '$_GET[id]'");
        $data = mysqli_fetch_array($cek);

        if ($data) {
            $hapus = mysqli_query($koneksi, "DELETE FROM tbhitung WHERE idalternatif = '$_GET[id]'");

            if ($hapus) {
                session_start();
                $_SESSION['pesan'] = 'hapus()';
                header('location:./input.php');
            } else {
                session_start();
                $_SESSION['pesan'] = 'gagalhapus()';
                header('location:./input.php');
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
            <div class="text-3xl text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-secondary font-bold">Penginputan Data</div>
            <hr class="w-12 h-1 outline-none border-none bg-gradient-to-r from-primary via-primary to-secondary rounded-full mb-4">
            <input type="text" name="tidhitung" class="input input-bordered hidden" value="<?= $idhitung ?>" />
            <div class="grid grid-cols-3 items-center justify-between gap-4">
                <div class="form-control col-span-3">
                    <label class="label">
                        <span class="label-text flex">Nama Peserta Didik<div class="text-red-600">*</div></span>
                    </label>
                    <select name="tidalternatif" required class="select select-bordered">
                        <option value=""></option>
                        <?php
                        $query = "SELECT * FROM tbalternatif";
                        $result = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $idalternatif = $row['idalternatif'];
                            $namaalternatif = $row['namaalternatif'];
                            // Membuat opsi untuk combo box
                            echo "<option value='$idalternatif' >$namaalternatif</option>";
                        }
                        ?>
                    </select>
                </div>
                <?php
                $query = "SELECT * FROM tbkriteria";
                $result = mysqli_query($koneksi, $query);
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text flex"><?= $data['namakriteria'] ?><div class="text-red-600">*</div></span>
                        </label>
                        <select name="<?= 'C' . $data['idkriteria'] ?>" required class="select select-bordered">
                            <option value=""></option>
                            <?php
                            $query = "SELECT * FROM tbsubkriteria WHERE idkriteria = '$data[idkriteria]'";
                            $results = mysqli_query($koneksi, $query);
                            while ($rows = mysqli_fetch_array($results)) {
                                $bobotsubkriteria = $rows['bobotsubkriteria'];
                                $namasubkriteria = $rows['namasubkriteria'];
                                // Membuat opsi untuk combo box
                                echo "<option value='$bobotsubkriteria' >$namasubkriteria</option>";
                            }
                            ?>
                        </select>
                    </div>
                <?php } ?>
                <div class="col-span-3 w-full mx-auto flex items-center justify-center gap-3">
                    <button type="submit" name="binput" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
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
                        <th>Nama Alternatif</th>
                        <?php
                        // Menampilkan header hanya untuk kolom dengan nilai lebih dari 0 di setidaknya satu baris
                        $columnsToShow = [];
                        for ($i = 1; $i <= 12; $i++) {
                            $columnHeader = 'C' . $i;
                            $q = "SELECT COUNT(*) FROM tbhitung WHERE $columnHeader > 0";
                            $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
                            $hasData = mysqli_fetch_array($query)[0] > 0;

                            if ($hasData) {
                                echo '<th>' . $columnHeader . '</th>';
                                $columnsToShow[] = $columnHeader; // Menyimpan nama kolom yang akan ditampilkan di tbody
                            }
                        }
                        ?>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = "SELECT * FROM tbhitung INNER JOIN tbalternatif ON tbhitung.idalternatif = tbalternatif.idalternatif";
                    $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) > 0) {
                        // Menampilkan data jika ada
                        while ($data = mysqli_fetch_array($query)) :
                    ?>
                            <tr>
                                <th><?= 'A' . $data['idalternatif'] ?></th>
                                <th><?= $data['namaalternatif'] ?></th>
                                <?php
                                // Menampilkan hanya kolom dari C1 sampai C7 sesuai dengan header
                                foreach ($columnsToShow as $columnName) {
                                    $columnValue = $data[$columnName];
                                    echo '<th>' . $columnValue . '</th>';
                                }
                                ?>
                                <th>
                                    <a href="./input.php?hal=hapus&id=<?= $data['idalternatif'] ?>" class="btn btn-sm btn-secondary">Hapus</a>
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