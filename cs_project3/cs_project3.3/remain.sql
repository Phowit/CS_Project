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
-- Table structure for table `remain`
--

CREATE TABLE `remain` (
  `Remain_ID` int(3) NOT NULL,
  `Remain_Amount` int(3) NOT NULL,
  `Remain_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Import_ID` int(3) NOT NULL,
  `Export_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `remain`
--

INSERT INTO `remain` (`Remain_ID`, `Remain_Amount`, `Remain_Date`, `Import_ID`, `Export_ID`) VALUES
(6, 10, '2025-08-28 17:34:29', 2, 0),
(7, 6, '2025-08-28 17:34:50', 2, 2),
(8, 5, '2025-08-28 17:35:13', 2, 2),
(9, 6, '2025-08-28 17:44:45', 2, 2),
(10, 5, '2025-08-28 20:14:56', 3, 0),
(11, 2, '2025-08-28 20:16:17', 3, 3),
(12, 5, '2025-08-28 20:19:00', 3, 3),
(13, 3, '2025-08-28 20:19:00', 2, 3),
(14, 1, '2025-08-28 21:55:10', 2, 4),
(15, 3, '2025-08-28 21:56:03', 2, 4),
(16, 3, '2025-08-28 21:56:03', 3, 4),
(17, 2, '2025-08-28 21:56:36', 3, 4),
(18, 5, '2025-08-28 21:57:24', 3, 4),
(19, 1, '2025-08-28 21:57:24', 2, 4),
(20, 2, '2025-08-28 22:00:57', 2, 4),
(21, 3, '2025-08-28 22:01:58', 2, 4),
(22, 3, '2025-08-28 22:01:58', 3, 4),
(23, 1, '2025-08-28 22:33:54', 4, 0),
(24, 0, '2025-08-28 22:34:15', 4, 0),
(25, 1, '2025-08-28 22:34:52', 5, 0),
(26, 3, '2025-08-29 12:17:29', 3, 4),
(27, 3, '2025-08-29 12:18:45', 3, 4),
(28, 5, '2025-08-29 12:36:48', 3, 4),
(29, 6, '2025-08-29 12:37:29', 2, 3),
(30, 4, '2025-09-05 14:33:07', 2, 5),
(31, 9, '2025-09-05 16:28:55', 6, 5),
(32, 4, '2025-09-05 16:29:16', 6, 5),
(33, 3, '2025-09-05 16:30:11', 6, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `remain`
--
ALTER TABLE `remain`
  ADD PRIMARY KEY (`Remain_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `remain`
--
ALTER TABLE `remain`
  MODIFY `Remain_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
