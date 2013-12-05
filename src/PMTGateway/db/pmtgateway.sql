-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2013 at 06:00 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pmtgateway`
--
CREATE DATABASE IF NOT EXISTS `pmtgateway` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pmtgateway`;

-- --------------------------------------------------------

--
-- Table structure for table `cp_integrationfields`
--

CREATE TABLE IF NOT EXISTS `cp_integrationfields` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ProfileID` int(10) unsigned DEFAULT NULL,
  `IsActive` tinyint(3) unsigned DEFAULT NULL,
  `IsRequired` tinyint(3) unsigned DEFAULT NULL,
  `DisplayName` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Value` varchar(400) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifieBy` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `cp_integrationfields`
--

INSERT INTO `cp_integrationfields` (`ID`, `ProfileID`, `IsActive`, `IsRequired`, `DisplayName`, `Value`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifieBy`) VALUES
(42, 1, 1, 1, 'bbbb', 'bbb', '2013-12-05 11:59:23', 'admin', NULL, NULL),
(43, 1, 1, 1, 'adddd', 'adddd', '2013-12-05 11:59:23', 'admin', NULL, NULL),
(44, 1, 1, 1, 'sdfsdf', 'asdasda', '2013-12-05 11:59:23', 'admin', NULL, NULL),
(45, 1, 1, 1, 'sdasd', 'as', '2013-12-05 11:59:23', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cp_integrationprofile`
--

CREATE TABLE IF NOT EXISTS `cp_integrationprofile` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ProviderCode` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ProviderName` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `IsActive` tinyint(3) unsigned DEFAULT NULL,
  `Description` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cp_integrationprofile`
--

INSERT INTO `cp_integrationprofile` (`ID`, `ProviderCode`, `ProviderName`, `IsActive`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 'FPT', 'FPT Company', 1, 'FPT Company', NULL, NULL, NULL, NULL),
(2, 'VNPT', 'VINA Company', 1, 'VINA Company', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `phone`, `email`) VALUES
(1, 'lochh', 'lochh', '09090808', 'lochh@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
