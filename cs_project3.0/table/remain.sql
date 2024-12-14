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
-- Table structure for table `remain`
--

CREATE TABLE `remain` (
  `remain_ID` int(3) NOT NULL,
  `Remain_Amount` int(3) NOT NULL,
  `Remain_Date` date NOT NULL,
  `total_ID` int(3) DEFAULT NULL,
  `Breed_ID` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `remain`
--

INSERT INTO `remain` (`remain_ID`, `Remain_Amount`, `Remain_Date`, `total_ID`, `Breed_ID`) VALUES
(1, 12, '2024-06-01', 1, 1),
(2, 85, '2024-06-01', 2, 2),
(3, 95, '2024-06-02', 3, 3),
(4, 1, '2024-06-03', 4, 1),
(5, 75, '2024-06-03', 5, 2),
(6, 11, '2024-06-04', 6, 3),
(7, 65, '2024-06-04', 7, 1),
(8, 9, '2024-06-05', 8, 2),
(9, 8, '2024-06-05', 9, 3),
(10, 115, '2024-06-06', 10, 1),
(11, 7, '2024-06-06', 11, 2),
(12, 15, '2024-06-07', 12, 3),
(13, 6, '2024-06-07', 13, 1),
(14, 95, '2024-06-08', 14, 2),
(15, 85, '2024-06-08', 15, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `remain`
--
ALTER TABLE `remain`
  ADD PRIMARY KEY (`remain_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
