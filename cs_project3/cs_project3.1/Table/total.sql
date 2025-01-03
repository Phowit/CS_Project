-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 11:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `total`
--

CREATE TABLE `total` (
  `total_ID` int(3) NOT NULL,
  `total` int(3) NOT NULL,
  `total_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `total`
--

INSERT INTO `total` (`total_ID`, `total`, `total_Date`) VALUES
(1, 150, '2024-06-01 00:00:00'),
(2, 145, '2024-06-02 00:00:00'),
(3, 140, '2024-06-03 00:00:00'),
(4, 135, '2024-06-04 00:00:00'),
(5, 130, '2024-06-05 00:00:00'),
(6, 125, '2024-06-06 00:00:00'),
(7, 120, '2024-06-07 00:00:00'),
(8, 115, '2024-06-08 00:00:00'),
(9, 110, '2024-06-09 00:00:00'),
(10, 105, '2024-06-10 00:00:00'),
(11, 100, '2024-06-11 00:00:00'),
(12, 95, '2024-06-12 00:00:00'),
(13, 90, '2024-06-13 00:00:00'),
(14, 85, '2024-06-14 00:00:00'),
(15, 80, '2024-06-15 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `total`
--
ALTER TABLE `total`
  ADD PRIMARY KEY (`total_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `total`
--
ALTER TABLE `total`
  MODIFY `total_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
