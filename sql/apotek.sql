-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2022 pada 07.52
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

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
-- Struktur dari tabel `faktur`
--

CREATE TABLE `faktur` (
  `id_faktur` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `penjual` varchar(100) NOT NULL,
  `pesanan` text NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `jatuh_tempo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `faktur`
--

INSERT INTO `faktur` (`id_faktur`, `tanggal`, `penjual`, `pesanan`, `total_pembayaran`, `jatuh_tempo`) VALUES
(6, '2022-12-27', 'Konidin', 'Panadol', 20000000, '2022-12-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`email`, `password`) VALUES
('nicholsyoung25@gmail.com', '7@6P4y25'),
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idobat` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `supplier` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `besarharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idobat`, `nama`, `kuantitas`, `supplier`, `tanggal`, `besarharga`) VALUES
(1, 0, '', 500, '4', '2022-12-25 07:42:39', 0),
(2, 7, '', 500, '4', '2022-12-25 07:45:53', 5000000),
(3, 11, '', 15, '5', '2022-12-27 03:09:07', 150000),
(4, 12, '', 15, '7', '2022-12-29 06:51:01', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `idobat` int(11) NOT NULL,
  `merek_dagang` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` enum('item','tablet','kapsul','tetesan','suppositori','hirup') NOT NULL,
  `exp_date` date NOT NULL,
  `stock` int(11) NOT NULL,
  `supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`idobat`, `merek_dagang`, `harga`, `satuan`, `exp_date`, `stock`, `supplier`) VALUES
(12, 'panadol', 20000, 'tetesan', '2022-12-29', 15, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `idsup` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`idsup`, `nama_supplier`, `alamat`, `no_telp`) VALUES
(7, 'Pandawan', 'Jln. Boulevard Raya', '08123456789');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `nama_dokter` varchar(50) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `nama_obat` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`id_faktur`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idobat`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsup`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `faktur`
--
ALTER TABLE `faktur`
  MODIFY `id_faktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `idobat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_transaksi` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
