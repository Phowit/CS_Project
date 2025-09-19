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
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_ID` int(3) NOT NULL,
  `FoodLevel` int(2) NOT NULL,
  `FoodSLevel` int(2) NOT NULL,
  `T_Level` int(2) NOT NULL,
  `FoodTray1` int(2) NOT NULL,
  `FoodTray2` int(2) NOT NULL,
  `DT_record` datetime DEFAULT current_timestamp(),
  `DateControl_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_ID`, `FoodLevel`, `FoodSLevel`, `T_Level`, `FoodTray1`, `FoodTray2`, `DT_record`, `DateControl_ID`) VALUES
(1, 0, 1, 28, 11, 0, '2025-09-08 22:04:44', 0),
(2, 9, 2, 28, 9, 7, '2025-09-08 22:19:44', 0),
(3, 9, 2, 28, 9, 6, '2025-09-08 22:34:44', 0),
(4, 8, 2, 28, 9, 7, '2025-09-08 22:49:44', 0),
(5, 9, 2, 28, 7, 7, '2025-09-08 23:04:44', 0),
(6, 9, 2, 28, 7, 7, '2025-09-08 23:19:44', 0),
(7, 9, 2, 28, 7, 6, '2025-09-08 23:34:45', 0),
(8, 9, 2, 28, 10, 6, '2025-09-08 23:49:45', 0),
(9, 9, 1, 28, 7, 6, '2025-09-09 00:04:45', 0),
(10, 0, 0, 31, 99, 0, '2025-09-09 15:44:43', 0),
(11, 0, 0, 30, 0, 0, '2025-09-09 16:32:21', 0),
(12, 0, 0, 29, 0, 0, '2025-09-09 16:47:21', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
