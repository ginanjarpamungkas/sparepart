-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 02:55 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `app_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE IF NOT EXISTS `beli` (
`id_beli` int(11) NOT NULL,
  `tgl_beli` datetime NOT NULL,
  `total_beli` int(11) NOT NULL,
  `tunai` int(20) NOT NULL,
  `kembali` int(20) NOT NULL,
  `gudang` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`id_beli`, `tgl_beli`, `total_beli`, `tunai`, `kembali`, `gudang`) VALUES
(8, '2016-05-28 08:05:52', 2210000, 2210000, 0, 5),
(10, '2017-06-01 00:00:00', 70000, 70000, 0, 3),
(12, '2017-07-08 03:07:39', 45000, 50000, 5000, 3),
(14, '2017-07-09 00:00:00', 0, 0, 0, 5),
(15, '2017-07-09 05:07:30', 60000, 60000, 0, 5),
(16, '2017-07-13 00:00:00', 0, 0, 0, 5),
(17, '2017-07-14 02:07:12', 300000, 300000, 0, 6),
(18, '2017-07-15 11:07:36', 600000, 600000, 0, 3),
(19, '2017-07-15 12:07:28', 2100000, 2200000, 100000, 6),
(20, '2017-07-15 12:07:54', 300000, 300000, 0, 6),
(21, '2017-07-16 04:07:18', 300000, 300000, 0, 3),
(22, '2017-07-16 00:00:00', 0, 0, 0, 0),
(23, '2017-07-16 07:07:14', 9000000, 9000000, 0, 3),
(24, '2017-07-16 00:00:00', 0, 0, 0, 0),
(25, '2017-07-16 08:07:18', 120000, 120000, 0, 3),
(26, '2018-03-11 00:00:00', 0, 0, 0, 0),
(27, '2018-05-31 00:00:00', 0, 0, 0, 0),
(28, '2018-06-03 04:06:00', 268630000, 300000000, 31370000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `detail_beli`
--

CREATE TABLE IF NOT EXISTS `detail_beli` (
`id_detailb` int(11) NOT NULL,
  `id_beli` int(11) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `harga_supplier` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_beli`
--

INSERT INTO `detail_beli` (`id_detailb`, `id_beli`, `id_sparepart`, `harga_supplier`, `jumlah_beli`, `total_harga`) VALUES
(47, 8, 11, 65000, 1, 65000),
(48, 8, 10, 340000, 1, 340000),
(49, 8, 7, 65000, 1, 65000),
(50, 8, 3, 450000, 1, 450000),
(51, 8, 5, 10000, 1, 10000),
(52, 8, 6, 40000, 1, 40000),
(53, 8, 2, 45000, 1, 45000),
(54, 8, 8, 450000, 1, 450000),
(55, 8, 4, 450000, 1, 450000),
(56, 8, 1, 45000, 1, 45000),
(59, 8, 9, 50000, 1, 50000),
(60, 10, 9, 30000, 1, 30000),
(76, 12, 1, 45000, 1, 45000),
(79, 15, 9, 30000, 2, 60000),
(82, 17, 23, 300000, 1, 300000),
(84, 18, 23, 300000, 2, 600000),
(93, 19, 23, 300000, 7, 2100000),
(102, 20, 23, 300000, 1, 300000),
(104, 21, 23, 300000, 1, 300000),
(109, 23, 24, 3000000, 3, 9000000),
(123, 25, 25, 40000, 3, 120000),
(128, 28, 10, 340000, 4, 1360000),
(129, 28, 24, 3000000, 89, 267000000),
(131, 28, 2, 45000, 6, 270000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_jual`
--

CREATE TABLE IF NOT EXISTS `detail_jual` (
`id_detailj` int(11) NOT NULL,
  `id_jual` int(11) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `jumlah_jual` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_jual`
--

INSERT INTO `detail_jual` (`id_detailj`, `id_jual`, `id_sparepart`, `harga_satuan`, `jumlah_jual`, `harga_total`) VALUES
(57, 66, 2, 50000, 1, 50000),
(58, 66, 8, 500000, 1, 500000),
(59, 67, 2, 50000, 1, 50000),
(60, 67, 8, 500000, 1, 500000),
(61, 69, 5, 50000, 2, 100000),
(62, 69, 4, 500000, 3, 1500000),
(63, 70, 5, 50000, 2, 100000),
(64, 70, 4, 500000, 3, 1500000),
(65, 71, 5, 50000, 2, 100000),
(66, 71, 4, 500000, 3, 1500000),
(67, 72, 5, 50000, 2, 100000),
(68, 72, 4, 500000, 3, 1500000),
(69, 73, 5, 50000, 2, 100000),
(70, 73, 4, 500000, 3, 1500000),
(71, 74, 5, 50000, 2, 100000),
(72, 74, 4, 500000, 3, 1500000),
(73, 75, 5, 50000, 2, 100000),
(74, 75, 4, 500000, 3, 1500000),
(75, 76, 5, 50000, 2, 100000),
(76, 76, 4, 500000, 3, 1500000),
(77, 77, 5, 50000, 2, 100000),
(78, 77, 4, 500000, 3, 1500000),
(79, 78, 5, 50000, 2, 100000),
(80, 78, 4, 500000, 3, 1500000),
(81, 79, 5, 50000, 2, 100000),
(82, 79, 4, 500000, 3, 1500000),
(83, 80, 7, 70000, 1, 70000),
(84, 80, 6, 300000, 1, 300000),
(85, 81, 9, 45000, 1, 45000),
(86, 81, 6, 300000, 1, 300000),
(87, 83, 2, 50000, 1, 50000),
(88, 84, 2, 50000, 5, 250000),
(95, 86, 8, 500000, 1, 500000),
(104, 87, 8, 500000, 1, 500000),
(115, 88, 1, 50000, 1, 50000),
(118, 89, 7, 70000, 3, 210000),
(127, 90, 7, 70000, 3, 210000),
(134, 91, 4, 500000, 4, 2000000),
(143, 92, 1, 50000, 3, 150000),
(150, 93, 8, 500000, 1, 500000),
(161, 95, 1, 50000, 1, 50000),
(170, 96, 1, 50000, 2, 100000),
(171, 97, 11, 70000, 1, 70000),
(173, 97, 7, 70000, 2, 140000),
(176, 98, 10, 400000, 1, 400000),
(182, 98, 1, 50000, 2, 100000),
(185, 99, 10, 400000, 1, 400000),
(189, 100, 24, 3500000, 1, 3500000),
(198, 101, 24, 3500000, 1, 3500000),
(204, 102, 9, 45000, 3, 135000);

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE IF NOT EXISTS `harga` (
`id_harga` int(11) NOT NULL,
  `id_sparepart` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_berlaku` datetime NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`id_harga`, `id_sparepart`, `nominal`, `tgl_berlaku`, `create_at`, `update_at`) VALUES
(1, 1, 25000, '2017-03-01 05:03:03', '2017-03-19 11:40:23', '0000-00-00 00:00:00'),
(3, 3, 500000, '2017-03-02 05:12:15', '2017-03-26 16:14:56', '0000-00-00 00:00:00'),
(4, 1, 50000, '2017-04-02 01:07:13', '2017-04-02 09:57:39', '0000-00-00 00:00:00'),
(5, 8, 1000000, '2017-04-01 03:10:12', '2017-04-02 10:19:13', '2017-06-04 04:19:54'),
(6, 8, 3000000, '2017-04-02 00:00:00', '2017-04-02 10:19:51', '2017-06-04 04:20:39'),
(7, 4, 500000, '2017-04-08 07:14:11', '2017-04-09 12:58:36', '0000-00-00 00:00:00'),
(8, 5, 15000, '2017-04-04 03:08:00', '2017-04-09 12:58:36', '2017-06-03 02:58:11'),
(9, 6, 300000, '2017-04-01 15:00:00', '2017-04-09 14:37:20', '0000-00-00 00:00:00'),
(10, 7, 70000, '2017-04-05 05:00:00', '2017-04-09 14:37:20', '0000-00-00 00:00:00'),
(12, 9, 45000, '2017-04-18 06:10:00', '2017-04-23 12:52:52', '0000-00-00 00:00:00'),
(13, 10, 400000, '2017-06-03 00:00:00', '2017-05-13 03:36:42', '2017-06-02 14:13:50'),
(14, 11, 70000, '2017-05-02 00:00:00', '2017-05-13 03:36:42', '0000-00-00 00:00:00'),
(16, 1, 90000, '2017-07-31 00:00:00', '2017-06-04 05:56:53', '0000-00-00 00:00:00'),
(17, 2, 900000, '2017-07-31 00:00:00', '2017-06-04 05:56:53', '0000-00-00 00:00:00'),
(18, 3, 600000, '2017-07-29 00:00:00', '2017-06-04 05:56:53', '2017-06-09 13:46:13'),
(19, 4, 90000, '2017-07-31 00:00:00', '2017-06-04 05:56:53', '0000-00-00 00:00:00'),
(20, 5, 90000, '2017-07-31 00:00:00', '2017-06-04 05:56:53', '0000-00-00 00:00:00'),
(21, 6, 450000, '2017-07-29 00:00:00', '2017-06-04 05:56:53', '2017-06-09 13:46:49'),
(22, 7, 85000, '2017-07-20 00:00:00', '2017-06-04 05:56:53', '2017-06-09 13:44:28'),
(23, 8, 90000, '2017-07-24 00:00:00', '2017-06-04 05:56:53', '2017-06-17 13:49:44'),
(24, 9, 90000, '2017-07-31 00:00:00', '2017-06-04 05:56:53', '0000-00-00 00:00:00'),
(25, 10, 450000, '2017-07-18 00:00:00', '2017-06-04 05:56:53', '2017-06-09 13:44:09'),
(26, 11, 80000, '2017-07-18 00:00:00', '2017-06-04 05:56:53', '2017-07-16 06:26:21'),
(27, 2, 50000, '2017-06-01 00:00:00', '2017-06-04 06:01:30', '0000-00-00 00:00:00'),
(42, 22, 150000, '2017-07-29 00:00:00', '2017-07-09 02:39:11', '0000-00-00 00:00:00'),
(43, 23, 310000, '2017-07-13 00:00:00', '2017-07-13 14:23:16', '0000-00-00 00:00:00'),
(44, 23, 320000, '2017-07-31 00:00:00', '2017-07-13 14:23:16', '0000-00-00 00:00:00'),
(45, 24, 3500000, '2017-07-16 00:00:00', '2017-07-16 05:32:33', '0000-00-00 00:00:00'),
(46, 24, 4000000, '2018-07-26 00:00:00', '2017-07-16 05:32:33', '2018-05-31 14:34:35'),
(47, 25, 50000, '2019-04-06 00:00:00', '2017-07-16 06:27:06', '2018-05-31 14:33:28'),
(48, 25, 65000, '2017-07-20 00:00:00', '2017-07-16 06:27:06', '0000-00-00 00:00:00'),
(49, 26, 100000, '2018-03-11 00:00:00', '2018-03-11 12:14:19', '0000-00-00 00:00:00'),
(50, 26, 33333333, '2018-06-16 00:00:00', '2018-03-11 12:14:19', '2018-05-31 14:31:00'),
(51, 27, 200000, '2018-05-01 00:00:00', '2018-05-31 14:21:47', '2018-05-31 14:30:39'),
(52, 27, 250000, '2018-06-09 00:00:00', '2018-05-31 14:21:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE IF NOT EXISTS `jual` (
`id_jual` int(11) NOT NULL,
  `tgl_jual` datetime NOT NULL,
  `total_jual` int(11) NOT NULL,
  `tunai` int(25) NOT NULL,
  `kembali` int(25) NOT NULL,
  `kasir` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`id_jual`, `tgl_jual`, `total_jual`, `tunai`, `kembali`, `kasir`, `update_at`) VALUES
(66, '2016-04-10 04:04:42', 550000, 600000, 50000, 2, '2017-07-16 01:53:51'),
(67, '2017-04-10 04:04:58', 550000, 600000, 50000, 2, '2017-07-13 14:28:40'),
(69, '2017-04-15 04:04:51', 1600000, 1700000, 100000, 2, '2017-07-13 14:28:44'),
(70, '2017-04-15 04:04:21', 1600000, 1700000, 100000, 2, '2017-07-13 14:29:00'),
(71, '2017-04-15 04:04:08', 1600000, 1700000, 100000, 4, '2017-07-13 14:29:04'),
(72, '2017-04-15 04:04:19', 1600000, 1700000, 100000, 4, '2017-07-13 14:29:08'),
(73, '2017-03-15 04:04:47', 1600000, 1700000, 100000, 4, '2017-07-13 14:29:14'),
(74, '2017-04-15 04:04:24', 1600000, 1700000, 100000, 4, '2017-07-13 14:29:24'),
(75, '2017-04-15 04:04:40', 1600000, 1700000, 100000, 4, '2017-07-13 14:32:31'),
(76, '2017-04-15 04:04:11', 1600000, 1700000, 100000, 2, '2017-07-13 14:33:00'),
(77, '2017-04-15 04:04:58', 1600000, 1700000, 100000, 4, '2017-07-13 14:33:23'),
(78, '2017-04-15 04:04:38', 1600000, 1700000, 100000, 4, '2017-07-13 14:33:27'),
(79, '2017-04-15 04:04:46', 1600000, 1700000, 100000, 2, '2017-07-13 14:33:33'),
(80, '2017-04-15 04:04:50', 370000, 400000, 30000, 4, '2017-07-13 14:33:18'),
(81, '2017-04-23 02:04:48', 345000, 350000, 5000, 4, '2017-07-13 14:33:04'),
(83, '2017-04-29 09:04:52', 50000, 100000, 50000, 2, '2017-07-13 14:32:35'),
(86, '2017-05-13 03:05:54', 500000, 600000, 100000, 2, '2017-07-13 14:33:08'),
(87, '2017-05-13 03:05:59', 500000, 600000, 100000, 2, '2017-07-13 14:33:11'),
(88, '2017-05-13 04:05:04', 50000, 60000, 10000, 4, '2017-07-13 14:33:38'),
(89, '2017-05-13 04:05:05', 210000, 300000, 90000, 4, '2017-07-13 14:33:13'),
(90, '2017-05-13 04:05:01', 210000, 300000, 90000, 4, '2017-07-13 14:33:41'),
(91, '2017-05-13 04:05:31', 2000000, 4000000, 2000000, 4, '2017-07-13 14:33:44'),
(92, '2017-05-13 05:05:33', 150000, 200000, 50000, 2, '2017-07-13 14:33:49'),
(93, '2017-05-13 05:05:21', 500000, 500000, 0, 4, '2017-07-13 14:33:52'),
(95, '2017-05-13 05:05:26', 50000, 50000, 0, 4, '2017-07-13 14:33:55'),
(96, '2017-05-13 05:05:00', 100000, 100000, 0, 0, '0000-00-00 00:00:00'),
(97, '2017-07-09 05:07:28', 210000, 210000, 0, 0, '0000-00-00 00:00:00'),
(98, '2017-07-13 05:07:00', 500000, 500000, 0, 2, '0000-00-00 00:00:00'),
(99, '2017-07-13 05:07:27', 400000, 400000, 0, 4, '0000-00-00 00:00:00'),
(100, '2017-07-16 07:07:49', 3500000, 3500000, 0, 2, '0000-00-00 00:00:00'),
(101, '2017-07-16 07:07:19', 3500000, 3500000, 0, 2, '0000-00-00 00:00:00'),
(102, '2017-07-16 08:07:04', 135000, 140000, 5000, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `referensi`
--

CREATE TABLE IF NOT EXISTS `referensi` (
  `id_list` int(11) NOT NULL,
  `list` varchar(255) NOT NULL,
  `kelompok` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referensi`
--

INSERT INTO `referensi` (`id_list`, `list`, `kelompok`) VALUES
(1, 'Admin', 'Status'),
(2, 'User', 'Status'),
(1, 'Sport', 'jenis_motor'),
(2, 'Bebek', 'jenis_motor'),
(3, 'Keuangan', 'Status'),
(4, 'Kasir', 'Status'),
(5, 'Gudang', 'Status'),
(3, 'Matic', 'jenis_motor'),
(0, 'Manager', 'Jabatan'),
(0, 'Kasir', 'Jabatan'),
(0, 'Gudang', 'Jabatan');

-- --------------------------------------------------------

--
-- Table structure for table `spareparts`
--

CREATE TABLE IF NOT EXISTS `spareparts` (
`id_sparepart` int(11) NOT NULL,
  `nama_sparepart` varchar(255) NOT NULL,
  `jenis_motor` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spareparts`
--

INSERT INTO `spareparts` (`id_sparepart`, `nama_sparepart`, `jenis_motor`, `stok`, `update_at`) VALUES
(1, 'Spion CB 150 R', 'Sport', 31, '2017-07-13 15:15:00'),
(2, 'Oli Mesin MPX', 'Sport', 108, '2018-06-03 02:34:01'),
(3, 'Karburator Tiger', 'Sport', 102, '2017-05-28 06:35:53'),
(4, 'Rantai Supra X 125', 'Bebek', 102, '2017-05-28 06:35:53'),
(5, 'Lampu Depan Blade', 'Bebek', 102, '2017-05-28 06:35:53'),
(6, 'Van Belt Beat', 'Matic', 100, '2017-05-12 16:51:52'),
(7, 'Kampas Rem Belakang Scoopy', 'Matic', 100, '2017-07-09 03:03:28'),
(8, 'Radiator CBR 150 R', 'Sport', 101, '2017-05-28 06:35:53'),
(9, 'Oli Mesin Matic', 'Matic', 102, '2017-07-16 06:41:05'),
(10, 'Gear Set CB10R', 'Sport', 104, '2018-06-03 02:34:00'),
(11, 'Bearing Ball', 'Sport', 101, '2017-07-09 03:03:28'),
(23, 'Chamfast', 'Bebek', 12, '2017-07-16 02:11:18'),
(24, 'Head Machine', 'Sport', 90, '2018-06-03 02:34:00'),
(25, 'Rantai', 'Bebek', 3, '2017-07-16 06:38:19'),
(26, 'www', 'Sport', 0, '0000-00-00 00:00:00'),
(27, 'Velg TK Bright', 'Sport', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `akses` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `status`, `create_at`, `akses`) VALUES
(1, 'Ginanjar Pamungkas Bob', 'gepe', '1111', 'Manager', '2017-04-01 13:35:17', 1),
(2, 'Ariyanti', 'ovi', '2222', 'Kasir', '2017-07-09 11:55:12', 1),
(3, 'Uswatun Khasanah', 'utun', '3333', 'Gudang', '2017-07-10 22:46:07', 1),
(4, 'Eka', 'mbul', '2222', 'Gudang', '2017-07-13 14:28:11', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
 ADD PRIMARY KEY (`id_beli`);

--
-- Indexes for table `detail_beli`
--
ALTER TABLE `detail_beli`
 ADD PRIMARY KEY (`id_detailb`);

--
-- Indexes for table `detail_jual`
--
ALTER TABLE `detail_jual`
 ADD PRIMARY KEY (`id_detailj`);

--
-- Indexes for table `harga`
--
ALTER TABLE `harga`
 ADD PRIMARY KEY (`id_harga`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
 ADD PRIMARY KEY (`id_jual`);

--
-- Indexes for table `spareparts`
--
ALTER TABLE `spareparts`
 ADD PRIMARY KEY (`id_sparepart`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beli`
--
ALTER TABLE `beli`
MODIFY `id_beli` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `detail_beli`
--
ALTER TABLE `detail_beli`
MODIFY `id_detailb` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `detail_jual`
--
ALTER TABLE `detail_jual`
MODIFY `id_detailj` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `harga`
--
ALTER TABLE `harga`
MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `jual`
--
ALTER TABLE `jual`
MODIFY `id_jual` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `spareparts`
--
ALTER TABLE `spareparts`
MODIFY `id_sparepart` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
