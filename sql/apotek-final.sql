-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2023 at 01:29 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `akses_id` tinyint UNSIGNED NOT NULL,
  `jenis` varchar(20) NOT NULL
;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`akses_id`, `jenis`) VALUES
(1, 'Viewer'),
(2, 'Manager'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Stand-in structure for view `cur_month_masuk`
-- (See below for the actual view)
--
CREATE TABLE `cur_month_masuk` (
`idobat` int
,`merek_dagang` varchar(150)
,`kuantitas` int
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Table structure for table `faktur`
--

CREATE TABLE `faktur` (
  `id_faktur` int NOT NULL,
  `tanggal` date NOT NULL,
  `idsup` int NOT NULL,
  `pesanan` text NOT NULL,
  `total_pembayaran` int NOT NULL,
  `jatuh_tempo` date NOT NULL
);

--
-- Dumping data for table `faktur`
--

INSERT INTO `faktur` (`id_faktur`, `tanggal`, `idsup`, `pesanan`, `total_pembayaran`, `jatuh_tempo`) VALUES
(7, '2023-01-04', 7, 'Ibuprofen x5, Naproxen x10,\r\nLorem Ipsum Dolor', 120000, '2023-02-02');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `id_transaksi` bigint NOT NULL,
  `id_obat` int NOT NULL,
  `jumlah` int NOT NULL,
  `nominal` bigint NOT NULL
);

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`id_transaksi`, `id_obat`, `jumlah`, `nominal`) VALUES
(1, 12, 15, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `akses_id` tinyint UNSIGNED NOT NULL
);

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`email`, `password`, `akses_id`) VALUES
('admin', 'admin', 3),
('nicholsyoung25@gmail.com', '7@6P4y25', 3);

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int NOT NULL,
  `idobat` int NOT NULL,
  `kuantitas` int NOT NULL,
  `id_supplier` int NOT NULL,
  `tanggal` date NOT NULL DEFAULT (curdate()),
  `besarharga` bigint NOT NULL
);

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idobat`, `kuantitas`, `id_supplier`, `tanggal`, `besarharga`) VALUES
(1, 14, 15, 8, '2023-01-04', 200000),
(2, 16, 11, 8, '2022-11-11', 7500),
(3, 12, 15, 7, '2022-11-17', 300000),
(4, 12, 2, 7, '2023-01-10', 120000),
(5, 17, 4, 7, '2022-12-21', 100000),
(6, 16, 30, 7, '2023-01-10', 600000),
(7, 14, 5, 8, '2023-01-10', 50000),
(8, 14, 5, 7, '2023-01-10', 10000),
(9, 17, 1, 8, '2023-01-10', 10000),
(10, 12, 15, 7, '2023-01-11', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idobat` int NOT NULL,
  `merek_dagang` varchar(150) NOT NULL,
  `harga` bigint NOT NULL,
  `satuan` enum('item','tablet','kapsul','tetesan','suppositori','hirup') NOT NULL,
  `exp_date` date NOT NULL,
  `stock` int NOT NULL,
  `supplier` int NOT NULL
);

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idobat`, `merek_dagang`, `harga`, `satuan`, `exp_date`, `stock`, `supplier`) VALUES
(12, 'Panadol', 20000, 'tetesan', '2022-12-29', 39, 7),
(13, 'Paracetamol', 5000, 'tablet', '2022-12-22', 17, 7),
(14, 'Ibuprofen', 8000, 'tablet', '2031-12-19', 42, 7),
(16, 'Aspirin', 7500, 'suppositori', '2030-11-18', 41, 8),
(17, 'Zestril', 25000, 'item', '2023-01-26', 17, 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sum_of_curmonth_masuk`
-- (See below for the actual view)
--
CREATE TABLE `sum_of_curmonth_masuk` (
`idobat` int
,`merek_dagang` varchar(150)
,`SUM(kuantitas)` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idsup` int NOT NULL,
  `nama_supplier` varchar(100)  NOT NULL,
  `alamat` varchar(100)  DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL
);

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idsup`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(7, 'Pandawan', 'Jln. Boulevard Raya', '08123456789'),
(8, 'Surya', 'Jln. Penang Paris no.213', '01920891021');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` bigint NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah` int NOT NULL,
  `nominal` bigint NOT NULL
);

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `jumlah`, `nominal`) VALUES
(1, '2023-01-10 17:14:23', 15, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_berpreskripsi`
--

CREATE TABLE `transaksi_berpreskripsi` (
  `id_transaksi` bigint NOT NULL,
  `nama_pelanggan` text NOT NULL,
  `nama_dokter` text NOT NULL
);

--
-- Dumping data for table `transaksi_berpreskripsi`
--

INSERT INTO `transaksi_berpreskripsi` (`id_transaksi`, `nama_pelanggan`, `nama_dokter`) VALUES
(1, '', '');

-- --------------------------------------------------------

--
-- Structure for view `cur_month_masuk`
--
DROP TABLE IF EXISTS `cur_month_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cur_month_masuk`  AS SELECT `m`.`idobat` AS `idobat`, `s`.`merek_dagang` AS `merek_dagang`, `m`.`kuantitas` AS `kuantitas`, `m`.`tanggal` AS `tanggal` FROM (`masuk` `m` left join `stock` `s` on((`m`.`idobat` = `s`.`idobat`))) WHERE (month(`m`.`tanggal`) = month(curdate()))  ;

-- --------------------------------------------------------

--
-- Structure for view `sum_of_curmonth_masuk`
--
DROP TABLE IF EXISTS `sum_of_curmonth_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sum_of_curmonth_masuk`  AS SELECT `cur_month_masuk`.`idobat` AS `idobat`, `cur_month_masuk`.`merek_dagang` AS `merek_dagang`, sum(`cur_month_masuk`.`kuantitas`) AS `SUM(kuantitas)` FROM `cur_month_masuk` GROUP BY `cur_month_masuk`.`idobat` ORDER BY sum(`cur_month_masuk`.`kuantitas`) AS `DESCdesc` ASC  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`akses_id`);

--
-- Indexes for table `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`id_faktur`),
  ADD KEY `idsup` (`idsup`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD KEY `id_obat` (`id_obat`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`email`),
  ADD KEY `akses_id` (`akses_id`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `idobat` (`idobat`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idobat`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsup`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_berpreskripsi`
--
ALTER TABLE `transaksi_berpreskripsi`
  ADD KEY `transaksi_berpreskripsi_ibfk_1` (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faktur`
--
ALTER TABLE `faktur`
  MODIFY `id_faktur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idobat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsup` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faktur`
--
ALTER TABLE `faktur`
  ADD CONSTRAINT `faktur_ibfk_1` FOREIGN KEY (`idsup`) REFERENCES `supplier` (`idsup`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `keluar`
--
ALTER TABLE `keluar`
  ADD CONSTRAINT `keluar_ibfk_2` FOREIGN KEY (`id_obat`) REFERENCES `stock` (`idobat`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `keluar_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`akses_id`) REFERENCES `akses` (`akses_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `masuk`
--
ALTER TABLE `masuk`
  ADD CONSTRAINT `masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`idsup`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `masuk_ibfk_2` FOREIGN KEY (`idobat`) REFERENCES `stock` (`idobat`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`supplier`) REFERENCES `supplier` (`idsup`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `transaksi_berpreskripsi`
--
ALTER TABLE `transaksi_berpreskripsi`
  ADD CONSTRAINT `transaksi_berpreskripsi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
