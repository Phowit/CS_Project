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
-- Table structure for table `datacontrol`
--

CREATE TABLE `datacontrol` (
  `DateControl_ID` int(11) NOT NULL,
  `Temperature_range` int(2) NOT NULL,
  `TimeFoodS` datetime NOT NULL,
  `DC_Motor` tinyint(1) NOT NULL,
  `DC_BV_Tem` tinyint(1) NOT NULL,
  `DC_BV_Water` tinyint(1) NOT NULL,
  `DC_BV_FoodS` tinyint(1) NOT NULL,
  `User_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `datacontrol`
--

INSERT INTO `datacontrol` (`DateControl_ID`, `Temperature_range`, `TimeFoodS`, `DC_Motor`, `DC_BV_Tem`, `DC_BV_Water`, `DC_BV_FoodS`, `User_ID`) VALUES
(1, 25, '2025-08-29 13:00:00', 0, 0, 0, 0, 1),
(16, 25, '0000-00-00 00:00:00', 1, 0, 0, 0, 0),
(17, 25, '0000-00-00 00:00:00', 0, 0, 0, 0, 0),
(18, 25, '2025-09-19 13:44:19', 1, 0, 0, 0, 1),
(19, 25, '2025-09-19 13:44:19', 0, 0, 0, 0, 1),
(20, 25, '2025-09-19 13:44:19', 1, 0, 0, 0, 1),
(21, 30, '2025-09-19 13:44:19', 0, 0, 0, 0, 1),
(22, 30, '2025-09-19 13:44:19', 1, 0, 0, 0, 1),
(23, 30, '2025-09-19 13:44:19', 1, 0, 1, 0, 1),
(24, 30, '2025-09-19 13:44:19', 1, 0, 0, 0, 1),
(25, 30, '2025-09-19 13:44:19', 1, 0, 1, 0, 1),
(26, 30, '2025-09-19 13:44:19', 1, 1, 1, 0, 1),
(27, 30, '2025-09-19 13:44:19', 1, 0, 1, 0, 1),
(28, 30, '2025-09-19 13:44:19', 1, 1, 1, 0, 1),
(29, 30, '2025-09-19 13:44:19', 1, 1, 1, 1, 1),
(30, 30, '2025-09-19 13:44:19', 1, 1, 1, 0, 1),
(31, 30, '2025-09-19 13:44:19', 1, 1, 1, 1, 1),
(32, 30, '2025-09-19 13:44:19', 0, 1, 1, 1, 1),
(33, 30, '2025-09-19 13:44:19', 0, 1, 0, 1, 1),
(34, 30, '2025-09-19 13:44:19', 0, 0, 0, 1, 1),
(35, 25, '2025-09-19 13:44:19', 0, 0, 0, 0, 1);

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
  MODIFY `DateControl_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
