-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 03:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`, `id_instansi`) VALUES
(2, 'Fakultas Matematika dan Ilmu Pengetahuan Alam', 1);

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id_instantsi`, `nama_instansi`) VALUES
(1, 'Universitas Halu OLeo');

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'S1');

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'admin', 'admin');

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id_penelitian`, `judul`, `nama_penulis`, `tahun`, `id_fakultas`, `id_kategori`, `id_rak`, `id_registrasi`) VALUES
(1, 'Analisis Hasil Pembahasan Bersayart Mengenai Perpustakaan Metode BIOS', 'Gilang Aziz Libratul Ahmad', 2024, 2, 2, 'A1', 3);

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`nip`, `nama_petugas`) VALUES
(2, 'admin');

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id_rak`, `keterangan`) VALUES
('A1', NULL);

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id_registrasi`, `tgl_masuk`, `id_petugas`) VALUES
(3, '2025-01-16', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
