-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2024 at 04:42 AM
-- Server version: 5.7.33
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ekinerja`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama_jabatan` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `gol_kpi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `kode`, `nama_jabatan`, `status`, `gol_kpi`) VALUES
(9, 'OWN', 'Owner Utama', 0, 9),
(12, 'DIR', 'Direktur Utama ', 0, 9),
(13, 'SPV', 'Supervisor', 0, 9),
(14, 'HR', 'HRD', 0, 9),
(15, 'ACC1', 'Accounting 1', 0, 9),
(16, 'ACC2', 'Accounting 2', 0, 9),
(17, 'PRG', 'IT / Progammer', 0, 9),
(18, 'MARKET1', 'Head Marketing', 1, 1),
(19, 'MARKET2', 'Marketing 2', 1, 1),
(20, 'SALES', 'Marketing Area', 0, 9),
(21, 'CC', 'Konten Kreator', 0, 9),
(22, 'DSGN', 'Design 1', 0, 9),
(23, 'DSGN2', 'Design 2', 0, 9),
(24, 'OPR', 'Operator H2H', 1, 2),
(25, 'SP', 'Support H2H', 1, 4),
(26, 'CS', 'CS H2H', 1, 7),
(27, 'ADM', 'ADM H2H', 1, 9),
(28, 'ADM', 'Admin Voucher', 1, 10),
(29, 'OPR', 'Operator XML Mobile', 1, 2),
(30, 'XML', 'CS XML Mobile', 1, 8),
(31, 'ADM', 'ADM XML Mobile', 1, 9),
(32, 'PH', 'Operator & CS PH', 1, 11),
(33, 'SDP', 'Operator & CS SDP', 1, 5),
(34, 'PG', 'Operator & CS PG', 1, 6),
(35, 'SP', 'Support 2', 1, 4),
(38, 'SP', 'Support 3', 1, 4),
(39, 'MO', 'Marketing Online', 0, 9),
(40, 'CV', 'CS  Voucher ', 1, 10),
(41, 'SSB', 'Operator & CS SSB ', 1, 6),
(42, 'SPVM', 'SPV Marketing Area', 0, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gol_kpi` (`gol_kpi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `fk_gol_kpi` FOREIGN KEY (`gol_kpi`) REFERENCES `golongan_kpi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
