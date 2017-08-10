-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2017 at 11:09 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `penyelenggara`
--

CREATE TABLE `penyelenggara` (
  `ID_PENYELENGGARA` int(11) NOT NULL,
  `NAMA_PENYELENGGARA` text,
  `ALAMAT` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `ID_PENAWARAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `ID_PENYELENGGARA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tender`
--
ALTER TABLE `tender`
  MODIFY `ID_TENDER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
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
