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
-- Table structure for table `export`
--

CREATE TABLE `export` (
  `Export_ID` int(3) NOT NULL,
  `Export_Date_Record` datetime NOT NULL,
  `Export_Date` datetime NOT NULL,
  `Export_Amount` int(3) NOT NULL,
  `Export_Details` varchar(200) DEFAULT NULL,
  `Import_ID` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `export`
--

INSERT INTO `export` (`Export_ID`, `Export_Date_Record`, `Export_Date`, `Export_Amount`, `Export_Details`, `Import_ID`) VALUES
(1, '2024-12-01 08:30:00', '2024-12-01 00:00:00', 5, 'ไก่หมดไข่แล้ว ขายเนื้อเพื่อหารายได้', 1),
(2, '2024-12-02 09:00:00', '2024-12-02 00:00:00', 3, 'ไก่ตายจากโรคระบาด', 2),
(3, '2024-12-03 14:20:00', '2024-12-03 00:00:00', 2, 'ไม่มีงบประมาณเพียงพอสำหรับเลี้ยงดู', 3),
(4, '2024-12-04 10:15:00', '2024-12-04 00:00:00', 5, 'ไก่หมดไข่แล้ว ขายเนื้อ', 4),
(5, '2024-12-05 16:40:00', '2024-12-05 00:00:00', 5, 'ไก่ตายจากงู', 5),
(6, '2024-12-06 11:30:00', '2024-12-06 00:00:00', 6, 'ขายเพราะปรับปรุงโรงเรือน', 6),
(7, '2024-12-07 08:00:00', '2024-12-07 00:00:00', 4, 'ไก่หมดไข่แล้ว ขายเนื้อเพื่อเปลี่ยนรุ่น', 7),
(8, '2024-12-08 13:45:00', '2024-12-08 00:00:00', 5, 'ไม่มีพื้นที่เพียงพอในโรงเรือน', 8),
(9, '2024-12-09 15:10:00', '2024-12-09 00:00:00', 5, 'ไก่ตายจากโรคระบาด', 9),
(10, '2024-12-10 09:50:00', '2024-12-10 00:00:00', 5, 'ขายเพื่อลดต้นทุนการผลิต', 10),
(11, '2024-12-11 07:20:00', '2024-12-11 00:00:00', 3, 'ไก่หมดไข่แล้ว ขายเนื้อ', 11),
(12, '2024-12-12 14:00:00', '2024-12-12 00:00:00', 2, 'ไก่ตายจากอุบัติเหตุในโรงเรือน', 12),
(13, '2024-12-13 11:15:00', '2024-12-13 00:00:00', 4, 'ขายเพื่อเตรียมพื้นที่สำหรับรุ่นใหม่', 13),
(14, '2024-12-14 08:45:00', '2024-12-14 00:00:00', 5, 'ไม่มีงบประมาณสำหรับซื้ออาหารเพิ่ม', 14),
(15, '2024-12-15 10:30:00', '2024-12-15 00:00:00', 25, 'ไก่หมดไข่แล้ว', 15),
(16, '2024-12-16 13:25:00', '2024-12-16 00:00:00', 6, 'ไก่ตายจากความร้อน', 16),
(17, '2024-12-17 09:40:00', '2024-12-17 00:00:00', 5, 'ขายเนื่องจากเปลี่ยนกลยุทธ์', 17),
(18, '2024-12-18 12:10:00', '2024-12-18 00:00:00', 5, 'ไก่หมดไข่แล้ว ขายเพื่อหารายได้', 18),
(19, '2024-12-19 10:55:00', '2024-12-19 00:00:00', 5, 'ขายเพื่อลดจำนวนประชากรไก่', 19),
(20, '2024-12-20 16:00:00', '2024-12-20 00:00:00', 3, 'ไก่ตายจากการขาดน้ำ', 20),
(21, '2024-12-25 12:41:11', '2024-12-25 18:41:11', 3, 'ตาย จากงู', 17);

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
  MODIFY `Export_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
