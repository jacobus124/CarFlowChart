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
-- Table structure for table `locationping`
--

CREATE TABLE `locationping` (
  `ID` int(11) NOT NULL,
  `Username` text DEFAULT NULL,
  `Location` text DEFAULT NULL,
  `Status` text DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Company` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locationping`
--

INSERT INTO `locationping` (`ID`, `Username`, `Location`, `Status`, `Date`, `Company`) VALUES
(2869, 'Jacobus', 'Main Site', 'Hier', '2021-05-06 09:50:53', '1'),
(2868, 'Jacobus', 'Michael huis', 'Hier', '2021-05-02 02:08:30', '1'),
(2867, 'Jacobus', 'Glossa toets', 'Hier', '2021-05-02 02:08:30', '1'),
(2866, 'Jacobus', 'Main Site', 'Hier', '2021-05-01 13:59:03', '1'),
(2864, 'Jacobus', 'Main Site', 'Hier', '2021-04-28 15:34:52', '1'),
(2865, 'Jacobus', 'Main Site', 'Hier', '2021-04-28 15:35:14', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `locationping`
--
ALTER TABLE `locationping`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locationping`
--
ALTER TABLE `locationping`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2870;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
