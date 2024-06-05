-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2024 at 03:13 AM
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
-- Table structure for table `nilai_kpi`
--

CREATE TABLE `nilai_kpi` (
  `id` int(11) NOT NULL,
  `pegawai_id` int(11) NOT NULL,
  `indikator_id` int(11) NOT NULL,
  `pencapaian` int(11) NOT NULL DEFAULT '0',
  `persen` decimal(10,2) NOT NULL DEFAULT '0.00',
  `score` decimal(10,2) NOT NULL DEFAULT '0.00',
  `final_score` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_kpi`
--

ALTER TABLE `nilai_kpi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_indikator` (`indikator_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nilai_kpi`
--
ALTER TABLE `nilai_kpi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai_kpi`
--
ALTER TABLE `nilai_kpi`
  ADD CONSTRAINT `fk_indikator` FOREIGN KEY (`indikator_id`) REFERENCES `kinerja_kpi` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
