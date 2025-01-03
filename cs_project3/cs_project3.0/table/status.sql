-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 06:37 AM
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
  `ServoMoter` int(1) NOT NULL,
  `BallValve_Tem` int(1) NOT NULL,
  `BallValve_water` int(1) NOT NULL,
  `BallValve_SFood` int(1) NOT NULL,
  `FoodLevel` int(2) NOT NULL,
  `FoodSLevel` int(2) NOT NULL,
  `T_Level` int(2) NOT NULL,
  `FoodTray1` int(2) NOT NULL,
  `FoodTray2` int(2) NOT NULL,
  `DT_record` datetime DEFAULT NULL,
  `Admin_ID` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_ID`, `ServoMoter`, `BallValve_Tem`, `BallValve_water`, `BallValve_SFood`, `FoodLevel`, `FoodSLevel`, `T_Level`, `FoodTray1`, `FoodTray2`, `DT_record`, `Admin_ID`) VALUES
(1, 1, 1, 1, 1, 10, 15, 20, 5, 6, '2024-11-01 08:30:00', 16),
(2, 0, 0, 1, 0, 12, 13, 18, 7, 8, '2024-11-02 09:15:00', 17),
(3, 1, 1, 0, 1, 11, 14, 19, 6, 9, '2024-11-03 10:45:00', 18),
(4, 1, 0, 1, 0, 14, 16, 17, 4, 7, '2024-11-04 11:00:00', 19),
(5, 0, 1, 1, 1, 13, 15, 16, 5, 8, '2024-11-05 14:20:00', 20),
(6, 1, 0, 0, 0, 12, 13, 15, 6, 9, '2024-11-06 15:35:00', 21),
(7, 0, 1, 1, 1, 15, 16, 18, 7, 8, '2024-11-07 16:50:00', 22),
(8, 1, 1, 1, 0, 11, 12, 14, 4, 5, '2024-11-08 18:05:00', 23),
(9, 1, 0, 0, 1, 10, 13, 15, 6, 7, '2024-11-09 19:10:00', 24),
(10, 0, 1, 1, 0, 13, 14, 19, 8, 9, '2024-11-10 20:25:00', 25),
(11, 1, 0, 1, 1, 12, 15, 17, 5, 6, '2024-11-11 21:30:00', 26),
(12, 0, 1, 0, 1, 14, 16, 18, 7, 8, '2024-11-12 22:45:00', 27),
(13, 1, 1, 1, 0, 15, 17, 19, 6, 5, '2024-11-13 23:55:00', 28),
(14, 0, 0, 1, 1, 13, 14, 15, 4, 6, '2024-11-14 07:05:00', 29),
(15, 1, 1, 0, 0, 12, 13, 17, 8, 9, '2024-11-15 06:15:00', 30);

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
  MODIFY `status_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
