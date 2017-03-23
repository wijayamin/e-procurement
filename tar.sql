-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2017 at 12:37 PM
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
  `UNIT_KERJA` text,
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
  `KETERANGAN` text,
  `UPLOAD` text,
  `TGL_MULAI` datetime DEFAULT NULL,
  `TGL_SELESAI` datetime DEFAULT NULL,
  `TGL_UPLOAD` datetime DEFAULT NULL,
  `MANAJER_APPROVAL` int(11) DEFAULT NULL,
  `DIREKTUR_APPROVAL` int(11) DEFAULT NULL,
  `TGL_PENGUMPULAN` datetime DEFAULT NULL,
  `NOTIFIKASI` longtext,
  `RKS` text,
  `BERITA_ACARA` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `PREVILEDGE` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`, `ALAMAT`, `TANGGAL_LAHIR`, `EMAIL`, `TELEFON`, `JABATAN`, `PREVILEDGE`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'saya admin', 'jauh', '2017-03-01 00:00:00', 'ryanhadiw@gmail.com', '082140177480', 'Administrasi', 1);

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
  MODIFY `ID_DOKUMEN_MASTER` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dokumen_tender`
--
ALTER TABLE `dokumen_tender`
  MODIFY `ID_DOKUMEN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penawaran`
--
ALTER TABLE `penawaran`
  MODIFY `ID_PENAWARAN` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `penyelenggara`
--
ALTER TABLE `penyelenggara`
  MODIFY `ID_PENYELENGGARA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tender`
--
ALTER TABLE `tender`
  MODIFY `ID_TENDER` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `ID_UNITKERJA` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
