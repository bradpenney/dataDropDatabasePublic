-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2017 at 02:07 PM
-- Server version: 5.7.19-0ubuntu0.17.04.1
-- PHP Version: 7.0.18-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataDropsPublic`
--
CREATE DATABASE IF NOT EXISTS `dataDropsPublic` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dataDropsPublic`;

-- --------------------------------------------------------

--
-- Table structure for table `building1DataDrops`
--

CREATE TABLE `building1DataDrops` (
  `id` int(11) NOT NULL,
  `drop_num` varchar(10) NOT NULL,
  `switch_port` int(11) NOT NULL,
  `switch_name` varchar(10) NOT NULL,
  `vlan` varchar(10) DEFAULT NULL,
  `room_num` varchar(10) DEFAULT NULL,
  `rack_location` varchar(10) NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `building1RackLocations`
--

CREATE TABLE `building1RackLocations` (
  `id` int(11) NOT NULL,
  `rackLocation` varchar(10) NOT NULL,
  `numSwitches` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `building1VoiceDrops`
--

CREATE TABLE `building1VoiceDrops` (
  `id` int(11) NOT NULL,
  `voiceDrop` varchar(10) DEFAULT NULL,
  `demarcPort` varchar(10) DEFAULT NULL,
  `rackLocation` varchar(10) DEFAULT NULL,
  `roomNum` varchar(10) DEFAULT NULL,
  `phoneNum` varchar(15) DEFAULT NULL,
  `dateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building1DataDrops`
--
ALTER TABLE `building1DataDrops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building1RackLocations`
--
ALTER TABLE `building1RackLocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building1VoiceDrops`
--
ALTER TABLE `building1VoiceDrops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building1DataDrops`
--
ALTER TABLE `building1DataDrops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `building1RackLocations`
--
ALTER TABLE `building1RackLocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `building1VoiceDrops`
--
ALTER TABLE `building1VoiceDrops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
