-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2017 at 08:57 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpark`
--

-- --------------------------------------------------------

--
-- Table structure for table `park`
--

CREATE TABLE `park` (
  `ic` varchar(12) NOT NULL,
  `plate` varchar(7) NOT NULL,
  `dateenter` date NOT NULL,
  `timeenter` time NOT NULL,
  `dateout` date NOT NULL,
  `timeout` time NOT NULL,
  `price` double NOT NULL,
  `status` tinyint(4) NOT NULL,
  `staffic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `parkid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`parkid`, `quantity`) VALUES
(1, 50);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ic` varchar(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` enum('Administrator','Staff','Customer','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ic`, `name`, `username`, `phone`, `email`, `password`, `type`) VALUES
('971209095277', 'Aria', 'Aria', '0111075916', 'AriaX@gmail.com', '4a849230486a312a4d0e4416a497b97a', 'Customer'),
('971211075013', 'Danial Chan', 'dcrc97', '0174586595', 'dcrc97@yahoo.com', 'd02321c63ad918959edc438048a492e8', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `park`
--
ALTER TABLE `park`
  ADD PRIMARY KEY (`ic`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`parkid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ic`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
