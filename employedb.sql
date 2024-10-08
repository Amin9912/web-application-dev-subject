-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 04:34 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `department table`
--

CREATE TABLE `department table` (
  `Dept Code` varchar(255) NOT NULL,
  `Dept Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department table`
--

INSERT INTO `department table` (`Dept Code`, `Dept Name`) VALUES
('IT011', 'IT Department');

-- --------------------------------------------------------

--
-- Table structure for table `employee details table`
--

CREATE TABLE `employee details table` (
  `Employee ID` varchar(255) NOT NULL,
  `First Name` varchar(255) NOT NULL,
  `Last Name` varchar(255) NOT NULL,
  `Phone Number` varchar(255) NOT NULL,
  `Birthdate` date NOT NULL,
  `Salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee details table`
--

INSERT INTO `employee details table` (`Employee ID`, `First Name`, `Last Name`, `Phone Number`, `Birthdate`, `Salary`) VALUES
('1', 'Test', 'User', '0123456789', '2024-08-01', 1300),
('2', 'Test', 'User', '0123456789', '2024-08-02', 13123),
('3', 'Test', 'User', '0123456789', '2024-08-01', 1300);

-- --------------------------------------------------------

--
-- Table structure for table `employee leave`
--

CREATE TABLE `employee leave` (
  `Employee ID` varchar(255) NOT NULL,
  `Leave Date From` date NOT NULL,
  `Leave Date To` date NOT NULL,
  `Number of Days Applied For` int(11) NOT NULL,
  `Leave Type` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee leave`
--

INSERT INTO `employee leave` (`Employee ID`, `Leave Date From`, `Leave Date To`, `Number of Days Applied For`, `Leave Type`, `Status`) VALUES
('3', '2024-08-01', '2024-08-04', 2, 'Sick leave', 'Approved'),
('3', '2024-08-13', '2024-08-09', 4, 'Public holiday', 'Reject'),
('3', '2024-08-12', '2024-08-31', 15, 'Casual leave', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `employee table`
--

CREATE TABLE `employee table` (
  `Employee ID` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Dept Code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee table`
--

INSERT INTO `employee table` (`Employee ID`, `Password`, `Dept Code`) VALUES
('3', '202cb962ac59075b964b07152d234b70', 'IT011');

-- --------------------------------------------------------

--
-- Table structure for table `holiday table`
--

CREATE TABLE `holiday table` (
  `id` int(11) NOT NULL,
  `Date From` date NOT NULL,
  `Date To` date NOT NULL,
  `Type of Public Holiday` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday table`
--

INSERT INTO `holiday table` (`id`, `Date From`, `Date To`, `Type of Public Holiday`) VALUES
(1, '2024-08-02', '2024-08-03', 'New Year 2024'),
(2, '2024-08-20', '2024-08-25', 'Christmas\r\n');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department table`
--
ALTER TABLE `department table`
  ADD PRIMARY KEY (`Dept Code`);

--
-- Indexes for table `employee details table`
--
ALTER TABLE `employee details table`
  ADD PRIMARY KEY (`Employee ID`);

--
-- Indexes for table `employee table`
--
ALTER TABLE `employee table`
  ADD PRIMARY KEY (`Employee ID`);

--
-- Indexes for table `holiday table`
--
ALTER TABLE `holiday table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `holiday table`
--
ALTER TABLE `holiday table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
