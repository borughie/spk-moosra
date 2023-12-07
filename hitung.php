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

?>

<!DOCTYPE html>
<html data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | Metode MOOSRA</title>
    <?php include './src/header.php'; ?>
</head>

<body onload="<?= @$pesan ?>" class="select-none">
    <?php include './src/navbar.php'; ?>

    <section id="tabel" class="max-w-7xl mx-auto">
        <div class="text-3xl text-transparent bg-clip-text bg-gradient-to-r from-primary via-secondary to-secondary font-bold mt-12">Proses Perhitungan Data</div>
        <hr class="w-12 h-1 outline-none border-none bg-gradient-to-r from-primary via-primary to-secondary rounded-full">
        <div class="text-xl font-semibold mt-4 ml-2">1. Bentuk Matriks</div>
        <div class="grid grid-cols-9 items-start justify-between gap-x-4 max-w-7xl mx-auto">
            <div class="overflow-x-auto mx-auto col-span-7 w-full">
                <table class="table text-center dark:bg-base-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-800">
                        <tr>
                            <th>Alternatif</th>
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
                                    <?php
                                    foreach ($columnsToShow as $columnName) {
                                        $columnValue = $data[$columnName];
                                        echo '<th>' . $columnValue . '</th>';
                                    }
                                    ?>
                                </tr>
                        <?php
                            endwhile;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto mx-auto col-span-2 w-full">
                <table class="table text-center dark:bg-base-300 rounded-lg overflow-hidden">
                    <thead class="bg-gray-800">
                        <tr>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Jenis</th>
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
                                    <th><?= $data['bobot'] ?></th>
                                    <th><?= $data['jeniskriteria'] ?></th>
                                </tr>
                        <?php
                            endwhile;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-xl max-w-xs font-semibold mt-8 ml-2">2. Rate Kecocokan</div>
        <?php
        $q = "SELECT * FROM tbhitung INNER JOIN tbalternatif ON tbhitung.idalternatif = tbalternatif.idalternatif";
        $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));

        // Inisialisasi array untuk menyimpan nilai setiap kriteria
        $nilai_kriteria = array();

        if (mysqli_num_rows($query) > 0) {
            // Membuat array untuk menyimpan kolom yang akan ditampilkan
            $columnsToShow = array();

            // Menampilkan header
            echo '<table class="table text-center dark:bg-base-300 shadow-md shadow-gray-700 rounded-lg overflow-hidden max-w-xs">';
            echo '<thead class="bg-gray-800"><tr><th>Kriteria</th><th>Nilai</th></tr></thead>';
            echo '<tbody>';

            while ($data = mysqli_fetch_array($query)) {
                foreach ($data as $key => $value) {
                    if (substr($key, 0, 1) == 'C' && $value > 0) {
                        $columnName = $key;
                        if (!in_array($columnName, $columnsToShow)) {
                            $columnsToShow[] = $columnName;
                        }

                        // Menambahkan nilai kriteria
                        if (!isset($nilai_kriteria[$columnName])) {
                            $nilai_kriteria[$columnName] = 0;
                        }
                        $nilai_kriteria[$columnName] += pow($value, 2);
                    }
                }
            }

            // Menampilkan data nilai kriteria
            foreach ($columnsToShow as $columnName) {
                $nilai_kriteria[$columnName] = round(sqrt($nilai_kriteria[$columnName]), 2);
                echo "<tr><th>$columnName</th><th>{$nilai_kriteria[$columnName]}</th></tr>";
            }

            echo '</tbody>';
            echo '</table>';

        ?>

            <div class="text-xl font-semibold mt-8 ml-2">3. Normalisasi</div>
        <?php
            // Normalisasi berdasarkan nilai kriteria
            $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
            if (mysqli_num_rows($query) > 0) {
                echo '<table class="table text-center dark:bg-base-300 shadow-md shadow-gray-700 rounded-lg overflow-hidden">';
                echo '<thead class="bg-gray-800"><tr><th>Alternatif</th>';

                // Menampilkan header hanya untuk kolom yang memiliki nilai
                foreach ($columnsToShow as $columnName) {
                    echo '<th>' . $columnName . '</th>';
                }

                echo '</tr></thead>';
                echo '<tbody>';

                while ($data = mysqli_fetch_array($query)) {
                    echo '<tr>';
                    echo '<th>A' . $data['idalternatif'] . '</th>';

                    // Menampilkan nilai normalisasi hanya untuk kolom yang memiliki nilai
                    foreach ($columnsToShow as $columnName) {
                        // Menghitung normalisasi sesuai rumus
                        echo '<th>' . round($data[$columnName] / $nilai_kriteria[$columnName], 2) . '</th>';
                    }

                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>Data Tidak Tersedia</p>';
            }
        }
        ?>



        <div class="text-xl font-semibold mt-8 ml-2">4. Normalisasi Bobot</div>
        <?php
        $q = "SELECT * FROM tbhitung INNER JOIN tbalternatif ON tbhitung.idalternatif = tbalternatif.idalternatif";
        $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));

        // Inisialisasi array untuk menyimpan nilai setiap kriteria dan nilai asli sebelum normalisasi
        $nilai_kriteria = array();
        $bobot_kriteria = array(); // Menyimpan bobot kriteria dari tbkriteria
        $nilai_asli = array();

        // Ambil bobot kriteria dari tbkriteria
        $q_bobot = "SELECT * FROM tbkriteria";
        $query_bobot = mysqli_query($koneksi, $q_bobot) or die(mysqli_error($koneksi));

        if (mysqli_num_rows($query_bobot) > 0) {
            while ($data_bobot = mysqli_fetch_array($query_bobot)) {
                $bobot_kriteria['C' . $data_bobot['idkriteria']] = $data_bobot['bobot'];
            }
        }

        if (mysqli_num_rows($query) > 0) {
            // Membuat array untuk menyimpan kolom yang akan ditampilkan
            $columnsToShow = array();

            // Menampilkan header
            echo '<table class="table text-center dark:bg-base-300 shadow-md shadow-gray-700 rounded-lg overflow-hidden">';
            echo '<thead class="bg-gray-800"><tr><th>Alternatif</th>';

            while ($data = mysqli_fetch_array($query)) {
                foreach ($data as $key => $value) {
                    if (substr($key, 0, 1) == 'C' && $value > 0) {
                        $columnName = $key;
                        if (!in_array($columnName, $columnsToShow)) {
                            $columnsToShow[] = $columnName;
                        }

                        // Menambahkan nilai kriteria
                        if (!isset($nilai_kriteria[$columnName])) {
                            $nilai_kriteria[$columnName] = 0;
                        }
                        $nilai_kriteria[$columnName] += pow($value, 2);

                        // Menambahkan nilai asli sebelum normalisasi
                        if (!isset($nilai_asli[$columnName])) {
                            $nilai_asli[$columnName] = array();
                        }
                        $nilai_asli[$columnName][] = $value;
                    }
                }
            }

            // Menampilkan header untuk kolom yang memiliki nilai
            foreach ($columnsToShow as $columnName) {
                echo '<th>' . $columnName . '</th>';
            }

            echo '</tr></thead>';
            echo '<tbody>';

            // Menghitung akar kuadrat dan membulatkannya
            foreach ($nilai_kriteria as $columnName => $total) {
                $nilai_kriteria[$columnName] = sqrt($total);
            }

            $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
            $index = 0; // Indeks untuk mengakses nilai asli sebelum normalisasi
            while ($data = mysqli_fetch_array($query)) {
                echo '<tr>';
                echo '<th>A' . $data['idalternatif'] . '</th>';

                // Menampilkan nilai normalisasi hanya untuk kolom yang memiliki nilai
                foreach ($columnsToShow as $columnName) {
                    // Menghitung normalisasi sesuai rumus
                    echo '<th>' . round(($data[$columnName] / $nilai_kriteria[$columnName]) * $bobot_kriteria[$columnName], 2) . '</th>';
                }

                echo '</tr>';
                $index++;
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Data Tidak Tersedia</p>';
        }
        ?>


        <div class="text-xl font-semibold max-w-md mt-8 ml-2">5. Nilai Akhir</div>
        <?php
        // Inisialisasi array untuk menyimpan nilai akhir
        $nilai_akhir = array();

        // Mengambil data kriteria dari tbkriteria
        $q_kriteria = "SELECT * FROM tbkriteria";
        $query_kriteria = mysqli_query($koneksi, $q_kriteria) or die(mysqli_error($koneksi));

        $columnsBenefit = array();
        $columnsCost = array();

        while ($data_kriteria = mysqli_fetch_array($query_kriteria)) {
            $columnName = 'C' . $data_kriteria['idkriteria'];
            if ($data_kriteria['jeniskriteria'] == 'Benefit') {
                $columnsBenefit[] = $columnName;
            } elseif ($data_kriteria['jeniskriteria'] == 'Cost') {
                $columnsCost[] = $columnName;
            }
        }

        // Menghitung nilai akhir untuk setiap alternatif
        $query = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
        while ($data = mysqli_fetch_array($query)) {
            $nilai_benefit = 0;
            $nilai_cost = 0;

            // Menghitung nilai benefit
            foreach ($columnsBenefit as $columnName) {
                $nilai_benefit += ($data[$columnName] / $nilai_kriteria[$columnName]) * $bobot_kriteria[$columnName];
            }

            // Menghitung nilai cost
            foreach ($columnsCost as $columnName) {
                $nilai_cost += ($data[$columnName] / $nilai_kriteria[$columnName]) * $bobot_kriteria[$columnName];
            }

            // Menghitung nilai akhir sesuai rumus
            $nilai_akhir[$data['idalternatif']] = $nilai_benefit / $nilai_cost;
        }

        // Mengurutkan nilai akhir dari yang tertinggi ke terendah
        arsort($nilai_akhir);

        // Menampilkan hasil dalam bentuk tabel
        echo '<table class="table text-center dark:bg-base-300 shadow-md shadow-gray-700 rounded-lg overflow-hidden max-w-md">';
        echo '<thead class="bg-gray-800"><tr><th>Alternatif</th><th>Nilai Akhir</th><th>Peringkat</th></tr></thead>';
        echo '<tbody>';
        $peringkat = 1;
        foreach ($nilai_akhir as $alternatif => $nilai) {
            echo '<tr>';
            echo '<th>A' . $alternatif . '</th>';
            echo '<th>' . round($nilai, 2) . '</th>';
            echo '<th>' . $peringkat . '</th>';
            echo '</tr>';
            $peringkat++;
        }
        echo '</tbody>';
        echo '</table>';
        ?>

        <div class="text-xl font-semibold mt-8 ml-2">6. Kesimpulan</div>
        <?php
        // Mendapatkan nilai terbaik dan peringkat pertama
        $alternatif_terbaik = key($nilai_akhir);
        $nilai_terbaik = reset($nilai_akhir);
        ?>
        <div class="bg-base-300 p-6 rounded-lg mb-8">
            <p>Alternatif terbaik adalah
                <span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">A<?= $alternatif_terbaik ?></span> dengan nilai akhir <span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold"><?= round($nilai_terbaik, 2) ?></span>
            </p>
        </div>
    </section>

</body>

</html>