-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2015 at 01:49 PM
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
  `lot_size_cetak` int(11) NOT NULL,
  `lot_size_bubut` int(11) NOT NULL,
  `lot_size_milling` int(11) NOT NULL,
  `wkt_prdksi_cetak` int(11) NOT NULL,
  `wkt_prdksi_bubut` int(11) NOT NULL,
  `wkt_prdksi_milling` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_brng`, `nm_brng`, `nm_jns_brng`, `lot_size_cetak`, `lot_size_bubut`, `lot_size_milling`, `wkt_prdksi_cetak`, `wkt_prdksi_bubut`, `wkt_prdksi_milling`) VALUES
('b016', 'Cylinder Liner RC 80', 'Boring', 120, 96, 60, 3, 3, 2),
('b419', 'Valve Seat Star / Astrea', 'Boring', 60, 48, 48, 1, 2, 1),
('b803', 'Cylinder_Liner_FR70', 'Boring', 72, 60, 60, 1, 2, 3),
('bl073', 'Bosh Kopling Grand 2', 'Bosh_Kopling', 72, 84, 72, 2, 2, 1),
('bl236', 'Bosh Kopling Grand 3', 'Bosh_Kopling', 72, 48, 48, 1, 2, 3),
('c536', 'Guide Valve H 90', 'Cincin_Setting', 120, 156, 96, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mesin`
--

CREATE TABLE IF NOT EXISTS `jadwal_mesin` (
  `id_jadwal_mesin` varchar(100) NOT NULL,
  `waktu_jdwl` datetime NOT NULL,
  `jenis_mesin` varchar(100) NOT NULL,
  `id_prdksi` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `waktu_prdksi` int(11) NOT NULL,
  `jumlah_batch` int(11) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `status_jadwal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_mesin`
--

INSERT INTO `jadwal_mesin` (`id_jadwal_mesin`, `waktu_jdwl`, `jenis_mesin`, `id_prdksi`, `nama_barang`, `waktu_prdksi`, `jumlah_batch`, `waktu_mulai`, `waktu_selesai`, `status_jadwal`) VALUES
('bb158', '2015-03-15 18:37:00', 'bubut', 'b20151437', 'Cylinder_Liner_FR70', 6, 3, '2015-03-17 11:30:00', '2015-03-17 17:30:00', 'utama'),
('bb2015520', '2015-03-15 18:37:00', 'bubut', '', 'Cylinder Liner RC 80', 0, 0, '2015-03-19 07:00:00', '2015-03-19 10:00:00', 'lanjutan'),
('bb270', '2015-03-15 18:37:00', 'bubut', 'b20159182', 'Valve Seat Star / Astrea', 10, 5, '2015-03-18 07:00:00', '2015-03-18 17:00:00', 'utama'),
('bb976', '2015-03-15 18:37:00', 'bubut', 'b20151524', 'Cylinder Liner RC 80', 6, 2, '2015-03-18 17:30:00', '2015-03-18 20:30:00', 'utama'),
('bc176', '2015-03-15 18:37:00', 'cetak', 'b20151437', 'Cylinder_Liner_FR70', 3, 3, '2015-03-16 16:00:00', '2015-03-16 18:00:00', 'utama'),
('bc201', '2015-03-15 18:37:00', 'cetak', 'b20151524', 'Cylinder Liner RC 80', 6, 2, '2015-03-17 13:00:00', '2015-03-17 19:00:00', 'utama'),
('bc2015879', '2015-03-15 18:37:00', 'cetak', '', 'Cylinder_Liner_FR70', 0, 0, '2015-03-17 07:00:00', '2015-03-17 08:00:00', 'lanjutan'),
('bc572', '2015-03-15 18:37:00', 'cetak', 'b20159182', 'Valve Seat Star / Astrea', 4, 4, '2015-03-17 08:30:00', '2015-03-17 12:30:00', 'utama'),
('bl2015346', '2015-03-15 18:37:00', 'bubut', '', 'Bosh Kopling Grand 2', 0, 0, '2015-03-17 07:00:00', '2015-03-17 11:00:00', 'lanjutan'),
('bl2015687', '2015-03-15 18:37:00', 'milling', '', 'Bosh Kopling Grand 3', 0, 0, '2015-03-21 07:00:00', '2015-03-21 10:00:00', 'lanjutan'),
('blb542', '2015-03-15 18:37:00', 'bubut', 'bl20155298', 'Bosh Kopling Grand 3', 8, 4, '2015-03-19 10:30:00', '2015-03-19 18:30:00', 'utama'),
('blb645', '2015-03-15 18:37:00', 'bubut', 'bl20150517', 'Bosh Kopling Grand 2', 6, 3, '2015-03-16 15:30:00', '2015-03-16 17:30:00', 'utama'),
('blc350', '2015-03-15 18:37:00', 'cetak', 'bl20150517', 'Bosh Kopling Grand 2', 6, 3, '2015-03-16 09:30:00', '2015-03-16 15:30:00', 'utama'),
('blc352', '2015-03-15 18:37:00', 'cetak', 'bl20155298', 'Bosh Kopling Grand 3', 3, 3, '2015-03-18 07:00:00', '2015-03-18 10:00:00', 'utama'),
('blm163', '2015-03-15 18:37:00', 'milling', 'bl20150517', 'Bosh Kopling Grand 2', 3, 3, '2015-03-17 11:00:00', '2015-03-17 14:00:00', 'utama'),
('blm976', '2015-03-15 18:37:00', 'milling', 'bl20155298', 'Bosh Kopling Grand 3', 12, 4, '2015-03-20 09:30:00', '2015-03-20 18:30:00', 'utama'),
('bm2015487', '2015-03-15 18:37:00', 'milling', '', 'Cylinder Liner RC 80', 0, 0, '2015-03-20 07:00:00', '2015-03-20 09:00:00', 'lanjutan'),
('bm2015952', '2015-03-15 18:37:00', 'milling', '', 'Valve Seat Star / Astrea', 0, 0, '2015-03-19 07:00:00', '2015-03-19 11:00:00', 'lanjutan'),
('bm258', '2015-03-15 18:37:00', 'milling', 'b20159182', 'Valve Seat Star / Astrea', 5, 5, '2015-03-18 17:00:00', '2015-03-18 18:00:00', 'utama'),
('bm501', '2015-03-15 18:37:00', 'milling', 'b20151437', 'Cylinder_Liner_FR70', 9, 3, '2015-03-18 07:00:00', '2015-03-18 16:00:00', 'utama'),
('bm951', '2015-03-15 18:37:00', 'milling', 'b20151524', 'Cylinder Liner RC 80', 8, 4, '2015-03-19 11:30:00', '2015-03-19 17:30:00', 'utama'),
('cb930', '2015-03-15 18:37:00', 'bubut', 'c20157843', 'Guide Valve H 90', 2, 1, '2015-03-16 09:00:00', '2015-03-16 11:00:00', 'utama'),
('cc184', '2015-03-15 18:37:00', 'cetak', 'c20157843', 'Guide Valve H 90', 4, 2, '2015-03-15 19:37:00', '2015-03-15 21:37:00', 'utama'),
('cc2015023', '2015-03-15 18:37:00', 'cetak', '', 'Guide Valve H 90', 0, 0, '2015-03-16 07:00:00', '2015-03-16 09:00:00', 'lanjutan'),
('cm063', '2015-03-15 18:37:00', 'milling', 'c20157843', 'Guide Valve H 90', 2, 2, '2015-03-16 11:00:00', '2015-03-16 13:00:00', 'utama');

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
('b20151437', '2015-03-15 18:37:00', 'Cylinder_Liner_FR70', 18, 0, '2015-03-16 16:00:00', '2015-03-18 16:00:00', 'utama'),
('b20151524', '2015-03-15 18:37:00', 'Cylinder Liner RC 80', 20, 0, '2015-03-17 13:00:00', '2015-03-20 09:00:00', 'utama'),
('b20159182', '2015-03-15 18:37:00', 'Valve Seat Star / Astrea', 19, 0, '2015-03-17 08:30:00', '2015-03-19 11:00:00', 'utama'),
('bl20150517', '2015-03-15 18:37:00', 'Bosh Kopling Grand 2', 15, 0, '2015-03-16 09:30:00', '2015-03-17 14:00:00', 'utama'),
('bl20155298', '2015-03-15 18:37:00', 'Bosh Kopling Grand 3', 23, 0, '2015-03-18 07:00:00', '2015-03-21 10:00:00', 'utama'),
('c20157843', '2015-03-15 18:37:00', 'Guide Valve H 90', 8, 0, '2015-03-15 19:37:00', '2015-03-16 13:00:00', 'utama');

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
-- Table structure for table `kapasitas`
--

CREATE TABLE IF NOT EXISTS `kapasitas` (
  `id_mesin` varchar(100) NOT NULL,
  `id_barang` varchar(100) NOT NULL,
  `lot_size` int(11) NOT NULL,
  `waktu_prdksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kapasitas`
--

INSERT INTO `kapasitas` (`id_mesin`, `id_barang`, `lot_size`, `waktu_prdksi`) VALUES
('z028', 'b016', 120, 3),
('z028', 'b419', 60, 1),
('z028', 'b803', 72, 1),
('z028', 'bl073', 72, 2),
('z028', 'bl236', 72, 1),
('z028', 'c536', 120, 2),
('z956', 'b016', 96, 3),
('z956', 'b419', 48, 2),
('z956', 'b803', 60, 2),
('z956', 'bl073', 84, 2),
('z956', 'bl236', 48, 2),
('z956', 'c536', 156, 2),
('z982', 'b016', 60, 2),
('z982', 'b419', 48, 1),
('z982', 'b803', 60, 3),
('z982', 'bl073', 72, 1),
('z982', 'bl236', 48, 3),
('z982', 'c536', 96, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE IF NOT EXISTS `mesin` (
  `id_mesin` varchar(100) NOT NULL,
  `jenis_mesin` varchar(100) NOT NULL,
  `nm_mesin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`id_mesin`, `jenis_mesin`, `nm_mesin`) VALUES
('z028', 'cetak', 'cetak1'),
('z956', 'bubut', 'bubut1'),
('z982', 'milling', 'milling1');

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
('c1503001', 'adi', 'manukan', 'ad@gmail.com', 23, 'adis', ''),
('c1503002', 'rendy', 'kartini', 'rendy@gmail.com', 2147483647, 'rendy', 'http://localhost/ci_bioli/uploads/pelanggan/c0103201520971/nature1.jpg'),
('c5001', 'herry', 'simpang', 'ruinz90@gmail.com', 80821031, 'pelanggan', 'http://localhost/ci_bioli/uploads/pelanggan/c5001/Boston City Flow.jpg');

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
('b15032015097', 'c1503001', 'Valve Seat Star / Astrea', '2015-03-15', '17:40:23', 132, 'dalam_penjadwalan', 'pesan', 'b20159182', '2015-03-19 11:00:00', ''),
('b15032015402', 'c5001', 'Cylinder_Liner_FR70', '2015-03-15', '17:37:24', 96, 'dalam_penjadwalan', 'pesan', 'b20151437', '2015-03-18 16:00:00', ''),
('b15032015637', 'c5001', 'Cylinder Liner RC 80', '2015-03-15', '18:47:31', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b15032015734', 'c1503001', 'Cylinder Liner RC 80', '2015-03-15', '17:40:34', 192, 'dalam_penjadwalan', 'pesan', 'b20151524', '2015-03-20 09:00:00', ''),
('b15032015792', 'c5001', 'Valve Seat Star / Astrea', '2015-03-15', '17:37:45', 84, 'dalam_penjadwalan', 'pesan', 'b20159182', '2015-03-19 11:00:00', ''),
('b15032015805', 'c1503001', 'Cylinder_Liner_FR70', '2015-03-15', '17:40:14', 60, 'dalam_penjadwalan', 'pesan', 'b20151437', '2015-03-18 16:00:00', ''),
('bl15032015057', 'c1503002', 'Bosh Kopling Grand 3', '2015-03-15', '17:41:28', 59, 'dalam_penjadwalan', 'pesan', 'bl20155298', '2015-03-21 10:00:00', ''),
('bl15032015234', 'c5001', 'Bosh Kopling Grand 2', '2015-03-15', '17:37:54', 96, 'dalam_penjadwalan', 'pesan', 'bl20150517', '2015-03-17 14:00:00', ''),
('bl15032015374', 'c5001', 'Bosh Kopling Grand 3', '2015-03-15', '17:38:01', 97, 'dalam_penjadwalan', 'pesan', 'bl20155298', '2015-03-21 10:00:00', ''),
('bl15032015904', 'c1503002', 'Bosh Kopling Grand 2', '2015-03-15', '17:41:20', 120, 'dalam_penjadwalan', 'pesan', 'bl20150517', '2015-03-17 14:00:00', ''),
('c15032015148', 'c5001', 'Guide Valve H 90', '2015-03-15', '17:37:34', 72, 'dalam_penjadwalan', 'pesan', 'c20157843', '2015-03-16 13:00:00', ''),
('c15032015820', 'c1503001', 'Guide Valve H 90', '2015-03-15', '17:40:55', 84, 'dalam_penjadwalan', 'pesan', 'c20157843', '2015-03-16 13:00:00', '');

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
('2015-03-15', 'b016', 0, 'terbaru'),
('2015-03-15', 'b419', 0, 'terbaru'),
('2015-03-15', 'b803', 0, 'terbaru'),
('2015-03-15', 'bl073', 0, 'terbaru'),
('2015-03-15', 'bl236', 0, 'terbaru'),
('2015-03-15', 'c536', 0, 'terbaru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id_brng`);

--
-- Indexes for table `jadwal_mesin`
--
ALTER TABLE `jadwal_mesin`
 ADD PRIMARY KEY (`id_jadwal_mesin`);

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
-- Indexes for table `kapasitas`
--
ALTER TABLE `kapasitas`
 ADD PRIMARY KEY (`id_mesin`,`id_barang`);

--
-- Indexes for table `mesin`
--
ALTER TABLE `mesin`
 ADD PRIMARY KEY (`id_mesin`);

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
