-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2014 at 01:09 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trip2`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `pass`, `email`) VALUES
('', '', ''),
('user', 'user', 'fathimafathii@gmail.com'),
('admin', 'admin', 'zarankumar@gmail.com'),
('sfsd', 'ssdg', 'shahanshah.shah@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `pid` int(8) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `pdesc` varchar(50) NOT NULL,
  `plati` double NOT NULL,
  `plong` double NOT NULL,
  `stayplace` tinyint(1) NOT NULL,
  `category` varchar(50) NOT NULL,
  `rating` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`pid`, `pname`, `pdesc`, `plati`, `plong`, `stayplace`, `category`, `rating`) VALUES
(10, 'munnar', 'cochin details', 10.0889, 77.0595, 1, '', 9),
(14, 'trivandrum', 'tvm details', 8.4874, 76.9486, 1, '', 8),
(13, 'allappuzha', 'allappey details', 9.498, 76.3388, 1, '', 8),
(11, 'cochin', 'cochin details', 9.931233, 76.267, 1, '', 7),
(12, 'thekkady', 'thekkady details', 9.6062, 77.1672, 1, '', 6),
(15, 'kollam', 'kollam details', 8.8932, 76.6141, 1, '', 5),
(20, 'kanyakumari', 'desc kanyakumari', 8.088306, 77.538451, 0, '', 7),
(26, 'alappuzha beach', 'beach', 9.494249, 76.317167, 0, '', 4),
(21, 'fort kochi', 'Fort kochi is a beach', 9.965779, 76.242115, 0, '', 5),
(22, 'Periyar Tiger Reserve', 'Forest', 9.466298, 77.143487, 0, '', 5),
(25, 'mattupetty dam', 'dam', 10.104444, 77.123611, 0, '', 4),
(23, 'Cherai Beach', 'beach', 10.141595, 76.178283, 0, '', 4),
(24, 'munnar town', 'town', 10.088933, 77.059525, 0, '', 3),
(27, 'trivandrum museum', 'museum', 8.510451, 76.953433, 0, '', 4),
(28, 'trivandrum zoo', 'zoo', 8.511616, 76.954944, 0, '', 5),
(30, 'marine drive', 'drive', 9.98258, 76.275427, 0, '', 5),
(31, 'mararikulam', 'mararikulam', 9.609605, 76.311623, 0, '', 4),
(32, 'thankaserry', 'thankaserry', 8.886071, 76.569052, 0, '', 4),
(33, 'kollam beach', 'kollam beach', 8.875678, 76.588916, 0, '', 5),
(56, 'thenmala', 'thenmala eco tourism', 8.963245, 77.065081, 0, 'eco-tourism', 5),
(34, 'varkala', 'varkala beach', 8.7333, 76.7167, 1, '', 8),
(35, 'kovalam', 'kovalam beach', 8.400923, 76.97883, 1, '', 9),
(78, 'veli tourist village', 'veli tourist village', 8.508021, 76.88867, 0, 'eco-tourism', 6),
(47, 'techno park', 'techno park', 8.487495, 76.948623, 1, '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE IF NOT EXISTS `plan` (
  `arrival` varchar(30) NOT NULL,
  `dep` varchar(30) NOT NULL,
  `nos` int(11) NOT NULL,
  `tripid` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`arrival`, `dep`, `nos`, `tripid`) VALUES
(' cochin ', 'trivandrum', 5, 1),
('cochin  ', 'trivandrum', 5, 2),
('cochin ', 'allappey', 3, 3),
('cochin  ', 'allappey', 5, 4),
('cochin   ', 'kollam', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE IF NOT EXISTS `trip` (
  `tripid` int(8) NOT NULL,
  `trip` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`tripid`, `trip`, `username`) VALUES
(3, 'a:3:{i:0;s:10:"trivandrum";i:1;s:7:"kovalam";i:2;s:6:"cochin";}', 'admin'),
(5, 'a:1:{i:0;s:54:"cochin|fort kochi|marine drive|Cherai Beach|trivandrum";}', 'user'),
(6, 'a:4:{i:0;s:10:"trivandrum";i:1;s:7:"kovalam";i:2;s:20:"veli tourist village";i:3;s:6:"kollam";}', 'admin');
