-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2022 pada 15.18
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `javatrain`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kereta`
--

CREATE TABLE `kereta` (
  `id` int(11) NOT NULL,
  `kode_kereta` varchar(10) NOT NULL,
  `nama_kereta` varchar(20) NOT NULL,
  `img_kereta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kereta`
--

INSERT INTO `kereta` (`id`, `kode_kereta`, `nama_kereta`, `img_kereta`) VALUES
(3, 'TES-12345', 'Kereta Tes', 'shinkansen.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_pesan`
--

CREATE TABLE `log_pesan` (
  `id` int(11) NOT NULL,
  `kode_bayar` varchar(13) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `penumpang` int(11) NOT NULL,
  `status` enum('Lunas','Pending','Expired') NOT NULL DEFAULT 'Pending',
  `nama` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `harga` int(11) NOT NULL,
  `jam_booking` time NOT NULL DEFAULT curtime(),
  `expired` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_pesan`
--

INSERT INTO `log_pesan` (`id`, `kode_bayar`, `id_tiket`, `penumpang`, `status`, `nama`, `nik`, `harga`, `jam_booking`, `expired`) VALUES
(9, '62c2cba15d725', 3, 1, 'Lunas', 'Rizqulloh Rayhan Ferdiansyah', '123456789', 150000, '18:14:42', '18:24:42'),
(14, '62c2d16c63850', 3, 1, 'Expired', 'Rizqulloh Rayhan Ferdiansyah', '123456789', 150000, '18:39:26', '18:49:26'),
(15, '62c2d49eb0e31', 3, 1, 'Expired', 'Rizqulloh Rayhan Ferdiansyah', '123456789', 150000, '18:53:04', '19:03:04'),
(16, '62c2d7983179a', 3, 1, 'Expired', 'Rizqulloh Rayhan Ferdiansyah', '123456789', 150000, '19:05:46', '19:15:46'),
(17, '62c2e2845c2e0', 3, 1, 'Lunas', 'Rizqulloh Rayhan Ferdiansyah', '123456789', 150000, '19:52:24', '20:02:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stasiun`
--

CREATE TABLE `stasiun` (
  `id` int(11) NOT NULL,
  `nama_stasiun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stasiun`
--

INSERT INTO `stasiun` (`id`, `nama_stasiun`) VALUES
(1, 'Jakarta Kota (JAKK)'),
(2, 'Jayakarta (JAKK)'),
(3, 'Mangga Besar (MGB)'),
(4, 'Sawah Besar (SW)'),
(5, 'Juanda (JUA)'),
(6, 'Manggarai (MRI, atas)'),
(7, 'Tebet (TEB)'),
(8, 'Duren Kalibata (DRN)'),
(9, 'Univ. Indonesia (UI)'),
(10, 'Pasar Senen (PSE, arah KPB)'),
(11, 'Tanah Abang (THB)'),
(12, 'Jatinegara (JNG)'),
(13, 'Purwosari (PWS)'),
(14, 'Solo Balapan (SLO)'),
(15, 'Klaten (KT)'),
(16, 'Brambanan (BBN)'),
(17, 'Lempuyangan (LPN)'),
(18, 'Yogyakarta (YK)'),
(19, 'Wonokromo (WO)'),
(20, 'Wonokromo Kota (WOK)'),
(21, 'Surabaya Gubeng (SGU)'),
(22, 'Surabaya Kota (SB)'),
(23, 'Surabaya Pasar Turi (SBI)'),
(24, 'Surabaya Sidotopo (SDT)'),
(25, 'Kalimas (KLM)'),
(26, 'Blimbing (BMG)'),
(27, 'Malang (ML)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id` int(11) NOT NULL,
  `kode_kereta` varchar(10) NOT NULL,
  `dari` varchar(100) NOT NULL,
  `ke` varchar(100) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `jam` varchar(10) NOT NULL,
  `class` enum('Eksekutif','Bisnis','Ekonomi') NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tiket`
--

INSERT INTO `tiket` (`id`, `kode_kereta`, `dari`, `ke`, `tanggal`, `jam`, `class`, `harga`) VALUES
(3, 'TES-12345', 'Solo Balapan (SLO)', 'Univ. Indonesia (UI)', '2022-07-13', '15:31', 'Ekonomi', '150000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_kereta` (`kode_kereta`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_pesan`
--
ALTER TABLE `log_pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tiket` (`id_tiket`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stasiun`
--
ALTER TABLE `stasiun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kereta` (`kode_kereta`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kereta`
--
ALTER TABLE `kereta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `log_pesan`
--
ALTER TABLE `log_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stasiun`
--
ALTER TABLE `stasiun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `log_pesan`
--
ALTER TABLE `log_pesan`
  ADD CONSTRAINT `log_pesan_ibfk_1` FOREIGN KEY (`id_tiket`) REFERENCES `tiket` (`id`);

--
-- Ketidakleluasaan untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`kode_kereta`) REFERENCES `kereta` (`kode_kereta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
