-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2017 at 09:24 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tar`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_master_administrasi`
--

CREATE TABLE `dokumen_master_administrasi` (
  `ID_DOKUMEN_MASTER` int(11) NOT NULL,
  `NAMA_DOKUMEN` text,
  `FILE_DOKUMEN` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen_master_administrasi`
--

INSERT INTO `dokumen_master_administrasi` (`ID_DOKUMEN_MASTER`, `NAMA_DOKUMEN`, `FILE_DOKUMEN`) VALUES
(1, 'NPWP', 'NPWP.PDF'),
(2, 'SIUP', 'SIUP.PDF');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_tender`
--

CREATE TABLE `dokumen_tender` (
  `ID_DOKUMEN` int(11) NOT NULL,
  `ID_TENDER` int(11) DEFAULT NULL,
  `NAMA_DOKUMEN` text,
  `FILE_DOKUMEN` text,
  `TGL_UPLOAD` char(10) DEFAULT NULL,
  `PENGUPLOAD` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `by_user` int(11) DEFAULT NULL,
  `for_user` int(11) DEFAULT NULL,
  `tentang` text,
  `waktu` datetime DEFAULT NULL,
  `meta` text,
  `status` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `by_user`, `for_user`, `tentang`, `waktu`, `meta`, `status`) VALUES
(4, 3, 1, 'Telah Menambah Berita Tender Baru \"asdasdada\"', '2017-03-31 00:00:00', '/project/tar/berita-tender/detail/7', NULL),
(5, 3, 2, 'Telah Menambah Berita Tender Baru \"asdasdada\"', '2017-03-31 00:00:00', '/project/tar/berita-tender/detail/7', NULL),
(6, 3, 3, 'Telah Menambah Berita Tender Baru \"asdasdada\"', '2017-03-31 00:00:00', '/project/tar/berita-tender/detail/7', NULL),
(7, 3, 4, 'Telah Menambah Berita Tender Baru \"asdasdada\"', '2017-03-31 00:00:00', '/project/tar/berita-tender/detail/7', NULL),
(8, 1, 3, 'Telah Menambah Berita Tender Baru \"PEMBORONGAN , PENCATATAN, PENGGANDAAN, PENDISTRIBUSIAN, dan PENGARSIPAN SURAT dan DOKUMEN pada KANTOR INDUK PT PLN (PERSERO) KITSBU\"', '2017-03-29 20:08:37', '/project/tar/berita-tender/detail/6', NULL),
(9, 1, 2, 'Telah Menambah Berita Tender Baru \"PEMBORONGAN , PENCATATAN, PENGGANDAAN, PENDISTRIBUSIAN, dan PENGARSIPAN SURAT dan DOKUMEN pada KANTOR INDUK PT PLN (PERSERO) KITSBU\"', '2017-03-29 20:08:37', '/project/tar/berita-tender/detail/6', NULL),
(10, 1, 4, 'Telah Menambah Berita Tender Baru \"PEMBORONGAN , PENCATATAN, PENGGANDAAN, PENDISTRIBUSIAN, dan PENGARSIPAN SURAT dan DOKUMEN pada KANTOR INDUK PT PLN (PERSERO) KITSBU\"', '2017-03-29 20:08:37', '/project/tar/berita-tender/detail/6', NULL),
(14, 2, 1, 'Telah Melakukan Approve Berita Tender \"dasdadsasdad\"', '2017-04-01 16:44:01', '/project/tar/berita-tender/detail/2', NULL),
(15, 2, 3, 'Telah Melakukan Approve Berita Tender \"dasdadsasdad\"', '2017-04-01 16:44:01', '/project/tar/berita-tender/detail/2', NULL),
(16, 2, 4, 'Telah Melakukan Approve Berita Tender \"dasdadsasdad\"', '2017-04-01 16:44:01', '/project/tar/berita-tender/detail/2', NULL),
(17, 3, 1, 'Telah Melakukan Approve Berita Tender \"dasdadsasdad\"', '2017-04-02 06:23:14', '/project/tar/berita-tender/detail/2', NULL),
(18, 3, 2, 'Telah Melakukan Approve Berita Tender \"dasdadsasdad\"', '2017-04-02 06:23:14', '/project/tar/berita-tender/detail/2', NULL),
(19, 3, 4, 'Telah Melakukan Approve Berita Tender \"dasdadsasdad\"', '2017-04-02 06:23:14', '/project/tar/berita-tender/detail/2', NULL),
(20, 3, 1, 'Telah Melakukan Approve Berita Tender \"asdasdada\"', '2017-04-02 06:25:02', '/project/tar/berita-tender/detail/7', NULL),
(21, 3, 2, 'Telah Melakukan Approve Berita Tender \"asdasdada\"', '2017-04-02 06:25:02', '/project/tar/berita-tender/detail/7', NULL),
(22, 3, 4, 'Telah Melakukan Approve Berita Tender \"asdasdada\"', '2017-04-02 06:25:02', '/project/tar/berita-tender/detail/7', NULL),
(23, 2, 1, 'Telah Menambahkan Dokumen RKS ke  \"dasdadsasdad\"', '2017-04-12 12:40:20', '/TAR/acara-rks/rks/detail/2', NULL),
(24, 2, 3, 'Telah Menambahkan Dokumen RKS ke  \"dasdadsasdad\"', '2017-04-12 12:40:20', '/TAR/acara-rks/rks/detail/2', NULL),
(25, 2, 4, 'Telah Menambahkan Dokumen RKS ke  \"dasdadsasdad\"', '2017-04-12 12:40:20', '/TAR/acara-rks/rks/detail/2', NULL),
(26, 2, 1, 'Telah Menambahkan Dokumen RKS ke  \"adsadasd\"', '2017-04-12 12:42:05', '/TAR/acara-rks/rks/detail/1', NULL),
(27, 2, 3, 'Telah Menambahkan Dokumen RKS ke  \"adsadasd\"', '2017-04-12 12:42:05', '/TAR/acara-rks/rks/detail/1', NULL),
(28, 2, 4, 'Telah Menambahkan Dokumen RKS ke  \"adsadasd\"', '2017-04-12 12:42:05', '/TAR/acara-rks/rks/detail/1', NULL),
(29, 3, 1, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:46:47', '/TAR/berita-tender/detail/2', NULL),
(30, 3, 2, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:46:47', '/TAR/berita-tender/detail/2', NULL),
(31, 3, 4, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:46:47', '/TAR/berita-tender/detail/2', NULL),
(32, 3, 1, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:47:43', '/TAR/berita-tender/detail/2', NULL),
(33, 3, 2, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:47:43', '/TAR/berita-tender/detail/2', NULL),
(34, 3, 4, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:47:43', '/TAR/berita-tender/detail/2', NULL),
(35, 3, 1, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:48:33', '/TAR/berita-tender/detail/2', NULL),
(36, 3, 2, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:48:33', '/TAR/berita-tender/detail/2', NULL),
(37, 3, 4, 'Telah Melakukan Approve Dokumen RKS dari Berita Tender \"dasdadsasdad\"', '2017-04-12 12:48:33', '/TAR/berita-tender/detail/2', NULL),
(38, 3, 1, 'Telah Menambahkan Dokumen Berita Acara ke  \"dasdadsasdad\"', '2017-04-12 13:42:50', '/TAR/acara-rks/acara/detail/2', NULL),
(39, 3, 2, 'Telah Menambahkan Dokumen Berita Acara ke  \"dasdadsasdad\"', '2017-04-12 13:42:50', '/TAR/acara-rks/acara/detail/2', NULL),
(40, 3, 4, 'Telah Menambahkan Dokumen Berita Acara ke  \"dasdadsasdad\"', '2017-04-12 13:42:50', '/TAR/acara-rks/acara/detail/2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penawaran`
--

CREATE TABLE `penawaran` (
  `ID_PENAWARAN` int(11) NOT NULL,
  `ID_TENDER` int(11) DEFAULT NULL,
  `NAMA_VENDOR` text,
  `NAMA_BARANG` text,
  `HARGA_PERSATUAN` float DEFAULT NULL,
  `VOLUME_BARANG` float DEFAULT NULL,
  `UKURAN_SATUAN` text,
  `NOTIFIKASI` longtext,
  `DIREKTUR_APPROVAL` int(11) DEFAULT NULL,
  `MANAJER_APPROVAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggara`
--

CREATE TABLE `penyelenggara` (
  `ID_PENYELENGGARA` int(11) NOT NULL,
  `NAMA_PENYELENGGARA` text,
  `ALAMAT` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyelenggara`
--

INSERT INTO `penyelenggara` (`ID_PENYELENGGARA`, `NAMA_PENYELENGGARA`, `ALAMAT`) VALUES
(4, 'PT. PLN Persero', 'Jauh'),
(5, 'PT INDONESIA POWER', 'dsadadsads'),
(7, 'PT. PJB PLN Persero', 'Jauh Juga');

-- --------------------------------------------------------

--
-- Table structure for table `tender`
--

CREATE TABLE `tender` (
  `ID_TENDER` int(11) NOT NULL,
  `ID_PENYELENGGARA` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `JUDUL_TENDER` text,
  `LINK_WEBSITE` text,
  `WILAYAH` text,
  `UPLOAD` text,
  `TGL_MULAI` datetime DEFAULT NULL,
  `TGL_SELESAI` datetime DEFAULT NULL,
  `TGL_UPLOAD` datetime DEFAULT NULL,
  `MANAJER_APPROVAL` text,
  `DIREKTUR_APPROVAL` text,
  `RKS` text,
  `BERITA_ACARA` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender`
--

INSERT INTO `tender` (`ID_TENDER`, `ID_PENYELENGGARA`, `ID_USER`, `JUDUL_TENDER`, `LINK_WEBSITE`, `WILAYAH`, `UPLOAD`, `TGL_MULAI`, `TGL_SELESAI`, `TGL_UPLOAD`, `MANAJER_APPROVAL`, `DIREKTUR_APPROVAL`, `RKS`, `BERITA_ACARA`) VALUES
(1, 4, 1, 'adsadasd', 'sadada', 'asdad', 'NPWP|SIUP', '2017-03-27 00:00:00', '2017-03-27 00:00:00', '2017-03-05 05:31:51', '{\r\n	\"status\":\"diterima\",\r\n	\"waktu\":\"2017-04-05 05:31:51\"\r\n}', '{\"status\":\"diterima\",\"waktu\":\"2017-04-01 16:27:48\"}', '{\"file\":\"surat balasan_0002_1491975725.pdf\",\"time\":\"2017-04-12 12:42:05\",\"who\":\"2\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}}', NULL),
(2, 4, 1, 'dasdadsasdad', 'sadada', 'asdad', 'NPWP|SIUP', '2017-03-27 00:00:00', '2017-03-27 00:00:00', '2017-03-27 19:20:11', '{\"status\":\"diterima\",\"waktu\":\"2017-04-02 06:23:14\"}', '{\"status\":\"diterima\",\"waktu\":\"2017-04-01 16:44:01\"}', '{\"file\":\"surat balasan_0002_1491975619.pdf\",\"time\":\"2017-04-12 12:40:19\",\"who\":\"2\",\"approval\":{\"direktur\":{\"status\":\"diterima\",\"waktur\":\"2017-04-12 12:47:43\"},\"manajer\":{\"status\":\"diterima\",\"waktur\":\"2017-04-12 12:48:33\"}}}', '{\"file\":\"surat balasan_0002_1491979370.pdf\",\"time\":\"2017-04-12 13:42:50\",\"who\":\"3\"}'),
(3, 4, 1, 'dasdadsasdad', 'sadada', 'asdad', 'NPWP|SIUP', '2017-03-27 00:00:00', '2017-03-27 00:00:00', '2017-03-27 19:20:30', NULL, NULL, NULL, NULL),
(4, 4, 1, 'dasdadsasdad', 'sadada', 'asdad', 'NPWP|SIUP', '2017-03-27 00:00:00', '2017-03-27 00:00:00', '2017-03-27 19:21:17', NULL, NULL, NULL, NULL),
(5, 4, 1, 'Pengadaan Barang Material dan Accessories Gardu', 'http://eproc.pln.co.id/portal/home;jsessionid=BQYaKDaZ2VR9x1vzeGIcBGHNHzxj4LcenmEVYdOCRVMZeUBMkXYX!2078370565', 'AREA JAMBI', 'NPWP|SIUP|Sertifikat Badan Usaha|Landasan Hukum Pendirian Perusahaan|Bukti pelunasan kewajiban pajak Tahun terakhir (SPT/PPh)|Tanda Daftar Perusahaan (TDP)|Penetapan Pengusaha Kena Pajak (PKP)|Detail Keuangan:Referensi Bank|Type Test LMK|Certifikate of Origin (COO)|TKDN yang dikeluarkan oleh Menperin|Surat Dukungan yang berasal dari Pabrik', '2017-04-14 00:00:00', '2017-04-05 00:00:00', '2017-03-29 20:07:10', NULL, NULL, NULL, NULL),
(6, 5, 1, 'PEMBORONGAN , PENCATATAN, PENGGANDAAN, PENDISTRIBUSIAN, dan PENGARSIPAN SURAT dan DOKUMEN pada KANTOR INDUK PT PLN (PERSERO) KITSBU', 'http://localhost/project/Tugasahkir/pages/admin/', 'PEMBANGKITAN SUMATERA BAGIAN UTARA', 'NPWP|SIUP|Ijin Hukum|bank Garansi', '2017-04-10 00:00:00', '2017-07-27 00:00:00', '2017-03-29 20:08:37', NULL, NULL, NULL, NULL),
(7, 7, 3, 'asdasdada', 'adasdasd', 'asdasda', 'NPWP|SIUP', '2017-03-31 00:00:00', '2017-03-10 00:00:00', '2017-03-31 06:07:59', '{\"status\":\"diterima\",\"waktu\":\"2017-04-02 06:25:01\"}', '{\r\n	\"status\":\"ditolak\",\r\n	\"waktu\":\"2017-03-05 05:31:51\"\r\n}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `ID_UNITKERJA` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_TENDER` int(11) DEFAULT NULL,
  `ID_PENAWARAN` int(11) DEFAULT NULL,
  `PENUGASAN` text,
  `MANAJER_APPROVAL` int(11) DEFAULT NULL,
  `DIREKTUR_APPROVAL` int(11) DEFAULT NULL,
  `NOTIFIKASI` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `NAMA` text,
  `ALAMAT` text,
  `TANGGAL_LAHIR` datetime DEFAULT NULL,
  `EMAIL` text,
  `TELEFON` text,
  `JABATAN` text,
  `PREVILEDGE` int(11) DEFAULT '0',
  `IMAGE` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `ALAMAT`, `TANGGAL_LAHIR`, `EMAIL`, `TELEFON`, `JABATAN`, `PREVILEDGE`, `IMAGE`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Saya Admin', 'jauh', '2017-03-01 00:00:00', 'ryanhadiw@gmail.com', '082140177480', 'Administrasi', 1, 'avatar.png'),
(2, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 'Saya Direktur', 'Jauh', '2017-03-22 00:00:00', 'direktur@gmail.com', '081515548148', 'Direktur', 2, 'avatar3.png'),
(3, 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'Saya Manager', 'jauh', '2014-11-22 00:00:00', 'manager@gmail.com', '085649411233', 'Manajer', 3, 'avatar2.png'),
(4, 'unitkerja', 'c7751a072df5820a90a679d0fa4bcbe7', 'Saya Unit Kerja', 'jauh', '2014-11-22 00:00:00', 'unitkerja@gmail.com', '085649411233', 'Unit Kerja', 4, 'avatar1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_master_administrasi`
--
ALTER TABLE `dokumen_master_administrasi`
  ADD PRIMARY KEY (`ID_DOKUMEN_MASTER`);

--
-- Indexes for table `dokumen_tender`
--
ALTER TABLE `dokumen_tender`
  ADD PRIMARY KEY (`ID_DOKUMEN`),
  ADD KEY `FK_REFERENCE_3` (`ID_TENDER`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `penawaran`
--
ALTER TABLE `penawaran`
  ADD PRIMARY KEY (`ID_PENAWARAN`),
  ADD KEY `FK_REFERENCE_4` (`ID_TENDER`);

--
-- Indexes for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  ADD PRIMARY KEY (`ID_PENYELENGGARA`);

--
-- Indexes for table `tender`
--
ALTER TABLE `tender`
  ADD PRIMARY KEY (`ID_TENDER`),
  ADD KEY `FK_REFERENCE_2` (`ID_PENYELENGGARA`),
  ADD KEY `FK_REFERENCE_6` (`ID_USER`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`ID_UNITKERJA`),
  ADD KEY `FK_REFERENCE_1` (`ID_TENDER`),
  ADD KEY `FK_REFERENCE_7` (`ID_USER`),
  ADD KEY `FK_RELATIONSHIP_7` (`ID_PENAWARAN`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_master_administrasi`
--
ALTER TABLE `dokumen_master_administrasi`
  MODIFY `ID_DOKUMEN_MASTER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dokumen_tender`
--
ALTER TABLE `dokumen_tender`
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `ID_PENAWARAN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `ID_PENYELENGGARA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tender`
--
ALTER TABLE `tender`
  MODIFY `ID_TENDER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `ID_UNITKERJA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumen_tender`
--
ALTER TABLE `dokumen_tender`
  ADD CONSTRAINT `FK_REFERENCE_3` FOREIGN KEY (`ID_TENDER`) REFERENCES `tender` (`ID_TENDER`);

--
-- Constraints for table `penawaran`
--
ALTER TABLE `penawaran`
  ADD CONSTRAINT `FK_REFERENCE_4` FOREIGN KEY (`ID_TENDER`) REFERENCES `tender` (`ID_TENDER`);

--
-- Constraints for table `tender`
--
ALTER TABLE `tender`
  ADD CONSTRAINT `FK_REFERENCE_2` FOREIGN KEY (`ID_PENYELENGGARA`) REFERENCES `penyelenggara` (`ID_PENYELENGGARA`),
  ADD CONSTRAINT `FK_REFERENCE_6` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD CONSTRAINT `FK_REFERENCE_1` FOREIGN KEY (`ID_TENDER`) REFERENCES `tender` (`ID_TENDER`),
  ADD CONSTRAINT `FK_REFERENCE_7` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`ID_PENAWARAN`) REFERENCES `penawaran` (`ID_PENAWARAN`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
