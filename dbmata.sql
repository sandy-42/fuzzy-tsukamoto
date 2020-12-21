-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2020 at 09:59 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmata`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbobot`
--

CREATE TABLE `tblbobot` (
  `id` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `bobot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbobot`
--

INSERT INTO `tblbobot` (`id`, `class`, `bobot`) VALUES
(1, 'iya', '7'),
(2, 'tidak', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tblgejala`
--

CREATE TABLE `tblgejala` (
  `id` int(11) NOT NULL,
  `gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgejala`
--

INSERT INTO `tblgejala` (`id`, `gejala`) VALUES
(3, ' Mata merah'),
(4, ' Penderita diabetes'),
(5, 'Memiliki tekanan darah tinggi'),
(6, ' Terlalu sering melihat matahari langsung'),
(7, ' Nyeri pada mata'),
(8, ' Sakit kepala'),
(9, ' Melihat bayangan lingkaran di sekitar cahaya'),
(10, ' Penglihatan kabur'),
(11, ' Mata terasa terang');

-- --------------------------------------------------------

--
-- Table structure for table `tblsolusi`
--

CREATE TABLE `tblsolusi` (
  `id` int(11) NOT NULL,
  `penyakit` varchar(50) NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsolusi`
--

INSERT INTO `tblsolusi` (`id`, `penyakit`, `solusi`) VALUES
(8, 'Katarak', ' Pada konjungtivitis Antibiotik tunggal seperti gentamisisn,\r\nkloramfenikol, polimiksin dan sebagainya selama 3-5 hari\r\natau tetes mata antibiotik spektrum tiap jam disertai salep\r\nmata 4-5 kali sehari\r\n'),
(9, 'Glukoma', ' Pada keratitis dapat diberikan gentamisin 15 mg/ml,\r\ntobramisisn 15 mg/ml. Perlu juga diberikan sikloplegik untuk\r\nmenghindari terbentuknya sinekia posterior dan mengurangi\r\nnyeri.'),
(10, 'Kelainan Refraksi', ' Pada uveitis diberikan steroid tetes mata pada siang hari dan\r\nsalep mata pada malam hari. Dapat dipakai deksametison,\r\nbetametason atau prednisolon selama 1 tetes setiap 5 menit\r\nkemudian diturunkan hingga perhari.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbobot`
--
ALTER TABLE `tblbobot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgejala`
--
ALTER TABLE `tblgejala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsolusi`
--
ALTER TABLE `tblsolusi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblbobot`
--
ALTER TABLE `tblbobot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblgejala`
--
ALTER TABLE `tblgejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblsolusi`
--
ALTER TABLE `tblsolusi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
