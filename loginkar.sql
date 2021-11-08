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
-- Table structure for table `loginkar`
--

CREATE TABLE `loginkar` (
  `ID` int(11) NOT NULL,
  `Username` text DEFAULT NULL,
  `Password` text DEFAULT NULL,
  `Company` text DEFAULT NULL,
  `SesID` text DEFAULT NULL,
  `Permission` text DEFAULT NULL,
  `Lat` text DEFAULT NULL,
  `Lng` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loginkar`
--

INSERT INTO `loginkar` (`ID`, `Username`, `Password`, `Company`, `SesID`, `Permission`, `Lat`, `Lng`) VALUES
(1, 'Jacobus', '5481', '1', '30340', 'Admin', '-25.6843916', ' 28.1469289'),
(3, 'Ruan', 'Ruan1', '1', '68447', '', NULL, NULL),
(4, 'Michael', 'Mmarais01', '1', '3997', 'Admin', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loginkar`
--
ALTER TABLE `loginkar`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loginkar`
--
ALTER TABLE `loginkar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
