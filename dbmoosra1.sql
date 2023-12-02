-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 06:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmoosra1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbalternatif`
--

CREATE TABLE `tbalternatif` (
  `idalternatif` int(11) NOT NULL,
  `namaalternatif` varchar(50) NOT NULL,
  `keteranganalternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbalternatif`
--

INSERT INTO `tbalternatif` (`idalternatif`, `namaalternatif`, `keteranganalternatif`) VALUES
(1, 'Khakha Surya Samudra', ''),
(2, 'Anjani Septriansyah', ''),
(3, 'Armansyah Daulay', ''),
(4, 'Ismaya Dwi Aprianti', ''),
(5, 'Putri Amelia', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbhitung`
--

CREATE TABLE `tbhitung` (
  `idhitung` int(11) NOT NULL,
  `idalternatif` int(11) NOT NULL,
  `C1` int(1) DEFAULT NULL,
  `C2` int(1) DEFAULT NULL,
  `C3` int(1) DEFAULT NULL,
  `C4` int(1) DEFAULT NULL,
  `C5` int(1) DEFAULT NULL,
  `C6` int(1) DEFAULT NULL,
  `C7` int(1) DEFAULT NULL,
  `C8` int(1) DEFAULT NULL,
  `C9` int(1) DEFAULT NULL,
  `C10` int(1) DEFAULT NULL,
  `C11` int(1) DEFAULT NULL,
  `C12` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbhitung`
--

INSERT INTO `tbhitung` (`idhitung`, `idalternatif`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `C9`, `C10`, `C11`, `C12`) VALUES
(1, 1, 4, 1, 3, 3, 3, 1, 0, 0, 0, 0, 0, 0),
(2, 2, 1, 2, 2, 3, 1, 3, 0, 0, 0, 0, 0, 0),
(3, 3, 4, 2, 3, 3, 1, 3, 0, 0, 0, 0, 0, 0),
(4, 4, 2, 1, 3, 3, 1, 3, 0, 0, 0, 0, 0, 0),
(5, 5, 4, 2, 3, 3, 1, 3, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbkriteria`
--

CREATE TABLE `tbkriteria` (
  `idkriteria` int(11) NOT NULL,
  `namakriteria` varchar(50) NOT NULL,
  `jeniskriteria` varchar(7) NOT NULL,
  `bobot` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbkriteria`
--

INSERT INTO `tbkriteria` (`idkriteria`, `namakriteria`, `jeniskriteria`, `bobot`) VALUES
(1, 'Penghasilan Orang Tua', 'Benefit', 25),
(2, 'Tanggungan Orang Tua', 'Benefit', 15),
(3, 'Pekerjaan Orang Tua', 'Cost', 20),
(4, 'Nilai Raport', 'Cost', 20),
(5, 'Status Orang Tua', 'Benefit', 10),
(6, 'Bantuan Pemerintah', 'Benefit', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbsubkriteria`
--

CREATE TABLE `tbsubkriteria` (
  `idkriteria` int(11) NOT NULL,
  `idsubkriteria` int(11) NOT NULL,
  `namasubkriteria` varchar(50) NOT NULL,
  `keterangansubkriteria` varchar(50) NOT NULL,
  `bobotsubkriteria` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbsubkriteria`
--

INSERT INTO `tbsubkriteria` (`idkriteria`, `idsubkriteria`, `namasubkriteria`, `keterangansubkriteria`, `bobotsubkriteria`) VALUES
(1, 1, '< 700000', 'Sangat Rendah', 5),
(1, 2, '700001 - 1000000', 'Rendah', 4),
(1, 3, '1000001 - 1200000', 'Sedang', 3),
(1, 4, '1200001 - 1500000', 'Cukup Tinggi', 2),
(1, 5, '> 1500001', 'Tinggi', 1),
(2, 6, '1 - 2', 'Sedikit', 1),
(2, 7, '3 - 4', 'Cukup Banyak', 2),
(2, 8, '5 - 6', 'Banyak', 3),
(2, 9, '> 6', 'Sangat Banyak', 4),
(3, 10, 'Pegawai Negeri Sipil (PNS)', 'Tingkat Kesejahteraan Tinggi', 1),
(3, 11, 'Karyawan / Wiraswasta', 'Tingkat Kesejahteraan Menengah', 2),
(3, 12, 'Buruh / Petani', 'Tingkat Kesejahteraan Rendah', 3),
(3, 13, 'Tidak Bekerja', 'Tidak Bekerja', 4),
(4, 14, '< 51', 'Sangat Buruk', 5),
(4, 15, '51 - 70', 'Buruk', 4),
(4, 16, '71 - 85', 'Cukup', 3),
(4, 17, '86 - 94', 'Baik', 2),
(4, 18, '> 94', 'Sangat Baik', 1),
(5, 19, 'Lengkap', 'Lengkap', 1),
(5, 20, 'Piatu', 'Piatu', 2),
(5, 21, 'Yatim', 'Yatim', 3),
(5, 22, 'Yatim Piatu', 'Yatim Piatu', 4),
(6, 23, 'Tidak Ada', 'Sangat Baik', 4),
(6, 24, 'SKTM', 'Baik', 3),
(6, 25, 'PKH', 'Cukup', 2),
(6, 26, 'KPS', 'Tidak Baik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `iduser` int(11) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `password` varchar(46) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`iduser`, `nim`, `password`) VALUES
(1, '20.50.090', '8d3fa11102ee509ebf012560ce3dd396');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbalternatif`
--
ALTER TABLE `tbalternatif`
  ADD PRIMARY KEY (`idalternatif`);

--
-- Indexes for table `tbhitung`
--
ALTER TABLE `tbhitung`
  ADD PRIMARY KEY (`idhitung`);

--
-- Indexes for table `tbkriteria`
--
ALTER TABLE `tbkriteria`
  ADD PRIMARY KEY (`idkriteria`);

--
-- Indexes for table `tbsubkriteria`
--
ALTER TABLE `tbsubkriteria`
  ADD PRIMARY KEY (`idsubkriteria`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbalternatif`
--
ALTER TABLE `tbalternatif`
  MODIFY `idalternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbhitung`
--
ALTER TABLE `tbhitung`
  MODIFY `idhitung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbkriteria`
--
ALTER TABLE `tbkriteria`
  MODIFY `idkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbsubkriteria`
--
ALTER TABLE `tbsubkriteria`
  MODIFY `idsubkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
