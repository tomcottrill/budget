-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2013 at 06:39 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dumpsterco`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE IF NOT EXISTS `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_id` int(11) NOT NULL,
  `Alert` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provider_id_2` (`provider_id`),
  KEY `provider_id` (`provider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `provider_id`, `Alert`) VALUES
(18, 17, 'Test'),
(19, 5, 'Test2');

-- --------------------------------------------------------

--
-- Table structure for table `budgetdumpster_providers`
--

CREATE TABLE IF NOT EXISTS `budgetdumpster_providers` (
  `provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `provider_name` varchar(1024) NOT NULL,
  `provider_rank` int(11) NOT NULL,
  `provider_address` varchar(1024) NOT NULL,
  `provider_phone` varchar(128) NOT NULL,
  `provider_email` varchar(512) NOT NULL,
  `provider_website` varchar(512) NOT NULL,
  `provider_lat` float(10,6) NOT NULL,
  `provider_lng` float(10,6) NOT NULL,
  PRIMARY KEY (`provider_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `budgetdumpster_providers`
--

INSERT INTO `budgetdumpster_providers` (`provider_id`, `provider_name`, `provider_rank`, `provider_address`, `provider_phone`, `provider_email`, `provider_website`, `provider_lat`, `provider_lng`) VALUES
(5, 'BigBox PT', 3, 'Akron, Ohio', '+36703928828', 'tomi.hajdu@gmail.com', 'www.searoutefinder.com', 41.081444, -81.519005),
(6, 'Calem Wine Cellars', 1, 'Medina, OH', '+123456744657', 'calem@calem.com', 'www.calemwinecellars.com', 41.138390, -81.863747),
(7, 'Offley Wine Cellars', 3, 'Mansfield, OH', '+197455768946', 'offley@offley.com', 'www.offley.com', 40.758389, -82.515450),
(17, 'ABC Company', 2, 'Colombus, ohio', '+36703928828', 'tomi.hajdu@gmail.com', 'www.tamas.com', 39.961178, -82.998795),
(18, 'Ritas Trucks', 1, 'Sandusky, Ohio', '+1234567898', 'gregi007@gmail.com', 'www.ritas.com', 41.448940, -82.707962),
(23, 'Tom', 0, '1148 Forest Ave., Alliance OH', '1112223333', 'tomcottrill@gmail.com', 'http://www.tomcottrill.com', 40.909904, -81.090233),
(26, 'Tom Test', 0, '8200 Sweet Valley Drive', '1112223333', 'tc@tc.com', 'test', 41.395515, -81.626251),
(27, 'Budget Dumpster', 0, '21190 Center Ridge Rd.', '111222333', 'tomcottrill@gmail.com', 'http://www.budgetdumpster.com', 41.461292, -81.854706);

-- --------------------------------------------------------

--
-- Table structure for table `extended_info`
--

CREATE TABLE IF NOT EXISTS `extended_info` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ProviderID` int(11) NOT NULL,
  `theyKnowUsAs` varchar(11) NOT NULL,
  `flatRateOrHaul` varchar(10) NOT NULL,
  `knowBroker` varchar(3) NOT NULL,
  `ourPhone` varchar(20) NOT NULL,
  `ourAddress` text NOT NULL,
  `contact1Name` varchar(255) NOT NULL,
  `contact1Email` varchar(70) NOT NULL,
  `contact1Phone` varchar(20) NOT NULL,
  `contact2Name` varchar(255) NOT NULL,
  `contact2Email` varchar(70) NOT NULL,
  `contact2Phone` varchar(20) NOT NULL,
  `contact3Name` varchar(255) NOT NULL,
  `contact3Email` varchar(70) NOT NULL,
  `contact3Phone` varchar(20) NOT NULL,
  `contact4Name` varchar(255) NOT NULL,
  `contact4Email` varchar(70) NOT NULL,
  `contact4Phone` varchar(20) NOT NULL,
  `CostCalculation` text NOT NULL,
  `GeneralNotes` text NOT NULL,
  `textunderlay` varchar(255) NOT NULL,
  `searchText` varchar(255) DEFAULT NULL,
  `timeZone` varchar(4) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ProviderID` (`ProviderID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `extended_info`
--

INSERT INTO `extended_info` (`ID`, `ProviderID`, `theyKnowUsAs`, `flatRateOrHaul`, `knowBroker`, `ourPhone`, `ourAddress`, `contact1Name`, `contact1Email`, `contact1Phone`, `contact2Name`, `contact2Email`, `contact2Phone`, `contact3Name`, `contact3Email`, `contact3Phone`, `contact4Name`, `contact4Email`, `contact4Phone`, `CostCalculation`, `GeneralNotes`, `textunderlay`, `searchText`, `timeZone`) VALUES
(1, 26, 'Test1', 'Haul Plus', 'No', 'dasd', '<b>Test</b><br><br>Test', 'Tom', 'tcottrill@fathomseo.com', '18001231232', '0', '0', '', '', '', '', '', '', '', 'MORE NOTES', 'Notes, taken in HTML', '', '', ''),
(2, 23, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 6, 'Some Compan', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '<b><i>Please work</i></b>', '', 'TEST', ''),
(4, 17, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 7, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 27, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Sample', ''),
(10, 18, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pricingstructures`
--

CREATE TABLE IF NOT EXISTS `pricingstructures` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WasteType` int(11) NOT NULL,
  `Hauler` int(11) NOT NULL,
  `10Y` int(11) DEFAULT NULL,
  `10YNotes` text,
  `12Y` int(11) DEFAULT NULL,
  `12YNotes` text,
  `15Y` int(11) DEFAULT NULL,
  `15YNotes` text,
  `18Y` int(11) DEFAULT NULL,
  `18YNotes` text,
  `20Y` int(11) DEFAULT NULL,
  `20YNotes` text,
  `25Y` int(11) DEFAULT NULL,
  `25YNotes` text,
  `30Y` int(11) DEFAULT NULL,
  `30YNotes` text,
  `40Y` int(11) DEFAULT NULL,
  `40YNotes` text,
  `10YCost` int(11) DEFAULT NULL,
  `12YCost` int(11) DEFAULT NULL,
  `15YCost` int(11) DEFAULT NULL,
  `18YCost` int(11) DEFAULT NULL,
  `20YCost` int(11) DEFAULT NULL,
  `25YCost` int(11) DEFAULT NULL,
  `30YCost` int(11) DEFAULT NULL,
  `40YCost` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `WasteType` (`WasteType`,`Hauler`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `pricingstructures`
--

INSERT INTO `pricingstructures` (`ID`, `WasteType`, `Hauler`, `10Y`, `10YNotes`, `12Y`, `12YNotes`, `15Y`, `15YNotes`, `18Y`, `18YNotes`, `20Y`, `20YNotes`, `25Y`, `25YNotes`, `30Y`, `30YNotes`, `40Y`, `40YNotes`, `10YCost`, `12YCost`, `15YCost`, `18YCost`, `20YCost`, `25YCost`, `30YCost`, `40YCost`) VALUES
(14, 2, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(15, 2, 6, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, 0, 0, 0, NULL, NULL, NULL, NULL),
(16, 2, 28, 150, NULL, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL),
(17, 2, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wastetypes`
--

CREATE TABLE IF NOT EXISTS `wastetypes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wastetypes`
--

INSERT INTO `wastetypes` (`ID`, `Name`) VALUES
(2, 'Construction'),
(3, 'Household');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `budgetdumpster_providers` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `extended_info`
--
ALTER TABLE `extended_info`
  ADD CONSTRAINT `extended_info_ibfk_2` FOREIGN KEY (`ProviderID`) REFERENCES `budgetdumpster_providers` (`provider_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pricingstructures`
--
ALTER TABLE `pricingstructures`
  ADD CONSTRAINT `pricingstructures_ibfk_1` FOREIGN KEY (`WasteType`) REFERENCES `wastetypes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
