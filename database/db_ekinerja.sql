-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2024 at 08:03 AM
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
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id` int(11) NOT NULL,
  `approval_kegiatan` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `atasan`
--

CREATE TABLE `atasan` (
  `id` int(11) NOT NULL,
  `nama_atasan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atasan`
--

INSERT INTO `atasan` (`id`, `nama_atasan`) VALUES
(1, 'Ir. Priyono Sanyoto'),
(3, 'Drs. Sri Wahyuni, Msi'),
(4, 'Drs Mahadhin CU, MM'),
(5, 'Moch. Asif Susanto, SH'),
(6, 'Ir. Agus Winardi ');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id` int(11) NOT NULL,
  `nama_bidang` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id`, `nama_bidang`) VALUES
(4, 'Bidang Informasi dan Komunikasi Publik'),
(5, 'Bidang Informatika'),
(6, 'Bidang Statistik dan Persandian'),
(11, 'Bidang Fungsional');

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `bonus` varchar(99) DEFAULT NULL,
  `gapok` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `jabatan`, `bonus`, `gapok`) VALUES
(1, 'IT/Progammer', '200000', '3000000'),
(2, 'IT/Progammer', '200000', '3000000'),
(3, '13', '600000', '8000000'),
(5, '20', '500000', '3500000'),
(7, '17', '5000000', '6500000');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_test`
--

CREATE TABLE `gaji_test` (
  `no` int(11) NOT NULL,
  `pegawai` varchar(255) NOT NULL,
  `jabatan` varchar(11) NOT NULL,
  `gaji` int(11) NOT NULL,
  `bonus` int(11) DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `gaji_bersih` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`) VALUES
(9, 'Owner Utama'),
(12, 'Direktur Utama '),
(13, 'Supervisor'),
(14, 'HRD'),
(15, 'Accounting 1'),
(16, 'Accounting 2'),
(17, 'IT / Progammer'),
(18, 'Head Marketing'),
(19, 'Marketing 2'),
(20, 'Marketing Area'),
(21, 'Konten Kreator'),
(22, 'Design 1'),
(23, 'Design 2'),
(24, 'Operator H2H'),
(25, 'Support H2H'),
(26, 'CS H2H'),
(27, 'ADM H2H'),
(28, 'Admin Voucher'),
(29, 'Operator XML Mobile'),
(30, 'CS XML Mobile'),
(31, 'ADM XML Mobile'),
(32, 'Operator & CS PH'),
(33, 'Operator & CS SDP'),
(34, 'Operator & CS PG'),
(35, 'Support 2'),
(36, ' 	Owner Utama'),
(38, 'Support 3'),
(39, 'Marketing Online'),
(40, 'CS  Voucher '),
(41, 'Operator & CS SSB '),
(42, 'SPV Marketing Area');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `target` varchar(20) DEFAULT NULL,
  `id_pegawai` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `uraian`, `satuan`, `target`, `id_pegawai`) VALUES
(1, 'Rekap Surat', 'buah', '10', '3'),
(3, 'Kegiatan Pembuatan Website Perpustakaan Kab Blitar', 'Aplikasi', '15', '3'),
(4, 'Pembuatan Katalok Perpustakaan Keliling', 'Aplikasi', '30', '6'),
(5, 'Desain poster', 'buah', '20', '6'),
(7, 'desain logo', 'buah', '15', '9'),
(8, 'Pembuatan Website Katalok Buku Perpustakaan Kabupaten Blitar', 'Aplikasi', '15', '10'),
(9, 'Pembuatan Reklame Kabupaten Blitar', 'Lembar', '50', '11'),
(10, 'membuat laporan harian ', 'buah', '10', '15'),
(11, 'Mengarang Kata kata yang indah', 'Lembar', 'satuan', '15'),
(12, 'Pembuatan Video Interaktif edukasi Untuk usian <10 tahun', 'Buah', '30 dvd', '16'),
(13, 'Membuat Reklame Hari Pendidikan Nasional', 'Lembar', '65', '15'),
(14, 'Membuat Design konten', 'buah', '2', '20');

-- --------------------------------------------------------

--
-- Table structure for table `kinerja`
--

CREATE TABLE `kinerja` (
  `id` int(11) NOT NULL,
  `nama_pegawai` varchar(225) DEFAULT NULL,
  `uraian_kegiatan` varchar(225) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kinerja`
--

INSERT INTO `kinerja` (`id`, `nama_pegawai`, `uraian_kegiatan`, `waktu`, `waktu_selesai`) VALUES
(23, '8', '5', '2018-01-01 07:00:00', '2018-01-01 11:00:00'),
(24, '9', '5', '2018-01-09 06:59:00', '2018-01-09 15:59:00'),
(25, '9', '3', '2018-01-09 12:00:00', '2018-01-10 18:09:00'),
(26, '13', '3', '2018-01-08 23:11:00', '2018-01-09 15:15:00'),
(27, '14', '5', '2018-01-08 11:11:00', '2018-01-09 11:11:00'),
(28, '12', '5', '2018-01-08 11:11:00', '2018-01-09 11:11:00'),
(29, '15', '10', '2018-01-16 07:00:00', '2018-01-16 15:00:00'),
(30, '27', '7', '2018-01-09 00:12:00', '2018-01-10 21:09:00'),
(31, '', '5', '2018-01-11 23:59:00', '2018-01-12 12:59:00'),
(32, 'admin', '13', '2023-02-12 16:18:00', '2023-02-12 17:18:00'),
(33, '654321', '10', '2023-02-11 00:00:00', '2023-02-11 13:00:00'),
(34, '654321', '10', '2023-02-11 13:00:00', '2023-02-11 14:00:00'),
(35, '654321', '10', '2023-02-11 13:00:00', '2023-02-11 14:00:00'),
(36, '654321', '7', '2023-02-18 02:00:00', '2023-02-18 02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `aksi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `user`, `aksi`, `created_at`) VALUES
(5, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-02-05, shift: 2', '2024-04-18 02:06:55'),
(6, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-02-06, shift: 2', '2024-04-18 02:06:55'),
(7, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-02-07, role: 1', '2024-04-18 02:06:55'),
(8, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-02-07, shift: 4', '2024-04-18 02:06:55'),
(9, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-02-06, role: 3', '2024-04-18 02:06:55'),
(10, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-02-06, shift: 2', '2024-04-18 02:06:55'),
(11, 'irfanem', 'insert data role pegawai: 63, tanggal : 2024-02-04, role: 1', '2024-04-18 02:06:55'),
(12, 'irfanem', 'update data shift pegawai: 63, tanggal : 2024-02-04, shift: 3', '2024-04-18 02:06:55'),
(13, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-05-06, role: 3', '2024-04-18 02:06:55'),
(14, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-05-06, shift: 2', '2024-04-18 02:06:55'),
(15, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-05-01, role: 3', '2024-04-18 02:07:43'),
(16, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-05-01, shift: 3', '2024-04-18 02:07:47'),
(17, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-15, role: 4', '2024-04-19 01:15:30'),
(18, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-15, shift: 4', '2024-04-19 01:15:33'),
(19, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-05-07, role: 8', '2024-04-22 03:42:02'),
(20, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-05-07, shift: 3', '2024-04-22 03:42:06'),
(21, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-05-02, role: 4', '2024-04-22 03:42:11'),
(22, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-05-02, shift: 4', '2024-04-22 03:42:14'),
(23, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-05-03, role: 5', '2024-04-22 03:42:16'),
(24, 'irfanem', 'update data role pegawai: 80, tanggal : 2024-05-03, role: 1', '2024-04-22 03:42:18'),
(25, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-05-03, shift: 3', '2024-04-22 03:42:22'),
(26, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-05-01, role: 10', '2024-04-22 03:42:27'),
(27, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-05-01, shift: 1', '2024-04-22 03:42:30'),
(28, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-05-02, role: 10', '2024-04-22 03:42:31'),
(29, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-05-02, shift: 4', '2024-04-22 03:42:34'),
(30, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-05-03, role: 10', '2024-04-22 03:42:36'),
(31, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-05-03, shift: 3', '2024-04-22 03:42:38'),
(32, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-05-04, role: 10', '2024-04-22 03:42:40'),
(33, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-05-04, shift: 3', '2024-04-22 03:42:42'),
(34, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-05, shift: 1', '2024-04-22 04:19:43'),
(35, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-06, role: 2', '2024-04-22 04:19:55'),
(36, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-22, role: 1', '2024-04-22 04:32:41'),
(37, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-22, shift: 3', '2024-04-22 04:32:50'),
(38, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-16, role: 2', '2024-04-22 05:32:34'),
(39, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-16, shift: 3', '2024-04-22 05:32:37'),
(40, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-06, role: 3', '2024-04-22 05:33:01'),
(41, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-06, shift: 2', '2024-04-22 05:33:05'),
(42, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-07, role: 2', '2024-04-22 05:37:58'),
(43, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-08, shift: 3', '2024-04-22 05:38:01'),
(44, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-07, shift: 5', '2024-04-22 05:38:04'),
(45, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-07, shift: 3', '2024-04-22 05:38:08'),
(46, 'irfanem', 'update data role pegawai: 73, tanggal : 2024-04-04, role: 8', '2024-04-22 08:07:16'),
(47, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-09, role: 3', '2024-04-23 01:44:42'),
(48, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-11, shift: 5', '2024-04-23 01:44:47'),
(49, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-11, shift: 2', '2024-04-23 01:44:51'),
(50, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-09, shift: 4', '2024-04-23 01:44:54'),
(51, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-13, role: 5', '2024-04-23 01:44:58'),
(52, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-13, shift: 3', '2024-04-23 01:45:01'),
(53, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-17, role: 4', '2024-04-23 01:45:07'),
(54, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-17, shift: 2', '2024-04-23 01:45:10'),
(55, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-18, role: 2', '2024-04-23 01:45:13'),
(56, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-18, shift: 1', '2024-04-23 01:45:16'),
(57, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-06, shift: 2', '2024-04-23 01:47:46'),
(58, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-07, role: 1', '2024-04-23 01:47:47'),
(59, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-07, shift: 1', '2024-04-23 01:47:52'),
(60, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-08, role: 1', '2024-04-23 01:47:57'),
(61, 'irfanem', 'update data role pegawai: 80, tanggal : 2024-04-08, role: 2', '2024-04-23 01:48:02'),
(62, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-08, shift: 2', '2024-04-23 01:48:06'),
(63, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-09, role: 3', '2024-04-23 01:48:07'),
(64, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-09, shift: 1', '2024-04-23 01:48:09'),
(65, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-10, role: 3', '2024-04-23 01:48:10'),
(66, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-10, shift: 1', '2024-04-23 01:48:11'),
(67, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-11, role: 3', '2024-04-23 01:48:15'),
(68, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-11, shift: 3', '2024-04-23 01:48:16'),
(69, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-12, role: 6', '2024-04-23 01:48:18'),
(70, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-12, shift: 4', '2024-04-23 01:48:20'),
(71, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-13, role: 6', '2024-04-23 01:48:21'),
(72, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-13, shift: 5', '2024-04-23 01:48:22'),
(73, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-14, role: 6', '2024-04-23 01:48:30'),
(74, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-14, shift: 3', '2024-04-23 01:48:33'),
(75, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-15, role: 6', '2024-04-23 01:48:35'),
(76, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-15, shift: 2', '2024-04-23 01:48:41'),
(77, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-16, role: 7', '2024-04-23 01:48:43'),
(78, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-16, shift: 3', '2024-04-23 01:48:45'),
(79, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-17, role: 5', '2024-04-23 01:48:47'),
(80, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-17, shift: 3', '2024-04-23 01:48:50'),
(81, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-18, role: 9', '2024-04-23 01:48:53'),
(82, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-18, shift: 3', '2024-04-23 01:48:55'),
(83, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-19, role: 5', '2024-04-23 01:48:57'),
(84, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-19, shift: 3', '2024-04-23 01:48:58'),
(85, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-20, role: 5', '2024-04-23 01:49:00'),
(86, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-20, shift: 2', '2024-04-23 01:49:01'),
(87, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-21, role: 9', '2024-04-23 01:49:04'),
(88, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-21, shift: 1', '2024-04-23 01:49:06'),
(89, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-23, role: 6', '2024-04-23 01:49:09'),
(90, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-23, shift: 2', '2024-04-23 01:49:12'),
(91, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-24, role: 3', '2024-04-23 01:49:14'),
(92, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-24, shift: 2', '2024-04-23 01:49:16'),
(93, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-25, role: 5', '2024-04-23 01:49:18'),
(94, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-25, shift: 3', '2024-04-23 01:49:19'),
(95, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-26, role: 6', '2024-04-23 01:49:22'),
(96, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-26, shift: 2', '2024-04-23 01:49:24'),
(97, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-27, role: 3', '2024-04-23 01:49:27'),
(98, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-27, shift: 1', '2024-04-23 01:49:29'),
(99, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-28, role: 1', '2024-04-23 01:49:35'),
(100, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-28, shift: 2', '2024-04-23 01:49:37'),
(101, 'irfanem', 'insert data role pegawai: 80, tanggal : 2024-04-29, role: 1', '2024-04-23 01:49:39'),
(102, 'irfanem', 'update data shift pegawai: 80, tanggal : 2024-04-29, shift: 2', '2024-04-23 01:49:41'),
(103, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-19, role: 3', '2024-04-23 01:49:45'),
(104, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-19, shift: 2', '2024-04-23 01:49:46'),
(105, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-20, role: 6', '2024-04-23 01:49:49'),
(106, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-20, shift: 1', '2024-04-23 01:49:51'),
(107, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-21, role: 3', '2024-04-23 01:49:53'),
(108, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-21, shift: 3', '2024-04-23 01:49:55'),
(109, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-22, role: 3', '2024-04-23 01:49:56'),
(110, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-22, shift: 3', '2024-04-23 01:49:58'),
(111, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-23, role: 2', '2024-04-23 01:50:00'),
(112, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-23, shift: 3', '2024-04-23 01:50:02'),
(113, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-25, role: 1', '2024-04-23 01:50:03'),
(114, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-25, shift: 2', '2024-04-23 01:50:06'),
(115, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-26, role: 4', '2024-04-23 01:50:09'),
(116, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-26, shift: 3', '2024-04-23 01:50:11'),
(117, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-27, role: 2', '2024-04-23 01:51:04'),
(118, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-27, shift: 3', '2024-04-23 01:51:06'),
(119, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-28, role: 2', '2024-04-23 01:51:07'),
(120, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-28, shift: 1', '2024-04-23 01:51:09'),
(121, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-29, role: 4', '2024-04-23 01:51:11'),
(122, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-29, shift: 2', '2024-04-23 01:51:12'),
(123, 'irfanem', 'insert data role pegawai: 73, tanggal : 2024-04-30, role: 2', '2024-04-23 01:51:14'),
(124, 'irfanem', 'update data shift pegawai: 73, tanggal : 2024-04-30, shift: 3', '2024-04-23 01:51:15'),
(125, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-30, role: 1', '2024-04-23 01:51:18'),
(126, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-30, shift: 3', '2024-04-23 01:51:20'),
(127, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-29, role: 7', '2024-04-23 01:51:22'),
(128, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-29, shift: 2', '2024-04-23 01:51:24'),
(129, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-28, role: 3', '2024-04-23 01:51:26'),
(130, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-28, shift: 1', '2024-04-23 01:51:27'),
(131, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-27, role: 1', '2024-04-23 01:51:29'),
(132, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-27, shift: 1', '2024-04-23 01:51:30'),
(133, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-26, role: 2', '2024-04-23 01:51:31'),
(134, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-26, shift: 2', '2024-04-23 01:51:33'),
(135, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-25, role: 3', '2024-04-23 01:51:35'),
(136, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-25, shift: 1', '2024-04-23 01:51:36'),
(137, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-25, shift: 3', '2024-04-23 01:51:39'),
(138, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-24, role: 2', '2024-04-23 01:51:40'),
(139, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-24, shift: 3', '2024-04-23 01:51:43'),
(140, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-23, role: 7', '2024-04-23 01:51:45'),
(141, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-23, shift: 2', '2024-04-23 01:52:52'),
(142, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-22, role: 1', '2024-04-23 01:52:53'),
(143, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-22, shift: 3', '2024-04-23 01:52:54'),
(144, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-21, role: 2', '2024-04-23 01:52:56'),
(145, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-21, shift: 1', '2024-04-23 01:52:57'),
(146, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-20, role: 4', '2024-04-23 01:52:58'),
(147, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-20, shift: 3', '2024-04-23 01:52:59'),
(148, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-19, role: 2', '2024-04-23 01:53:01'),
(149, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-19, shift: 3', '2024-04-23 01:53:02'),
(150, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-18, role: 1', '2024-04-23 01:53:04'),
(151, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-18, shift: 1', '2024-04-23 01:53:05'),
(152, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-17, role: 6', '2024-04-23 01:53:06'),
(153, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-17, shift: 3', '2024-04-23 01:53:08'),
(154, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-16, role: 2', '2024-04-23 01:53:09'),
(155, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-16, shift: 1', '2024-04-23 01:53:11'),
(156, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-15, role: 4', '2024-04-23 01:53:14'),
(157, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-15, shift: 3', '2024-04-23 01:53:16'),
(158, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-14, role: 3', '2024-04-23 01:53:17'),
(159, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-14, shift: 2', '2024-04-23 01:53:18'),
(160, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-13, role: 2', '2024-04-23 01:53:19'),
(161, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-13, shift: 2', '2024-04-23 01:53:21'),
(162, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-12, role: 3', '2024-04-23 01:53:22'),
(163, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-12, shift: 3', '2024-04-23 01:53:24'),
(164, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-11, role: 2', '2024-04-23 01:53:25'),
(165, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-11, shift: 2', '2024-04-23 01:53:26'),
(166, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-10, role: 3', '2024-04-23 01:53:27'),
(167, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-10, shift: 2', '2024-04-23 01:53:28'),
(168, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-09, role: 6', '2024-04-23 01:53:30'),
(169, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-09, shift: 3', '2024-04-23 01:53:32'),
(170, 'irfanem', 'update data role pegawai: 94, tanggal : 2024-04-07, role: 2', '2024-04-23 01:53:33'),
(171, 'irfanem', 'insert data role pegawai: 94, tanggal : 2024-04-06, role: 1', '2024-04-23 01:53:35'),
(172, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-06, shift: 2', '2024-04-23 01:53:37'),
(173, 'irfanem', 'update data shift pegawai: 94, tanggal : 2024-04-05, shift: 3', '2024-04-23 01:53:39'),
(174, 'irfanem', 'insert data role pegawai: 104, tanggal : 2024-04-02, role: 3', '2024-04-23 07:04:13'),
(175, 'irfanem', 'update data shift pegawai: 104, tanggal : 2024-04-02, shift: 3', '2024-04-23 07:04:14'),
(176, 'irfanem', 'insert data role pegawai: 104, tanggal : 2024-04-03, role: 2', '2024-04-23 07:04:16'),
(177, 'irfanem', 'update data shift pegawai: 104, tanggal : 2024-04-03, shift: 3', '2024-04-23 07:04:18'),
(178, 'irfanem', 'insert data role pegawai: 104, tanggal : 2024-04-04, role: 2', '2024-04-23 07:04:21'),
(179, 'irfanem', 'update data shift pegawai: 104, tanggal : 2024-04-04, shift: 1', '2024-04-23 07:04:22'),
(180, 'irfanem', 'insert data role pegawai: 104, tanggal : 2024-04-05, role: 1', '2024-04-23 07:04:24'),
(181, 'irfanem', 'update data shift pegawai: 104, tanggal : 2024-04-05, shift: 2', '2024-04-23 07:04:28'),
(182, 'irfanem', 'insert data role pegawai: 104, tanggal : 2024-04-06, role: 2', '2024-04-23 07:08:11'),
(183, 'irfanem', 'update data shift pegawai: 104, tanggal : 2024-04-06, shift: 4', '2024-04-23 07:08:14'),
(184, 'irfanem', 'insert data role pegawai: 104, tanggal : 2024-04-07, role: 2', '2024-04-23 07:08:16'),
(185, 'irfanem', 'update data shift pegawai: 104, tanggal : 2024-04-07, shift: 4', '2024-04-23 07:08:17'),
(186, 'irfanem', 'insert data role pegawai: 104, tanggal : 2024-04-08, role: 2', '2024-04-23 07:08:19'),
(187, 'irfanem', 'update data shift pegawai: 104, tanggal : 2024-04-08, shift: 4', '2024-04-23 07:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` int(21) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kontak` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `report` int(11) NOT NULL DEFAULT '1',
  `tgl_masuk` date DEFAULT NULL,
  `tgl_kontrak` date DEFAULT NULL,
  `bpjs_kes` varchar(255) DEFAULT NULL,
  `bpjs_ket` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `nik`, `alamat`, `kontak`, `email`, `jabatan`, `report`, `tgl_masuk`, `tgl_kontrak`, `bpjs_kes`, `bpjs_ket`) VALUES
(1, 'xmltrronik', 0, '', '', 'admin@contoh.com', '9', 1, '1970-01-01', '1970-01-01', '', ''),
(52, 'Zulfa Aulia Wibowo ', 0, 'Jl. Mayjen Sutoyo Gg. Turi No 7 Rt 002 Rw 007 Kel. Sidakaya, Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '12', 1, '2015-06-01', '2015-06-01', '', '23003154376'),
(53, 'Aprelia Gusniawati ', 0, 'Jl. Baruna Tengah X No 169 Rt 006 Rw 014 Kel. Tegalkamulyan , Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '13', 1, '2014-08-11', '2014-08-11', '', ''),
(54, 'Zulfa Rohadatul aisyi fauziah', 0, 'Jl. Mt Haryono Gg. Cendrawasih No 1, Tegalreja, Cilacap ', NULL, NULL, '14', 1, '2023-02-01', '2023-02-01', '', ''),
(55, 'Widyaswari Kusuma N', 0, 'Jl. Jendral Sudirman No 73 Rt 002 Rw 008 Kel. Tegalreja, Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '15', 1, '2020-07-10', '2020-07-10', '', '23003154384'),
(56, 'Siska Tri Y', 0, 'Jl. Beringin Rt 003 Rw 004 Desa. Tritih Kulon , Kec. Cilacap Utara - Kab. Cilacap', NULL, NULL, '16', 1, '2021-03-05', '2021-03-05', '', '23003154368'),
(57, 'test', 0, 'test', NULL, NULL, '17', 1, '2023-04-30', '2024-05-31', '', ''),
(58, 'Wildan Faturohman', 0, 'Jl. Mayjen Sutoyo Gg. Turi No 7 Rt 002 Rw 007 Kel. Sidakaya, Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '18', 1, '2016-01-11', '2016-01-11', '', '23003154350'),
(59, 'Giovani Magdalena', 0, 'Perum Rineggo Asri Blok A6/35 Rt 008 Rw 018 Kel. Gumilir, Kec. Cilacap Utara - Kab. Cilacap', NULL, NULL, '19', 1, '2016-12-05', '2016-12-05', '', '23012602555'),
(60, 'Muji Kurnianto', 0, 'Jl. Darusman No 88 Rt 002 Rw 006 Kel. Karangtalun , Kec. Cilacap Utara - Kab. Cilacap', NULL, NULL, '20', 1, '2022-02-01', '2022-02-01', '', ''),
(61, 'Eko Aziz Setiawan ', 0, 'Jl. Tugu utara Rt 03/02 Sampang. Kec Sampang ', NULL, NULL, '20', 0, '2023-03-01', '2023-03-01', '', ''),
(62, 'Abdul Aziz', 0, 'Desa. Grujugan Rt 002 Rw 004 Kec. Kemranjen - Kab. Banyumas', NULL, NULL, '20', 1, '2023-01-09', '2023-01-09', '', ''),
(63, 'Ades Chaniago Akmal ', 0, 'Cluster Pelita Garden Rt 03/01, Kalikidang, Kec. Sokaraja, Banyumas ', NULL, NULL, '20', 1, '2023-05-01', '2023-05-01', '', ''),
(64, 'Dwi Mey Hariprasetyo', 0, 'Jl. Bogowonto No 46 Rt 006 Rw 008 Kel. Donan, Kec. Cilacap Tengah - Kab. Cilacap', '', '', '21', 1, '2022-07-27', '2022-07-27', '', ''),
(65, 'Khoerul Anam', 0, 'Dusun. Awiluar Rt 004 Rw 001 Desa. Kedungreja, Kec. Kedungreja - Kab. Cilacap', NULL, NULL, '22', 1, '2022-09-01', '2022-09-01', '', ''),
(66, 'Yogi Nuraini ', 0, 'Jl. Rajawali VII No 23 Rt 03/03, Tegalreja, Cilacap ', NULL, NULL, '39', 1, '2023-05-01', '2023-05-01', '', ''),
(67, 'Aprilia Bekti Mahalani', 0, 'Jl. Kendeng Rt 03/01. Kuripan, kesugihan, cilacap ', NULL, NULL, '23', 1, '2023-05-04', '2023-05-04', '', ''),
(68, 'Irfan Machmud', 0, 'Dusun. Kedung Banteng  Utara Rt 002 Rw 001 Desa. Sumingkir, Kec. Jeruklegi - Kab. Cilacap', '+6285602944606', 'progamerxml@gmail.com', '17', 1, '2022-07-01', '2022-07-01', '', ''),
(69, 'Cholid Qiwamudin', 0, 'Jl. Dr. Cipto No 92 Rt 004 Rw 016 Kel. Gumilir , Kec. Cilacap Utara - Kab. Cilacap', NULL, NULL, '24', 1, '2015-11-23', '2015-11-23', '', ''),
(70, 'Ramdita Febriana', 0, 'Jl. Merbabu No 46 Rt 003 Rw 006 Kel. Sidanegara , Kec. Cilacap Tengah - Kab. Cilacap', NULL, NULL, '24', 1, '2016-08-29', '2016-08-29', '', ''),
(71, 'Erlangga Triasa', 0, 'Jl. Sendangsari Timur  Rt 009 Rw 011 Kel. Donan, Kec. Cilacap Tengah - Kab. Cilacap', NULL, NULL, '24', 1, '2018-10-08', '2018-10-08', '', ''),
(72, 'Silvia Dwi R', 0, 'Jl. Delima No 173 Rt 006 Rw 002 Kel. Tambakreja, Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '26', 1, '2014-09-01', '2014-09-01', '', ''),
(73, 'Novita Yuli Anika', 0, 'Jl. Dr. Cipto no.108 Rt. 003/004 Kel. Kebonmanis Cilacap Utara - Kab. Cilacap', NULL, NULL, '26', 1, '2016-12-12', '2016-12-12', '', ''),
(74, 'Mulyani', 0, 'jl. merbabu no.44 rt.03/rw.06 sidanegara', NULL, NULL, '27', 1, '2018-08-06', '2018-08-06', '', ''),
(75, 'Anisyha Huditia', 0, 'Jl. Anggrek ruko No 4 Rt 004 Rw 013 Kel. Sidakaya , Kec. Cilacap Selatan - Kab.Cilacap', NULL, NULL, '27', 1, '2019-11-11', '2019-11-11', '', ''),
(76, 'Gesang Prayogi', 0, 'Jl. Lingkar Rt 002 Rw 001 Kel. Tegalkamulyan, Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '25', 1, '2019-09-30', '2019-09-30', '', ''),
(77, 'Edwin Bahari', 0, 'Jl. Kinibalu No 42 Rt 002 Rw 011 Kel. Sidanegara, Kec.Cilacap Tengah - Kab. Cilacap', NULL, NULL, '25', 1, '2021-02-01', '2021-02-01', '', ''),
(78, 'Widi Rizaldi', 0, 'Jl. Let. Jend. Suprapto No. 10 Rt 008 Rw 007 Kel. Tegalreja, Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '35', 1, '2019-11-01', '2019-11-01', '', ''),
(79, 'Tiara Mercusiana P', 0, 'Jl. Swadaya Rt 010 Rw 003 Kel. Tambakreja, Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '35', 1, '2020-02-17', '2020-02-17', '', ''),
(80, 'Akmal Hidayat', 0, 'Jl. Rinjani, Perumahan Sidanegara Indah Blok 14 No     Kel. Sidanegara, Kec. Cilacap Tengah - Kab. Cilacap', NULL, NULL, '38', 1, '2021-10-20', '2021-10-20', '', ''),
(81, 'Andi Susanto', 0, 'Jl. Penyu Gg Bulus RT 08/13, Cilacap selatan ', NULL, NULL, '29', 1, '2018-10-08', '2018-10-08', '', ''),
(82, 'Rizki Puspita Sari', 0, 'Jl. Banjaran Rt 002 Rw 022 Kel. Donan, Kec. Cilacap Tengah - Kab. Cilacap', NULL, NULL, '29', 1, '2019-05-01', '2019-05-01', '', ''),
(83, 'Dhwi Sulistiyowati', 0, 'Jl. Sendangsari Rt 006 Rw 023 Kel. Donan , Kec. Cilacap Tengah - Kab. Cilacap', NULL, NULL, '31', 1, '2023-01-16', '2023-01-16', '', ''),
(84, 'Novia Nurdianing Putri', 0, 'Jl. Nakula Rt 001 Rw 008 Kel. Tritih Wetan, Kec. Jeruklegi - Kab. Cilacap', NULL, NULL, '31', 1, '2022-01-03', '2022-01-03', '', ''),
(85, 'Mei Neiska Wati', 0, 'Jl. Perjuangan No 35 Rt 002 Rw 009 Desa. Jangrana , Kec. Kesugihan - Kab. Cilacap', NULL, NULL, '31', 1, '2022-08-08', '2022-08-08', '', ''),
(86, 'Valen Milan Ananta', 0, 'Jl. Kutilang No 8 Rt 003 Rw 005 Kel. Tegalreja , Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '30', 1, '2022-07-15', '2022-07-15', '', ''),
(87, 'Nadia Surya Wardani', 0, 'Jl. Wisata Payau Rt 03/11, Tritih kulon, Kec. Cilacap Utara ', NULL, NULL, '30', 1, '2023-03-20', '2023-03-20', '', ''),
(88, 'Oktaf Alan Alende', 0, 'Jl. Jambu No 3 Rt 005 / Rw 003 Kel. Tambakreja , Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '32', 1, '2021-08-01', '2021-08-01', '', ''),
(89, 'Nafitta Nur istifa', 0, 'Perum Rineggo Asri Blok A6/35 Rt 008 Rw 018 Kel. Gumilir, Kec. Cilacap Utara - Kab. Cilacap', NULL, NULL, '32', 1, '2021-10-16', '2021-10-16', '', ''),
(90, 'Slamet Mahardika', 0, 'Dusun mentasan Rt 04/03, Kawunganten, cilacap ', NULL, NULL, '32', 1, '2023-04-01', '2023-04-01', '', ''),
(91, 'Trivem Adde Alfan', 0, 'Jl. Delima No 258 Rt 006 Rw 001 Kel. Tambakreja , Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '33', 1, '2021-04-01', '2021-04-01', '', ''),
(92, 'Muhammad Faiz', 0, 'Jl. Mayjen Sutoyo Gg. Turi No 7 Rt 002 Rw 007 Kel. Sidakaya, Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '33', 1, '2021-04-01', '2021-04-01', '', ''),
(93, 'Eep Syaifulloh', 0, 'Dusun, Ciarus Rt 002 Rw 010 Desa. Randegan, Kec. Wangon -  Kab. Banyumas', NULL, NULL, '33', 1, '2021-07-21', '2021-07-21', '', ''),
(94, 'Dion Pangestu', 0, 'JL. Manggasari Rt 01/11, Dayeuhluhur, Cilacap ', NULL, NULL, '33', 1, '2023-04-01', '2023-04-01', '', ''),
(95, 'Gregorio Matthew', 0, 'Perum Bayur Permai Rt 003 Rw 019  Kel. Gumilir, Kec. Cilacap Utara - Kab. Cilacap', NULL, NULL, '34', 1, '2022-05-23', '2022-05-23', '', ''),
(96, 'Bernandus Agung Wijaya', 0, 'Jl. Kendeng No 49 Rt 005 Rw 015 Kel. Sidanegara, Kec. Cilacap Tengah - Kab. Cilacap', NULL, NULL, '34', 1, '2022-07-06', '2022-07-06', '', ''),
(97, 'Vina Apriliana', 0, 'Jl. Singa Laut Rt 002 Rw 012 Kel. Mertasinga , Kec. Cilacap Utara - Kab. Cilacap', NULL, NULL, '40', 1, '2023-01-03', '2023-01-03', '', ''),
(98, 'Septi Widiarti Ningrum ', 0, 'Jl. Kendeng Rt 02/14 Sidanegara. Kel. Cilacap Tengah ', NULL, NULL, '40', 1, '2023-03-01', '2023-03-01', '', ''),
(99, 'Lutfi Nuraini ', 0, 'Jl. Bromo No.305 Rt 003/006, Sidanegara, Cilacap tengah, Cilacap ', NULL, NULL, '40', 1, '2023-05-08', '2023-05-08', '', ''),
(100, 'Fajar Arif Imaduddin', 0, 'Jl. Dr. Rajiman No 30 Rt 001 Rw 012 Kel. Gunungsimping, Kec. Cilacap Tengah - Kab. Cilacap', NULL, NULL, '41', 1, '2022-08-08', '2022-08-08', '', ''),
(101, 'Dhea Amelia putri ', 0, 'Jl. IR.H Juanda GG savita 56 rt 007/016 kec. Sidanegara kec. Cilacap tengah ', NULL, NULL, '41', 1, '2023-02-16', '2023-02-16', '', ''),
(102, 'Zalfa Saesarifa', 0, 'Gang. Bintang IV Rt 005 Rw 004 Kel. Tegalkamulyan , Kec. Cilacap Selatan - Kab. Cilacap', NULL, NULL, '28', 1, '2022-02-01', '2022-02-01', '', ''),
(103, 'Diah Prihatin', 0, 'Jl. Kakap Rt 005/010 Cilacap selatan ', NULL, NULL, '20', 0, '2023-05-11', '2023-05-11', '', ''),
(104, 'Ambar Asmara Sapto A.', 0, 'Jl. DR Cipto Rt 02/01, Kel. Kebon Manis, Kab Cilacap ', NULL, NULL, '42', 1, '2023-06-02', '2023-06-02', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `karyawan` varchar(255) NOT NULL,
  `pekerjaan` text NOT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `tanggal`, `karyawan`, `pekerjaan`, `tgl`) VALUES
(11, '2023-05-10 16:05:47', '64', '<p>- Revisi Background konten PH yang Testimoni<br />\r\n- Post Konten Tips Pulsa Genggam<br />\r\n- Story Konten Tips Pulsa Genggam<br />\r\n- Post Konten Testimoni PH<br />\r\n- Story Konten Testimoni PH<br />\r\n- Membuat Vector Ilustrasi Motion Grafis (DOA)<br />\r\n- Edit Transisi Motion Grafis (DOA)<br />\r\n- Edit suara voice over untuk Motion Grafis (DOA)<br />\r\n- Rendering Motion Grafis (DOA)</p>\r\n', '2023-05-10'),
(12, '2023-05-10 16:07:50', '59', '<p>&nbsp;10 Mei 2023</p>\r\n\r\n<p>1. Rekap Transaksi All Server<br />\r\n2. Rekap Hasil Gosokan Tim Voucher<br />\r\n3. Produk Promo SDP<br />\r\n4. Flash Sale Axis Data SDP<br />\r\n5. Konten Giveaway SDP<br />\r\n6. Diskusi Flyer dg tim design<br />\r\n7. Follow Up Agen PH<br />\r\n8. Diskusi Iklan dg Marketing Online<br />\r\n9. Croscek Iklan yg tayang<br />\r\n10. Rekap Stok Voucher<br />\r\n11. Rekap Penjualan Voucher<br />\r\n12. Follow Up Agen H2H<br />\r\n*Multikom<br />\r\n*Piscar<br />\r\n*Payfi<br />\r\n*Pulsabalap<br />\r\n*Atmpulsa<br />\r\n*FifReload<br />\r\n13. Rekap Orderan Voucher<br />\r\n*PH<br />\r\n*Teguh<br />\r\n*PG<br />\r\n*Yt Cell<br />\r\n*Eka<br />\r\n*Terminal Cell</p>\r\n', '2023-05-10'),
(13, '2023-05-10 16:08:19', '65', '<p>Design1 Report Harian Tanggal 10 Mei 2023</p>\r\n\r\n<p>- Design Icon Tukar Point dg Saldo XML<br />\r\n- Design Icon XL-Axis Cuan XML<br />\r\n- Design Promo Modal Hp Bisa Punya Konter XML<br />\r\n- Design ID Card XML<br />\r\n- Design Info Penting PG<br />\r\n- Design Banner Info Penting PG</p>\r\n', '2023-05-10'),
(14, '2023-05-10 16:10:02', '67', '<p>Report Harian Tanggal 10 Mei 2023 Design 2</p>\r\n\r\n<p>-Revisi Background Tumblr Pulsa Genggam<br />\r\n-Motion PH<br />\r\n-Desain Flayer Produk Cuan<br />\r\n-Desain Flayer Produk Cuan Axis</p>\r\n', '2023-05-10'),
(15, '2023-05-10 16:14:45', '68', '<p>&nbsp; &nbsp; âŒ upload kesan karyawan CS Retail Nadia<br />\r\n&nbsp; &nbsp; âŒ upload kesan karyawan HRD - Zulfa<br />\r\n&nbsp; &nbsp; âŒ upload kesan karyawan Marketing Online - Yogi<br />\r\n&nbsp; &nbsp; âŒ upload kesan karyawan Support 2 Akmal<br />\r\n&nbsp; &nbsp; âŒ upload kesan karyawan Operator PH dika<br />\r\n&nbsp; &nbsp; âŒ upload kesan karyawan Desain 2 alin<br />\r\n&nbsp; &nbsp; âŒ upload kesan karyawan CS Retail2 Valen<br />\r\n&nbsp; &nbsp; âŒ edit query tampil data karyawan (order by jabatan)<br />\r\n&nbsp; &nbsp; âŒ perbaikan tidak bisa remote pc accurate&nbsp;<br />\r\n&nbsp; &nbsp; âŒ penambahan sql syntax inesrt transaksi gagal ke xml_test<br />\r\n&nbsp; &nbsp; âŒ testing dan debuging auto insert xml_test dengan kondisi waktur tertentu.<br />\r\n&nbsp; &nbsp; âŒ integrasi datatable ke table xml_test</p>\r\n', '2023-05-10'),
(16, '2023-05-10 16:30:12', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 10 MEI 2023</p>\r\n\r\n<p>- Rekap&nbsp; voucher sales<br />\r\n- Gosok &amp; Upload voucher<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 09/05 yg sdh dtg<br />\r\n&nbsp;( SPL : Otim,Muji three,Toni)<br />\r\n- Update rekapan voucher<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari kamis<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-10'),
(17, '2023-05-11 16:02:38', '70', '<p>10 mei 2023<br />\r\n- Diskusi dengan kiki (retail) settingan produk xlcuanku di webreport<br />\r\n- Info kiki (retail) untuk meminta icon xlcuanku<br />\r\n- Update aplikasi XML (icon tukar poin ke saldo dan icon xl/axis cuanku)<br />\r\n- Publish aplikasi PH<br />\r\n- Cek settingan kuesioner PH dan XML di console<br />\r\n- Cek banner pergantian rekening PG dan revisi<br />\r\n- Cek L/R SSB dan info ke cs SSB untuk cek produk yang margin nya perlu diperbaiki<br />\r\n- Cek L/R PG dan info ke cs SSB untuk cek produk yang margin nya perlu diperbaiki<br />\r\n- Cek equoto , rekapan invent SSB<br />\r\n- Info cs SSB rekapan cashback dr kpindo<br />\r\n- Cek equoto , rekapan invent PG<br />\r\n- Bertanya ke zulfa perihal spl minus krna akmal<br />\r\n- Info Akmal untuk ganti rugi spl yang minus di PG (karena trx sukses digagalkan)<br />\r\n- Info cs PG untuk bc banner pergantian rekening<br />\r\n- Cek margin trx h2h dan menginfokan ke support siang produk yang margin nya perlu diperbaiki<br />\r\n- Pantau trx SU</p>\r\n', '2023-05-10'),
(18, '2023-05-10 16:37:18', '54', '<p>10 mei 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC 9 -10 Mei 23</li>\r\n	<li>Rekap KPI Retail, CS, support, OPR, SDP &amp; PH, marketing, data voucher</li>\r\n	<li>Brifing dengan ades marketing area pwt</li>\r\n</ul>\r\n\r\n<p>Instruksi dari ades : request ID card untuk marketing area</p>\r\n\r\n<ul>\r\n	<li>Brifing dan menginfokan SP kepada eko marketing area sampang</li>\r\n</ul>\r\n\r\n<p>Instruksi dari eko : ada beberapa agen yang areanya sampang tapi untuk transaksinya masuk ke mas aziz karena kenal dg mas aziz (padahal bukan area aziz)</p>\r\n\r\n<ul>\r\n	<li>Rekap absensi tanggal 1 &ndash; 9 mei share grup shift</li>\r\n	<li>Rekap form dari tanggal 1 &ndash; 10 mei</li>\r\n	<li>Menghubungi dian (calon MA jeruk legi) konfirmasi keberangkatan</li>\r\n	<li>Revisi data karyawan di e-report</li>\r\n	<li>Rekap form cuti</li>\r\n</ul>\r\n\r\n<p>1. form cuti trivem tanggal 14 mei (backup vani)</p>\r\n\r\n<ul>\r\n	<li>Rekap form tukar shift</li>\r\n</ul>\r\n\r\n<p>1. form tukar shift vina dg septi tanggal 15 mei (vina ada keperluan pribadi)</p>\r\n', '2023-05-10'),
(19, '2023-05-11 07:34:35', '56', '<p>1. Rekon Saldo Akhir Rekening bank dg Accurate<br />\r\n2. Input mutasi bank retail tgl 1 sd 8 Mei (accurate)<br />\r\n3. Rekon Saldo Spl dan Agen Feb, Mar, April (accurate)<br />\r\n4. Rekon transaksi penjualan dan pembelian April (accurate)</p>\r\n', '2023-05-10'),
(20, '2023-05-10 17:08:50', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Bayar dan Lapor PPh23 Jasa Audit<br />\r\n7. Bayar dan Lapor PPh21<br />\r\n8. Rekap Data Sewa<br />\r\n9. Bayar Astinet</p>\r\n', '2023-05-10'),
(21, '2023-05-10 18:30:44', '52', '<p>-menyiapkan bahan promosi sales (banner, brosur<br />\r\n-Briefing dengan Sales<br />\r\n*menawarkan vocer fisik bisa disiasati lewat PO<br />\r\n*mengarahkan eko utk tetap maintence dl dari kukuh<br />\r\n*eko: dl dari kukuh masih di maintence tp ga bs setiap hari<br />\r\n*aziz: tampilan aplikasi bagusnya per provider, jadi misal klik tsel langsung muncul semua produk seperti pulsa, paket data, dll contoh aplikasi order kuota, propana<br />\r\n*Aziz: request produk token yg bisa cek nama dulu baru lanjut bayar (beda kode tdk masalah)<br />\r\n*Ades: harga masih bersaing dgn kompetitor yg jalan di pwt<br />\r\n*Ades: kunjungan akuisisi butuh waktu lama sehari paling cuma bs 10 outlet<br />\r\n*Ades: tanya kalo sudah ada yg pake xml hrs gimana<br />\r\n*Eko: kendala waktu kalo harus setiap hari ke kesugihan<br />\r\n-hitung equoto ototepe tgl 9<br />\r\n-rekap saldo ototepe orderan kemaren yg sdh masuk, fu yg blm masuk ke golden<br />\r\n-cek hrg tsel tf di pasaran server<br />\r\n-cek hrg gs dipasaran<br />\r\n-mengarahkan opr menurunkan harga ff<br />\r\n-order tsel tp 39jt rate 14% golden<br />\r\n-mengarahkan mo, review caption promosi.<br />\r\n-request design id card untuk sales kasih konsep/ contoh ke anam<br />\r\n-info karyawan user dan pass ereporting, mulai hari ini sementara report double<br />\r\n-info ada eror submit ereport ke irfan</p>\r\n', '2023-05-10'),
(22, '2023-05-11 16:02:18', '68', '<ul>\r\n	<li>pasang ssd pc IT / Progamer</li>\r\n	<li>fix error tidak bisa akses database ototepe</li>\r\n	<li>Update jabatan admin retail - mei web karir</li>\r\n	<li>rebuild halaman rekap_report</li>\r\n	<li>setup config halaman rekap_report</li>\r\n	<li>pembuatan form filter tanggal halaman rekap_report</li>\r\n	<li>pembuatan query tampil jumlah karyawan sudah dan belum report</li>\r\n	<li>testing query tampil jumlah karyawan sudah dan belum report</li>\r\n	<li>pembuatan query tampil data karyawan sudah dan belum report&nbsp;</li>\r\n	<li>testing query tampil data karyawan sudah dan belum report</li>\r\n	<li>testing tampil jumlah dan data karyawan sudah</li>\r\n	<li>dan belum report by filter tanggal.</li>\r\n	<li>buat dan import database msfx ke phpmyadmin</li>\r\n	<li>membuat pengkondisian untuk karyawan yang wajib report dan tidak</li>\r\n	<li>testing pengkondisian karyawan wajib report dan tidak</li>\r\n	<li>edit dan testing filter data report</li>\r\n	<li>edit dan testing query tampil data report</li>\r\n	<li>setup data dan debuging filter tampil data report</li>\r\n</ul>\r\n', '2023-05-11'),
(23, '2023-05-11 16:02:49', '56', '<p>1. Rekon Saldo Akhir Rekening bank dg Accurate<br />\r\n2. Input biaya gaji april<br />\r\n3. Input mutasi dan rekon saldo akhir bca 2 pt/penggajian<br />\r\n4. Input mutasi bank h2h dan pt tgl 1 sd 4 Mei</p>\r\n', '2023-05-11'),
(24, '2023-05-11 16:03:01', '64', '<p><br />\r\n- Bikin tema dan Copywritting Mitos Atau Fakta Untuk SSB<br />\r\n- Desain Cover Motion Grafis PG<br />\r\n- Desain konten Mitos Atau Fakta SSB<br />\r\n- Desain Story&nbsp; Mitos Atau Fakta SSB<br />\r\n- Post Konten Motivasi di Facebook SSB</p>\r\n', '2023-05-11'),
(25, '2023-05-11 16:04:53', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Membuat Estimasi Pajak 2023<br />\r\n7. Revisi PPh21<br />\r\n8. Rekonsiliasi Pembelian</p>\r\n', '2023-05-11'),
(26, '2023-05-11 16:06:57', '59', '<p>1. Rekap Transaksi All Server<br />\r\n2. Rekap Hasil Gosokan Tim Voucher<br />\r\n3. Flash Sale Tsel Data PH<br />\r\n4. Diskusi Flyer dg tim Design<br />\r\n5. Produk Promo Voucher H2H<br />\r\n6. Produk Promo Aktivasi PH<br />\r\n7. Croscek Produk Close/Gangguan<br />\r\n8. Croscek Produk Naik/Turun<br />\r\n9. Rekap Penjualan Voucher<br />\r\n10. Cari Jalur Terbaik/Termurah<br />\r\n11. Follow Up Agen H2H<br />\r\n*Atm Pulsa<br />\r\n*JayaArt<br />\r\n*ADRAJAYA<br />\r\n*Plusenamdua<br />\r\n*SAGARA<br />\r\n*Thalita<br />\r\n*haitronik<br />\r\n*Payfi<br />\r\n*YRELOAD<br />\r\n*VIE VOUCHER<br />\r\n*TRANZ PULSA<br />\r\n*Solutipay<br />\r\n*RAJAWALI<br />\r\n*Darra<br />\r\n12. Rekap Orderan Voucher<br />\r\n*Robby<br />\r\n*Forteen<br />\r\n*Samsul<br />\r\n*Windi<br />\r\n*Atun<br />\r\n*Selvy<br />\r\n*PH<br />\r\n*Nizar</p>\r\n', '2023-05-11'),
(27, '2023-05-11 16:07:40', '65', '<p>Design1 Report Harian Tanggal 11 Mei 2023</p>\r\n\r\n<p>- Design Tutorial Transaksi XL Axis XML<br />\r\n- Design Cover Blog XML<br />\r\n- Design Banner Agen XML<br />\r\n- Design Flash Sale Telkomsel SSB<br />\r\n- Design Loker Desain Grafis&nbsp;</p>\r\n', '2023-05-11'),
(28, '2023-05-11 16:11:05', '67', '<p>-Motion PH<br />\r\n-Design Flayer SSB Topup Gojek<br />\r\n-Design Flayer SSB Topup Shopeepay<br />\r\n-Design Flayer PG Topup Gojek&nbsp;<br />\r\n-Design Flayer PG Topup Shopeepay<br />\r\n-Design Flayer PH Produk FlashSale Telkomsel</p>\r\n', '2023-05-11'),
(29, '2023-05-11 16:38:50', '52', '<p>-hitung equoto ototepe tgl 10<br />\r\n-briefing sales baru (diah)<br />\r\n*info target<br />\r\n*info maintence agen bayu, kasih list dl , alamat dan no hp<br />\r\n*info SOP saldo<br />\r\n*info sop absensi dan report<br />\r\n*pengenalan aplikasi dan fungsinya<br />\r\n-bc pake wa qiscus info ke dl bayu, sdh ada sales pengganti<br />\r\n-diskusi dgn pak yudi dan nina<br />\r\n-cek hrg tsel tf di pasaran server<br />\r\n-nego gs ke golden , blm dpt<br />\r\n-update harga tsel tp mengikuti pasaran h2h<br />\r\n-delegasi anam buat design seragam<br />\r\n-koordinasi dgn anam, hrd, alin dan hari cc rolling jadwal libur<br />\r\n*anam: mau didiskusikan dulu<br />\r\n*hari: mau dibicarakan dengan keluarga dulu<br />\r\n-menegaskan rolling jadwal krna sampai pulang masih blm ada keputusan<br />\r\n-review caption promosi dari mo, sdh mulai pas bisa mengikuti<br />\r\n-delegasi ramdita buat produk pln yg bisa cek nama dulu baru lanjut bayar<br />\r\n-review surat rekomendasi dari tiara, koordinasi pembuatan surat dg hrd<br />\r\n-review lap estimasi pph29 dr nina</p>\r\n', '2023-05-11'),
(30, '2023-05-11 16:39:10', '58', '<p><br />\r\n-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-11'),
(31, '2023-05-11 16:40:18', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 11 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Gosok &amp; Upload voucher<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Order voucher ke SPL : Damas ,Daffina<br />\r\n- Cek / bongkaran orderan voucher tgl 11/05 yg sdh dtg<br />\r\n&nbsp;( SPL : ASWA,FAVOUR,DAFFINA)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari jumat<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-11'),
(32, '2023-05-11 17:30:21', '54', '<p>11 mei 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC 11 Mei 23</li>\r\n	<li>Rekap KPI Retail, CS, support, OPR, SDP &amp; PH, data voucher</li>\r\n	<li>Membuatkan kontrak untuk diah marketing area jeruk legi</li>\r\n	<li>Menjelaskan sop kerja dan absensi ke diah</li>\r\n	<li>Minta di buatkan flyer lowongan untuk design</li>\r\n	<li>Konfirmasi atur ulang jadwal tim kreatif</li>\r\n	<li>Membuat surat rekomendasi kerja</li>\r\n	<li>Screening cv</li>\r\n	<li>Mencari refrensi design terbaru</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-11'),
(33, '2023-05-13 09:02:35', '70', '<p>11 mei 2023<br />\r\n- Pantau trx SU<br />\r\n- Cek tinjauan publish apk PH (sudah up)<br />\r\n- Info cs PH , apk sudah up di playstore<br />\r\n- Info cs PG jalur gojek murah dan info untuk promo kan produk gojek dan shopee (trx sepi) dan meminta untuk membuat flayer bahan promo<br />\r\n- Cek L/R SSB dan info ke cs SSB untuk cek produk yang margin nya perlu diperbaiki<br />\r\n- Cek L/R PG dan info ke cs SSB untuk cek produk yang margin nya perlu diperbaiki<br />\r\n- Cek equoto , rekapan invent SSB<br />\r\n- Cek equoto , rekapan invent PG<br />\r\n- Order three transfer 8.7% 5chip dan menyiapkan chipnya<br />\r\n- Order tsel transfer 13.9% 15chip dan menyiapkan chipnya<br />\r\n- Set harga three transfer untuk xml dibawah harga spl<br />\r\n- Set produk pln yg bisa cek nama dulu baru lanjut bayar (sudah bisa)<br />\r\n- Info opr retail ada produk baru (pln cek nama dlu baru lanjut bayar)<br />\r\n- Set harga tsel transfer untuk xml dibawah harga spl<br />\r\n- Info cs SSB jalur gojek murah dan info untuk promo kan produk gojek dan shopee (trx sepi) dan meminta untuk membuat flayer bahan promo</p>\r\n', '2023-05-11'),
(34, '2023-05-12 08:31:12', '57', '<ul>\r\n	<li>test</li>\r\n	<li>test2</li>\r\n</ul>\r\n', '2023-05-12'),
(35, '2023-05-12 16:01:23', '68', '<ul>\r\n	<li>fix error halaman beranda(menampilkan report kemaren)</li>\r\n	<li>edit query syntax tamil data report terkini</li>\r\n	<li>membuat repositori lokal untuk sc penjualan</li>\r\n	<li>membuat repositori remote untuk sc penjualan</li>\r\n	<li>push (backup) sc penjualan ke repositori remote</li>\r\n	<li>membuat repositori lokal untuk sc auto insert php</li>\r\n	<li>membuat repositori remote (github) untuk auto insert php&nbsp;</li>\r\n	<li>push (backup) sc auto insert php ke repositori remote</li>\r\n	<li>install radmin pc marketing online2</li>\r\n	<li>rubah konsep tampilan halaman tugas menjadi nav-tabs</li>\r\n</ul>\r\n', '2023-05-12'),
(36, '2023-05-12 16:03:11', '64', '<p>- Bikin tema dan Copywritting Hiburan PH<br />\r\n- Bikin tema dan Copywritting Pertanyaan SDP<br />\r\n- Desain Konten Hiburan PH<br />\r\n- Desain Story Hiburan PH &nbsp;<br />\r\n- Desain konten Pertanyaan SDP<br />\r\n- Desain Story Pertanyaan SDP<br />\r\n- Post Konten Doa Pulsa Genggam<br />\r\n- Story Konten Pulsa Genggam</p>\r\n', '2023-05-12'),
(37, '2023-05-12 16:03:17', '67', '<p>-Motion PH<br />\r\n-Design Banner Deposit TF Bank<br />\r\n-Design Flayer PH Aktivasi Voucher XL<br />\r\n-Design Flayer PH Aktivasi Voucher XL Combo<br />\r\n-Design Flayer Icon SSB</p>\r\n', '2023-05-12'),
(38, '2023-05-12 16:04:26', '65', '<p>Design1 Report Harian Tanggal 12 Mei 2023</p>\r\n\r\n<p>- Design Loker Customer Service<br />\r\n- Update design banner hati hati penipuan<br />\r\n- Design seragam baru XM</p>\r\n', '2023-05-12'),
(39, '2023-05-12 16:18:10', '59', '<p>1. Rekap Transaksi All Server<br />\r\n2. Rekap Hasil Gosokan Tim Voucher<br />\r\n3. Diskusi Flyer dan Motion dg tim Design<br />\r\n4. Mengingatkan Cs PH BC Aplikasi<br />\r\n5. Croscek Pendingan Transaksi<br />\r\n6. Produk Promo Indosat Reguler<br />\r\n7. Croscek Produk Close/Gangguan<br />\r\n8. Croscek Produk Naik/Turun<br />\r\n9. Rekap Penjualan Voucher<br />\r\n10. Cari Jalur Terbaik/Termurah<br />\r\n11. Croscek Margin Transaksi<br />\r\n12. BC PLN Promo di WA Blast<br />\r\n13. Backup SDP Cs Jumatan<br />\r\n14. Croscek Ulang Orderan Voucher<br />\r\n15. Follow Up Agen H2H<br />\r\n*kharisma<br />\r\n*Megabiller<br />\r\n*Optimus<br />\r\n*POWER RANGERS<br />\r\n*Jelitareload<br />\r\n*Graha Pulsa<br />\r\n*Ghofir Tronik<br />\r\n*Ashmedia<br />\r\n*Sukses Tronik<br />\r\n16. Rekap Orderan Voucher<br />\r\n*Sari<br />\r\n*PH<br />\r\n*Lastri</p>\r\n', '2023-05-12'),
(40, '2023-05-12 16:25:28', '56', '<p>1. Rekon Saldo Akhir Rekening bank dg Accurate</p>\r\n\r\n<p>2. Rekap mutasi bank h2h dan pt tgl 9, 10, 11 April</p>\r\n\r\n<p>3. Menyelesaikan input mutasi bank h2h dan pt tgl 4 Mei</p>\r\n', '2023-05-12'),
(41, '2023-05-12 16:25:29', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Membuat Invoice</p>\r\n', '2023-05-12'),
(42, '2023-05-12 16:36:03', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 12 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Gosok &amp; Upload voucher<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Order voucher ke SPL : Damas,Daffina,favour,citra,three muji<br />\r\n- Cek / bongkaran orderan voucher tgl 11/05 yang sdh datang : (SPL: Damas)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari sabtu<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-12'),
(43, '2023-05-13 09:02:17', '70', '<p>12 mei 2023<br />\r\n- Cek otomax PG dan PH tidak bisa diremot (sudah normal)<br />\r\n- Update addon bank PG rek angga (BCA)<br />\r\n- Ganti userid (rek angga) di addon bank BNI , BRI PG<br />\r\n- Info cs PG , mandiri sekarang pake addon mandiri mcm di pc 171<br />\r\n- Info cs PG untuk update banner dan flayer deposit (rek angga)<br />\r\n- Cek dan revisi design flayer/banner rekening PG rek atas nama angga<br />\r\n- Cek dan pasang chip tsel dan three PG (ganti chip)<br />\r\n- Set regex produk PBB di retail<br />\r\n- Info cs PG untuk update banner dan flayer di aplikasi<br />\r\n- Backup opr h2h dan SSB (jumatan)<br />\r\n- Followup cs SSB titipan cs tadi malam (cetak struk)<br />\r\n- Packing dan kirim paket tukar poin PG<br />\r\n- Cek addon isimple SSB error (sudah normal)<br />\r\n- Cek masa aktif chip<br />\r\n- Cek otomax ototepe tidak respon (sudah normal)<br />\r\n- Set gagal trx cuan di retail<br />\r\n- Set sukses aktv voc isat di retail</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-12'),
(44, '2023-05-12 17:01:10', '54', '<p>12 mei 2023<br />\r\n-&nbsp; Kroscek report harian &amp; report harian Design, CC 11-12 Mei 23<br />\r\n-&nbsp; Rekap KPI Retail, CS, support, OPR, SDP &amp; PH, marketing, data voucher&nbsp;<br />\r\n-&nbsp; Menerima dan Membuatkan berita serah terima ijazah untuk ijazah diah&nbsp;<br />\r\n-&nbsp; Request di buatkan flyer lowongan&nbsp; untuk posisi costumer service<br />\r\n-&nbsp; Revisi flyer lowongan untuk posisi desain grafis&nbsp;<br />\r\n-&nbsp; Diskusi dengan pak yudi&nbsp;<br />\r\n-&nbsp; Diskusi dengan tim kreatif&nbsp;<br />\r\n-&nbsp; Update Instagram lowongan kerja di akun ig HRD Xmltronik&nbsp;<br />\r\n-&nbsp; Cek komplain di oto SDP &amp; PH dari tanggal 1-11 mei</p>\r\n', '2023-05-12'),
(45, '2023-05-13 15:57:18', '64', '<p>- Desain Konten IG Hari Kebangkitan Nasional<br />\r\n- Desain Konten Story IG Kebangkitan Nasional<br />\r\n- Desain APK Kebangkitan Nasional<br />\r\n- Bikin tema dan Copywritting Viral (Serba-serbi warga Pas Tau Coldplay) Untuk XML &nbsp;<br />\r\n- Desain Konten Viral (Serba-serbi warga Pas Tau Coldplay) Untuk XML &nbsp;<br />\r\n- Edit video Viral (Serba-serbi warga Pas Tau Coldplay) Untuk XML - Desain Story Viral (Serba-serbi warga Pas Tau Coldplay) Untuk XML &nbsp;<br />\r\n- Post Konten Hiburan Pulsa Hoki<br />\r\n- Story Konten Hiburan Piulsa Hoki</p>\r\n', '2023-05-13'),
(46, '2023-05-13 16:00:18', '56', '<p>1. Rekon Saldo Akhir Rekening bank dg Accurate<br />\r\n2. Rekap mutasi bank h2h dan pt tgl 12 Mei<br />\r\n3. Rekap mutasi bank retail tgl 9 - 12 Mei<br />\r\n4. Input mutasi bank h2h dan pt tgl 5 dan 7 Mei (accurate)<br />\r\n5. Rekap transaksi penjualan, pembelian dan jkp tgl 9 - 12 Mei<br />\r\n6. Input biaya sms1900/kas e wallet (accurate)<br />\r\n7. Input komisi dan tukar komisi retail (accurate)</p>\r\n', '2023-05-13'),
(47, '2023-05-13 16:00:26', '65', '<p>Design1 Report Harian Tanggal 13 Mei 2023</p>\r\n\r\n<p>- Design template konten XML<br />\r\n- Design promo indosat data unlimited PH<br />\r\n- Design promo smartfren data unlimited PH<br />\r\n- Update design free fire super promo</p>\r\n', '2023-05-13'),
(48, '2023-05-13 16:00:32', '68', '<ul>\r\n	<li>pindah PC accounting 1 dan 2</li>\r\n	<li>pindah PC CS SDP dan PG</li>\r\n	<li>merubah logic dan ketentuan request penugasan</li>\r\n	<li>buat query dapatkan data semua karyawan</li>\r\n	<li>testing query dapatkan data semua karyawan</li>\r\n	<li>buat query dapatkan jumlah data tugas masuk,&nbsp; keluar dan selesai semua karyawan</li>\r\n	<li>testing query dapatkan jumlah data tugas masuk,&nbsp; keluar dan selesai semua karyawan</li>\r\n	<li>debuging dan konfigurasi tampil data jumlah tugas keluar, masuk dan selesai.</li>\r\n	<li>perbaikan pengkondisian syntax tampil data report terbaru sisi karyawan</li>\r\n	<li>perbaikan pengkodisian syntax tampil data karyawan belum report</li>\r\n</ul>\r\n', '2023-05-13'),
(49, '2023-05-13 16:06:58', '54', '<p>13 mei 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC 12 Mei 23</li>\r\n	<li>Rekap KPI Retail, CS, support, OPR, SDP &amp; PH, marketing, data voucher</li>\r\n	<li>Update akun linkedin dan post lowker desain grafis dan costumer shift</li>\r\n	<li>Mencari refrensi untuk pembuatan twibbon untuk post di ig hrd</li>\r\n	<li>Request pembuatan twibbon ke design</li>\r\n	<li>Membuat jadwal untuk bulan juni (kurang opr dan support)</li>\r\n	<li>Rekap penambahan agen dan share grup</li>\r\n	<li>Menegur dika karna mengajukan tukar shift mendadak</li>\r\n	<li>Rekap form</li>\r\n</ul>\r\n\r\n<p>1. form tukar shift tanggal 13 mei an dika, tukar shift menjadi siang (ada acara pribadi)</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-13'),
(50, '2023-05-13 16:08:40', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Membuat Invoice<br />\r\n7. Input Mutasi Bank H2Htgl 6 April (accurate)</p>\r\n', '2023-05-13'),
(51, '2023-05-13 16:10:50', '59', '<p>1. Rekap Transaksi All Server<br />\r\n2. Rekap Hasil Gosokan Tim Voucher<br />\r\n3. Req Flyer Promo ke tim Design<br />\r\n4. Croscek Pendingan Transaksi<br />\r\n5. Croscek Produk Close/Gangguan<br />\r\n6. Croscek Produk Naik/Turun<br />\r\n7. Croscek Margin Transaksi<br />\r\n8. Cari Jalur Terbaik/Termurah<br />\r\n9. Rekap Penjualan Voucher<br />\r\n10. Croscek SO Voucher<br />\r\n11. Follow Up Agen H2H<br />\r\n12. Promo Indosat Unlimited PH<br />\r\n13. Promo Smart Unlimited PH<br />\r\n14. Nego Harga ke SPL<br />\r\n15. Rekap Orderan Voucher<br />\r\n*Sarah<br />\r\n*Retno<br />\r\n*Samsul<br />\r\n*PH<br />\r\n*Hendrik<br />\r\n*Forteen<br />\r\n*Robby</p>\r\n', '2023-05-13'),
(52, '2023-05-13 16:57:01', '70', '<p>13 mei 2023<br />\r\n- Cek masa aktif chip tsel dan three tp<br />\r\n- Order three transfer 8.7%<br />\r\n- Menyiapkan dan memasang chip three transfer<br />\r\n- Set harga three transfer untuk xml dibawah harga spl 8.4%<br />\r\n- Update kuesioner PG di console<br />\r\n- Cek transaksi SSB dan PG<br />\r\n- Followup MK SSB tanya kendala trx dan produk yang ramai<br />\r\n- Info cs SSB untuk membuat produk dana admin 500<br />\r\n- Info cs SSB untuk menurunkan produk aktivasi<br />\r\n- Info cs SSB mengarahkan pln ke jalur yang murah dan lancar<br />\r\n- Cek rekapan dan equoto SSB tgl 11 dan 12<br />\r\n- Cek rekapan dan equoto PG tgl 11 dan 12<br />\r\n- Pantau trx su<br />\r\n- Mencari jalur produk promo untuk SSB<br />\r\n- Info cs SSB untuk mengarahkan telkomsel reguler ke jalur yang murah dan lancar<br />\r\n- Info cs SSB untuk membuat produk super promo telkomsel (req MK)<br />\r\n- Info cs SSB untuk pantau harga spl<br />\r\n- Cek L/R SSB dan info ke cs SSB untuk cek produk yang margin nya perlu diperbaiki<br />\r\n- Cek L/R PG dan info ke cs SSB untuk cek produk yang margin nya perlu diperbaiki<br />\r\n- Cek tinjauan keamanan data (kuesioner PG) sudah ditinjau</p>\r\n', '2023-05-13'),
(53, '2023-05-13 17:15:53', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 13 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Gosok &amp; Upload voucher<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- SO voucher<br />\r\n- Cek / bongkaran orderan voucher tgl 11/05 yang sdh datang : (SPL: Damas,Daffina)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari minggu dan senin<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-13'),
(54, '2023-05-14 15:07:06', '59', '<p>ðŸ‘‰ðŸ» Backup SDP (Tri Cuti)<br />\r\nðŸ‘‰ðŸ» Cek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Setting Harga<br />\r\nðŸ‘‰ðŸ» Update Harga Jual<br />\r\nðŸ‘‰ðŸ» Deposit Suplier<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Minus<br />\r\nðŸ‘‰ðŸ» Rekap Saldo Bank<br />\r\nðŸ‘‰ðŸ» Croscek Inventory<br />\r\nðŸ‘‰ðŸ» Cek Verifikasi Akun Aplikasi</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-14'),
(55, '2023-05-14 16:05:58', '67', '<p>-Design Flash Sale Tri XML<br />\r\n-Design SDP Produk PLN<br />\r\n-Design PH Promo Mobile Legends<br />\r\n-Design Lanyard</p>\r\n', '2023-05-14'),
(56, '2023-05-14 16:30:16', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-membuat survey kepuasan pelanggan</p>\r\n', '2023-05-14'),
(57, '2023-05-14 16:35:52', '52', '<p>-hitung equoto ototepe tgl 14<br />\r\n-pantau ototepe habiskan sisa sisa saldo<br />\r\n-cek web rebahan blm bisa di akses, konfirmasi di grup dan ke pakyudi<br />\r\n-cek cek harga tp golden 13%, hendri 12.3%<br />\r\n-order tsel tp 39jt rate 13% golden<br />\r\n-cek hrg tsel tf di pasaran server , set turunkan harga<br />\r\n-cek kinerja alin design baru, delegasi buat design lanyard<br />\r\n-nagih kerjaan alin ke marketing 1 dan 2<br />\r\n-cek kpi opr, masih ada yg belum pas info ke hrd<br />\r\n-cek kpi market 1 dan 2 ada yg kembar, info ke masing2<br />\r\n-nagih kurangan vocer ke mas adit<br />\r\n-cari perdana tsel<br />\r\n-cek email pulsagenggam, ada notif domain blm di bayar, konfirmasi pakyudi, delegasi bayar ke cs pg<br />\r\n-cek dan konfirmasi angga bri token pg belum bisa login<br />\r\n-review link survey kepuasan pelanggan h2h dari marketing&nbsp; &raquo; https://docs.google.com/forms/d/1kqX7fhjcVu8fGdmfPyxkbkePO4ql3n5EIryZGqS06KM/viewform?edit_requested=true</p>\r\n', '2023-05-14'),
(58, '2023-05-15 16:01:38', '65', '<p>- Design promo telkomsel reguler SSB&nbsp;<br />\r\n- Design Icon Sub menu Maxim PH<br />\r\n- Design Icon Sub menu Maxim Driver PH<br />\r\n- Design Icon Sub menu QRIS PH<br />\r\n- Design loker operator &amp; cs server&nbsp;<br />\r\n- Design hari besar Kenaikan isa almasih XML<br />\r\n- Design Banner hari besar Kenaikan isa almasih XML<br />\r\n- Design Story hari besar Kenaikan isa almasih XML<br />\r\n- Design hari besar Kenaikan isa almasih PG<br />\r\n- Design Banner hari besar Kenaikan isa almasih PG<br />\r\n- Design Story hari besar Kenaikan isa almasih PG</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-15'),
(59, '2023-05-15 16:02:44', '56', '<p>1. Rekon Saldo Akhir Rekening bank dg Accurate<br />\r\n2. Rekap mutasi bank h2h, retail dan pt tgl 13, 14 Mei<br />\r\n3. Input mutasi bank h2h dan pt tgl 7, 8 dan 10 Mei (accurate)<br />\r\n4. Rekap stok sales, cash sales dan cash vocuher<br />\r\n5. Input biaya sms1900/kas e wallet (accurate)</p>\r\n', '2023-05-15'),
(60, '2023-05-15 16:03:34', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Mutasi Bank H2Htgl 9,11,12 Mei (accurate)</p>\r\n', '2023-05-15'),
(61, '2023-05-15 16:04:31', '67', '<p>-Design Lanyard<br />\r\n-Design Banner Hari Besar Kenaikan Isa Almasih SDP<br />\r\n-Design Flayer Hari Besar Kenaikan Isa Almasih SDP<br />\r\n-Design Story Hari Besar Kenaikan Isa Almasih SDP<br />\r\n-Design Banner Hari Besar Kenaikan Isa Almasih SSB<br />\r\n-Design Story Hari Besar Kenaikan Isa Almasih SSB<br />\r\n-Design Flayer Hari Besar Kenaikan Isa Almasih SSB<br />\r\n-Design Paket Nelpon Telkomsel XML</p>\r\n', '2023-05-15'),
(62, '2023-05-15 16:05:43', '68', '<ul>\r\n	<li>perbaikan bug tampilan halaman tugas superadmin</li>\r\n	<li>debuging data tugas</li>\r\n	<li>edit konfigurasi waktu retest auto insert dengan jam yang ditentukan.</li>\r\n	<li>pembuatan dan testing query penghitung jumlah total tugas masuk perkaryawan</li>\r\n	<li>pembuatan dan testing query penghitung jumlah total tugas keluar perkaryawan</li>\r\n	<li>pembuatan dan testing query penghitung jumlah total tugas proses perkaryawan</li>\r\n	<li>pembuatan dan testing query penghitung jumlah total tugas selesai perkaryawan</li>\r\n	<li>debuging data jumlah total tugas selesai, keluar, proses dan selesai.</li>\r\n	<li>perbaikan tampil data tugas keluar perkaryawan</li>\r\n	<li>setting scaner pada printer pc mba zulfa</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-15'),
(63, '2023-05-15 16:08:46', '58', '<p>Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-akuisisi mitra lama</p>\r\n', '2023-05-15'),
(64, '2023-05-15 16:15:52', '52', '<p>-cek kendala ph , addon qris tdk mau login<br />\r\n-nagih design hari besar ke tim design<br />\r\n-update kalender konten<br />\r\n-cek design hari besar alin, mengarahkan revisi sedikit<br />\r\n-cek design lanyard alin masih blm cocok, mengarahkan perpaduan warna<br />\r\n-rekap dan redeem kurangan vocer dari mas imam tsel<br />\r\n-menegur wildan menjawab komplen agen terbawa suasana, mengarahkan utk tetap memberi pelayanan terbaik<br />\r\n-hitung equoto ototepe tgl 14<br />\r\n-order perdana tsel 25pcs hrg 16500 ke andi, cek masa aktif<br />\r\n-menanyakan progress lutfi di cs voucer (masih lumayan byk yg revisi)<br />\r\n-info ke zalfa sdh tdk gosok voucer/gosok ketika urgent, mulai maintence waktu, persiapan vani shift<br />\r\n-rekap pulsa tp orderan kemaren, tagih yg blm masuk ke golden<br />\r\n-mengarahkan wildan dalam followup agen retail<br />\r\n-ngajarin yogi mo cek agen yg daftar, dan report harian<br />\r\n-ngajarin yogi mo cara pasang fb ads<br />\r\n-mengarahkan mo apabila ada yg ditanyakan audience bisa langsung tanyakan ke cs server yg ditanyakan.<br />\r\n-scan dokumen nobu, siapkan company profile<br />\r\n-cari tau cara jualan pulsa di shopee, test up produk</p>\r\n', '2023-05-15'),
(65, '2023-05-15 16:20:24', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 15 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Gosok &amp; Upload voucher<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 12/05 yang sdh datang : (SPL:Daffina,favour)<br />\r\n- Cek / bongkaran orderan voucher tgl 15/05 yang sdh datang : (SPL:Damas)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari selasa<br />\r\n- Menyiapkan orderan offline<br />\r\n&nbsp;&nbsp; &nbsp;1. Windi<br />\r\n&nbsp;&nbsp; &nbsp;2. Tofu<br />\r\n&nbsp;&nbsp; &nbsp;3. YT<br />\r\n&nbsp;&nbsp; &nbsp;4. Syamsul<br />\r\n&nbsp;&nbsp; &nbsp;5. PH<br />\r\n&nbsp;&nbsp; &nbsp;6. Kafka Cell<br />\r\n&nbsp;&nbsp; &nbsp;7. Hendrik<br />\r\n&nbsp;&nbsp; &nbsp;8. Teguh<br />\r\n- Mengantar orderan voucher (Tofu,YT,Syamsul) ke konter<br />\r\n- Rekap target voucher</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-15'),
(66, '2023-05-16 16:00:34', '68', '<ul>\r\n	<li>perbaikan jaringan pc support</li>\r\n	<li>pindahan dan setup pc hrd</li>\r\n	<li>edit query tampil data report</li>\r\n	<li>pembuatan halaman detail rekap tugas perkaryawan dari untuk administrator</li>\r\n	<li>pembuatan dan testing query counter data tugas masuk, keluar, proses dan selesai halaman detail rekap tugas.</li>\r\n	<li>debuging count data tugas masuk keluar proses dan detail rekap tugas halaman administrator.</li>\r\n	<li>pembuatan query dan testing tampil data tugas masuk, keluar, proses dan selesai perkaryawan untuk halaman detail rekap tugas.</li>\r\n	<li>debuging datadata tugas masuk, keluar, proses dan selesai perkaryawan untuk halaman detail rekap tugas.</li>\r\n	<li>backup source code ke repositori local</li>\r\n	<li>backup source code ke repositori remote(github)</li>\r\n	<li>set category dan foto artikel cara bayar tagihan indihome</li>\r\n	<li>set category dan foto artikel cara pesan tiket secara online</li>\r\n</ul>\r\n', '2023-05-16'),
(67, '2023-05-16 16:02:50', '65', '<p>- Design hari besar Kenaikan isa almasih PH<br />\r\n- Design Banner hari besar Kenaikan isa almasih PH<br />\r\n- Design Story hari besar Kenaikan isa almasih PH<br />\r\n- Design icon dompet sakti xml</p>\r\n', '2023-05-16'),
(68, '2023-05-16 16:03:08', '67', '<p>-Design TopUp Dana XML<br />\r\n-Design TopUp Shopeepay XML<br />\r\n-Design TopUp Gopay XML<br />\r\n-Design Spesial Promo Axis PH<br />\r\n-Design Pemenang GiveAway<br />\r\n-Design Lanyard<br />\r\n-Design Blog XML Cara Bayar Tagihan Indihome<br />\r\n-Design Blog XML Cara Pesan Tiket Secara Online<br />\r\n-Design Telkomsel Data Flash XML</p>\r\n', '2023-05-16'),
(69, '2023-05-16 16:32:41', '102', '<p>REPORT HARIAN 16 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Gosok &amp; Upload voucher<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Order voucher (SPL : Daff,Otim,Aswa,MujiK ,Muji three,Toni,Damas,Favour)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari rabu<br />\r\n- Menyiapkan orderan PG dan PH<br />\r\n- Rekap target voucher</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-16'),
(70, '2023-05-16 16:11:02', '59', '<p>1. Rekap Transaksi All Server<br />\r\n2. Rekap Hasil Gosokan Tim Voucher<br />\r\n3. Req Flyer Promo ke tim Design<br />\r\n4. Croscek Pendingan Transaksi<br />\r\n5. Croscek Produk Close/Gangguan<br />\r\n6. Croscek Produk Naik/Turun<br />\r\n7. Croscek Margin Transaksi<br />\r\n8. Cari Jalur Terbaik/Termurah<br />\r\n9. Promo Axis Data Bronet<br />\r\n10. Merencanakan Produk Flashsale<br />\r\n11. Pengumuman Giveaway PH<br />\r\n12. Iklan Tiktok PH<br />\r\n13. Rekap Transaksi Voucher Daffina<br />\r\n14. Follow Up Agen H2H<br />\r\n*Mitra Cellular<br />\r\n*zona Reload<br />\r\n*rain cell<br />\r\n*anantapulsa<br />\r\n*KAWAKIB RELOAD<br />\r\n*sipusku<br />\r\n*RBP RELOAD<br />\r\n*Lazim Reload<br />\r\n*pulsa bahagia<br />\r\n15. Rekap Order Voucher<br />\r\n*Robby</p>\r\n', '2023-05-16'),
(71, '2023-05-16 16:13:43', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Mutasi Bank H2Htgl 13,12 Mei (accurate)<br />\r\n7. Input Pembelian Transaksi 1,2 mei (accurate)</p>\r\n', '2023-05-16'),
(72, '2023-05-16 16:15:46', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin</p>\r\n\r\n<p>AIGOMS1<br />\r\nAIGOMS2<br />\r\nAIGOMS3<br />\r\nAIGOMS5<br />\r\nIVID3<br />\r\nIVID4<br />\r\nIVID1<br />\r\nIVID2<br />\r\nMTIX100<br />\r\nMTIX150<br />\r\nMTIX200<br />\r\nMTIX250<br />\r\nMTIX300<br />\r\nMTIX350<br />\r\nMTIX400<br />\r\nMTIX450<br />\r\nMTIX500<br />\r\nVID1<br />\r\nFF400<br />\r\nFF405<br />\r\nFF475</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-16'),
(73, '2023-05-16 16:25:23', '56', '<p>1. Rekon Saldo Akhir Rekening bank dg saldo bank di accurate<br />\r\n2. Rekap transaksi penjualan, pembelian dan jkp tgl 13, 14, 15 Mei<br />\r\n3. Input mutasi bank retail tgl 9 sd 14 Mei (accurate)<br />\r\n4. Input transaksi penjualan tgl 1 sd 15 Mei (accurate)<br />\r\n5. Input transaksi jkp tgl 1, 2, 3 Mei (accurate)<br />\r\n6. Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n7. Input biaya sms1900/kas e wallet (accurate)<br />\r\n8. Input komisi dan tukar komisi retail (accurate)<br />\r\n9. Input poin retail (accurate)</p>\r\n', '2023-05-16'),
(74, '2023-05-16 16:55:30', '52', '<p>-nagih design hari besar ph ke anam<br />\r\n-cek design lanyard alin masih menambahkan sedikit revisi<br />\r\n-hitung equoto ototepe tgl 15<br />\r\n-konfirmasi order lanyard dan id card ke zona<br />\r\n-menanyakan&nbsp; lutfi progress di cs voucer by chat, sdh bisa mengikuti tinggal lebih teliti lg<br />\r\n-diskusi posisi kerja karyawan by chat dgn pakyudi, konfirmasi hrd akan dipindah<br />\r\n-memberi label pada chips baru ototepe 25chips<br />\r\n-cari stok tsel tp, golden 12.7%, hendri 13.3% belum ada yg masuk<br />\r\n-review hasil interview hrd 1 org<br />\r\n-cek salah set parsing ph, konfirmasi pakyudi<br />\r\n-menyampaikan ganti rugi ke dika , mengarahkan utk lebih teliti<br />\r\n-set terminal dan modul chips baru, buat catatan port baru ototepe<br />\r\n-nego harga ke hendri, deal 14%</p>\r\n', '2023-05-16'),
(75, '2023-05-17 12:18:29', '70', '<p>16 Mei 2023<br />\r\n- update otomax PG untuk login BRI ibbiz PG&nbsp; di otomax<br />\r\n- update otomax SDP untuk login BRI ibbiz SDP di otomax<br />\r\n- update otomax PH untuk login BRI ibbiz PH di otomax<br />\r\n- update otomax SSB untuk login BRI ibbiz SSB di otomax (belum bisa)<br />\r\n- mencoba login bri ibbiz SSB di web (corporate id terblokir - salah username karena belum tau username newbiz di note SSB masih username lama)<br />\r\n- call center bri untuk membuka blokir usernme SSB , tidak bisa lewat call center (harus datang ke kantor bri)<br />\r\n- info cs SSB untuk chat bu luly minta tolong datang ke kantor bri untuk membuka blokiran corporate id bri<br />\r\n- update link kebijakan privasi SDP di web android dan di google console<br />\r\n- publish apk SDP<br />\r\n- minta design stiker PH,SDP,PG,SSB ke design (req MK - MK mau cetak stiker sendiri)<br />\r\n- nego three transfer dan order three transfer chip 5jt<br />\r\n- cek chip three PG yang error (sudah normal)<br />\r\n- cek rekapan dan equoto SSB tgl 14 dan 15<br />\r\n- cek rekapan dan equoto PG&nbsp; tgl 14 dan 15<br />\r\n- menyiapkan file untuk update otomax h2h<br />\r\n- info opr h2h file dan cara&sup2; update otomax h2h , untuk disampaikan ke shift malam<br />\r\n- nego tsel tp dan order tsel tp 14% 20jt dan menyiapkan chip nya<br />\r\n- cek link kebijakan privasi xml di console dan web android</p>\r\n', '2023-05-16'),
(76, '2023-05-17 16:01:17', '68', '<ul>\r\n	<li>seting struktur link post blog xmltronik.com</li>\r\n	<li>install plugin WP Fastest Cache</li>\r\n	<li>bantu setup lighting CC</li>\r\n	<li>setup setting WP Fastest Cache</li>\r\n	<li>install plugin Inline Related Posts</li>\r\n	<li>setup setting Inline Related Posts</li>\r\n	<li>minimalis code dan logic tampil data tugas sesi admin dan pegawai.</li>\r\n	<li>perbaikan aplikasi photos tidak bisa buka foto pc desaign1</li>\r\n</ul>\r\n', '2023-05-17'),
(77, '2023-05-17 16:03:39', '65', '<p>Design1 Report Harian Tanggal 17 Mei 2023</p>\r\n\r\n<p>- Update design stiker all server&nbsp;<br />\r\n- Design banner agen arga cell<br />\r\n- Design xl xtra combo flex xml<br />\r\n- Update design id card mba zulfa&nbsp;<br />\r\n- Update design id card mas wildan<br />\r\n- Update design id card mba vani<br />\r\n- Update design id card mas muji<br />\r\n- Update design id card mas aziz<br />\r\n- Update design id card mas eko<br />\r\n- Update design id card mas ades</p>\r\n', '2023-05-17'),
(78, '2023-05-17 16:04:19', '67', '<p>-Design FlashSale Smartfren Data Volume PH<br />\r\n-Design Banner Hari Kebangkitan Nasional PH<br />\r\n-Design Story Hari Kebangkitan Nasional PH<br />\r\n-Design Flayer Hari Kebangkitan Nasional PH<br />\r\n-Design Banner Hari Kebangkitan Nasional SDP<br />\r\n-Design Story Hari Kebangkitan Nasional SDP<br />\r\n-Design Flayer Hari Kebangkitan Nasional SDP<br />\r\n-Design Pemenang GiveAway SDP<br />\r\n-Design TopUp OVO XML</p>\r\n', '2023-05-17'),
(79, '2023-05-17 16:05:38', '64', '<p>- Membuat Tema dan caption writing hari besar kenaikan Isa Al masih semua konten<br />\r\n- Set Lampu Untuk Foto<br />\r\n- Foto Marketing, sales dan Direktur XML mobile untuk ID card Dan profil<br />\r\n- Posting Konten Viral Untuk XML Mobile<br />\r\n- Story Viral Untuk XML Mobile<br />\r\n- Post Konten Mitos Atau fakta SBB<br />\r\n- Story Mitos atau Fakta SSB</p>\r\n', '2023-05-17'),
(80, '2023-05-17 16:05:59', '56', '<p>1. Rekon Saldo Akhir Rekening bank dg saldo bank di accurate<br />\r\n2. Rekap mutasi bank retail, h2h dan pt&nbsp; tgl 15, 16 Mei<br />\r\n3. Input transaksi jkp tgl 4 sd 15 Mei (accurate)<br />\r\n4. Input transaksi pembelian tgl 11, 13, 14 Mei (accurate)<br />\r\n5. Input biaya sms1900/kas e wallet (accurate)</p>\r\n', '2023-05-17'),
(81, '2023-05-17 16:07:36', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Pembelian Transaksi 3,4,5,6,7,8,9,10,12,15 mei (accurate)</p>\r\n', '2023-05-17'),
(82, '2023-05-17 16:10:57', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-open produk baru digiflazz<br />\r\n*xtra combo flex<br />\r\n*paket telpon telkomsel<br />\r\n*free fire<br />\r\n*token pln<br />\r\n*emoney mandiri</p>\r\n', '2023-05-17'),
(83, '2023-05-17 16:12:06', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Pengumuman Giveaway SDP<br />\r\nðŸ‘‰ðŸ» Rekap Harga Modal Voucher<br />\r\nðŸ‘‰ðŸ» Flash Sale Smart PH<br />\r\nðŸ‘‰ðŸ» Foto untuk Id Card<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Croscek Produk Naik/Turun<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Rekap Stok Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Penjualan Voucher<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*Atm Pulsa<br />\r\n*DYODA SERVER<br />\r\n*Erefil<br />\r\n*Arjuna Tronik<br />\r\n*Global Corp<br />\r\n*Data Kita<br />\r\n*Sattronik<br />\r\n*Sunreload<br />\r\n*Ipay<br />\r\n*Odepulsa<br />\r\n*Digital Pulsa<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Samsul<br />\r\n*Robby<br />\r\n*PH<br />\r\n*Galuh<br />\r\n*PG</p>\r\n', '2023-05-17'),
(84, '2023-05-17 16:28:30', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 17 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Gosok &amp; Upload voucher<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Update rekapan<br />\r\n- Cek / bongkaran orderan voucher tgl 16/05 yang sdh datang : (SPL: Otim,Citra,MujiK)<br />\r\n- Cek / bongkaran orderan voucher tgl 17/05 yang sdh datang : (SPL: Damas)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari jumat<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-17'),
(85, '2023-05-17 18:40:28', '52', '<p>-diskusi dgn sales<br />\r\n*Mas muji menanyakan progres ades di pwt<br />\r\n*ades persaingannya lumayan dgn server lokal, tp keunggulan kita jemput bola masih bisa di akuisisi<br />\r\n*eko minta brosur<br />\r\n*muji usul program kursi dicetak utk konter2<br />\r\n*info program akuisisi ke ades dan diah<br />\r\n*menanyakan agen tempo mas muji barangkali sdh ada agen potensi<br />\r\n*menjelaskan sistem tempo ke diah dan ades<br />\r\n*eko menanyakan sistem hapus dl otomatis yg saldo 0<br />\r\n*menyampaikan kurangan target masing2 sales, dan pencapaian nya<br />\r\n*menyampaikan poin bisa ditukar ke saldo, ganti program hadiah setiap tahun tp poin tdk reset<br />\r\n-cek selisih tampungan, konfirmasi pakyudi<br />\r\n-delegasi ph cek equoto real +20jt<br />\r\n-delegasi cc dan tim marketing foto untuk id card<br />\r\n-koordinasi design id card dgn anam<br />\r\n-cari stok tsel tp, golden 14.4% order 128jt<br />\r\n-review hasil interview hrd<br />\r\n-rekap vocer gs<br />\r\n-koordinasi penjualan gs dgn pakyudi by chat , cek stok dan pemakaian<br />\r\n-set harga jual &amp; beli ototepe mengikuti hrg pasar<br />\r\n-cek selisih fu reload konfirmasi pakyudi<br />\r\n-delegasi ramdita downgrade otomax ke versi 4.0.8.11 &raquo; eror<br />\r\n-cek pendingan , test test resend trx<br />\r\n-delegasi ramdita upgrade versi oto 4.1.3.26, 411, 412<br />\r\n-menjelaskan perihal fureload ke shift sore, delegasi kawal ketat</p>\r\n', '2023-05-17'),
(86, '2023-05-17 19:06:30', '70', '<p>17 Mei 2023<br />\r\n- update addon bank XML H2H,RETAIL,PG,PH,SDP,SSB<br />\r\n- cek tinjauan sdp ( sdp sudah up di ps)<br />\r\n- update link kebijakan privasi di web android xml retail<br />\r\n- update link kebijakan privasi di konten aplikasi google console<br />\r\n- update aplikasi xml retail (update link) - sudah up di ps<br />\r\n- coba login bri newbiz SSB di web dan ubah password nya (krna baru pertama kali login)<br />\r\n- info cs SSB perubahan data untuk login bri newbiz dan info untuk mencoba login di web<br />\r\n- cek mandiri SDP error (sudah normal)<br />\r\n- cek mandiri PG error (sudah normal)<br />\r\n- set regex sukses RB<br />\r\n-&nbsp; set regex RB yang gagal dan saldo tidak cukup auto alihkan<br />\r\n- update dan downgrade otomax h2h</p>\r\n', '2023-05-17');
INSERT INTO `pekerjaan` (`id`, `tanggal`, `karyawan`, `pekerjaan`, `tgl`) VALUES
(87, '2023-05-18 16:08:10', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Iklan FB Ads PH<br />\r\nðŸ‘‰ðŸ» Rekap Telegram Agen<br />\r\nðŸ‘‰ðŸ» Croscek Produk Minus<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Update Harga Voucher<br />\r\nðŸ‘‰ðŸ» Cek Stok Voucher di Server Utama<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*Home Payment<br />\r\n*Mabruk<br />\r\n*Craserver<br />\r\n*Ibnu Cell<br />\r\n*IG Reload<br />\r\n*ALKAHFI<br />\r\n*MH Reload<br />\r\n*IPAY<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Teguh<br />\r\n*PH<br />\r\n*Robby<br />\r\n*Sari<br />\r\n*PG</p>\r\n', '2023-05-18'),
(88, '2023-05-18 16:09:52', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-merapikan produk :<br />\r\nDNT<br />\r\nSAKU<br />\r\nSHP<br />\r\nSHD<br />\r\nETL<br />\r\nSDUL<br />\r\nTTF<br />\r\nDEAL<br />\r\nTDM<br />\r\nTTN<br />\r\nFLEX<br />\r\nSMT<br />\r\nDFM<br />\r\nXTP</p>\r\n', '2023-05-18'),
(89, '2023-05-18 16:28:42', '70', '<p>18 Mei 2023<br />\r\n- pantau trx su<br />\r\n- update addon bank SSB versi 240<br />\r\n- update addon bank PG versi 240<br />\r\n- update addon bank PH versi 240<br />\r\n- update addon bank SDP versi 240<br />\r\n- update addon bank Retail versi 240<br />\r\n- update addon bank H2h versi 240<br />\r\n- followup everluck komplenan agen SDP yang paralel apk (hilang dr ps)<br />\r\n- followup agen PG yang paralel apk untuk cek link kebijakan privasi dan fiturhapus akun<br />\r\n- set regex sukses RB h2h (produk dana)<br />\r\n- set gagal RB h2h (gagal manual oleh admin)<br />\r\n- cek telegram PG error (sudah normal)<br />\r\n- pantau forum maxsoft ( isimple sedang gangguan)<br />\r\n- cek addon isimple error , off kan isimple all server karena keterangannya user/pass wrong<br />\r\n- cek isimple sudah normal , dan info ke cs all server untuk input otp di addon isimple masing2<br />\r\n- cek otomax client h2h error (sudah diperbaiki)<br />\r\n- update otomax SSB versi 414 dan cek trx ppob normal atau tidak setelah update versi<br />\r\n- info cs SSB untuk pantau trx ppob dan trx yg lain , jika ada kendala suruh info<br />\r\n- memperbaiki regex gagal di SSB , sebelumnya replay ke agen tidak ada keterangan alasan gagalnya (skrang replay ke agen sudah ada keterangan gagal beserta alasannya)<br />\r\n- order three transfer 8.7% 5jt<br />\r\n- info opr xml untuk tarik three transfer ke PG , harga dibawah spl<br />\r\n- cek rekapan dan equoto SSB tgl 16 dan 17<br />\r\n- cek rekapan dan equoto PG tgl 16 dan 17</p>\r\n', '2023-05-18'),
(90, '2023-05-18 16:33:05', '52', '<p>-hitung equoto ototepe tgl 17<br />\r\n-cek harga pasar tsel tp<br />\r\n-order golden 128jt rate 14.8%<br />\r\n-delegasi ph cek equoto real -20jt, tampungan xml sdh bener<br />\r\n-info cara hitung tpgs01 dgn admin h2h, klop2an hitungan<br />\r\n-mengarahkan wildan cek juga margin dan agen yang narik, jgn hanya menurunkan harga<br />\r\n-cek trx dan margin all server<br />\r\n-promo gs, cek harga2 gs di grup sdh ada yg jual 84.xxx<br />\r\n-menjelaskan rumus hitungan target trx apabila hendak menurunkan harga<br />\r\n-mengarahkan wildan dan giovani rekap data agen h2h beserta telegramnya, buat data yg tdk tarik tsel data (memudahkan promo)<br />\r\n-cek masa aktif chips baru ototepe, dan menambah yg sdh mendekati<br />\r\n-mengarahkan sdp tarik pln ke xml, info marketing buat kode khusus<br />\r\n-skrining cv kandidat ototepe, info hrd pemanggilan interview</p>\r\n', '2023-05-18'),
(91, '2023-05-19 15:52:14', '58', '<p>=REPORT HARIAN 19 Mei 2023=<br />\r\n-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-merapikan produk :<br />\r\nXPRO<br />\r\nFastMedia<br />\r\nPK PULSA<br />\r\nKimi tronik<br />\r\nTop Payment<br />\r\nGLORY PULSA<br />\r\nMITRA PULSA<br />\r\nmutronik2<br />\r\nURC<br />\r\nSurya Sejahtera Globalindo<br />\r\nSRB</p>\r\n\r\n<p>DFM<br />\r\nXTP</p>\r\n', '2023-05-19'),
(92, '2023-05-19 16:00:13', '64', '<p>- Membuat Tema dan caption writing HARI KEBANGKITAN NASIONAL All Aplikasi<br />\r\n- Post Konten Pertanyaan SDP Mobile<br />\r\n- Story Konten SDP Mobile<br />\r\n- Desain Konten pengingat bayar Tagihan untuk PG<br />\r\n- Desain Story pengingat bayar Tagihan untuk PG<br />\r\n- Desain Konten pengingat bayar Tagihan untuk SSB<br />\r\n- Desain Story pengingat bayar Tagihan untuk SSB<br />\r\n- Desain Konten Testimoni untuk XML mobile<br />\r\n- Desain Story Testimoni untuk XML mobile<br />\r\n- Desain Konten Testimoni untuk SDP Mobile<br />\r\n- Desain Story Testimoni untuk SDP mobile</p>\r\n', '2023-05-19'),
(93, '2023-05-19 16:00:23', '65', '<p>Design1 Report Harian Tanggal 19 Mei 2023</p>\r\n\r\n<p>- Revisi design id card mas muji<br />\r\n- Revisi Update design id card mas aziz<br />\r\n- Revisi Update design id card mas eko<br />\r\n- Revisi Update design id card mas ades<br />\r\n- Design id card tampilan belakang<br />\r\n- Design aktivasi voucher masal ssb<br />\r\n- Design daftar harga paket data all operator<br />\r\n- Update design harga grosir voucher<br />\r\n- Design hari besar kebangkitan nasional xml<br />\r\n- Design banner hari besar kebangkitan nasional xml<br />\r\n- Design story hari besar kebangkitan nasional xml<br />\r\n- Design hari besar kebangkitan nasional PG<br />\r\n- Design banner hari besar kebangkitan nasional PG<br />\r\n- Design story hari besar kebangkitan nasional PG<br />\r\n- Design PP customer relation xml</p>\r\n', '2023-05-19'),
(94, '2023-05-19 16:00:24', '68', '<ul>\r\n	<li>mencari referensi emailing penggajian.</li>\r\n	<li>mempelajari referensi emailing penggajian</li>\r\n	<li>update baner hati hati penipuan PH</li>\r\n	<li>update rekening Mandiri PH</li>\r\n	<li>update rekening BRI PH</li>\r\n	<li>testing emailing gaji (tahap test slip dan pembuatan daftar gaji)</li>\r\n</ul>\r\n', '2023-05-19'),
(95, '2023-05-19 16:00:47', '67', '<p>-Update Design Flash Sale PLN-20 PH<br />\r\n-Design Brosur XML<br />\r\n-Design FreedomApps XML<br />\r\n-Design XL Extra Combo Flex<br />\r\n-Design Flayer Bayar PLN, PDAM</p>\r\n', '2023-05-19'),
(96, '2023-05-19 16:03:48', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Iklan Grosir Voucher FB<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Promo Produk Indosat Voucher<br />\r\nðŸ‘‰ðŸ» Promo Produk XL Data Flex<br />\r\nðŸ‘‰ðŸ» Promo Produk Aktivasi PH<br />\r\nðŸ‘‰ðŸ» Diskusi Iklan dg Marketing Online<br />\r\nðŸ‘‰ðŸ» Update Rekening di Web PH (Info ke Programer)<br />\r\nðŸ‘‰ðŸ» Croscek Produk Minus<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Croscek Orderan Voucher<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Update Harga Grosir Voucher<br />\r\nðŸ‘‰ðŸ» Update Produk Kasir Pintar<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*MINAS RELOAD<br />\r\n*Sae Reload<br />\r\n*Payshop<br />\r\n*YOT RELOAD<br />\r\n*Leon Pulsa<br />\r\n*PULSAHP<br />\r\n*SF RELOAD<br />\r\n*SAVEPLUS<br />\r\n*Tamma Reload<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Retno<br />\r\n*Erna<br />\r\n*PH<br />\r\n*Fourteen</p>\r\n', '2023-05-19'),
(97, '2023-05-19 16:15:32', '56', '<p>1. Rekon Saldo Akhir Rekening bank dg saldo bank di accurate<br />\r\n2. Rekap mutasi bank retail, h2h dan pt&nbsp; tgl 17, 18 Mei<br />\r\n3. Input mutasi bank retail tgl 15, 16, 17, 18 Mei (accurate)<br />\r\n4. Input biaya sms1900/kas e wallet (accurate)<br />\r\n5. Rekap dan input cash sales, cash voucher dan stok sales (accurate)</p>\r\n', '2023-05-19'),
(98, '2023-05-19 16:23:12', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 19 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 19/05 yang sdh datang : (SPL: Damas)<br />\r\n- Order voucher (SPL: Otim,Daffina,Favour,Toni,Citra)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari sabtu<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-19'),
(99, '2023-05-19 16:40:14', '52', '<p>-cek kendala ip center oto retail tdk mau nyala<br />\r\n-cek history setting parsing fu<br />\r\n-delegasi ramdita cek ulang semua regex ip<br />\r\n-hitung equoto ototepe tgl 18<br />\r\n-rekap pulsa tp yg blm masuk, info golden masih byk yg blm masuk (done)<br />\r\n-order tsel tp 64jt golden rate 14.8%<br />\r\n-info irfan filter ereport supaya tdk terlihat<br />\r\n-cek settingan regex kendala ramdita, done krna salah tangkap reffid<br />\r\n-review hasil interview hrd<br />\r\n-backup sdp saat sholat jum&#39;at<br />\r\n-cari tau cara notice saldo habis di spl oto, info di grup teknis settingan di modul</p>\r\n', '2023-05-19'),
(100, '2023-05-19 16:50:43', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Menghitung dan Setor Uang Retail<br />\r\n7. Rekap Nota Biaya</p>\r\n', '2023-05-19'),
(101, '2023-05-19 17:05:01', '54', '<p>19 mei 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC 18-19 Mei 23</li>\r\n	<li>Rekap KPI Retail, CS, support, OPR, SDP &amp; PH, marketing, data voucher</li>\r\n	<li>Interview dan psikotes 2 kandidat untuk kandiat opr dan cs ototape</li>\r\n	<li>Interpretasi hasil psikotes dan interview, kirim PIC</li>\r\n	<li>Diskusi dengan p yudi dan PIC</li>\r\n	<li>Mencari informasi dan refrensi mengenai E-mailing slip gaji meneruskan ke programmer</li>\r\n	<li>Mencari refrensi mengenai kontrak kerja (pembaruan)</li>\r\n	<li>Menghubungi kandidat yang memenuhi kualifikasi untuk mulai berangkat senin</li>\r\n	<li>Rekap sisa cuti lalu kirim grup shift</li>\r\n	<li>Rekap absensi telat lalu kirim grup shift</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-19'),
(102, '2023-05-19 17:45:10', '70', '<p>19 Mei 2023<br />\r\n- ngajarin mas edwin update oto client jika otomax asli update versi<br />\r\n- update otomax PG versi 414<br />\r\n- memperbaiki regex status menunggu jawaban , gagal dan regex yg kosong supplier fureload (SSB)<br />\r\n- memperbaiki regex status menunggu jawaban , gagal dan regex yg kosong supplier fureload (PG)<br />\r\n- set prioritas di kelompok jawaban RB di otomax h2h<br />\r\n- set regex sukses manual oleh admin&nbsp; RB di otomax h2h<br />\r\n- set regex gagal manual oleh admin&nbsp; RB di otomax h2h<br />\r\n- update otomax PH versi 414<br />\r\n- cek addon BRI retail error (sudah normal)<br />\r\n- cek addon BRI SDP error (sudah normal)<br />\r\n- order three transfer 8.8% dan menyiapkan chip nya<br />\r\n- backup operator h2h sholat jumat (pantau transkasi dan menaikan harga tsel 15 yang tidak masuk )<br />\r\n- set harga beli spl PLUS ENAMDUA di otomax SSB<br />\r\n- set regex RB dg status sukses oleh admin dan gagal manual oleh admin<br />\r\n- update addon bank versi 2.4.1 SSB<br />\r\n- update addon bank versi 2.4.1 PG<br />\r\n- menjelaskan ke mas edwin dan shift pagi settingan notice saldo habis di modul spl otomax dan mencontohkan settingannya<br />\r\n- mengganti chip tsel tp PG<br />\r\n- info cholid , trxid yang ditangkap di replay callback RB reff nya</p>\r\n', '2023-05-19'),
(103, '2023-05-20 16:00:05', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Rekap mutasi bank retail, h2h dan pt&nbsp; tgl 19 Mei<br />\r\n3. Input mutasi bank retail tgl 19 Mei (accurate)<br />\r\n4. Input mutasi bank h2h dan pt tgl 15, 16 Mei (accurate)<br />\r\n5. Input biaya sms1900/kas e wallet (accurate)<br />\r\n6. Rekap dan input cash sales, cash voucher dan stok sales (accurate)<br />\r\n7. Input komisi &amp; tukar komisi retail (accurate)<br />\r\n8. Rekap transaksi penjualan, pembelian dan jkp tgl 16 sd 19 Mei<br />\r\n9. Input poin retail (accurate)</p>\r\n', '2023-05-20'),
(104, '2023-05-20 16:00:20', '65', '<p>Design1 Report Harian Tanggal 20 Mei 2023</p>\r\n\r\n<p>- Design icon digipos PG<br />\r\n- Design indosat only4u PG<br />\r\n- Design promo saldo maxim driver SDP<br />\r\n- Design promo paket data aman internet lancar SDP</p>\r\n', '2023-05-20'),
(105, '2023-05-22 15:30:27', '68', '<ul>\r\n	<li>setup dan edit parameter code macro emailing gaji test</li>\r\n	<li>testing emailing gaji test&nbsp;</li>\r\n	<li>update otomax client pc HRD</li>\r\n	<li>test&nbsp; perbaikan sharing printer pc hrd</li>\r\n	<li>pembuatan query pengambilan data admin untuk pengkondisian halaman beranda</li>\r\n	<li>test syntax query</li>\r\n	<li>test pembuatan pengkondisian tampil report halaman beranda.</li>\r\n	<li>backup sc elaporanxml ke repo local</li>\r\n	<li>backup sc elaporanxml ke repo remote</li>\r\n</ul>\r\n', '2023-05-20'),
(106, '2023-05-20 16:02:40', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Rekap Klaim kesehatan Karyawan<br />\r\n7. Rekap Nota Biaya</p>\r\n', '2023-05-20'),
(107, '2023-05-20 16:02:46', '64', '<p>- Membuat Tema dan caption writing&nbsp; Motivasi Untuk Pulsa Hoki<br />\r\n- Post Konten Pengingat bayar Tagihan untuk PG<br />\r\n- Story Konten Pengingat bayar Tagihan untuk PG<br />\r\n- Post di Facebook Pengingat bayar Tagihan untuk PG<br />\r\n- Post Konten Pengingat bayar Tagihan untuk SSB<br />\r\n- Story Konten Pengingat bayar Tagihan untuk SSB<br />\r\n- Post di Facebook Pengingat bayar Tagihan untuk SSB<br />\r\n- Desain Konten Motivasi PH<br />\r\n- Desain Story&nbsp; Motivasi PH<br />\r\n- Desain Konten Mitos dan fakta PG<br />\r\n- Desain Story Mitos dan fakta PG</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-20'),
(108, '2023-05-20 16:05:39', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Packing &amp; Kirim Tukar Poin SDP<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Equoto Retail<br />\r\nðŸ‘‰ðŸ» Croscek Produk Minus<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Balance Selisih Stokdaffina<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Update Produk Kasir Pintar<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*Minoritascell<br />\r\n*Leon<br />\r\n*Rajapulsa<br />\r\n*adaratech<br />\r\n*AUTOREFILL<br />\r\n*KIOSPULSA<br />\r\n*Salsa<br />\r\n*HAGATRONIK<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Retno<br />\r\n*Nizar<br />\r\n*Windi<br />\r\n*PH<br />\r\n*Eka<br />\r\n*Robby<br />\r\n*Selvy<br />\r\n*PG</p>\r\n', '2023-05-20'),
(109, '2023-05-20 16:12:37', '70', '<p>20 Mei 2023<br />\r\n- update otomax client h2h v414 pc acc1<br />\r\n- update otomax client h2h v414 pc acc2<br />\r\n- update addon bank retail v241<br />\r\n- ngajarin cs SSB (dea) set fitur tiket deposit di web report<br />\r\n- update addon bank PH v241 , sementara BRI login di otomax<br />\r\n- update addon bank H2H v241<br />\r\n- pasang chip tsel tp PG<br />\r\n- pantau trx su<br />\r\n- update otomax SDP versi 414<br />\r\n- update addon bank SDP v241<br />\r\n- cek rekapan dan equoto tgl 18 dan 19 SSB<br />\r\n- cek rekapan dan equoto tgl 18 dan 19 PG</p>\r\n\r\n<p>- menambahkan prioritas di status sukses dan gagal spl Rakipay di otomax h2h<br />\r\n- menambahkan prioritas di status sukses , gagal , alihkan , dan dibatalkan spl Apudaulia di otomax h2h<br />\r\n- menambahkan prioritas di status sukses , gagal dan alihkan spl Fifadana di otomax h2h<br />\r\n- menambahkan regex menunggu jawaban , sebelumnya kosong spl JPM di otomax SSB<br />\r\n- menambahkan prioritas di status sukses, menunggu jawaban , dan gagal&nbsp; spl JPM di otomax SSB<br />\r\n- menambahkan regex menunggu jawaban , sebelumnya kosong spl fureload di otomax PH<br />\r\n- menambahkan prioritas di status menunggu jawaban , sukses , dan gagal spl fureload di otomax PH<br />\r\n-&nbsp; mengubah regex gagal produk tidak tersedia agar agen dapat ket alasan gagalnya&nbsp; , sebelumnya replay ke agen hanya gagal kelompok jwaban SKTCEK di otomax PH<br />\r\n- mengubah regex gagal produk tidak tersedia dan nomor pelanggan salah agar agen dapat replay ket alasan gagalnya&nbsp; , sebelumnya replay ke agen hanya gagal kelompok jawaban cekdwi di otomax PH<br />\r\n- mengubah regex gagal Tiket Sudah Expired agar agen dapat replay ket alasan gagalnya&nbsp; , sebelumnya replay ke agen hanya gagal kelompok jawaban XMLBAYR di otomax PH<br />\r\n- memperbaiki regex gagal dg keterangan alasan gagal sebelumnya hanya status gagal saja spl PIXME di otomax SSB<br />\r\n- memperbaiki regex menunggu jawaban sebelumnya hanya status menunggu jawaban&nbsp; saja , spl AMC di otomax PG<br />\r\n- memperbaiki regex menunggu jawaban sebelumnya hanya status menunggu jawaban&nbsp; saja , spl BCA di otomax PG</p>\r\n', '2023-05-20'),
(110, '2023-05-20 16:31:06', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 20 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 19/05 yang sdh datang (Otim,Toni,Citra,Muji )<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari minggu dan senin<br />\r\n- Rekap target voucher</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-20'),
(111, '2023-05-21 16:01:01', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Update Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Rekap Stok Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Penjualan Voucher<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*Sarvenaz<br />\r\n*Radar Pulsa<br />\r\n*Amazone<br />\r\n*PMK<br />\r\n*Sniper<br />\r\n*Pasar Kuota<br />\r\n*Vision Pulsa<br />\r\n*Thalita<br />\r\n*Paypoin<br />\r\n*Travel Pulsa<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Teras Cell<br />\r\n*PH<br />\r\n*Robby</p>\r\n', '2023-05-21'),
(112, '2023-05-21 16:01:47', '67', '<p>-Design Cara Transaksi Spotify PH<br />\r\n-Design Transaksi Lancar Gunakan Aplikasi PH<br />\r\n-Design Produk Transfer Pulsa SDP<br />\r\n-Design TopUp Games PH</p>\r\n', '2023-05-21'),
(113, '2023-05-21 16:35:21', '52', '<p>-hitung equoto ototepe tgl 19-20<br />\r\n-update harga jual tsel tp sesuai pasaran<br />\r\n-cek harga tsel tf, golden 13.7%, markas 14% blm ada yg masuk tdk order<br />\r\n-set addon kiosgamer tarik langsung dari otomax ototepe<br />\r\n-set parsing all kode ff, croscek ulang parsing<br />\r\n-test trx ff, kehabisan stok, konfirmasi pakyudi<br />\r\n-menawarkan vocer gs, melayani pembelian gs<br />\r\n-cari stok gs, nego ke sagara ttp 84rb blm order slowres<br />\r\n-set regex sukses gagal tpgs di ototepe<br />\r\n-update equoto ototepe tambah tpgs<br />\r\n-mengarahkan wildan ngajarin marketing online cara komunikasi dengan agen aktif dan wa blast<br />\r\n-cek saldo tpgs01 setelah pindah oto</p>\r\n', '2023-05-21'),
(114, '2023-05-22 16:00:24', '68', '<ul>\r\n	<li>install telegram pc ototepe</li>\r\n	<li>pembuatan query tampil report kerja terkini halaman beranda</li>\r\n	<li>testing query tampil report kerja terkini halaman beranda</li>\r\n	<li>debuging output data report kerja terkini halaman beranda</li>\r\n	<li>membuat pengkondisian edit dan hapus data report kerja tersedia hanya untuk user login</li>\r\n	<li>testing pengkondisian dan fitur edit dan hapus data</li>\r\n	<li>backup sc elaporanxml ke repo local</li>\r\n	<li>backup sc elaporanxml ke repo remote</li>\r\n</ul>\r\n', '2023-05-22'),
(115, '2023-05-22 16:00:28', '64', '<p>- Membuat Tema dan caption writing Doa Untuk Pulsa Hoki<br />\r\n- Post Konten Motivasi untuk PH<br />\r\n- Story Konten Motivasi untuk PH<br />\r\n- Post Konten Mitos dan fakta PG<br />\r\n- Story Mitos dan fakta PG<br />\r\n- Post di Facebook Mitos dan fakta untuk PG<br />\r\n- Desain background Motion Grafis Doa PH (video Doa)<br />\r\n- Edit Motion background Supaya bergerak di After Effects (video Doa) PH<br />\r\n- Edit Roda Mobil supaya bergerak Di After Effects (video Doa) PH<br />\r\n- Edit transisi (video Doa) PH<br />\r\n- Edit suara : Memasukan Suara narasi ke Video Doa</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-22'),
(116, '2023-05-22 16:00:46', '65', '<p>Design1 Report Harian Tanggal 22 Mei 2023</p>\r\n\r\n<p>- Design icon xl-axis ssb<br />\r\n- Design icon joox ssb<br />\r\n- design icon ree fire<br />\r\n- design icon genshin impact<br />\r\n- design icon mobile legend<br />\r\n- design icon&nbsp; pubg<br />\r\n- design icon sausage man<br />\r\n- design icon aov<br />\r\n- design icon dragon raja<br />\r\n- design icon league of legends<br />\r\n- design icon call of duty<br />\r\n- Design Photoprofil CS ototepe<br />\r\n- design banner xml</p>\r\n', '2023-05-22'),
(117, '2023-05-22 16:01:18', '67', '<p>-Design FlashSale Emoney<br />\r\n-Design Token Promo PLMM50<br />\r\n-Design Topup FreeFire<br />\r\n-Update Design Freedom Apps H2H<br />\r\n-Uppdate Design Freedom Apps Retail<br />\r\n-Update Harga FreeFire Super Promo</p>\r\n', '2023-05-22'),
(118, '2023-05-22 16:01:30', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax<br />\r\n-Update harga digiflazz</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-22'),
(119, '2023-05-22 16:06:48', '55', '<p>ACCOUNTING 1 REPORT HARIAN 22 mei 2023<br />\r\n1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Mutasi Bank H2H tgl 17,18,19 Mei (Accurate)<br />\r\n7. Input Transaksi Pembelian tgl 16,17 Mei (Accurate)</p>\r\n', '2023-05-22'),
(120, '2023-05-22 16:09:30', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 22 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 19/05 yang sdh datang (Daffina)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari selasa<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1.Siti Juleha<br />\r\n2.Khulatul<br />\r\n3.Syamsul<br />\r\n4.PH<br />\r\n5.Roby<br />\r\n6.Fourteen<br />\r\n7.Teguh</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-22'),
(121, '2023-05-22 16:12:01', '70', '<p>22 Mei 2023<br />\r\n- mencoba login BRI PGH di addon (sebelumnya di addon error dan login di otomax) , dan info ke cs ph kalo BRI sudah bisa login di addon<br />\r\n- konfirmasi ke agen yg paralel aplikasi apakah sudah atau belum update link keamanan data hapus akun dan memperbaiki keusioner<br />\r\n&nbsp;&gt;&gt; apk paralel PULSA GENGGAM :<br />\r\n1 . Pulsa Gaspoll&nbsp;&nbsp; ---------- sedang ditanyakan (belum balas)<br />\r\n2 . Konter Saku&nbsp;&nbsp;&nbsp;&nbsp; --------- link sudah diupdate</p>\r\n\r\n<p>apk paralel SSB :<br />\r\n1 . Smart Saldo&nbsp;&nbsp; ---------&nbsp; link sudah diupdate</p>\r\n\r\n<p>apk paralel SDP :<br />\r\n1 . PulsaNU&nbsp; --------- sudah&nbsp; - sedang memperbaiki kuesioner nya</p>\r\n\r\n<p>apk paralel PH :<br />\r\n1 . TRIPOL MOBILE&nbsp;&nbsp; - belum (sedang dipandu untuk update link nya)</p>\r\n\r\n<p>apk paralel XML TRONIK :<br />\r\n1 . AM TOKEN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - sedang ditanyakan (belum balas)<br />\r\n2 . Pusat Grosir Pulsa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - sudah diupdate<br />\r\n3&nbsp; .Cerdas Payment&nbsp; - sudah diupdate</p>\r\n\r\n<p>- pantau trx su<br />\r\n- cek margin di su , dan menginfokan ke opr untuk cek produk yang up nya perlu diperbaiki<br />\r\n- followup cs PG produk req agen , sudah ada jalur tinggal membuat produknya<br />\r\n- cek masa aktif everluck setiap server<br />\r\n- cek rekapan dan equoto tgl 20 dan 21 SSB<br />\r\n- cek rekapan dan equoto tgl 20 dan 21 PG<br />\r\n- update addon bank versi 242 PG<br />\r\n- update addon bank versi 242 SSB<br />\r\n- update addon bank versi 242 SDP</p>\r\n\r\n<p><br />\r\n- memperbaiki regex menunggu jawaban , sebelumnya hanya status menunggu jawaban&nbsp; saja (HIDAYAH oto PG)<br />\r\n- set regex gagal beserta keterangan gagal nya (INDONESIA oto PG)<br />\r\n- set regex gagal beserta keterangan gagal nya (MASTERLOAD oto PG)<br />\r\n- set regex gagal dengan keterangan gagal nya , sebelumnya kosong (MEDIAPAY oto PG)<br />\r\n- memperbaiki regex menunggu jawaban , sebelumnya hanya status saja dan menambahkan prioritas (MITRA oto PG)<br />\r\n- set regex gagal beserta keterangan gagal nya (PLUSENAMDUA oto PG)<br />\r\n- memperbaiki regex menunggu jawaban , sebelum nya hanya status saja (MARKAZ oto PG)</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-22'),
(122, '2023-05-22 16:28:21', '52', '<p>-ngajarin opr ototepe yg baru<br />\r\n*mengenalkan alur transaksi<br />\r\n*mengenalkan nama2 tools (modul, terminal, addon)<br />\r\n*mejelaskan cara lepas pasang chips<br />\r\n*menjelaskan cara aktif&nbsp; dan logout modul<br />\r\n*menjelaskan penyebab2 port tdk tersambung<br />\r\n*menjelaskan beberapa replay gagal tsel tf</p>\r\n\r\n<p>-membuatkan catatan beserta gambar study kasus (karena masih sering lupa)<br />\r\n-membuat perjanjian tempo sales eko konfirmasi pakyudi<br />\r\n-menjelaskan pertanyaan2 dari opr ototepe baru<br />\r\n-diskusi aturan tempo dgn pakyudi by chat<br />\r\n-koordinasi aturan tempo dgn eko sales<br />\r\n-rekap kurangan gs dari mas imam<br />\r\n-ngajarin rekapan saldo ototepe ke opr baru</p>\r\n', '2023-05-22'),
(124, '2023-05-23 16:00:48', '65', '<p>Design1 Report Harian Tanggal 23 Mei 2023</p>\r\n\r\n<p>- design icon spotify<br />\r\n- design icon bigo live<br />\r\n- design icon playstation<br />\r\n- design icon garena<br />\r\n- design icon gemscool<br />\r\n- design icon google play<br />\r\n- design icon steam<br />\r\n- design icon zepetto<br />\r\n- design icon vidio.com<br />\r\n- design banner agen arifa cell<br />\r\n- design banner agen nouf cell<br />\r\n- design promo grab driver xml<br />\r\n- esign flash sale voucher indosat xml</p>\r\n', '2023-05-23'),
(125, '2023-05-23 16:02:54', '67', '<p>-Design Flayer Jualan Aman Pake SDP Mobile Slide 1<br />\r\n-Design Flayer Jualan Aman Pake SDP Mobile Slide 2<br />\r\n-Design Produk Lengkap Transaksi Cepat SDP<br />\r\n-Design Semua Bisa di Pulsa Hoki&nbsp;<br />\r\n-Update Design Token Promo PLM XML<br />\r\n-Design Aplikasi Pulsa Amanah dan Termurah PH<br />\r\n-Design Rekomendasi Transaksi SDP&nbsp;</p>\r\n', '2023-05-23'),
(126, '2023-05-24 10:43:27', '68', '<ul>\r\n	<li>perbaikan pc Retail tidak bisa diremote</li>\r\n	<li>test install macos vmware</li>\r\n	<li>cari referensi emulator ios Windows</li>\r\n	<li>fix error jaringan pc sdp</li>\r\n	<li>debuging xml test</li>\r\n	<li>backup local sc elaporan</li>\r\n	<li>backup remote / online sc elaporan</li>\r\n	<li>cicil dokumentasi buat akun apple develop</li>\r\n	<li>cicil buat akun apple developer</li>\r\n	<li>cari referensi fix error Your enrollment in the Apple Developer Program could not be completed at this time.</li>\r\n	<li>coba edit dong</li>\r\n</ul>\r\n', '2023-05-23'),
(127, '2023-05-23 16:05:44', '70', '<p>23 Mei 2023<br />\r\n- update addon bank versi 242 PH<br />\r\n- update addon bank versi 242 Retail<br />\r\n- update addon bank versi 242 H2h<br />\r\n- pantau trx SU<br />\r\n- cek margin SU dan info ke opr , produk yang up nya perlu diperbaiki<br />\r\n- push cs SSB untuk sering bc produk free fire yang sebelumnya sudah diturunkan<br />\r\n- info cs SSB untuk mengarahkan produk ke jalur yang murah dengan memantau lancar/tidaknya<br />\r\n- info cs PG untuk menurunkan harga produk yang akan dipromokan<br />\r\n- order three trf 10chip 8.7% , menyiapkan chip dan set harga untuk xml dibawah harga pasaran<br />\r\n- cek addon bank mandiri SSB error (sudah normal)<br />\r\n- cek vpn java down dan cek di mikrotiknya<br />\r\n- info ke opr (mas edwin) apa yang harus dilakukan jika vpn java down dan cara pantau vpn java sudah normal atau belum<br />\r\n- info ke opr (mas edwin) jika vpn java down ,&nbsp; otomax SSB perlu diganti ke astinet (server) , pc wijaya perlu diganti ke vpn do<br />\r\n- cek addon bank mandiri retail error (sudah normal)<br />\r\n- set regex gagal beserta keterangan nya dan memberikan prioritas (produk pdam otomax retail)<br />\r\n- cek rekapan dan equoto tgl 22 SSB<br />\r\n- cek rekapan dan equoto tgl 22 PG</p>\r\n', '2023-05-23'),
(128, '2023-05-23 16:06:18', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Rekap mutasi bank retail, h2h dan pt&nbsp; tgl 20, 21, 22 Mei<br />\r\n3. Input biaya sms1900/kas e wallet (accurate)<br />\r\n4. Rekap biaya tgl 1 - 22 Mei 2023<br />\r\n5. Rekap transaksi penjualan, pembelian dan jkp tgl 20, 21, 22 Mei</p>\r\n', '2023-05-23'),
(129, '2023-05-23 16:07:21', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Mutasi Bank H2H tgl 20 Mei (Accurate)<br />\r\n7. Input Transaksi Pembelian tgl 18,19 Mei (Accurate)<br />\r\n8. Membayar dan Lapor PPN PT, CV, DPN</p>\r\n', '2023-05-23'),
(130, '2023-05-23 16:13:37', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Diskusi Iklan dg Marketing Online<br />\r\nðŸ‘‰ðŸ» Croscek Orderan Voucher<br />\r\nðŸ‘‰ðŸ» Update Harga Voucher H2H/Retail<br />\r\nðŸ‘‰ðŸ» Update Harga Promo PLN<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*ADRAJAYA<br />\r\n*Pasar Kuota<br />\r\n*PMK<br />\r\n*SUKSES TRONIK<br />\r\n*Leonpulsa<br />\r\n*Istana Reload<br />\r\n*Payfi<br />\r\n*Bhinneka Pulsa<br />\r\n*LSR<br />\r\n*genesisdigital<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Windi<br />\r\n*Teras Cell<br />\r\n*Sugiarto<br />\r\n*Sarah<br />\r\n*Tofu Cell<br />\r\n*PH<br />\r\n*PG<br />\r\n*Lastri</p>\r\n', '2023-05-23'),
(131, '2023-05-23 16:19:16', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 23 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Input dan Upload Voucher<br />\r\n- Mencari komplenan Voucher<br />\r\n- Order Voucher (SPL: Daffina.Otim,Citra,Muji Isat,Favour)<br />\r\n- Menyiapkan gosokan voucher CSVoucher untuk hari rabu<br />\r\n- Rekap target voucher</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-23'),
(132, '2023-05-23 16:20:32', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax<br />\r\n-Update harga digiflazz<br />\r\n-Training marketing online<br />\r\n-Pendaftaran Mitra h2h baru<br />\r\n-planning desain poster produk grab driver<br />\r\n-planning desain poster produk token pln</p>\r\n', '2023-05-23'),
(133, '2023-05-23 16:28:47', '54', '<p>23 mei 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC 22 Mei 23</li>\r\n	<li>Rekap KPI Retail, CS, support, OPR, SDP &amp; PH, marketing, data voucher</li>\r\n	<li>Upload jadwal juni di worksheet jadwal</li>\r\n	<li>Menjelaskan mengenai jadwal ke berlyanda</li>\r\n	<li>Review cv di email</li>\r\n	<li>Rekap absensi sampai dengan tanggal 22 mei</li>\r\n	<li>Cek komplain cs sdp &amp; ph</li>\r\n	<li>Rekap skd</li>\r\n</ul>\r\n\r\n<p>1. skd an lutfi nur tanggal 22-24 mei (bedrest pasca keguguran)</p>\r\n', '2023-05-23'),
(137, '2023-05-24 16:00:39', '68', '<ul>\r\n	<li>debuging untuk menemukan bug report yang tidak langsung muncul</li>\r\n	<li>testing query tampil data report terkini</li>\r\n	<li>testing input report sisi admin</li>\r\n	<li>cek database report</li>\r\n	<li>perbaikan bug report tidak langsung muncul</li>\r\n	<li>bantu content setup lighting</li>\r\n	<li>pengajuan nomor DUNS</li>\r\n	<li>backup perubahan code elaporan ke repo locel</li>\r\n	<li>backup perubahan code elaporan ke repo github</li>\r\n</ul>\r\n', '2023-05-24'),
(138, '2023-05-24 16:01:18', '64', '<p>- Membuat Tema dan caption writing Tips XML<br />\r\n- Membuat Tema dan caption writing Tips SSB<br />\r\n- Ngeset lighting foto, Untuk foto Marketing<br />\r\n- Foto Marketing<br />\r\n- Post Konten testimoni XML<br />\r\n- Story Konten testimoni XML<br />\r\n- Post Konten testimoni SDP<br />\r\n- Story Mitos testimoni SDP<br />\r\n- Desain Konten Tips XML<br />\r\n- Desain Story Tips XML<br />\r\n- Membuat Tema dan caption writing Pertanyaan Untuk PG<br />\r\n- Desain Konten Tips SSB<br />\r\n- Desain Story Tips SSB<br />\r\n- Desaain Konten Pertanyaan PG<br />\r\n- Desain Konten Pertanyaan PG</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-24'),
(139, '2023-05-24 16:01:20', '65', '<p>Design1 Report Harian Tanggal 24 Mei 2023</p>\r\n\r\n<p>- design flash sale axis data voucher xml<br />\r\n- revisi design flash sale voucher indosat xml<br />\r\n- design info penting customer relation xml<br />\r\n- design promo diamon mlbb xml<br />\r\n- design id card mba diah xml</p>\r\n', '2023-05-24'),
(140, '2023-05-24 16:05:29', '67', '<p>-Design Token PLN Promo-5 PH<br />\r\n-Design Mau Buka Usaha Tapi Gamau Ribet SDP<br />\r\n-Design Cari Produk Digital</p>\r\n', '2023-05-24'),
(141, '2023-05-24 16:06:13', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Produk Promo Voucher H2H/Retail<br />\r\nðŸ‘‰ðŸ» Cek Jalur XL Flex Promo PH<br />\r\nðŸ‘‰ðŸ» Rekap Agen Non Aktif PH<br />\r\nðŸ‘‰ðŸ» Cek Jalur Smart Unlimited PH<br />\r\nðŸ‘‰ðŸ» Rekap Stok Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Penjualan Voucher<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*Signal<br />\r\n*Saka<br />\r\n*Sarvenaz<br />\r\n*GJMRELOAD<br />\r\n*Tamma Reload<br />\r\n*Pulsa Niaga<br />\r\n*Iben<br />\r\n*YReload<br />\r\n*Adrajaya<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Retno<br />\r\n*Sari<br />\r\n*PH<br />\r\n*PG<br />\r\n*Forteen</p>\r\n', '2023-05-24'),
(142, '2023-05-24 16:23:22', '102', '<p>REPORT HARIAN 24 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Rekapan upload voucher di KPI Stokdaffina<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 23/05 yang sdh datang : (Citra,Otim,Muji Isat)<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan konter untuk hari kamis<br />\r\n- Rekap target voucher</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-24'),
(143, '2023-05-24 16:29:45', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Mutasi Bank H2H tgl 21,22 Mei (Accurate)<br />\r\n7. Rekap Cuti, Insentif Malam, Lembur Tanggal Merah Karyawan</p>\r\n', '2023-05-24'),
(144, '2023-05-24 17:05:19', '52', '<p>-hitung equoto ototepe tgl 23<br />\r\n-telfon call center komplen gs tdk dpt replay<br />\r\n-cari stok tsel tp, order golden 64jt rate 13.5%, order hendri 52jt rate 13.8%</p>\r\n\r\n<p>-briefing sales<br />\r\n*hrd menjelaskan perihal bpjs ketenagakerjaan<br />\r\n*menambahkan penjelasan hrd perihal bpjs PU dan BPU<br />\r\n*eko tanya , itu pembagian ke perusahaan atau full karyawan<br />\r\n*aziz tanya aktivasi isat mahal dibanding injeknya<br />\r\n*menjelaskan perihal aturan saldo tempo</p>\r\n\r\n<p>-delegasi opr retail cari jalur aktivasi isat yg dibawah harga injek<br />\r\n-delegasi ramdita test trx digipos<br />\r\n-konfirmasi mas adit gs tdk respon, diminta stop trx<br />\r\n-cek ib bni rek fais (done)</p>\r\n\r\n<p>-ngajari opr ototepe baru<br />\r\n*update harga jual dan beli<br />\r\n*menentukan harga jual dari harga beli dan hrg spl server<br />\r\n*cek komplenan ff<br />\r\n*rekap sisa saldo, dan saldo masuk<br />\r\n*titip ke support dan menjelaskan chips yg blm dipakai</p>\r\n\r\n<p>-cek dan test apk kompetitor<br />\r\n*test icon marup provider prastica<br />\r\n*test icon cs live di apk prastica<br />\r\n*test icon tutorial , masuk link yutub di apk prastica<br />\r\n*test icon qris, bisa masukan nominal dan ada pilihan admin (jalan tanpa tiket)<br />\r\n*test icon tools download design apk topindoku</p>\r\n\r\n<p>-ngajarin dhwi admin retail load data lama<br />\r\n-koordinasi dgn wildan penambahan icon tutorial di apk</p>\r\n', '2023-05-24'),
(145, '2023-05-24 17:11:14', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Input mutasi bank retail, h2h dan pt&nbsp; tgl 20, 21, 22 Mei (accurate)<br />\r\n3. Input biaya sms1900/kas e wallet (accurate)<br />\r\n4. Input komisi dan tukar komisi retail (accurate)<br />\r\n5. Input transaksi penjualan dan jkp tgl 16 sd 22 Mei (accurate)</p>\r\n', '2023-05-24'),
(146, '2023-05-24 17:18:58', '70', '<p>24 Mei 2023<br />\r\n- cek minus equoto SSB (ada trx GS yang motong saldo linkaja) &gt;&gt; saldo digipos sudah di isi oleh admin h2h dengan vendor ototepe<br />\r\n- cek L/R SSB dan info ke cs SSB cek produk yang markup nya perlu diperbaiki<br />\r\n- cek L/R PG dan info ke cs PG cek produk yang markup nya perlu diperbaiki<br />\r\n- info cs PG untuk menambah kuota produk pln promo<br />\r\n- mencoba trx GS dg login digipos SSB di hp<br />\r\n- cek margin trx SU tgl 23 , dan info ke opr kalau hidayah tgl 23 marginnya minus karna ada salah set hpp<br />\r\n- cek settingan retail produk roamax total tagihan 2xlipat dr tagihan seharusnya ( nominal pada produk diisi 1 harusnya di isi 0)<br />\r\n- cek addon BRI SSB error (sudah normal)<br />\r\n- info cs PG untuk membuat produk umroh , haji, roaming ke digipos<br />\r\n- cek settingan produk yang baru dibuat cs PG , dan info yang salah dan yg harus diperbaiki<br />\r\n- info cs SSB untuk membuat produk umroh , haji, roaming ke digipos<br />\r\n- cek settingan produk yang baru dibuat cs PG , dan info yang salah dan yg harus diperbaiki<br />\r\n- cek settingan produk isat only 4u , tampilan memunculkan tagihan nya tidak rapi &gt;&gt; info cs PG untuk memperbaiki<br />\r\n- cek cara ubah nama aplikasi di akun developer<br />\r\n- meneruskan komplain agen paralel apklikasi ke everluck<br />\r\n- cek settingan produk haji PH , dan info cs PH cara untuk memperbaiki tampilan agar lebih rapi</p>\r\n', '2023-05-24'),
(147, '2023-05-24 18:49:15', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax<br />\r\n-Update harga digiflazz<br />\r\n-Pendaftaran Mitra h2h baru</p>\r\n', '2023-05-24'),
(148, '2023-05-25 16:08:54', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accura<br />\r\n2. Rekap transaksi penjualan, pembelian dan jkp tgl 23, 24 Mei<br />\r\n3. Input transaksi penjualan dan jkp tgl 23, 24 Mei (accurate)<br />\r\n4. Rekap mutasi bank h2h, pt dan retail tgl 23, 24&nbsp; Mei<br />\r\n5. Input mutasi bank h2h, dan pt tgl 23 Mei<br />\r\n6. Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n7. Input biaya sms1900/kas e wallet (accurate)<br />\r\n8. Input komisi dan tukar komisi retail (accurate)</p>\r\n', '2023-05-25'),
(149, '2023-05-25 16:03:11', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Rekap Agen Non Aktif PH<br />\r\nðŸ‘‰ðŸ» Packing &amp; Kirim Tukar Poin SDP<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Produk Promo Voucher PH<br />\r\nðŸ‘‰ðŸ» Update Harga di Shopee<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*ANZ<br />\r\n*KONTERDIGITAL<br />\r\n*Media Komunika<br />\r\n*PANGESTU TRONIK<br />\r\n*Mbk Pulsa<br />\r\n*Annaser Reload<br />\r\n*Asya Epay<br />\r\n*KML<br />\r\n*Sarvenaz<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Robby<br />\r\n*PH</p>\r\n', '2023-05-25'),
(150, '2023-05-25 16:03:14', '64', '<p>- Post Konten Tips XML<br />\r\n- Story Konten Tips XML<br />\r\n- Membuat Tema dan caption writing Doa untuk SDP<br />\r\n- Membuat vector Orang sedang gusar di tempat tidur. Untuk Video &#39;Doa SDM mobile<br />\r\n- Membuat Lay Out Kamar Tidur Untuk Video &#39;Doa SDM mobile<br />\r\n- Membuat Vector Orang sedang sholat atau bersujud. Untuk Video Motion Grafis &#39;Doa SDM mobile<br />\r\n- Membuat vector Orang sedang Berdoa Untuk Video Motion Grafis &#39;Doa SDM mobile<br />\r\n- Edit video vector tersebut agar bergerak atau bisa di sebut edit rigging tubuh Untuk Video &#39;Doa SDP mobile<br />\r\n- Edit Transisi perscene dari scene 1 dan ke scene 2 Untuk video &#39;Doa SDP mobile<br />\r\n- Edit text voice over Untuk video &#39;Doa SDP mobile<br />\r\n- Desain Cover Doa Untuk Video Doa SDP mobile<br />\r\n- Rendering Video Doa SDP mobile &nbsp;<br />\r\n- Desain Konten Motivasi SDP<br />\r\n- Desain Story Motivasi SDP</p>\r\n', '2023-05-25'),
(151, '2023-05-25 16:04:07', '67', '<p><br />\r\n-Design GiveAway XML<br />\r\n-Design Motion Aplikasi Pulsa Hoki<br />\r\n-Motion Aplikasi Pulsa Hoki</p>\r\n', '2023-05-25'),
(152, '2023-05-25 16:04:38', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Mutasi Bank H2H tgl 24 Mei (Accurate)<br />\r\n7. Rekap Daftar Karyawan, Menghitung THR<br />\r\n8. Membuat Invoice Untuk Agen</p>\r\n', '2023-05-25'),
(153, '2023-05-25 16:13:43', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 25 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 23/05 yang sdh datang : (SPL : Daffina,Favour)<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan konter untuk hari jumat<br />\r\n- Rekap target voucher</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-25'),
(154, '2023-05-25 16:20:57', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax<br />\r\n*SadayaMobile<br />\r\n*marketingindotel<br />\r\n*Cs_microfazz<br />\r\n*PrismalinkInternationalop</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-25'),
(155, '2023-05-25 16:43:51', '52', '<p>-mengarahkan dan memantau opr ototepe rekapan + hitung equoto tgl 24<br />\r\n-diskusi dengan pakyudi<br />\r\n-koordinasi kurangan GS dgn mas adit<br />\r\n-delegasi all server login kopra dgn id mcm, request dari mba yuli mandiri<br />\r\n-delgasi hrd open rekruitmen sales dan opr ototepe<br />\r\n-review design lowker memberi masukan<br />\r\n-mengarahkan wildan, memberi masukan program GA<br />\r\n-cek addon ototepe ga nyambung, inet down, konfirmasi pakyudi<br />\r\n-kofirmasi sales, rekap server kompetitor<br />\r\n-konfirmasi pembelian kartu perdana baru ke mas ade<br />\r\n-cek akun mandiri ssb konfirmasi pakyudi<br />\r\n-cek cara kerja mcm mandiri, aktivasi soft token mandiri ph<br />\r\n-mengarahkan dan memantau opr ototepe, buat panduan ototepe</p>\r\n', '2023-05-25'),
(156, '2023-05-25 16:50:43', '70', '<p>25 Mei 2023<br />\r\n- update nama aplikasi XML-MOBILE: Pulsa,Kuota &amp; PPOB &raquo; di akun developer (sudah up)<br />\r\n- set produk umroh dan roamax di PG<br />\r\n- info cs SSB cara untuk meminta bukti validasi ke spl dr komplainan pulsa yang tidak masuk<br />\r\n- hapus data dan open close addon winpay (all server) yang terjadi aliran hit deras ke API cek status pihak vendor<br />\r\n- cek rekapan bank ,invent dan rekapan biaya &amp; margin trx SSB tgl 23 dan 24<br />\r\n&nbsp; &gt;&gt; info cs SSB untuk revisi rekapan biaya dan margin trx SSB tgl 23 dan 24<br />\r\n- cek equoto SSB tgl 23 dan 24<br />\r\n&nbsp; &gt;&gt; info cs SSB untuk revisi equoto tgl 23 , sebelumnya minus karena digipos salah motong saldo ngrs<br />\r\n&nbsp; &gt;&gt; info cs SSB untuk revisi equoto tgl 24 , salah link saldo kemarin<br />\r\n- cek rekapan bank , invent , dan rekapan biaya &amp; margin trx PG tgl 23 dan 24<br />\r\n- cek equoto PG tgl 23 dan 24<br />\r\n- cek selisih equoto PG tgl 23<br />\r\n&nbsp; &gt;&gt; selisih karena ada nya langganan GM dan ML (sudah di UNREG)<br />\r\n- pantau trx SU<br />\r\n- cek margin trx SU<br />\r\n- info opr h2h untuk memperbaiki produk yang up nya perlu diperbaiki<br />\r\n- info cs SSB untuk share hasil rekapan invent dan rekapan bank di grup<br />\r\n- cek addon BRI retail error (sudah normal)<br />\r\n- cek addon Mandiri retail error (sudah normal)<br />\r\n- update aplikasi PG di ps (sudah up)<br />\r\n&nbsp; &gt;&gt; tambah menu only 4u dan digipos<br />\r\n&nbsp; &gt;&gt; update flow menu jumat berkah (sebelumnya input nomor, baru pilih produk ||&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; sekarang diupdate jadi pilih produk dlu baru input nomor)<br />\r\n- followup cs SDP, PG, PH , SSB untuk mencoba login di link mandiri kopra<br />\r\n- coba login mandiri SSB dengan link mcm dan kopra<br />\r\n- reset password mandiri mcm SSB<br />\r\n- info cs SSB userid,company id , password mandiri mcm</p>\r\n', '2023-05-25'),
(157, '2023-05-25 18:00:12', '68', '<ul>\r\n	<li>debug dan test log_test.test</li>\r\n	<li>set configurasi test kirim slip gaji via whatsapp</li>\r\n	<li>testing kirim slip gaji via whatsapp</li>\r\n	<li>retest kirim slip gaji via email</li>\r\n	<li>cari referensi pemecahan masalah tidak bisa akses fitur lesssecureaps google account</li>\r\n	<li>update xml testimoni CS PG (Matthew)</li>\r\n	<li>perbaikan dan test sql query count total tugas masuk</li>\r\n	<li>perbaikan dan test sql query tampil tugas dalam proses</li>\r\n	<li>backup perubahan code elaporan ke repo locel</li>\r\n	<li>backup perubahan code elaporan ke repo github</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-25');
INSERT INTO `pekerjaan` (`id`, `tanggal`, `karyawan`, `pekerjaan`, `tgl`) VALUES
(158, '2023-05-26 16:00:15', '65', '<p>Design1 Report Harian Tanggal 26 Mei 2023</p>\r\n\r\n<p>- Design banner download berbagai macam design xml<br />\r\n- Design icon download berbagai macam design xml<br />\r\n- Update design brosur xml<br />\r\n- Design loker area kawunganten - sidareja<br />\r\n- Design loker operator &amp; cs<br />\r\n- Design banner agen faza cell&nbsp;</p>\r\n', '2023-05-26'),
(159, '2023-05-26 16:02:07', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Rekap mutasi bank h2h, pt dan retail tgl 25 Mei<br />\r\n3. Input mutasi bank retail tgl 23, 24 Mei (accurate)<br />\r\n4. Membantu acc1 hitung uang retail<br />\r\n5. Input transaksi pembelian tgl 20, 21, 22 Mei (accurate)</p>\r\n', '2023-05-26'),
(160, '2023-05-26 16:02:11', '55', '<p>ACCOUNTING 1 REPORT HARIAN 26 mei 2023<br />\r\n1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Menghitung dan setor Uang Retail, Cas Voucher, Cash Sales<br />\r\n7. Rekap Nota Biaya</p>\r\n', '2023-05-26'),
(162, '2023-05-26 16:03:16', '68', '<ul>\r\n	<li>upload loker marketing area web xmltronik.com</li>\r\n	<li>buat app password account gmail untuk test kirim slip gaji via email.</li>\r\n	<li>edit configurasi code vba excel test kirim slip gaji via email</li>\r\n	<li>re test kirim slip gaji via email (work)</li>\r\n	<li>membuat halaman download&nbsp;</li>\r\n	<li>tambah menu download di header</li>\r\n	<li>edit menu panduan xmltronik</li>\r\n	<li>recreate menu panduan menjadi menu aplikasi</li>\r\n</ul>\r\n', '2023-05-26'),
(163, '2023-05-26 16:03:20', '64', '<p>- Post Doa SDP<br />\r\n- Story Doa SDP<br />\r\n- Post Tips SSB<br />\r\n- Story Tips SSB<br />\r\n- Post Pertanyaan PG<br />\r\n- Story Pertanyaan PG<br />\r\n- Membuat Tema dan caption writing Quote/motivasi XML<br />\r\n- Desain Konten Quote/motivasi XML<br />\r\n- Desain Story Quote/motivasi XML<br />\r\n- Membuat Tema dan caption writing Pertanyaan SSB<br />\r\n- Desain Konten Pertanyaan SSB<br />\r\n- Desain Story Pertanyaan SSB<br />\r\n- Post Konten&nbsp; XML<br />\r\n- Story Loker XML</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-26'),
(164, '2023-05-26 16:03:33', '67', '<p>-Design Topup Mobile Legend PH<br />\r\n-Design Topup Mobile Legend SDP<br />\r\n-Design Topup FreeFire PH<br />\r\n-Design Topup FreeFire SDP<br />\r\n-Design Smartfren Unlimited SDP<br />\r\n-Design Topup Gojek PH<br />\r\n-Design TopupGojek SDP<br />\r\n-Design Telkomsel Telpon Promo PH<br />\r\n-Design Telkomsel Telpon Promo SDP<br />\r\n-Design X Banner Jual Paket Data XML<br />\r\n-Design X Banner Jual Pulsa XML</p>\r\n', '2023-05-26'),
(165, '2023-05-26 16:06:28', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Rekap Agen Non Aktif PH<br />\r\nðŸ‘‰ðŸ» Backup PH Cs jumatan<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Croscek Orderan Voucher<br />\r\nðŸ‘‰ðŸ» Post Konten Produk PH<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*AzPayment<br />\r\n*NARA Teknologi<br />\r\n*Coy62 Pulsa<br />\r\n*Wib Pulsa<br />\r\n*IPAY<br />\r\n*ARCOM<br />\r\n*DN payment<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Forteen<br />\r\n*Yt cell<br />\r\n*PH<br />\r\n*TERAS Cell<br />\r\n*Galuh</p>\r\n', '2023-05-26'),
(166, '2023-05-26 16:15:22', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax<br />\r\n*SadayaMobile<br />\r\n*marketingindotel<br />\r\n*Cs_microfazz<br />\r\n*PrismalinkInternationalop</p>\r\n', '2023-05-26'),
(167, '2023-05-26 16:31:41', '52', '<p>-delegasi anam revisi brosur sales, konfirmasi cetak ke zona<br />\r\n-mengarahkan opr ototepe , ngajarin cara cek dan refund transaksi<br />\r\n-mengarahkan wildan buat link download tools<br />\r\n-request design icon ke tim design<br />\r\n-diskusi dgn pakyudi<br />\r\n*tambah karyawan spv sales<br />\r\n*Analisa trx downline sales untuk mencari solusi dalam menaikan trx<br />\r\n*reporting setiap kegiatan/kunjungan<br />\r\n*Gapok training 2.5 +reimburse bensin<br />\r\n*lepas training tambahan insentif 500rb<br />\r\n*ngurusin sales, menyediakan kebutuhan sales,<br />\r\n*buat program utk menaikan transaksi<br />\r\n*survey agen yg tempo<br />\r\n*alokasi budget limit saldo sales 100jt<br />\r\n-delegasi hrd ganti loker area sales dan share ke grup sesuai daerahnya<br />\r\n-ngajarin opr ototepe mengulangi yg dipelajari kemarin<br />\r\n-pantau opr ototepe<br />\r\n-cek addon kios gamer 2x eror login</p>\r\n', '2023-05-26'),
(168, '2023-05-26 16:33:38', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 26 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Cek stok fisik di SU<br />\r\n- Order voucher ; (SPL : Daffina,Otim,Aswa,Favour,Citra,Muji,Toni)<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan konter untuk hari sabtu<br />\r\n- Rekap target voucher</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-26'),
(169, '2023-05-26 16:35:00', '70', '<p>26 Mei 2023<br />\r\n- cek expired web report h2h dan bayar perpanjang tahunan<br />\r\n- backup operator h2h (sholat jumat)<br />\r\n&nbsp; &gt;&gt; pantau trx SU<br />\r\n&nbsp; &gt;&gt; mengarahkan produk ke jalur yg lancar<br />\r\n- backup cs SSB (sholat jumat)<br />\r\n&nbsp; &gt;&gt; menjawab komplainan agen dan meneruskan komplainan ke supplier<br />\r\n- cek laba/rugi dan equoto SSB tgl 25<br />\r\n- cek rekapan bank ,invent dan rekapan biaya &amp; margin trx SSB tgl 25<br />\r\n- menjelaskan ke cs SSB yang menyebabkan saldo supplier plus (tgl 25)<br />\r\n- cek jalur produk reguler di SSB<br />\r\n- info cs SSB untuk mengarahkan produk reguler ke jalur yang lebih murah<br />\r\n&nbsp; &gt;&gt; beberapa produk indosat reguler ke indonesia<br />\r\n&nbsp; &gt;&gt; produk three ke sagara backup amc<br />\r\n&nbsp; &gt;&gt; beberapa produk xl/axis reguler ke xml dan indonesia<br />\r\n&nbsp; &gt;&gt; produk shopeepay admin ke indonesia backup xml<br />\r\n- order three transfer 10jt 8.8%<br />\r\n- set harga untuk xml 8.6%<br />\r\n- info ke cs PG untuk open produk jumat berkah<br />\r\n- info cs PG untuk mengarahkan produk reguler ke jalur yang lebih murah<br />\r\n&nbsp; &gt;&gt; beberapa produk indosat reguler ke indonesia<br />\r\n&nbsp; &gt;&gt; produk telkomsel 20 ke kingu backup xml<br />\r\n&nbsp; &gt;&gt; produk three ke sagara</p>\r\n', '2023-05-26'),
(170, '2023-05-27 16:00:33', '68', '<ul>\r\n	<li>upload testixml CS Ototepe&nbsp;</li>\r\n	<li>buat data gaji xml test</li>\r\n	<li>buat slip gaji xml test</li>\r\n	<li>seting code vb emailing gaji xml test</li>\r\n	<li>seting penyimpanan slip gaji xml test</li>\r\n	<li>buat dan set configurasi tombol menu emailing gaji xml test</li>\r\n	<li>testing emailing gaji xml test.</li>\r\n	<li>demo emailing gaji xml test ke HRD</li>\r\n</ul>\r\n', '2023-05-27'),
(171, '2023-05-27 16:02:31', '64', '<p>- Post Pertanyaan SSB<br />\r\n- Story Pertanyaan SSB<br />\r\n- Membuat Tema dan caption writing Pertanyaan PH<br />\r\n- Desain Konten Pertanyaan PH<br />\r\n- Desain Story Pertanyaan PH<br />\r\n- Membuat Tema dan caption writing Awas / Waspada PG<br />\r\n- Desain Konten&nbsp; Awas / Waspada PG<br />\r\n- Desain Story&nbsp; Awas / Waspada PG</p>\r\n', '2023-05-27'),
(172, '2023-05-27 16:03:39', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Produk Promo Voucher H2H/Retail<br />\r\nðŸ‘‰ðŸ» Croscek Stok Opname Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Stok Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Penjualan Voucher<br />\r\nðŸ‘‰ðŸ» Menyiapkan Orderan Shopee<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*RAKAN PONSEL<br />\r\n*Yuscom<br />\r\n*Gerobak Pulsa<br />\r\n*prawira<br />\r\n*CDS Reload<br />\r\n*Alex Cell<br />\r\n*Psv<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Shopee<br />\r\n*Windi<br />\r\n*PH<br />\r\n*Robby<br />\r\n*Atun</p>\r\n', '2023-05-27'),
(173, '2023-05-27 16:04:10', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Rekap transaksi penjualan, pembelian dan jkp tgl 25, 26 Mei<br />\r\n3. Input transaksi pembelian tgl 23 Mei (accurate)<br />\r\n4. Input transaksi penjualan dan jkp tgl 25, 26 Mei (accurate)<br />\r\n5. Rekap mutasi bank h2h, pt dan retail tgl 26 Mei<br />\r\n6. Input mutasi bank h2h, dan pt tgl 26 Mei (accurate)<br />\r\n7. Input mutasi bank retail tgl 25, 26 Mei (accurate)<br />\r\n8. Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n9. Input biaya sms1900/kas e wallet (accurate)<br />\r\n10. Input komisi dan tukar komisi retail (accurate)</p>\r\n', '2023-05-27'),
(174, '2023-05-27 16:05:05', '67', '<p>&nbsp;</p>\r\n\r\n<p>-Design Kuota Ketengan Indosat<br />\r\n-Design Topup Shopee PH<br />\r\n-Design Topup Shopee SDp<br />\r\n-Design Topup Dana PH<br />\r\n-Design Topup Dana SDP<br />\r\n-Design Pulsa Transfer Indosat SSB<br />\r\n-Design Pulsa Transfer Axis &amp; XL SSB<br />\r\n-Design Pulsa Transfer Three SSB<br />\r\n-Design Pulsa Transfer Telkomsel SSB<br />\r\n-Design Jual Pulsa XML&nbsp;</p>\r\n', '2023-05-27'),
(175, '2023-05-27 16:06:22', '54', '<p>27 mei 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC 26 Mei 23</li>\r\n	<li>Rekap KPI Retail, CS, support, OPR, SDP &amp; PH, marketing, data voucher</li>\r\n	<li>Update performance kpi karyawan yang sudah 100%</li>\r\n	<li>Screening cv</li>\r\n	<li>Perbarui format mailing kontrak</li>\r\n	<li>List nama2 untuk perpanjang kontrak</li>\r\n	<li>Rekap iklan (japri dan minta link untuk dicek upload iklan di grup)</li>\r\n	<li>Rekap absensi</li>\r\n	<li>Cek komplain sdp &amp; ph</li>\r\n	<li>Trial emailing slip gaji dijelaskan oleh programmer</li>\r\n	<li>Rekap Skd</li>\r\n</ul>\r\n\r\n<p>1. skd an novia tanggal 25-26 mei (diare)</p>\r\n', '2023-05-27'),
(176, '2023-05-27 16:06:43', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Bank H2H tgl 25 Mei (Accurate)<br />\r\n7. Rekap Nota Biaya</p>\r\n', '2023-05-27'),
(177, '2023-05-27 16:31:33', '70', '<p>27 Mei 2023<br />\r\n- pantau transaksi ototepe dan mengarahkan cs ototepe jika ada trx pending<br />\r\n- cek wa center SSB tidak respon ,chat looping<br />\r\n- update imcenter v1056 SSB<br />\r\n- cek outbox bigbox samsin gagal , ganti link<br />\r\n- info cs SSB produk promo yang belum ada flayer , minta design2 untuk bwt flayer<br />\r\n- pantau trx SU<br />\r\n- cek margin SU dan menginfokan ke opr untuk produk yang harus diperbaiki margin nya<br />\r\n- cek port kuning di ototepe<br />\r\n- cek addon ototepe tidak respon<br />\r\n- cek laba/rugi dan equoto SSB tgl 26<br />\r\n- cek laba/rugi dan equoto PG tgl 25 dan 26<br />\r\n- cek rekapan bank ,invent dan rekapan biaya &amp; margin trx SSB tgl 25 dan 26<br />\r\n- cek rekapan bank ,invent dan rekapan biaya &amp; margin trx PG tgl 25 dan 26<br />\r\n- diskusi dg opr retail , format daftarkan downline manual agar downline masuk ke grup UV<br />\r\n- pasang banner (download berbagai macam design/tools...) web androdi dan pasang link download nya (retail)<br />\r\n- pasang icon link youtube di menu agen web android (retail)</p>\r\n', '2023-05-27'),
(178, '2023-05-27 17:32:47', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 27 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 26/05 yang sdh datang : (SPL : Otim,Toni,Muji Isat)<br />\r\n- Stok opname voucher<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan konter untuk hari minggu dan senin<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-27'),
(179, '2023-05-28 16:06:49', '65', '<p>Design1 Report Harian Tanggal 28 Mei 2023</p>\r\n\r\n<p>- Update design brosur harga PG<br />\r\n- Design transfer antar bank PG<br />\r\n- Revisi design banner download berbagai macam design xml<br />\r\n- Design aktivasi inject voucher axis PH<br />\r\n- Update design transaksi xml<br />\r\n- Design pulsa transfer xml</p>\r\n', '2023-05-28'),
(180, '2023-05-28 16:26:30', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax<br />\r\n*Cspixindo<br />\r\n*marketingsyandana1<br />\r\n*ardiansyahnya<br />\r\n*csutamireload<br />\r\n*csnusantarapulsa<br />\r\n*metapaycs<br />\r\n*ghofirtronik<br />\r\n*andriteduh<br />\r\n*revana1<br />\r\n*cs_premiumH2H<br />\r\n*feriareload<br />\r\n*CS1_KMLH2H<br />\r\n*cs_pascapay<br />\r\n*YUSCOM_PRODUK</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-28'),
(181, '2023-05-28 16:27:55', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Update Harga Produk Promo PH<br />\r\nðŸ‘‰ðŸ» Croscek Jalur Produk Promo<br />\r\nðŸ‘‰ðŸ» Menyiapkan Gosokan Voucher<br />\r\nðŸ‘‰ðŸ» Update Rincian Produk<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*PH<br />\r\n*PG<br />\r\n*Selvy</p>\r\n', '2023-05-28'),
(182, '2023-05-28 16:30:05', '52', '<p>-mengarahkan opr baru dan rekapan saldo ototepe<br />\r\n-mengarahkan opr ototepe update harga jual harga beli<br />\r\n-cari selisih ototepe<br />\r\n-cari tsel tf, golden rate 13.8% , hendri 14%<br />\r\n-order hendri 14% 64jt, rekap dan tf<br />\r\n-mengarahkan opr ototepe registrasi kartu baru<br />\r\n-mengarahkan opr ototepe memberi label kartu baru<br />\r\n-promo dan menawarkan vocer gs<br />\r\n-pantau trx ototepe<br />\r\n-cek jadwal, update jadwal juni, konfirmasi jadwal tukar libur septi dan lutfi bulan juni ke hrd<br />\r\n-delegasi anam buat design banner, buat design jual pulsa di shopee<br />\r\n-coba up produk jualan pulsa di shopee<br />\r\n-test pembelian pulsa dri seller lain<br />\r\n-cari tau proses pengiriman tanpa ongkir/ekspedisi</p>\r\n', '2023-05-28'),
(183, '2023-05-29 16:01:03', '68', '<ul>\r\n	<li>breafing userlevel elaporan dengan pak yudi</li>\r\n	<li>pasang switcher printer hrd</li>\r\n	<li>testing switcher printer hrd</li>\r\n	<li>buat table user_level</li>\r\n	<li>buat tabel user_level</li>\r\n	<li>buat form input user_level</li>\r\n	<li>buat dan test sql cek user level tersedia</li>\r\n	<li>buat dan test sql input user level</li>\r\n	<li>testing input user level</li>\r\n	<li>buat form edit data user level</li>\r\n	<li>buat aliran data edit date user level</li>\r\n	<li>buat dan testing query edit data user level</li>\r\n	<li>testing edit data user level</li>\r\n	<li>buat menu hapus user level</li>\r\n	<li>buat dan test query hapus user level</li>\r\n	<li>test menu hapus user level</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-05-29'),
(184, '2023-05-29 16:01:04', '65', '<p>Design1 Report Harian Tanggal 29 Mei 2023</p>\r\n\r\n<p>- Design transfer antar bank PG<br />\r\n- Design bayar tagihan pdam PG<br />\r\n- Design top up voucher game PG<br />\r\n- Design promo vocuher kosong PG<br />\r\n- Design hari besar hari lahir pancasila xml<br />\r\n- Design story hari besar hari lahir pancasila xml<br />\r\n- Design banner hari besar hari lahir pancasila xml<br />\r\n- Design icon home credit PH<br />\r\n- Design icon cappela PH</p>\r\n', '2023-05-29'),
(185, '2023-05-29 16:01:55', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Rekap mutasi bank h2h, pt dan retail tgl 27, 28 Mei<br />\r\n3. Input mutasi bank retail tgl 27, 28 Mei (accurate)<br />\r\n4. Input biaya sms1900/kas e wallet (accurate)<br />\r\n5. Input komisi dan tukar komisi retail (accurate)<br />\r\n6. Rekap biaya tgl 1 - 28 Mei 2023</p>\r\n', '2023-05-29'),
(186, '2023-05-29 16:02:29', '67', '<p>-Design Cashback XML<br />\r\n-Design Topup Genshin Impact SDP<br />\r\n-Design Topup Pubg SDP<br />\r\n-Design Topup AOV SDP<br />\r\n-Design Topup Call of Duty SDP<br />\r\n-Design Topup Garena SDP</p>\r\n', '2023-05-29'),
(187, '2023-05-29 16:02:48', '64', '<p>- Post quote/motivasi&nbsp; XML<br />\r\n- Story quote/motivasi&nbsp; XML<br />\r\n- Post Awas PG<br />\r\n- Story Awas PG<br />\r\n- Membuat Tema dan caption writing Testimoni SSB pay<br />\r\n- Desain Testimoni SSBpay<br />\r\n- Desain Story Testimoni SSBpay<br />\r\n- Desain Konten Hari Lahir Pancasila SSBpay<br />\r\n- Desain Story Hari Lahir Pancasila SSBpay<br />\r\n- Desain Apk Hari Lahir Pancasila SSBpay</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-29'),
(188, '2023-05-29 16:04:39', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax<br />\r\n-Update produk<br />\r\nPUBG<br />\r\nSHM<br />\r\nTN<br />\r\nUTN<br />\r\nMLPP<br />\r\nTTN<br />\r\nXCF<br />\r\n-update harga<br />\r\nBYU</p>\r\n', '2023-05-29'),
(189, '2023-05-29 16:11:14', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Pembetulan SPT OP<br />\r\n7. Merapihkan excel Penggajian</p>\r\n', '2023-05-29'),
(190, '2023-05-29 16:17:38', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 29 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 26/05 yang sdh datang : (SPL : Daffina,Favour)<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan konter untuk hari selasa<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan voucher offline<br />\r\n1. Teguh<br />\r\n2. Erna<br />\r\n3. PH<br />\r\n4. Retno<br />\r\n5. PG</p>\r\n', '2023-05-29'),
(191, '2023-05-29 17:06:16', '70', '<p>29 Mei 2023<br />\r\n- cek outbox samsin gagal kirim (link belum update apilogy) , minta link update ke pak yudi<br />\r\n- konfirmasi ke mattew minus eqoto tgl 25 (trx three transfer salah resend)<br />\r\n- info nina , ganti rugi akmal (trx tdk respon diresend spl indonesia) dan mattew (trx three trf salah resend)&nbsp; potong gaji<br />\r\n- cek parsing paket telp di digipos dengan hargamax<br />\r\n- mencoba ubah format daftarkan downline agar masuk ke grup UV<br />\r\n- pantau trx SU<br />\r\n- cek margin trx SU dan info ke opr untuk memperbaiki produk yang margin nya perlu diperbaiki<br />\r\n- cek L/R SSB dan info ke cs SSB produk dan jalur yg harus diperbaiki<br />\r\n- cek rekapan bank , invent supplier , dan biaya &amp;margin SSB tgl 27 dan 28<br />\r\n- cek equoto SSB tgl 27 dan 28<br />\r\n- info cs SSB untuk revisi link saldo kemarin ada yg salah<br />\r\n- cek equoto PG tgl 27 dan 28<br />\r\n- cek rekapan bank , invent supplier , dan biaya &amp;margin PG tgl 27 dan 28<br />\r\n- cek L/R SSB dan info ke cs PG produk dan jalur yg harus diperbaiki</p>\r\n', '2023-05-29'),
(192, '2023-05-29 17:30:47', '52', '<p>-hitung equoto ototepe tgl 28<br />\r\n-pantau trx ototepe<br />\r\n-order hendri 14% 84jt, rekap dan tf<br />\r\n-set terminal dan modul chips baru<br />\r\n-siapkan dan kirim dokumen syarat ubah nama komisaris<br />\r\n-buat surat pernyataan sanggahan untuk qris mandiri<br />\r\n-menjawab telfon dari sales eko, menjelaskan kendalanya, konfirmasi pakyudi<br />\r\n-menjawab telfon dari agen tempo dl eko, menjelaskan kendalanya<br />\r\n-diskusi dgn pakyudi dan irfan<br />\r\n-cek semua ijazah, serah terima ke hrd<br />\r\n-cek dan test transaksi tsel telfon konfirmasi pakyudi</p>\r\n\r\n<p>Acc Pengajuan Cuti Bulan Juni:<br />\r\n1.&nbsp; Yani tukar libur dengan novia di tanggal 5 juni<br />\r\n2.&nbsp; Yani cuti tanggal 3-4 juni backup adm pagi novia (3hr dengan libur mingguan<br />\r\n3.&nbsp; Vani cuti tanggal 6 juni (2hr dgn libur mingguan)<br />\r\n4.&nbsp; Nafitta cuti tanggal 5 juni backup ph pagi gesang (2hr dgn libur mingguan)<br />\r\n5.&nbsp; Alan cuti tanggal 4 juni backup cs pagi vani&nbsp; (2hr dgn libur mingguan)<br />\r\n6.&nbsp; Zalfa tuker libur di tanggal 3 juni<br />\r\n7.&nbsp; Angga cuti tanggal 6 juni backup opr pagi gesang&nbsp; (1 hari)<br />\r\n8.&nbsp; Nina cuti tanggal 6 juni&nbsp; (1 hari)<br />\r\n9.&nbsp; Cholid cuti tanggal 5 juni backup opr siang wildan&nbsp; (2hr dgn libur mingguan)</p>\r\n', '2023-05-29'),
(193, '2023-05-30 15:52:02', '57', '<ul>\r\n	<li>cuma test aja</li>\r\n</ul>\r\n', '2023-05-30'),
(195, '2023-05-30 16:00:39', '65', '<p>Design1 Report Harian Tanggal 30 Mei 2023</p>\r\n\r\n<p>- Design hari besar hari lahir pancasila PG<br />\r\n- Design story hari besar hari lahir pancasila PG<br />\r\n- Design banner apk hari besar hari lahir pancasila PG<br />\r\n- Design hari besar waisak xml<br />\r\n- Design story hari besar waisak xml<br />\r\n- Design banner apk hari besar waisak xml</p>\r\n', '2023-05-30'),
(196, '2023-05-30 16:01:05', '64', '<p>- Post Pertanyaan PH<br />\r\n- StoryPertanyaan PH<br />\r\n- Post Testimoni SSB pay<br />\r\n- Story Testimoni SSB pay<br />\r\n- Membuat Tema dan caption writing Hiburan Untuk SDP<br />\r\n- Desain Hiburan SDP<br />\r\n- Desain Story Hiburan SDP<br />\r\n- Desain Hari Lahir Pancasila SSB<br />\r\n- Desain benner APK&nbsp; Hari Lahir Pancasila SSB<br />\r\n- Desain Story&nbsp; Hari Lahir Pancasila SSB<br />\r\n- Post Motivasi SDP<br />\r\n- Story Motivasi SDP</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-30'),
(197, '2023-05-30 16:01:20', '67', '<p>-Design Flayer Hari Lahir Pancasila PH<br />\r\n-Design Story Hari Lahir Pancasila PH<br />\r\n-Design Banner Hari Lahir Pancasila PH<br />\r\n-Design Flayer Hari Lahir Pancasila SDP<br />\r\n-Design Story Hari Lahir Pancasila SDP<br />\r\n-Design Banner Hari Lahir Pancasila SDP<br />\r\n-Design Aktivasi Voucher XL Combo SSB<br />\r\n-Design Aktivasi Voucher XL Hotrod SSB<br />\r\n-Design Voucher Data Axis Promo PH<br />\r\n-Design Voucher Data Telkomsel PH<br />\r\n-Update Design Jual Pulsa XML</p>\r\n', '2023-05-30'),
(198, '2023-05-30 16:03:26', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax<br />\r\n-Followup :<br />\r\n*Marketing_asiatronik<br />\r\n*ardiansyahnya<br />\r\n*Jonimutronik<br />\r\n*csutamireload<br />\r\n*cs1_sunreload<br />\r\n*Cs_microfazz<br />\r\n*roketmonsterppob<br />\r\n*rudihartono53<br />\r\n*cs_kuotaku<br />\r\n*csbaik<br />\r\n*metapaycs<br />\r\n*KenzieKomunika<br />\r\n*Benuapulsa<br />\r\n*mktmiharo_Sari<br />\r\n*marketing_BJHGROUP<br />\r\n*ryra_official<br />\r\n*pt_prodigi</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-30'),
(199, '2023-05-30 16:09:44', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Konsep Konten PH/SDP<br />\r\nðŸ‘‰ðŸ» Croscek Orderan Voucher<br />\r\nðŸ‘‰ðŸ» Update Harga Voucher PH<br />\r\nðŸ‘‰ðŸ» Update Harga Produk Promo PH<br />\r\nðŸ‘‰ðŸ» Croscek Jalur Produk Promo<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Aktifasi Jasa Kirim Shopee<br />\r\nðŸ‘‰ðŸ» Rekap Stok Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Penjualan Voucher<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*Elyo<br />\r\n*KonterDigital<br />\r\n*Caraka Reload<br />\r\n*PULSAKU<br />\r\n*Ryra Multipay<br />\r\n*MP Reload<br />\r\n*Harmareload<br />\r\n*AzPayment<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Teguh<br />\r\n*Teras Cell<br />\r\n*Erna<br />\r\n*Fourteen</p>\r\n', '2023-05-30'),
(200, '2023-05-30 16:10:18', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 30 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Cek stok fisik di SU<br />\r\n- Order voucher<br />\r\n(SPL : Daffina,Otim,Aswa,Favour,Citra,Muji K)<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan Konter untuk hari rabu<br />\r\n- Menyiapkan orderan offline (Teguh)<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-30'),
(201, '2023-05-30 16:14:02', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Rekap transaksi penjualan, pembelian dan jkp tgl 27, 28, 29 Mei<br />\r\n3. Rekap mutasi bank h2h, pt dan retail tgl 29 Mei<br />\r\n4. Input mutasi bank h2h, dan pt tgl 27, 29 Mei (accurate)<br />\r\n5. Input mutasi bank retail tgl 27, 28, 29 Mei (accurate)<br />\r\n6. Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n7. Input biaya sms1900/kas e wallet (accurate)</p>\r\n', '2023-05-30'),
(202, '2023-05-30 16:15:41', '70', '<p>30 Mei 2023<br />\r\n- update addon sidompul v2.7<br />\r\n- cari jalur aktivasi voucher xl combo flex dan hotrod special<br />\r\n- info ke cs SSB aktivasi voc combo flex diarahkan ke Galery<br />\r\n- info cs SSB untuk menurunkan produk aktivasi combo flex dan buat flayer untuk bc di channel &amp; flayer untuk promo MK (dg harga MD)<br />\r\n- info cs PG set harga khusus aktivasi hotrod spesial untuk SSB (spl masterlod)<br />\r\n- info cs SSB aktivasi hotrod spesial diarahkan ke PG<br />\r\n- info cs SSB untuk menurunkan produk aktivasi hotrod spesial dan buat flayer untuk bc di channel &amp; flayer untuk promo MK (dg harga MD)<br />\r\n- cek transkasi omni PH, di addon masih proses , login digipos di hp sudah motong saldo<br />\r\n- cek L/R SSB dan info ke cs PG produk dan jalur yg harus diperbaiki<br />\r\n- cek equoto PG tgl 29<br />\r\n- cek equoto SSB tgl 29<br />\r\n- cek rekapan bank , invent supplier , dan biaya &amp;margin PG tgl 28 dan 29<br />\r\n- croscek ke cs PG supplier yang minus<br />\r\n- cek rekapan bank , invent supplier , dan biaya &amp;margin SSB tgl 28 dan 29<br />\r\n- pantau trx SU<br />\r\n- ganti banner (download banner menunjang usahamu) di web android<br />\r\n- ganti link tutorial youtube di web android<br />\r\n- compile aplikasi (cek banner dan link)<br />\r\n- cek kelompok jawaban provider retail dan SSB yang belum di cantumkan prioritas</p>\r\n', '2023-05-30'),
(203, '2023-05-30 16:19:23', '68', '<ul>\r\n	<li>perbaikan bug update data user</li>\r\n	<li>resetup konfigurasi cek login</li>\r\n	<li>debuging data cek login dan update data level user</li>\r\n	<li>buat pengkondisian menu untuk level user yang berbeda</li>\r\n	<li>testing tampilan menu untuk level user yang berbeda</li>\r\n	<li>perbaikan bug tampilan menu user level admin</li>\r\n	<li>setting pengkondisian halaman beranda untuk level user superadmin</li>\r\n	<li>setting pengkondisian otoritas superadmin</li>\r\n	<li>setup content halaman download</li>\r\n	<li>setup link download baner pulsa dan data</li>\r\n	<li>testing dan konfirmasi konten halaman download ke Marketing</li>\r\n	<li>buat halaman dan form upload file excel gaji_test</li>\r\n	<li>buat halaman import.php</li>\r\n	<li>buat table dan setup kolom table gaji_test</li>\r\n	<li>setup aliran data form upload file excel gaji test.</li>\r\n	<li>setup pemrosesan data excel yang diupload</li>\r\n	<li>testing upload file excel gaji test</li>\r\n	<li>cari referensi error upload file excel gaji test</li>\r\n	<li>buat halaman download pulsacilacap.com</li>\r\n	<li>layouting halaman download pulsacilacap.com</li>\r\n</ul>\r\n', '2023-05-30'),
(204, '2023-05-30 16:23:51', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Mutasi Bank H2H tgl 28 Mei 2023 (Accurate)<br />\r\n7. Input Pembelian Transaksi 24 Mei 2023 (Accurate)</p>\r\n', '2023-05-30'),
(205, '2023-05-30 17:42:59', '52', '<p>-mengarahkan opr baru :<br />\r\n*ngajarin ulang cara refund dan cek trx yg perlu di refund<br />\r\n*ngajarin input saldo agen, dan cek mutasi rekening<br />\r\n*ngajarin transfer ke spl<br />\r\n*rekapan saldo ototepe.<br />\r\n*update harga jual, dan info ke member<br />\r\n-cari stok tsel tp, order hendrik 14%<br />\r\n-diskusi dgn mas widi, memastikan resign tgl 31, menanyakan progres reposisi fais<br />\r\n-cari tau dan tes transaksi tsel telfon by digipos<br />\r\n-konfirmasi pembelian addon ke pandu<br />\r\n-mengarahkan vani ganti buku rekening<br />\r\n-mengarahkan vani daftar gratis ongkir keperluan shopee dan siapkan data yg dibutuhkan<br />\r\n-set port baru dan rekap ulang chips<br />\r\n-pasang chips baru titip ke support</p>\r\n', '2023-05-30'),
(206, '2023-05-31 16:00:31', '68', '<ul>\r\n	<li>instalasi radmin pc HRD</li>\r\n	<li>seting pengkondisian otoritas halaman tampil data report untuk level superadmin dan admin</li>\r\n	<li>seting alignment data report</li>\r\n	<li>perbaikan bug update data pegawai</li>\r\n	<li>hapus menu rekap report user level user biasa</li>\r\n	<li>buat pengkondisian otoritas halaman tugas untuk superadmin, admin, user</li>\r\n	<li>reseting tampilan menu halaman tugas untuk level user superadmin, admin, user.</li>\r\n	<li>beli tinta printer accounting dan HRD</li>\r\n	<li>ganti semua tinta printer accounting dan HRD</li>\r\n	<li>powercleaning printer HRD dan Accounting</li>\r\n	<li>headcleaning printer HRD dan Accounting</li>\r\n	<li>test nozle printer HRD dan Accounting</li>\r\n	<li>testing library import data excel ke mysql</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-05-31'),
(207, '2023-05-31 16:00:53', '65', '<p>Design1 Report Harian Tanggal 31 Mei 2023</p>\r\n\r\n<p>- Design hari lahir pancasila putih xml<br />\r\n- Design story hari lahir pancasila putih xml<br />\r\n- Design hari besar waisak PG<br />\r\n- Design story hari besar waisak PG<br />\r\n- Design banner apk hari besar waisak PG</p>\r\n', '2023-05-31'),
(208, '2023-05-31 16:01:22', '64', '<p>- Post Konten Hiburan SDP<br />\r\n- Story Konten Hiburan SDP<br />\r\n- Membuat Caption writing Hari Lahirnya Pancasila Untuk PG<br />\r\n- Membuat Caption writing Hari Lahirnya Pancasila Untuk PH<br />\r\n- Membuat Caption writing Hari Lahirnya Pancasila Untuk SDP<br />\r\n- Membuat Caption writing Hari Lahirnya Pancasila Untuk SSB<br />\r\n- Membuat Caption writing Hari Lahirnya Pancasila Untuk XML mobile<br />\r\n- Desain Konten SSB<br />\r\n- Desain Story SSB<br />\r\n-&nbsp; Edit Video Tutorial Cara deposit aplikasi xmlmobile melalui transfer bank</p>\r\n', '2023-05-31'),
(209, '2023-05-31 16:01:47', '67', '<p>-Design Info Pulsa Hoki<br />\r\n-Design Yuk Ajak Semuanya PH<br />\r\n-Design Yuk Ajak Semuanya SDP<br />\r\n-Design Giveaway PH<br />\r\n-Update Ukuran Banner SSB</p>\r\n', '2023-05-31'),
(210, '2023-05-31 16:02:29', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Input transaksi penjualan dan jkp tgl 27, 28, 29 Mei (accurate)<br />\r\n3. Rekap mutasi bank h2h, pt dan retail tgl 30 Mei<br />\r\n4. Input mutasi bank h2h, retail dan pt tgl 30 Mei (accurate)<br />\r\n5. Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n6. Input biaya sms1900/kas e wallet (accurate)<br />\r\n7. Input komisi dan tukar komisi retail (accurate)</p>\r\n', '2023-05-31'),
(211, '2023-05-31 16:03:08', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Pembelian Transaksi 25 Mei 2023 (Accurate)<br />\r\n7. Menyicil Excel Penggajian</p>\r\n', '2023-05-31'),
(212, '2023-05-31 16:11:56', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dg Tim Design<br />\r\nðŸ‘‰ðŸ» Produk Promo PH<br />\r\nðŸ‘‰ðŸ» Konsep Giveaway PH<br />\r\nðŸ‘‰ðŸ» Croscek Jalur Produk Promo<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Rekap Stok Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Penjualan Voucher<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*Lodpay<br />\r\n*Expayment<br />\r\n*Bambu Tronik<br />\r\n*Sumbu Pulsa<br />\r\n*Libersa<br />\r\n*Sonic Pulsa<br />\r\n*Radar<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Teguh<br />\r\n*PH<br />\r\n*Windi<br />\r\n*Tofu</p>\r\n', '2023-05-31'),
(213, '2023-05-31 16:19:03', '58', '<p>-Rekap transaksi Sales<br />\r\n-Rekap transaksi h2h<br />\r\n-Rekap transaksi retail<br />\r\n-Riset produk<br />\r\n-Tawar menawar harga dengan&nbsp; suplier<br />\r\n-menyesuaikan harga produk<br />\r\n-Cari produk/stok dengan harga terbaik<br />\r\n-Follow up mitra Retail<br />\r\n-Cek &amp; mengaktifkan produk close/gangguan<br />\r\n-Memantau naik &amp; turun transaksi<br />\r\n-Follow up mitra H2H<br />\r\n-Merencanakan konten<br />\r\n-Memantau harga kompetitor<br />\r\n-Analisa transaksi &amp; margin<br />\r\n-Update harga forum otomax</p>\r\n', '2023-05-31'),
(214, '2023-05-31 16:19:41', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 31 MEI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Cek stok fisik di SU<br />\r\n- Cek / bongkaran orderan voucher tgl 30/05 yang sdh datang : (SPL : Otim,Aswa,Citra,Muji Isat,Favour)<br />\r\n- Update rekapan<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan konter untuk hari jumat<br />\r\n- Rekap target voucher</p>\r\n', '2023-05-31'),
(215, '2023-05-31 16:24:08', '70', '<p>31 Mei 2023<br />\r\n- cek masa aktif kartu dan isi pulsa no 083874027274 (Marketing Online2)<br />\r\n- cek masa aktif kartu no 083874027277 (Marketing Online1)<br />\r\n- info cs SSB rekap data MK buat bikin flayer data MK SSB<br />\r\n- info cs PG untuk update trx dan margin di link<br />\r\n- set regex gagal otomax SSB (isatonly4u)<br />\r\n- pantau trx SU<br />\r\n- cek margin trx SU<br />\r\n- cek komplain MK produk isat only 4u loading terus , coba transkaksi dengan nomer lain dan record bukti kalo trx isat only 4u aman<br />\r\n- memperbaiki settingan produk dan bayar isat only 4u di web report SSB<br />\r\n- info cs SSB untuk melengkapi paket data only 4u (ada yang belum di input di web report)<br />\r\n- cari jalur transfer bank (MK request turun harga)<br />\r\n- info cs PG untuk daftar ke BHOBU (produk transfer bank)<br />\r\n- mencoba setting regex dan parsing produk paket telpon di ototepe<br />\r\n- cek equoto PG tgl 30<br />\r\n- cek L/R otomax PG tgl 30<br />\r\n- cek rekapan biaya dan margin PG tgl 30<br />\r\n- cek equoto SSB tgl 30<br />\r\n- cek L/R otomax SSB tgl 30<br />\r\n- cek rekapan biaya dan margin SSB tgl 30</p>\r\n', '2023-05-31'),
(216, '2023-06-01 16:00:11', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Input transaksi pembelian tgl 28 Mei (accurate)<br />\r\n3. Rekap mutasi bank h2h, pt dan retail tgl 31 Mei<br />\r\n4. Input mutasi bank h2h, retail dan pt tgl 31 Mei (accurate)<br />\r\n5. Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n6. Input biaya sms1900/kas e wallet (accurate)<br />\r\n7. Rekap biaya tgl 1 - 31 Mei 2023</p>\r\n', '2023-06-01'),
(217, '2023-06-01 16:09:49', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Pembelian Transaksi 26,27 Mei 2023 (Accurate)<br />\r\n7. Menghitung Gaji<br />\r\n8. Rekapan Nota</p>\r\n', '2023-06-01'),
(218, '2023-06-01 16:50:41', '52', '<p>31 Mei 2023<br />\r\n-konek addon digipos<br />\r\n-Briefing Sales<br />\r\n*Menjelaskan ulang ke eko, sistem teknis login<br />\r\n*Eko menceritakan kronologi, belum ada kelejasan<br />\r\n*Eko menanyakan<br />\r\n*mas muji menambahkan pengalaman dlnya ke hack<br />\r\n*eko kendala ada sales isat yg menjelek 2jelekan xml ke konter2 dl<br />\r\n*muji memberi saran cara merangkul sales provider<br />\r\n*muji request rekapan buku transaksi ditukar dgn poin agen<br />\r\n-diskusi dgn nina dan pakyudi<br />\r\n-tes dan cek trx tsel telfon by addon<br />\r\n-mencoba load data h2h konfirmasi eror ke pakyudi<br />\r\n-cek akun shopee jualan , pengajuan ditolak<br />\r\n-konfirmasi mas satrio, sms banking PG minta di non aktifkan<br />\r\n-pantau dan mengarahkan opr ototepe yg ditanyakan<br />\r\n-diskusi dgn tiara progres alan, sudah paham alurnya tinggal ngelancarin biar sat set<br />\r\n-menghubungi ady dan nugy minta arahan setting</p>\r\n\r\n<p>1 Juni 2023<br />\r\n-cek stok tsel transfer , rekap equoto ototepe<br />\r\n-diskusi dgn pakyudi dan nina<br />\r\n-diskusi dgn pakyudi<br />\r\n-set parsing tsel tlfn ototepe<br />\r\n-pantau trx ototepe, titip ke support sore<br />\r\n-membalas chat MK , delegasikan beberapa request dari MK ke ramdita dan andi<br />\r\n-cek kpi all karyawan, delegasi hrd berlakukan kpi ssb dan pg<br />\r\n-cek report biaya dari siska<br />\r\n-cek rekapan agen dari andi, kurang tgl aktif dan transaksi<br />\r\n-cek excel penggajian dari nina<br />\r\n-hitung gaji konter konfirmasi mba yeni lembur dan potongan</p>\r\n', '2023-06-01'),
(219, '2023-06-01 17:47:14', '70', '<p>1 Juni 2023<br />\r\n- followup reward MK PG dan SSB<br />\r\n- cek biaya sewa safana dan isi saldo untuk biaya sewa<br />\r\n&nbsp; &gt;&gt; xml retail &nbsp;<br />\r\n&nbsp; &gt;&gt; pulsahoki<br />\r\n&nbsp; &gt;&gt; SDP<br />\r\n&nbsp; &gt;&gt; Pulsagenggam<br />\r\n&nbsp; &gt;&gt; SSB<br />\r\n- pantau trx SU<br />\r\n- bantu cek settingan regex SIUPI di otomax h2h<br />\r\n- cek equoto SSB tgl&nbsp; 31<br />\r\n- cek equoto PG tgl&nbsp; 31<br />\r\n- cek rekapan biaya dan margin harian PG<br />\r\n&nbsp; &gt;&gt; ada biaya yang salah nominal dan belum diinputkan di rekapan<br />\r\n- rekap biaya bulanan SSB<br />\r\n- rekap biaya bulanan PG<br />\r\n- cek L/R otomax SSB tgl 1<br />\r\n- cek L/R otomax PG tgl 1<br />\r\n- update oto report otomax retail<br />\r\n- kroscek ke nina total gaji karyawan PG dan SSB<br />\r\n- menjelaskan ke cs SSB cara isi KPI<br />\r\n&nbsp; &gt;&gt; rekap member tidak aktif<br />\r\n&nbsp; &gt;&gt; rekap komplain member sn N/A atau sn pendek<br />\r\n&nbsp; &gt;&gt; followup member program dan flash sale produk<br />\r\n&nbsp; &gt;&gt; iklan<br />\r\n&nbsp; &gt;&gt; penambahan member aktif SSB ke akun pribadi<br />\r\n- set ip bhobu di otomax PG dan tes transaksi transfer bank<br />\r\n- info cs PG untuk mengarahkan produk transfer bank ke bhobu</p>\r\n', '2023-06-01'),
(220, '2023-06-02 15:55:24', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Voucher Lokal Cilacap<br />\r\nðŸ‘‰ðŸ» Produk Baru Axis Pure (Request Agen)<br />\r\nðŸ‘‰ðŸ» Iklan Voucher di Shopee<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dgn Tim Design<br />\r\nðŸ‘‰ðŸ» Croscek Jalur Produk<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Croscek Orderan Voucher<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*HaiTronik<br />\r\n*Sagara<br />\r\n*Darra<br />\r\n*Payfi<br />\r\n*Optimus<br />\r\n*Metro<br />\r\n*Yreload<br />\r\n*AtmPulsa<br />\r\n*Alfatrans<br />\r\n*Ghofir<br />\r\n*Ipay<br />\r\n*Mutiaralink<br />\r\n*Saveplus<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Sari<br />\r\n*Windi<br />\r\n*Retno<br />\r\n*Teguh<br />\r\n*Nizar<br />\r\n*PH<br />\r\n*Robby<br />\r\n*Selvy</p>\r\n', '2023-06-02'),
(221, '2023-06-02 16:00:59', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Input transaksi pembelian tgl 28, 29 Mei (accurate)<br />\r\n3. Rekap mutasi bank h2h, dan pt tgl 1 Juni<br />\r\n4. Input mutasi bank h2h dan pt tgl 1 Juni (accurate)<br />\r\n5. Input komisi dan tukar komisi retail (accurate)</p>\r\n', '2023-06-02'),
(222, '2023-06-02 16:01:33', '55', '<p>ACCOUNTING 1 REPORT HARIAN 02 juni 2023<br />\r\n1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Revisi Excel Gaji<br />\r\n7. Membuat Surat Penghapusan Sanksi<br />\r\n8. Membayar PPh25 PT dan OP</p>\r\n', '2023-06-02'),
(223, '2023-06-02 16:02:52', '65', '<p>- Design promo top up game PG</p>\r\n\r\n<p>- Design promom paket roaming haji PH<br />\r\n- Update design flash sale axis data voucher XML</p>\r\n', '2023-06-02'),
(224, '2023-06-02 16:04:19', '67', '<p>-Update Harga PLN -10 SDP<br />\r\n-Design Banner Hari Raya Waisak PH<br />\r\n-Design Flayer Hari Raya Waisak PH&nbsp;&nbsp;<br />\r\n-Design Story Hari Raya Waisak PH<br />\r\n-Design Banner Hari Raya Waisak SDP&nbsp;<br />\r\n-Design Flayer Hari Raya Waisak SDP<br />\r\n-Design Story Hari Raya Waisak SDP<br />\r\n-Design Telkomsel Transfer Promo PH<br />\r\n-Design Topup OVO PH<br />\r\n-Design Axis Data Pure PH<br />\r\n-DEsign Contact MK SSB&nbsp; &nbsp;</p>\r\n', '2023-06-02'),
(225, '2023-06-02 16:06:00', '68', '<ul>\r\n	<li>cek performa memori pc operator PH dengan windows memory diagnostic</li>\r\n	<li>cek penggunaan memory dengan task manager</li>\r\n	<li>cari referensi import excel ke php mysql</li>\r\n	<li>testing import excel php mysql</li>\r\n	<li>buat database test import excel ke phpmysql</li>\r\n	<li>cek ketersediaan komponen pc ke tripio</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-06-02'),
(226, '2023-06-02 16:09:52', '64', '<p>- Editing motion graphic Cara deposit aplikasi XML mobile melalui transfer bank<br />\r\n- Editing scene adegan motion graphic Bagian Intro XML Mobile<br />\r\n- Editing background motion graphic XML Mobile<br />\r\n- Editing transisi motion graphic XML Mobile<br />\r\n- Editing mockup motion graphic XML Mobile<br />\r\n- Editing text motion graphic XML Mobile<br />\r\n- Editing per-scene adegan motion graphic XML<br />\r\n- Editing background motion graphic XML<br />\r\n- Editing backsound motion graphic XML</p>\r\n', '2023-06-02'),
(227, '2023-06-02 16:24:21', '54', '<p>02 juni 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC, 1 juni 2023</li>\r\n	<li>Rekap KPI, SDP &amp; PH, Marketing, Retail, CS, Operator, Data Voucher</li>\r\n	<li>Kroscek kpi PG dan SSB</li>\r\n	<li>Pengenalan lingkungan kerja ke SPV MA yang baru</li>\r\n	<li>Update data keryawan bulan juni</li>\r\n	<li>Update kontrak pembaruan kontrak bulan juni</li>\r\n	<li>Mencari refrensi kontrak tanpa menyalahi aturan</li>\r\n	<li>Mencari info UU PDP 2022</li>\r\n	<li>Input data SPV MA yang baru di e-reporting</li>\r\n	<li>Menjelaskan ke SPV MA mengenai e-reporting</li>\r\n	<li>Cek cv yang masuk di email</li>\r\n</ul>\r\n', '2023-06-02'),
(228, '2023-06-02 17:04:24', '70', '<p>2 Juni 2023<br />\r\n- cek addon bri retail error (sudah normal)<br />\r\n- cek addon bri h2h error (sudah normal)<br />\r\n- backup opr h2h (sholat jumat)<br />\r\n- order tsel tp golden rate 14% dan menyiapkan chip nya<br />\r\n- Info cs SSB dan PG untuk transfer penggajian ke rek pakyudi , konfirmasi pakyudi dan Nina<br />\r\n- menjelaskan ke cs PG request agen (tagihan ineternet myrepublic)<br />\r\n- cek settingan produk cek dan bayar produk pln BPLD di web report<br />\r\n- set IP bhobu di SSB dan tes transaksi<br />\r\n- info cs SSB produk transfer bank dan pln mini diarahkan ke bhobu<br />\r\n- set regex gagal spl BHOBU di otomax PG<br />\r\n- followup cs SSB (flayer contact MK)<br />\r\n- review flayer contact MK dan minta revisi untuk design flayer contact MK<br />\r\n- info cs SSB untuk daftar ototepe ambil produk paket telfon<br />\r\n- pantau cs SSB set modul IP ototepe di otomax<br />\r\n- ganti link youtube di web android (xml&nbsp; retail) &gt;&gt; link youtube tanya mas irfan<br />\r\n- sinkron kode referal yang tidak bertuan di web report (xml retail)<br />\r\n- compile aplikasi (xml retail) dan cek link sudah benar<br />\r\n- cek port PG yang error (sudah normal)</p>\r\n', '2023-06-02'),
(229, '2023-06-02 17:21:53', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 02 JUNI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n- Cek stok fisik di SU<br />\r\n- Order voucher&nbsp; (SPL : Otim,Aswa,Citra,Muji Isat,Favour)<br />\r\n-Cek / bongkaran orderan voucher tgl 30/05 yang sdh datang (SPL: Daffina)<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan konter untuk hari sabtu (persiapan hari waisak)<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. Marwoto<br />\r\n2. PH<br />\r\n3. Teguh</p>\r\n', '2023-06-02'),
(230, '2023-06-02 21:41:11', '58', '<p><strong>Laporan Harian Marketing</strong></p>\r\n\r\n<ol>\r\n	<li>Rekap transaksi Sales</li>\r\n	<li>Rekap transaksi h2h</li>\r\n	<li>Rekap transaksi retail</li>\r\n	<li>Riset produk</li>\r\n	<li>Tawar menawar harga dengan&nbsp; suplier</li>\r\n	<li>menyesuaikan harga produk</li>\r\n	<li>Cari produk/stok dengan harga terbaik</li>\r\n	<li>Follow up mitra Retail</li>\r\n	<li>Cek &amp; mengaktifkan produk close/gangguan</li>\r\n	<li>Memantau naik &amp; turun transaksi</li>\r\n	<li>Follow up mitra H2H</li>\r\n	<li>Merencanakan konten</li>\r\n	<li>Memantau harga kompetitor</li>\r\n	<li>Analisa transaksi &amp; margin</li>\r\n	<li>Update harga forum otomax</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-02'),
(231, '2023-06-03 14:56:15', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Produk Promo PH Aktivasi Indosat<br />\r\nðŸ‘‰ðŸ» Diskusi Flyer dgn Tim Design<br />\r\nðŸ‘‰ðŸ» Croscek Jalur Produk<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Laba Rugi PH/SDP<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Croscek Produk Close/Gangguan<br />\r\nðŸ‘‰ðŸ» Croscek Orderan Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Stok Voucher<br />\r\nðŸ‘‰ðŸ» Rekap Penjualan Voucher<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*SAVEPLUS<br />\r\n*Istana Reload<br />\r\n*SAUDAGAR<br />\r\n*Digital Pulsa<br />\r\n*SEMBURAT<br />\r\n*Rumah Pulsa<br />\r\n*Jelitareload<br />\r\n*Erefill<br />\r\nðŸ‘‰ðŸ» Rekap Order Voucher<br />\r\n*Windi<br />\r\n*Wahyudi<br />\r\n*YT Cell<br />\r\n*PH<br />\r\n*PG</p>\r\n', '2023-06-03');
INSERT INTO `pekerjaan` (`id`, `tanggal`, `karyawan`, `pekerjaan`, `tgl`) VALUES
(232, '2023-06-03 16:00:04', '68', '<ul>\r\n	<li>post artikel kuota lokal axis boy, bigbro, dan bigboy</li>\r\n	<li>pasang dan aktivasi plugin table press</li>\r\n	<li>import dan insert table axis boy ke artikel</li>\r\n	<li>import dan insert table bigbro ke artikel</li>\r\n	<li>import dan insert table bigboy ke artikel</li>\r\n	<li>implement code import excel work ke elap</li>\r\n	<li>penyesuaian nama variabel&nbsp;</li>\r\n	<li>penyesuaian folder dan library</li>\r\n	<li>penyesuaian query&nbsp;</li>\r\n	<li>testing import file excel</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-06-03'),
(233, '2023-06-03 16:02:17', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Rekap mutasi bank h2h dan pt&nbsp; tgl 2 Juni<br />\r\n3. Rekap mutasi bank retail tgl 1, 2 Juni<br />\r\n4. Input mutasi bank h2h dan pt tgl 2 Juni (accurate)<br />\r\n5. Input mutasi bank retail tgl 1, 2 Juni (accurate)<br />\r\n6. Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n7. Input biaya sms1900/kas e wallet (accurate)</p>\r\n', '2023-06-03'),
(234, '2023-06-03 16:03:25', '65', '<p>-&gt; Design info penting no rekening baru sdp<br />\r\n-&gt; Design banner info penting no rekening baru sdp<br />\r\n-&gt; Design promo paket haji &amp; umroh PG</p>\r\n\r\n<p>-&gt; Update design contact MK ssb</p>\r\n', '2023-06-03'),
(235, '2023-06-03 16:03:27', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Mentransfer Gaji<br />\r\n7. Membuat Slip Gaji<br />\r\n8. RekapExcel Rekening Penggajian</p>\r\n', '2023-06-03'),
(236, '2023-06-03 16:11:31', '54', '<p>03 juni 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC, 2 juni 2023</li>\r\n	<li>Diskusi dengan pak ambar mengenai rekrutmen sales</li>\r\n	<li>Membuat surat pernyataan untuk di sertakan di kontrak (kirim PIC)</li>\r\n	<li>Cek cv di email</li>\r\n	<li>Arsip kontrak 1 tahun 2022-2023</li>\r\n	<li>Menanyakan kendala berliyanda</li>\r\n	<li>Mengganti kursi kerja berliyanda</li>\r\n</ul>\r\n', '2023-06-03'),
(237, '2023-06-03 16:13:45', '70', '<p>3 Juni 2023<br />\r\n- cek BNI PH tidak mau login di otomax , cari tau solusi nya (harus ganti password)<br />\r\n- cek expired lisensi otomax dan backup online PG<br />\r\n- perpanjang lisensi otomax dan backup online PG<br />\r\n- set regex trx paket telfon ke ototepe yg gagal alihkan ke spl lain<br />\r\n- info ke cs SSB untuk memberikan prioritas di parsing paket telfon nya , dan menjelaskan fungsi prioritas nya<br />\r\n- info cs SDP untuk bc flayer pergantian rekening SDP mulai hari ini (agar tidak mendadak)<br />\r\n- mencoba login BNI (faiz) di otomax , sudah connect<br />\r\n- mencoba login MANDIRI mcm (faiz) , sudah connect<br />\r\n- cek pendingan trx ototepe<br />\r\n- pantau cs ototepe dan menjwab pertanyaan dr cs ototepe<br />\r\n- backup opr (ke kamar mandi)<br />\r\n&nbsp; &gt;&gt; pantau trx SU dan mengarahkan produk ke jalur yang aman<br />\r\n- review banner hari raya waisak all server retail , banner ph revisi tulisan<br />\r\n- info cs all server retail pasang banner&nbsp; hari raya waisak bwt aplikasi (disembunyikan) , bwt tes jadi kalo ada error bisa minta di revisi<br />\r\n&nbsp;&nbsp; &gt;&gt; ph done<br />\r\n&nbsp; &gt;&gt; ssb done<br />\r\n&nbsp; &gt;&gt; xml done<br />\r\n&nbsp; &gt;&gt; pg done<br />\r\n&nbsp; &gt;&gt; sdp done<br />\r\n- set harga beli spl indonesia di otomax PG<br />\r\n- cek chip tsel tp PG yang tidak bisa bwt transkasi<br />\r\n- cek equoto SSB tgl 1 dan 2<br />\r\n- cek rekapan SSB&nbsp; biaya dan margin tgl 1 dan 2<br />\r\n- cek equoto PG tgl 1 dan 2<br />\r\n- cek rekapan PG biaya dan margin tgl 1 dan 2<br />\r\n- coba tes login mandiri retail di addon mcm</p>\r\n', '2023-06-03'),
(238, '2023-06-03 16:16:31', '64', '<p>- Editing motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart<br />\r\n- Editing scene adegan motion graphic Bagian Intro XML Mobile<br />\r\n- Editing background motion graphic XML Mobile<br />\r\n- Editing transisi motion graphic XML Mobile<br />\r\n- Editing mockup motion graphic XML Mobile<br />\r\n- Editing text motion graphic XML Mobile<br />\r\n- Editing per-scene adegan motion graphic XML tapi baru sampe 6 Scene..</p>\r\n', '2023-06-03'),
(239, '2023-06-04 12:37:44', '52', '<p>-diskusi dengan pakyudi dan pak ambar<br />\r\n-cek kpi baru, delegasi hrd&nbsp; update beberapa bagian<br />\r\n-cek excel penggajian revisi beberapa kali<br />\r\n-cek keterangan2 produk data koordinasi dgn vani<br />\r\n-delegasi kiki update produk2 sesuai request<br />\r\n-delegasi ramdita cek link2 yg akan dipasang di apk<br />\r\n-cek kendala ramdita, link yutub blm mode hp, delegasi info programmer<br />\r\n-cari stok tsel tf , order 80jt ke hendri rate 14%<br />\r\n-koordinasi tambahan request dgn mas muji<br />\r\n-cek jalur vocer tri yg ngehost koordinasi dgn vani<br />\r\n-ngajarin lg cara tf ke opr baru ototepe<br />\r\n-cek excel penggajian konfirm pakyudi</p>\r\n', '2023-06-02'),
(240, '2023-06-04 14:39:33', '59', '<p>CS H2H (Backup Alan Cuti)<br />\r\n&nbsp;</p>\r\n', '2023-06-04'),
(241, '2023-06-04 16:54:03', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 04 JUNI 2023</p>\r\n\r\n<p>- Cek stok fisik di SU<br />\r\n-Cek / bongkaran orderan voucher tgl 02/06 yang sdh datang (SPL: Daffina,Otim)<br />\r\n- Gosok dan Upload voucher<br />\r\n- Mencari komplenan voucher<br />\r\n- Menyiapkan gosokan voucher CSVoucher dan konter untuk hari senin<br />\r\n- Update Rekapan daffina<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. Teguh<br />\r\n2. PH<br />\r\n3. Retno<br />\r\n4. Kafka Cell<br />\r\n5. Fourteen</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-04'),
(242, '2023-06-04 21:42:57', '58', '<p><strong>Laporan Harian Marketing</strong></p>\r\n\r\n<ol>\r\n	<li>Rekap transaksi Sales</li>\r\n	<li>Rekap transaksi h2h</li>\r\n	<li>Rekap transaksi retail</li>\r\n	<li>Riset produk</li>\r\n	<li>Tawar menawar harga dengan&nbsp; suplier</li>\r\n	<li>menyesuaikan harga produk</li>\r\n	<li>Cari produk/stok dengan harga terbaik</li>\r\n	<li>Follow up mitra Retail</li>\r\n	<li>Cek &amp; mengaktifkan produk close/gangguan</li>\r\n	<li>Memantau naik &amp; turun transaksi</li>\r\n	<li>Follow up mitra H2H</li>\r\n	<li>Merencanakan konten</li>\r\n	<li>Memantau harga kompetitor</li>\r\n	<li>Analisa transaksi &amp; margin</li>\r\n	<li>Update harga forum otomax</li>\r\n</ol>\r\n\r\n<p>followup mitra h2h :</p>\r\n\r\n<p>XML2271&nbsp;&nbsp; &nbsp;KHARISMA<br />\r\nXML53983&nbsp;&nbsp; &nbsp;BsP Pulsa<br />\r\nXML3934&nbsp;&nbsp; &nbsp;PT.Pejuang Mandiri Kreatif<br />\r\nXML347&nbsp;&nbsp; &nbsp;One Reload 114<br />\r\nXML2199&nbsp;&nbsp; &nbsp;IBEN RELOAD<br />\r\nXML43928&nbsp;&nbsp; &nbsp;BERKAH JBA<br />\r\nXML53991&nbsp;&nbsp; &nbsp;Radar<br />\r\nXML2077&nbsp;&nbsp; &nbsp;GRAHA PULSA<br />\r\nXML3892&nbsp;&nbsp; &nbsp;MORARELOAD<br />\r\nXML1115&nbsp;&nbsp; &nbsp;sagaramobile<br />\r\nXML3507&nbsp;&nbsp; &nbsp;Y Reload&#39;<br />\r\nXML134&nbsp;&nbsp; &nbsp;TM PULSA<br />\r\nXML413&nbsp;&nbsp; &nbsp;SIGNAL PULSA<br />\r\nXML1003&nbsp;&nbsp; &nbsp;TRAVEL PULSA<br />\r\nXML1045&nbsp;&nbsp; &nbsp;WNI PULSA<br />\r\nXML43929&nbsp;&nbsp; &nbsp;RUMAH PULSA<br />\r\nXML3609&nbsp;&nbsp; &nbsp;PMK2<br />\r\nXML43921&nbsp;&nbsp; &nbsp;ALAW<br />\r\nXML3922&nbsp;&nbsp; &nbsp;CUAN KOPER KOPER<br />\r\nXML3607&nbsp;&nbsp; &nbsp;MORENA PULSA<br />\r\nXML1076&nbsp;&nbsp; &nbsp;TALENTA<br />\r\nXML3923&nbsp;&nbsp; &nbsp;Saka Nusantara<br />\r\nXML3407&nbsp;&nbsp; &nbsp;Jaya Art Centre<br />\r\nXML101&nbsp;&nbsp; &nbsp;RC PAYMENT<br />\r\nXML1068&nbsp;&nbsp; &nbsp;Langitpay</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-04'),
(243, '2023-06-05 16:02:03', '68', '<ul>\r\n	<li>membuat form input penggajian manual</li>\r\n	<li>konfigurasi nama input dan variabel input penggajian</li>\r\n	<li>membuat pengkondisian untuk akses input penggajian</li>\r\n	<li>membuat pengkondisian untuk akses edit penggajian</li>\r\n	<li>buat action button untuk menu penggajian</li>\r\n	<li>layouting action button untuk menu penggajian</li>\r\n	<li>update foto baner artikel Kuota Lokal Axis Boy BigBro dan BigBoy</li>\r\n	<li>testing dan debuging pengkondisian akses input dan update penggajian</li>\r\n	<li>debuging dan testing output dan variabel input penggajian</li>\r\n	<li>buat dan konfigurasi tabel penggajian_test</li>\r\n	<li>edit header menu website xmltronik.com</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-06-05'),
(244, '2023-06-05 16:02:07', '65', '<p>=&gt;&gt; Design promo google play gift voucher xml<br />\r\n=&gt;&gt; Update design info deposit via tf bank<br />\r\n=&gt;&gt; Update design banner info deposit via tf bank<br />\r\n=&gt;&gt; Design banner agen althaf phone&nbsp;<br />\r\n=&gt;&gt; Design banner berkah kuota cell</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-05'),
(245, '2023-06-05 16:02:29', '67', '<p>-Update Design Contact MK SSB<br />\r\n-Design Detail Kuota Axis<br />\r\n-Design Topup E-Money Mandiri</p>\r\n', '2023-06-05'),
(246, '2023-06-05 16:04:21', '64', '<p>- Nerusin&nbsp; Edit motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart (background)<br />\r\n- Nerusin&nbsp; Edit motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart (Edit transisi)<br />\r\n- Nerusin&nbsp; Edit motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart (Edit mockup)<br />\r\n- Nerusin&nbsp; Edit motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart ( Edit text )<br />\r\n- Lanjut Edit&nbsp; per-scene adegan motion graphic XML dari 6, 7, 8 dan penutup.<br />\r\n-&nbsp; Nerusin&nbsp; Edit motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart ( Edit Backsound )<br />\r\n- Rendering motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart</p>\r\n', '2023-06-05'),
(247, '2023-06-05 16:25:35', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 05 JUNI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n-Cek stok fisik di SU<br />\r\n-Cek / bongkaran orderan voucher tgl 02/06 yang sdh datang (SPL: Daffina,Favour,Aswa)<br />\r\n-Menyiapkan gosokan voucher CSVoucher dan konter untuk hari selasa<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. Windi<br />\r\n2. Marwoto<br />\r\n3. PG<br />\r\n4. Lastri<br />\r\n5. Galuh Cell<br />\r\n6. PH</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-05-06'),
(248, '2023-06-05 17:05:50', '52', '<p>-hitung equoto ototepe tgl 3<br />\r\n-rekap saldo masuk orderan tgl 2-3, konfirmasi ke golden dan hendri<br />\r\n-pantau trx ototepe<br />\r\n-order tsel tf 234jt ke golden rate 14.7%<br />\r\n-cek semua masa aktif chips ototepe<br />\r\n-tambah masa aktif ke beberapa chips yg sdh mendekati<br />\r\n-diskusi presentase by chat dgn pakyudi<br />\r\n-cek settingan / parsing tsel tlp, tes trx<br />\r\n-croscek reporting pak ambar, koordinasi dgn hrd<br />\r\n-update novia cuti tanggal 10 -11 juni 2023</p>\r\n', '2023-06-04'),
(249, '2023-06-05 17:06:02', '52', '<p>-hitung equoto ototepe tgl 4<br />\r\n-rekap saldo masuk orderan tgl 4, konfirmasi ke golden yg belum masuk<br />\r\n-pantau trx ototepe<br />\r\n-diskusi gs by chat dgn pakyudi<br />\r\n-koordinasi briefing dgn pak ambar<br />\r\n-cek kendala admin token mandiri mati<br />\r\n-aktivasi soft token mandiri mcm retail<br />\r\n-cek kendala new report sdp data bank rancu krna jalan bank baru,<br />\r\n-update kode bank di new report<br />\r\n-buat tutorial cara tf dari bank mandiri mcm<br />\r\n-mengarahkan cs sdp balance saldo bank<br />\r\n-ngajarin mas andi cara cek transaksi ototepe</p>\r\n', '2023-06-05'),
(250, '2023-06-05 17:10:33', '70', '<p>5 Juni 2023<br />\r\n- update addon bank BCA atasnama Faiz (SDP)<br />\r\n- update addon bank BRI atasnama Faiz (SDP)<br />\r\n- update userid BNI atasnama Faiz di otomax (SDP)<br />\r\n- update userid Mandiri atasnama Faiz di addon mcm (SDP)<br />\r\n- info nina update addon BCA dan BRI Faiz (biaya 2)<br />\r\n- info cs SDP untuk mengganti replay tiket ke rek Faiz<br />\r\n- info cs SDP untuk sering bc pergantian rekening Faiz , dan info cs SDP untuk meminta updatean flayer rek Faiz<br />\r\n- backup opr h2h (angga ke bank BRI untuk nonaktifkan sms dr BRI PG)<br />\r\n- cek port chip tsel tp PG yang error (sudah normal)<br />\r\n- cek masa aktif nomor yang digunakan untuk center whatsapp h2h<br />\r\n- cek equoto SSB tgl 3 dan 4<br />\r\n- cek equoto PG tgl 3 dan 4<br />\r\n- cek rekapan biaya, invent , bank SSB tgl 3 dan 4<br />\r\n- cek rekapan biaya, invent , bank PG tgl 3 dan 4<br />\r\n- cek BNI SDP (fais) tidak bisa login di web , login ganti link<br />\r\n- coba login di web dengan link baru (sudah bisa) , info ke cs SDP link baru dan info untuk mencoba login BNI<br />\r\n- cek regex gagal spl Siupi (h2h) belum ggal otomatis</p>\r\n', '2023-06-05'),
(252, '2023-06-06 14:45:04', '58', '<p><strong>Laporan Harian Marketing</strong></p>\r\n\r\n<ol>\r\n	<li>Rekap transaksi Sales</li>\r\n	<li>Rekap transaksi h2h</li>\r\n	<li>Rekap transaksi retail</li>\r\n	<li>Riset produk</li>\r\n	<li>Tawar menawar harga dengan&nbsp; suplier</li>\r\n	<li>menyesuaikan harga produk</li>\r\n	<li>Cari produk/stok dengan harga terbaik</li>\r\n	<li>Follow up mitra Retail</li>\r\n	<li>Cek &amp; mengaktifkan produk close/gangguan</li>\r\n	<li>Memantau naik &amp; turun transaksi</li>\r\n	<li>Follow up mitra H2H</li>\r\n	<li>Merencanakan konten</li>\r\n	<li>Memantau harga kompetitor</li>\r\n	<li>Analisa transaksi &amp; margin</li>\r\n</ol>\r\n', '2023-06-06'),
(253, '2023-06-06 16:02:45', '65', '<p>=&gt;&gt; Design icon history mutasi memanjang xml<br />\r\n=&gt;&gt; Design icon history mutasi memanjang PH<br />\r\n=&gt;&gt; Design icon cek status voucher PH<br />\r\n=&gt;&gt; Design icon history mutasi memanjang PG<br />\r\n=&gt;&gt; Design icon history mutasi memanjang SSB<br />\r\n=&gt;&gt; Design icon digipost SSB<br />\r\n=&gt;&gt; Design icon history mutasi memanjang SDP</p>\r\n', '2023-06-06'),
(254, '2023-06-06 16:03:00', '67', '<p>-Update Harga Produk Pulsa Reguler &amp; Token Pulsa PG<br />\r\n-Design Paket Roaming Haji &amp; Umrah<br />\r\n-Design Pemenang Giveaway XML Feed<br />\r\n-Design Pemenang Giveaway XML Story<br />\r\n-Design Beli Pulsa Harga Grosir XML</p>\r\n', '2023-06-06'),
(255, '2023-06-07 11:07:42', '64', '<p>- Revisi Background motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart<br />\r\n- Edit transisi motion graphic Cara deposit aplikasi xmlmobile melalui Indomaret<br />\r\n- Edit&nbsp; mockup motion graphic Cara deposit aplikasi xmlmobile melalui Indomaret<br />\r\n- Edit text motion graphic Cara deposit aplikasi xmlmobile melalui Indomaret<br />\r\n- Lanjut Edit&nbsp; per-scene adegan motion graphic XML dari 6, 7, 8 dan penutup.<br />\r\n- Edit Backsound motion graphic Cara deposit aplikasi xmlmobile melalui Indomaret<br />\r\n- Rendering motion graphic Cara deposit aplikasi xmlmobile melalui Indomaret<br />\r\n- Desain Motivasi XML<br />\r\n- Desain Story Motivasi XML</p>\r\n', '2023-06-06'),
(256, '2023-06-06 16:03:12', '68', '<ul>\r\n	<li>debuging alur data dari form input penggajian manual</li>\r\n	<li>pasang pc spv marketing</li>\r\n	<li>tambah field bulan tabel penggajian_test</li>\r\n	<li>pembuatan sintaks query cek data tersedia,&nbsp;</li>\r\n	<li>testing query cek data tersedia</li>\r\n	<li>pembuatan pengkondisian insert data penggajian_test</li>\r\n	<li>pembuatan query insert penggajian_test manual</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-06-06'),
(257, '2023-06-06 16:08:00', '70', '<p>6 Juni 2023<br />\r\n- cek BSI retail error (update chrome)<br />\r\n- info cs all server retail meminta icon history mutasi dan bertanya ada tambahan untuk update aplikasi atau tidak<br />\r\n- menanyakan ke cs all server retail apa ada request dr agen yang memungkinkan untuk update aplikasi di PS<br />\r\n- followup cs PH (alan) produk transfer bank req agen cek nama dlu baru proses bayar<br />\r\n- diskusi dengan vani by chat , tambahan untuk update aplikasi di PS<br />\r\n- update aplikasi PulsaHoki di PS (sudah up di PS)<br />\r\n&nbsp;&nbsp; &raquo;&raquo;&raquo; Menambahkan fitur history mutasi , sehingga memudahkan anda untuk&nbsp;&nbsp;&nbsp; pengecekan data<br />\r\n&nbsp;&nbsp; &raquo;&raquo;&raquo; Menambahkan menu cek status voucher , kini anda bisa cek status voucher yang&nbsp;&nbsp;&nbsp; ditransaksi kan<br />\r\n&nbsp;&nbsp; &raquo;&raquo;&raquo; Pengelompokan produk bebas nominal sesuai provider nya<br />\r\n- cek addon Sidompul error ( sudah normal)<br />\r\n- order tsel tp rate 854 10chip dan menyiapkan chip nya<br />\r\n- update aplikasi XML-MOBILE di PS&nbsp; (sudah up di PS)<br />\r\n&nbsp;&nbsp; &raquo;&raquo;&raquo; Penambahan banner design<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sekarang semakin mudah untuk promosikan usahamu melalui fitur ini ,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dengan cukup download dan cetak&nbsp;&nbsp; banner nya<br />\r\n&nbsp;&nbsp; &raquo;&raquo;&raquo; Penambahan menu tutorial<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Yang masih bingung dengan fitur aplikasi XML-Mobile, kami sediakan tutorial&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; untuk memudahkan proses transaksi anda dengan aplikasi kami<br />\r\n&nbsp;&nbsp; &raquo;&raquo;&raquo; Penambahan fitur history mutasi<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fitur history yang dapat mendukung pencatatan anda semakin lengkap</p>\r\n\r\n<p>- cek addon BRI dan BCA retail error (sudah normal )</p>\r\n', '2023-06-06'),
(258, '2023-06-06 16:20:36', '56', '<p>- Rekap mutasi bank h2h, dan pt tgl 3, 4, 5 Juni<br />\r\n- Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n- Input biaya sms1900/kas e wallet (accurate)<br />\r\n- Input komisi dan tukar komisi retail (accurate)<br />\r\n- Rekap transaksi penjualan dan pembelian tgl 30, 31 Mei</p>\r\n', '2023-06-06'),
(259, '2023-06-06 16:23:16', '54', '<p>04 juni 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC, 3-5 juni 2023</li>\r\n	<li>Rekap KPI, SDP &amp; PH, Marketing, Retail, CS, pg &amp;ssb, Operator, Data Voucher</li>\r\n	<li>Diskusi dengan SPV marketing area, head Marketing dan sales area</li>\r\n	<li>Siapkan pembayaran bpjs PU dan BPU untuk di kirimkan akunting</li>\r\n	<li>Mengarahkan pak ambar untuk pengisian e-report</li>\r\n	<li>Perbarui isi kontrak berikut dengan data karyawannya</li>\r\n	<li>Rekap iklan share grup</li>\r\n	<li>Diskusi dari pak ambar terkait penjelasan alamat outlet agar mudah pemetaan (arahkan ke programmer)</li>\r\n</ul>\r\n', '2023-06-06'),
(260, '2023-06-06 16:51:02', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 06 JUNI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n-Cek stok fisik di SU<br />\r\n-&nbsp; Order voucher (mencari harga termurah SPL: Daffina,Otim,Aswa,Citra,Muji Isat,Muji Three,Favour)<br />\r\n-Menyiapkan gosokan voucher CSVoucher dan konter untuk hari rabu<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. PH<br />\r\n2. Teguh<br />\r\n3. Teras Cell</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-06'),
(261, '2023-06-07 08:22:08', '104', '<ul>\r\n	<li>Breafing bersama canvaser , didampingin HRD dan Head Marketing</li>\r\n	<li>pembahasan target ONO (Open New Outlet) 4 outlet perminggu harus deposit langsung.</li>\r\n	<li>Memberikan edukasi pemahaman ke canvaser tentang fitur aplikasi xml untuk bekal mengedukasi outlet binaan</li>\r\n	<li>keliling ke outlet xml non canvaser menerangkan kelebihan dari app xml</li>\r\n</ul>\r\n', '2023-06-06'),
(262, '2023-06-07 16:00:12', '68', '<ul>\r\n	<li>edit table pegawai tambah kolom nik</li>\r\n	<li>edit form input gaji manual tambah form email, nik, dan jabatan</li>\r\n	<li>melatih report spv marketing</li>\r\n	<li>buat sintak query update data penggajian manual.</li>\r\n	<li>testing query update data penggajian.</li>\r\n	<li>debuging data update data penggajian manual.</li>\r\n	<li>pembuatan query get data nik, jabatan, dan email.</li>\r\n	<li>buat halaman downlaod baner sdp mobile</li>\r\n	<li>upload baner dan promosi ke hosting</li>\r\n	<li>konfigurasi link download file baner promosi</li>\r\n	<li>testing halaman download sdp mobile</li>\r\n	<li>upload baner pg ke hosting</li>\r\n	<li>buat halaman downlaod baner pg</li>\r\n	<li>buat menu download website pg</li>\r\n	<li>konfigurasi link downlaod baner pg</li>\r\n	<li>tesitng link download baner pulsa genggam</li>\r\n</ul>\r\n', '2023-06-07'),
(263, '2023-06-07 16:00:22', '67', '<p>-Design X Banner Jual Pulsa PH<br />\r\n-Design X Banner Jual Kuota PH<br />\r\n-Design X Banner Jual Pulsa SDP<br />\r\n-Design X Banner Jual Kuota SDP<br />\r\n-Design X Banner Jual Pulsa SSB<br />\r\n-Design X Banner Jual Kuota SSB<br />\r\n-Design Blog Zona Telkomsel 2023 XML<br />\r\n-Design Berbagai Macam Design PH<br />\r\n-Design Berbagai Macam Design SDP<br />\r\n-Design Berbagai Macam Design SSB<br />\r\n-Update Banner SSB Reload<br />\r\n-Design Cara Daftar di Aplikasi SSB Reload<br />\r\n-Design Topup Maxim XML</p>\r\n', '2023-06-07'),
(264, '2023-06-07 16:00:35', '65', '<p>=&gt;&gt; Design info xml tronik&nbsp;<br />\r\n=&gt;&gt; Design update apk PH versi 31&nbsp;<br />\r\n=&gt;&gt; Revisi banner kosong PG<br />\r\n=&gt;&gt; Design banner cara download berbagai macam design PG</p>\r\n', '2023-06-07'),
(265, '2023-06-07 16:01:59', '104', '<ul>\r\n	<li>Melakukan Video Call dg all canvaser di outlet pertama yg dikunjungi tujuannya( untuk mendisiplinkan jam mulai&nbsp; kerja )</li>\r\n	<li>Menganalisa hasil ONO dengan realita ONO aktif/akuisisi ( bukan hanya di daftarkan akan tetapi ditekannjkan utk Deposit juga.</li>\r\n	<li>melakukan monitoring japri ke all canvaser</li>\r\n	<li>Melakukan kunjungan ke outlet mengedukasi app XML</li>\r\n</ul>\r\n', '2023-06-07'),
(266, '2023-06-07 16:03:24', '56', '<p>1. Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate<br />\r\n2. Rekap transaksi penjualan, pembelian dan jkp tgl 30 Mei - 6 Juni 2023<br />\r\n3. Input transaksi penjualan &amp; pembelian tgl 30, 31Mei (accurate)<br />\r\n4. Rekap mutasi bank h2h, pt dan retail tgl 6 Juni<br />\r\n5. Rekap dan input stok sales, cash sales, cash vocuher (accurate)<br />\r\n6. Input biaya sms1900/kas e wallet (accurate)<br />\r\n7. Input komisi dan tukar komisi retail (accurate)<br />\r\n8. Menerima arahan dr ramdita utk kontrol ekuitas ph, ssb dan pg</p>\r\n', '2023-06-07'),
(267, '2023-06-07 16:05:33', '64', '<p>- Post Motivasi XML<br />\r\n- Story Motivasi XML &nbsp;<br />\r\n- Membuat Tema dan Caption writing Doa PG<br />\r\n- Desain Doa PG<br />\r\n- Desain Story Doa PG<br />\r\n- Membuat Tema dan Caption writing Testimoni PH<br />\r\n- Desain Testimoni PH<br />\r\n-&nbsp; Desain Testimoni PH<br />\r\n- Revisi Text motion graphic Cara deposit aplikasi xmlmobile melalui Alfamart<br />\r\n- Rendering Cara deposit aplikasi xmlmobile melalui Alfamart<br />\r\n- Revisi Text motion graphic Cara deposit aplikasi xmlmobile melalui Indomaret<br />\r\n- Rendering Cara deposit aplikasi xmlmobile melalui Indomaret</p>\r\n', '2023-06-07'),
(268, '2023-06-07 16:06:33', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Ke KPP Menemui AR<br />\r\n7. Bayar Astinet<br />\r\n8. Bayar BPJSTK<br />\r\n9. Memisahkan Transaksi JKP dan NonJKP</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-07'),
(269, '2023-06-07 16:08:14', '54', '<p>06 juni 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC, 5 juni 2023</li>\r\n	<li>Kroscek pembayaran BPJS BPU dan PU (serahkan ke akunting)</li>\r\n	<li>Diskusi dengan pak yudi dan PIC</li>\r\n	<li>Menghubungi kandidat opr dan cs ototepe</li>\r\n	<li>konfirmasi ke berlianda untuk info perubahan libur di tanggal merah dan adanya opr cs ototepe yang baru</li>\r\n	<li>Membuat kontrak karyawan</li>\r\n	<li>Rekap form cuti</li>\r\n</ul>\r\n\r\n<p>1. Ramdita cuti tanggal 9 juni , tukar libur dengan zulfa menjadi tanggal &nbsp;10 juni</p>\r\n\r\n<p>2. Edwin bahari cuti tanggal 14 juni backup support siang wildan</p>\r\n\r\n<p>3. muji kurnianto cuti tanggal 9-10 juni</p>\r\n', '2023-06-07'),
(270, '2023-06-07 16:16:10', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 07 JUNI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n-Cek stok fisik di SU<br />\r\n-Menyiapkan gosokan voucher CSVoucher untuk hari kamis<br />\r\n- Cek / bongkaran orderan voucher tgl 07/06 yang sdh datang : (SPL : Otim,Toni,Muji Isat,Muji Three)<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. Windi<br />\r\n2. PH<br />\r\n3. Teguh<br />\r\n4. Tofu</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-07'),
(271, '2023-06-07 22:00:26', '59', '<p>ðŸ‘‰ðŸ» Rekap Transaksi All Server<br />\r\nðŸ‘‰ðŸ» Rekap Hasil Gosokan Tim Voucher<br />\r\nðŸ‘‰ðŸ» Diskusi Banner Promosi SDP<br />\r\nðŸ‘‰ðŸ» Croscek Pendingan Transaksi<br />\r\nðŸ‘‰ðŸ» Croscek Margin Transaksi<br />\r\nðŸ‘‰ðŸ» Cari Jalur Terbaik/Termurah<br />\r\nðŸ‘‰ðŸ» Produk Promo Indosat Reguler<br />\r\nðŸ‘‰ðŸ» Produk Promo Voucher Three<br />\r\nðŸ‘‰ðŸ» Flash Sale Token PLN -10<br />\r\nðŸ‘‰ðŸ» Konten SDP Produk Axis<br />\r\nðŸ‘‰ðŸ» Rekap Data Agen PH<br />\r\nðŸ‘‰ðŸ» Follow Up Agen PH (blm depo)<br />\r\nðŸ‘‰ðŸ» Iklan Google Ads SDP<br />\r\nðŸ‘‰ðŸ» Iklan Forum FB PH<br />\r\nðŸ‘‰ðŸ» Rekap Penjualan Voucher<br />\r\nðŸ‘‰ðŸ» Follow Up Agen H2H<br />\r\n*Solutipay<br />\r\n*Juber<br />\r\n*TRANZ PULSA<br />\r\n*POWER RANGERS<br />\r\n*Morena Pulsa<br />\r\n*EM-PULSA<br />\r\n*PixMe<br />\r\n*JayaArt<br />\r\n*Tm Pulsa<br />\r\n*GERHANARELOAD</p>\r\n', '2023-06-07'),
(272, '2023-06-08 16:01:48', '67', '<p>-Design Banner Produk Transfer Bank SDP<br />\r\n-Design Flayer Produk Transfer Bank SDP<br />\r\n-Update Token PLN Promo-10<br />\r\n-Design Topup Maxim PH<br />\r\n-Design Topup Maxim SDP<br />\r\n-Design Thumbnail Youtube Indomaret<br />\r\n-Design Thumbnail Youtube Alfamart</p>\r\n', '2023-06-08'),
(273, '2023-06-08 16:01:51', '65', '<p>=&gt;&gt; Design cara daftar pulsa genggam<br />\r\n=&gt;&gt; Design tumbnail youtub xml cara deposit alfa&nbsp;<br />\r\n=&gt;&gt; Update design cek saldo info sdp<br />\r\n=&gt;&gt; Design top up saldo maxim PH<br />\r\n=&gt;&gt; Design kartu nama agen xml</p>\r\n', '2023-06-08'),
(274, '2023-06-08 16:02:27', '68', '<ul>\r\n	<li>buat halaman download baner ssb</li>\r\n	<li>layouting halaman download ssb</li>\r\n	<li>upload file baner ssb ke google drive</li>\r\n	<li>setup link download baner ssb ke halaman download</li>\r\n	<li>testing download baner ssb</li>\r\n	<li>ubah link download baner pulsa genggam</li>\r\n	<li>buat form dan print form jumlah outlet deposit offline</li>\r\n	<li>reupload dan ubah link baner kosongan pulsa genggam</li>\r\n	<li>buat menu dan setting layouting download website Pulsa Hoki</li>\r\n	<li>rakit PC</li>\r\n	<li>instalasi windows</li>\r\n	<li>buat halaman download PH</li>\r\n	<li>buat menu download web PH</li>\r\n	<li>seting route halaman download web PH</li>\r\n	<li>seting link download baner promosi web PH</li>\r\n	<li>upload baner promosi PH ke hostingan</li>\r\n</ul>\r\n', '2023-06-08'),
(275, '2023-06-08 16:03:21', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 08 JUNI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n-Cek stok fisik di SU<br />\r\n-Menyiapkan gosokan voucher CSVoucher untuk hari jumat<br />\r\n- Cek / bongkaran orderan voucher tgl 06/06 yang sdh datang : (SPL : Daffina,Aswa)<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. Teguh<br />\r\n2. PH<br />\r\n3. Khulatul<br />\r\n4. Roby<br />\r\n5. Erna<br />\r\n6. Retno<br />\r\n7. PG<br />\r\n8. Fourteen</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-08'),
(276, '2023-06-09 09:46:42', '64', '<p>- Post Doa&nbsp; PG<br />\r\n- Story Doa PG<br />\r\n- Post Testimoni PH<br />\r\n- Story Testimoni PH<br />\r\n- Membuat Tema dan Caption writing Testimoni SDP<br />\r\n- Membuat Tema dan Caption writing hiburan PH<br />\r\n- Membuat Tema dan Caption writing Motivasi SSB<br />\r\n- Desain Testimoni SDP<br />\r\n- Desain Story Testimoni SDP<br />\r\n- Desain Layout Video Hiburan PH<br />\r\n- Desain Conver Hiburan PH<br />\r\n- Edit Video Hiburan PH<br />\r\n- Rendering Video Hiburan PH<br />\r\n- Desain Motivasi SSB<br />\r\n- Desain Story Motivasi SSB</p>\r\n', '2023-06-08'),
(277, '2023-06-08 16:16:03', '54', '<p>08 juni 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, CC, 7 juni 2023 (e-report)</li>\r\n	<li>Membuat kontrak training untuk karyawan baru (OPR dan CS Ototepe)</li>\r\n	<li>Arsip kontrak training</li>\r\n	<li>Menyelesaikan pembuatan kontrak 1 th</li>\r\n	<li>Distribusikan kontrak kepada karyawan (blok 12, kontrakan, blok 14)</li>\r\n	<li>Pengenalan lingkungan dan sop kerja untuk karyawan baru (OPR dan CS ototepe)</li>\r\n	<li>Diskusi dengan Pak ambar terkait kinerha diah (sales area jeruklegi)</li>\r\n</ul>\r\n\r\n<p>1. mengapa antara jumlah FU agen dam akuisisi tidak seimbang cenderung jomplang</p>\r\n\r\n<p>2. mengapa area yang di kunjungi hanya sedikit (padahal area jeruk legi sudah ada pembuaan outlet sebelumnya)</p>\r\n\r\n<p>3. mengapa jarang reporting foto di grup</p>\r\n\r\n<p>4. bagaimana cara pressure untuk area jeruk legi dan kawunganten</p>\r\n\r\n<ul>\r\n	<li>Rekap absensi dari tanggal 1- 7 juni (share grup shift)</li>\r\n	<li>Rekap sisa cuti dari jan- juni 2023 (share grup)</li>\r\n	<li>Rekap form ijin</li>\r\n</ul>\r\n\r\n<p>1. form absen tidak terekam an m.faiz tanggal 1 juni</p>\r\n', '2023-06-08'),
(278, '2023-06-08 16:20:22', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Ke KPP<br />\r\n7. Bayar dan Lapor PPh21<br />\r\n8. Bayar dan lapor PPh4(2) dan PPh23</p>\r\n', '2023-06-08'),
(279, '2023-06-08 16:24:37', '56', '<ul>\r\n	<li>Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate</li>\r\n	<li>Input mutasi bank retail tgl 3 sd 6 Juni (accurate)</li>\r\n	<li>Rekap dan input stok sales, cash sales, cash vocuher (accurate)</li>\r\n	<li>Input biaya sms1900/kas e wallet (accurate)</li>\r\n	<li>Input komisi dan tukar komisi retail (accurate)</li>\r\n	<li>Input biaya gaji mei 2023 (accurate)</li>\r\n	<li>Input poin retail (accurate)</li>\r\n	<li>Tarik LR Accurate Mei 2023</li>\r\n	<li>Kontrol equitas ph, pg dan ssb tgl 7 Juni</li>\r\n</ul>\r\n', '2023-06-08'),
(280, '2023-06-08 16:42:10', '52', '<p>-update jadwal konter<br />\r\n-update kalender konten</p>\r\n\r\n<p>-order tsel tp 54jt ke golden<br />\r\n-update kode bank new report sdp, delegasi update saldo manual ke cs<br />\r\n-delegasi ramdita alih tugas kontrol equoto pg ssb ke siska<br />\r\n-set terminal baru utk chips gs<br />\r\n-ngajarin opr ototepe cek saldo manual by dial<br />\r\n-ngajarin opr ototepe convert gs<br />\r\n-delegasi beri label chips ke opr ototepe<br />\r\n-diskusi dgn pakyudi dan hrd<br />\r\n-cek dan pantau garapan convert gs<br />\r\n-ngajarin cs sdp aktivasi mandiri mobile token<br />\r\n-tambah masa aktif chips ototepe</p>\r\n', '2023-06-07'),
(281, '2023-06-08 16:43:43', '52', '<p>-hitung equoto ototepe<br />\r\n-cek rekapan saldo<br />\r\n-konfirmasi saldo yg belum masuk ke golden<br />\r\n-cek ke call center sender sdh transfer pulsa, tp belum masuk ke penerima<br />\r\n-cek google ads xml<br />\r\n-cari pelatihan digital marketing<br />\r\n-daftar dan beli pelatihan digital marketing<br />\r\n-mengarahkan dan opr otepe convert gs<br />\r\n-mengarahkan dan opr otepe cek saldo all chips gs<br />\r\n-konfirmasi mas imam tsel dial gs limit 1jt<br />\r\n-order tsel tp 14.9% ke hendri 252jt utk ototepe<br />\r\n-order tsel tp 14.9% ke hendri 27jt utk gs</p>\r\n', '2023-06-08'),
(282, '2023-06-08 16:50:25', '104', '<ul>\r\n	<li>Melakukan VC dengan canvaser pada kunjungan pertama tujuannya utk mendisiplinkan jam kerja dilapangan..</li>\r\n	<li>Menganalisa angka pertumbuhan trx canvaser berdasarkan data dari om wildan head marketing office..</li>\r\n	<li>Tendem dengan cvs EKO area Sampang...mengedukasi beberapa outlet dan mengakuisisi outlet wilayah cvs eko.</li>\r\n	<li>Pemantauan hasil ONO yg akuisisi per canvaser..dengan menanyakan langsung ke cvs di grup WA</li>\r\n</ul>\r\n', '2023-06-08'),
(283, '2023-06-10 12:39:00', '70', '<p>8 Juni 2023<br />\r\n- cek addon BRI retail error (sudah normal)<br />\r\n- cek isimple gangguan (gangguan dr pusat)<br />\r\n- isimple sudah normal , tapi harga di addon rancu jadi info cs all server retail kalo produk data diclose dlu<br />\r\n- cari tau di forum2 isimple gangguan karena ada update dari isimple (upda transaksi tagihan) , server lain harga di addon juga rancu<br />\r\n- chat max (develop) tanya ada update isimple atau tidak (belum balas)<br />\r\n- cek settingan keamanan data di akun dev xml , pulsagenggam,pulsahoki<br />\r\n- update di akun dev :<br />\r\n&nbsp; 1. sdp :<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - compile dan upload naik versi<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; update link fitur hapus akun dari http menjadi https</p>\r\n\r\n<p>&nbsp; 2. xml :<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; perubahan nama menjadi :<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; XML-MOBILE: Pulsa, Kuota, PPOB<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; update link fitur hapus akun dari http menjadi https</p>\r\n\r\n<p>&nbsp; 3. ph :<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; perbaikan kuesioner enkripsi (pilihan ya/tidak)</p>\r\n\r\n<p>&nbsp; 4. pg :<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; perbaikan kuesioner enkripsi (pilihan ya/tidak)<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; update link fitur hapus akun dari http menjadi https<br />\r\n- setting trx tsel combo 2 langkah<br />\r\n&nbsp; 1. tsel data mingguan<br />\r\n&nbsp; 2. tsel data harian<br />\r\n&nbsp; 3. tsel roaming haji<br />\r\n&nbsp; 4. tsel internet max<br />\r\n&nbsp; 5. tsel promo digipos<br />\r\n&nbsp; 6. tsel roaming max<br />\r\n&nbsp; 7. tsel telpon bulk<br />\r\n&nbsp; 8. telkomsel Nelpon Sakti<br />\r\n&nbsp; 9. telkomsel Telpon Pas<br />\r\n&nbsp;10. Paket Data GigaNet<br />\r\n- cek dan revisi link Pulsa genggam (link download banner)</p>\r\n', '2023-06-08'),
(284, '2023-06-08 20:58:55', '58', '<p>Laporan Harian Marketing</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; Rekap transaksi Sales<br />\r\n&nbsp;&nbsp;&nbsp; Rekap transaksi h2h<br />\r\n&nbsp;&nbsp;&nbsp; Rekap transaksi retail<br />\r\n&nbsp;&nbsp;&nbsp; Riset produk<br />\r\n&nbsp;&nbsp;&nbsp; Tawar menawar harga dengan&nbsp; suplier<br />\r\n&nbsp;&nbsp;&nbsp; menyesuaikan harga produk<br />\r\n&nbsp;&nbsp;&nbsp; Cari produk/stok dengan harga terbaik<br />\r\n&nbsp;&nbsp;&nbsp; Follow up mitra Retail<br />\r\n&nbsp;&nbsp;&nbsp; Cek &amp; mengaktifkan produk close/gangguan<br />\r\n&nbsp;&nbsp;&nbsp; Memantau naik &amp; turun transaksi<br />\r\n&nbsp;&nbsp;&nbsp; Follow up mitra H2H<br />\r\n&nbsp;&nbsp;&nbsp; Merencanakan konten<br />\r\n&nbsp;&nbsp;&nbsp; Memantau harga kompetitor<br />\r\n&nbsp;&nbsp;&nbsp; Analisa transaksi &amp; margin</p>\r\n', '2023-06-08'),
(285, '2023-06-08 21:54:44', '59', '<p>8 Juni 2023</p>\r\n\r\n<p>- Rekap Transaksi &amp; Margin<br />\r\n- Diskusi design flyer<br />\r\n- Croscek harga beli dan jual voucher PH<br />\r\n- Meminta dibuatkan link download banner &amp; flyer PH<br />\r\n- Menginfokan tim voucher lebih teliti dalam input voucher agar mengurangi revisian voucher<br />\r\n- Info CS PH flyer promo token pln<br />\r\n- Info CS SDP jalur produk indosat data (flash sale sdp)<br />\r\n- Info tim design untuk dibuatkan flyer Flash Sale SDP<br />\r\n- Cek modal, harga jual grosir voucher (update harga)<br />\r\n- Info tim design untuk update daftar harga grosir voucher<br />\r\n- Follow up agen PH yg sdh daftar tetapi blm deposit tanyakan kendalanya<br />\r\n- Isi saldo dan iklan google ads PH<br />\r\n- Iklan produk promo PH di forum FB<br />\r\n- Croscek margin transaksi<br />\r\n- Rekap Penjualan Voucher<br />\r\n- Rekap Agen SDP yg sdh daftar tp blm deposit<br />\r\n- Follow up agen H2H<br />\r\n&nbsp; *Alfatrans<br />\r\n&nbsp; *ELRELOAD<br />\r\n&nbsp; *haitronik<br />\r\n&nbsp; *Asha Pulsa<br />\r\n&nbsp; *Alaw<br />\r\n&nbsp; *Atm Pulsa<br />\r\n&nbsp; *Digital Partner<br />\r\n&nbsp; *XTRONIK<br />\r\n&nbsp; *ARDY PUSAJA<br />\r\n- Menyiapkan orderan voucher untuk besok<br />\r\n&nbsp; *Samsul<br />\r\n&nbsp; *Sari<br />\r\n&nbsp; *Windi</p>\r\n', '2023-06-08'),
(286, '2023-06-09 14:45:14', '58', '<p><strong>Laporan Harian Marketing</strong></p>\r\n\r\n<ol>\r\n	<li>Rekap transaksi Sales</li>\r\n	<li>Rekap transaksi h2h</li>\r\n	<li>Rekap transaksi retail</li>\r\n	<li>Riset produk</li>\r\n	<li>Tawar menawar harga dengan&nbsp; suplier</li>\r\n	<li>menyesuaikan harga produk</li>\r\n	<li>Cari produk/stok dengan harga terbaik</li>\r\n	<li>Follow up mitra Retail</li>\r\n	<li>Cek &amp; mengaktifkan produk close/gangguan</li>\r\n	<li>Memantau naik &amp; turun transaksi</li>\r\n	<li>Follow up mitra H2H</li>\r\n	<li>Merencanakan konten</li>\r\n	<li>Memantau harga kompetitor</li>\r\n	<li>Analisa transaksi &amp; margin</li>\r\n	<li>rapat spv sales</li>\r\n	<li>upload banner gratis</li>\r\n	<li>upload konten blog</li>\r\n	<li>sketsa desain banner/poster</li>\r\n	<li>&nbsp;</li>\r\n</ol>\r\n', '2023-06-09'),
(287, '2023-06-09 16:03:55', '68', '<ul>\r\n	<li>Edit judul artikel / blog daftar zona telkomsel</li>\r\n	<li>ubah cryptografi password user dengan ekstensi openSSL</li>\r\n	<li>buat function encrypt dengan extensi openSSL</li>\r\n	<li>buat function decrypt dengan extensi openSSL</li>\r\n	<li>debuging output data dari open ssl</li>\r\n	<li>enable fitur update password user di menu profil</li>\r\n	<li>testing fiutr update password di menu profil</li>\r\n	<li>tambah menu download baner jual paket data dan masa aktif</li>\r\n	<li>tambah menu download baner jual pulsa dan masa aktif</li>\r\n	<li>tambah menu download desain kartu nama.</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-06-09'),
(288, '2023-06-09 16:04:17', '64', '<p>- Post Testimoni SDP<br />\r\n- Story Testimoni SDP<br />\r\n- Post Hiburan PH<br />\r\n- Story Hiburan PH<br />\r\n- Post Motivasi SSB<br />\r\n- Story Motivasi SSB<br />\r\n- Membuat tema dan caption writing Tips Bahagia untuk XML mobile<br />\r\n- Desain Tips Bahagia untuk XML mobile<br />\r\n- Desain Sory Tips Bahagia untuk XML mobile<br />\r\n- Desain mockup App XML tronik<br />\r\n-&nbsp; Edit Mockup App Xml Tronik<br />\r\n&nbsp;</p>\r\n', '2023-06-09'),
(289, '2023-06-09 16:04:41', '67', '<p>-Update X Banner Jual Pulsa XML<br />\r\n-Update X Banner Jual Paket Data XML<br />\r\n-Design Flash Sale Time Indosat SDP<br />\r\n-Design Telkomsel Telepon Promo SSB<br />\r\n-Design XML Kini Tersedia di AppStore<br />\r\n-Design Paket Indosat Only4U</p>\r\n', '2023-06-09'),
(290, '2023-06-09 16:06:00', '65', '<p>=&gt;&gt; Design sub icon bigo live ssb<br />\r\n=&gt;&gt; Design sub icon lifeafter ssb<br />\r\n=&gt;&gt; Design sub icon spotify ssb<br />\r\n=&gt;&gt; Design sub icon bukalapak ssb<br />\r\n=&gt;&gt; Design sub icon dana ssb<br />\r\n=&gt;&gt; Design sub icon doku ssb<br />\r\n=&gt;&gt; Design sub icon gojek customer ssb<br />\r\n=&gt;&gt; Design sub icon gojek driver ssb<br />\r\n=&gt;&gt; Design sub icon grab driver ssb<br />\r\n=&gt;&gt; Design sub icon grab voucher ssb<br />\r\n=&gt;&gt; Design sub icon grab customer ssb<br />\r\n=&gt;&gt; Design sub icon isaku ssb<br />\r\n=&gt;&gt; Design sub icon kaspro ssb<br />\r\n=&gt;&gt; Design sub icon sakuku ssb<br />\r\n=&gt;&gt; Design sub icon shopee ssb<br />\r\n=&gt;&gt; Update design harga grosir voucher&nbsp;<br />\r\n=&gt;&gt; Design sub icon bfi finance ssb<br />\r\n=&gt;&gt; Design sub icon baf finance ssb<br />\r\n=&gt;&gt; Design sub icon columbia finance ssb<br />\r\n=&gt;&gt; Design sub icon fif grup ssb<br />\r\n=&gt;&gt; Design sub icon mandala finance ssb<br />\r\n=&gt;&gt; Design harga pulsa all operator pg</p>\r\n', '2023-06-09'),
(291, '2023-06-09 16:06:28', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Membuat LR Pajak dan Server Utama<br />\r\n7. Membuat Estimasi Pajak<br />\r\n8. Membuat Invoice</p>\r\n', '2023-06-09'),
(292, '2023-06-09 16:18:44', '54', '<p>09 juni 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, spv canvasser, CC, 8 juni 2023 (e-report)</li>\r\n	<li>Rekap KPI, SDP &amp; PH, Marketing, Retail, CS, pg &amp;ssb, Operator, Data Voucher</li>\r\n	<li>Distribusikan kontrak kepada karyawan (blok 12, kontrakan, blok 14)</li>\r\n	<li>Meminta kembali kontrak yang kemarin belum di ttd oleh karyawan</li>\r\n	<li>Kroscek absensi (revisi cholid telat 1 menit di tanggal 7 juni)</li>\r\n	<li>Diskusi dengan pak ambar mengenai problem canvasser (diah)</li>\r\n	<li>Screening cv di email</li>\r\n	<li>Menghubungi dan share undangan untuk psikotes dan interview besok jam 9 pagi</li>\r\n</ul>\r\n', '2023-06-09'),
(293, '2023-06-09 16:24:28', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 09 JUNI 2023<br />\r\n-Cek stok fisik di SU<br />\r\n-Order voucher<br />\r\n(SPL : Daffina,Aswa,Favour,Citra,Muji K)<br />\r\n-Menyiapkan gosokan voucher CSVoucher dan konter untuk hari sabtu<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. Tofu<br />\r\n2. PH<br />\r\n3. Teguh<br />\r\n4. Fayi Cell<br />\r\nMelengkapi orderan offline<br />\r\n1. Samsul<br />\r\n2. Windi<br />\r\n6. Retno<br />\r\n7. PG<br />\r\n8. Fourteen<br />\r\n- Update exp voucher fisik</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-09'),
(294, '2023-06-09 16:43:14', '56', '<ul>\r\n	<li>Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate</li>\r\n	<li>Input mutasi bank h2h dan pt tgl 3 sd 6 Juni (accurate)</li>\r\n	<li>Rekap dan input stok sales, cash sales, cash vocuher (accurate)</li>\r\n	<li>Input biaya sms1900/kas e wallet (accurate)</li>\r\n	<li>Input komisi dan tukar komisi retail (accurate)</li>\r\n	<li>Tarik LR Accurate Mei 2023 (Update)</li>\r\n	<li>Kontrol equitas ph, pg dan ssb tgl 8 Juni</li>\r\n</ul>\r\n', '2023-06-09'),
(295, '2023-06-10 12:39:35', '70', '<p>9 Juni 2023<br />\r\n- melengkapi kuesioner keamanan data di akun dev XML<br />\r\n&nbsp;&nbsp; 1. perbaikan kuesioner enkripsi (pilihan ya/tidak)<br />\r\n&nbsp;&nbsp; 2. info keuangan tidak di centang (sebelumnya dicentang : info pembayaran pengguna dan history pembelian)<br />\r\n- cek dan perpanjang lisensi center wa pulsahoki<br />\r\n- update pulsagenggam di PS (sudah up di PS)<br />\r\n&nbsp;&nbsp; 1. penambahan fitur history mutasi<br />\r\n&nbsp;&nbsp; 2. penambahan link download banner<br />\r\n- update chrome center wa Pulsagenggam<br />\r\n- cek addon BCA Pulsa genggam kena user aktif ( penyelesaian call center BCA)<br />\r\n- cek addon BNI Pulsagenggam error (sudah normal)<br />\r\n- cek icon digipos di aplikasi SSB tidak muncul (karena double kode provider)<br />\r\n- update addon ISIMPEL all server retail v2.0<br />\r\n- backup opr h2h , SSB , SDP (sholat jumat)<br />\r\n-&nbsp; cek Backup Online Pulsahoki error (sudah normal)<br />\r\n- setting produk tsel 2 langkah :<br />\r\n&nbsp;&nbsp; 1. Telkomsel Paket Ketengan Kuota Utama<br />\r\n&nbsp;&nbsp; 2. Telkomsel Paket MAXstream<br />\r\n&nbsp;&nbsp; 3. Telkomsel MusicMax<br />\r\n&nbsp;&nbsp; 4. Telkomsel Data Pendidikan<br />\r\n&nbsp;&nbsp; 5. Telkomsel Data Suprise Deal<br />\r\n&nbsp;&nbsp; 6. Telkomsel SMS Postpaid<br />\r\n&nbsp;&nbsp; 7. Telkomsel RoaMAX Multy Country<br />\r\n&nbsp;&nbsp; 8. Telkomsel Data Zoom<br />\r\n&nbsp;&nbsp; 9. Telkomsel Masa Aktif Kartu<br />\r\n&nbsp;10. Telkomsel Roaming Umroh<br />\r\n&nbsp;11. Telkomsel GameMax Power Diamond<br />\r\n&nbsp;12. Telkomsel GamesMax Power Gold<br />\r\n&nbsp;13. Telkomsel GameMax Ketengan<br />\r\n&nbsp;14. Indosat Data Only For You<br />\r\n&nbsp;15. Produk XL/AXIS Cuan<br />\r\n- info opr retail , produk combo 2 langkah sudah ready untuk yang 3langkah bisa dihapus sembari cek produk yg 2 langkah</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-09'),
(296, '2023-06-09 18:12:27', '104', '<ul>\r\n	<li>Melakukan VC dengan All CVS saat kunjungan pertama di outlet binaan tujuannya untuk memastikan dan mendisiplinkan jam kerja cvs</li>\r\n	<li>Melakukan feedback evaluasi ke sdri CVS Diah..dalam hal kirim foto kunjungan dan target.</li>\r\n	<li>Melakukan diskusi dengan head&nbsp; marketing office mengenai data outlet yg real deposit offline ke cvs..</li>\r\n	<li>Diskusi dg HRD perihal di atas</li>\r\n	<li>melakukan kunjungan ke beberapa outlet..dengan mengedukasi fitur app XML</li>\r\n	<li>Evaluasi Target ONO AKUISISI ke all cvs by telpon</li>\r\n</ul>\r\n', '2023-06-09'),
(297, '2023-06-09 19:26:10', '52', '<p>-hitung equoto ototepe tgl 8<br />\r\n-cek rekapan saldo tp orderan ototepe tgl 7<br />\r\n-cek rekapan saldo tp orderan gs tgl 7<br />\r\n-konfirmasi saldo yg belum masuk ke golden dan hendri<br />\r\n-konfirmasi mas imam kurangan vocer yg tdk replay<br />\r\n-order tsel tp 15% ke hendri 30jt utk tpgs<br />\r\n-order tsel tp 15% ke hendri 198jt utk gs bm<br />\r\n-menerima call dari pt boost keperluan invoice arjuna xml338<br />\r\n-koordinasi dgn arjuna xml338<br />\r\n-delegasi nina buat 2 invoice belum lunas dan sdh lunas khusus arjuna<br />\r\n-convert 16chips gs kejar chips kosong<br />\r\n-cek report estimasi pph badan</p>\r\n', '2023-06-09'),
(298, '2023-06-09 21:57:35', '59', '<p>9 Juni 2023</p>\r\n\r\n<p>- Rekap Transaksi &amp; Margin<br />\r\n- Diskusi design flyer<br />\r\n- Croscek pendingan transaksi<br />\r\n- Cek ulang orderan voucher fisik<br />\r\n- Rekap agen SDP yg sdh daftar tp blm deposit<br />\r\n- Follow up agen SDP yg sdh daftar tp blm deposit tanyakan kendalanya<br />\r\n- Croscek margin transaksi<br />\r\n- Cek Jalur smart data nonstop<br />\r\n- Info CS PH flyer promo smart data nonstop<br />\r\n- Info CS PH flyer indonsat only4u<br />\r\n- Share bahan promosi/iklan SDP &amp; PH<br />\r\n- Croscek margin transaksi<br />\r\n- Rekap Penjualan Voucher<br />\r\n- Follow up agen H2H (menawarkan produk)<br />\r\n&nbsp; *Metro<br />\r\n&nbsp; *Stokpulsa<br />\r\n&nbsp; *Uctronik<br />\r\n&nbsp; *Ualtronik<br />\r\n&nbsp; *Digital reload<br />\r\n&nbsp; *Anekatronik<br />\r\n&nbsp; *Gerbang Pulsa<br />\r\n&nbsp; *Onereload<br />\r\n&nbsp; *Radar Pulsa<br />\r\n- Menyiapkan orderan voucher untuk besok<br />\r\n&nbsp; *Novi<br />\r\n&nbsp; *Sarah</p>\r\n', '2023-06-09'),
(299, '2023-06-10 12:38:12', '70', '<p>7 Juni 2023<br />\r\n- setting trx tsel combo 2 langkah<br />\r\n&nbsp; 1. tsel data terbaik<br />\r\n&nbsp; 2. tsel Combo Sakti<br />\r\n&nbsp; 3. tsel bulanan<br />\r\n- pasang banner download design dan link (SDP) di web android<br />\r\n- cek dan revisi link download design (SDP)<br />\r\n- pasang icon menu history mutasi SDP<br />\r\n- update aplikasi SDP Mobile di PS &nbsp;<br />\r\n&nbsp;&nbsp; &raquo;&raquo;&raquo; Penambahan banner design<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sekarang semakin mudah untuk promosikan usahamu melalui fitur ini ,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dengan cukup download dan cetak&nbsp; banner nya<br />\r\n&nbsp;&nbsp; &raquo;&raquo;&raquo; Penambahan fitur history mutasi<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fitur history yang dapat mendukung pencatatan anda semakin lengkap<br />\r\n- info cs PG dan SSB untuk meminta banner download<br />\r\n- info dan jelaskan ke siska cara cek equoto SSB,PG,PH<br />\r\n- menjawab pertanyaan agen terkait settingan inject voucher massal<br />\r\n- menjawab komplenan MK (paralel aplikasi)<br />\r\nngajarin ges replay gagal di reversal<br />\r\n- info opr (gesang) replay supplier tidak gagal otomatis , cek di note reversal</p>\r\n', '2023-06-07');
INSERT INTO `pekerjaan` (`id`, `tanggal`, `karyawan`, `pekerjaan`, `tgl`) VALUES
(300, '2023-06-10 16:01:27', '65', '<p>=&gt;&gt; Design promo paket indosat only 4U ph<br />\r\n=&gt;&gt; Design promo smartfren unlimited nonstop apliksi ph<br />\r\n=&gt;&gt; Design sub menu adira finance ssb<br />\r\n=&gt;&gt; Design sub menu bima finance ssb<br />\r\n=&gt;&gt; Design sub menu kredit plus ssb<br />\r\n=&gt;&gt; Design sub menu maf ssb&nbsp;<br />\r\n=&gt;&gt; Design sub menu mcf ssb<br />\r\n=&gt;&gt; Design sub menu nsc ssb&nbsp;<br />\r\n=&gt;&gt; Design sub menu oto finance ssb<br />\r\n=&gt;&gt; Design sub menu smart finance ssb<br />\r\n=&gt;&gt; Design sub menu woka finance ssb<br />\r\n=&gt;&gt; Design sub menu wom finance ssb<br />\r\n=&gt;&gt; Design flash sale voucher data three xml<br />\r\n=&gt;&gt; Design sub menu paket telfon axis ssb<br />\r\n=&gt;&gt; Design sub menu paket telfon indosat ssb<br />\r\n=&gt;&gt; Design sub menu paket telfon smartfren ssb<br />\r\n=&gt;&gt; Design sub menu paket telfon telkomsel ssb<br />\r\n=&gt;&gt; Design sub menu paket telfon three ssb<br />\r\n=&gt;&gt; Design sub menu paket telfon xl ssb<br />\r\n=&gt;&gt; Design sub menu gamescoll ssb<br />\r\n=&gt;&gt; Design sub menu garena ssb<br />\r\n=&gt;&gt; Design sub menu gocash ssb<br />\r\n=&gt;&gt; Design sub menu google play ssb<br />\r\n=&gt;&gt; Design sub menu imvu ssb<br />\r\n=&gt;&gt; Design sub menu itunes ssb<br />\r\n=&gt;&gt; Design sub menu nintendo ssb<br />\r\n=&gt;&gt; Design sub menu playstation ssb<br />\r\n=&gt;&gt; Design sub menu pubg ssb<br />\r\n=&gt;&gt; Design sub menu roblox ssb<br />\r\n=&gt;&gt; Design sub menu steam ssb<br />\r\n=&gt;&gt; Design sub menu susiroll ssb<br />\r\n=&gt;&gt; Design sub menu wot ssb<br />\r\n=&gt;&gt; Design sub menu wow ssb<br />\r\n=&gt;&gt; Design sub menu zepeto ssb<br />\r\n=&gt;&gt; Design sub menu video ssb<br />\r\n=&gt;&gt; Design give away tebak kata ssb&nbsp;</p>\r\n', '2023-06-10'),
(301, '2023-06-10 16:01:45', '68', '<ul>\r\n	<li>fix error function decrypt halaman profil</li>\r\n	<li>implement function encrypt decrypt password ke halaman login</li>\r\n	<li>pembuatan pengkondisian untuk user dengan password encrypt metode md5 dan openaSSL</li>\r\n	<li>debuging data variabel login</li>\r\n	<li>debuging dan testing syntax query login</li>\r\n	<li>testing login dengan password hasil encrypt open SSL</li>\r\n	<li>testing login dengan password hasil encrypt md5</li>\r\n	<li>perbaikan quick settings tidak muncul pada laptop accounting</li>\r\n	<li>perbaikan bug fungsi decrypt password halaman update data user</li>\r\n	<li>pembuatan fungsi javascript lihat dan tutup password</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-06-10'),
(302, '2023-06-10 16:02:04', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 10 JUNI 2023<br />\r\n<br />\r\n- Rekap penjualan voucher sales<br />\r\n-Cek stok fisik di SU<br />\r\n-Cek / bongkaran orderan voucher tgl 09/05 yang sdh datang : (SPL : Toni,Citra)<br />\r\n-Update rekapan daffina<br />\r\n-Menyiapkan gosokan voucher CSVoucher dan konter untuk hari minggu<br />\r\n-Update exp voucher fisik sales</p>\r\n\r\n<p>- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. Roby<br />\r\n2. PH<br />\r\n3. Teguh<br />\r\nMelengkapi orderan offline<br />\r\n1. Sarah</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-10'),
(303, '2023-06-10 16:04:00', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Rekap Nota Biaya<br />\r\n7. Membuat Invoice</p>\r\n', '2023-06-10'),
(304, '2023-06-10 16:06:04', '56', '<ul>\r\n	<li>Rekon &amp; memastikan saldo akhir rekening bank sama dg saldo bank di accurate</li>\r\n	<li>Rekap &nbsp;mutasi bank retail tgl 7 sd 9 Juni</li>\r\n	<li>Rekap &nbsp;mutasi bank h2h, dan pt tgl 7 sd 8 Juni</li>\r\n	<li>Rekap dan input stok sales, cash sales, cash vocuher (accurate)</li>\r\n	<li>Input biaya sms1900/kas e wallet (accurate)</li>\r\n	<li>Input komisi dan tukar komisi retail (accurate)</li>\r\n	<li>Kontrol equitas ph, pg dan ssb tgl 9 Mei</li>\r\n</ul>\r\n', '2023-06-10'),
(305, '2023-06-10 16:06:20', '54', '<p>10 juni 2023</p>\r\n\r\n<ul>\r\n	<li>Kroscek report harian &amp; report harian Design, spv canvasser, CC, 9 juni 2023 (e-report)</li>\r\n	<li>Kroscek ulang kontrak yang sudah di ttd karyawan</li>\r\n	<li>Interview dan psikotes kandidat marketing area 2 orang (yang datang hanya 1)</li>\r\n	<li>mendampingi interview user untuk kandidat marketing area (tidak acc)</li>\r\n	<li>diskusi dengan pak ambar terkait pembagian area jangkauan sales canvasser</li>\r\n	<li>screening cv di email</li>\r\n	<li>menghubungi kandidat yang potensial</li>\r\n	<li>menghubungi @lokercilacap untuk up dan post iklan lowongan kerja</li>\r\n	<li>rekap form</li>\r\n</ul>\r\n\r\n<p>1. form lupa absen masuk an rizki puspita sari tanggal 10 juni</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-10'),
(306, '2023-06-10 16:09:18', '64', '<p>- Foto pak Ambar Untuk ID Card<br />\r\n- Post Tips Bahagia XML<br />\r\n- Story Tips Bahagia XML<br />\r\n- Membuat tema dan caption writing Malam Minggu SSB<br />\r\n-&nbsp; Desain Konten malam Minggu untuk SSB<br />\r\n-&nbsp; Desain Story Malam Minggu Untuk SSB<br />\r\n- Post Konten malam Minggu SSB<br />\r\n- Story Konten Malam Minggu SSB<br />\r\n- Membuat tema dan caption writing Cara atur keuangan Untuk Generasi Z untuk PG<br />\r\n-&nbsp; Desain Konten Cara atur keuangan Untuk Generasi Z untuk PG<br />\r\n- Desain Story Cara atur keuangan Untuk Generasi Z untuk PG<br />\r\n- Post Cara atur keuangan Untuk Generasi Z untuk PG<br />\r\n- Story Cara atur keuangan Untuk Generasi Z untuk PG<br />\r\n- Desain Cover Motion Quiztime Pulsa Genggam<br />\r\n- Edit Video Quistime Motion Grafis Grafis</p>\r\n', '2023-06-10'),
(307, '2023-06-10 16:53:40', '70', '<p>10 Juni 2023<br />\r\n- cek BRI Pulsagenggam error (sudah normal)<br />\r\n- cari referensi untuk program giveaway<br />\r\n- buat program giveaway untuk Pulsagenggam (tebak pasangan motif logo Pulsagenggam)<br />\r\n- buat program giveaway untuk SSB (tebak singkatan dari SSB)<br />\r\n- pasang icon utk voucher game SSB di otoreport<br />\r\n- pasang link download banner SSB di otoreport<br />\r\n- pasang icon utk fitur history mutasi<br />\r\n- bantu opr h2h pantau transaksi SU (backup kalo lagi update hpp/sholat)<br />\r\n- setting dial di ototepe<br />\r\n- cek transkasi GS status gagal kirim dan menunggu jawaban<br />\r\n- mencoba transkasi OID (dari SSB ke Otomax h2h) (sudah bisa)<br />\r\n- setting produk 2 langkah dengan addon digipos MAX (SSB)<br />\r\n&nbsp; 1. Produk telkomsel combo sakti<br />\r\n- membuat tutorial transkasi digipos dengan 2 langkah&nbsp; (belum selesai)<br />\r\n- revisi kelompok jawaban retail untuk produk 2 langkah (BITS)<br />\r\n- info ke anisa untuk bantu update aplikasi SSB di playstore<br />\r\n&nbsp; 1. penambahan fitur history mutasi<br />\r\n&nbsp; 2. penambahan menu voucher game (voucher hiburan)<br />\r\n&nbsp; 3. penambahan link download banner ( agen bisa download banner kosongan)</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-10'),
(308, '2023-06-10 17:23:19', '104', '<ul>\r\n	<li>Rutinitas VC dengan all canvaser..Memastikan dan mendisiplinkan jam kerja cvs</li>\r\n	<li>Controling by telpon ke all canvaser mengenai pencapain targer ONO akuisisi</li>\r\n	<li>Mendampingi HRD interview ke calon cvs</li>\r\n	<li>Melakukan diskusi tentang efisiensi teritory wilayah kerja canvaser</li>\r\n	<li>melakukan kunjungan ke outlet dengan meng edukasi fitur app XML</li>\r\n</ul>\r\n', '2023-06-10'),
(309, '2023-06-10 21:55:53', '59', '<p>10 Juni 2023</p>\r\n\r\n<p>- Rekap Transaksi &amp; Margin<br />\r\n- Croscek pendingan transaksi<br />\r\n- Bongkaran voucher yg datang (urgent voucher kehabisan ketika zalfa sdh pulang)<br />\r\n- Follow up agen SDP yg sdh daftar tp blm deposit tanyakan kendalanya<br />\r\n- Croscek margin transaksi<br />\r\n- Cek jalur xl dan axis aktivasi (harga turun promo PH menyesuaikan)<br />\r\n- Info cs PH flyer promo indosat yellow<br />\r\n- Info tim voucher, voucher lama di rapihkan dijadikan satu<br />\r\n- Posting giveaway mini game PH<br />\r\n- Info cs PH kalau ada program giveaway<br />\r\n- Buat konsep giveaway SDP<br />\r\n- Croscek margin transaksi<br />\r\n- Update harga turun voucher indosat unlimited retail &amp; h2h<br />\r\n- Update harga turun voucher three happy retail &amp; h2h<br />\r\n- Update harga voucher di shopee<br />\r\n- Respon chat di shopee dan inbox fb (menanyakan grosir voucher)<br />\r\n- Rekap Penjualan Voucher<br />\r\n- Follow up agen H2H (menawarkan produk)<br />\r\n&nbsp; *Graha<br />\r\n&nbsp; *Yatiphone<br />\r\n&nbsp; *RK Reload<br />\r\n&nbsp; *Sumberkuota<br />\r\n&nbsp; *Solih<br />\r\n&nbsp; *Arvindtronik<br />\r\n&nbsp; *Dyoda server<br />\r\n- Menyiapkan orderan voucher untuk besok<br />\r\n&nbsp; *Fredi<br />\r\n&nbsp; *Forteen</p>\r\n', '2023-06-10'),
(310, '2023-06-11 15:36:57', '59', '<p>11 Juni 2023</p>\r\n\r\n<p>- Rekap Transaksi &amp; Margin<br />\r\n- Croscek pendingan transaksi<br />\r\n- Bongkaran voucher yg datang<br />\r\n- Croscek margin transaksi<br />\r\n- Cek jalur indosat freedom (harga turun promo PH menyesuaikan)<br />\r\n- Info cs PH flyer indosat freedom<br />\r\n- Meminta flyer giveaway sdp ke tim design<br />\r\n- Update Harga di hpp<br />\r\n- Croscek margin transaksi<br />\r\n- Respon chat di shopee dan inbox fb (menanyakan grosir voucher)<br />\r\n- info ke ramdita (agen ph request transaksi aktivasi voucher didulukan produk baru nomer tujuan)<br />\r\n- Info cs PH untuk meminta icon Data Voucher (beberapa agen salah masuk menu ketika transaksi voucher internet)<br />\r\n- Menyiapkan gosokan tim voucher<br />\r\n- Rekap Penjualan Voucher<br />\r\n- Follow up agen H2H (menawarkan produk)<br />\r\n- Menyiapkan orderan voucher<br />\r\n&nbsp; *Retno<br />\r\n&nbsp; *Teguh<br />\r\n&nbsp; *PG<br />\r\n&nbsp; *Robby<br />\r\n&nbsp; *PH<br />\r\n&nbsp; *Selvy</p>\r\n', '2023-06-11'),
(311, '2023-06-11 16:07:10', '52', '<p>-ngajarin ototepe yg baru<br />\r\n*cara lepas pasang chips ke fadila ototepe baru<br />\r\n*cara ganti ganti port terminal<br />\r\n*cara cek saldo via dial<br />\r\n-convert 10 chips gs kejar chips kosong<br />\r\n-order tsel tp utk gs , golden rate 15.7%<br />\r\n-cek kendala ph apk tdk bs utk tf saldo, konfirmasi everluck disarankan sinkron parameter (done)<br />\r\n-cek kendala admin addon bank eror<br />\r\n-cek addon bank, open close beberapa kali, hapus history (done)<br />\r\n-rekap dan order tsel utk gs 117jt chips bm<br />\r\n-memberi arahan berli opr ototepe siang tips2 supaya cpt dan tdk panik saat chips habis bareng, cara cek saldo terpotong/tdk<br />\r\n-beri test nominal ke fadil opr ototepe pagi<br />\r\n-delegasi alin design id card pak ambar</p>\r\n', '2023-06-11'),
(312, '2023-06-11 16:24:50', '67', '<p>-Design Akses Internet AXIS PH<br />\r\n-Design GiveAway SDP<br />\r\n-Design Indosat Freedom Internet<br />\r\n-Design Transfer Antar Bank SSB</p>\r\n', '2023-06-11'),
(313, '2023-06-11 22:44:41', '58', '<p><strong>Laporan Harian Marketing</strong></p>\r\n\r\n<ol>\r\n	<li>Rekap transaksi h2h</li>\r\n	<li>Riset produk</li>\r\n	<li>Tawar menawar harga dengan&nbsp; suplier</li>\r\n	<li>menyesuaikan harga produk</li>\r\n	<li>Cari produk/stok dengan harga terbaik</li>\r\n	<li>Follow up mitra Retail</li>\r\n	<li>Cek &amp; mengaktifkan produk close/gangguan</li>\r\n	<li>Memantau naik &amp; turun transaksi</li>\r\n	<li>Follow up mitra H2H</li>\r\n	<li>Merencanakan konten</li>\r\n	<li>Memantau harga kompetitor</li>\r\n	<li>Analisa transaksi &amp; margin</li>\r\n	<li>analisa ads facebook</li>\r\n	<li>merencanakan konten facebook</li>\r\n	<li>penjadwalan konten</li>\r\n</ol>\r\n', '2023-06-11'),
(314, '2023-06-12 16:00:26', '64', '<p>- Membuat tema dan caption writing Hiburan Untuk PG<br />\r\n- Desain Konten hiburan Pulsa Genggam<br />\r\n- Desain Story hiburan Pulsa Genggam<br />\r\n- Desain Konten Testimoni SSB<br />\r\n- Desain Story Testimoni SSB<br />\r\n- Desain Story Giveaway SSB<br />\r\n- Ngelanjutkan Edit Video Quistime Pulsa genggam<br />\r\n- Edit Backsound Video Quistime Pulsa Genggam<br />\r\n- Membuat tema dan caption writing Video Quistime Pulsa genggam<br />\r\n- Post Konten Video Quistime Pulsa genggam<br />\r\n- Story Video Quistime Pulsa genggam<br />\r\n- Post Facebook Video Quistime Pulsa genggam<br />\r\n- Story Facebook Video Quistime Pulsa genggam<br />\r\n- Post Giveaway SSB<br />\r\n- Story Giveaway SSB<br />\r\n- Post FB Giveaway SSB<br />\r\n- Story FB Giveaway SSB</p>\r\n', '2023-06-12'),
(315, '2023-06-12 16:00:54', '65', '<p>- Design flash sale smartfren xml<br />\r\n- Design promo xl data combo xml<br />\r\n- Design icon voucher data PH&nbsp;<br />\r\n- Design sub menu paket sms indosat<br />\r\n- Design sub menu paket sms telkomsel<br />\r\n- Design sub menu paket sms three</p>\r\n', '2023-06-12'),
(316, '2023-06-12 16:01:04', '56', '<ul>\r\n	<li>Rekap &nbsp;mutasi bank retail tgl 10, 11 Juni</li>\r\n	<li>Rekap&nbsp; mutasi bank h2h, dan pt tgl 9, 10, 11 Juni</li>\r\n	<li>Rekap transaksi penjualan dan transaksi pembelian tgl 7 sd 11 Juni</li>\r\n	<li>Kontrol equitas ph, pg dan ssb tgl 10, 11 Juni</li>\r\n</ul>\r\n', '2023-06-12'),
(317, '2023-06-12 16:01:24', '67', '<p>-Design Paket Internet Axis<br />\r\n-Design XML Mobile Aplikasi Isi Kuota Harga Distributor 5 Slide<br />\r\n-Design Testimoni XML Mobile 6 Slide</p>\r\n', '2023-06-12'),
(318, '2023-06-12 16:01:52', '68', '<ul>\r\n	<li>debuging syntax query insert data penggajian manual</li>\r\n	<li>edit syntax query insert data penggajian manual</li>\r\n	<li>test syntax query insert data penggajian manual</li>\r\n	<li>re-setting configurasi variabel insert data penggajian manual.</li>\r\n	<li>install windows pc 248</li>\r\n	<li>buat query dapatkan data penggajain test</li>\r\n	<li>testing query dapatkan data penggajian test</li>\r\n	<li>buat form update data penggajian test</li>\r\n	<li>konfigurasi data penggajian test ke form penggajian</li>\r\n	<li>buat query dapatkan data pegawai berdasarkan id data penggajian test</li>\r\n	<li>testing dan debuging query dapatkan data pegawai berdasarkan id data penggajian</li>\r\n	<li>buat dan testing query dapatkan data penggajian</li>\r\n	<li>buat dan testing query dapatkan data jabatan</li>\r\n	<li>setting penyajian data penggajian.</li>\r\n	<li>buat, testing dan debuging syntax query dan variabel upadate data penggajian test</li>\r\n	<li>update perubahan ke repositori lokal</li>\r\n	<li>update dan backup source code dan database ke repositori remote(github)</li>\r\n</ul>\r\n', '2023-06-12'),
(319, '2023-06-12 16:02:18', '55', '<p>1. Monitoring Pembelian Agen Untuk Invoice<br />\r\n2. Rekap Data JKP<br />\r\n3. Rekap Detail JKP dan Non JKP<br />\r\n4. Rekap Transaksi Harian<br />\r\n5. Rekap Transaksi Otomax<br />\r\n6. Input Mutasi Bank H2H tgl 7,8 (Accurate)<br />\r\n7. Membuat Invoice</p>\r\n', '2023-06-12'),
(320, '2023-06-12 16:22:44', '102', '<p>CSVOUCHER2<br />\r\nREPORT HARIAN 12 JUNI 2023</p>\r\n\r\n<p>- Refill stok voucher sales ( Muji )<br />\r\n- Rekap penjualan voucher sales<br />\r\n-Cek stok fisik di SU<br />\r\n-Cek / bongkaran orderan voucher tgl 09/05 yang sdh datang : (SPL : Daffina,Toni)<br />\r\n-Menyiapkan gosokan voucher CSVoucher dan konter untuk hari selasa<br />\r\n- Rekap target voucher<br />\r\n- Menyiapkan orderan offline<br />\r\n1. Retno<br />\r\n2. PH<br />\r\n3. Teguh<br />\r\n4. Windi<br />\r\n5. Yt Cell<br />\r\n6. Teras Cell<br />\r\n7. PG</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-12'),
(321, '2023-06-12 16:45:11', '104', '<ul>\r\n	<li>VC dengan all canvaser untuk memastikan dan mendisiplinkan jam kerja pagi</li>\r\n	<li>Monitoring target akuisis canvaser</li>\r\n	<li>Tendem dengan cvs DIAH area jeruk legi kawunganten</li>\r\n	<li>Edukaasi fitur app xml dan pemanfaatan harga ke beberapa outlet binaan</li>\r\n</ul>\r\n', '2023-06-12'),
(322, '2023-06-12 17:58:22', '70', '<p>12 Juni 2023<br />\r\n- set regex gagal di otomax PH<br />\r\n- cek winpay PH error ( sudah normal tanya ke pakyudi , userdatabese ganti)<br />\r\n- revisi motion quiztime untuk giveaway PG<br />\r\n- info ke cs PG dan SSB program giveaway sudah mulai hari ini<br />\r\n- setting desimal , tanggal di otomax PH<br />\r\n&nbsp; 1. desimal &gt;&gt; sebelumnya 20,000 menjadi 20.000<br />\r\n&nbsp; 2. tanggal &gt;&gt; sebelumnya bulan/tanggal/tahun menjadi tanggal/bulan/tahun<br />\r\n- cek otomax client di PH error (sudah normal , diupdate databese nya)<br />\r\n- setting produk telkomsel digipos menjadi 2 langkah (produk sebelumnya sudah ada)<br />\r\n&nbsp; 1. Telkomsel Paket Internet Sakti<br />\r\n&nbsp; 2. Telkomsel Promo Digipos<br />\r\n&nbsp; 3. Telkomsel Paket Haji<br />\r\n&nbsp; 4. Telkomsel Combo Sakti<br />\r\n- menambahkan produk telkomsel digipos yang belum ada di PH<br />\r\n&nbsp; 1. Telkomsel Paket Umroh&nbsp; (NEW)<br />\r\n&nbsp; 2. Telkomsel terbaik&nbsp; &gt;&gt; TD39E (NEW)<br />\r\n&nbsp; 3. Telkomsel Paket Harian&nbsp;&nbsp; &gt;&gt; TD39F (NEW)<br />\r\n&nbsp; 4. Telkomsel Paket Mingguan &gt;&gt; TD39G (NEW)<br />\r\n&nbsp; 5. Telkomsel Paket Bulanan &gt;&gt; TD39H (NEW)<br />\r\n&nbsp; 6. Telkomsel Paket Bulanan OMG (Extra Kuota)&gt;&gt; TD39I (NEW)<br />\r\n7. Telkomsel Paket Harian&nbsp;&nbsp; &gt;&gt; TD39F (NEW)<br />\r\n8. Telkomsel Paket Mingguan &gt;&gt; TD39G (NEW)<br />\r\n9. Telkomsel Paket Bulanan &gt;&gt; TD39H (NEW)<br />\r\n10. Telkomsel Paket Bulanan OMG (Extra Kuota)&gt;&gt; TD39H (NEW)<br />\r\n11. Telkomsel Paket Malam &gt;&gt; TD39I (NEW)<br />\r\n12. Telkomsel Paket Nelpon KringKring Bulk &gt;&gt; TD39J (NEW)&nbsp; belum dicoba<br />\r\n13. Telkomsel Paket Nelpon KringKring &gt;&gt; TD39J (NEW)&nbsp; belum dicoba<br />\r\n14. Telkomsel Ketengan Kuota Utama &gt;&gt; TD39K (NEW)&nbsp; belum dicoba<br />\r\n15. Telkomsel Paket Pendidikan &gt;&gt; TD39L (NEW)&nbsp; belum dicoba<br />\r\n- cek isimpel SSB error (sudah normal)<br />\r\n- cek regex kelompok jawaban BITS CEK di otomax Retail</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2023-06-12'),
(323, '2023-06-13 15:00:31', '59', '<p>13 Juni 2023</p>\r\n\r\n<p>- Rekap Transaksi &amp; Margin<br />\r\n- Croscek pendingan transaksi<br />\r\n- Croscek margin transaksi<br />\r\n- Update harga di hpp<br />\r\n- Respon chat di shopee dan inbox fb (menanyakan grosir voucher)<br />\r\n- Diskusi dg pak yudi<br />\r\n- Diskusi Flyer dgn tim design<br />\r\n- Cari jalur produk aman lancar<br />\r\n- Cek harga jual voucher di shopee,fb<br />\r\n- Follow up agen H2H (menawarkan produk)<br />\r\n&nbsp; *mustikareload<br />\r\n&nbsp; *ELRELOAD<br />\r\n&nbsp; *Travel Pulsa<br />\r\n&nbsp; *Darra<br />\r\n&nbsp; *Optimus Mobile<br />\r\n&nbsp; *Matrix<br />\r\n&nbsp; *Radar Pulsa<br />\r\n&nbsp; *UnitedTronik<br />\r\n&nbsp; *YRELOAD<br />\r\n&nbsp; *JayaArt<br />\r\n&nbsp; *giga<br />\r\n&nbsp; *Galeri Multi Payment<br />\r\n&nbsp; *Media Komunika<br />\r\n&nbsp; *SALOMON<br />\r\n&nbsp; *IJ-Tronik<br />\r\n&nbsp; *AnB Pay<br />\r\n&nbsp; *Morareload</p>\r\n', '2023-06-13'),
(324, '2023-08-12 14:19:11', '1', '<ul>\r\n	<li>modify config composer test project import excel - phpmysql</li>\r\n	<li>update composer test project</li>\r\n	<li>testing import excel to phpmysql dengan php v.74</li>\r\n</ul>\r\n', '2023-08-12'),
(325, '2023-09-05 16:00:13', '1', '<ul>\r\n	<li>setup form halaman broadcast pesan broadcast</li>\r\n	<li>testing output data input form pesan broadcast</li>\r\n	<li>membuat pengulangan untuk menangani data group</li>\r\n	<li>membuat query insert data pesan broadcast</li>\r\n	<li>testing query pesan boradcast</li>\r\n	<li>perbaikan bug gagal insert pesan broadcast</li>\r\n	<li>modifikasi tabel bc_pesan</li>\r\n	<li>Testing input data pesan broadcast</li>\r\n	<li>membuat form untuk melakukan hapus data</li>\r\n	<li>pembuatan query hapus data pesan broadcast</li>\r\n	<li>testing query hapus data pesan broadcast</li>\r\n	<li>testing fitur hapus pesan broadcast</li>\r\n	<li>pembuatan query hapus data template pesan</li>\r\n	<li>testing query hapus data template pesan</li>\r\n	<li>testing fitur hapus data template pesan</li>\r\n	<li>pembuatan query hapus data group telegram</li>\r\n	<li>testing query hapus data group telegram</li>\r\n	<li>testing fitur hapus data group telegram</li>\r\n</ul>\r\n', '2023-09-05'),
(328, '2023-09-06 09:51:21', '52', '<ul>\r\n	<li>test</li>\r\n</ul>\r\n', '2023-09-06'),
(329, '2023-09-08 16:09:14', '1', '<p>test</p>\r\n', '2023-09-08'),
(330, '2023-09-08 16:09:24', '1', '<ul>\r\n	<li>test</li>\r\n</ul>\r\n', '2023-09-07'),
(331, '2023-10-11 12:33:10', '57', '<ul>\r\n	<li><code>testing</code></li>\r\n</ul>\r\n', '2023-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `penggajian_test`
--

CREATE TABLE `penggajian_test` (
  `id` int(11) NOT NULL,
  `pegawai` varchar(255) DEFAULT NULL,
  `jabatan` varchar(255) DEFAULT NULL,
  `gapok` int(11) DEFAULT NULL,
  `bonus` int(11) DEFAULT NULL,
  `lembur` int(11) DEFAULT NULL,
  `tj_jabatan` int(11) DEFAULT NULL,
  `tj_makan` int(11) DEFAULT NULL,
  `tj_masker` int(11) DEFAULT NULL,
  `tj_kesehatan` int(11) DEFAULT NULL,
  `tj_bpjsjht` int(11) DEFAULT NULL,
  `tj_hariraya` int(11) DEFAULT NULL,
  `bonus_absen` int(11) DEFAULT NULL,
  `jml_pndptn` int(11) DEFAULT NULL,
  `pph21` int(11) NOT NULL,
  `ganti_rugi` int(11) DEFAULT NULL,
  `pinjaman` int(11) DEFAULT NULL,
  `bpjs` int(11) DEFAULT NULL,
  `pot_absen` int(11) DEFAULT NULL,
  `pot_kpi` int(11) DEFAULT NULL,
  `pot_target` int(11) DEFAULT NULL,
  `pot_sp` int(11) NOT NULL,
  `gaji_diterima` int(11) DEFAULT NULL,
  `sisa_gantirugi` int(11) DEFAULT NULL,
  `sisa_pinjaman` int(11) NOT NULL,
  `sisa_cuti` int(11) NOT NULL,
  `kpi` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggajian_test`
--

INSERT INTO `penggajian_test` (`id`, `pegawai`, `jabatan`, `gapok`, `bonus`, `lembur`, `tj_jabatan`, `tj_makan`, `tj_masker`, `tj_kesehatan`, `tj_bpjsjht`, `tj_hariraya`, `bonus_absen`, `jml_pndptn`, `pph21`, `ganti_rugi`, `pinjaman`, `bpjs`, `pot_absen`, `pot_kpi`, `pot_target`, `pot_sp`, `gaji_diterima`, `sisa_gantirugi`, `sisa_pinjaman`, `sisa_cuti`, `kpi`, `email`, `tanggal`) VALUES
(72, 'Aprelia Gusniawati', 'Supervisor', 9000000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9000000, 0, 0, 0, 0, 66800, 0, 0, 0, 8933200, 0, 0, 8, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(73, 'Silvia Dwi R', 'CS H2H', 2000000, 0, 0, 600000, 0, 400000, 0, 0, 0, 0, 3000000, 0, 0, 0, 0, 0, 66800, 0, 0, 2933200, 0, 0, 9, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(74, 'Zulfa Aulia Wibowo', 'Direktur', 0, 500000, 0, 0, 0, 350000, 0, 0, 0, 12903, 862903, 16159, 0, 5000000, 148762, 0, 0, 0, 0, -4302017, 0, 75000000, 7, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(75, 'Cholid Qiwamudin', 'Operator', 0, 0, 0, 0, 0, 350000, 0, 0, 0, 0, 350000, 0, 431250, 5635571, 66800, 0, 0, 0, 0, -5783621, 0, 55415454, 9, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(76, 'Wildan Faturohman', 'Marketing', 0, 310000, 0, 0, 0, 300000, 0, 0, 0, 12903, 622903, 0, 0, 0, 148762, 0, 0, 0, 0, 474142, 0, 0, 8, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(77, 'Ramdita Febriana', 'Operator', 0, 0, 0, 0, 0, 300000, 0, 0, 0, 12903, 312903, 16158, 0, 0, 148762, 0, 0, 0, 0, 147983, 0, 0, 6, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(78, 'Giovani Magdalena', 'Marketing 2', 0, 0, 0, 0, 0, 200000, 0, 0, 0, 12903, 212903, 16158, 0, 0, 148762, 12903, 0, 0, 0, 35080, 0, 0, 7, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(79, 'Novita Yulianika', 'CS H2H', 0, 0, 0, 0, 0, 400000, 0, 0, 0, 0, 400000, 0, 0, 0, 66800, 0, 0, 0, 0, 333200, 0, 0, 6, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(80, 'Mulyani', 'Admin H2H', 0, 0, 0, 0, 0, 300000, 0, 0, 0, 12903, 312903, 0, 0, 800000, 66800, 0, 0, 0, 0, -553897, 0, 5600000, 5, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(81, 'Erlangga Triasa', 'Operator', 0, 0, 0, 0, 0, 200000, 0, 0, 0, 0, 200000, 16158, 0, 0, 148762, 0, 0, 0, 0, 35080, 0, 0, 8, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(82, 'Andi Susanto', 'Operator Retail', 0, 0, 0, 0, 0, 150000, 0, 0, 0, 0, 150000, 0, 0, 0, 0, 50000, 0, 0, 0, 100000, 0, 0, 12, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(83, 'Rizki Puspita', 'Operator Retail', 0, 0, 0, 0, 0, 200000, 0, 0, 0, 12903, 212903, 0, 0, 0, 48800, 0, 0, 0, 0, 164103, 0, 0, 8, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(84, 'Gesang Prayogi', 'Support 1', 0, 0, 0, 0, 0, 200000, 0, 0, 0, 12903, 212903, 0, 0, 0, 66800, 0, 0, 0, 0, 146103, 0, 0, 8, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(85, 'Anisyha Huditia', 'Admin H2H', 0, 0, 0, 0, 0, 150000, 0, 0, 0, 0, 150000, 0, 0, 0, 0, 50000, 0, 0, 0, 100000, 0, 0, 7, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(86, 'Edwin Bahari', 'Support 1', 0, 0, 0, 0, 0, 100000, 0, 0, 0, 12903, 112903, 0, 0, 0, 148762, 0, 0, 0, 0, -35859, 0, 0, 6, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(87, 'Oktaf Alan', 'Support 2 (B)', 0, 0, 0, 0, 0, 100000, 0, 0, 0, 0, 100000, 0, 0, 0, 0, 0, 0, 0, 0, 100000, 0, 0, 9, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(88, 'Trivem Adde Alfan', 'Operator SDP', 0, 0, 0, 0, 0, 50000, 0, 0, 0, 0, 50000, 0, 0, 1150000, 78800, 0, 0, 0, 15000, -1193800, 0, 4600000, 9, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(89, 'M. Faiz', 'Support 2 (A)', 0, 250000, 0, 0, 0, 50000, 0, 0, 0, 0, 300000, 0, 0, 0, 54800, 0, 0, 0, 0, 245200, 0, 0, 10, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(90, 'Widyaswari Kusuma N', 'Accounting', 0, 250000, 0, 0, 0, 150000, 0, 0, 0, 12903, 412903, 0, 0, 0, 148762, 0, 0, 0, 0, 264142, 0, 0, 5, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(91, 'Siska Tri Y', 'Accounting', 0, 500000, 0, 0, 0, 100000, 0, 0, 0, 0, 600000, 0, 0, 0, 148762, 0, 0, 0, 0, 451238, 0, 0, 5, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(92, 'Eep Syaifulloh', 'Operator SDP', 0, 0, 0, 0, 0, 50000, 0, 0, 0, 12903, 62903, 0, 0, 1000000, 66800, 0, 0, 0, 0, -1003897, 0, 0, 6, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(93, 'Akmal Hidayat', 'Support 3', 0, 0, 0, 0, 0, 50000, 0, 0, 0, 12903, 62903, 0, 250100, 0, 0, 0, 0, 0, 496912, -684109, 0, 0, 8, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(94, 'Nafitta Nur istifa', 'Operator PH', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 7, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(95, 'Muji Kurnianto', 'Sales', 0, 1000000, 0, 0, 0, 50000, 0, 0, 0, 0, 1050000, 0, 0, 1700000, 66800, 0, 0, 0, 0, -716800, 0, 27200000, 7, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(96, 'Novia Nurdianing Putri', 'Support Retail', 0, 300000, 0, 0, 0, 50000, 0, 0, 0, 12903, 362903, 0, 100000, 0, 54800, 0, 0, 0, 0, 208103, 100000, 0, 5, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(97, 'Zalfa Saesarifa', 'Admin Voucher', 0, 0, 0, 0, 0, 50000, 0, 0, 0, 12903, 62903, 0, 0, 0, 0, 0, 0, 0, 0, 62903, 0, 0, 10, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(98, 'Gregorio Matthew', 'Operator PG', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 200000, 0, 0, 0, 0, 0, 7500, -207500, 800000, 0, 6, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(99, 'Valen Milan Ananta', 'CS Retail', 0, 0, 0, 0, 0, 50000, 0, 0, 0, 0, 50000, 0, 0, 0, 0, 0, 0, 0, 0, 50000, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(100, 'Bernandus Agung Wijaya', 'Operator PG', 0, 0, 0, 0, 0, 50000, 0, 0, 0, 12903, 62903, 0, 0, 0, 0, 0, 0, 0, 0, 62903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(101, 'Dwi Mey Hariprasetyo', 'Content Creator', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(102, 'Irfan Machmud', 'Programmer', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 4, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(103, 'Fajar Arif Imaduddin', 'Operator SSB', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(104, 'Mei Neiska Wati', 'Admin Retail', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(105, 'Khoerul Anam', 'Design 1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(106, 'Vina Apriliana', 'Admin Voucher', 0, 113500, 0, 0, 0, 0, 0, 0, 0, 12903, 126403, 0, 0, 0, 0, 0, 0, 0, 0, 126403, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(107, 'Abdul Azis', 'Sales', 0, 400000, 0, 0, 0, 0, 0, 0, 0, 0, 400000, 0, 0, 0, 0, 0, 0, 0, 0, 400000, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(108, 'Dhwi Sulistiyowati', 'Admin Retail', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(109, 'Dhea Amelia Putri', 'Operator SSB', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(110, 'Septi Widiarti Ningrum', 'Admin Voucher', 0, 120950, 0, 0, 0, 0, 0, 0, 0, 12903, 133853, 0, 0, 0, 0, 0, 0, 0, 0, 133853, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(111, 'Eko Azis Setiawan', 'Sales', 0, 400000, 0, 0, 0, 0, 0, 0, 0, 0, 400000, 0, 0, 0, 60800, 0, 0, 0, 0, 339200, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(112, 'Nadia Surya Wardani', 'CS Retail', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(113, 'Slamet Mahardika', 'Operator PH', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(114, 'Dion Pangestu', 'Operator SDP', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(115, 'Yogi Nuraini', 'Marketing Online', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(116, 'Ades Chaniago Akmal', 'Sales', 0, 400000, 0, 0, 0, 0, 0, 0, 0, 0, 400000, 0, 0, 0, 0, 0, 0, 0, 0, 400000, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(117, 'Aprilia Bekti Mahalani', 'Design 2', 0, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 12903, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(118, 'Luthfi Nurainy', 'Admin Voucher', 0, 54900, 0, 0, 0, 0, 0, 0, 0, 0, 54900, 0, 0, 200000, 0, 0, 0, 0, 0, -145100, 0, 600000, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(119, 'Diah Prihatin', 'Sales', 0, 400000, 0, 0, 0, 0, 0, 0, 0, 0, 400000, 0, 0, 0, 0, 100000, 0, 0, 0, 300000, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(120, 'Berlyanda Febriaty', 'Operator Ototepe', 1100000, 0, 0, 0, 0, 0, 0, 0, 0, 12903, 1112903, 0, 0, 0, 0, 0, 0, 0, 0, 1112903, 0, 0, 0, 0, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(121, 'Ambar Asmara Sapto A', 'SPV Canvaser', 0, 198130, 0, 500000, 0, 4400000, 0, 0, 0, 0, 5098130, 0, 0, 0, 0, 0, 0, 0, 0, 5098130, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(122, 'Imam Waisol Toti', 'Sales', 0, 66667, 0, 0, 0, 0, 0, 0, 0, 12903, 79570, 0, 0, 0, 0, 0, 0, 0, 0, 79570, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(123, 'Fadila Ainun Syafiq', 'Operator Ototepe', 603226, 0, 0, 0, 0, 0, 0, 0, 0, 0, 603226, 0, 210896, 0, 0, 150000, 0, 0, 0, 242330, 0, 0, 0, 0, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(124, 'Rosiana Ramadani', 'Content Creator', 1064516, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1064516, 0, 0, 0, 0, 0, 0, 0, 0, 1064516, 0, 0, 0, 1, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(125, 'Rayi Rahmahni', 'Operator Ototepe', 425806, 0, 0, 0, 0, 0, 0, 0, 0, 0, 425806, 0, 0, 0, 0, 0, 0, 0, 0, 425806, 0, 0, 0, 0, 'progamerxml@outlook.com', '2023-08-25 13:16:49'),
(126, 'Aprelia Gusniawati', 'Supervisor', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 66800, 0, 0, 0, 0, -66800, 0, 0, 8, 1, 'progamerxml@outlook.com', '2023-10-12 09:54:48'),
(127, 'Silvia Dwi R', 'CS H2H', 0, 0, 0, 500000, 0, 400000, 0, 0, 0, 0, 900000, 0, 0, 0, 66800, 0, 0, 0, 0, 833200, 0, 0, 9, 1, 'progamerxml@outlook.com', '2023-10-12 09:54:48'),
(128, 'Zulfa Aulia Wibowo', 'Direktur', 0, 500000, 0, 0, 0, 350000, 0, 0, 0, 12903, 862903, 16159, 0, 5000000, 148762, 0, 0, 0, 0, -4302017, 0, 75000000, 7, 1, 'progamerxml@outlook.com', '2023-10-12 09:54:48'),
(129, 'Cholid Qiwamudin', 'Operator', 0, 0, 0, 0, 0, 350000, 0, 0, 0, 0, 350000, 0, 431250, 5635571, 66800, 0, 0, 0, 0, -5783621, 0, 55415454, 9, 1, 'progamerxml@outlook.com', '2023-10-12 09:54:48'),
(130, 'Wildan Faturohman', 'Marketing', 0, 310000, 0, 0, 0, 300000, 0, 0, 0, 12903, 622903, 0, 0, 0, 148762, 0, 0, 0, 0, 474142, 0, 0, 8, 1, 'progamerxml@outlook.com', '2023-10-12 09:54:48');

-- --------------------------------------------------------

--
-- Table structure for table `rekap_report`
--

CREATE TABLE `rekap_report` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `kode`, `nama`) VALUES
(1, 'OPR', 'Operator'),
(2, 'SP', 'Support'),
(3, 'RTL', 'Operator Retail'),
(4, 'ADM', 'Admin H2H'),
(5, 'CV', 'Cs Voucher'),
(6, 'SPR', 'CS Retail'),
(7, 'CS', 'CS Xmltronik'),
(8, 'PG', 'CS Pg'),
(9, 'PH', 'CS PH'),
(10, 'SSB', 'CS SSB'),
(11, 'SDP', 'cs sdp');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `employ_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `employ_id`, `role_id`, `shift_id`, `created_at`, `updated_at`, `date`) VALUES
(7, 94, 7, 1, NULL, NULL, '2024-04-02'),
(8, 80, 2, 1, NULL, NULL, '2024-04-02'),
(9, 80, 11, 3, '2024-04-01 13:06:23', NULL, '2024-04-03'),
(10, 80, 1, 3, '2024-04-01 13:06:23', NULL, '2024-04-04'),
(11, 94, 11, 3, '2024-04-01 13:17:43', NULL, '2024-04-03'),
(12, 94, 11, 1, '2024-04-01 13:17:43', NULL, '2024-04-04'),
(13, 94, 1, 3, NULL, NULL, '2024-04-01'),
(14, 94, 6, 3, NULL, NULL, '2024-04-05'),
(15, 80, 4, 2, NULL, NULL, '2024-04-01'),
(16, 73, 7, 1, NULL, NULL, '2024-04-05'),
(18, 94, 2, 2, NULL, NULL, '2024-04-08'),
(20, 73, 2, 2, NULL, NULL, '2024-04-01'),
(21, 73, 9, 1, NULL, NULL, '2024-04-02'),
(22, 104, 3, 3, NULL, NULL, '2024-04-01'),
(23, 73, 4, 3, NULL, NULL, '2024-04-03'),
(24, 80, 3, 2, NULL, NULL, '2024-04-30'),
(25, 80, 3, 3, NULL, NULL, '2024-04-05'),
(26, 73, 3, 3, NULL, NULL, '2024-04-10'),
(27, 73, 3, 2, NULL, NULL, '2024-04-11'),
(28, 73, 5, 2, NULL, NULL, '2024-04-12'),
(29, 73, 1, 3, NULL, NULL, '2024-04-08'),
(30, 94, 2, 3, NULL, NULL, '2024-04-07'),
(32, 73, 1, 3, NULL, NULL, '2024-04-24'),
(33, 73, 2, 3, NULL, NULL, '2024-04-14'),
(34, 73, 8, 3, NULL, NULL, '2024-04-04'),
(35, 73, 2, 2, NULL, NULL, '2024-05-04'),
(36, 104, 3, 3, NULL, NULL, '2024-05-05'),
(37, 73, 2, 3, NULL, NULL, '2024-05-03'),
(38, 73, 1, 3, NULL, NULL, '2024-05-02'),
(39, 73, 1, 1, NULL, NULL, '2024-05-01'),
(40, 73, 4, 2, NULL, NULL, '2024-05-05'),
(41, 73, 1, 3, NULL, NULL, '2024-03-01'),
(42, 73, 3, 3, NULL, NULL, '2024-02-01'),
(43, 73, 1, 3, NULL, NULL, '2024-02-02'),
(44, 73, 4, 1, NULL, NULL, '2024-02-03'),
(45, 73, 1, 2, NULL, NULL, '2024-02-04'),
(46, 73, 2, 2, NULL, NULL, '2024-02-05'),
(47, 73, 1, 2, NULL, NULL, '2024-02-06'),
(48, 73, 1, 4, NULL, NULL, '2024-02-07'),
(49, 94, 3, 2, NULL, NULL, '2024-02-06'),
(50, 63, 1, 3, NULL, NULL, '2024-02-04'),
(51, 73, 3, 2, NULL, NULL, '2024-05-06'),
(52, 80, 3, 3, NULL, NULL, '2024-05-01'),
(53, 73, 4, 4, NULL, NULL, '2024-04-15'),
(54, 73, 8, 3, NULL, NULL, '2024-05-07'),
(55, 80, 4, 4, NULL, NULL, '2024-05-02'),
(56, 80, 1, 3, NULL, NULL, '2024-05-03'),
(57, 94, 10, 1, NULL, NULL, '2024-05-01'),
(58, 94, 10, 4, NULL, NULL, '2024-05-02'),
(59, 94, 10, 3, NULL, NULL, '2024-05-03'),
(60, 94, 10, 3, NULL, NULL, '2024-05-04'),
(61, 80, 2, 2, NULL, NULL, '2024-04-06'),
(62, 80, 1, 3, NULL, NULL, '2024-04-22'),
(63, 73, 2, 3, NULL, NULL, '2024-04-16'),
(64, 73, 3, 2, NULL, NULL, '2024-04-06'),
(65, 73, 2, 3, NULL, NULL, '2024-04-07'),
(66, 73, 3, 4, NULL, NULL, '2024-04-09'),
(67, 73, 5, 3, NULL, NULL, '2024-04-13'),
(68, 73, 4, 2, NULL, NULL, '2024-04-17'),
(69, 73, 2, 1, NULL, NULL, '2024-04-18'),
(70, 80, 1, 1, NULL, NULL, '2024-04-07'),
(71, 80, 2, 2, NULL, NULL, '2024-04-08'),
(72, 80, 3, 1, NULL, NULL, '2024-04-09'),
(73, 80, 3, 1, NULL, NULL, '2024-04-10'),
(74, 80, 3, 3, NULL, NULL, '2024-04-11'),
(75, 80, 6, 4, NULL, NULL, '2024-04-12'),
(76, 80, 6, 5, NULL, NULL, '2024-04-13'),
(77, 80, 6, 3, NULL, NULL, '2024-04-14'),
(78, 80, 6, 2, NULL, NULL, '2024-04-15'),
(79, 80, 7, 3, NULL, NULL, '2024-04-16'),
(80, 80, 5, 3, NULL, NULL, '2024-04-17'),
(81, 80, 9, 3, NULL, NULL, '2024-04-18'),
(82, 80, 5, 3, NULL, NULL, '2024-04-19'),
(83, 80, 5, 2, NULL, NULL, '2024-04-20'),
(84, 80, 9, 1, NULL, NULL, '2024-04-21'),
(85, 80, 6, 2, NULL, NULL, '2024-04-23'),
(86, 80, 3, 2, NULL, NULL, '2024-04-24'),
(87, 80, 5, 3, NULL, NULL, '2024-04-25'),
(88, 80, 6, 2, NULL, NULL, '2024-04-26'),
(89, 80, 3, 1, NULL, NULL, '2024-04-27'),
(90, 80, 1, 2, NULL, NULL, '2024-04-28'),
(91, 80, 1, 2, NULL, NULL, '2024-04-29'),
(92, 73, 3, 2, NULL, NULL, '2024-04-19'),
(93, 73, 6, 1, NULL, NULL, '2024-04-20'),
(94, 73, 3, 3, NULL, NULL, '2024-04-21'),
(95, 73, 3, 3, NULL, NULL, '2024-04-22'),
(96, 73, 2, 3, NULL, NULL, '2024-04-23'),
(97, 73, 1, 2, NULL, NULL, '2024-04-25'),
(98, 73, 4, 3, NULL, NULL, '2024-04-26'),
(99, 73, 2, 3, NULL, NULL, '2024-04-27'),
(100, 73, 2, 1, NULL, NULL, '2024-04-28'),
(101, 73, 4, 2, NULL, NULL, '2024-04-29'),
(102, 73, 2, 3, NULL, NULL, '2024-04-30'),
(103, 94, 1, 3, NULL, NULL, '2024-04-30'),
(104, 94, 7, 2, NULL, NULL, '2024-04-29'),
(105, 94, 3, 1, NULL, NULL, '2024-04-28'),
(106, 94, 1, 1, NULL, NULL, '2024-04-27'),
(107, 94, 2, 2, NULL, NULL, '2024-04-26'),
(108, 94, 3, 3, NULL, NULL, '2024-04-25'),
(109, 94, 2, 3, NULL, NULL, '2024-04-24'),
(110, 94, 7, 2, NULL, NULL, '2024-04-23'),
(111, 94, 1, 3, NULL, NULL, '2024-04-22'),
(112, 94, 2, 1, NULL, NULL, '2024-04-21'),
(113, 94, 4, 3, NULL, NULL, '2024-04-20'),
(114, 94, 2, 3, NULL, NULL, '2024-04-19'),
(115, 94, 1, 1, NULL, NULL, '2024-04-18'),
(116, 94, 6, 3, NULL, NULL, '2024-04-17'),
(117, 94, 2, 1, NULL, NULL, '2024-04-16'),
(118, 94, 4, 3, NULL, NULL, '2024-04-15'),
(119, 94, 3, 2, NULL, NULL, '2024-04-14'),
(120, 94, 2, 2, NULL, NULL, '2024-04-13'),
(121, 94, 3, 3, NULL, NULL, '2024-04-12'),
(122, 94, 2, 2, NULL, NULL, '2024-04-11'),
(123, 94, 3, 2, NULL, NULL, '2024-04-10'),
(124, 94, 6, 3, NULL, NULL, '2024-04-09'),
(125, 94, 1, 2, NULL, NULL, '2024-04-06'),
(126, 104, 3, 3, NULL, NULL, '2024-04-02'),
(127, 104, 2, 3, NULL, NULL, '2024-04-03'),
(128, 104, 2, 1, NULL, NULL, '2024-04-04'),
(129, 104, 1, 2, NULL, NULL, '2024-04-05'),
(130, 104, 2, 4, NULL, NULL, '2024-04-06'),
(131, 104, 2, 4, NULL, NULL, '2024-04-07'),
(132, 104, 2, 4, NULL, NULL, '2024-04-08');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `nama`) VALUES
(1, 'Enjing'),
(2, 'Siang'),
(3, 'Ndalu'),
(4, 'Middle'),
(5, 'Libur');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `deadline` date NOT NULL,
  `judul` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `progres` varchar(255) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `kepada` varchar(9999) DEFAULT NULL,
  `pembuat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `tgl_input`, `deadline`, `judul`, `keterangan`, `status`, `progres`, `tgl_update`, `kepada`, `pembuat`) VALUES
(19, '2023-04-08 09:41:57', '2023-04-29', 'edit tugas masuk ', '<p>Presentase progres : &gt;&gt;&gt; selalu 0 % harus nya sesuai progress yg sdh berjalan ( di pilih sebelum nya&nbsp; )</p>\r\n\r\n<p>notifikasi ketika ada tugas baru / belum selesai&nbsp; &lt;&lt;&lt;&lt; tampilakn di&nbsp;&nbsp; beranda</p>\r\n', 'selesai', '<ul>\r\n	<li>presentase selesai</li>\r\n	<li>notifikasi tugas sisi admin</li>\r\n	<li>sudah selesai pak</li>\r\n</ul>\r\n', '2023-04-12 08:27:39', 'IT / Progammer - Irfan Machmud', 'Owner Utama - Admin'),
(20, '2023-04-06 18:24:34', '2023-04-04', 'test', '<p>test ada koma, kutip &#39;</p>\r\n', 'selesai', '<p>tuliskan detail progress yang sudah dicapai</p>\r\n', '2023-04-12 08:27:50', 'IT / Progammer - Irfan Machmud', 'Owner Utama - Admin'),
(22, '2023-04-11 00:00:00', '2023-04-15', 'Buatkan konten Idul Fitri', '<ul>\r\n	<li>Buatkan konten Idul Fitri</li>\r\n	<li>Buatkan konten Idul Fitri</li>\r\n	<li>Buatkan konten Idul Fitri</li>\r\n	<li>Buatkan konten Idul Fitri</li>\r\n</ul>\r\n', 'selesai', '<p>selesai gan</p>\r\n', '2023-04-12 08:23:05', 'Konten Kreator - Hari Dwi Mei', 'Marketing Area - Karyawan 1'),
(24, '2023-04-11 00:00:00', '2023-04-16', 'Buat konten Lailatur Qodar', '<ul>\r\n	<li>Buat konten Lailatur Qodar</li>\r\n	<li>Buat konten Lailatur Qodar</li>\r\n	<li>Buat konten Lailatur Qodar</li>\r\n	<li>Buat konten Lailatur Qodar</li>\r\n</ul>\r\n', 'selesai', '<p>selesai gan</p>\r\n', '2023-04-12 08:23:17', 'Konten Kreator - Hari Dwi Mei', 'Marketing Area - Karyawan 1'),
(26, '2023-04-26 00:00:00', '2023-05-01', 'Bantu Penggajian', '<ul>\r\n	<li>Bantu penggajian</li>\r\n	<li>Bantu Penggajian</li>\r\n	<li>Bantu Penggajian</li>\r\n</ul>\r\n', 'selesai', '<p>ternyata ada refisi</p>\r\n', '2023-04-26 14:51:21', 'Accounting 2 - Siska Yuliana', 'Accounting 1 - Nina'),
(27, '2023-04-26 00:00:00', '2023-05-02', 'coba bantu juga', '<ul>\r\n	<li>coba bantu juga</li>\r\n	<li>coba bantu juga</li>\r\n	<li>coba bantu juga</li>\r\n	<li>coba bantu juga</li>\r\n</ul>\r\n', 'selesai', '<p>alhamdulillah selesai</p>\r\n', '2023-04-26 14:44:53', 'Accounting 1 - Nina', 'Accounting 2 - Siska Yuliana'),
(28, '2023-05-13 00:00:00', '2023-05-20', 'konten kebangkitan nasional', '<ol>\r\n	<li>buat konten kebangkitan dengan detail</li>\r\n</ol>\r\n\r\n<ul>\r\n	<li>test</li>\r\n	<li>test</li>\r\n	<li>estetsw</li>\r\n	<li>test</li>\r\n</ul>\r\n', 'selesai', '<p>sudah done</p>\r\n', '2023-05-13 14:55:55', 'Konten Kreator - test', 'IT / Progammer - Irfan Machmud'),
(29, '2023-05-13 00:00:00', '2023-05-16', 'tambah ram pc konten', '<p>minta tolong pasangin ram buat pc konten kreator</p>\r\n', 'selesai', '<p>test selesai</p>\r\n', '2023-05-22 13:59:56', 'IT / Progammer - Irfan Machmud', 'Konten Kreator - test'),
(30, '2023-05-20 00:00:00', '2023-05-20', 'update Elap', '<p>- bukan login tidak boleh edit laporan&nbsp; dan tugas</p>\r\n', '50%', '<p>sudah pak..mungkin mau di review dlu</p>\r\n', '2023-05-22 15:27:28', 'IT / Progammer - Irfan Machmud', 'Owner Utama - admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `level` varchar(20) NOT NULL DEFAULT 'user',
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `url_foto` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `blokir`, `level`, `nama_lengkap`, `url_foto`) VALUES
(891, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'N', 'superadmin', '1', '/../../assets/img/XML.ico'),
(893, 'irfanem', 'uRd/KZI7LtN2', 'N', 'superadmin', '68', ''),
(903, 'nina010121', 'de560277083335f7cf58b22f3fd9f84e', 'N', 'karyawan', '48', NULL),
(902, 'siska010120', 'bfc5b801e06f095a56ba133bed62f974', 'N', 'karyawan', '47', NULL),
(899, 'haridwimei', '210dd9f2ca856c35365728de2be13264', 'N', 'karyawan', '44', '/../../assets/img/gembul chan.png'),
(900, 'zulfa010615', 'cdd773039f5b1a8f41949a1fccd0768f', 'N', 'admin', '45', NULL),
(904, 'testing090523', 'ab91b14657a20d1387607e72e34c7379', 'N', 'karyawan', '49', NULL),
(905, 'test090523', '675724dba4879e3ab23c132fd61a4e2c', 'N', 'karyawan', '50', NULL),
(906, 'coba090523', '57f991681aa797ce0a7281cd5ce44555', 'N', 'karyawan', '51', NULL),
(907, 'zulfaaw', 'qhB1Lp1obw==', 'N', 'superadmin', '52', NULL),
(908, 'aprelia110814', '5fd31674d6adfe20add5a202f102da59', 'N', 'karyawan', '53', NULL),
(909, 'zulfa19', '971fc833d61a69f445b2eb5aaaf0f1ed', 'N', 'superadmin', '54', NULL),
(910, 'widyaswari100720', 'cdd773039f5b1a8f41949a1fccd0768f', 'N', 'karyawan', '55', NULL),
(911, 'siska050321', 'cdd773039f5b1a8f41949a1fccd0768f', 'N', 'karyawan', '56', NULL),
(912, 'test300423', 'pABqPM85KNZ1zA==', 'N', 'user', '57', NULL),
(913, 'wildan110116', 'cdd773039f5b1a8f41949a1fccd0768f', 'N', 'karyawan', '58', NULL),
(914, 'giovani051216', 'cdd773039f5b1a8f41949a1fccd0768f', 'N', 'karyawan', '59', NULL),
(915, 'muji010222', '6e3b39c67c722762134cd083e381efed', 'N', 'karyawan', '60', NULL),
(916, 'eko010323', 'bf5ea26e27d6d1c04a4631316a399766', 'N', 'karyawan', '61', NULL),
(917, 'abdul090123', 'de43117a1c559f11925e9596300aabb0', 'N', 'karyawan', '62', NULL),
(918, 'ades010523', 'a0009a7b07c78e92c2fe2131e8ccacc0', 'N', 'karyawan', '63', NULL),
(919, 'Hari270722', 'b0665bb9f9cd0c8c6d45a315d7fd11a5', 'N', 'karyawan', '64', '/../../assets/img/'),
(920, 'khoerul010922', 'uw12LY58dNJ2z62jFg==', 'N', 'user', '65', NULL),
(921, 'yogi010523', '10a0e856c853e2fb5580a91a9a41054c', 'N', 'karyawan', '66', NULL),
(922, 'aprilia040523', 'cdd773039f5b1a8f41949a1fccd0768f', 'N', 'karyawan', '67', NULL),
(960, 'ambar020623', 'sQh7KY45KtJxzac=', 'N', 'user', '104', NULL),
(924, 'cholid231115', 'd7c4a340669d019453d021fc6f09578f', 'N', 'karyawan', '69', NULL),
(925, 'ramdita290816', 'e3cdf70a99c1d6890c54ad56bd4a5de1', 'N', 'admin', '70', NULL),
(926, 'erlangga081018', 'd5a9f8c21814ab89d10bca12e49c77d6', 'N', 'karyawan', '71', NULL),
(927, 'silvia010914', '73707d40eb891d665ac6c62b8c78d859', 'N', 'karyawan', '72', NULL),
(928, 'novita121216', 'ac43faa3ae5b2aca6f41314025094c50', 'N', 'karyawan', '73', NULL),
(929, 'mulyani060818', '584dd91e4dd7cd794d723d2c93a1239b', 'N', 'karyawan', '74', NULL),
(930, 'anisyha111119', '295c1ad9f73d393c12866406c769bcd1', 'N', 'karyawan', '75', NULL),
(931, 'gesang300919', 'c3adfd84d0d38a7ca776958f3d67574e', 'N', 'karyawan', '76', NULL),
(932, 'edwin010221', '6f939369c99d23db7ec37f0a21e43df7', 'N', 'karyawan', '77', NULL),
(933, 'widi011119', 'f9469bec7b2fb3eb5e8daa9320796ce7', 'N', 'karyawan', '78', NULL),
(934, 'tiara170220', '239e47b8dc5a06b746e32ac30e76be54', 'N', 'karyawan', '79', NULL),
(935, 'akmal201021', 'b3e72e513dc46683118f10cf3c34a6cb', 'N', 'karyawan', '80', NULL),
(936, 'andi081018', 'da9265dfbb2278e8fec04a5ec4325c0c', 'N', 'karyawan', '81', NULL),
(937, 'rizki010519', '87215330e692d971e64eedfb72f23438', 'N', 'karyawan', '82', NULL),
(938, 'dhwi160123', '27800a8e6ca7120877e989c71ad6ab39', 'N', 'karyawan', '83', NULL),
(939, 'novia030122', '092e59aeacccc569556b1dfdde69a4e4', 'N', 'karyawan', '84', NULL),
(940, 'mei080822', 'e057678f5271b043e6eec1e3b2595139', 'N', 'karyawan', '85', NULL),
(941, 'valen150722', '6daac6d6836ffd60af69f2754ff3e3b7', 'N', 'karyawan', '86', NULL),
(942, 'nadia200323', '0a566ad8aadc9ee3343a849ba180fa36', 'N', 'karyawan', '87', NULL),
(943, 'oktaf010821', '7f172204c0d67fbad366a962cf00a2fa', 'N', 'karyawan', '88', NULL),
(944, 'nafitta161021', '8bfcac8cbe6f62d288071bc7595e7034', 'N', 'karyawan', '89', NULL),
(945, 'slamet010423', '7c493ec9e9fc1fd46f40ab07e4db501d', 'N', 'karyawan', '90', NULL),
(946, 'trivem010421', '912b8e3aa0e207945bc242ff4fa43758', 'N', 'karyawan', '91', NULL),
(947, 'muhammad010421', '45cfceffc4ae925466c461581f85c149', 'N', 'karyawan', '92', NULL),
(948, 'eep210721', 'b966000e3403e22199cd184ffc3afb97', 'N', 'karyawan', '93', NULL),
(949, 'dion010423', 'e8912f13bb3c9458539584c039ab8144', 'N', 'karyawan', '94', NULL),
(950, 'gregorio230522', 'e2611993dbb41afc3b011be72aa7ef33', 'N', 'karyawan', '95', NULL),
(951, 'bernandus060722', 'cd2ceea4aac261044a595e47bf4fd3f0', 'N', 'karyawan', '96', NULL),
(952, 'vina030123', '7269c6af46c3c57986ebf833f0bab3d6', 'N', 'karyawan', '97', NULL),
(953, 'septi010323', '5bb560cff2ef4834b70151ac5b21edc1', 'N', 'karyawan', '98', NULL),
(954, 'lutfi080523', '0e6a662a39ca191981ddf0da01424122', 'N', 'karyawan', '99', NULL),
(955, 'fajar080822', 'da9709057ef9f12af156bba1390ab8ce', 'N', 'karyawan', '100', NULL),
(956, 'dhea160223', 'e9454eed4cdfb10953d7dac1f94d8681', 'N', 'karyawan', '101', NULL),
(957, 'zalfa010222', 'cdd773039f5b1a8f41949a1fccd0768f', 'N', 'karyawan', '102', NULL),
(958, 'diah110523', '3fdbd86505d7266cd7d0011866b38ff8', 'N', 'karyawan', '103', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id` int(20) NOT NULL,
  `kode_level` int(11) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id`, `kode_level`, `level`) VALUES
(1, NULL, 'superadmin'),
(3, NULL, 'admin'),
(4, NULL, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atasan`
--
ALTER TABLE `atasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji_test`
--
ALTER TABLE `gaji_test`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kinerja`
--
ALTER TABLE `kinerja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penggajian_test`
--
ALTER TABLE `penggajian_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekap_report`
--
ALTER TABLE `rekap_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_role_id` (`role_id`),
  ADD KEY `fk_shift_id` (`shift_id`),
  ADD KEY `fk_employ_id` (`employ_id`) USING BTREE;

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`,`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atasan`
--
ALTER TABLE `atasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gaji_test`
--
ALTER TABLE `gaji_test`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kinerja`
--
ALTER TABLE `kinerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `penggajian_test`
--
ALTER TABLE `penggajian_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `rekap_report`
--
ALTER TABLE `rekap_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=961;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `fk_employ_id` FOREIGN KEY (`employ_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_shift_id` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
