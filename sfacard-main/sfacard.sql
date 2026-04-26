-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Apr 2026 pada 18.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sfacard`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` int(10) NOT NULL,
  `kategori` enum('kerusakan','kinerja_guru','kebijakan_sekolah') NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `id_pengaduan` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `isi_feedback` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `id_pengaduan`, `id_user`, `isi_feedback`, `tanggal`) VALUES
(1, 1234, 0, '', '2026-04-11 00:00:00'),
(2, 1234, 0, '', '2026-04-11 00:00:00'),
(3, 1234, 0, 'silahkan sudah dibenarkan', '2026-04-11 00:00:00'),
(4, 1234, 0, 'silahkan sudah dibenarkan', '2026-04-11 00:00:00'),
(5, 1234, 0, 'silahkan sudah dibenarkan', '2026-04-11 00:00:00'),
(6, 1234, 0, 'fgdmjgfdm', '2026-04-11 00:00:00'),
(7, 1, 0, 'dsba', '2026-04-11 00:00:00'),
(8, 1, 0, 'sudah selesai terimakasih', '2026-04-11 00:00:00'),
(9, 1234, 0, '/ljliolo', '2026-04-11 00:00:00'),
(10, 1, 0, 'terimakasih atas aspirasinya', '2026-04-11 00:00:00'),
(11, 1, 0, 'terimakasih atas aspirasinya', '2026-04-11 00:00:00'),
(12, 1, 0, '', '2026-04-11 00:00:00'),
(13, 5, 0, 'sudah [isan', '2026-04-11 00:00:00'),
(14, 11, 0, 'swewrvv', '2026-04-11 00:00:00'),
(15, 2, 0, 'hgjl,', '2026-04-11 00:00:00'),
(16, 2, 0, 'hgjl,', '2026-04-11 00:00:00'),
(17, 9, 0, 'sudahh', '2026-04-11 00:00:00'),
(18, 6, 0, 'sudahhh', '2026-04-11 00:00:00'),
(19, 7, 0, 'syudah', '2026-04-11 00:00:00'),
(20, 6, 0, 'sudahhh', '2026-04-11 00:00:00'),
(21, 6, 0, 'sudahhh', '2026-04-11 00:00:00'),
(22, 5, 0, 'xngmjn', '2026-04-11 00:00:00'),
(23, 12, 0, 'gcmmmmmm,mh', '2026-04-11 00:00:00'),
(24, 13, 0, 'fxjmcd', '2026-04-11 00:00:00'),
(25, 5, 0, '\r\n=oo', '2026-04-11 00:00:00'),
(26, 5, 0, '\r\n=oo', '2026-04-11 00:00:00'),
(27, 5, 0, 'sudahhh', '2026-04-15 00:00:00'),
(28, 14, 0, 'sad', '2026-04-15 00:00:00'),
(29, 5, 0, '', '2026-04-15 00:00:00'),
(30, 5, 0, 'terimakasih sudah dilaksanakan\r\n', '0000-00-00 00:00:00'),
(31, 5, 0, 'ttt', '0000-00-00 00:00:00'),
(32, 5, 0, 'dsbb', '0000-00-00 00:00:00'),
(33, 18, 0, 'sudahh seleai', '0000-00-00 00:00:00'),
(34, 5, 0, 'sudah yah', '0000-00-00 00:00:00'),
(35, 15, 0, 'sudahh yah', '0000-00-00 00:00:00'),
(36, 15, 0, 'jhg,', '0000-00-00 00:00:00'),
(37, 19, 0, 'vdv', '0000-00-00 00:00:00'),
(38, 24, 0, 'kjhl', '0000-00-00 00:00:00'),
(39, 27, 0, 'guik,', '0000-00-00 00:00:00'),
(40, 42, 0, 'y', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(10) NOT NULL,
  `id_aspirasi` int(10) DEFAULT NULL,
  `id_user` int(10) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `foto` varchar(250) DEFAULT NULL,
  `lokasi` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('menunggu','proses','selesai','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `id_aspirasi`, `id_user`, `judul`, `foto`, `lokasi`, `deskripsi`, `tanggal`, `status`) VALUES
(19, 0, 1239, 'pintu kelas', '1776410319_64731b8078b5d8adcbb0.png', 'kelas 12', 'udah banyak rinyuh', '2026-04-17', 'selesai'),
(24, NULL, 1240, 'mauu apaa yakk', '1776411009_f66fab567ab60f2863f9.jpg', 'sdfbhrfyhkm', 'ioghughuhi', '2026-04-17', 'selesai'),
(42, NULL, 1239, 'mauu apaa yakk', '1776438310_741f70159d4305cb7898.jpg', 'toilet bawah', 'knnhlhilgf', '2026-04-17', 'selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','guru','siswa','') NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`, `foto`) VALUES
(1234, 'ade ayu', 'ayuadmin', '$2y$10$FMQRdH0ecCbZZVWtN2n7/u1YZN/gr7X98Er4NG4sqDAWCXlZwmB6S', 'admin', '1775615420_de54a2a3e3e805279d6a.jpg'),
(1239, 'Farhan Mubarok', 'farhanm', '$2y$10$mnN2BtSu9iuzV7ycxeS35OOZMNR7slaABpLxqQO/LMc5bBF0YLc06', 'siswa', '1775616549_db49d79c99502d9b1ab6.jpg'),
(1240, 'Muhammad Ridwan', 'ridwan', '$2y$10$Db0xGfnmquJpYCIWzjoN9uQdUZsKMBkEWTST2B3gMU9VJN.UmBz8K', 'siswa', '1776307369_ed14688ffd41d793383d.jpg'),
(1241, 'adel', 'dell', '$2y$10$P5k8rKH4Tv/S8Q9YEpVQJOTPmKPZw5OvRc6LVg.AgQNhOxgD.BAe6', 'admin', '1776441437_9c0467b0392b9a809eec.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
