-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 02:15 PM
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
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `import_ID` int(3) NOT NULL,
  `Import_Date_Record` datetime DEFAULT current_timestamp(),
  `Import_Date` datetime NOT NULL,
  `Breed_ID` int(2) NOT NULL,
  `Import_Amount` int(3) NOT NULL,
  `Import_Details` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `import`
--

INSERT INTO `import` (`import_ID`, `Import_Date_Record`, `Import_Date`, `Breed_ID`, `Import_Amount`, `Import_Details`) VALUES
(1, '2024-12-17 23:00:18', '2024-12-15 14:14:00', 1, 7, 'ทดสอบ การแก้ไขข้อมูลการนำเข้าไก่ไข่ครั้งที่ 4'),
(2, '2024-12-15 15:16:46', '2024-07-01 00:00:00', 1, 4, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(3, '2024-12-14 21:47:47', '2024-07-02 00:00:00', 2, 15, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(4, '2024-12-14 21:47:47', '2024-07-03 00:00:00', 3, 3, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(5, '2024-12-14 21:47:47', '2024-07-04 00:00:00', 1, 12, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(6, '2024-12-14 21:47:47', '2024-07-05 00:00:00', 2, 18, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(7, '2024-12-14 21:47:47', '2024-07-06 00:00:00', 3, 25, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(8, '2024-12-14 21:47:47', '2024-07-07 00:00:00', 1, 14, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(9, '2024-12-14 21:47:47', '2024-07-08 00:00:00', 2, 2, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(10, '2024-12-14 21:47:47', '2024-07-09 00:00:00', 3, 3, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(11, '2024-12-14 21:47:47', '2024-07-10 00:00:00', 1, 22, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(12, '2024-12-14 21:47:47', '2024-07-11 00:00:00', 2, 18, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(13, '2024-12-14 21:47:47', '2024-07-12 00:00:00', 3, 25, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(14, '2024-12-14 21:47:47', '2024-07-13 00:00:00', 1, 16, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(15, '2024-12-14 21:47:47', '2024-07-14 00:00:00', 2, 13, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(16, '2024-12-14 21:47:47', '2024-07-15 00:00:00', 3, 19, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(17, '2024-12-17 22:57:43', '2024-07-16 00:00:00', 1, 20, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(18, '2024-12-14 21:47:47', '2024-07-17 00:00:00', 2, 15, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(19, '2024-12-14 21:47:47', '2024-07-18 00:00:00', 3, 27, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(20, '2024-12-14 21:47:47', '2024-07-19 00:00:00', 1, 23, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(21, '2024-12-14 21:47:47', '2024-07-20 00:00:00', 2, 2, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(24, '2024-12-15 19:52:40', '2024-12-13 19:51:00', 14, 5, 'คนรู้จักมาฝากไว้ 2-3 วัน เป็นตัวผู้เอาไว้ชน'),
(25, '2024-12-17 23:03:55', '2024-12-17 23:02:00', 12, 17, 'ซื้อไก่ไข่สายพันธุ์ แคมพิน มาจากร้านที่รู้จัก เขาแนะนำว่าช่วงนี้เป็นช่วงที่ได้รับความนิยมในการเลี้ยงไก่ไข่แคมพินมาก ทั้งในด้านเลี้ยงเพื่อเกษตรกับการเป็นสัตว์เลี้ยงเล่นๆ');

--
-- Triggers `import`
--
DELIMITER $$
CREATE TRIGGER `update_import_date` BEFORE UPDATE ON `import` FOR EACH ROW BEGIN
    SET NEW.Import_Date_Record = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`import_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `import`
--
ALTER TABLE `import`
  MODIFY `import_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
