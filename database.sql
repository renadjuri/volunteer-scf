-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2018 at 10:15 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Username` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Username`, `password`, `Email`) VALUES
('admin', 'renad123', 'renadjuri@gmail.com'),
('nora555', '123', NULL),
('sara555', '1111', 'sara@jj.com');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(10) NOT NULL,
  `FirstName` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MiddleName` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AdminUsername` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `FirstName`, `MiddleName`, `LastName`, `AdminUsername`) VALUES
(1112224567, 'Nora', 'Mohammed', 'Salem', 'nora555'),
(1122334455, 'Sara', 'Ahmed', 'Ali', 'sara555'),
(2130009111, 'رناد', 'عماد', 'جري', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE `certificate` (
  `CertificateID` int(10) NOT NULL,
  `Form` blob NOT NULL,
  `Event_ID` int(10) NOT NULL,
  `Admin_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dateofevent`
--

CREATE TABLE `dateofevent` (
  `Event_ID` int(10) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(10) NOT NULL,
  `EventName` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EventDescription` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `MaleNum` int(3) NOT NULL DEFAULT '0',
  `FemaleNum` int(3) NOT NULL DEFAULT '0',
  `Location` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EventImage` varchar(30) CHARACTER SET armscii8 NOT NULL,
  `Admin_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`EventID`, `EventName`, `EventDescription`, `MaleNum`, `FemaleNum`, `Location`, `EventImage`, `Admin_ID`) VALUES
(1111114444, 'المؤتمر العلمي العالمي الثاني عشر لأمراض السرطان', 'المؤتمر يهدف إلى زيادة الوعي لدى المجتمع وأيضا لإجراء البحوث حول المرض وكيفية الوقاية منه', 0, 0, 'الشرقية -مدينة الظهران', '', 2130009111),
(1111115555, 'الشرقية الوردية', 'فعالية  توعية عن المرض', 0, 0, 'المنطقة الشرقية', '', 1122334455);

-- --------------------------------------------------------

--
-- Table structure for table `taskofevent`
--

CREATE TABLE `taskofevent` (
  `Event_ID` int(10) NOT NULL,
  `Task` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `VolunteerID` int(15) NOT NULL,
  `FirstName` varchar(15) CHARACTER SET utf8 NOT NULL,
  `MiddleName` varchar(15) CHARACTER SET utf8 NOT NULL,
  `LastName` varchar(15) CHARACTER SET utf8 NOT NULL,
  `MobileNumber` int(10) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `nationality` varchar(15) CHARACTER SET utf8 NOT NULL,
  `residence` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Qualification` varchar(50) CHARACTER SET utf8 NOT NULL,
  `WorkStatus` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `WorkType` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sector` int(11) DEFAULT NULL,
  `VolunteerUsername` varchar(20) DEFAULT NULL,
  `Admin_ID` int(10) DEFAULT NULL,
  `BlackList` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`VolunteerID`, `FirstName`, `MiddleName`, `LastName`, `MobileNumber`, `DateOfBirth`, `Gender`, `nationality`, `residence`, `Qualification`, `WorkStatus`, `WorkType`, `Sector`, `VolunteerUsername`, `Admin_ID`, `BlackList`) VALUES
(222, 'سارا', 'عادل', 'محمد', 562228999, '2018-03-13', 'f', 'سعودية', 'الدمام', 'ماستر', '', NULL, NULL, 'sara555', NULL, 0),
(2130008877, 'nora', 'ahmed', 'saleh', 562228938, '0000-00-00', '', '', '', '', '', NULL, NULL, 'nora555', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `volunteerparticipateonevent`
--

CREATE TABLE `volunteerparticipateonevent` (
  `Volunteer_ID` int(10) NOT NULL,
  `Event_ID` int(10) NOT NULL,
  `Date` date NOT NULL,
  `StartingHour` time NOT NULL DEFAULT '00:00:00',
  `EndingHour` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteerregisterinevent`
--

CREATE TABLE `volunteerregisterinevent` (
  `Admin_ID` int(11) DEFAULT NULL,
  `Event_ID` int(10) NOT NULL,
  `Vounteer_ID` int(10) NOT NULL,
  `GrantCertificate` int(1) NOT NULL DEFAULT '0',
  `Status` int(1) NOT NULL DEFAULT '0',
  `Task` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteerregisterinevent`
--

INSERT INTO `volunteerregisterinevent` (`Admin_ID`, `Event_ID`, `Vounteer_ID`, `GrantCertificate`, `Status`, `Task`) VALUES
(0, 151, 145, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`) USING BTREE;

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD KEY `AdminUsername` (`AdminUsername`);

--
-- Indexes for table `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`CertificateID`),
  ADD KEY `Admin_ID` (`Admin_ID`),
  ADD KEY `Event_ID` (`Event_ID`);

--
-- Indexes for table `dateofevent`
--
ALTER TABLE `dateofevent`
  ADD PRIMARY KEY (`Event_ID`,`Date`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `taskofevent`
--
ALTER TABLE `taskofevent`
  ADD PRIMARY KEY (`Event_ID`,`Task`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`VolunteerID`),
  ADD KEY `Admin_ID` (`Admin_ID`),
  ADD KEY `VolunteerUsername` (`VolunteerUsername`);

--
-- Indexes for table `volunteerparticipateonevent`
--
ALTER TABLE `volunteerparticipateonevent`
  ADD PRIMARY KEY (`Volunteer_ID`,`Event_ID`,`Date`),
  ADD KEY `Event_ID` (`Event_ID`);

--
-- Indexes for table `volunteerregisterinevent`
--
ALTER TABLE `volunteerregisterinevent`
  ADD PRIMARY KEY (`Event_ID`,`Vounteer_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`AdminUsername`) REFERENCES `account` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `certificate`
--
ALTER TABLE `certificate`
  ADD CONSTRAINT `certificate_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `certificate_ibfk_2` FOREIGN KEY (`Event_ID`) REFERENCES `event` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volunteer_ibfk_2` FOREIGN KEY (`VolunteerUsername`) REFERENCES `account` (`Username`);

--
-- Constraints for table `volunteerparticipateonevent`
--
ALTER TABLE `volunteerparticipateonevent`
  ADD CONSTRAINT `volunteerparticipateonevent_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `event` (`EventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `volunteerparticipateonevent_ibfk_2` FOREIGN KEY (`Volunteer_ID`) REFERENCES `volunteer` (`VolunteerID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
