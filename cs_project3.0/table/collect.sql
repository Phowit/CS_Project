-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 06:36 AM
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
  `User_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `collect`
--

INSERT INTO `collect` (`Collect_ID`, `Collect_Date`, `EggAmount`, `User_ID`) VALUES
(1, '2024-11-01 08:30:00', 120, 16),
(2, '2024-11-02 09:15:00', 115, 17),
(3, '2024-11-03 10:05:00', 123, 18),
(4, '2024-11-04 11:20:00', 118, 19),
(5, '2024-11-05 08:45:00', 121, 20),
(6, '2024-11-06 09:30:00', 125, 21),
(7, '2024-11-07 10:10:00', 119, 22),
(8, '2024-11-08 08:20:00', 116, 23),
(9, '2024-11-09 09:55:00', 122, 24),
(10, '2024-11-10 10:35:00', 117, 25),
(11, '2024-11-11 08:40:00', 120, 26),
(12, '2024-11-12 09:25:00', 114, 27),
(13, '2024-11-13 10:15:00', 126, 28),
(14, '2024-11-14 11:05:00', 119, 29),
(15, '2024-11-15 08:55:00', 122, 30),
(18, '2024-12-12 10:56:00', 30, 16),
(19, '2024-12-11 10:56:00', 10, 16);

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
  MODIFY `Collect_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
