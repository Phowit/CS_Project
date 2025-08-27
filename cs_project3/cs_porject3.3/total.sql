-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 07:44 AM
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
(1, 2, '2025-08-24 14:57:40', 1),
(2, 4, '2025-08-24 14:57:50', 2),
(3, 4, '2025-08-24 14:58:12', 0),
(4, 5, '2025-08-24 17:38:07', 5),
(5, 7, '2025-08-24 17:38:27', 0),
(6, 11, '2025-08-24 17:39:13', 7),
(7, 16, '2025-08-24 21:12:28', 8),
(8, 14, '2025-08-24 21:15:05', 0),
(9, 11, '2025-08-24 22:18:02', 0),
(10, 12, '2025-08-24 22:25:13', 11),
(11, 11, '2025-08-24 22:25:50', 0),
(12, 13, '2025-08-24 22:37:09', 13),
(13, 12, '2025-08-25 14:45:37', 0),
(14, 11, '2025-08-25 14:48:26', 0),
(15, 21, '2025-08-25 21:32:47', 16),
(16, 11, '2025-08-25 21:33:31', 0),
(17, 9, '2025-08-26 22:11:25', 0),
(18, 14, '2025-08-26 22:16:52', 20),
(19, 18, '2025-08-26 22:17:26', 21),
(20, 16, '2025-08-26 22:27:53', 0),
(21, 13, '2025-08-26 22:33:35', 0),
(22, 13, '2025-08-26 22:37:24', 0);

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
  MODIFY `Total_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
