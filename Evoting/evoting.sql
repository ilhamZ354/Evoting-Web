-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221022.e89ebe179c
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 01:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE `calon` (
  `nomor` int(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `foto` text NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`nomor`, `nama`, `visi`, `misi`, `foto`, `total`) VALUES
(1, 'SOPO & JARWO', 'KUAT, HEBAT DAN INOVATIF', 'SIAP MAJU BANGKIT BERSAMA', 'calon.jpeg', 0),
(2, 'UPIN & IPIN', 'LUCU, BERKARAKTER, SEMANGAT DAN CERIA', 'MENUMBUHKAN KEAKRABAN KEBERSAMAAN', 'calon.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `hak_akses` varchar(10) NOT NULL,
  `pilihan` int(5) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `nama`, `password`, `hak_akses`, `pilihan`, `status`) VALUES
(1, '5551', 'RADIT', '123', 'admin', 0, 'open'),
(2, '6661', 'ILHAM', '321', 'user', 2, 'closed'),
(3, '6662', 'BUDI', '321', 'user', 0, 'open');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
