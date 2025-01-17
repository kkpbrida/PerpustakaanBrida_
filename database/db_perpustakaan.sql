-- -- phpMyAdmin SQL Dump
-- -- version 5.2.1
-- -- https://www.phpmyadmin.net/
-- --
-- -- Host: 127.0.0.1
-- -- Generation Time: Jan 16, 2025 at 07:37 AM
-- -- Server version: 10.4.32-MariaDB
-- -- PHP Version: 8.1.25

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

-- --
-- -- Database: `db_perpustakaan`
-- --

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `fakultas`
-- --

-- CREATE TABLE `fakultas` (
--   `id_fakultas` int(11) NOT NULL,
--   `nama_fakultas` varchar(50) NOT NULL,
--   `id_instansi` int(11) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `instansi`
-- --

-- CREATE TABLE `instansi` (
--   `id_instantsi` int(11) NOT NULL,
--   `nama_instansi` varchar(50) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `kategori`
-- --

-- CREATE TABLE `kategori` (
--   `id_kategori` int(11) NOT NULL,
--   `nama_kategori` varchar(50) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `login`
-- --

-- CREATE TABLE `login` (
--   `id_login` int(11) NOT NULL,
--   `username` varchar(50) NOT NULL,
--   `password` varchar(20) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --
-- -- Dumping data for table `login`
-- --

-- INSERT INTO `login` (`id_login`, `username`, `password`) VALUES
-- (1, 'admin', 'admin123'),
-- (2, 'admin', 'admin');

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `penelitian`
-- --

-- CREATE TABLE `penelitian` (
--   `id_penelitian` int(11) NOT NULL,
--   `judul` varchar(100) NOT NULL,
--   `nama_penulis` varchar(200) NOT NULL,
--   `tahun` varchar(4) NOT NULL,
--   `id_fakultas` int(11) DEFAULT NULL,
--   `id_kategori` int(11) NOT NULL,
--   `tgl_masuk` date NOT NULL DEFAULT current_timestamp(),
--   `id_rak` varchar(10) NOT NULL,
--   `petugas` varchar(50) NOT NULL DEFAULT 'Admin'
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- --------------------------------------------------------

-- --
-- -- Table structure for table `rak`
-- --

-- CREATE TABLE `rak` (
--   `id_rak` varchar(10) NOT NULL,
--   `keterangan` varchar(100) DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --
-- -- Dumping data for table `rak`
-- --

-- INSERT INTO `rak` (`id_rak`, `keterangan`) VALUES
-- ('A1', NULL);

-- --
-- -- Indexes for dumped tables
-- --

-- --
-- -- Indexes for table `fakultas`
-- --
-- ALTER TABLE `fakultas`
--   ADD PRIMARY KEY (`id_fakultas`),
--   ADD KEY `id_instansi` (`id_instansi`);

-- --
-- -- Indexes for table `instansi`
-- --
-- ALTER TABLE `instansi`
--   ADD PRIMARY KEY (`id_instantsi`);

-- --
-- -- Indexes for table `kategori`
-- --
-- ALTER TABLE `kategori`
--   ADD PRIMARY KEY (`id_kategori`);

-- --
-- -- Indexes for table `login`
-- --
-- ALTER TABLE `login`
--   ADD PRIMARY KEY (`id_login`);

-- --
-- -- Indexes for table `penelitian`
-- --
-- ALTER TABLE `penelitian`
--   ADD PRIMARY KEY (`id_penelitian`),
--   ADD KEY `id_fakultas` (`id_fakultas`),
--   ADD KEY `id_kategori` (`id_kategori`),
--   ADD KEY `id_rak` (`id_rak`);
-- ALTER TABLE `penelitian` ADD FULLTEXT KEY `judul` (`judul`,`nama_penulis`);
-- ALTER TABLE `penelitian` ADD FULLTEXT KEY `judul_2` (`judul`,`nama_penulis`);

-- ALTER TABLE `penelitian`
--   ADD COLUMN `tgl_masuk` date NOT NULL DEFAULT current_timestamp();
-- ALTER TABLE `penelitian`
--   ADD COLUMN `petugas` varchar(50) NOT NULL DEFAULT 'Admin';
--   ALTER TABLE `penelitian`
--     MODIFY COLUMN `tahun` varchar(50) NOT NULL;

-- --
-- -- Indexes for table `rak`
-- --
-- ALTER TABLE `rak`
--   ADD PRIMARY KEY (`id_rak`);

-- --
-- -- AUTO_INCREMENT for dumped tables
-- --

-- --
-- -- AUTO_INCREMENT for table `fakultas`
-- --
-- ALTER TABLE `fakultas`
--   MODIFY `id_fakultas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- --
-- -- AUTO_INCREMENT for table `instansi`
-- --
-- ALTER TABLE `instansi`
--   MODIFY `id_instantsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --
-- -- AUTO_INCREMENT for table `kategori`
-- --
-- ALTER TABLE `kategori`
--   MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- --
-- -- AUTO_INCREMENT for table `login`
-- --
-- ALTER TABLE `login`
--   MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- --
-- -- AUTO_INCREMENT for table `penelitian`
-- --
-- ALTER TABLE `penelitian`
--   MODIFY `id_penelitian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- --
-- -- Constraints for dumped tables
-- --

-- --
-- -- Constraints for table `fakultas`
-- --
-- ALTER TABLE `fakultas`
--   ADD CONSTRAINT `fakultas_ibfk_1` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instantsi`) ON DELETE CASCADE ON UPDATE CASCADE;

-- --
-- -- Constraints for table `penelitian`
-- --
-- ALTER TABLE `penelitian`
--   ADD CONSTRAINT `penelitian_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
--   ADD CONSTRAINT `penelitian_ibfk_2` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE ON UPDATE CASCADE,
--   ADD CONSTRAINT `penelitian_ibfk_3` FOREIGN KEY (`id_rak`) REFERENCES `rak` (`id_rak`) ON DELETE CASCADE ON UPDATE CASCADE;
-- COMMIT;

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Hapus tabel

-- ALTER TABLE registrasi DROP CONSTRAINT registrasi_ibfk_1;

-- drop table petugas;

-- ALTER TABLE penelitian DROP CONSTRAINT penelitian_ibfk_4;

-- drop table registrasi;

-- ALTER TABLE penelitian DROP COLUMN id_registrasi;

-- Mengubah Batas Penulis
ALTER TABLE penelitian MODIFY COLUMN nama_penulis varchar(500) NOT NULL;