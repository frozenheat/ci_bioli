-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2014 at 01:05 AM
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
('b241120140958694852', '2014-11-24 09:58:00', 'Guide_Valve_(Bosh_klep)_H90', 6, 3, '2014-11-24 13:58:00', '2014-11-24 17:58:00', 'utama'),
('b241120140958785396', '2014-11-24 09:58:00', 'Guide_Valve_(Bosh_klep)_c700', 2, 1, '2014-11-24 11:58:00', '2014-11-24 13:58:00', 'utama'),
('v241120140958709124', '0000-00-00 00:00:00', 'Guide_Valve_(Bosh_klep)_H90', 0, 0, '2014-11-25 07:00:00', '2014-11-25 09:00:00', 'utama'),
('v241120140958782951', '2014-11-24 09:58:00', 'Valve_Seat_(Cincin_Setting)_Star/Astrea', 1, 1, '2014-11-24 10:58:00', '2014-11-24 11:58:00', 'utama');

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
  `jumlah_ketersediaan_pesanan` int(11) NOT NULL,
  `jumlah_kekurangan_pesanan` int(11) NOT NULL,
  `perkiraan_waktu_selesai` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_barang`
--

INSERT INTO `pesanan_barang` (`id_pesanan`, `id_pemesan`, `nama_barang`, `tanggal_pemesanan`, `jam_pemesanan`, `jumlah_pesanan`, `status_pesanan`, `sts_konfirm`, `jumlah_ketersediaan_pesanan`, `jumlah_kekurangan_pesanan`, `perkiraan_waktu_selesai`) VALUES
('b2311201415794', 'c0826459', 'Guide_Valve_(Bosh_klep)_H90', '2014-11-23', '21:31:10', 341, 'dalam_penjadwalan', 'pesan', 0, 0, '2014-11-25 09:00:00'),
('b2311201487192', 'c5001', 'Guide_Valve_(Bosh_klep)_c700', '2014-11-23', '21:30:27', 131, 'dalam_penjadwalan', 'pesan', 0, 0, '2014-11-24 13:58:00'),
('b2311201495364', 'c5001', 'Guide_Valve_(Bosh_klep)_H90', '2014-11-23', '21:30:32', 141, 'dalam_penjadwalan', 'pesan', 0, 0, '2014-11-25 09:00:00'),
('c2311201403561', 'c5001', 'cylinder_liner_(boring)_FR70', '2014-11-23', '21:30:19', 132, 'terpenuhi', 'pesan', 0, 0, '2014-11-17 00:00:00'),
('c2311201447093', 'c5001', 'cylinder_liner_(boring)_RC80', '2014-11-23', '21:30:23', 333, 'terpenuhi', 'pesan', 0, 0, '2014-11-19 00:00:00'),
('v2311201424903', 'c0826459', 'Valve_Seat_(Cincin_Setting)_Grand/Prima', '2014-11-23', '21:31:14', 221, 'terpenuhi', 'pesan', 0, 0, '2014-11-19 00:00:00'),
('v2311201434926', 'c0826459', 'Valve_Seat_(Cincin_Setting)_Star/Astrea', '2014-11-23', '21:31:33', 444, 'dalam_penjadwalan', 'pesan', 0, 0, '2014-11-24 11:58:00'),
('v2311201485961', 'c0826459', 'vValve_Seat_(Cincin_Setting)_Shogun', '2014-11-23', '21:31:36', 132, 'terpenuhi', 'pesan', 0, 0, '2014-11-19 00:00:00');

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
('2014-11-17', 'c001', 400, 'terbaru'),
('2014-11-19', 'c002', 444, 'terbaru'),
('2014-11-19', 'g001', 0, 'terbaru'),
('2014-11-19', 'g002', 30, 'terbaru'),
('2014-11-19', 'v001', 335, 'terbaru'),
('2014-11-19', 'v002', 23, 'terbaru'),
('2014-11-19', 'v003', 465, 'terbaru');

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
