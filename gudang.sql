-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2024 pada 14.43
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `jenis` varchar(20) NOT NULL,
  `harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stock`, `jenis`, `harga`) VALUES
(38, 'teh gelas', 20, 'perbox', 100000),
(39, 'mie sedap goreng', 100, 'perbox', 106000),
(40, 'alamo', 90, 'perbox', 20000),
(42, 'Al Qodiri', 50, 'perbox', 14000),
(43, 'minyak sunco 2L', 100, 'perbox', 261000),
(44, 'tepung terigu segitiga 500 g', 450, 'perbox', 140000),
(45, 'kecap sedap 600ml', 100, 'perbox', 210000),
(46, 'minyak tropical 2L', 40, 'perbox', 221000),
(47, 'beras rajawali RRR 25 kg', 100, 'per karung', 350000),
(48, 'beras rajawali merah 25 kg', 100, 'per karung', 315000),
(49, 'beras rajawali emas 25kg', 500, 'per karung', 370000),
(50, 'rinso rose frest 750', 1300, 'perbox', 124000),
(51, 'so klin 700 ml', 100, 'perbox', 64000),
(52, 'aqua galon', 0, 'per buah', 43900),
(53, 'mie sedap soto', 40, 'perbox', 108000),
(56, 'pop mie rasa ayam', 100, 'perbox', 120000),
(60, 'ali', 1, 'manusia', 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_keluar` int(11) DEFAULT NULL,
  `tanggal_keluar` date DEFAULT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `id_barang`, `jumlah_keluar`, `tanggal_keluar`, `nama`) VALUES
(25, 38, 500, '2024-01-16', 'cristoper'),
(26, 42, 50, '2024-03-16', 'davin'),
(27, 49, 200, '2024-02-29', 'wafiq'),
(28, 39, 400, '2024-01-31', 'ilham'),
(29, 38, 200, '2024-01-23', 'cristoper'),
(30, 38, 400, '2024-02-20', 'cristoper'),
(31, 48, 200, '2024-02-29', 'ilham'),
(32, 39, 80, '2024-01-23', 'wafiq'),
(33, 42, 700, '2024-03-31', 'davin'),
(34, 46, 60, '2024-01-17', 'wafiq'),
(35, 44, 1500, '2024-03-12', 'davin'),
(36, 39, 16, '2024-05-30', 'cristoper'),
(37, 40, 900, '2024-02-21', 'ilham'),
(38, 45, 1400, '2024-04-16', 'cristoper'),
(39, 47, 300, '2024-02-20', 'davin'),
(40, 46, 600, '2024-02-22', 'wafiq'),
(41, 42, 1200, '2024-04-30', 'ilham'),
(42, 45, 300, '2024-05-30', 'davin'),
(43, 43, 1000, '2024-05-30', 'wafiq'),
(44, 51, 900, '2024-05-30', 'davin'),
(45, 52, 100, '2024-05-31', 'ilham'),
(46, 53, 60, '2024-05-31', 'wafiq'),
(49, 38, 100, '2024-06-08', 'ilham'),
(50, 39, 4, '2024-06-08', 'ilham'),
(51, 39, 100, '2024-06-08', 'wafiq'),
(52, 38, 10, '2024-06-08', 'wafiq'),
(53, 38, 500, '2024-06-10', 'ilham');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah_masuk` int(11) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `id_barang`, `jumlah_masuk`, `tanggal_masuk`, `nama`) VALUES
(23, 38, 1000, '2024-01-01', 'cristoper'),
(24, 40, 1000, '2024-01-01', 'ilham'),
(25, 42, 2000, '2024-03-12', 'davin'),
(26, 44, 2000, '2024-02-06', 'ilham'),
(27, 49, 200, '2024-02-13', 'wafiq'),
(28, 46, 100, '2024-01-07', 'ilham'),
(29, 45, 1800, '2024-03-13', 'ilham\r\n'),
(30, 48, 300, '2024-02-14', 'cristoper'),
(31, 46, 600, '2024-01-08', 'wafiq\r\n'),
(32, 39, 700, '2024-01-09', 'ilham'),
(33, 47, 400, '2024-01-10', 'ilham'),
(34, 38, 100, '2024-05-30', 'ilham'),
(35, 38, 200, '2024-04-04', 'ilham'),
(36, 49, 500, '2024-04-16', 'ilham'),
(37, 43, 1000, '2024-05-14', 'ilham'),
(38, 50, 1300, '2024-05-30', 'ilham'),
(39, 43, 100, '2024-05-30', 'davin'),
(40, 51, 1000, '2024-05-30', 'cristoper'),
(41, 52, 100, '2024-05-31', 'ilham'),
(42, 53, 100, '2024-05-31', 'davin'),
(45, 38, 10, '2024-06-08', 'wafiq'),
(46, 38, 10, '2024-06-08', 'wafiq'),
(47, 38, 100, '2024-06-08', 'wafiq'),
(48, 56, 100, '2024-06-08', 'ilham'),
(49, 38, 100, '2024-06-10', 'ilham'),
(50, 38, 1000, '2024-06-10', 'ilham'),
(53, 60, 1, '2024-06-10', 'lukman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(4) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama`) VALUES
(1, 'admin'),
(2, 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `password`, `username`, `role_id`) VALUES
(23, 'ilham', '111111', 'ilham', 1),
(26, 'cristoper', '123123', 'neko', 2),
(27, 'wafiq', '12345', 'wafiq', 1),
(31, 'davin', '123', 'davin', 2),
(34, 'lukman', '123', 'lukman', 2),
(35, 'ahmad', '123', 'ahmad', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
