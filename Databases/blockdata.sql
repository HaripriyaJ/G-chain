-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2020 at 09:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blockdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

--- Password given to each employee is test
INSERT INTO `accounts` (`id`, `emp_id`, `username`, `password`, `email`, `designation`, `weight`) VALUES
(1, 'eid1', 'Employee1', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'employee1@gmail.com', 'Clerk', 0),
(2, 'eid2', 'Employee2', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'employee2@gmail.com', 'Superior', 0),
(3, 'eid3', 'Employee3', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'employee3@gmail.com', 'Senior', 0);

-- --------------------------------------------------------

--
-- Table structure for table `applicant_db`
--

CREATE TABLE `applicant_db` (
  `aadhar` bigint(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicant_db`
--



-- --------------------------------------------------------

--
-- Table structure for table `approvaldb`
--

CREATE TABLE `approvaldb` (
  `uid` varchar(100) NOT NULL,
  `emp1` tinyint(1) NOT NULL,
  `emp1_time` int(25) NOT NULL,
  `emp2` tinyint(1) NOT NULL,
  `emp2_time` int(25) NOT NULL,
  `emp3` tinyint(1) NOT NULL,
  `emp3_time` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approvaldb`
--



-- --------------------------------------------------------

--
-- Table structure for table `commentdb`
--

CREATE TABLE `commentdb` (
  `uid` varchar(100) NOT NULL,
  `emp_name` varchar(25) NOT NULL,
  `time` int(25) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentdb`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicant_db`
--
ALTER TABLE `applicant_db`
  ADD PRIMARY KEY (`aadhar`);

--
-- Indexes for table `approvaldb`
--
ALTER TABLE `approvaldb`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `commentdb`
--
ALTER TABLE `commentdb`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `weekly` ON SCHEDULE EVERY 7 DAY STARTS '2020-06-09 14:17:53' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Deletes data older than 7 days' DO DELETE FROM commentdb WHERE time < UNIX_TIMESTAMP() - time$$

CREATE DEFINER=`root`@`localhost` EVENT `weeklyEvent` ON SCHEDULE EVERY 7 DAY STARTS '2020-06-09 14:59:21' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Deletes data every 7 days' DO DELETE FROM approvaldb WHERE emp1=-1 OR emp2=-1 OR emp3=-1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
