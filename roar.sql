-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2013 at 01:20 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `roar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `dateinserted` varchar(30) DEFAULT NULL,
  `dateupdated` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `dateinserted`, `dateupdated`) VALUES
(1, 'najib', 'najib', NULL, NULL),
(2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bookingno` varchar(20) DEFAULT NULL,
  `memberid` bigint(20) DEFAULT NULL,
  `datebooked` varchar(50) DEFAULT NULL,
  `timeslotid` varchar(50) DEFAULT NULL,
  `studioid` bigint(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `dateinserted` varchar(50) DEFAULT NULL,
  `dateupdated` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `bookingno`, `memberid`, `datebooked`, `timeslotid`, `studioid`, `status`, `remarks`, `dateinserted`, `dateupdated`) VALUES
(1, 'REF1001', 1, '19/02/2013', '1', 1, 'approved', NULL, '2013-02-19 03:29:39', NULL),
(2, 'REF1002', 1, '19/02/2013', '1', 2, 'reject', NULL, '2013-02-19 20:32:01', '2013-04-09 23:01:42'),
(3, 'REF1003', 1, '19/02/2013', '2', 1, 'approved', NULL, '2013-02-20 17:29:59', NULL),
(4, 'REF1004', 1, '20/03/2013', '1', 1, 'approved', NULL, '2013-03-19 16:28:04', '2013-03-19 16:29:41'),
(5, 'REF1005', 5, '24/03/2013', '3', 2, 'approved', NULL, '2013-03-19 16:37:57', '2013-03-19 16:50:52'),
(6, 'REF1006', 6, '09/04/2013', '1', 1, 'approved', NULL, '2013-04-07 12:44:23', '2013-04-07 12:48:05'),
(7, 'REF1007', 2, '03/04/2013', '1', 1, 'new', NULL, '2013-04-09 14:22:34', NULL),
(8, 'REF1008', 2, '04/04/2013', '5', 1, 'new', NULL, '2013-04-09 14:51:23', NULL),
(9, 'REF1009', 2, '04/04/2013', '10', 1, 'new', NULL, '2013-04-09 16:36:11', NULL),
(10, 'REF1010', 2, '04/04/2013', '13', 2, 'new', NULL, '2013-04-09 22:59:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `bandname` varchar(100) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `dateinserted` varchar(40) DEFAULT NULL,
  `dateupdated` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `email`, `password`, `bandname`, `contact`, `status`, `dateinserted`, `dateupdated`) VALUES
(1, 'Phoon Weng Hou', 'pauletaphoon@gmail.com', '888888', 'test band name', '0165017082', 'activate', '2013-02-16 16:57:05', '2013-02-19 12:27:23'),
(2, 'test', 'ohriental85@hotmail.com', 'test', 'test', 'test', 'activate', '2013-02-20 16:16:58', NULL),
(3, 'test', '', 'test', '', '', 'activate', '2013-02-20 16:17:36', NULL),
(4, 'najib', 'najib', 'najib', '', 'test', 'activate', '2013-03-19 13:59:58', NULL),
(5, 'kevin', 'kevin_cca84@hotmail.com', 'kevin', 'kevin', '0122078918', 'blacklist', '2013-03-19 16:35:11', '2013-03-19 16:59:58'),
(6, 'najib', 'najib@najib.com', 'najib', 'najib', 'najib', 'activate', '2013-04-07 12:42:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `runningid`
--

CREATE TABLE IF NOT EXISTS `runningid` (
  `bookingid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `runningid`
--

INSERT INTO `runningid` (`bookingid`) VALUES
(1010);

-- --------------------------------------------------------

--
-- Table structure for table `studio`
--

CREATE TABLE IF NOT EXISTS `studio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) DEFAULT NULL,
  `dateinserted` varchar(50) DEFAULT NULL,
  `dateupdated` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `studio`
--

INSERT INTO `studio` (`id`, `description`, `dateinserted`, `dateupdated`) VALUES
(1, 'Studio A', NULL, NULL),
(2, 'Studio B', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE IF NOT EXISTS `timeslot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `dateinserted` varchar(50) NOT NULL,
  `dateupdated` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`id`, `description`, `dateinserted`, `dateupdated`) VALUES
(1, '1800 - 1830', '', ''),
(2, '1830 - 1900', '', ''),
(3, '1900 - 1930', '', ''),
(4, '1930 - 2000', '', ''),
(5, '2000 - 2030', '', ''),
(6, '2030 - 2100', '', ''),
(7, '2100 - 2130', '', ''),
(8, '2130 - 2200', '', ''),
(9, '2200 - 2230', '', ''),
(10, '2230 - 2300', '', ''),
(11, '2300 - 2330', '', ''),
(12, '2330 - 0000', '', ''),
(13, '0000 - 0030', '', ''),
(14, '0030 - 0100', '', ''),
(15, '0100 - 0130', '', ''),
(16, '0130 - 0200', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
