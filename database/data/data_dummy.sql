-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 08:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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

-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id_penelitian`, `judul`, `nama_penulis`, `tahun`, `id_fakultas`, `id_kategori`, `tgl_masuk`, `id_rak`, `petugas`, `id_instansi`) VALUES
(27, 'Studi Kasus Implementasi Machine Learning dalam Prediksi Cuaca', 'Budi Santoso', '2023', 1, 2, '2025-01-17', 'A2', 'Admin', 1),
(28, 'Pengaruh Media Sosial terhadap Perilaku Konsumtif Remaja', 'Siti Aminah', '2022', 2, 3, '2025-01-17', 'A3', 'Admin', 2),
(29, 'Evaluasi Kinerja Sistem Informasi Manajemen Rumah Sakit', 'Ahmad Fauzi', '2021', 3, 4, '2025-01-17', 'A4', 'Admin', 3),
(30, 'Pengembangan Aplikasi Mobile untuk Pembelajaran Bahasa Inggris', 'Dewi Lestari', '2024', 4, 5, '2025-01-17', 'A5', 'Admin', 5);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;