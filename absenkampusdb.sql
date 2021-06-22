-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2017 at 03:48 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenkampusdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `limit_absen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`limit_absen`) VALUES
('10'),
('10');

-- --------------------------------------------------------

--
-- Table structure for table `data_absen_dosen`
--

CREATE TABLE `data_absen_dosen` (
  `id_data` int(10) NOT NULL,
  `id_jadwal` varchar(10) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_absen_mhs`
--

CREATE TABLE `data_absen_mhs` (
  `id_data` int(10) NOT NULL,
  `id_jadwal` varchar(10) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nid` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `photo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nid`, `nama`, `umur`, `photo`) VALUES
('0123', 'Faty GN', '32', '0123.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kuliah`
--

CREATE TABLE `jadwal_kuliah` (
  `id_jadwal` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `kode_kelas` varchar(10) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `kode_mata_kuliah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_kuliah`
--

INSERT INTO `jadwal_kuliah` (`id_jadwal`, `tanggal`, `jam_mulai`, `kode_jurusan`, `kode_kelas`, `nid`, `semester`, `kode_mata_kuliah`) VALUES
(3, '2013-08-13', '23:57:00', '1', '1', '0123', '3', '1'),
(4, '2013-11-06', '01:18:00', '1', '1', '0123', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `kode_jurusan` int(10) NOT NULL,
  `nama_jurusan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
(1, 'Komputer Akuntansi');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kode_kelas` int(10) NOT NULL,
  `nama_kelas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`) VALUES
(1, 'MI1A');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(20) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `umur` varchar(10) NOT NULL,
  `kode_jurusan` varchar(10) NOT NULL,
  `photo` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `umur`, `kode_jurusan`, `photo`) VALUES
('123', 'Mariati', '23', '1', '123.jpg'),
('22872', 'Bagus Dwiky Wicaksono', '16', '1', '22872.');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kode_mata_kuliah` int(10) NOT NULL,
  `nama_mata_kuliah` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kode_mata_kuliah`, `nama_mata_kuliah`) VALUES
(1, 'Sistem Basis Data');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `login_hash` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`username`, `password`, `login_hash`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'administrator'),
('bagus', '21232f297a57a5a743894a0e4a801fc3', 'akademik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_absen_dosen`
--
ALTER TABLE `data_absen_dosen`
  ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `data_absen_mhs`
--
ALTER TABLE `data_absen_mhs`
  ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`kode_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kode_kelas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kode_mata_kuliah`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_absen_dosen`
--
ALTER TABLE `data_absen_dosen`
  MODIFY `id_data` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_absen_mhs`
--
ALTER TABLE `data_absen_mhs`
  MODIFY `id_data` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jadwal_kuliah`
--
ALTER TABLE `jadwal_kuliah`
  MODIFY `id_jadwal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `kode_jurusan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kode_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `kode_mata_kuliah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
