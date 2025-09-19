-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2025 at 07:07 AM
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
-- Table structure for table `collect`
--

CREATE TABLE `collect` (
  `Collect_ID` int(3) NOT NULL,
  `Collect_Date` datetime NOT NULL,
  `EggAmount` int(3) NOT NULL,
  `User_ID` int(3) NOT NULL,
  `Collect_Delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `collect`
--

INSERT INTO `collect` (`Collect_ID`, `Collect_Date`, `EggAmount`, `User_ID`, `Collect_Delete`) VALUES
(1, '2024-12-15 12:42:00', 20, 1, 0),
(2, '2024-11-02 09:15:00', 15, 1, 0),
(3, '2024-11-03 10:05:00', 23, 1, 0),
(4, '2024-11-04 11:20:00', 18, 1, 0),
(5, '2024-11-05 08:45:00', 21, 1, 0),
(6, '2024-11-06 09:30:00', 25, 1, 0),
(7, '2024-11-07 10:10:00', 19, 1, 0),
(8, '2024-11-08 08:20:00', 16, 1, 0),
(9, '2024-11-09 09:55:00', 22, 1, 0),
(10, '2024-11-10 10:35:00', 17, 1, 0),
(11, '2024-11-11 08:40:00', 20, 1, 0),
(12, '2024-11-12 09:25:00', 14, 1, 0),
(13, '2024-11-13 10:15:00', 26, 1, 0),
(14, '2024-11-14 11:05:00', 19, 1, 0),
(15, '2024-11-15 08:55:00', 22, 1, 0),
(18, '2024-12-12 10:56:00', 30, 1, 0),
(19, '2024-12-11 10:56:00', 10, 1, 0),
(20, '2025-01-03 12:16:07', 50, 1, 0),
(22, '2025-01-28 14:22:00', 20, 1, 0),
(23, '2025-02-01 15:28:00', 5, 1, 0),
(24, '2025-07-10 13:00:00', 5, 1, 0),
(25, '2025-07-10 12:59:00', 7, 1, 0),
(26, '2025-07-10 13:07:00', 4, 1, 0),
(28, '2025-07-10 14:16:00', 10, 1, 0),
(29, '2025-07-14 11:49:00', 10, 1, 0),
(30, '2025-07-14 11:49:00', 10, 1, 0),
(31, '2025-07-15 20:15:00', 5, 1, 0),
(32, '2025-07-17 13:03:00', 3, 1, 0),
(33, '2025-07-17 13:03:00', 7, 1, 0),
(34, '2025-07-17 13:03:00', 2, 1, 0),
(35, '2025-07-23 10:54:00', 6, 1, 0),
(36, '2025-07-23 10:55:00', 4, 1, 0),
(39, '2025-07-25 13:10:00', 87, 1, 0),
(40, '2025-07-30 11:30:00', 3, 1, 0),
(41, '2025-08-04 13:57:00', 3, 1, 1),
(42, '2025-08-04 14:45:00', 4, 1, 0),
(43, '2025-08-04 14:49:00', 3, 16, 0),
(44, '2025-08-04 15:06:00', 2, 16, 0),
(45, '2025-08-04 15:21:00', 2, 16, 0),
(46, '2025-08-04 15:21:00', 2, 16, 0),
(48, '2025-08-08 16:01:00', 2, 16, 1),
(49, '2025-08-08 16:48:00', 1, 16, 1),
(50, '2025-08-08 16:59:00', 1, 1, 1),
(51, '2025-08-08 17:01:00', 1, 1, 1),
(52, '2025-08-13 14:31:00', 1, 16, 1),
(53, '2025-08-13 19:00:00', 2, 1, 1),
(54, '2025-08-27 15:17:00', 2, 16, 0),
(55, '2025-09-05 14:00:00', 3, 16, 0),
(56, '2025-09-05 16:00:00', 2, 48, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collect`
--
ALTER TABLE `collect`
  ADD PRIMARY KEY (`Collect_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collect`
--
ALTER TABLE `collect`
  MODIFY `Collect_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
