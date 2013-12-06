-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2013 at 09:17 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clickpayapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cp_epaybillinfo`
--

CREATE TABLE IF NOT EXISTS `cp_epaybillinfo` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `LastName` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `AddressLine1` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `AddressLine2` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `City` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Country` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ZipCode` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `State` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Company` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `TrxnDate` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `cp_epaybillinfo`
--

INSERT INTO `cp_epaybillinfo` (`ID`, `FirstName`, `LastName`, `AddressLine1`, `AddressLine2`, `City`, `Country`, `ZipCode`, `State`, `Company`, `Email`, `Phone`, `TrxnDate`) VALUES
(6, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 01:45:50'),
(7, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 05:09:31'),
(8, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 05:21:33'),
(9, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 05:21:59'),
(10, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:25:24'),
(11, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:28:28'),
(12, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:33:20'),
(13, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:45:53'),
(14, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:48:53'),
(15, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:52:52'),
(16, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:56:05'),
(17, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:57:45'),
(18, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 06:58:55'),
(19, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 07:08:30'),
(20, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 07:12:30'),
(21, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 07:17:00'),
(22, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 07:54:16'),
(23, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 07:55:56'),
(24, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:22:55'),
(25, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:26:47'),
(26, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:31:41'),
(27, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:32:54'),
(28, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:35:38'),
(29, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:38:03'),
(30, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:43:35'),
(31, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:45:10'),
(32, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:49:15'),
(33, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:51:17'),
(34, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:53:39'),
(35, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:56:21'),
(36, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:57:53'),
(37, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 08:58:48'),
(38, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 09:02:12'),
(39, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 09:03:56'),
(40, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 09:05:48'),
(41, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 09:06:48'),
(42, 'Hieu', 'Phan Trung', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '0938681718', '2013-12-06 09:10:03'),
(43, 'AAAA', 'BBBB', '266-268', 'NKKN Q3', 'HCM', 'VN', '123456', '', 'Sacom', 'trunghieu1718@gmail.com', '111111', '2013-12-06 09:11:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
