-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 05, 2018 at 08:05 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spacetime`
--

-- --------------------------------------------------------

--
-- Table structure for table `destroyers`
--

CREATE TABLE `destroyers` (
  `ID` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `hitpoints` mediumint(9) NOT NULL,
  `attack` mediumint(3) NOT NULL,
  `defence` mediumint(3) NOT NULL,
  `exper` mediumint(2) NOT NULL,
  `level` int(3) NOT NULL,
  `maxhitpoints` mediumint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destroyers`
--

INSERT INTO `destroyers` (`ID`, `name`, `hitpoints`, `attack`, `defence`, `exper`, `level`, `maxhitpoints`) VALUES
(19, 'Medium destroyer', 4, 5, 5, 5, 5, 5),
(20, 'Large destroyer', 7, 7, 7, 7, 7, 7),
(18, 'Small destroyer', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `stats` varchar(30) NOT NULL,
  `statadd` smallint(3) NOT NULL,
  `price` int(11) NOT NULL,
  `randid` int(9) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ID`, `name`, `stats`, `statadd`, `price`, `randid`, `type`) VALUES
(8, 'Quick repair', 'hitpoints', 15, 0, 573822447, 'healing'),
(1, 'Quick repair', 'hitpoints', 5, 0, 787062992, 'healing'),
(9, 'regular repair', 'hitpoints', 10, 0, 479157014, 'healing');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `userid` varchar(21) NOT NULL,
  `sender` varchar(21) NOT NULL,
  `message` text NOT NULL,
  `subject` text NOT NULL,
  `randid` int(7) NOT NULL,
  `readm` tinyint(1) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`userid`, `sender`, `message`, `subject`, `randid`, `readm`, `date`) VALUES
('alexander', 'Alexander', 'hello', 'bottom', 3672812, 0, '2018-04-23 03:58:00'),
('ross', 'Alexander', 'obi wan', 'test', 2259074, 0, '2018-04-23 03:51:33'),
('ross', 'ross', 'hello there', 'Hi Ross', 473058, 0, '2018-04-23 03:50:38'),
('alexander', 'Alexander', 'top', 'top', 129770, 0, '2018-04-23 03:58:09'),
('Coursework', 'Alexander', 'kfnvnlskdlncksdclsdklcksamx', 'test for coursework', 4727441, 0, '2018-05-01 20:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `ID` int(10) NOT NULL,
  `player` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `level` smallint(2) NOT NULL,
  `exper` int(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `hitpoints` mediumint(3) NOT NULL,
  `attack` mediumint(3) NOT NULL,
  `defence` mediumint(3) NOT NULL,
  `maxhitpoints` smallint(3) NOT NULL,
  `scraps` int(11) NOT NULL,
  `destroyer` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`ID`, `player`, `email`, `level`, `exper`, `password`, `hitpoints`, `attack`, `defence`, `maxhitpoints`, `scraps`, `destroyer`) VALUES
(1, 'Alexander', 'ladd@test.com', 3, 42, '098f6bcd4621d373cade4e832627b4f6', 20, 11, 12, 20, 270, 19),
(11, 'ross', 'ross', 1, 0, 'edeee8f93fded5d72328f773125fb118', 30, 5, 5, 35, 20, 18),
(12, 'Coursework', 'coursework@test.com', 1, 3, '098f6bcd4621d373cade4e832627b4f6', 11, 5, 5, 35, 5, 18);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `stats` varchar(30) NOT NULL,
  `statadd` smallint(3) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` smallint(5) NOT NULL,
  `randid` int(9) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`ID`, `name`, `stats`, `statadd`, `price`, `amount`, `randid`, `type`) VALUES
(0, 'Quick repair', 'hitpoints', 5, 15, 5, 4344437, 'healing'),
(1, 'Regular repair', 'hitpoints', 10, 25, 5, 4343445, 'healing'),
(2, 'Full repair', 'hitpoints', 20, 45, 5, 3432423, 'healing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destroyers`
--
ALTER TABLE `destroyers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD UNIQUE KEY `randid` (`randid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destroyers`
--
ALTER TABLE `destroyers`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
