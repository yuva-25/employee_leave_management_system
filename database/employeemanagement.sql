-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2025 at 07:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employeemanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dep_id` int(15) NOT NULL,
  `dep_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dep_id`, `dep_name`) VALUES
(1, 'sales'),
(2, 'php'),
(3, 'ui');

-- --------------------------------------------------------

--
-- Table structure for table `emp_form`
--

CREATE TABLE `emp_form` (
  `emp_id` int(10) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `emp_mobile` varchar(10) NOT NULL,
  `emp_address` varchar(50) NOT NULL,
  `emp_dep` varchar(30) NOT NULL,
  `user_name` varchar(40) NOT NULL,
  `user_password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_form`
--

INSERT INTO `emp_form` (`emp_id`, `emp_name`, `emp_mobile`, `emp_address`, `emp_dep`, `user_name`, `user_password`) VALUES
(1, 'Arun kumar', '8234836487', '', 'sales', 'Arun', 'Arun@12'),
(2, 'Sivaji', '8236847638', '', 'php', 'Sivaji', 'Sivaji@12');

-- --------------------------------------------------------

--
-- Table structure for table `leave_form`
--

CREATE TABLE `leave_form` (
  `id` int(10) NOT NULL,
  `mobile_number` varchar(10) NOT NULL,
  `req_date` varchar(20) NOT NULL,
  `from_date` varchar(15) NOT NULL,
  `to_date` varchar(15) NOT NULL,
  `no_days` varchar(15) NOT NULL,
  `lev_reason` varchar(50) NOT NULL,
  `lev_type` varchar(20) NOT NULL,
  `lev_status` varchar(30) NOT NULL,
  `lev_remark` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_form`
--

INSERT INTO `leave_form` (`id`, `mobile_number`, `req_date`, `from_date`, `to_date`, `no_days`, `lev_reason`, `lev_type`, `lev_status`, `lev_remark`) VALUES
(1, '8234836487', '2025-02-21', '2025-02-22', '2025-02-23', '1', 'family trip', 'causalleave', 'rejected', 'not allowed'),
(2, '8236847638', '2025-02-21', '2025-02-22', '2025-02-23', '1', 'hospital', 'sickleave', 'approved', 'approve'),
(3, '8234836487', '2025-02-21', '2025-03-03', '2025-03-04', '1', 'family trip', 'causalleave', 'pending', ''),
(4, '8236847638', '2025-02-21', '2025-02-27', '2025-03-01', '2', 'family trip', 'causalleave', 'rejected', 'Not Allowed'),
(5, '8236847638', '2025-02-24', '2025-02-20', '2025-02-21', '1', 'Fever', 'sickleave', 'approved', 'Leave Accepted'),
(6, '8234836487', '2025-02-25', '2025-02-27', '2025-02-28', '1', 'Health Issue', 'sickleave', 'pending', ''),
(7, '8234836487', '2025-03-15', '2025-03-12', '2025-03-15', '3', 'family trip', 'causalleave', 'pending', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `emp_form`
--
ALTER TABLE `emp_form`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `leave_form`
--
ALTER TABLE `leave_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dep_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emp_form`
--
ALTER TABLE `emp_form`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_form`
--
ALTER TABLE `leave_form`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
