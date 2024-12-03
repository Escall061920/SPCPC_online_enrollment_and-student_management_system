-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 06:43 PM
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
-- Database: `dbgreenvalley`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_NAME` varchar(30) NOT NULL,
  `COURSE_LEVEL` varchar(50) NOT NULL DEFAULT '1',
  `COURSE_MAJOR` varchar(30) NOT NULL DEFAULT 'None',
  `COURSE_DESC` varchar(255) NOT NULL,
  `DEPT_ID` int(11) NOT NULL,
  `SETSEMESTER` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`COURSE_ID`, `COURSE_NAME`, `COURSE_LEVEL`, `COURSE_MAJOR`, `COURSE_DESC`, `DEPT_ID`, `SETSEMESTER`) VALUES
(1, 'BSIT', '3', 'Computer Programming', 'Bachelor of Science in Information Technology', 33, 'First'),
(2, 'BSIT', '4', 'Computer Programming', 'Bachelor of Science in Information Technology', 33, 'First'),
(3, 'BSBAD', '3', 'Accounting', 'Bachelor of Science in Business Administration', 34, 'First'),
(4, 'BSBAD', '4', 'Accounting', 'Bachelor of Science in Business Administration', 34, 'First'),
(5, 'BSIS', '2', 'Systerm Analysis', 'Bachelor of Science in Information System', 35, 'First'),
(65, 'BSTM', '1', 'Tourism Management', 'Bachelor of Science in Tourism Management', 39, ''),
(66, 'BSENTREP', '1', 'Entrepreneurship', 'Bachelor of Science in Entrepreneurship', 37, '');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DEPT_ID` int(11) NOT NULL,
  `DEPARTMENT_NAME` varchar(30) NOT NULL,
  `DEPARTMENT_DESC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DEPT_ID`, `DEPARTMENT_NAME`, `DEPARTMENT_DESC`) VALUES
(33, 'IT', 'Information Technology \r\n'),
(34, 'BAAD', 'Business Accounting and Administration'),
(35, 'IS', 'Information System'),
(37, 'ENTRREP', '              Entrepreneur'),
(39, 'TM', '             Tourism Management\r\n               ');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `GRADE_ID` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `SUBJ_ID` int(11) NOT NULL,
  `FIRST` int(11) NOT NULL,
  `SECOND` int(11) NOT NULL,
  `THIRD` int(11) NOT NULL,
  `FOURTH` int(11) NOT NULL,
  `AVE` float NOT NULL,
  `REMARKS` text NOT NULL,
  `COMMENT` text NOT NULL,
  `SEMS` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`GRADE_ID`, `IDNO`, `SUBJ_ID`, `FIRST`, `SECOND`, `THIRD`, `FOURTH`, `AVE`, `REMARKS`, `COMMENT`, `SEMS`) VALUES
(1522, 1000000207, 346, 87, 88, 90, 92, 89.8, 'Passed', '', ''),
(1523, 1000000207, 347, 77, 87, 99, 87, 87.4, 'Passed', '', ''),
(1524, 1000000207, 348, 66, 77, 70, 89, 78.2, 'Passed', '', ''),
(1525, 1000000207, 349, 75, 74, 0, 80, 61.8, 'Failed', '', ''),
(1526, 1000000207, 350, 90, 78, 66, 65, 72.8, 'Failed', '', ''),
(1527, 1000000207, 351, 88, 89, 87, 66, 79.2, 'Passed', '', ''),
(1528, 1000000207, 352, 90, 98, 66, 87, 85.6, 'Passed', '', ''),
(1529, 1000000209, 352, 0, 0, 0, 0, 0, '', '', 'First'),
(1530, 1000000209, 351, 0, 0, 0, 0, 0, '', '', 'First'),
(1531, 1000000209, 350, 0, 0, 0, 0, 0, '', '', 'First'),
(1532, 1000000209, 349, 0, 0, 0, 0, 0, '', '', 'First'),
(1533, 1000000209, 348, 0, 0, 0, 0, 0, '', '', 'First'),
(1534, 1000000209, 347, 0, 0, 0, 0, 0, '', '', 'First'),
(1535, 1000000209, 346, 0, 0, 0, 0, 0, '', '', 'First'),
(1536, 1000000210, 353, 0, 0, 0, 0, 0, '', '', 'First'),
(1537, 1000000210, 355, 0, 0, 0, 0, 0, '', '', 'First'),
(1538, 1000000210, 357, 0, 0, 0, 0, 0, '', '', 'First'),
(1539, 1000000212, 353, 0, 0, 0, 0, 0, '', '', ''),
(1540, 1000000212, 355, 0, 0, 0, 0, 0, '', '', ''),
(1541, 1000000212, 357, 0, 0, 0, 0, 0, '', '', ''),
(1542, 1000000213, 353, 0, 0, 0, 0, 0, '', '', 'First'),
(1543, 1000000213, 355, 0, 0, 0, 0, 0, '', '', 'First'),
(1544, 1000000213, 357, 0, 0, 0, 0, 0, '', '', 'First'),
(1545, 1000000214, 358, 0, 0, 0, 0, 0, '', '', 'Second'),
(1546, 1000000214, 359, 0, 0, 0, 0, 0, '', '', 'Second'),
(1547, 1000000214, 360, 0, 0, 0, 0, 0, '', '', 'Second'),
(1548, 1000000214, 361, 0, 0, 0, 0, 0, '', '', 'Second'),
(1549, 1000000214, 362, 0, 0, 0, 0, 0, '', '', 'Second'),
(1550, 1000000214, 364, 0, 0, 0, 0, 0, '', '', 'Second'),
(1551, 1000000214, 365, 0, 0, 0, 0, 0, '', '', 'Second'),
(1552, 1000000211, 365, 0, 0, 0, 0, 0, '', '', 'Second'),
(1553, 1000000211, 364, 0, 0, 0, 0, 0, '', '', 'Second'),
(1554, 1000000211, 362, 0, 0, 0, 0, 0, '', '', 'Second'),
(1555, 1000000211, 361, 0, 0, 0, 0, 0, '', '', 'Second'),
(1556, 1000000211, 360, 0, 0, 0, 0, 0, '', '', 'Second'),
(1557, 1000000211, 359, 0, 0, 0, 0, 0, '', '', 'Second'),
(1558, 1000000211, 358, 0, 0, 0, 0, 0, '', '', 'Second'),
(1559, 1000000216, 358, 0, 0, 0, 0, 0, '', '', 'Second'),
(1560, 1000000216, 359, 0, 0, 0, 0, 0, '', '', 'Second'),
(1561, 1000000216, 360, 0, 0, 0, 0, 0, '', '', 'Second'),
(1562, 1000000216, 361, 0, 0, 0, 0, 0, '', '', 'Second'),
(1563, 1000000216, 362, 0, 0, 0, 0, 0, '', '', 'Second'),
(1564, 1000000216, 364, 0, 0, 0, 0, 0, '', '', 'Second'),
(1565, 1000000216, 365, 0, 0, 0, 0, 0, '', '', 'Second'),
(1566, 1000000217, 358, 0, 0, 0, 0, 0, '', '', 'Second'),
(1567, 1000000217, 359, 0, 0, 0, 0, 0, '', '', 'Second'),
(1568, 1000000217, 360, 0, 0, 0, 0, 0, '', '', 'Second'),
(1569, 1000000217, 361, 0, 0, 0, 0, 0, '', '', 'Second'),
(1570, 1000000217, 362, 0, 0, 0, 0, 0, '', '', 'Second'),
(1571, 1000000217, 364, 0, 0, 0, 0, 0, '', '', 'Second'),
(1572, 1000000217, 365, 0, 0, 0, 0, 0, '', '', 'Second'),
(1573, 1000000218, 358, 0, 0, 0, 0, 0, '', '', 'Second'),
(1574, 1000000218, 359, 0, 0, 0, 0, 0, '', '', 'Second'),
(1575, 1000000218, 360, 0, 0, 0, 0, 0, '', '', 'Second'),
(1576, 1000000218, 361, 0, 0, 0, 0, 0, '', '', 'Second'),
(1577, 1000000218, 362, 0, 0, 0, 0, 0, '', '', 'Second'),
(1578, 1000000218, 364, 0, 0, 0, 0, 0, '', '', 'Second'),
(1579, 1000000218, 365, 0, 0, 0, 0, 0, '', '', 'Second');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyr`
--

CREATE TABLE `schoolyr` (
  `SYID` int(11) NOT NULL,
  `AY` varchar(30) NOT NULL,
  `SEMESTER` varchar(20) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `IDNO` int(30) NOT NULL,
  `CATEGORY` varchar(30) NOT NULL DEFAULT 'ENROLLED',
  `DATE_RESERVED` datetime NOT NULL,
  `DATE_ENROLLED` datetime NOT NULL,
  `STATUS` varchar(30) NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schoolyr`
--

INSERT INTO `schoolyr` (`SYID`, `AY`, `SEMESTER`, `COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`) VALUES
(200, '2024-2025', 'First', 1, 1000000203, 'ENROLLED', '2024-09-01 00:00:00', '2024-09-01 00:00:00', 'New'),
(201, '2024-2025', 'First', 1, 1000000204, 'ENROLLED', '2024-09-01 00:00:00', '2024-09-01 00:00:00', 'New'),
(202, '2024-2025', 'First', 1, 1000000205, 'ENROLLED', '2024-09-01 00:00:00', '2024-09-01 00:00:00', 'New'),
(203, '2024-2025', 'First', 1, 1000000206, 'ENROLLED', '2024-09-02 00:00:00', '2024-09-02 00:00:00', 'New'),
(204, '2024-2025', 'First', 5, 1000000207, 'ENROLLED', '2024-09-02 00:00:00', '2024-09-02 00:00:00', 'New'),
(205, '2024-2025', 'First', 1, 1000000208, 'ENROLLED', '2024-09-11 00:00:00', '2024-09-11 00:00:00', 'New'),
(206, '2024-2025', 'First', 1, 1000000209, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(207, '2024-2025', 'First', 1, 1000000209, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(208, '2024-2025', 'First', 1, 1000000209, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(209, '2024-2025', 'First', 1, 1000000209, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(210, '2024-2025', 'First', 1, 1000000209, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(211, '2024-2025', 'First', 1, 1000000209, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(212, '2024-2025', 'First', 1, 1000000209, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(213, '2024-2025', 'First', 2, 1000000210, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(214, '2024-2025', 'First', 2, 1000000210, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(215, '2024-2025', 'First', 2, 1000000210, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(216, '2024-2025', 'First', 2, 1000000212, 'ENROLLED', '2024-11-10 00:00:00', '2024-11-10 00:00:00', 'New'),
(217, '2024-2025', 'First', 2, 1000000213, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(218, '2024-2025', 'First', 2, 1000000213, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(219, '2024-2025', 'First', 2, 1000000213, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(220, '2024-2025', 'Second', 1, 1000000214, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(221, '2024-2025', 'Second', 1, 1000000214, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(222, '2024-2025', 'Second', 1, 1000000214, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(223, '2024-2025', 'Second', 1, 1000000214, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(224, '2024-2025', 'Second', 1, 1000000214, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(225, '2024-2025', 'Second', 1, 1000000214, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(226, '2024-2025', 'Second', 1, 1000000214, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(227, '2024-2025', 'Second', 1, 1000000211, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(228, '2024-2025', 'Second', 1, 1000000211, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(229, '2024-2025', 'Second', 1, 1000000211, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(230, '2024-2025', 'Second', 1, 1000000211, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(231, '2024-2025', 'Second', 1, 1000000211, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(232, '2024-2025', 'Second', 1, 1000000211, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(233, '2024-2025', 'Second', 1, 1000000211, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(234, '2024-2025', 'Second', 1, 1000000216, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(235, '2024-2025', 'Second', 1, 1000000216, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(236, '2024-2025', 'Second', 1, 1000000216, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(237, '2024-2025', 'Second', 1, 1000000216, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(238, '2024-2025', 'Second', 1, 1000000216, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(239, '2024-2025', 'Second', 1, 1000000216, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(240, '2024-2025', 'Second', 1, 1000000216, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(241, '2024-2025', 'Second', 1, 1000000217, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(242, '2024-2025', 'Second', 1, 1000000217, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(243, '2024-2025', 'Second', 1, 1000000217, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(244, '2024-2025', 'Second', 1, 1000000217, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(245, '2024-2025', 'Second', 1, 1000000217, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(246, '2024-2025', 'Second', 1, 1000000217, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(247, '2024-2025', 'Second', 1, 1000000217, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(248, '2024-2025', 'Second', 1, 1000000218, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(249, '2024-2025', 'Second', 1, 1000000218, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(250, '2024-2025', 'Second', 1, 1000000218, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(251, '2024-2025', 'Second', 1, 1000000218, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(252, '2024-2025', 'Second', 1, 1000000218, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(253, '2024-2025', 'Second', 1, 1000000218, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New'),
(254, '2024-2025', 'Second', 1, 1000000218, 'ENROLLED', '2024-11-13 00:00:00', '2024-11-13 00:00:00', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `studentschedule`
--

CREATE TABLE `studentschedule` (
  `CLASS_ID` int(11) NOT NULL,
  `SUBJ_ID` int(11) NOT NULL,
  `schedID` int(11) NOT NULL,
  `AY` varchar(11) NOT NULL,
  `DAY` varchar(20) NOT NULL,
  `C_TIME` varchar(30) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `ROOM` text NOT NULL,
  `CSECTION` varchar(30) NOT NULL DEFAULT 'NONE',
  `COURSE_ID` int(11) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentsubjects`
--

CREATE TABLE `studentsubjects` (
  `STUDSUBJ_ID` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `SUBJ_ID` int(11) NOT NULL,
  `LEVEL` int(11) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL,
  `SY` text NOT NULL,
  `ATTEMP` int(11) NOT NULL,
  `AVERAGE` double NOT NULL,
  `OUTCOME` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `studentsubjects`
--

INSERT INTO `studentsubjects` (`STUDSUBJ_ID`, `IDNO`, `SUBJ_ID`, `LEVEL`, `SEMESTER`, `SY`, `ATTEMP`, `AVERAGE`, `OUTCOME`) VALUES
(1516, 1000000207, 346, 1, 'First', '2024-2025', 1, 89.8, 'Passed'),
(1517, 1000000207, 347, 1, 'First', '2024-2025', 1, 87.4, 'Passed'),
(1518, 1000000207, 348, 1, 'First', '2024-2025', 1, 78.2, 'Passed'),
(1519, 1000000207, 349, 1, 'First', '2024-2025', 1, 61.8, 'Failed'),
(1520, 1000000207, 350, 1, 'First', '2024-2025', 1, 72.8, 'Failed'),
(1521, 1000000207, 351, 1, 'First', '2024-2025', 1, 79.2, 'Passed'),
(1522, 1000000207, 352, 1, 'First', '2024-2025', 1, 85.6, 'Passed'),
(1523, 1000000209, 352, 3, 'First', '2024-2025', 0, 0, ''),
(1524, 1000000209, 351, 3, 'First', '2024-2025', 0, 0, ''),
(1525, 1000000209, 350, 3, 'First', '2024-2025', 0, 0, ''),
(1526, 1000000209, 349, 3, 'First', '2024-2025', 0, 0, ''),
(1527, 1000000209, 348, 3, 'First', '2024-2025', 0, 0, ''),
(1528, 1000000209, 347, 3, 'First', '2024-2025', 0, 0, ''),
(1529, 1000000209, 346, 3, 'First', '2024-2025', 0, 0, ''),
(1530, 1000000210, 353, 4, 'First', '2024-2025', 0, 0, ''),
(1531, 1000000210, 355, 4, 'First', '2024-2025', 0, 0, ''),
(1532, 1000000210, 357, 4, 'First', '2024-2025', 0, 0, ''),
(1533, 1000000212, 353, 1, 'First', '2024-2025', 1, 0, ''),
(1534, 1000000212, 355, 1, 'First', '2024-2025', 1, 0, ''),
(1535, 1000000212, 357, 1, 'First', '2024-2025', 1, 0, ''),
(1536, 1000000213, 353, 4, 'First', '2024-2025', 0, 0, ''),
(1537, 1000000213, 355, 4, 'First', '2024-2025', 0, 0, ''),
(1538, 1000000213, 357, 4, 'First', '2024-2025', 0, 0, ''),
(1539, 1000000214, 358, 3, 'Second', '2024-2025', 0, 0, ''),
(1540, 1000000214, 359, 3, 'Second', '2024-2025', 0, 0, ''),
(1541, 1000000214, 360, 3, 'Second', '2024-2025', 0, 0, ''),
(1542, 1000000214, 361, 3, 'Second', '2024-2025', 0, 0, ''),
(1543, 1000000214, 362, 3, 'Second', '2024-2025', 0, 0, ''),
(1544, 1000000214, 364, 3, 'Second', '2024-2025', 0, 0, ''),
(1545, 1000000214, 365, 3, 'Second', '2024-2025', 0, 0, ''),
(1546, 1000000211, 365, 3, 'Second', '2024-2025', 0, 0, ''),
(1547, 1000000211, 364, 3, 'Second', '2024-2025', 0, 0, ''),
(1548, 1000000211, 362, 3, 'Second', '2024-2025', 0, 0, ''),
(1549, 1000000211, 361, 3, 'Second', '2024-2025', 0, 0, ''),
(1550, 1000000211, 360, 3, 'Second', '2024-2025', 0, 0, ''),
(1551, 1000000211, 359, 3, 'Second', '2024-2025', 0, 0, ''),
(1552, 1000000211, 358, 3, 'Second', '2024-2025', 0, 0, ''),
(1553, 1000000216, 358, 3, 'Second', '2024-2025', 0, 0, ''),
(1554, 1000000216, 359, 3, 'Second', '2024-2025', 0, 0, ''),
(1555, 1000000216, 360, 3, 'Second', '2024-2025', 0, 0, ''),
(1556, 1000000216, 361, 3, 'Second', '2024-2025', 0, 0, ''),
(1557, 1000000216, 362, 3, 'Second', '2024-2025', 0, 0, ''),
(1558, 1000000216, 364, 3, 'Second', '2024-2025', 0, 0, ''),
(1559, 1000000216, 365, 3, 'Second', '2024-2025', 0, 0, ''),
(1560, 1000000217, 358, 3, 'Second', '2024-2025', 0, 0, ''),
(1561, 1000000217, 359, 3, 'Second', '2024-2025', 0, 0, ''),
(1562, 1000000217, 360, 3, 'Second', '2024-2025', 0, 0, ''),
(1563, 1000000217, 361, 3, 'Second', '2024-2025', 0, 0, ''),
(1564, 1000000217, 362, 3, 'Second', '2024-2025', 0, 0, ''),
(1565, 1000000217, 364, 3, 'Second', '2024-2025', 0, 0, ''),
(1566, 1000000217, 365, 3, 'Second', '2024-2025', 0, 0, ''),
(1567, 1000000218, 358, 3, 'Second', '2024-2025', 0, 0, ''),
(1568, 1000000218, 359, 3, 'Second', '2024-2025', 0, 0, ''),
(1569, 1000000218, 360, 3, 'Second', '2024-2025', 0, 0, ''),
(1570, 1000000218, 361, 3, 'Second', '2024-2025', 0, 0, ''),
(1571, 1000000218, 362, 3, 'Second', '2024-2025', 0, 0, ''),
(1572, 1000000218, 364, 3, 'Second', '2024-2025', 0, 0, ''),
(1573, 1000000218, 365, 3, 'Second', '2024-2025', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SUBJ_ID` int(11) NOT NULL,
  `SUBJ_CODE` varchar(30) NOT NULL,
  `SUBJ_DESCRIPTION` varchar(255) NOT NULL,
  `UNIT` int(2) NOT NULL,
  `PRE_REQUISITE` varchar(30) NOT NULL DEFAULT 'None',
  `COURSE_ID` int(11) NOT NULL,
  `AY` varchar(30) NOT NULL,
  `SEMESTER` varchar(20) NOT NULL,
  `PreTaken` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`, `PreTaken`) VALUES
(358, 'IAS101', 'Information Assurance & Security 1', 3, 'None', 1, '', 'Second', 0),
(359, 'SP101', 'Social & Professional issues', 3, 'None', 1, '', 'Second', 0),
(360, 'CC106', 'Application Development & Emerging Technologies ', 3, 'None', 1, '', 'Second', 0),
(361, 'GE9', 'Life and Works of Rizal', 3, 'None', 1, '', 'Second', 0),
(362, 'FIL2 ', 'Filipino sa Iba\'t-Ibang Disiplina', 3, 'None', 1, '', 'Second', 0),
(364, 'SA101', 'System Admin & Maintenance', 3, 'None', 1, '', 'Second', 0),
(365, 'CAP1', 'Capstone 1', 3, 'System Analysis & Design', 1, '', 'Second', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblauto`
--

CREATE TABLE `tblauto` (
  `ID` int(11) NOT NULL,
  `autocode` varchar(255) DEFAULT NULL,
  `autoname` varchar(255) DEFAULT NULL,
  `appendchar` varchar(255) DEFAULT NULL,
  `autostart` int(11) DEFAULT 0,
  `autoend` int(11) DEFAULT 0,
  `incrementvalue` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblauto`
--

INSERT INTO `tblauto` (`ID`, `autocode`, `autoname`, `appendchar`, `autostart`, `autoend`, `incrementvalue`) VALUES
(1, 'Asset', 'Asset', 'ASitem', 0, 3, 1),
(2, 'Trans', 'Transaction', 'TrAnS', 1, 5, 1),
(3, 'SIDNO', 'IDNO', '2015', 1000000, 219, 1),
(4, 'EMPLOYEE', 'EMPID', '020010', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblinstructor`
--

CREATE TABLE `tblinstructor` (
  `INST_ID` int(11) NOT NULL,
  `INST_NAME` varchar(90) NOT NULL,
  `INST_MAJOR` varchar(90) NOT NULL,
  `INST_CONTACT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblinstructor`
--

INSERT INTO `tblinstructor` (`INST_ID`, `INST_NAME`, `INST_MAJOR`, `INST_CONTACT`) VALUES
(33, 'Mr. Arnold Aranaydo', 'Programming', '09123456788'),
(34, 'Mr. Jeffrey Lareta', 'Literature', '09123456789'),
(35, 'Mr. Lopez', 'Literature', '09123456787'),
(36, 'Ms. Wency Trapago', 'Programming and Networking', '091234567899'),
(37, 'Mr. Valdez', 'CSS', '09123456782'),
(38, 'Dr. Dicdican', 'Filipino', '09123456789');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `LOGID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `LOGDATETIME` datetime NOT NULL,
  `LOGROLE` varchar(55) NOT NULL,
  `LOGMODE` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`LOGID`, `USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) VALUES
(339, 1, '2024-09-01 13:26:42', 'Administrator', 'Logged out'),
(340, 1, '2024-09-01 13:26:46', 'Administrator', 'Logged in'),
(341, 1, '2024-09-01 13:28:00', 'Administrator', 'Logged out'),
(342, 1, '2024-09-01 13:28:10', 'Administrator', 'Logged in'),
(343, 1, '2024-09-01 13:54:25', 'Administrator', 'Logged out'),
(344, 1, '2024-09-01 13:54:29', 'Administrator', 'Logged in'),
(345, 1000000202, '2024-09-01 14:23:32', 'Student', 'Logged out'),
(346, 1000000202, '2024-09-01 14:23:56', 'Student', 'Logged in'),
(347, 1000000202, '2024-09-01 14:26:59', 'Student', 'Logged out'),
(348, 1000000203, '2024-09-01 14:43:54', 'Student', 'Logged out'),
(349, 1000000203, '2024-09-01 14:46:23', 'Student', 'Logged in'),
(350, 1000000203, '2024-09-01 14:51:13', 'Student', 'Logged out'),
(351, 1000000203, '2024-09-01 14:51:27', 'Student', 'Logged in'),
(352, 1000000203, '2024-09-01 14:54:07', 'Student', 'Logged out'),
(353, 1000000203, '2024-09-01 14:54:12', 'Student', 'Logged in'),
(354, 1000000203, '2024-09-01 14:59:21', 'Student', 'Logged in'),
(355, 1, '2024-09-01 15:01:25', 'Administrator', 'Logged in'),
(356, 1000000203, '2024-09-01 15:05:24', 'Student', 'Logged out'),
(357, 1000000203, '2024-09-01 15:05:55', 'Student', 'Logged in'),
(358, 1000000203, '2024-09-01 15:09:19', 'Student', 'Logged out'),
(359, 1000000204, '2024-09-01 15:11:20', 'Student', 'Logged out'),
(360, 1000000204, '2024-09-01 15:11:29', 'Student', 'Logged in'),
(361, 1000000204, '2024-09-01 15:13:44', 'Student', 'Logged out'),
(362, 1000000203, '2024-09-01 15:15:21', 'Student', 'Logged in'),
(363, 1000000203, '2024-09-01 15:15:24', 'Student', 'Logged out'),
(364, 1, '2024-09-01 15:17:11', 'Administrator', 'Logged out'),
(365, 1, '2024-09-01 15:17:16', 'Administrator', 'Logged in'),
(366, 1000000205, '2024-09-01 15:23:09', 'Student', 'Logged out'),
(367, 1000000205, '2024-09-01 15:23:19', 'Student', 'Logged in'),
(368, 1, '2024-09-02 06:08:05', 'Administrator', 'Logged in'),
(369, 1000000203, '2024-09-02 06:08:49', 'Student', 'Logged in'),
(370, 1000000203, '2024-09-02 06:08:55', 'Student', 'Logged out'),
(371, 1000000205, '2024-09-02 06:09:12', 'Student', 'Logged in'),
(372, 1000000205, '2024-09-02 06:18:27', 'Student', 'Logged out'),
(373, 1000000206, '2024-09-02 06:31:04', 'Student', 'Logged out'),
(374, 1000000206, '2024-09-02 06:39:04', 'Student', 'Logged in'),
(375, 1000000206, '2024-09-02 06:39:19', 'Student', 'Logged out'),
(376, 1000000207, '2024-09-02 06:57:41', 'Student', 'Logged out'),
(377, 1000000207, '2024-09-02 06:57:52', 'Student', 'Logged in'),
(378, 1000000207, '2024-09-02 07:00:18', 'Student', 'Logged out'),
(379, 1000000206, '2024-09-02 07:00:23', 'Student', 'Logged in'),
(380, 1000000205, '2024-09-02 07:39:09', 'Student', 'Logged in'),
(381, 1000000205, '2024-09-02 07:41:44', 'Student', 'Logged out'),
(382, 1000000206, '2024-09-02 07:41:49', 'Student', 'Logged in'),
(383, 1000000206, '2024-09-02 07:42:00', 'Student', 'Logged out'),
(384, 1000000207, '2024-09-02 07:42:15', 'Student', 'Logged in'),
(385, 1, '2024-09-02 07:44:30', 'Administrator', 'Logged in'),
(386, 1, '2024-09-02 14:52:20', 'Administrator', 'Logged in'),
(387, 1000000206, '2024-09-02 14:52:44', 'Student', 'Logged in'),
(388, 1000000206, '2024-09-02 14:52:50', 'Student', 'Logged out'),
(389, 1000000207, '2024-09-02 14:53:00', 'Student', 'Logged in'),
(390, 1000000207, '2024-09-04 10:20:38', 'Student', 'Logged in'),
(391, 1, '2024-09-06 13:53:15', 'Administrator', 'Logged in'),
(392, 1, '2024-09-10 11:24:54', 'Administrator', 'Logged in'),
(393, 1, '2024-09-11 02:17:25', 'Administrator', 'Logged in'),
(394, 1, '2024-09-11 02:30:15', 'Administrator', 'Logged out'),
(395, 1000000207, '2024-09-11 02:30:31', 'Student', 'Logged in'),
(396, 1000000207, '2024-09-11 02:30:48', 'Student', 'Logged out'),
(397, 1, '2024-09-11 03:13:30', 'Administrator', 'Logged in'),
(398, 1000000207, '2024-09-11 03:14:05', 'Student', 'Logged in'),
(399, 1000000207, '2024-09-11 03:18:29', 'Student', 'Logged out'),
(400, 1, '2024-09-11 05:04:03', 'Administrator', 'Logged in'),
(401, 1, '2024-11-10 17:32:14', 'Administrator', 'Logged in'),
(402, 1, '2024-11-10 17:34:05', 'Administrator', 'Logged out'),
(403, 1, '2024-11-10 17:34:42', 'Administrator', 'Logged in'),
(404, 1, '2024-11-10 17:35:04', 'Administrator', 'Logged out'),
(405, 2, '2024-11-10 17:35:07', 'Registrar', 'Logged in'),
(406, 2, '2024-11-10 17:35:23', 'Registrar', 'Logged out'),
(407, 1, '2024-11-10 17:35:31', 'Administrator', 'Logged in'),
(408, 1000000209, '2024-11-10 18:06:53', 'Student', 'Logged out'),
(409, 1000000210, '2024-11-10 18:33:40', 'Student', 'Logged out'),
(410, 1000000209, '2024-11-10 18:33:47', 'Student', 'Logged in'),
(411, 1000000209, '2024-11-10 18:35:08', 'Student', 'Logged out'),
(412, 1000000211, '2024-11-10 18:37:36', 'Student', 'Logged out'),
(413, 1, '2024-11-10 18:43:28', 'Administrator', 'Logged in'),
(414, 1000000212, '2024-11-10 18:46:21', 'Student', 'Logged out'),
(415, 1, '2024-11-13 12:08:14', 'Administrator', 'Logged in'),
(416, 1000000207, '2024-11-13 12:43:51', 'Student', 'Logged in'),
(417, 1000000207, '2024-11-13 12:44:02', 'Student', 'Logged out'),
(418, 1000000213, '2024-11-13 12:44:23', 'Student', 'Logged in'),
(419, 1000000213, '2024-11-13 12:45:33', 'Student', 'Logged out'),
(420, 1000000214, '2024-11-13 15:50:29', 'Student', 'Logged out'),
(421, 1, '2024-11-13 16:01:31', 'Administrator', 'Logged in'),
(422, 1000000214, '2024-11-13 16:02:42', 'Student', 'Logged in'),
(423, 1000000214, '2024-11-13 16:02:58', 'Student', 'Logged out'),
(424, 1000000216, '2024-11-13 16:06:53', 'Student', 'Logged out'),
(425, 1000000217, '2024-11-13 18:12:19', 'Student', 'Logged out'),
(426, 1000000217, '2024-11-13 18:12:46', 'Student', 'Logged in'),
(427, 1000000217, '2024-11-13 18:12:49', 'Student', 'Logged out'),
(428, 1000000218, '2024-11-13 18:18:39', 'Student', 'Logged out'),
(429, 1000000217, '2024-11-13 18:18:47', 'Student', 'Logged in');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `PAYMENTID` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_LEVEL` int(11) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL,
  `ENTRANCEFEE` double NOT NULL,
  `TOTALUNITS` double NOT NULL,
  `TOTALSEMESTER` double NOT NULL,
  `PARTIALPAYMENT` double NOT NULL,
  `BALANCE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblschedule`
--

CREATE TABLE `tblschedule` (
  `schedID` int(11) NOT NULL,
  `TIME_FROM` varchar(90) NOT NULL,
  `TIME_TO` varchar(90) NOT NULL,
  `sched_time` varchar(30) NOT NULL,
  `sched_day` varchar(30) NOT NULL,
  `sched_semester` varchar(30) NOT NULL,
  `sched_sy` varchar(30) NOT NULL,
  `sched_room` varchar(30) NOT NULL,
  `SECTION` varchar(30) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `SUBJ_ID` int(11) NOT NULL,
  `INST_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblschedule`
--

INSERT INTO `tblschedule` (`schedID`, `TIME_FROM`, `TIME_TO`, `sched_time`, `sched_day`, `sched_semester`, `sched_sy`, `sched_room`, `SECTION`, `COURSE_ID`, `SUBJ_ID`, `INST_ID`) VALUES
(436, '01:00 pm', '03:00 pm', '01:00 pm-03:00 pm', 'Monday', 'Second', '2024-2025', '', '1', 1, 361, 38),
(437, '04:00 pm', '08:00 pm', '04:00 pm-08:00 pm', 'Monday', 'Second', '2024-2025', '', '1', 1, 358, 36),
(438, '07:00 am', '12:00 pm', '07:00 am-12:00 pm', 'Tuesday', 'Second', '2024-2025', '', '1', 1, 364, 33),
(439, '01:00 pm', '04:00 pm', '01:00 pm-04:00 pm', 'Tuesday', 'Second', '2024-2025', '', '1', 1, 359, 37),
(440, '04:00 pm', '09:00 pm', '04:00 pm-09:00 pm', 'Tuesday', 'Second', '2024-2025', '', '1', 1, 360, 37),
(441, '07:00 am', '09:00 am', '07:00 am-09:00 am', 'Saturday', 'Second', '2024-2025', '', '1', 1, 365, 33),
(442, '01:00 pm', '04:00 pm', '01:00 pm-04:00 pm', 'Saturday', 'Second', '2024-2025', '', '1', 1, 362, 34);

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

CREATE TABLE `tblsemester` (
  `SEMID` int(11) NOT NULL,
  `SEMESTER` varchar(90) NOT NULL,
  `SETSEM` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsemester`
--

INSERT INTO `tblsemester` (`SEMID`, `SEMESTER`, `SETSEM`) VALUES
(1, 'First', 0),
(2, 'Second', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblstuddetails`
--

CREATE TABLE `tblstuddetails` (
  `DETAIL_ID` int(11) NOT NULL,
  `GUARDIAN` varchar(255) NOT NULL,
  `GUARDIAN_ADDRESS` varchar(255) NOT NULL,
  `GCONTACT` varchar(40) NOT NULL,
  `IDNO` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstuddetails`
--

INSERT INTO `tblstuddetails` (`DETAIL_ID`, `GUARDIAN`, `GUARDIAN_ADDRESS`, `GCONTACT`, `IDNO`) VALUES
(134, 'Chou', '', '09898989891', 1000000204),
(135, 'Chou', '', '09898767654', 1000000205),
(136, 'Jiren-sama', '', '09876545678', 1000000206),
(137, 'Barney', '', '09898978909', 1000000207),
(138, 'PAPA ARANAYDO SR.', '', '09157916611', 1000000208),
(139, 'Chou', '', '09100668203', 1000000209),
(140, 'Chou', '', '09100668203', 1000000210),
(141, 'Portgas Spade', '', '09100668203', 1000000211),
(142, 'Mickey Mouse', '', '09100668203', 1000000212),
(143, 'Chou', '', '09100668203', 1000000213),
(144, 'alucard', '', '09090909099', 1000000214),
(145, 'alucard', '', '09090909090', 1000000215),
(146, 'alucard', '', '09876565765', 1000000216),
(147, 'Emylou Escallente', '', '09100668203', 1000000217),
(148, 'Art Mercado', '', '09988776654', 1000000218);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `S_ID` int(11) NOT NULL,
  `OR_NUMBER` int(255) NOT NULL,
  `STUDENT_NUMBER` varchar(255) NOT NULL,
  `IDNO` int(20) NOT NULL,
  `FNAME` varchar(40) NOT NULL,
  `LNAME` varchar(40) NOT NULL,
  `MNAME` varchar(40) NOT NULL,
  `SEX` varchar(10) NOT NULL DEFAULT 'Male',
  `BDAY` date NOT NULL,
  `BPLACE` text NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `AGE` int(30) NOT NULL,
  `NATIONALITY` varchar(40) NOT NULL,
  `RELIGION` varchar(255) NOT NULL,
  `CONTACT_NO` varchar(40) NOT NULL,
  `HOME_ADD` text NOT NULL,
  `ACC_USERNAME` varchar(255) NOT NULL,
  `ACC_PASSWORD` text NOT NULL,
  `student_status` text NOT NULL,
  `YEARLEVEL` int(11) NOT NULL,
  `STUDSECTION` int(11) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `STUDPHOTO` varchar(255) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL,
  `SYEAR` varchar(30) NOT NULL,
  `NewEnrollees` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`S_ID`, `OR_NUMBER`, `STUDENT_NUMBER`, `IDNO`, `FNAME`, `LNAME`, `MNAME`, `SEX`, `BDAY`, `BPLACE`, `STATUS`, `AGE`, `NATIONALITY`, `RELIGION`, `CONTACT_NO`, `HOME_ADD`, `ACC_USERNAME`, `ACC_PASSWORD`, `student_status`, `YEARLEVEL`, `STUDSECTION`, `COURSE_ID`, `STUDPHOTO`, `SEMESTER`, `SYEAR`, `NewEnrollees`) VALUES
(148, 0, '23-759', 1000000217, 'Alexander Joerenz', 'Escallente', 'E', 'Male', '2004-08-27', 'Muntinlupa City', 'Single', 0, 'Filipino', 'Roman Catholic', '09100668203', '#67 A. Olivarez Street. Brgy. Santo Niño, San Pedro City, Laguna ', 'alexander', '14e1743c694e2c397bb8d92d41134d626738525a', 'Old', 3, 1, 1, '', 'Second', '', 0),
(149, 0, '24-2024', 1000000218, 'SPCPC', 'EAN', 'E', 'Male', '2000-08-27', 'Muntinlupa City', 'Single', 0, 'Filipino', 'Roman Catholic', '09988776655', 'Brgy. Santo Niño San Pedro CIty, Laguna  ', 'spcpc', '14e1743c694e2c397bb8d92d41134d626738525a', 'Old', 3, 1, 1, '', 'Second', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `ACCOUNT_ID` int(11) NOT NULL,
  `ACCOUNT_NAME` varchar(255) NOT NULL,
  `ACCOUNT_USERNAME` varchar(255) NOT NULL,
  `ACCOUNT_PASSWORD` text NOT NULL,
  `ACCOUNT_TYPE` varchar(30) NOT NULL,
  `EMPID` int(11) NOT NULL,
  `USERIMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `ACCOUNT_USERNAME`, `ACCOUNT_PASSWORD`, `ACCOUNT_TYPE`, `EMPID`, `USERIMAGE`) VALUES
(1, 'Alexander Joerenz Escallente', 'admin_escall', '14e1743c694e2c397bb8d92d41134d626738525a', 'Administrator', 1234, 'photos/alu-lghtbrn.jfif'),
(2, 'Alex', 'registrar_escall', '14e1743c694e2c397bb8d92d41134d626738525a', 'Registrar', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`COURSE_ID`),
  ADD KEY `DEPT_ID` (`DEPT_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DEPT_ID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`GRADE_ID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `schoolyr`
--
ALTER TABLE `schoolyr`
  ADD PRIMARY KEY (`SYID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `studentschedule`
--
ALTER TABLE `studentschedule`
  ADD PRIMARY KEY (`CLASS_ID`),
  ADD KEY `IDNO` (`IDNO`),
  ADD KEY `schedID` (`schedID`);

--
-- Indexes for table `studentsubjects`
--
ALTER TABLE `studentsubjects`
  ADD PRIMARY KEY (`STUDSUBJ_ID`),
  ADD KEY `IDNO` (`IDNO`),
  ADD KEY `SUBJ_ID` (`SUBJ_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SUBJ_ID`),
  ADD KEY `COURSE_ID` (`COURSE_ID`);

--
-- Indexes for table `tblauto`
--
ALTER TABLE `tblauto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `autocode` (`autocode`);

--
-- Indexes for table `tblinstructor`
--
ALTER TABLE `tblinstructor`
  ADD PRIMARY KEY (`INST_ID`);

--
-- Indexes for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD PRIMARY KEY (`LOGID`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`PAYMENTID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `tblschedule`
--
ALTER TABLE `tblschedule`
  ADD PRIMARY KEY (`schedID`),
  ADD KEY `COURSE_ID` (`COURSE_ID`),
  ADD KEY `SUBJ_ID` (`SUBJ_ID`);

--
-- Indexes for table `tblsemester`
--
ALTER TABLE `tblsemester`
  ADD PRIMARY KEY (`SEMID`);

--
-- Indexes for table `tblstuddetails`
--
ALTER TABLE `tblstuddetails`
  ADD PRIMARY KEY (`DETAIL_ID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`S_ID`),
  ADD UNIQUE KEY `IDNO` (`IDNO`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`ACCOUNT_ID`),
  ADD UNIQUE KEY `ACCOUNT_USERNAME` (`ACCOUNT_USERNAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `COURSE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DEPT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `GRADE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1580;

--
-- AUTO_INCREMENT for table `schoolyr`
--
ALTER TABLE `schoolyr`
  MODIFY `SYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `studentschedule`
--
ALTER TABLE `studentschedule`
  MODIFY `CLASS_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentsubjects`
--
ALTER TABLE `studentsubjects`
  MODIFY `STUDSUBJ_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1574;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `SUBJ_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;

--
-- AUTO_INCREMENT for table `tblauto`
--
ALTER TABLE `tblauto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblinstructor`
--
ALTER TABLE `tblinstructor`
  MODIFY `INST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbllogs`
--
ALTER TABLE `tbllogs`
  MODIFY `LOGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=430;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `PAYMENTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tblschedule`
--
ALTER TABLE `tblschedule`
  MODIFY `schedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT for table `tblsemester`
--
ALTER TABLE `tblsemester`
  MODIFY `SEMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblstuddetails`
--
ALTER TABLE `tblstuddetails`
  MODIFY `DETAIL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
