-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jun 2023 pada 14.36
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barbershop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan_tambahan`
--

CREATE TABLE `layanan_tambahan` (
  `id_layanan` varchar(10) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `harga_layanan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `layanan_tambahan`
--

INSERT INTO `layanan_tambahan` (`id_layanan`, `nama_layanan`, `harga_layanan`) VALUES
('EXT0', '-', 0),
('EXT1', 'Keramas & Pijat', 10000),
('EXT2', 'Cukur Rambut Lainnya', 5000),
('EXT3', 'Pijat', 5000),
('EXT4', 'Hair Coloring', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_transaksi` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `kategori` enum('DEWASA','ANAK') NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `waktu_pelayanan` varchar(50) NOT NULL,
  `id_potongan` varchar(10) NOT NULL,
  `id_layanan` varchar(10) NOT NULL,
  `total_harga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id_transaksi`, `nama`, `no_hp`, `kategori`, `tanggal`, `waktu_pelayanan`, `id_potongan`, `id_layanan`, `total_harga`) VALUES
(15, 'qwerty', '12345', 'DEWASA', '11 Januari 2003', '15.00-16.00', 'PTG1', 'EXT2', 30000),
(16, 'Fadli Darusalam', '0895329127575', 'DEWASA', '10 Januari 2023', '19.00-20.00', 'PTG1', 'EXT1', 35000),
(17, 'Adi Setiawan', '087264771829', 'ANAK', '14 Januari 2023', '16.00-17.00', 'PTG1', 'EXT0', 15000),
(18, 'Rizals', '0894726318497', 'DEWASA', '14 Januari 2023', '15.00-16.00', 'PTG2', 'EXT4', 65000),
(19, 'Bima', '082746188192', 'DEWASA', '11 Januari 2023', '13.00-14.00', 'PTG4', 'EXT2', 30000),
(23, 'Fadi Darusalam', '0888888888', 'DEWASA', '11 Januari 2023', '16.00-17.00', 'PTG2', 'EXT1', 35000),
(24, 'Beni', '08643543', 'DEWASA', '18 juni 2023', '17.00-18.00', 'PTG3', 'EXT0', 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan_rambut`
--

CREATE TABLE `potongan_rambut` (
  `id_potongan` varchar(10) NOT NULL,
  `nama_potongan` varchar(50) NOT NULL,
  `gbr_potongan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `potongan_rambut`
--

INSERT INTO `potongan_rambut` (`id_potongan`, `nama_potongan`, `gbr_potongan`) VALUES
('PTG1', 'Mullet', '63b53b00b6a57.jpeg'),
('PTG2', 'Comma Hair', '63bd949dee8e9.jpg'),
('PTG3', 'Two Block', '63bd96365beb8.jpg'),
('PTG4', 'Cepmek', '63bd968cb07ed.jpg'),
('PTG5', 'Undercut', '63bd96f548f60.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('ADMIN','USER') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `level`) VALUES
(1, 'admin1@gmail.com', 'usernameadmin1', '$2y$10$JcNaoRq6sf1k6bQ98sRgPOMM..cipQ1TzM321YIIcUlDz5WmpuoW.', 'ADMIN'),
(2, 'user1@gmail.com', 'usernameuser1', '$2y$10$goDeR8L7ilWhSqiR80McLuI.wy45plO9/HkHPcugS8bE5fjTb8RFy', 'USER'),
(3, 'user2@gmail.com', 'user2', '$2y$10$RT.IwR.rwO3ODxuPQFJ3humOtZJsfiGAE6goaECOepmgVKM82e/Oq', 'USER'),
(4, 'user3@gmail.com', 'user3', '$2y$10$H.RV8t8GtUjELQSsD1l2I.I1AdqCpWZKXOdW/nj8NuLHOWUQIAHfC', 'USER'),
(5, 'user4@gmail.com', 'user4', '$2y$10$wIjPC6zIWvRY0g4q5N5AduVnxapv0hArssbIk6DmfVP4NX6ugMKgq', 'USER'),
(6, 'user5@gmail.com', 'user5', '$2y$10$MVjIRbAe2zpmYZB31MWKvOy2Uvx8H8W8Ji2oakMLxyRb7TYzCY3T6', 'USER'),
(7, '123@gmail.com', '123krisna', '$2y$10$uLfjRi7/LmIMK5h0zeKh/.4cguFWsvwZK/cCWRXVbcALmOLsNVjEy', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `layanan_tambahan`
--
ALTER TABLE `layanan_tambahan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_transaksi`) USING BTREE,
  ADD KEY `jenis_potongan` (`id_potongan`),
  ADD KEY `tambahan` (`id_layanan`);

--
-- Indeks untuk tabel `potongan_rambut`
--
ALTER TABLE `potongan_rambut`
  ADD PRIMARY KEY (`id_potongan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`id_potongan`) REFERENCES `potongan_rambut` (`id_potongan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `layanan_tambahan` (`id_layanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
