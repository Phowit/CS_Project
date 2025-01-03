-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 10:47 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(8) NOT NULL,
  `Admin_Name` varchar(30) NOT NULL,
  `Admin_Password` int(6) NOT NULL,
  `Tel` decimal(10,0) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Program_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_Name`, `Admin_Password`, `Tel`, `Address`, `Email`, `Program_ID`) VALUES
(16, 'John Smith', 123456, 812345678, '123 Main St, Bangkok', 'john.smith@example.com', 20),
(17, 'Jane Doe', 234567, 823456789, '456 Second Ave, Chiang Mai', 'jane.doe@example.com', 20),
(18, 'Alice Brown', 345678, 834567890, '789 Third Blvd, Phuket', 'alice.brown@example.com', 20),
(19, 'Bob White', 456789, 845678901, '101 Fourth St, Pattaya', 'bob.white@example.com', 20),
(20, 'Charlie Black', 567890, 856789012, '202 Fifth Ave, Hat Yai', 'charlie.black@example.com', 20),
(21, 'Emily Green', 678901, 867890123, '303 Sixth St, Korat', 'emily.green@example.com', 20),
(22, 'David Blue', 789012, 878901234, '404 Seventh Blvd, Udon Thani', 'david.blue@example.com', 20),
(23, 'Grace Pink', 890123, 889012345, '505 Eighth Rd, Rayong', 'grace.pink@example.com', 20),
(24, 'Frank Purple', 901234, 890123456, '606 Ninth St, Nonthaburi', 'frank.purple@example.com', 20),
(25, 'Hannah Yellow', 12345, 801234567, '707 Tenth Ave, Chiang Rai', 'hannah.yellow@example.com', 20),
(26, 'Ivy Gray', 123450, 812345067, '808 Eleventh Blvd, Ubon Ratchathani', 'ivy.gray@example.com', 20),
(27, 'Jack Red', 234560, 823456078, '909 Twelfth Rd, Khon Kaen', 'jack.red@example.com', 20),
(28, 'Kenny White', 345670, 834567089, '101 Thirteenth St, Samut Prakan', 'kenny.white@example.com', 20),
(29, 'Laura Blue', 456780, 845678090, '202 Fourteenth Ave, Songkhla', 'laura.blue@example.com', 20),
(30, 'Mike Orange', 567890, 856789001, '303 Fifteenth Blvd, Ayutthaya', 'mike.orange@example.com', 20);

-- --------------------------------------------------------

--
-- Table structure for table `chickendata`
--

CREATE TABLE `chickendata` (
  `Set_ID` int(3) NOT NULL,
  `Date_in` date NOT NULL,
  `Gene` varchar(20) NOT NULL,
  `Amount` int(2) NOT NULL,
  `Admin_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chickendata`
--

INSERT INTO `chickendata` (`Set_ID`, `Date_in`, `Gene`, `Amount`, `Admin_ID`) VALUES
(1, '2024-10-01', 'Rhode Island Red', 25, 16),
(2, '2024-10-02', 'Leghorn', 30, 17),
(3, '2024-10-03', 'Sussex', 20, 18),
(4, '2024-10-04', 'Orpington', 18, 19),
(5, '2024-10-05', 'Brahma', 22, 20),
(6, '2024-10-06', 'Australorp', 24, 21),
(7, '2024-10-07', 'Plymouth Rock', 27, 22),
(8, '2024-10-08', 'Wyandotte', 19, 23),
(9, '2024-10-09', 'Ancona', 26, 24),
(10, '2024-10-10', 'Faverolles', 28, 25),
(11, '2024-10-11', 'Marans', 23, 26),
(12, '2024-10-12', 'Cochin', 21, 27),
(13, '2024-10-13', 'Silkie', 29, 28),
(14, '2024-10-14', 'Sebright', 20, 29),
(15, '2024-10-15', 'Naked Neck', 22, 30);

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

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `Faculty_ID` int(3) NOT NULL,
  `Faculty_Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gene`
--

CREATE TABLE `gene` (
  `Gene_ID` int(3) NOT NULL,
  `Gene_Name` varchar(30) NOT NULL,
  `Description` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gene`
--

INSERT INTO `gene` (`Gene_ID`, `Gene_Name`, `Description`) VALUES
(1, 'สายพันธุ์ A', 'ไก่ไข่ที่มีอัตราการวางไข่สูง และต้านทานโรคได้ดี'),
(2, 'สายพันธุ์ B', 'ไก่ไข่ที่ปรับตัวได้ดีกับสภาพอากาศร้อน เหมาะสำหรับพื้นที่เขตร้อน'),
(3, 'สายพันธุ์ C', 'ไก่ไข่ที่มีไข่ขนาดใหญ่ เนื้อไข่แดงมีคุณค่าทางโภชนาการสูง'),
(4, 'สายพันธุ์ D', 'ไก่ไข่ที่สามารถเลี้ยงในระบบปิดได้ดี มีอัตราการรอดสูง'),
(5, 'สายพันธุ์ E', 'ไก่ไข่ที่เจริญเติบโตเร็ว วางไข่ได้ตั้งแต่อายุยังน้อย'),
(6, 'สายพันธุ์ F', 'ไก่ไข่ที่มีเปลือกไข่หนา ป้องกันไข่แตกได้ดีในระหว่างการขนส่ง'),
(7, 'สายพันธุ์ G', 'ไก่ไข่ที่มีลักษณะเชื่องง่าย เหมาะสำหรับเลี้ยงในครัวเรือน'),
(8, 'สายพันธุ์ H', 'ไก่ไข่ที่มีอายุการวางไข่นานกว่า 2 ปี และมีประสิทธิภาพในการผลิตไข่สูง'),
(9, 'สายพันธุ์ I', 'ไก่ไข่ที่ให้ไข่สีเข้มสวยงาม เป็นที่ต้องการของตลาด'),
(10, 'สายพันธุ์ J', 'ไก่ไข่ที่มีอัตราการเจริญเติบโตดี ต้านทานโรคได้หลายชนิด'),
(11, 'สายพันธุ์ K', 'ไก่ไข่ที่ใช้เวลาน้อยในการเจริญเติบโต เหมาะสำหรับฟาร์มเชิงพาณิชย์'),
(12, 'สายพันธุ์ L', 'ไก่ไข่ที่ให้ไข่ขนาดกลาง รสชาติไข่ดี เหมาะสำหรับการบริโภคสด'),
(13, 'สายพันธุ์ M', 'ไก่ไข่ที่ให้ผลผลิตไข่สูงสุดในช่วงฤดูหนาว เหมาะสำหรับเลี้ยงในพื้นที่หนาวเย็น'),
(14, 'สายพันธุ์ N', 'ไก่ไข่ที่มีระบบภูมิคุ้มกันแข็งแรง สามารถทนต่อสภาพแวดล้อมต่างๆ ได้ดี'),
(15, 'สายพันธุ์ O', 'ไก่ไข่ที่มีลักษณะเปลือกไข่แข็งแรง น้ำหนักไข่เหมาะสมกับความต้องการตลาด');

-- --------------------------------------------------------

--
-- Table structure for table `harvest`
--

CREATE TABLE `harvest` (
  `Harvest_ID` int(3) NOT NULL,
  `Date_Harvest` datetime NOT NULL,
  `EggAmount` int(3) NOT NULL,
  `Admin_ID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `harvest`
--

INSERT INTO `harvest` (`Harvest_ID`, `Date_Harvest`, `EggAmount`, `Admin_ID`) VALUES
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
(15, '2024-11-15 08:55:00', 122, 30);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `Program_ID` int(3) NOT NULL,
  `ProgramName` varchar(60) NOT NULL,
  `Faculty_ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `DT_record` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_ID`, `ServoMoter`, `BallValve_Tem`, `BallValve_water`, `BallValve_SFood`, `FoodLevel`, `FoodSLevel`, `T_Level`, `FoodTray1`, `FoodTray2`, `DT_record`) VALUES
(1, 1, 1, 1, 1, 10, 15, 20, 5, 6, '2024-11-01 08:30:00'),
(2, 0, 0, 1, 0, 12, 13, 18, 7, 8, '2024-11-02 09:15:00'),
(3, 1, 1, 0, 1, 11, 14, 19, 6, 9, '2024-11-03 10:45:00'),
(4, 1, 0, 1, 0, 14, 16, 17, 4, 7, '2024-11-04 11:00:00'),
(5, 0, 1, 1, 1, 13, 15, 16, 5, 8, '2024-11-05 14:20:00'),
(6, 1, 0, 0, 0, 12, 13, 15, 6, 9, '2024-11-06 15:35:00'),
(7, 0, 1, 1, 1, 15, 16, 18, 7, 8, '2024-11-07 16:50:00'),
(8, 1, 1, 1, 0, 11, 12, 14, 4, 5, '2024-11-08 18:05:00'),
(9, 1, 0, 0, 1, 10, 13, 15, 6, 7, '2024-11-09 19:10:00'),
(10, 0, 1, 1, 0, 13, 14, 19, 8, 9, '2024-11-10 20:25:00'),
(11, 1, 0, 1, 1, 12, 15, 17, 5, 6, '2024-11-11 21:30:00'),
(12, 0, 1, 0, 1, 14, 16, 18, 7, 8, '2024-11-12 22:45:00'),
(13, 1, 1, 1, 0, 15, 17, 19, 6, 5, '2024-11-13 23:55:00'),
(14, 0, 0, 1, 1, 13, 14, 15, 4, 6, '2024-11-14 07:05:00'),
(15, 1, 1, 0, 0, 12, 13, 17, 8, 9, '2024-11-15 06:15:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `chickendata`
--
ALTER TABLE `chickendata`
  ADD PRIMARY KEY (`Set_ID`);

--
-- Indexes for table `datacontrol`
--
ALTER TABLE `datacontrol`
  ADD PRIMARY KEY (`DateControl_ID`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`Faculty_ID`);

--
-- Indexes for table `gene`
--
ALTER TABLE `gene`
  ADD PRIMARY KEY (`Gene_ID`);

--
-- Indexes for table `harvest`
--
ALTER TABLE `harvest`
  ADD PRIMARY KEY (`Harvest_ID`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`Program_ID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `chickendata`
--
ALTER TABLE `chickendata`
  MODIFY `Set_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `datacontrol`
--
ALTER TABLE `datacontrol`
  MODIFY `DateControl_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `Faculty_ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gene`
--
ALTER TABLE `gene`
  MODIFY `Gene_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `harvest`
--
ALTER TABLE `harvest`
  MODIFY `Harvest_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `Program_ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
