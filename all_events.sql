-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 01:05 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `all_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `employee_mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_mail`) VALUES
(1, 'Reto Fanzen', 'reto.fanzen@no-reply.rexx-systems.com'),
(2, 'Leandro Bußmann', 'leandro.bussmann@no-reply.rexx-systems.com'),
(3, 'Hans Schäfer', 'hans.schaefer@no-reply.rexx-systems.com'),
(4, 'Mia Wyss', 'mia.wyss@no-reply.rexx-systems.com');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `event_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`) VALUES
(1, 'PHP 7 crash course', '2019-09-04'),
(2, 'International PHP Conference', '2019-10-21'),
(3, 'code.talks', '2019-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `participations`
--

CREATE TABLE `participations` (
  `participation_id` int(11) NOT NULL,
  `employee_mail` varchar(100) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `participation_fee` decimal(10,2) DEFAULT NULL,
  `version` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participations`
--

INSERT INTO `participations` (`participation_id`, `employee_mail`, `event_id`, `participation_fee`, `version`) VALUES
(1, 'reto.fanzen@no-reply.rexx-systems.com', 1, '0.00', 'NULL'),
(2, 'reto.fanzen@no-reply.rexx-systems.com', 2, '1485.99', 'NULL'),
(3, 'leandro.bussmann@no-reply.rexx-systems.com', 2, '657.50', 'NULL'),
(4, 'hans.schaefer@no-reply.rexx-systems.com', 1, '0.00', 'NULL'),
(5, 'mia.wyss@no-reply.rexx-systems.com', 1, '0.00', 'NULL'),
(6, 'mia.wyss@no-reply.rexx-systems.com', 2, '657.50', '1.1.3'),
(7, 'reto.fanzen@no-reply.rexx-systems.com', 3, '474.81', 'NULL'),
(8, 'hans.schaefer@no-reply.rexx-systems.com', 3, '534.31', '1.1.3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_mail` (`employee_mail`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `participations`
--
ALTER TABLE `participations`
  ADD PRIMARY KEY (`participation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
