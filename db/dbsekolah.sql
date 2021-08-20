-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Agu 2021 pada 16.40
-- Versi server: 5.7.33
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datasd`
--

CREATE TABLE `datasd` (
  `kdSekolah` int(11) NOT NULL,
  `sekolah` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `datasd`
--

INSERT INTO `datasd` (`kdSekolah`, `sekolah`, `alamat`) VALUES
(23, 'SD INPRES 10/73 CEPPAGA', 'LIBURENG'),
(24, 'SD 181 CEPPAGA', 'LIBURENG'),
(25, 'SD 12/79 MALLINRUNG', 'MALLINRUNG'),
(26, 'SD INP 10/73 LEPPANGENG', 'LAPRI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datasma`
--

CREATE TABLE `datasma` (
  `kdSekolah` int(11) NOT NULL,
  `sekolah` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `datasma`
--

INSERT INTO `datasma` (`kdSekolah`, `sekolah`, `alamat`) VALUES
(2, 'SMA NEGERI 5 BONE', 'Jl. Poros Makassar-Bone'),
(3, 'SMA NEGERI 1 TOLI-TOLI', 'Jln. Panjaitan Toli-Toli'),
(4, 'SMA NEGERI 11 BONE', 'Jl. Poros Makassar-Sinjai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datasmp`
--

CREATE TABLE `datasmp` (
  `kdSekolah` int(11) NOT NULL,
  `sekolah` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `datasmp`
--

INSERT INTO `datasmp` (`kdSekolah`, `sekolah`, `alamat`) VALUES
(47, 'SMP NEGERI 1 LIBURENG', 'LIBURENG'),
(48, 'Smp Lappariaja', 'asdsaddsad'),
(49, 'SMP NEGERI 4 BONE', 'BONE'),
(50, 'SMA  BONE', 'BONE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kdKriteria` int(11) NOT NULL,
  `kriteria` varchar(10) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `sifat` char(1) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kdKriteria`, `kriteria`, `kode`, `sifat`, `bobot`) VALUES
(3, 'C1', 'Aspek Kebijakan Sekolah yang Berwawasan Lingkungan', 'B', 0.2),
(6, 'C2', 'Aspek Kegiatan Sekolah Berbasis Partisipatif', 'B', 0.15),
(7, 'C3', 'Aspek Kegiatan Sekolah Berbasis Partisipatif', 'B', 0.25),
(8, 'C4', 'Aspek Pengelolaan Sarana dan Prasarana Pendukung Sekolah yang Ramah Lingkungan', 'B', 0.4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `kdSekolah` int(11) NOT NULL,
  `kdKriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`kdSekolah`, `kdKriteria`, `nilai`) VALUES
(23, 3, 1),
(23, 6, 0.75),
(23, 7, 0.25),
(23, 8, 0.75),
(24, 3, 1),
(24, 6, 1),
(24, 7, 1),
(24, 8, 1),
(25, 3, 0.75),
(25, 6, 0.25),
(25, 7, 0.75),
(25, 8, 0.25),
(26, 3, 0.75),
(26, 6, 0.75),
(26, 7, 0.75),
(26, 8, 0.75);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilaisma`
--

CREATE TABLE `nilaisma` (
  `kdSekolah` int(11) NOT NULL,
  `kdKriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilaisma`
--

INSERT INTO `nilaisma` (`kdSekolah`, `kdKriteria`, `nilai`) VALUES
(2, 3, 0.75),
(2, 6, 1),
(2, 7, 0.25),
(2, 8, 0.25),
(3, 3, 1),
(3, 6, 0.75),
(3, 7, 0.25),
(3, 8, 0),
(4, 3, 0.75),
(4, 6, 0.25),
(4, 7, 1),
(4, 8, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilaismp`
--

CREATE TABLE `nilaismp` (
  `kdSekolah` int(11) NOT NULL,
  `kdKriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilaismp`
--

INSERT INTO `nilaismp` (`kdSekolah`, `kdKriteria`, `nilai`) VALUES
(47, 3, 1),
(47, 6, 0),
(47, 7, 0),
(47, 8, 0.75),
(48, 3, 1),
(48, 6, 0.25),
(48, 7, 0.25),
(48, 8, 0),
(49, 3, 0.75),
(49, 6, 0.25),
(49, 7, 0.25),
(49, 8, 0),
(50, 3, 0.25),
(50, 6, 0.25),
(50, 7, 0.25),
(50, 8, 0.25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `kdSubKriteria` int(11) NOT NULL,
  `subKriteria` varchar(50) NOT NULL,
  `value` float NOT NULL,
  `kdKriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`kdSubKriteria`, `subKriteria`, `value`, `kdKriteria`) VALUES
(1, 'Ada', 1, 3),
(2, 'Sedang', 0.75, 3),
(3, 'Kurang', 0.25, 3),
(4, 'Tidak Ada', 0, 3),
(16, 'Ada', 1, 6),
(17, 'Sedang', 0.75, 6),
(18, 'Kurang', 0.25, 6),
(19, 'Tidak Ada', 0, 6),
(21, 'Banyak', 1, 7),
(22, 'Sedang', 0.75, 7),
(23, 'Kurang', 0.25, 7),
(24, 'Tidak Ada', 0, 7),
(26, 'Memadai', 1, 8),
(27, 'Sedang', 0.75, 8),
(28, 'Kurang Memadai', 0.25, 8),
(29, 'Tidak Ada', 0, 8);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datasd`
--
ALTER TABLE `datasd`
  ADD PRIMARY KEY (`kdSekolah`);

--
-- Indeks untuk tabel `datasma`
--
ALTER TABLE `datasma`
  ADD PRIMARY KEY (`kdSekolah`);

--
-- Indeks untuk tabel `datasmp`
--
ALTER TABLE `datasmp`
  ADD PRIMARY KEY (`kdSekolah`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kdKriteria`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD UNIQUE KEY `indexNilai` (`kdSekolah`,`kdKriteria`) USING BTREE,
  ADD KEY `kdKriteria` (`kdKriteria`);

--
-- Indeks untuk tabel `nilaisma`
--
ALTER TABLE `nilaisma`
  ADD UNIQUE KEY `indexNilai` (`kdSekolah`,`kdKriteria`) USING BTREE,
  ADD KEY `kdKriteria` (`kdKriteria`);

--
-- Indeks untuk tabel `nilaismp`
--
ALTER TABLE `nilaismp`
  ADD UNIQUE KEY `indexNilai` (`kdSekolah`,`kdKriteria`) USING BTREE,
  ADD KEY `kdKriteria` (`kdKriteria`);

--
-- Indeks untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`kdSubKriteria`),
  ADD KEY `kdKriteria` (`kdKriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `datasd`
--
ALTER TABLE `datasd`
  MODIFY `kdSekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `datasma`
--
ALTER TABLE `datasma`
  MODIFY `kdSekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `datasmp`
--
ALTER TABLE `datasmp`
  MODIFY `kdSekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `kdKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `kdSubKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`kdSekolah`) REFERENCES `datasd` (`kdSekolah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kdKriteria`) REFERENCES `kriteria` (`kdKriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilaisma`
--
ALTER TABLE `nilaisma`
  ADD CONSTRAINT `nilaisma_ibfk_1` FOREIGN KEY (`kdKriteria`) REFERENCES `kriteria` (`kdKriteria`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilaisma_ibfk_2` FOREIGN KEY (`kdSekolah`) REFERENCES `datasma` (`kdSekolah`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilaismp`
--
ALTER TABLE `nilaismp`
  ADD CONSTRAINT `nilaismp_ibfk_1` FOREIGN KEY (`kdSekolah`) REFERENCES `datasmp` (`kdSekolah`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilaismp_ibfk_2` FOREIGN KEY (`kdKriteria`) REFERENCES `kriteria` (`kdKriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`kdKriteria`) REFERENCES `kriteria` (`kdKriteria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;