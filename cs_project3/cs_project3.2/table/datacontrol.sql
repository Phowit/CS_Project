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
-- Table structure for table `datacontrol`
--

CREATE TABLE `datacontrol` (
  `DateControl_ID` int(3) NOT NULL,
  `Temperature_range` int(2) NOT NULL,
  `TimeFoodS` datetime NOT NULL,
  `TimeWater` time NOT NULL,
  `FoodTray_rang` int(2) NOT NULL,
  `TimeFood_1` int(2) NOT NULL,
  `TimeFood_2` int(2) NOT NULL,
  `TimeFood_3` int(2) NOT NULL,
  `Admin_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `datacontrol`
--

INSERT INTO `datacontrol` (`DateControl_ID`, `Temperature_range`, `TimeFoodS`, `TimeWater`, `FoodTray_rang`, `TimeFood_1`, `TimeFood_2`, `TimeFood_3`, `Admin_ID`) VALUES
(1, 25, '2024-11-14 08:30:00', '10:00:00', 1, 10, 20, 30, 16),
(2, 26, '2024-11-14 09:00:00', '10:15:00', 2, 15, 25, 35, 17),
(3, 24, '2024-11-14 09:30:00', '10:30:00', 1, 12, 22, 32, 18),
(4, 27, '2024-11-14 10:00:00', '10:45:00', 2, 18, 28, 38, 19),
(5, 25, '2024-11-14 10:30:00', '11:00:00', 1, 20, 30, 40, 20),
(6, 23, '2024-11-14 11:00:00', '11:15:00', 2, 25, 35, 45, 21),
(7, 28, '2024-11-14 11:30:00', '11:30:00', 1, 22, 32, 42, 22),
(8, 26, '2024-11-14 12:00:00', '11:45:00', 2, 17, 27, 37, 23),
(9, 24, '2024-11-14 12:30:00', '12:00:00', 1, 14, 24, 34, 24),
(10, 25, '2024-11-14 13:00:00', '12:15:00', 2, 19, 29, 39, 25),
(11, 27, '2024-11-14 13:30:00', '12:30:00', 1, 21, 31, 41, 26),
(12, 23, '2024-11-14 14:00:00', '12:45:00', 2, 26, 36, 46, 27),
(13, 26, '2024-11-14 14:30:00', '13:00:00', 1, 23, 33, 43, 28),
(14, 25, '2024-11-14 15:00:00', '13:15:00', 2, 28, 38, 48, 29),
(15, 24, '2024-11-14 15:30:00', '13:30:00', 1, 16, 26, 36, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datacontrol`
--
ALTER TABLE `datacontrol`
  ADD PRIMARY KEY (`DateControl_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datacontrol`
--
ALTER TABLE `datacontrol`
  MODIFY `DateControl_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
