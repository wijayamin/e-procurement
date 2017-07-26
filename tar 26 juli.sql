-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2017 at 03:30 PM
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
(80, 16, 'NPWP Perusahaan', '815-5376042_1500457852.pdf', '2017-07-19 16:50:52', '3', 1, NULL, 0),
(81, 17, 'NPWP Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', '2017-07-19 18:26:17', '3', 1, NULL, 0),
(82, 18, 'NPWP Perusahaan', 'SURAT PERMOHONAN amin_1500463477.pdf', '2017-07-19 18:26:17', '3', 1, NULL, 0);

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
(73, 11, 3, '2017-07-26 19:51:13', 'd_unit', 28, NULL);

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
(14, 3, 4, 'Anda telah dipilih menjadi unitkerja <mark>dsadsda</mark> pada tender \"xxxxxxxxxxxsyam\"', '2017-07-11 19:31:48', '/TAR/tender/detail/12', NULL),
(15, 3, 1, 'Menambahkan berita tender baru: \"jhhjkhjk\"', '2017-07-12 16:47:04', '/TAR/tender/detail/14', NULL),
(16, 3, 2, 'Menambahkan berita tender baru: \"jhhjkhjk\"', '2017-07-12 16:47:04', '/TAR/tender/detail/14', NULL),
(17, 3, 3, 'Menambahkan berita tender baru: \"jhhjkhjk\"', '2017-07-12 16:47:04', '/TAR/tender/detail/14', NULL),
(18, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>lala</mark> pada tender \"xxxxxxxxxxxsyamdsfsgdsfadf\"', '2017-07-13 14:18:07', '/TAR/tender/detail/12', NULL),
(19, 3, 6, 'Anda telah dipilih menjadi unitkerja <mark>lala</mark> pada tender \"xxxxxxxxxxxsyamdsfsgdsfadf\"', '2017-07-13 14:18:07', '/TAR/tender/detail/12', NULL),
(20, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>adsad</mark> pada tender \"xxxxxxxxxxxsyamdsfsgdsfadf\"', '2017-07-13 14:24:06', '/TAR/tender/detail/12', NULL),
(21, 3, 4, 'Anda telah dipilih menjadi unitkerja <mark>aa</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-13 20:53:22', '/TAR/tender/detail/11', NULL),
(22, 3, 4, 'Anda telah dipilih menjadi unitkerja <mark>a</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-13 20:54:53', '/TAR/tender/detail/11', NULL),
(23, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>b</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-13 20:54:59', '/TAR/tender/detail/11', NULL),
(24, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>b</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-13 20:54:59', '/TAR/tender/detail/11', NULL),
(25, 3, 1, 'Menambahkan berita tender baru: \"asdadsads\"', '2017-07-19 17:55:11', '/TAR/tender/detail/16', NULL),
(26, 3, 2, 'Menambahkan berita tender baru: \"asdadsads\"', '2017-07-19 17:55:11', '/TAR/tender/detail/16', NULL),
(27, 3, 3, 'Menambahkan berita tender baru: \"asdadsads\"', '2017-07-19 17:55:11', '/TAR/tender/detail/16', NULL),
(28, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>a</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 16:10:39', '/TAR/tender/detail/11', NULL),
(29, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>a</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 16:10:39', '/TAR/tender/detail/11', NULL),
(30, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>a</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 16:10:40', '/TAR/tender/detail/11', NULL),
(31, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>a</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 16:10:40', '/TAR/tender/detail/11', NULL),
(32, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>a</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 16:10:41', '/TAR/tender/detail/11', NULL),
(33, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>Dokumen</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 18:30:36', '/TAR/tender/detail/11', NULL),
(34, 3, 5, 'Anda telah dipilih menjadi unitkerja <mark>Dokumen</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 18:31:09', '/TAR/tender/detail/11', NULL),
(35, 3, 6, 'Anda telah dipilih menjadi unitkerja <mark>Dokumen</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 18:31:18', '/TAR/tender/detail/11', NULL),
(36, 3, 6, 'Anda telah dipilih menjadi unitkerja <mark>Dokumen</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 18:31:33', '/TAR/tender/detail/11', NULL),
(37, 3, 6, 'Anda telah dipilih menjadi unitkerja <mark>Dokumen</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-25 18:32:13', '/TAR/tender/detail/11', NULL),
(38, 3, 1, 'Menambahkan berita tender baru: \"asdadsad\"', '2017-07-26 16:02:12', '/TAR/tender/detail/17', NULL),
(39, 3, 2, 'Menambahkan berita tender baru: \"asdadsad\"', '2017-07-26 16:02:12', '/TAR/tender/detail/17', NULL),
(40, 3, 3, 'Menambahkan berita tender baru: \"asdadsad\"', '2017-07-26 16:02:12', '/TAR/tender/detail/17', NULL),
(41, 3, 1, 'Menambahkan berita tender baru: \"y\"', '2017-07-26 18:34:02', '/TAR/tender/detail/18', NULL),
(42, 3, 2, 'Menambahkan berita tender baru: \"y\"', '2017-07-26 18:34:02', '/TAR/tender/detail/18', NULL),
(43, 3, 3, 'Menambahkan berita tender baru: \"y\"', '2017-07-26 18:34:02', '/TAR/tender/detail/18', NULL),
(44, 3, 4, 'Anda telah dipilih menjadi unitkerja <mark>b</mark> pada tender \"PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA\"', '2017-07-26 18:35:42', '/TAR/tender/detail/11', NULL);

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
  `INPUTAN_MANAJER` int(11) DEFAULT NULL,
  `DELETED` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penawaran`
--

INSERT INTO `penawaran` (`ID_PENAWARAN`, `ID_TENDER`, `ID_USER`, `NAMA_VENDOR`, `NAMA_BARANG`, `HARGA_PERSATUAN`, `VOLUME_BARANG`, `UKURAN_SATUAN`, `WAKTU`, `APPROVAL`, `INPUTAN_MANAJER`, `DELETED`) VALUES
(2, 11, 3, 'PT', 'GW 56', 100000, 2, 'm', '2017-06-20 04:31:15', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:32:12\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:31:15\"}}', 1, 0),
(3, 11, 3, 'PT', 'GW 56', 100000, 2, 'm', '2017-06-20 04:31:15', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:31:15\"}}', 1, 0),
(4, 12, 4, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 600000, 2000, 'm', '2017-07-10 15:38:08', '{\"manajer\":{\"status\":\"ditolak\",\"waktu\":\"2017-07-26 16:27:42\"}}', NULL, 0),
(6, 11, 3, 'xxxx', 'xxx', 2, 2, 'cm', '2017-07-13 20:51:35', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-13 20:51:35\"}}', 5, 0),
(12, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-25 19:40:03', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-25 19:40:03\"}}', 9, 0),
(13, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:25', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:25\"}}', 9, 0),
(14, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:25', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:25\"}}', 9, 0),
(15, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:34', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:34\"}}', 9, 0),
(16, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:34', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:34\"}}', 9, 0),
(17, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:34', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:34\"}}', 9, 0),
(18, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:35', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:35\"}}', 9, 0),
(19, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:35', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:35\"}}', 9, 0),
(20, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:35', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:35\"}}', 9, 0),
(21, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:35', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:35\"}}', 9, 0),
(22, 11, 3, 'AA', 'AA', 50000000, 12, 'm', '2017-07-26 15:50:36', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:50:36\"}}', 9, 0),
(25, 11, 4, 'PT.XYZ', 'GWS 55mm', 50000, 1000, 'mm', '2017-07-26 15:53:33', '{\"manajer\":{\"status\":\"ditolak\",\"waktu\":\"2017-07-26 15:56:05\"}}', NULL, 0),
(26, 11, 3, 'PT.XYZ', 'GWS 55mm', 45000, 1000, 'mm', '2017-07-26 15:54:19', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:54:19\"}}', 25, 0),
(27, 11, 3, 'PT.XYZ', 'GWS 55mm', 50000, 1000, 'mm', '2017-07-26 15:56:04', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:56:04\"}}', 25, 0),
(28, 11, 3, 'PT.XYZ', 'GWS 55mm', 50000, 1000, 'mm', '2017-07-26 15:56:04', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:56:04\"}}', 25, 0),
(29, 11, 3, 'PT.XYZ', 'GWS 55mm', 50000, 1000, 'mm', '2017-07-26 15:56:04', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:56:04\"}}', 25, 0),
(30, 11, 3, 'PT.XYZ', 'GWS 55mm', 50000, 1000, 'mm', '2017-07-26 15:56:05', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 15:56:05\"}}', 25, 0),
(31, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 100000, 2000, 'm', '2017-07-26 16:27:29', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:29\"}}', 4, 0),
(32, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 900000, 2000, 'm', '2017-07-26 16:27:41', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:41\"}}', 4, 0),
(33, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 900000, 2000, 'm', '2017-07-26 16:27:41', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:41\"}}', 4, 0),
(34, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 900000, 2000, 'm', '2017-07-26 16:27:41', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:41\"}}', 4, 0),
(35, 12, 3, 'PT. Sri Sentosa Teknik', 'High Voltage Coated Silica Wire 38976', 900000, 2000, 'm', '2017-07-26 16:27:42', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:27:42\"}}', 4, 0);

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
(11, 4, 3, 'PERLUASAN JTM, PEMBANGUNAN GARDU SISIP DAN PERLUASAN JTR UNTUK PENYAMBUNGAN BARU DAN PENAMBAHAN DAYA SAMPAI DENGAN 33 KVA PT PLN (PERSERO) AREA KUPANG, RAYON KEFAMENANU DAN RAYON ATAMBUA', 'http://eproc.pln.co.id/portal/home;jsessionid=qM6YK9FMcW4qfdkfaZO03wZxDm6TucJOW_Cys1UVsefEOCJ_IfLo!843456274', 'AREA KUPANG', 'NPWP Perusahaan|Sertifikat Badan Usaha (SBU)|Pakta Integritas|Sertifikat Badan Usaha Jasa Konstruksi (SBUJK)|Surat keterangan dukungan keuangan dari Bank|Surat Izin Tempat Usaha (SITU)/Izin Gangguan/ Keterangan Domisili.|Direksi/Pengurus yang bertindak untuk dan atas nama perusahaan tidak masuk dalam daftar penyedia Barang/Jasa yang terkena daftar hitam (blacklist)|Surat pernyataan bersedia jika pelelangan batal|Tanda Daftar Perusahaan (TDP)|Pengusaha Kena Pajak (PKP)|Surat Ijin Usaha Jasa Penunjang Tenaga Listrik (SIUJPTL)|Penetapan Pengusaha Kena Pajak (PKP)|Sertifikat Badan Usaha Jasa Penunjang Tenaga Listrik (SBUJPTL)|Surat Ijin Usaha Perdagangan (SIUP)|Surat Ijin Usaha Jasa Konstruksi (SIUJK)|Sertifikat Keterampilan|Formulir Isian Dokumen Kualifikasi|Surat Dukungan Bank|Laporan Keuangan Perusahaan|Data Pengalaman Perusahaan|Type Test LMK|Type Test Independen|Copy Sertifikat SPM|Sertifikat Keahlian (SKA)|Metode Pelaksanaan Pekerjaan|Surat Dukungan yang berasal dari Pabrik|Surat Ijin Usaha Jasa Konstruksi (SIUJK)|ISO 9001 Tahun 2008', '2017-07-31 00:00:00', '2017-09-30 00:00:00', '2017-06-12 02:26:51', '{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-06-20 04:50:04\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-06-13 20:02:03\"}}', '{\"file\":\"815-5376042_1501059884.pdf\",\"waktu\":\"2017-07-26 16:04:44\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 20:12:04\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:04:44\"}}}', '{\"file\":\"PowerBeam_PBE-M2-400_QSG_1499855504.pdf\",\"waktu\":\"2017-07-12 17:31:44\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 20:12:04\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-13 20:49:44\"}}}', 0),
(12, 5, 3, 'xxxxxxxxxxx', 'xxxxxxxxx', 'xxxxxxxxxxxxx', 'Sertifikat Badan Usaha (SBU)', '2009-07-16 00:00:00', '2016-02-11 00:00:00', '2017-06-12 02:28:21', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', '{\"file\":\"orange_pi-zero-v1_11_1499854616.pdf\",\"waktu\":\"2017-07-12 17:16:56\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}}', '{\"file\":\"Allwinner_H3_Datasheet_V1.2_1499854636.pdf\",\"waktu\":\"2017-07-12 17:17:16\",\"user_id\":\"3\",\"approval\":{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}}', 0),
(13, 5, 3, 'jhhjkhjk', 'sadadsdasdasads', 'asdadsda', 'Sertifikat Badan Usaha (SBU)|Pakta Integritas|Surat keterangan dukungan keuangan dari Bank|Surat Dukungan Bank', '1899-12-13 00:00:00', '2017-07-14 00:00:00', '2017-07-12 16:46:40', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 1),
(14, 5, 3, 'aa', 'sadadsdasdasads', 'asdadsda', 'Sertifikat Badan Usaha (SBU)|Pakta Integritas|Surat keterangan dukungan keuangan dari Bank|Surat Dukungan Bank', '1899-12-13 00:00:00', '2017-07-14 00:00:00', '2017-07-12 16:47:04', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 0),
(15, 4, 3, 'asdadsads', 'asddsaadsaddas', 'adsasdads', 'NPWP Perusahaan', '2017-07-19 00:00:00', '2017-07-21 00:00:00', '2017-07-19 17:54:11', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 0),
(16, 5, 3, 'asdadsads', 'asddsaadsaddas', 'adsasdads', 'NPWP Perusahaan', '2017-07-19 00:00:00', '2017-07-21 00:00:00', '2017-07-19 17:55:11', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', NULL, NULL, 0),
(17, 5, 3, 'x', 'asddsd', 'asdads', 'NPWP Perusahaan', '2017-07-05 00:00:00', '2017-07-19 00:00:00', '2017-07-26 16:02:12', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 16:03:24\"}}', NULL, NULL, 0),
(18, 5, 3, 'y', 'y', 'y', 'NPWP Perusahaan', '2017-06-28 00:00:00', '2017-06-30 00:00:00', '2017-07-26 18:34:01', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"diterima\",\"waktu\":\"2017-07-26 18:34:01\"}}', NULL, NULL, 0);

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
(24, 5, 11, 'Dokumen', '2017-07-25 18:31:09', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(27, 6, 11, 'Dokumen', '2017-07-25 18:32:13', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 0),
(28, 4, 11, 'b', '2017-07-26 18:35:42', '{\"direktur\":{\"status\":\"\",\"waktu\":\"\"},\"manajer\":{\"status\":\"\",\"waktu\":\"\"}}', 1);

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
  `STATUS` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `ALAMAT`, `TANGGAL_LAHIR`, `EMAIL`, `TELEFON`, `JABATAN`, `PREVILEDGE`, `IMAGE`, `TOKEN`, `STATUS`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Saya Admin', 'jauh', '2017-03-01', 'ryanhadiw@gmail.com', '082140177480', 'Administrasi', 1, 'avatar.png', 'aaa', 1),
(2, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 'Saya Direktur', 'Jauh', '2017-03-22', 'direktur@gmail.com', '081515548148', 'Direktur', 2, 'avatar3.png', NULL, 1),
(3, 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'Saya Manager Lho', 'jauh sekali', '2017-03-09', 'manager@gmail.com', '085649411233', 'Manajer', 3, 'avatar2_1500901986.png', NULL, 1),
(4, 'unitkerja', 'c7751a072df5820a90a679d0fa4bcbe7', 'Saya Unit Kerja', 'jauh', '2014-11-22', 'unitkerja@gmail.com', '085649411233', 'Unit Kerja', 4, 'avatar1.png', NULL, 1),
(5, 'unitkerja1', 'b175330980714f7d312c18148dbab360', 'Saya unit kerja juga', 'lebih jauh', '2017-04-20', 'unitkerja1@gmail.com', '085649411233', 'Unit Kerja', 4, 'avatar6.png', NULL, 1),
(6, 'unitkerja2', 'b78fdad92d2c446b7990a5d0c1e4931b', 'Saya Unit Kerja 3', 'jauh', '2017-04-18', 'unitkerja3@gmail.com', '081515548148', 'Unit Kerja', 4, 'avatar5.png', NULL, 1),
(7, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'Admin with Super Saiyan Mode', 'Surga', '2017-07-20', 'superadmin@gmail.com', '085649411233', 'Super Admin', 5, 'saiyan.png', NULL, 1),
(8, NULL, NULL, NULL, NULL, NULL, 'drak_nes@yahoo.com', NULL, NULL, 0, NULL, 'xxx', 0);

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
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `ID_PENAWARAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `ID_PENYELENGGARA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tender`
--
ALTER TABLE `tender`
  MODIFY `ID_TENDER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `ID_UNITKERJA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
