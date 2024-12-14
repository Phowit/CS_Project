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
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `Import_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Import_Date_Record` datetime DEFAULT NULL,
  `Import_Date` date DEFAULT NULL,
  `Breed_ID` int(11) DEFAULT NULL,
  `Import_Amount` int(11) DEFAULT NULL,
  `Import_Details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `import`
--

INSERT INTO `import` (`Import_ID`, `User_ID`, `Import_Date_Record`, `Import_Date`, `Breed_ID`, `Import_Amount`, `Import_Details`) VALUES
(1, 16, '2024-07-01 08:00:00', '2024-07-01', 1, 2, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(2, 17, '2024-07-02 09:15:00', '2024-07-02', 2, 15, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(3, 18, '2024-07-03 10:30:00', '2024-07-03', 3, 3, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(4, 19, '2024-07-04 07:45:00', '2024-07-04', 1, 12, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(5, 20, '2024-07-05 11:00:00', '2024-07-05', 2, 18, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(6, 21, '2024-07-06 08:30:00', '2024-07-06', 3, 25, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(7, 22, '2024-07-07 09:00:00', '2024-07-07', 1, 14, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(8, 23, '2024-07-08 10:15:00', '2024-07-08', 2, 2, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(9, 24, '2024-07-09 11:45:00', '2024-07-09', 3, 3, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(10, 25, '2024-07-10 08:20:00', '2024-07-10', 1, 22, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(11, 26, '2024-07-11 09:35:00', '2024-07-11', 2, 18, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(12, 27, '2024-07-12 10:45:00', '2024-07-12', 3, 25, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(13, 28, '2024-07-13 11:50:00', '2024-07-13', 1, 16, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(14, 29, '2024-07-14 07:50:00', '2024-07-14', 2, 13, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(15, 30, '2024-07-15 08:10:00', '2024-07-15', 3, 19, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(16, 16, '2024-07-16 09:25:00', '2024-07-16', 1, 21, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(17, 17, '2024-07-17 10:30:00', '2024-07-17', 2, 15, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น'),
(18, 18, '2024-07-18 11:40:00', '2024-07-18', 3, 27, 'นำเข้าไก่ไข่สายพันธุ์บาร์พลีมัทร็อค'),
(19, 19, '2024-07-19 08:35:00', '2024-07-19', 1, 23, 'นำเข้าไก่ไข่สายพันธุ์โร้ดไอแลนด์'),
(20, 20, '2024-07-20 09:45:00', '2024-07-20', 2, 2, 'นำเข้าไก่ไข่สายพันธุ์เล็กฮอร์น');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `import`
--
ALTER TABLE `import`
  ADD PRIMARY KEY (`Import_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
