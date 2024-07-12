-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jun 2024 pada 13.44
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
-- Database: `projek1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `prosespengaduan`
--

CREATE TABLE `prosespengaduan` (
  `idlaporan` int(11) NOT NULL,
  `npm` varchar(20) NOT NULL,
  `idadmin` varchar(20) NOT NULL,
  `isiaduan` text NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  `statuspengaduan` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prosespengaduan`
--

INSERT INTO `prosespengaduan` (`idlaporan`, `npm`, `idadmin`, `isiaduan`, `tanggal`, `statuspengaduan`, `foto`) VALUES
(16, '222510161', '121', 'Asbes di lab 2 bocor ', '2024-06-19 ', 'Diproses', '6672d94e0f02c.jpg'),
(17, '222610151', '121', 'Salah satu bangku di lab 2 rusak', '2024-06-19 ', 'Berhasil terkirim', '6672dde960174.jpg'),
(18, '222510161', '121', 'shhh', '2024-06-19 ', 'Berhasil terkirim', '6672f159311d8.jpg'),
(24, '222610151', '121', 'ac rusak', '2024-06-20 ', 'Berhasil terkirim', '66742581a313e.jpeg'),
(25, '222610151', '121', 'bangku rusak', '2024-06-20 ', 'Berhasil terkirim', '667425a1bfb80.jpg'),
(31, '2223', '121', 'tai', '2024-06-21 ', 'Berhasil terkirim', '6675097652bb9.jpg'),
(37, '222510161', '121', 'Ac rusak Di lab 3', '2024-06-26 ', 'Berhasil terkirim', '667bd07ae07c8.jpg'),
(39, '222510161', '121', 'ac rusak', '2024-06-27 ', 'Berhasil terkirim', '667ce70e3321e.jpg'),
(40, '222510161', '121', 'ac rusak', '2024-06-27 ', 'Berhasil terkirim', '667ce74b060af.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `npm` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa') NOT NULL,
  `nama` varchar(100) NOT NULL,
  `program_studi` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`npm`, `username`, `password`, `role`, `nama`, `program_studi`, `fakultas`) VALUES
('1', 'admin', 'admin123', 'admin', '', '', ''),
('2223', 'perdisambo', '12', 'mahasiswa', 'perdi', 'sambo', 'sambo1'),
('222510161', 'aman', 'man123', 'mahasiswa', 'Aman Hutabarat', 'Teknik Informatika', 'Fakultas Ilmu Komputer'),
('222610151', 'kurlep', '123', 'mahasiswa', 'Kurlep nadapdap', 'Sistem Informasi', 'Fakultas Ilmu Komputer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `prosespengaduan`
--
ALTER TABLE `prosespengaduan`
  ADD PRIMARY KEY (`idlaporan`),
  ADD KEY `npm` (`npm`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`npm`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `prosespengaduan`
--
ALTER TABLE `prosespengaduan`
  MODIFY `idlaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `prosespengaduan`
--
ALTER TABLE `prosespengaduan`
  ADD CONSTRAINT `prosespengaduan_ibfk_1` FOREIGN KEY (`npm`) REFERENCES `users` (`npm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
