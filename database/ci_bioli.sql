-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2014 at 10:49 PM
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
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_brng` varchar(50) NOT NULL,
  `nm_brng` varchar(50) NOT NULL,
  `nm_jns_brng` varchar(50) NOT NULL,
  `lot_size` int(11) NOT NULL,
  `wkt_prdksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brng`, `nm_brng`, `nm_jns_brng`, `lot_size`, `wkt_prdksi`) VALUES
('c001', 'cylinder_liner_(boring)_FR70', 'Cylinder_liner', 50, 3),
('c002', 'cylinder_liner_(boring)_RC80', 'Cylinder_liner', 90, 4),
('g001', 'Guide_Valve_(Bosh_klep)_c700', 'Bosh_klep', 200, 2),
('g002', 'Guide_Valve_(Bosh_klep)_H90', 'Bosh_klep', 200, 2),
('v001', 'Valve_Seat_(Cincin_Setting)_Grand/Prima', 'Cincin_setting', 500, 1),
('v002', 'Valve_Seat_(Cincin_Setting)_Star/Astrea', 'Cincin_setting', 500, 1),
('v003', 'vValve_Seat_(Cincin_Setting)_Shogun', 'Cincin_setting', 200, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_prdksi`
--

CREATE TABLE IF NOT EXISTS `jadwal_prdksi` (
  `id_prdksi` varchar(100) NOT NULL,
  `waktu_jdwl` datetime NOT NULL,
  `nm_brng` varchar(50) NOT NULL,
  `wkt_prdksi` int(11) NOT NULL,
  `jumlah_batch` int(11) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_prdksi`
--

INSERT INTO `jadwal_prdksi` (`id_prdksi`, `waktu_jdwl`, `nm_brng`, `wkt_prdksi`, `jumlah_batch`, `waktu_mulai`, `waktu_selesai`, `status`) VALUES
('b071220142245652071', '2014-12-07 22:45:00', 'Guide_Valve_(Bosh_klep)_c700', 6, 3, '2014-12-08 07:45:00', '2014-12-08 13:45:00', 'utama'),
('b071220142245843759', '2014-12-07 22:45:00', 'Guide_Valve_(Bosh_klep)_H90', 4, 2, '2014-12-08 03:45:00', '2014-12-08 07:45:00', 'utama'),
('c071220142245108243', '0000-00-00 00:00:00', 'cylinder_liner_(boring)_FR70', 0, 0, '2014-12-14 07:00:00', '2014-12-14 10:00:00', 'utama'),
('c071220142245341927', '2014-12-07 22:45:00', 'cylinder_liner_(boring)_RC80', 28, 7, '2014-12-09 13:00:00', '2014-12-09 21:00:00', 'utama'),
('c071220142245485632', '0000-00-00 00:00:00', 'cylinder_liner_(boring)_RC80', 0, 0, '2014-12-10 07:00:00', '2014-12-10 19:00:00', 'utama'),
('c071220142245498065', '0000-00-00 00:00:00', 'cylinder_liner_(boring)_FR70', 0, 0, '2014-12-13 07:00:00', '2014-12-13 19:00:00', 'utama'),
('c071220142245586347', '0000-00-00 00:00:00', 'cylinder_liner_(boring)_RC80', 0, 0, '2014-12-11 07:00:00', '2014-12-11 15:00:00', 'utama'),
('c071220142245769234', '2014-12-07 22:45:00', 'cylinder_liner_(boring)_FR70', 30, 10, '2014-12-11 15:00:00', '2014-12-11 18:00:00', 'utama'),
('c071220142245918756', '0000-00-00 00:00:00', 'cylinder_liner_(boring)_FR70', 0, 0, '2014-12-12 07:00:00', '2014-12-12 19:00:00', 'utama'),
('v071220142245136245', '0000-00-00 00:00:00', 'vValve_Seat_(Cincin_Setting)_Shogun', 0, 0, '2014-12-09 07:00:00', '2014-12-09 13:00:00', 'utama'),
('v071220142245205196', '2014-12-07 22:45:00', 'Valve_Seat_(Cincin_Setting)_Grand/Prima', 1, 1, '2014-12-07 23:45:00', '2014-12-08 00:45:00', 'utama'),
('v071220142245217493', '2014-12-07 22:45:00', 'vValve_Seat_(Cincin_Setting)_Shogun', 12, 4, '2014-12-08 13:45:00', '2014-12-08 19:45:00', 'utama'),
('v071220142245401365', '2014-12-07 22:45:00', 'Valve_Seat_(Cincin_Setting)_Star/Astrea', 3, 3, '2014-12-08 00:45:00', '2014-12-08 03:45:00', 'utama');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `nm_jns_brng` varchar(50) NOT NULL,
  `id_jns_brng` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`nm_jns_brng`, `id_jns_brng`) VALUES
('Bosh_klep', 'b'),
('Cincin_setting', 'v'),
('Cylinder_liner', 'c');

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
('a5001', 'herry1', 'SDPS', 3213123, 'herry@gmail.com', 'admin_utama', 'admin'),
('m5001', 'rudisss', 'dsafasd', 123141, 'rudi@gmail.com', 'admin_pelanggan', 'adpel'),
('p5001', 'adi', 'adada', 12312312, 'adi@gmail.com', 'admin_produksi', 'adpro');

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
('c0826459', 'adi', 'manukan', 'ad@gmail.com', 23, 'adis'),
('c5001', 'herry susanto kwee', 'simpang', 'ruinz90@gmail.com', 80821031, 'pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_barang`
--

CREATE TABLE IF NOT EXISTS `pesanan_barang` (
  `id_pesanan` varchar(100) NOT NULL,
  `id_pemesan` varchar(50) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `jam_pemesanan` time NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `status_pesanan` varchar(20) NOT NULL,
  `sts_konfirm` varchar(50) NOT NULL,
  `id_prdksi` varchar(100) NOT NULL,
  `perkiraan_waktu_selesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_barang`
--

INSERT INTO `pesanan_barang` (`id_pesanan`, `id_pemesan`, `nama_barang`, `tanggal_pemesanan`, `jam_pemesanan`, `jumlah_pesanan`, `status_pesanan`, `sts_konfirm`, `id_prdksi`, `perkiraan_waktu_selesai`) VALUES
('b0712201403891', 'c5001', 'Guide_Valve_(Bosh_klep)_c700', '2014-12-07', '22:43:18', 800, 'dalam_penjadwalan', 'pesan', 'b071220142245652071', '2014-12-08 13:45:00'),
('b0712201415032', 'c5001', 'Guide_Valve_(Bosh_klep)_H90', '2014-12-07', '22:43:22', 800, 'dalam_penjadwalan', 'pesan', 'b071220142245843759', '2014-12-08 07:45:00'),
('c0712201436079', 'c5001', 'cylinder_liner_(boring)_RC80', '2014-12-07', '22:43:14', 800, 'dalam_penjadwalan', 'pesan', 'c071220142245341927', '2014-12-11 15:00:00'),
('c0712201448297', 'c5001', 'cylinder_liner_(boring)_FR70', '2014-12-07', '22:43:09', 800, 'dalam_penjadwalan', 'pesan', 'c071220142245769234', '2014-12-14 10:00:00'),
('v0712201402487', 'c5001', 'Valve_Seat_(Cincin_Setting)_Star/Astrea', '2014-12-07', '22:43:31', 800, 'dalam_penjadwalan', 'pesan', 'v071220142245401365', '2014-12-08 03:45:00'),
('v0712201427543', 'c5001', 'Valve_Seat_(Cincin_Setting)_Star/Astrea', '2014-12-07', '22:43:36', 800, 'dalam_penjadwalan', 'pesan', 'v071220142245401365', '2014-12-08 03:45:00'),
('v0712201489256', 'c5001', 'Valve_Seat_(Cincin_Setting)_Grand/Prima', '2014-12-07', '22:43:27', 800, 'dalam_penjadwalan', 'pesan', 'v071220142245205196', '2014-12-08 00:45:00'),
('v0712201489764', 'c5001', 'vValve_Seat_(Cincin_Setting)_Shogun', '2014-12-07', '22:43:44', 800, 'dalam_penjadwalan', 'pesan', 'v071220142245217493', '2014-12-09 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock_barang`
--

CREATE TABLE IF NOT EXISTS `stock_barang` (
  `tgl_stock` date NOT NULL,
  `id_brng` varchar(50) NOT NULL,
  `jml_stock` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_barang`
--

INSERT INTO `stock_barang` (`tgl_stock`, `id_brng`, `jml_stock`, `status`) VALUES
('2014-11-17', 'c001', 400, 'lama'),
('2014-11-19', 'c002', 444, 'lama'),
('2014-11-19', 'g001', 0, 'lama'),
('2014-11-19', 'g002', 30, 'lama'),
('2014-11-19', 'v001', 335, 'lama'),
('2014-11-19', 'v002', 23, 'lama'),
('2014-11-19', 'v003', 465, 'lama'),
('2014-11-30', 'v001', 235, 'lama'),
('2014-11-30', 'v002', 423, 'lama'),
('2014-12-01', 'g002', 30, 'lama'),
('2014-12-01', 'v003', 65, 'lama'),
('2014-12-02', 'c002', 24, 'lama'),
('2014-12-02', 'g001', 0, 'lama'),
('2014-12-03', 'c001', 0, 'lama'),
('2014-12-08', 'c002', 204, 'lama'),
('2014-12-08', 'g001', 0, 'terbaru'),
('2014-12-08', 'g002', 30, 'terbaru'),
('2014-12-08', 'v001', 435, 'terbaru'),
('2014-12-08', 'v002', 1123, 'terbaru'),
('2014-12-09', 'v003', 65, 'terbaru'),
('2014-12-10', 'c001', 300, 'lama'),
('2014-12-11', 'c002', 34, 'terbaru'),
('2014-12-14', 'c001', 0, 'terbaru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id_brng`);

--
-- Indexes for table `jadwal_prdksi`
--
ALTER TABLE `jadwal_prdksi`
 ADD PRIMARY KEY (`id_prdksi`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
 ADD PRIMARY KEY (`nm_jns_brng`);

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

--
-- Indexes for table `pesanan_barang`
--
ALTER TABLE `pesanan_barang`
 ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `stock_barang`
--
ALTER TABLE `stock_barang`
 ADD PRIMARY KEY (`tgl_stock`,`id_brng`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
