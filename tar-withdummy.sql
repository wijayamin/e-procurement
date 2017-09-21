-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2017 at 09:03 PM
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
  `NAMA_DOKUMEN` longtext,
  `FILE_DOKUMEN` text,
  `DIUPLOAD_OLEH` int(11) DEFAULT NULL,
  `WAKTU` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen_master_administrasi`
--

INSERT INTO `dokumen_master_administrasi` (`ID_DOKUMEN_MASTER`, `NAMA_DOKUMEN`, `FILE_DOKUMEN`, `DIUPLOAD_OLEH`, `WAKTU`) VALUES
(4, 'NPWP|Nomor Pokok Wajib Pajak|NPWP Perusahaan|Nomor Pokok Wajib Pajak Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', 3, '2017-07-19 18:26:17');

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
  `APPROVAL` longtext,
  `DELETED` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokumen_tender`
--

INSERT INTO `dokumen_tender` (`ID_DOKUMEN`, `ID_TENDER`, `NAMA_DOKUMEN`, `FILE_DOKUMEN`, `TGL_UPLOAD`, `PENGUPLOAD`, `DOKUMEN_SYARAT`, `APPROVAL`, `DELETED`) VALUES
(43, 11, 'NPWP Perusahaan', 'PENDAFTARAN_1497813877.pdf', '2017-06-19 00:00:00', '3', 1, '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:32:29\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-19 03:15:15\"}}', 0),
(44, 11, 'Sertifikat Badan Usaha (SBU)', 'tellabsmod-tl-stu-160_1497940635.pdf', '2017-06-20 13:37:15', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(46, 11, 'Sertifikat Badan Usaha Jasa Konstruksi (SBUJK)', NULL, NULL, NULL, 1, NULL, 0),
(47, 11, 'Surat keterangan dukungan keuangan dari Bank', NULL, NULL, NULL, 1, NULL, 0),
(48, 11, 'Surat Izin Tempat Usaha (SITU)/Izin Gangguan/ Keterangan Domisili.', NULL, NULL, NULL, 1, NULL, 0),
(49, 11, 'Direksi/Pengurus yang bertindak untuk dan atas nama perusahaan tidak masuk dalam daftar penyedia Barang/Jasa yang terkena daftar hitam (blacklist)', NULL, NULL, NULL, 1, NULL, 0),
(50, 11, 'Surat pernyataan bersedia jika pelelangan batal', NULL, NULL, NULL, 1, NULL, 0),
(51, 11, 'Tanda Daftar Perusahaan (TDP)', NULL, NULL, NULL, 1, NULL, 0),
(52, 11, 'Pengusaha Kena Pajak (PKP)', NULL, NULL, NULL, 1, NULL, 0),
(53, 11, 'Surat Ijin Usaha Jasa Penunjang Tenaga Listrik (SIUJPTL)', NULL, NULL, NULL, 1, NULL, 0),
(54, 11, 'Penetapan Pengusaha Kena Pajak (PKP)', NULL, NULL, NULL, 1, NULL, 0),
(55, 11, 'Sertifikat Badan Usaha Jasa Penunjang Tenaga Listrik (SBUJPTL)', NULL, NULL, NULL, 1, NULL, 0),
(56, 11, 'Surat Ijin Usaha Perdagangan (SIUP)', NULL, NULL, NULL, 1, NULL, 0),
(57, 11, 'Surat Ijin Usaha Jasa Konstruksi (SIUJK)', NULL, NULL, NULL, 1, NULL, 0),
(58, 11, 'Sertifikat Keterampilan', NULL, NULL, NULL, 1, NULL, 0),
(59, 11, 'Formulir Isian Dokumen Kualifikasi', NULL, NULL, NULL, 1, NULL, 0),
(60, 11, 'Surat Dukungan Bank', NULL, NULL, NULL, 1, NULL, 0),
(61, 11, 'Laporan Keuangan Perusahaan', NULL, NULL, NULL, 1, NULL, 0),
(62, 11, 'Data Pengalaman Perusahaan', NULL, NULL, NULL, 1, NULL, 0),
(63, 11, 'Type Test LMK', NULL, NULL, NULL, 1, NULL, 0),
(64, 11, 'Type Test Independen', NULL, NULL, NULL, 1, NULL, 0),
(65, 11, 'Copy Sertifikat SPM', NULL, NULL, NULL, 1, NULL, 0),
(66, 11, 'Sertifikat Keahlian (SKA)', NULL, NULL, NULL, 1, NULL, 0),
(67, 11, 'Metode Pelaksanaan Pekerjaan', NULL, NULL, NULL, 1, NULL, 0),
(68, 11, 'Surat Dukungan yang berasal dari Pabrik', NULL, NULL, NULL, 1, NULL, 0),
(69, 11, 'Surat Ijin Usaha Jasa Konstruksi (SIUJK)', NULL, NULL, NULL, 1, NULL, 0),
(70, 11, 'ISO 9001 Tahun 2008', NULL, NULL, NULL, 1, NULL, 0),
(71, 12, 'Sertifikat Badan Usaha (SBU) ', 'PENDAFTARAN_1497911156.pdf', '2017-06-20 05:25:56', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(73, 11, 'lala', 'PENDAFTARAN_1497814091.pdf', '2017-06-19 00:00:00', '5', 0, '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:32:33\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-19 03:20:01\"}}', 0),
(74, 12, 'asdasdasd', 'SURAT PERMOHONAN amin_1501060088.pdf', '2017-07-26 16:08:08', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:08:08\"}}', 0),
(75, 12, 'lalalala', 'MAX6958-MAX6959_1499623737.pdf', '2017-07-10 01:08:57', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(76, 14, 'Sertifikat Badan Usaha (SBU)', NULL, NULL, NULL, 1, NULL, 0),
(77, 14, 'Pakta Integritas', NULL, NULL, NULL, 1, NULL, 0),
(78, 14, 'Surat keterangan dukungan keuangan dari Bank', NULL, NULL, NULL, 1, NULL, 0),
(79, 14, 'Surat Dukungan Bank', NULL, NULL, NULL, 1, NULL, 0),
(80, 16, 'NPWP Perusahaan', '815-5376042_1500457852.pdf', '2017-07-19 16:50:52', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(81, 17, 'NPWP Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', '2017-07-19 18:26:17', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(82, 18, 'NPWP Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', '2017-07-19 18:26:17', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(83, 19, 'NPWP Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', '2017-07-19 18:26:17', '3', 1, '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:34:15\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:30:30\"}}', 0),
(84, 19, 'Pakta Integritas', 'SURAT PERMOHONAN amin 2_1501154813.pdf', '2017-07-27 18:26:53', '4', 1, '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:34:17\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:30:32\"}}', 0),
(85, 19, 'ISO 9001 Tahun 2008', 'SURAT PERMOHONAN amin_1501154827.pdf', '2017-07-27 18:27:07', '4', 1, '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:34:19\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:30:35\"}}', 0),
(86, 19, 'SIUP', NULL, NULL, NULL, 1, NULL, 0),
(87, 20, 'NPWP Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', '2017-07-19 18:26:17', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(88, 20, 'Surat Dukungan Bank', NULL, NULL, NULL, 1, NULL, 0),
(89, 20, 'siup', NULL, NULL, NULL, 1, NULL, 0),
(90, 21, 'NPWP Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', '2017-07-19 18:26:17', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(91, 21, 'Surat Dukungan Bank', NULL, NULL, NULL, 1, NULL, 0),
(92, 21, 'siup', NULL, NULL, NULL, 1, NULL, 0),
(93, 22, 'NPWP Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', '2017-07-19 18:26:17', '3', 1, '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-08-11 05:10:44\"}}', 0);

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
(73, 11, 3, '2017-07-26 19:51:13', 'd_unit', 28, NULL),
(74, 11, 3, '2017-07-27 16:51:11', 'd_tender', 11, NULL),
(75, 12, 3, '2017-07-27 16:51:18', 'd_tender', 12, NULL),
(76, 14, 3, '2017-07-27 16:51:39', 'd_tender', 14, NULL),
(77, 15, 3, '2017-07-27 16:51:44', 'd_tender', 15, NULL),
(78, 16, 3, '2017-07-27 16:51:51', 'd_tender', 16, NULL),
(79, 17, 3, '2017-07-27 16:51:56', 'd_tender', 17, NULL),
(80, 18, 3, '2017-07-27 16:52:01', 'd_tender', 18, NULL),
(81, 11, 3, '2017-07-27 17:00:39', 'd_unit', 24, NULL),
(82, 11, 3, '2017-07-27 17:00:43', 'd_unit', 27, NULL),
(83, 11, 3, '2017-07-27 17:10:27', 'i_unit', 29, NULL),
(84, 19, 4, '2017-05-17 17:41:20', 'i_tender', 19, NULL),
(85, 19, 2, '2017-07-27 17:42:52', 'a_tender', 19, 'diterima'),
(86, 19, 3, '2017-07-27 17:43:05', 'a_tender', 19, 'diterima'),
(87, 19, 4, '2017-07-27 17:43:22', 'i_rks', 19, NULL),
(88, 19, 3, '2017-07-27 17:43:57', 'a_rks', 19, 'diterima'),
(89, 19, 2, '2017-07-27 17:46:35', 'a_rks', 19, 'diterima'),
(90, 19, 3, '2017-07-27 17:47:09', 'i_unit', 30, NULL),
(91, 19, 3, '2017-07-27 17:47:25', 'd_unit', 30, NULL),
(92, 19, 3, '2017-07-27 17:47:30', 'i_unit', 31, NULL),
(93, 19, 4, '2017-07-27 17:50:32', 'e_tender', 19, NULL),
(94, 19, 3, '2017-07-27 18:14:32', 'a_tender', 19, 'diterima'),
(95, 19, 2, '2017-07-27 18:14:48', 'a_tender', 19, 'diterima'),
(96, 19, 2, '2017-07-27 18:14:58', 'a_rks', 19, 'diterima'),
(97, 19, 3, '2017-07-27 18:15:19', 'a_rks', 19, 'diterima'),
(98, 19, 3, '2017-07-27 18:15:32', 'd_unit', 31, NULL),
(99, 19, 3, '2017-07-27 18:15:40', 'i_unit', 32, NULL),
(100, 19, 3, '2017-07-27 18:16:41', 'i_unit', 33, NULL),
(101, 19, 3, '2017-07-27 18:17:41', 'i_unit', 34, NULL),
(102, 19, 4, '2017-07-27 18:19:34', 'e_rks', 19, NULL),
(103, 19, 4, '2017-07-27 18:20:19', 'e_rks', 19, NULL),
(104, 19, 3, '2017-07-27 18:20:45', 'a_rks', 19, 'diterima'),
(105, 19, 2, '2017-07-27 18:21:13', 'a_rks', 19, 'diterima'),
(106, 19, 4, '2017-07-27 18:25:13', 'u_dok', 84, NULL),
(107, 19, 4, '2017-07-27 18:26:53', 'u_dok', 84, NULL),
(108, 19, 4, '2017-07-27 18:27:07', 'u_dok', 85, NULL),
(109, 19, 3, '2017-07-27 18:30:25', 'a_dok', 84, 'ditolak'),
(110, 19, 3, '2017-07-27 18:30:28', 'a_dok', 83, 'ditolak'),
(111, 19, 3, '2017-07-27 18:30:30', 'a_dok', 83, 'ditolak'),
(112, 19, 3, '2017-07-27 18:30:32', 'a_dok', 84, 'ditolak'),
(113, 19, 3, '2017-07-27 18:30:35', 'a_dok', 85, 'ditolak'),
(114, 19, 2, '2017-07-27 18:34:15', 'a_dok', 83, 'ditolak'),
(115, 19, 2, '2017-07-27 18:34:17', 'a_dok', 84, 'ditolak'),
(116, 19, 2, '2017-07-27 18:34:19', 'a_dok', 85, 'ditolak'),
(117, 19, 3, '2017-07-27 20:40:20', 'i_unit', 35, NULL),
(118, 19, 3, '2017-07-27 20:40:22', 'd_unit', 35, NULL),
(119, 19, 3, '2017-07-28 18:43:59', 'i_boq', 38, NULL),
(120, 19, 3, '2017-07-28 19:08:32', 'e_boq', 38, NULL),
(121, 19, 3, '2017-07-28 19:11:49', 'e_boq', 38, NULL),
(122, 19, 3, '2017-07-28 19:18:22', 'd_boq', 38, NULL),
(123, 19, 3, '2017-07-28 19:40:50', 'i_boq', 39, NULL),
(124, 19, 3, '2017-07-28 19:47:32', 'a_boq', 39, 'ditolak'),
(125, 20, 16, '2017-08-01 19:53:32', 'i_tender', 20, NULL),
(126, 21, 16, '2017-08-01 19:54:22', 'i_tender', 21, NULL),
(127, 21, 3, '2017-08-01 19:59:07', 'a_tender', 21, 'diterima'),
(128, 21, 2, '2017-08-01 19:59:25', 'a_tender', 21, 'diterima'),
(129, 21, 3, '2017-08-01 20:00:36', 'i_unit', 36, NULL),
(130, 21, 3, '2017-08-01 20:06:38', 'e_tender', 21, NULL),
(131, 22, 3, '2017-08-11 05:10:44', 'i_tender', 22, NULL),
(132, 19, 3, '2017-08-14 18:31:30', 'i_boq', 40, NULL),
(133, 19, 4, '2017-08-14 18:32:08', 'i_boq', 41, NULL),
(134, 19, 4, '2017-08-14 18:33:25', 'd_boq', 41, NULL),
(135, 19, 4, '2017-08-14 18:33:27', 'd_boq', 40, NULL),
(136, 19, 4, '2017-08-14 18:33:30', 'i_boq', 42, NULL),
(137, 21, 3, '2017-08-30 19:20:04', 'i_rks', 21, NULL),
(138, 22, 3, '2017-08-31 18:21:20', 'a_tender', 22, 'ditolak'),
(139, 19, 4, '2017-09-18 18:53:07', 'i_boq', 43, NULL),
(140, 19, 4, '2017-09-18 18:55:18', 'e_boq', 42, NULL),
(141, 19, 4, '2017-09-18 18:56:06', 'e_boq', 42, NULL),
(142, 11, 2, '2017-09-21 23:54:21', 'a_boq', 2, 'diterima'),
(143, 11, 2, '2017-09-21 23:54:21', 'a_boq', 3, 'diterima'),
(144, 11, 2, '2017-09-21 23:54:21', 'a_boq', 6, 'diterima'),
(145, 11, 2, '2017-09-21 23:54:21', 'a_boq', 12, 'diterima'),
(146, 11, 2, '2017-09-21 23:54:21', 'a_boq', 13, 'diterima'),
(147, 11, 2, '2017-09-21 23:54:21', 'a_boq', 14, 'diterima'),
(148, 11, 2, '2017-09-21 23:54:21', 'a_boq', 15, 'diterima'),
(149, 11, 2, '2017-09-21 23:54:22', 'a_boq', 16, 'diterima'),
(150, 11, 2, '2017-09-21 23:54:22', 'a_boq', 17, 'diterima'),
(151, 11, 2, '2017-09-21 23:54:22', 'a_boq', 18, 'diterima'),
(152, 11, 2, '2017-09-21 23:54:48', 'a_boq', 19, 'diterima'),
(153, 11, 2, '2017-09-21 23:54:48', 'a_boq', 20, 'diterima'),
(154, 11, 2, '2017-09-21 23:54:48', 'a_boq', 21, 'diterima'),
(155, 11, 2, '2017-09-21 23:54:48', 'a_boq', 22, 'diterima'),
(156, 11, 2, '2017-09-21 23:54:49', 'a_boq', 25, 'diterima'),
(157, 11, 2, '2017-09-21 23:54:49', 'a_boq', 26, 'diterima'),
(158, 11, 2, '2017-09-21 23:54:49', 'a_boq', 27, 'diterima'),
(159, 11, 2, '2017-09-21 23:54:49', 'a_boq', 28, 'diterima'),
(160, 11, 2, '2017-09-21 23:54:49', 'a_boq', 29, 'diterima'),
(161, 11, 2, '2017-09-21 23:54:49', 'a_boq', 30, 'diterima'),
(162, 11, 3, '2017-09-21 23:56:26', 'i_boq', 44, NULL);

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
(45, 3, 4, 'Menunjuk anda sebagai Unit Kerja Berita Tender \"Berita Tender B\" dengan penugasan \"Penawaran\"', '2017-07-27 18:17:41', '/TAR/tender/detail/19', NULL),
(46, 4, 2, 'Mengganti RKS dari berita tender \"Berita Tender B\". Anda perlu melakukan approval RKS kembali', '2017-07-27 18:20:19', '/TAR/rks-acara/approval/19', NULL),
(47, 4, 3, 'Mengganti RKS dari berita tender \"Berita Tender B\". Anda perlu melakukan approval RKS kembali', '2017-07-27 18:20:19', '/TAR/rks-acara/approval/19', NULL),
(48, 4, 2, 'Mengganti Dokumen dari berita tender \"Berita Tender B\". Anda perlu melakukan approval Dokumen kembali', '2017-07-27 18:26:53', '/TAR/tender/detail/19', NULL),
(49, 4, 3, 'Mengganti Dokumen dari berita tender \"Berita Tender B\". Anda perlu melakukan approval Dokumen kembali', '2017-07-27 18:26:53', '/TAR/tender/detail/19', NULL),
(50, 4, 2, 'Mengganti Dokumen dari berita tender \"Berita Tender B\". Anda perlu melakukan approval Dokumen kembali', '2017-07-27 18:27:07', '/TAR/tender/detail/19', NULL),
(51, 4, 3, 'Mengganti Dokumen dari berita tender \"Berita Tender B\". Anda perlu melakukan approval Dokumen kembali', '2017-07-27 18:27:07', '/TAR/tender/detail/19', NULL),
(52, 3, 5, 'Menunjuk anda sebagai Unit Kerja Berita Tender \"Berita Tender B\" dengan penugasan \"Lainnya\"', '2017-07-27 20:40:20', '/TAR/tender/detail/19', NULL),
(53, 3, 2, 'Mengubah BOQ  \"PT.XYZ - GWS 55mm\". Anda perlu melakukan approval BOQ ini kembali', '2017-07-28 19:11:49', '/TAR/tender/detail/19', NULL),
(54, 3, 3, 'Mengubah BOQ  \"PT.XYZ - GWS 55mm\". Anda perlu melakukan approval BOQ ini kembali', '2017-07-28 19:11:49', '/TAR/tender/detail/19', NULL),
(55, 16, 1, 'Menambahkan berita tender baru: \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\"', '2017-08-01 19:53:32', '/tender/detail/20', NULL),
(56, 16, 2, 'Menambahkan berita tender baru: \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\"', '2017-08-01 19:53:32', '/tender/detail/20', NULL),
(57, 16, 3, 'Menambahkan berita tender baru: \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\"', '2017-08-01 19:53:32', '/tender/detail/20', NULL),
(58, 16, 1, 'Menambahkan berita tender baru: \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\"', '2017-08-01 19:54:22', '/tender/detail/21', NULL),
(59, 16, 2, 'Menambahkan berita tender baru: \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\"', '2017-08-01 19:54:22', '/tender/detail/21', NULL),
(60, 16, 3, 'Menambahkan berita tender baru: \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\"', '2017-08-01 19:54:22', '/tender/detail/21', NULL),
(61, 3, 4, 'Menunjuk anda sebagai Unit Kerja Berita Tender \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\" dengan penugasan \"Penawaran\"', '2017-08-01 20:00:36', '/tender/detail/21', NULL),
(62, 3, 2, 'Mengubah Berita Tender \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\". Anda perlu melakukan approval Berita Tender, RKS, BOQ, dan Dokumen Tender kembali', '2017-08-01 20:06:38', '/tender/approval/21', NULL),
(63, 3, 3, 'Mengubah Berita Tender \"PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II\". Anda perlu melakukan approval Berita Tender, RKS, BOQ, dan Dokumen Tender kembali', '2017-08-01 20:06:38', '/tender/approval/21', NULL),
(64, 3, 1, 'Menambahkan berita tender baru: \"asdasdfgjhfghdfgh\"', '2017-08-11 05:10:44', '/TAR/tender/detail/22', NULL),
(65, 3, 17, 'Menambahkan berita tender baru: \"asdasdfgjhfghdfgh\"', '2017-08-11 05:10:44', '/TAR/tender/detail/22', NULL),
(66, 3, 2, 'Menambahkan berita tender baru: \"asdasdfgjhfghdfgh\"', '2017-08-11 05:10:44', '/TAR/tender/detail/22', NULL),
(67, 3, 3, 'Menambahkan berita tender baru: \"asdasdfgjhfghdfgh\"', '2017-08-11 05:10:44', '/TAR/tender/detail/22', NULL),
(68, 4, 2, 'Mengubah BOQ  \"adasd - adsadasd\". Anda perlu melakukan approval BOQ ini kembali', '2017-09-18 18:55:18', '/tender/detail/19', NULL),
(69, 4, 3, 'Mengubah BOQ  \"adasd - adsadasd\". Anda perlu melakukan approval BOQ ini kembali', '2017-09-18 18:55:18', '/tender/detail/19', NULL),
(70, 4, 2, 'Mengubah BOQ  \"adasd - adsadasd\". Anda perlu melakukan approval BOQ ini kembali', '2017-09-18 18:56:06', '/tender/detail/19', NULL),
(71, 4, 3, 'Mengubah BOQ  \"adasd - adsadasd\". Anda perlu melakukan approval BOQ ini kembali', '2017-09-18 18:56:06', '/tender/detail/19', NULL);

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
  `HARGA_JASA` float DEFAULT '0',
  `VOLUME_BARANG` float DEFAULT NULL,
  `UKURAN_SATUAN` text,
  `WAKTU` datetime DEFAULT NULL,
  `APPROVAL` text,
  `INPUTAN_MANAJER` int(11) DEFAULT NULL,
  `DELETED` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penawaran`
--

INSERT INTO `penawaran` (`ID_PENAWARAN`, `ID_TENDER`, `ID_USER`, `NAMA_VENDOR`, `NAMA_BARANG`, `HARGA_PERSATUAN`, `HARGA_JASA`, `VOLUME_BARANG`, `UKURAN_SATUAN`, `WAKTU`, `APPROVAL`, `INPUTAN_MANAJER`, `DELETED`) VALUES
(2, 11, 3, 'PT', 'GW 56', 100000, 0, 2, 'm', '2017-06-20 04:31:15', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:20\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:31:15\"}}', 1, 0),
(3, 11, 3, 'PT', 'GW 56', 100000, 0, 2, 'm', '2017-06-20 04:31:15', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:21\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:31:15\"}}', 1, 0),
(4, 12, 4, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 600000, 0, 2000, 'm', '2017-07-10 15:38:08', '{\"manajer\":{\"status\":\"ditolak\",\"waktu\":\"2017-07-26 16:27:42\"}}', NULL, 0),
(6, 11, 3, 'xxxx', 'xxx', 2, 0, 2, 'cm', '2017-07-13 20:51:35', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:21\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-13 20:51:35\"}}', 5, 0),
(12, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-25 19:40:03', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:21\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-25 19:40:03\"}}', 9, 0),
(13, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:25', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:21\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:25\"}}', 9, 0),
(14, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:25', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:21\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:25\"}}', 9, 0),
(15, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:34', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:21\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:34\"}}', 9, 0),
(16, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:34', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:21\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:34\"}}', 9, 0),
(17, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:34', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:22\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:34\"}}', 9, 0),
(18, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:35', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:22\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:35\"}}', 9, 0),
(19, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:35', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:48\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:35\"}}', 9, 0),
(20, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:35', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:48\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:35\"}}', 9, 0),
(21, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:35', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:48\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:35\"}}', 9, 0),
(22, 11, 3, 'AA', 'AA', 50000000, 0, 12, 'm', '2017-07-26 15:50:36', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:48\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:36\"}}', 9, 0),
(25, 11, 4, 'PT.XYZ', 'GWS 55mm', 50000, 0, 1000, 'mm', '2017-07-26 15:53:33', '{\"manajer\":{\"status\":\"ditolak\",\"waktu\":\"2017-07-26 15:56:05\"},\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:49\"}}', NULL, 0),
(26, 11, 3, 'PT.XYZ', 'GWS 55mm', 45000, 0, 1000, 'mm', '2017-07-26 15:54:19', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:49\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:54:19\"}}', 25, 0),
(27, 11, 3, 'PT.XYZ', 'GWS 55mm', 50000, 0, 1000, 'mm', '2017-07-26 15:56:04', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:49\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:56:04\"}}', 25, 0),
(28, 11, 3, 'PT.XYZ', 'GWS 55mm', 50000, 0, 1000, 'mm', '2017-07-26 15:56:04', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:49\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:56:04\"}}', 25, 0),
(29, 11, 3, 'PT.XYZ', 'GWS 55mm', 50000, 0, 1000, 'mm', '2017-07-26 15:56:04', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:49\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:56:04\"}}', 25, 0),
(30, 11, 3, 'PT.XYZ', 'GWS 55mm', 50000, 0, 1000, 'mm', '2017-07-26 15:56:05', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:54:49\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:56:05\"}}', 25, 0),
(31, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 100000, 0, 2000, 'm', '2017-07-26 16:27:29', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:29\"}}', 4, 0),
(32, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 900000, 0, 2000, 'm', '2017-07-26 16:27:41', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:41\"}}', 4, 0),
(33, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 900000, 0, 2000, 'm', '2017-07-26 16:27:41', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:41\"}}', 4, 0),
(34, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 900000, 0, 2000, 'm', '2017-07-26 16:27:41', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:41\"}}', 4, 0),
(35, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 900000, 0, 2000, 'm', '2017-07-26 16:27:42', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:42\"}}', 4, 0),
(36, 19, 3, 'PT.XYZ', 'GWS 55mm', 56000, 0, 1000, 'm', '2017-07-28 18:41:06', '{\"direktur\":{\"status\":\"\",\"waktu\":\"2017-07-28 18:41:06\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-28 18:41:06\"}}', NULL, 1),
(38, 19, 3, 'PT.XYZ', 'GWS 55mm', 54000, 0, 10000, 'm', '2017-07-28 18:42:55', '{\"direktur\":{\"status\":\"\",\"waktu\":\"2017-07-28 18:42:55\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-28 18:42:55\"}}', NULL, 1),
(39, 19, 3, 'PT ABC', 'GMS', 1000000, 0, 10000000, 'm', '2017-07-28 19:40:50', '{\"direktur\":{\"status\":\"\",\"waktu\":\"2017-07-28 19:40:50\"},\"manajer\":{\"status\":\"ditolak\",\"waktu\":\"2017-07-28 19:47:32\"}}', NULL, 0),
(40, 19, 3, 'asdads', 'adsada', 1, 0, 1, 'mm', '2017-08-14 18:31:30', '{\"direktur\":{\"status\":\"\",\"waktu\":\"2017-08-14 18:31:30\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-08-14 18:31:30\"}}', NULL, 1),
(41, 19, 4, 'adasd', 'adsadasd', 1, 0, 1, 'mm', '2017-08-14 18:32:08', '{\"direktur\":{\"status\":\"\",\"waktu\":\"2017-08-14 18:32:08\"},\"manajer\":{\"status\":\"\",\"waktu\":\"2017-08-14 18:32:08\"}}', NULL, 1),
(42, 19, 4, 'adasd', 'adsadasd', 1, 3000, 1, 'mm', '2017-09-18 18:56:06', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, 0),
(43, 19, 4, 'AAA', 'GG', 1000, 50000, 1000, 'mm', '2017-09-18 18:53:06', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, 0),
(44, 11, 3, 'adhjhgj', 'hgjfghj', 100, 500, 100, 'KM', '2017-09-21 23:56:26', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-09-21 23:56:26\"}}', NULL, 0);

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
(11, 4, 3, 'PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA', 'http://eproc.pln.co.id/portal/home;jsessionid=qM6YK9FMcW4qfdkfaZO03wZxDm6TucJOW_Cys1UVsefEOCJ_IfLo!843456274', 'AREA KUPANG', 'NPWP Perusahaan|Sertifikat Badan Usaha (SBU)|Pakta Integritas|Sertifikat Badan Usaha Jasa Konstruksi (SBUJK)|Surat keterangan dukungan keuangan dari Bank|Surat Izin Tempat Usaha (SITU)/Izin Gangguan/ Keterangan Domisili.|Direksi/Pengurus yang bertindak untuk dan atas nama perusahaan tidak masuk dalam daftar penyedia Barang/Jasa yang terkena daftar hitam (blacklist)|Surat pernyataan bersedia jika pelelangan batal|Tanda Daftar Perusahaan (TDP)|Pengusaha Kena Pajak (PKP)|Surat Ijin Usaha Jasa Penunjang Tenaga Listrik (SIUJPTL)|Penetapan Pengusaha Kena Pajak (PKP)|Sertifikat Badan Usaha Jasa Penunjang Tenaga Listrik (SBUJPTL)|Surat Ijin Usaha Perdagangan (SIUP)|Surat Ijin Usaha Jasa Konstruksi (SIUJK)|Sertifikat Keterampilan|Formulir Isian Dokumen Kualifikasi|Surat Dukungan Bank|Laporan Keuangan Perusahaan|Data Pengalaman Perusahaan|Type Test LMK|Type Test Independen|Copy Sertifikat SPM|Sertifikat Keahlian (SKA)|Metode Pelaksanaan Pekerjaan|Surat Dukungan yang berasal dari Pabrik|Surat Ijin Usaha Jasa Konstruksi (SIUJK)|ISO 9001 Tahun 2008', '2017-07-31 00:00:00', '2017-09-30 00:00:00', '2017-06-12 02:26:51', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:50:04\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-13 20:02:03\"}}', '{\"file\":\"815-5376042_1501059884.pdf\",\"waktu\":\"2017-07-26 16:04:44\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 20:12:04\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:04:44\"}}}', '{\"file\":\"PowerBeam_PBE-M2-400_QSG_1499855504.pdf\",\"waktu\":\"2017-07-12 17:31:44\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 20:12:04\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-13 20:49:44\"}}}', 1),
(12, 5, 3, 'xxxxxxxxxxx', 'xxxxxxxxx', 'xxxxxxxxxxxxx', 'Sertifikat Badan Usaha (SBU)', '2009-07-16 00:00:00', '2016-02-11 00:00:00', '2017-06-12 02:28:21', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', '{\"file\":\"orange_pi-zero-v1_11_1499854616.pdf\",\"waktu\":\"2017-07-12 17:16:56\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}}', '{\"file\":\"Allwinner_H3_Datasheet_V1.2_1499854636.pdf\",\"waktu\":\"2017-07-12 17:17:16\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}}', 1),
(13, 5, 3, 'jhhjkhjk', 'sadadsdasdasads', 'asdadsda', 'Sertifikat Badan Usaha (SBU)|Pakta Integritas|Surat keterangan dukungan keuangan dari Bank|Surat Dukungan Bank', '1899-12-13 00:00:00', '2017-07-14 00:00:00', '2017-07-12 16:46:40', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 1),
(14, 5, 3, 'aa', 'sadadsdasdasads', 'asdadsda', 'Sertifikat Badan Usaha (SBU)|Pakta Integritas|Surat keterangan dukungan keuangan dari Bank|Surat Dukungan Bank', '1899-12-13 00:00:00', '2017-07-14 00:00:00', '2017-07-12 16:47:04', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 1),
(15, 4, 3, 'asdadsads', 'asddsaadsaddas', 'adsasdads', 'NPWP Perusahaan', '2017-07-19 00:00:00', '2017-07-21 00:00:00', '2017-07-19 17:54:11', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 1),
(16, 5, 3, 'asdadsads', 'asddsaadsaddas', 'adsasdads', 'NPWP Perusahaan', '2017-07-19 00:00:00', '2017-07-21 00:00:00', '2017-07-19 17:55:11', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 1),
(17, 5, 3, 'x', 'asddsd', 'asdads', 'NPWP Perusahaan', '2017-07-05 00:00:00', '2017-07-19 00:00:00', '2017-07-26 16:02:12', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:03:24\"}}', NULL, NULL, 1),
(18, 5, 3, 'y', 'y', 'y', 'NPWP Perusahaan', '2017-06-28 00:00:00', '2017-06-30 00:00:00', '2017-07-26 18:34:01', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 18:34:01\"}}', NULL, NULL, 1),
(19, 4, 4, 'Berita Tender B', 'web berita tender B', 'ya lokasi berita tender B', 'NPWP Perusahaan|Pakta Integritas|ISO 9001 Tahun 2008|SIUP', '2017-10-19 00:00:00', '2018-05-11 00:00:00', '2017-07-27 17:41:20', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:14:48\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:14:31\"}}', '{\"file\":\"SURAT PERMOHONAN amin 2_1501154419.pdf\",\"waktu\":\"2017-07-27 18:20:19\",\"user_id\":\"4\",\"approval\":{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:21:12\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-27 18:20:45\"}}}', '{\"file\":\"PowerBeam_PBE-M2-400_QSG_1499855504.pdf\",\"waktu\":\"2017-07-12 17:31:44\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 20:12:04\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-13 20:49:44\"}}}', 0),
(20, 5, 16, 'PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II', 'lala', 'lala', 'NPWP Perusahaan|Surat Dukungan Bank|siup', '2017-08-16 00:00:00', '2017-08-31 00:00:00', '2017-08-01 19:53:32', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 0),
(21, 5, 16, 'PEKERJAAN PEMBORONGAN JASA TRANSPORTASI PROYEK TSK PLTU KALSELTENG 2 (ASAM â€“ ASAM UNIT 5 & 6) PT PLN (PERSERO) PUSAT MANAJEMEN KONSTRUKSI UNIT MANAJEMEN KONSTRUKSI II', 'lala', 'lalaa', 'NPWP Perusahaan|Surat Dukungan Bank|siup', '2017-08-16 00:00:00', '2017-08-31 00:00:00', '2017-08-01 19:54:22', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-08-01 20:06:38\"}}', '{\"file\":\"Noisy_1504095604.pdf\",\"waktu\":\"2017-08-30 19:20:04\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-08-30 19:20:04\"}}}', NULL, 0),
(22, 5, 3, 'asdasdfgjhfghdfgh', 'gfdgjhjkjkgh', 'fgfdgdf', 'NPWP Perusahaan', '2017-08-25 00:00:00', '2017-08-26 00:00:00', '2017-08-11 05:10:44', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"ditolak\",\"waktu\":\"2017-08-31 18:21:20\"}}', NULL, NULL, 0);

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
  `APPROVAL` text,
  `DELETED` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`ID_UNITKERJA`, `ID_USER`, `ID_TENDER`, `PENUGASAN`, `WAKTU`, `APPROVAL`, `DELETED`) VALUES
(12, 5, 12, 'adsad', '2017-07-13 14:24:06', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(24, 5, 11, 'Dokumen', '2017-07-25 18:31:09', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1),
(27, 6, 11, 'Dokumen', '2017-07-25 18:32:13', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1),
(28, 4, 11, 'b', '2017-07-26 18:35:42', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1),
(29, 4, 11, 'Penawaran', '2017-07-27 17:10:27', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(30, 4, 19, 'Penawaran', '2017-07-27 17:47:09', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1),
(31, 4, 19, 'Lainnya', '2017-07-27 17:47:30', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1),
(32, 4, 19, 'Penawaran', '2017-07-27 18:15:40', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1),
(33, 5, 19, 'Lainnya', '2017-07-27 18:16:41', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1),
(34, 4, 19, 'Penawaran', '2017-07-27 18:17:41', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(35, 5, 19, 'Lainnya', '2017-07-27 20:40:20', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1),
(36, 4, 21, 'Penawaran', '2017-08-01 20:00:36', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0);

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
  `TANGGAL_LAHIR` date DEFAULT NULL,
  `EMAIL` text,
  `TELEFON` text,
  `JABATAN` text,
  `PREVILEDGE` int(11) DEFAULT '0',
  `IMAGE` text,
  `TOKEN` text,
  `SMSCODE` text,
  `STATUS` int(11) NOT NULL DEFAULT '0',
  `DELETED` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `ALAMAT`, `TANGGAL_LAHIR`, `EMAIL`, `TELEFON`, `JABATAN`, `PREVILEDGE`, `IMAGE`, `TOKEN`, `SMSCODE`, `STATUS`, `DELETED`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Saya Admin', 'jauh', '2017-03-01', 'ryanhadiw@gmail.com', '085863957221', 'Administrasi', 1, 'avatar.png', 'aaa', NULL, 1, 0),
(2, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 'Saya Direktur', 'Jauh', '2017-03-22', 'direktur@gmail.com', '085863957221', 'Direktur', 2, 'avatar3.png', NULL, NULL, 1, 0),
(3, 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'Saya Manager Lho', 'jauh sekali', '2017-03-09', 'manajer@gmail.com', '085863957221', 'Manajer', 3, 'avatar2_1500901986.png', NULL, NULL, 1, 0),
(4, 'unitkerja', 'c7751a072df5820a90a679d0fa4bcbe7', 'Saya Unit Kerja', 'jauh', '2014-11-22', 'unitkerja@gmail.com', '085863957221', 'Unit Kerja', 4, 'avatar1.png', NULL, NULL, 1, 0),
(5, 'unitkerja1', 'b175330980714f7d312c18148dbab360', 'Saya unit kerja juga', 'lebih jauh', '2017-04-20', 'unitkerja1@gmail.com', '085863957221', 'Unit Kerja', 4, 'avatar6.png', NULL, NULL, 1, 0),
(6, 'unitkerja2', 'b78fdad92d2c446b7990a5d0c1e4931b', 'Saya Unit Kerja 3', 'jauh', '2017-04-18', 'unitkerja3@gmail.com', '085863957221', 'Unit Kerja', 4, 'avatar5.png', NULL, NULL, 1, 1),
(7, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'Admin with Super Saiyan Mode', 'Surga', '2017-07-20', 'superadmin@gmail.com', '081252727622', 'Super Admin', 5, 'saiyan.png', NULL, NULL, 1, 0),
(16, 'mientz', 'f04878fc9c0d6452eb8d6603371f2548', 'mientz', NULL, NULL, 'genthowijaya@gmail.com', '085863957221', 'Unit Kerja', 4, 'no-photo.jpg', '9adf20bfa7b423ba89d67dfe56876907', NULL, 1, 0),
(17, 'lalala', 'f04878fc9c0d6452eb8d6603371f2548', 'lalala', NULL, NULL, 'drak_nes@yahoo.com', '081252727622', 'Admin', 1, 'no-photo.jpg', NULL, '30E3BF', 1, 1);

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
  MODIFY `ID_DOKUMEN_MASTER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dokumen_tender`
--
ALTER TABLE `dokumen_tender`
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `ID_PENAWARAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `ID_PENYELENGGARA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tender`
--
ALTER TABLE `tender`
  MODIFY `ID_TENDER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `ID_UNITKERJA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
