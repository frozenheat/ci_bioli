-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2014 at 07:36 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_bioli`
--

-- --------------------------------------------------------

--
-- Table structure for table `otoritas`
--

CREATE TABLE IF NOT EXISTS `otoritas` (
  `id_otoritas` varchar(50) NOT NULL,
  `nama_otoritas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otoritas`
--

INSERT INTO `otoritas` (`id_otoritas`, `nama_otoritas`) VALUES
('a', 'admin_utama'),
('m', 'admin_pelanggan'),
('p', 'admin_produksi');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pgw` varchar(50) NOT NULL,
  `nm_pgw` varchar(50) NOT NULL,
  `almt_pgw` varchar(50) NOT NULL,
  `telp_pgw` int(11) NOT NULL,
  `almt_email_pgw` varchar(50) NOT NULL,
  `otoritas` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pgw`, `nm_pgw`, `almt_pgw`, `telp_pgw`, `almt_email_pgw`, `otoritas`, `password`) VALUES
('a5001', 'herry', 'sdps', 1238213201, 'aaaa@ymai.com', 'admin_utama', 'admin'),
('h5001', 'testing', 'testing', 2147483647, 'aaa@msn.com', 'admin_utama', 'h5001'),
('m24189', 'kepala', 'surga', 138213021, 'ga tau', 'admin_pelanggan', 'adpel'),
('m5001', 'rudi', 'dsafasd', 123141, 'rudi@gmail.com', 'admin_pelanggan', 'adpel'),
('m52178', 'kepala', 'surga', 138213021, 'ga tau', 'admin_pelanggan', 'adpel'),
('p5001', 'adi', 'dsafjasdjoa', 3213124, 'coba@gmail.com', 'admin_produksi', 'produksi');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pln` varchar(50) NOT NULL,
  `nm_pln` varchar(50) NOT NULL,
  `almt_pln` varchar(100) NOT NULL,
  `almt_email` varchar(50) NOT NULL,
  `no_telp` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pln`, `nm_pln`, `almt_pln`, `almt_email`, `no_telp`, `password`) VALUES
('c5001', 'herry susanto', 'simpang darmo permai selatan', 'ruinz90@gmail.com', 80821031, 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otoritas`
--
ALTER TABLE `otoritas`
 ADD PRIMARY KEY (`id_otoritas`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`id_pgw`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
 ADD PRIMARY KEY (`id_pln`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
