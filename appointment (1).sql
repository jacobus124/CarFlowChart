-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2021 at 03:53 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riddel`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `ID` int(11) NOT NULL,
  `AppointmentName` text DEFAULT NULL,
  `Rep` text DEFAULT NULL,
  `Lat` text NOT NULL,
  `Lng` text NOT NULL,
  `Date` datetime DEFAULT NULL,
  `Company` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`ID`, `AppointmentName`, `Rep`, `Lat`, `Lng`, `Date`, `Company`) VALUES
(13, 'Dr Toets', 'Jacobus', '-25.6843916', ' 28.1469289', '2021-04-19 15:46:00', '1'),
(14, 'Dr hier', 'Michael', '-25.8302618', ' 28.3011909', '2021-04-21 19:50:00', '1'),
(15, 'Dr hier', 'Jacobus', '-25.8302618', ' 28.3011909', '2021-04-21 19:50:00', '1'),
(16, 'Hids', 'Jacobus', '48.2428386', ' 12.5056618', '2021-04-22 16:51:00', '1'),
(22, 'Ruan', 'Michael', '-25.8601', ' 28.209703', '2021-05-25 13:21:54', '1'),
(23, 'Toets Location', 'Jacobus', '-25.8601', ' 28.209703', '2021-04-29 16:00:00', '1'),
(24, 'Toets Location', 'Jacobus', '-25.8601', ' 28.209703', '2021-05-13 21:25:00', '1'),
(25, 'Toets Location', 'Jacobus', '-25.8601', ' 28.209703', '2021-05-13 21:25:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
