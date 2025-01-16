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

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`, `id_instansi`) VALUES
(1, 'Kesehatan Masyarakat', 1),
(2, 'Kedokteran', 5),
(3, 'Hukum', 2),
(4, 'Pertanian', 5),
(5, 'Ilmu Sosial dan Ilmu Politik', 1);

--
-- Dumping data for table `instansi`
--

INSERT INTO `instansi` (`id_instantsi`, `nama_instansi`) VALUES
(1, 'Universitas Halu Oleo'),
(2, 'Universitas Halu Oleo'),
(3, 'Institut Agama Islam Negeri Kendari'),
(4, 'Universitas Mandala Waluya'),
(5, 'Universitas Sulawesi Tenggara');

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'S1'),
(2, 'BRIDA'),
(3, 'S3'),
(4, 'S2'),
(5, 'BRIDA');

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`) VALUES
(1, 'admin', 'admin123'),
(2, 'admin', 'admin');

--
-- Dumping data for table `penelitian`
--

INSERT INTO `penelitian` (`id_penelitian`, `judul`, `nama_penulis`, `tahun`, `id_fakultas`, `id_kategori`, `id_rak`, `tgl_masuk`, `petugas`) VALUES
(1, 'Pengembangan Sistem Informasi Perpustakaan Berbasis Web dengan Fitur Pencarian Cerdas Menggunakan Al', 'Nazwah Thalbiatul Ilmi Rahman', '2024', 3, 1, 'A2', '2025-01-16', 'Admin'),
(2, 'Analisis Pengaruh Strategi Pemasaran Digital terhadap Peningkatan Penjualan pada UMKM di Era Pandemi', 'Selin Rahmadani', '2022', 5, 5, 'A5', '2025-01-16', 'Admin'),
(3, 'Efektivitas Model Pembelajaran Kooperatif Tipe Think-Pair-Share pada Mata Pelajaran Matematika Kelas', 'Irham Hasbi', '2021', 3, 3, 'A3', '2025-01-16', 'Admin'),
(4, 'Hubungan Antara Pola Konsumsi Fast Food dengan Tingkat Obesitas pada Remaja di Kota X', 'Muhammad Dimas', '2023', 1, 5, 'A4', '2025-01-16', 'Admin'),
(5, 'Pengaruh Literasi Keuangan terhadap Keputusan Investasi Mahasiswa pada Platform Peer-to-Peer Lending', 'Kalingga Sakti', '2024', 2, 2, 'A1', '2025-01-16', 'Admin');

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id_rak`, `keterangan`) VALUES
('A1', NULL),
('A2', NULL),
('A3', NULL),
('A4', NULL),
('A5', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
