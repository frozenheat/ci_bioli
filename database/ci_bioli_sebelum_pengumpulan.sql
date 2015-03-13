-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2015 at 06:12 PM
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
('bb2015594', '2015-03-13 01:15:00', 'bubut', '', 'Cylinder_Liner_FR70', 0, 0, '2015-03-14 07:00:00', '2015-03-14 11:00:00', 'lanjutan'),
('bb2015635', '2015-03-13 01:15:00', 'bubut', '', 'Valve Seat Star / Astrea', 0, 0, '2015-03-15 07:00:00', '2015-03-15 11:00:00', 'lanjutan'),
('bb213', '2015-03-13 01:15:00', 'bubut', 'b20158103', 'Cylinder_Liner_FR70', 6, 3, '2015-03-13 17:15:00', '2015-03-13 19:15:00', 'utama'),
('bb357', '2015-03-13 01:15:00', 'bubut', 'b20155487', 'Cylinder Liner RC 80', 6, 2, '2015-03-15 11:30:00', '2015-03-15 17:30:00', 'utama'),
('bb509', '2015-03-13 01:15:00', 'bubut', 'b20158652', 'Valve Seat Star / Astrea', 10, 5, '2015-03-14 11:30:00', '2015-03-14 17:30:00', 'utama'),
('bc170', '2015-03-13 01:15:00', 'cetak', 'b20155487', 'Cylinder Liner RC 80', 6, 2, '2015-03-14 08:30:00', '2015-03-14 14:30:00', 'utama'),
('bc2015146', '2015-03-13 01:15:00', 'cetak', '', 'Valve Seat Star / Astrea', 0, 0, '2015-03-14 07:00:00', '2015-03-14 08:00:00', 'lanjutan'),
('bc231', '2015-03-13 01:15:00', 'cetak', 'b20158652', 'Valve Seat Star / Astrea', 4, 4, '2015-03-13 14:45:00', '2015-03-13 17:45:00', 'utama'),
('bc418', '2015-03-13 01:15:00', 'cetak', 'b20158103', 'Cylinder_Liner_FR70', 3, 3, '2015-03-13 11:15:00', '2015-03-13 14:15:00', 'utama'),
('bl2015106', '2015-03-13 01:15:00', 'milling', '', 'Bosh Kopling Grand 3', 0, 0, '2015-03-17 07:00:00', '2015-03-17 16:00:00', 'lanjutan'),
('bl2015932', '2015-03-13 01:15:00', 'milling', '', 'Bosh Kopling Grand 2', 0, 0, '2015-03-14 07:00:00', '2015-03-14 09:00:00', 'lanjutan'),
('blb267', '2015-03-13 01:15:00', 'bubut', 'bl20159012', 'Bosh Kopling Grand 3', 8, 4, '2015-03-16 07:00:00', '2015-03-16 15:00:00', 'utama'),
('blb581', '2015-03-13 01:15:00', 'bubut', 'bl20155109', 'Bosh Kopling Grand 2', 6, 3, '2015-03-13 10:45:00', '2015-03-13 16:45:00', 'utama'),
('blc384', '2015-03-13 01:15:00', 'cetak', 'bl20155109', 'Bosh Kopling Grand 2', 6, 3, '2015-03-13 04:45:00', '2015-03-13 10:45:00', 'utama'),
('blc915', '2015-03-13 01:15:00', 'cetak', 'bl20159012', 'Bosh Kopling Grand 3', 3, 3, '2015-03-14 15:00:00', '2015-03-14 18:00:00', 'utama'),
('blm560', '2015-03-13 01:15:00', 'milling', 'bl20155109', 'Bosh Kopling Grand 2', 3, 3, '2015-03-13 16:45:00', '2015-03-13 17:45:00', 'utama'),
('blm914', '2015-03-13 01:15:00', 'milling', 'bl20159012', 'Bosh Kopling Grand 3', 12, 4, '2015-03-16 15:00:00', '2015-03-16 18:00:00', 'utama'),
('bm403', '2015-03-13 01:15:00', 'milling', 'b20158652', 'Valve Seat Star / Astrea', 5, 5, '2015-03-15 11:00:00', '2015-03-15 16:00:00', 'utama'),
('bm476', '2015-03-13 01:15:00', 'milling', 'b20155487', 'Cylinder Liner RC 80', 8, 4, '2015-03-16 07:00:00', '2015-03-16 15:00:00', 'utama'),
('bm493', '2015-03-13 01:15:00', 'milling', 'b20158103', 'Cylinder_Liner_FR70', 9, 3, '2015-03-14 11:00:00', '2015-03-14 20:00:00', 'utama'),
('cb647', '2015-03-13 01:15:00', 'bubut', 'c20150236', 'Guide Valve H 90', 2, 1, '2015-03-13 04:15:00', '2015-03-13 06:15:00', 'utama'),
('cc517', '2015-03-13 01:15:00', 'cetak', 'c20150236', 'Guide Valve H 90', 2, 1, '2015-03-13 02:15:00', '2015-03-13 04:15:00', 'utama'),
('cm064', '2015-03-13 01:15:00', 'milling', 'c20150236', 'Guide Valve H 90', 1, 1, '2015-03-13 06:15:00', '2015-03-13 07:15:00', 'utama');

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
('b20155487', '2015-03-13 01:15:00', 'Cylinder Liner RC 80', 20, 0, '2015-03-14 08:30:00', '2015-03-16 15:00:00', 'utama'),
('b20158103', '2015-03-13 01:15:00', 'Cylinder_Liner_FR70', 18, 0, '2015-03-13 11:15:00', '2015-03-14 20:00:00', 'utama'),
('b20158652', '2015-03-13 01:15:00', 'Valve Seat Star / Astrea', 19, 0, '2015-03-13 14:45:00', '2015-03-15 16:00:00', 'utama'),
('bl20155109', '2015-03-13 01:15:00', 'Bosh Kopling Grand 2', 15, 0, '2015-03-13 04:45:00', '2015-03-14 09:00:00', 'utama'),
('bl20159012', '2015-03-13 01:15:00', 'Bosh Kopling Grand 3', 23, 0, '2015-03-14 15:00:00', '2015-03-17 16:00:00', 'utama'),
('c20150236', '2015-03-13 01:15:00', 'Guide Valve H 90', 5, 0, '2015-03-13 02:15:00', '2015-03-13 07:15:00', 'utama');

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
('z265', 'milling1', '3'),
('z397', 'cetak1', '1'),
('z827', 'bubut1', '2');

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
('b13032015210', 'c1503001', 'Valve Seat Star / Astrea', '2015-03-13', '01:06:59', 132, 'dalam_penjadwalan', 'pesan', 'b20158652', '2015-03-15 16:00:00', ''),
('b13032015358', 'c1503001', 'Cylinder Liner RC 80', '2015-03-13', '01:07:06', 192, 'dalam_penjadwalan', 'pesan', 'b20155487', '2015-03-16 15:00:00', ''),
('b13032015916', 'c1503001', 'Cylinder_Liner_FR70', '2015-03-13', '01:06:51', 60, 'dalam_penjadwalan', 'pesan', 'b20158103', '2015-03-14 20:00:00', ''),
('b13032015940', 'c5001', 'Valve Seat Star / Astrea', '2015-03-13', '01:05:27', 84, 'dalam_penjadwalan', 'pesan', 'b20158652', '2015-03-15 16:00:00', ''),
('b13032015951', 'c5001', 'Cylinder_Liner_FR70', '2015-03-13', '01:05:13', 96, 'dalam_penjadwalan', 'pesan', 'b20158103', '2015-03-14 20:00:00', ''),
('bl13032015039', 'c5001', 'Bosh Kopling Grand 2', '2015-03-13', '01:06:12', 96, 'dalam_penjadwalan', 'pesan', 'bl20155109', '2015-03-14 09:00:00', ''),
('bl13032015529', 'c5001', 'Bosh Kopling Grand 3', '2015-03-13', '01:06:18', 97, 'dalam_penjadwalan', 'pesan', 'bl20159012', '2015-03-17 16:00:00', ''),
('bl13032015560', 'c1503002', 'Bosh Kopling Grand 2', '2015-03-13', '01:07:42', 120, 'dalam_penjadwalan', 'pesan', 'bl20155109', '2015-03-14 09:00:00', ''),
('bl13032015928', 'c1503002', 'Bosh Kopling Grand 3', '2015-03-13', '01:07:47', 59, 'dalam_penjadwalan', 'pesan', 'bl20159012', '2015-03-17 16:00:00', ''),
('c13032015128', 'c1503001', 'Guide Valve H 90', '2015-03-13', '01:07:13', 84, 'dalam_penjadwalan', 'pesan', 'c20150236', '2015-03-13 07:15:00', '');

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
('2015-03-13', 'b016', 0, 'terbaru'),
('2015-03-13', 'b419', 0, 'terbaru'),
('2015-03-13', 'b803', 0, 'terbaru'),
('2015-03-13', 'bl073', 0, 'terbaru'),
('2015-03-13', 'bl236', 0, 'terbaru'),
('2015-03-13', 'c536', 0, 'terbaru');

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
