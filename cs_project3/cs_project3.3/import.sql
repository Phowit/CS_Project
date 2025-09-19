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
-- Table structure for table `import`
--

CREATE TABLE `import` (
  `Import_ID` int(3) NOT NULL,
  `Import_Date_Record` datetime DEFAULT current_timestamp(),
  `Import_Date` datetime NOT NULL,
  `Breed_ID` int(2) NOT NULL,
  `Import_Amount` int(3) NOT NULL,
  `Import_Details` varchar(200) NOT NULL,
  `Import_Delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `import`
--

INSERT INTO `import` (`Import_ID`, `Import_Date_Record`, `Import_Date`, `Breed_ID`, `Import_Amount`, `Import_Details`, `Import_Delete`) VALUES
(2, '2025-08-28 17:34:29', '2025-08-28 17:34:00', 1, 10, '', 0),
(3, '2025-08-28 20:14:56', '2025-08-28 20:14:00', 11, 5, '', 0),
(4, '2025-08-29 12:35:43', '2025-08-28 22:33:00', 2, 1, '', 1),
(5, '2025-09-05 14:30:36', '2025-08-28 22:34:00', 10, 1, 'นำเข้ามาเลี้ยงครั้งแรก', 0),
(6, '2025-09-05 16:29:16', '2025-09-05 16:28:00', 1, 5, 'ทดสอบ', 1);

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
  ADD PRIMARY KEY (`Import_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `import`
--
ALTER TABLE `import`
  MODIFY `Import_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
