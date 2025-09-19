-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2025 at 07:08 AM
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
  `Total_ID` int(3) NOT NULL,
  `Total` int(3) NOT NULL,
  `Total_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Remain_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `total`
--

INSERT INTO `total` (`Total_ID`, `Total`, `Total_Date`, `Remain_ID`) VALUES
(5, 10, '2025-08-28 17:34:29', 6),
(6, 6, '2025-08-28 17:34:50', 0),
(7, 5, '2025-08-28 17:35:13', 0),
(8, 6, '2025-08-28 17:44:45', 0),
(9, 11, '2025-08-28 20:14:56', 10),
(10, 8, '2025-08-28 20:16:17', 0),
(11, 8, '2025-08-28 20:19:00', 0),
(12, 6, '2025-08-28 21:55:10', 0),
(13, 6, '2025-08-28 21:56:03', 0),
(14, 5, '2025-08-28 21:56:36', 0),
(15, 6, '2025-08-28 21:57:24', 0),
(16, 7, '2025-08-28 22:00:57', 0),
(17, 6, '2025-08-28 22:01:58', 0),
(18, 7, '2025-08-28 22:33:54', 23),
(19, 6, '2025-08-28 22:34:15', 0),
(20, 7, '2025-08-28 22:34:52', 25),
(21, 7, '2025-08-29 12:17:29', 0),
(22, 9, '2025-08-29 12:18:45', 0),
(23, 9, '2025-08-29 12:36:48', 0),
(24, 12, '2025-08-29 12:37:29', 0),
(25, 10, '2025-09-05 14:33:07', 0),
(26, 15, '2025-09-05 16:28:55', 31),
(27, 10, '2025-09-05 16:29:16', 0),
(28, 9, '2025-09-05 16:30:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `total`
--
ALTER TABLE `total`
  ADD PRIMARY KEY (`Total_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `total`
--
ALTER TABLE `total`
  MODIFY `Total_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
