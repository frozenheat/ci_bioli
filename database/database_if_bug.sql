-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2015 at 09:44 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
('b538', 'Packing almunium 25', 'Boring', 150, 2),
('b702', 'Cylinder Liner RC 80', 'Boring', 120, 2),
('b713', 'Cylinder Liner FR 70', 'Boring', 120, 2),
('b856', 'Cylinder Liner A 100', 'Boring', 120, 2),
('b896', 'Packing almunium 20', 'Boring', 150, 2),
('bk063', 'Guide Valve H90', 'Bosh_Klep', 200, 3),
('bk379', 'Guide Valve GL100', 'Bosh_Klep', 200, 3),
('bk630', 'Guide Valve C 700', 'Bosh_Klep', 200, 3),
('bl403', 'Grand 3', 'Bosh_Kopling', 200, 3),
('bl527', 'Grand 2', 'Bosh_Kopling', 200, 3),
('bl876', 'Grand 1', 'Bosh_Kopling', 200, 3),
('c140', 'Valve Seat Star / Astrea', 'Cincin_Setting', 250, 3),
('c349', 'Valve Seat Shogun', 'Cincin_Setting', 250, 3),
('c921', 'Valve Seat Grand / Prima', 'Cincin_Setting', 250, 3),
('pk756', 'Paku keling', 'paku_keling', 350, 2);

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
('Boring', 'b'),
('Bosh_Klep', 'bk'),
('Bosh_Kopling', 'bl'),
('Cincin_Setting', 'c'),
('Packing_Almunium', 'pa'),
('paku_keling', 'pk'),
('Sok_Kopling_Ganda', 'sk');

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
  `password` varchar(30) NOT NULL,
  `image_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pgw`, `nm_pgw`, `almt_pgw`, `telp_pgw`, `almt_email_pgw`, `otoritas`, `password`, `image_path`) VALUES
('a5001', 'herry1', 'SDPS', 3213123, 'herry@gmail.com', 'admin_utama', 'admin', 'http://localhost/ci_bioli/uploads/pegawai/a5001/nature1.jpg'),
('m5001', 'rudisss', 'dsafasd', 123141, 'rudi@gmail.com', 'admin_pelanggan', 'adpel', ''),
('p5001', 'adi', 'adada', 12312312, 'adi@gmail.com', 'admin_produksi', 'adpro', '');

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
  `password` varchar(50) NOT NULL,
  `image_path` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pln`, `nm_pln`, `almt_pln`, `almt_email`, `no_telp`, `password`, `image_path`) VALUES
('c0103201520971', 'rendy', 'kartini', 'rendy@gmail.com', 2147483647, 'rendy', 'http://localhost/ci_bioli/uploads/pelanggan/c0103201520971/nature1.jpg'),
('c0826459', 'adi', 'manukan', 'ad@gmail.com', 23, 'adis', ''),
('c5001', 'herry', 'simpang', 'ruinz90@gmail.com', 80821031, 'pelanggan', 'http://localhost/ci_bioli/uploads/pelanggan/c5001/m_08410100022.jpg');

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
  `perkiraan_waktu_selesai` datetime NOT NULL,
  `penghitungan_stock` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_barang`
--

INSERT INTO `pesanan_barang` (`id_pesanan`, `id_pemesan`, `nama_barang`, `tanggal_pemesanan`, `jam_pemesanan`, `jumlah_pesanan`, `status_pesanan`, `sts_konfirm`, `id_prdksi`, `perkiraan_waktu_selesai`, `penghitungan_stock`) VALUES
('b0103201503614', 'c0103201520971', 'Cylinder Liner RC 80', '2015-03-01', '03:43:20', 50, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b0103201503641', 'c0826459', 'Cylinder Liner FR 70', '2015-03-01', '03:42:14', 100, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b0103201547650', 'c0826459', 'Cylinder Liner RC 80', '2015-03-01', '03:42:47', 90, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b0103201550326', 'c5001', 'Cylinder Liner FR 70', '2015-03-01', '03:41:07', 100, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('bk0103201531564', 'c0826459', 'Guide Valve H90', '2015-03-01', '03:42:55', 40, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('bk0103201581963', 'c5001', 'Guide Valve H90', '2015-03-01', '03:41:12', 80, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('bl0103201514852', 'c0103201520971', 'Grand 3', '2015-03-01', '03:43:34', 30, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('bl0103201518954', 'c5001', 'Grand 3', '2015-03-01', '03:41:37', 60, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('bl0103201523896', 'c0103201520971', 'Grand 2', '2015-03-01', '03:43:26', 30, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('bl0103201579345', 'c5001', 'Grand 2', '2015-03-01', '03:41:30', 60, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('c0103201516978', 'c0826459', 'Valve Seat Star / Astrea', '2015-03-01', '03:42:37', 70, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('c0103201518259', 'c5001', 'Valve Seat Star / Astrea', '2015-03-01', '03:41:21', 100, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', '');

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
('2015-03-01', 'b538', 0, 'terbaru'),
('2015-03-01', 'b702', 0, 'terbaru'),
('2015-03-01', 'b713', 0, 'terbaru'),
('2015-03-01', 'b856', 0, 'terbaru'),
('2015-03-01', 'b896', 0, 'terbaru'),
('2015-03-01', 'bk063', 0, 'terbaru'),
('2015-03-01', 'bk379', 0, 'terbaru'),
('2015-03-01', 'bk630', 0, 'terbaru'),
('2015-03-01', 'bl403', 0, 'terbaru'),
('2015-03-01', 'bl527', 0, 'terbaru'),
('2015-03-01', 'bl876', 0, 'terbaru'),
('2015-03-01', 'c140', 0, 'terbaru'),
('2015-03-01', 'c349', 0, 'terbaru'),
('2015-03-01', 'c921', 0, 'terbaru'),
('2015-03-01', 'pk756', 0, 'terbaru');

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
