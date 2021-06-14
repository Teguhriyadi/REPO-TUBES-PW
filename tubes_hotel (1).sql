-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jun 2021 pada 18.38
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
('1', 2, 'Tersedia', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `kode_reservasi` int(100) NOT NULL,
  `email_tamu` varchar(30) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date DEFAULT NULL,
  `jumlah_tamu` int(100) NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `id_tipe` int(11) NOT NULL,
  `no_kamar` int(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`kode_reservasi`, `email_tamu`, `check_in`, `check_out`, `jumlah_tamu`, `pesan`, `id_tipe`, `no_kamar`, `status`, `total`) VALUES
(1, 'sahrul@gmail.com', '2021-06-14', '2021-06-15', 1, 'Bagus', 1, 1, 'Pending', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi_ruangan`
--

CREATE TABLE `reservasi_ruangan` (
  `id_reservasi_ruangan` int(11) NOT NULL,
  `kode_reservasi` varchar(100) NOT NULL,
  `no_kamar` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reservasi_ruangan`
--

INSERT INTO `reservasi_ruangan` (`id_reservasi_ruangan`, `kode_reservasi`, `no_kamar`) VALUES
(1, '1', 1);

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
('06012001', 'Farhan M Adi Yanuar', 'farhan@gmail.com', '12345', '$2y$10$VfOQDd8.q/u/vtLEnK/LQuvZ4o0R584IkiMIk7H6AqZYpbPh/IWDa'),
('12345', 'tamu', 'tamu@gmail.com', '12345', '$2y$10$3QbOH2.NkDGdHp8Sek9KhOqZs7ODzVPwbNFr7dIHCDql3JGFF1GIO'),
('1234567890', 'Feby Maulana H', 'feby@gmail.com', '12345', '$2y$10$6WRq60Q108KjCQ9sc5ACTOuGQxzAv2ZfzQp7WbIeXKVx8Di.i4dPe'),
('29092002', 'ahmadfauzi', 'ahmadfauzi@gmail.com', '12345', '$2y$10$EPFpmKvlmCETodG7hqWh7eZXuH3wS2yeH/TmZZahJPJhlz9FU2FDi'),
('sahrul', 'sahrul', 'sahrul@gmail.com', '1234', '$2y$10$PS.FzzeXBPsWN3qE3B5HjeTvcJoZ/JZPmGH8nA3sYuSlDgXOQz42.');

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

--
-- Dumping data untuk tabel `tipe_kamar`
--

INSERT INTO `tipe_kamar` (`id_tipe`, `tipe_kamar`, `deskripsi`, `fasilitas`, `harga`, `jumlah_bed`, `image`) VALUES
(1, 'ELITE Room', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Handuk, Bed Cover', 150000, 2, '60c59b7ef29db.jpg'),
(2, 'VIP Room', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Handuk, Bed Cover', 200000, 2, '60c59bd3c698a.jpg'),
(3, 'Standar Room', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Handuk', 5000, 2, '60c5b8a5d3d57.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `no_check_in` int(11) NOT NULL,
  `tgl_check_in` date DEFAULT NULL,
  `tgl_check_out` date DEFAULT NULL,
  `total_pembayaran` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime DEFAULT '0000-00-00 00:00:00',
  `level` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `password`, `created_at`, `last_login`, `level`) VALUES
(44, 'hame', '$2y$10$aNhtw6Q50veIZK03FRIRoOsPeHsNiTosOM9vxlDsDdQUyCt70qwCC', '2021-06-09 05:32:05', '2021-06-13 12:00:57', 1),
(47, '1', '$2y$10$nce08R3pR6OzdASLBKDlhuwz2LpaYwRofHIFaLkCB/CxvAeTQBX.u', '2021-06-13 04:43:08', '0000-00-00 00:00:00', 1);

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
-- AUTO_INCREMENT untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `kode_reservasi` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `reservasi_ruangan`
--
ALTER TABLE `reservasi_ruangan`
  MODIFY `id_reservasi_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tipe_kamar`
--
ALTER TABLE `tipe_kamar`
  MODIFY `id_tipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
