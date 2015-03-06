-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2015 at 05:49 PM
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
('b725', 'Cylinder Liner FR70', 'Boring', 70, 60, 50, 50, 40, 120),
('b864', 'Grand 2', 'Boring', 200, 200, 200, 140, 180, 110),
('b945', 'Guide Valve C700', 'Boring', 100, 120, 90, 180, 80, 80),
('c719', 'Valve seat grand / prima', 'Cincin_Setting', 150, 120, 110, 45, 50, 90);

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
  `waktu_mulai` datetime NOT NULL,
  `waktu_selesai` datetime NOT NULL,
  `status_jadwal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('b20150418', '2015-03-05 23:47:00', 'Cylinder Liner FR70', 26, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sementara'),
('b20150726', '2015-03-05 19:26:00', 'Cylinder Liner FR70', 26, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sementara'),
('b20153960', '2015-03-05 23:48:00', 'Cylinder Liner FR70', 26, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sementara'),
('b20156710', '2015-03-05 22:21:00', 'Cylinder Liner FR70', 26, 0, '2015-03-05 23:21:00', '0000-00-00 00:00:00', 'sementara'),
('b20158259', '2015-03-05 19:34:00', 'Cylinder Liner FR70', 26, 0, '2015-03-05 20:34:00', '0000-00-00 00:00:00', 'sementara'),
('b20159130', '2015-03-05 19:34:00', 'Cylinder Liner FR70', 26, 0, '2015-03-06 07:00:00', '0000-00-00 00:00:00', 'sementara'),
('b20159856', '2015-03-05 23:46:00', 'Cylinder Liner FR70', 26, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sementara');

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
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`id_mesin`, `jenis_mesin`, `urutan`) VALUES
('z265', 'milling', 3),
('z397', 'cetak', 1),
('z827', 'bubut', 2);

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
('b0503201503684', 'c5001', 'Guide Valve C700', '2015-03-05', '16:34:47', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b0503201526453', 'c0826459', 'Grand 2', '2015-03-05', '16:35:06', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b0503201567812', 'c5001', 'Cylinder Liner FR70', '2015-03-05', '16:34:34', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b0503201568270', 'c0826459', 'Guide Valve C700', '2015-03-05', '16:35:10', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b0503201581597', 'c5001', 'Grand 2', '2015-03-05', '16:34:43', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('b0503201598650', 'c0826459', 'Cylinder Liner FR70', '2015-03-05', '16:35:02', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('c0503201507861', 'c5001', 'Valve seat grand / prima', '2015-03-05', '16:34:50', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', ''),
('c0503201526917', 'c0826459', 'Valve seat grand / prima', '2015-03-05', '16:35:14', 200, 'belum_diproses', 'belum_konfirmasi', '', '0000-00-00 00:00:00', '');

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
('2015-03-05', 'b725', 0, 'terbaru'),
('2015-03-05', 'b864', 0, 'terbaru'),
('2015-03-05', 'b945', 0, 'terbaru'),
('2015-03-05', 'c719', 0, 'terbaru');

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
