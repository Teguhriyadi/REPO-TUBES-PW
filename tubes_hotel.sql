-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2021 pada 12.58
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes_hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `no_kamar` varchar(100) NOT NULL,
  `id_tipe` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `lantai` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`no_kamar`, `id_tipe`, `status`, `lantai`) VALUES
('1', 93, 'Tersedia', 1),
('100', 93, 'Booking', 20),
('12', 2, 'booking', 2),
('2', 93, 'Tersedia', 1),
('4', 93, 'Tersedia', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `kode_reservasi` varchar(100) NOT NULL,
  `email_tamu` varchar(30) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date DEFAULT NULL,
  `jumlah_kamar` int(2) NOT NULL,
  `jumlah_tamu` int(100) NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `id_tipe` int(11) NOT NULL,
  `no_kamar` int(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi_ruangan`
--

CREATE TABLE `reservasi_ruangan` (
  `id_reservasi_ruangan` int(11) NOT NULL,
  `kode_reservasi` varchar(100) NOT NULL,
  `no_kamar` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tamu`
--

CREATE TABLE `tamu` (
  `no_identitas` varchar(100) NOT NULL,
  `nama_tamu` varchar(100) NOT NULL,
  `email_tamu` varchar(100) NOT NULL,
  `telp_tamu` varchar(100) NOT NULL,
  `password_tamu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tamu`
--

INSERT INTO `tamu` (`no_identitas`, `nama_tamu`, `email_tamu`, `telp_tamu`, `password_tamu`) VALUES
('12345', 'Ahmad Fauzi', 'ahmad@gmail.com', '12345', '111\r\n'),
('123456789', 'ilham', 'ilham.teguh55@gmail.com', '12345', '$2y$10$Aamgpqpty9fs53W9vbp40uLL1iJg7cSoXeOquZDUpMpGPcNGSPPhW'),
('29092002', 'mohammad', 'ilham.teguh55@gmail.com', '12345', 'mohammad'),
('444444', 'alan', 'alan@gmail.com', '212', '$2y$10$LU8Nx5LkZMDrLO8.02gt8ufiBUbVCDtLa806K2g3c29Wpdev3GWCW'),
('6', '6', '6', '6', '$2y$10$jfI3MvXUVMaEuRmn/vsMg.r2aX0tqp2RRYCtQ.n02KYmCA1RLnXZ6'),
('7', '7', '7', '7', '7'),
('8192182', 'efefh', 'hefu3hf', '2901', 'fnef'),
('9', '9', '9', '9', '9'),
('tamu', 'tamu', 'tamu', 'tamu', '$2y$10$YWiHHyAEuZu5lXM0HXLA7.8/UVf2yLb2Vcyhm8USTMI/0yc8fZlx6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_kamar`
--

CREATE TABLE `tipe_kamar` (
  `id_tipe` int(11) NOT NULL,
  `tipe_kamar` varchar(100) NOT NULL,
  `deskripsi` text,
  `fasilitas` varchar(100) NOT NULL,
  `harga` double NOT NULL,
  `jumlah_bed` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_check_in` int(11) NOT NULL,
  `tgl_check_in` date DEFAULT NULL,
  `tgl_check_out` date DEFAULT NULL,
  `total_pembayaran` double NOT NULL,
  `uang_muka_kamar` double NOT NULL,
  `pelunasan_kamar` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `level` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `created_at`, `last_login`, `level`) VALUES
(44, 'hame', '$2y$10$aNhtw6Q50veIZK03FRIRoOsPeHsNiTosOM9vxlDsDdQUyCt70qwCC', '2021-06-09 05:32:05', '2021-06-12 02:22:44', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`no_kamar`);

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`kode_reservasi`);

--
-- Indeks untuk tabel `reservasi_ruangan`
--
ALTER TABLE `reservasi_ruangan`
  ADD PRIMARY KEY (`id_reservasi_ruangan`);

--
-- Indeks untuk tabel `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`no_identitas`);

--
-- Indeks untuk tabel `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_check_in`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `reservasi_ruangan`
--
ALTER TABLE `reservasi_ruangan`
  MODIFY `id_reservasi_ruangan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
