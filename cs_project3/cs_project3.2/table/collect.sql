-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 02:14 PM
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
  `Breed_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `collect`
--

INSERT INTO `collect` (`Collect_ID`, `Collect_Date`, `EggAmount`, `Breed_ID`) VALUES
(1, '2024-12-15 12:42:00', 20, 1),
(2, '2024-11-02 09:15:00', 15, 2),
(3, '2024-11-03 10:05:00', 23, 1),
(4, '2024-11-04 11:20:00', 18, 2),
(5, '2024-11-05 08:45:00', 21, 3),
(6, '2024-11-06 09:30:00', 25, 2),
(7, '2024-11-07 10:10:00', 19, 3),
(8, '2024-11-08 08:20:00', 16, 2),
(9, '2024-11-09 09:55:00', 22, 3),
(10, '2024-11-10 10:35:00', 17, 2),
(11, '2024-11-11 08:40:00', 20, 3),
(12, '2024-11-12 09:25:00', 14, 12),
(13, '2024-11-13 10:15:00', 26, 1),
(14, '2024-11-14 11:05:00', 19, 12),
(15, '2024-11-15 08:55:00', 22, 14),
(18, '2024-12-12 10:56:00', 30, 3),
(19, '2024-12-11 10:56:00', 10, 2),
(20, '2025-01-03 12:16:07', 50, 1);

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
  MODIFY `Collect_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
