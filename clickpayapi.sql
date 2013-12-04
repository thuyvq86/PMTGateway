-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2013 at 04:13 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clickpayapi`
--
CREATE DATABASE IF NOT EXISTS `clickpayapi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `clickpayapi`;

-- --------------------------------------------------------

--
-- Table structure for table `cp_epaybillinfo`
--

CREATE TABLE IF NOT EXISTS `cp_epaybillinfo` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `LastName` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Address` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `City` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Country` varchar(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ZipCode` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Email` varchar(25) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cp_requestlog`
--

CREATE TABLE IF NOT EXISTS `cp_requestlog` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MerchantName` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ReferenceNumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `Signature` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `RespCode` char(2) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `RequestBody` text CHARACTER SET utf8 COLLATE utf8_bin,
  `ResponseBody` text CHARACTER SET utf8 COLLATE utf8_bin,
  `TrxnDateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`),
  UNIQUE KEY `ID_2` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
