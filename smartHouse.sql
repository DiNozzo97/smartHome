-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2016 at 08:13 PM
-- Server version: 5.5.44-0+deb8u1
-- PHP Version: 5.6.19-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smartHouse`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensorReadings`
--

CREATE TABLE IF NOT EXISTS `sensorReadings` (
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kitchenTemp` float NOT NULL,
  `utilityRoomTemp` float NOT NULL,
  `livingRoomTemp` float NOT NULL,
  `photoSensor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
`userId` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `passwordHash` varchar(32) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`userId`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `passwordHash`, `active`) VALUES
(1, 'Test', 'User', 'testuser@mdx.ac.uk', '+447710574957', '098f6bcd4621d373cade4e832627b4f6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensorReadings`
--
ALTER TABLE `sensorReadings`
 ADD PRIMARY KEY (`timestamp`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
 ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
