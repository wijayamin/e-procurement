-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2017 at 04:16 PM
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
  `TGL_UPLOAD` datetime DEFAULT NULL,
  `PENGUPLOAD` char(10) DEFAULT NULL,
  `DOKUMEN_SYARAT` int(11) DEFAULT '0',
  `APPROVAL` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen_tender`
--

INSERT INTO `dokumen_tender` (`ID_DOKUMEN`, `ID_TENDER`, `NAMA_DOKUMEN`, `FILE_DOKUMEN`, `TGL_UPLOAD`, `PENGUPLOAD`, `DOKUMEN_SYARAT`, `APPROVAL`) VALUES
(43, 11, 'NPWP Perusahaan', 'PENDAFTARAN_1497813877.pdf', '2017-06-19 00:00:00', '3', 1, '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:32:29\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-19 03:15:15\"}}'),
(44, 11, 'Sertifikat Badan Usaha (SBU)', 'tellabsmod-tl-stu-160_1497940635.pdf', '2017-06-20 13:37:15', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}'),
(45, 11, 'Pakta Integritas', NULL, NULL, NULL, 1, NULL),
(46, 11, 'Sertifikat Badan Usaha Jasa Konstruksi (SBUJK)', NULL, NULL, NULL, 1, NULL),
(47, 11, 'Surat keterangan dukungan keuangan dari Bank', NULL, NULL, NULL, 1, NULL),
(48, 11, 'Surat Izin Tempat Usaha (SITU)/Izin Gangguan/ Keterangan Domisili.', NULL, NULL, NULL, 1, NULL),
(49, 11, 'Direksi/Pengurus yang bertindak untuk dan atas nama perusahaan tidak masuk dalam daftar penyedia Barang/Jasa yang terkena daftar hitam (blacklist)', NULL, NULL, NULL, 1, NULL),
(50, 11, 'Surat pernyataan bersedia jika pelelangan batal', NULL, NULL, NULL, 1, NULL),
(51, 11, 'Tanda Daftar Perusahaan (TDP)', NULL, NULL, NULL, 1, NULL),
(52, 11, 'Pengusaha Kena Pajak (PKP)', NULL, NULL, NULL, 1, NULL),
(53, 11, 'Surat Ijin Usaha Jasa Penunjang Tenaga Listrik (SIUJPTL)', NULL, NULL, NULL, 1, NULL),
(54, 11, 'Penetapan Pengusaha Kena Pajak (PKP)', NULL, NULL, NULL, 1, NULL),
(55, 11, 'Sertifikat Badan Usaha Jasa Penunjang Tenaga Listrik (SBUJPTL)', NULL, NULL, NULL, 1, NULL),
(56, 11, 'Surat Ijin Usaha Perdagangan (SIUP)', NULL, NULL, NULL, 1, NULL),
(57, 11, 'Surat Ijin Usaha Jasa Konstruksi (SIUJK)', NULL, NULL, NULL, 1, NULL),
(58, 11, 'Sertifikat Keterampilan', NULL, NULL, NULL, 1, NULL),
(59, 11, 'Formulir Isian Dokumen Kualifikasi', NULL, NULL, NULL, 1, NULL),
(60, 11, 'Surat Dukungan Bank', NULL, NULL, NULL, 1, NULL),
(61, 11, 'Laporan Keuangan Perusahaan', NULL, NULL, NULL, 1, NULL),
(62, 11, 'Data Pengalaman Perusahaan', NULL, NULL, NULL, 1, NULL),
(63, 11, 'Type Test LMK', NULL, NULL, NULL, 1, NULL),
(64, 11, 'Type Test Independen', NULL, NULL, NULL, 1, NULL),
(65, 11, 'Copy Sertifikat SPM', NULL, NULL, NULL, 1, NULL),
(66, 11, 'Sertifikat Keahlian (SKA)', NULL, NULL, NULL, 1, NULL),
(67, 11, 'Metode Pelaksanaan Pekerjaan', NULL, NULL, NULL, 1, NULL),
(68, 11, 'Surat Dukungan yang berasal dari Pabrik', NULL, NULL, NULL, 1, NULL),
(69, 11, 'Surat Ijin Usaha Jasa Konstruksi (SIUJK)', NULL, NULL, NULL, 1, NULL),
(70, 11, 'ISO 9001 Tahun 2008', NULL, NULL, NULL, 1, NULL),
(71, 12, 'Sertifikat Badan Usaha (SBU) ', 'PENDAFTARAN_1497911156.pdf', '2017-06-20 05:25:56', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}'),
(73, 11, 'lala', 'PENDAFTARAN_1497814091.pdf', '2017-06-19 00:00:00', '5', 0, '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:32:33\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-19 03:20:01\"}}'),
(74, 12, 'asdasdasd', NULL, '2017-07-10 00:22:10', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}'),
(75, 12, 'lalalala', 'MAX6958-MAX6959_1499623737.pdf', '2017-07-10 01:08:57', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(255) NOT NULL,
  `id_tender` int(255) DEFAULT NULL,
  `id_user` int(255) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `perubahan` text,
  `id_perubahan` int(11) DEFAULT NULL,
  `meta` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `id_tender`, `id_user`, `waktu`, `perubahan`, `id_perubahan`, `meta`) VALUES
(2, 12, 3, '2017-07-11 20:13:50', 'u_tender', 12, NULL),
(3, 12, 3, '2017-07-11 20:28:20', 'u_tender', 12, NULL);

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
(1, 3, 4, 'Anda telah dipilih menjadi unitkerja <mark>Dokumen Tender</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-06-19 01:38:10', '/TAR/tender/detail/11', NULL),
(2, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>Dokumen Tender</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-06-19 01:38:10', '/TAR/tender/detail/11', NULL),
(3, 3, 6, 'Anda telah dipilih menjadi unitkerja <mark>Dokumen Tender</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-06-19 01:38:11', '/TAR/tender/detail/11', NULL),
(4, 3, 1, 'Menambahkan berita tender baru: \"aasdad\"', '2017-06-20 14:32:24', '/TAR/tender/detail/13', NULL),
(5, 3, 2, 'Menambahkan berita tender baru: \"aasdad\"', '2017-06-20 14:32:24', '/TAR/tender/detail/13', NULL),
(6, 3, 3, 'Menambahkan berita tender baru: \"aasdad\"', '2017-06-20 14:32:24', '/TAR/tender/detail/13', NULL),
(7, 3, 1, 'Menambahkan berita tender baru: \"aasdad\"', '2017-06-20 14:33:16', '/TAR/tender/detail/14', NULL),
(8, 3, 2, 'Menambahkan berita tender baru: \"aasdad\"', '2017-06-20 14:33:16', '/TAR/tender/detail/14', NULL),
(9, 3, 3, 'Menambahkan berita tender baru: \"aasdad\"', '2017-06-20 14:33:16', '/TAR/tender/detail/14', NULL),
(10, 3, 1, 'Menambahkan berita tender baru: \"adasda\"', '2017-06-20 14:34:21', '/TAR/tender/detail/15', NULL),
(11, 3, 2, 'Menambahkan berita tender baru: \"adasda\"', '2017-06-20 14:34:21', '/TAR/tender/detail/15', NULL),
(12, 3, 3, 'Menambahkan berita tender baru: \"adasda\"', '2017-06-20 14:34:21', '/TAR/tender/detail/15', NULL),
(13, 3, 4, 'Anda telah dipilih menjadi unitkerja <mark>Keuangan</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-07 15:29:15', '/TAR/tender/detail/11', NULL),
(14, 3, 4, 'Anda telah dipilih menjadi unitkerja <mark>dsadsda</mark> pada tender \"xxxxxxxxxxxsyam\"', '2017-07-11 19:31:48', '/TAR/tender/detail/12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penawaran`
--

CREATE TABLE `penawaran` (
  `ID_PENAWARAN` int(11) NOT NULL,
  `ID_TENDER` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `NAMA_VENDOR` text,
  `NAMA_BARANG` text,
  `HARGA_PERSATUAN` float DEFAULT NULL,
  `VOLUME_BARANG` float DEFAULT NULL,
  `UKURAN_SATUAN` text,
  `WAKTU` datetime DEFAULT NULL,
  `APPROVAL` text,
  `INPUTAN_MANAJER` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penawaran`
--

INSERT INTO `penawaran` (`ID_PENAWARAN`, `ID_TENDER`, `ID_USER`, `NAMA_VENDOR`, `NAMA_BARANG`, `HARGA_PERSATUAN`, `VOLUME_BARANG`, `UKURAN_SATUAN`, `WAKTU`, `APPROVAL`, `INPUTAN_MANAJER`) VALUES
(2, 11, 3, 'PT', 'GW 56', 100000, 2, 'm', '2017-06-20 04:31:15', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:32:12\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:31:15\"}}', 1),
(3, 11, 3, 'PT', 'GW 56', 100000, 2, 'm', '2017-06-20 04:31:15', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:31:15\"}}', 1),
(4, 12, 4, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 600000, 2000, 'm', '2017-07-10 15:38:08', '', NULL);

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
  `APPROVAL` text,
  `RKS` text,
  `BERITA_ACARA` text,
  `DELETED` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender`
--

INSERT INTO `tender` (`ID_TENDER`, `ID_PENYELENGGARA`, `ID_USER`, `JUDUL_TENDER`, `LINK_WEBSITE`, `WILAYAH`, `UPLOAD`, `TGL_MULAI`, `TGL_SELESAI`, `TGL_UPLOAD`, `APPROVAL`, `RKS`, `BERITA_ACARA`, `DELETED`) VALUES
(11, 4, 3, 'PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA', 'http://eproc.pln.co.id/portal/home;jsessionid=qM6YK9FMcW4qfdkfaZO03wZxDm6TucJOW_Cys1UVsefEOCJ_IfLo!843456274', 'AREA KUPANG', 'NPWP Perusahaan|Sertifikat Badan Usaha (SBU)|Pakta Integritas|Sertifikat Badan Usaha Jasa Konstruksi (SBUJK)|Surat keterangan dukungan keuangan dari Bank|Surat Izin Tempat Usaha (SITU)/Izin Gangguan/ Keterangan Domisili.|Direksi/Pengurus yang bertindak untuk dan atas nama perusahaan tidak masuk dalam daftar penyedia Barang/Jasa yang terkena daftar hitam (blacklist)|Surat pernyataan bersedia jika pelelangan batal|Tanda Daftar Perusahaan (TDP)|Pengusaha Kena Pajak (PKP)|Surat Ijin Usaha Jasa Penunjang Tenaga Listrik (SIUJPTL)|Penetapan Pengusaha Kena Pajak (PKP)|Sertifikat Badan Usaha Jasa Penunjang Tenaga Listrik (SBUJPTL)|Surat Ijin Usaha Perdagangan (SIUP)|Surat Ijin Usaha Jasa Konstruksi (SIUJK)|Sertifikat Keterampilan|Formulir Isian Dokumen Kualifikasi|Surat Dukungan Bank|Laporan Keuangan Perusahaan|Data Pengalaman Perusahaan|Type Test LMK|Type Test Independen|Copy Sertifikat SPM|Sertifikat Keahlian (SKA)|Metode Pelaksanaan Pekerjaan|Surat Dukungan yang berasal dari Pabrik|Surat Ijin Usaha Jasa Konstruksi (SIUJK)|ISO 9001 Tahun 2008', '2017-07-31 00:00:00', '2017-09-30 00:00:00', '2017-06-12 02:26:51', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:50:04\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-13 20:02:03\"}}', '{\"file\":\"manual-2018_1499084896.pdf\",\"waktu\":\"2017-07-03 19:28:16\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-10 18:01:04\"}}}', '{\"file\":\"MAX6958-MAX6959_1497365181.pdf\",\"waktu\":\"2017-06-13 21:46:21\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-13 21:58:00\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-10 18:01:04\"}}}', 0),
(12, 5, 3, 'xxxxxxxxxxxsyamdsfsgdsfadf', 'xxxxxxxxx', 'xxxxxxxxxxxxx', 'Sertifikat Badan Usaha (SBU)', '2009-07-16 00:00:00', '2016-02-11 00:00:00', '2017-06-12 02:28:21', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', '{\"file\":\"orange_pi-zero-v1_11_1499684438.pdf\",\"waktu\":\"2017-07-10 18:00:38\",\"user_id\":\"4\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}}', '{\"file\":\"\",\"waktu\":\"\",\"user_id\":\"\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `ID_UNITKERJA` int(11) NOT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `ID_TENDER` int(11) DEFAULT NULL,
  `PENUGASAN` text,
  `WAKTU` datetime DEFAULT NULL,
  `APPROVAL` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`ID_UNITKERJA`, `ID_USER`, `ID_TENDER`, `PENUGASAN`, `WAKTU`, `APPROVAL`) VALUES
(6, 5, 11, 'Dokumen Tender', '2017-06-19 01:38:10', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}'),
(7, 6, 11, 'Dokumen Tender', '2017-06-19 01:38:11', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}'),
(8, 4, 11, 'Keuangan', '2017-07-07 15:29:15', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}'),
(9, 4, 12, 'dsadsda', '2017-07-11 19:31:48', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}');

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
(4, 'unitkerja', 'c7751a072df5820a90a679d0fa4bcbe7', 'Saya Unit Kerja', 'jauh', '2014-11-22 00:00:00', 'unitkerja@gmail.com', '085649411233', 'Unit Kerja', 4, 'avatar1.png'),
(5, 'unitkerja1', 'b175330980714f7d312c18148dbab360', 'Saya unit kerja juga', 'lebih jauh', '2017-04-20 00:00:00', 'unitkerja1@gmail.com', '085649411233', 'Unit Kerja', 4, 'avatar6.png'),
(6, 'unitkerja2', 'b78fdad92d2c446b7990a5d0c1e4931b', 'Saya Unit Kerja 3', 'jauh', '2017-04-18 00:00:00', 'unitkerja3@gmail.com', '081515548148', 'Unit Kerja', 4, 'avatar5.png');

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
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

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
  ADD KEY `FK_REFERENCE_7` (`ID_USER`);

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
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `ID_PENAWARAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `ID_PENYELENGGARA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tender`
--
ALTER TABLE `tender`
  MODIFY `ID_TENDER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `ID_UNITKERJA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  ADD CONSTRAINT `FK_REFERENCE_7` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
