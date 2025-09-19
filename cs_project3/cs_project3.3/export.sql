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
-- Table structure for table `export`
--

CREATE TABLE `export` (
  `Export_ID` int(3) NOT NULL,
  `Export_Date_Record` datetime NOT NULL DEFAULT current_timestamp(),
  `Export_Date` datetime NOT NULL,
  `Export_Amount` int(3) NOT NULL,
  `Export_Details` varchar(200) DEFAULT NULL,
  `Export_Delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `export`
--

INSERT INTO `export` (`Export_ID`, `Export_Date_Record`, `Export_Date`, `Export_Amount`, `Export_Details`, `Export_Delete`) VALUES
(2, '2025-08-28 20:13:38', '2025-08-28 17:30:00', 4, 'ทดสอบการแก้ไขข้อมูลการนำออก โดยไม่แก้สายพันธุ์และจำนวน', 0),
(3, '2025-08-29 12:37:29', '2025-08-28 20:15:00', 3, 'ทดสอบการเปลี่ยนสายพันธุ์', 1),
(4, '2025-08-29 12:36:48', '2025-08-28 22:00:00', 2, 'ทำสอบการรีเฟรชหน้า 2', 1),
(5, '2025-09-05 14:33:07', '2025-09-05 14:32:00', 2, '', 0),
(6, '2025-09-05 16:30:11', '2025-09-05 16:30:00', 1, '', 0);

--
-- Triggers `export`
--
DELIMITER $$
CREATE TRIGGER `update_export_date` BEFORE UPDATE ON `export` FOR EACH ROW BEGIN
    SET NEW.Export_Date_Record = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `export`
--
ALTER TABLE `export`
  ADD PRIMARY KEY (`Export_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `export`
--
ALTER TABLE `export`
  MODIFY `Export_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
