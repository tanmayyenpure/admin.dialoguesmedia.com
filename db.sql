
-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2023 at 11:44 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dialoguesmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

DROP TABLE IF EXISTS `adminlogin`;
CREATE TABLE IF NOT EXISTS `adminlogin` (
  `user_id` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`user_id`, `user_password`) VALUES
('admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `aadhar_card_no` varchar(25) NOT NULL,
  `pan_card` varchar(25) NOT NULL,
  `mobile_number` varchar(25) DEFAULT NULL,
  `department_name` varchar(50) DEFAULT NULL,
  `job_role` varchar(25) DEFAULT NULL,
  `employee_type` int(5) DEFAULT 1,
  PRIMARY KEY (`emp_id`),
  UNIQUE KEY `name_uniq` (`name`),
  UNIQUE KEY `aadhar_no` (`aadhar_card_no`) USING BTREE,
  UNIQUE KEY `pan_card` (`pan_card`),
  UNIQUE KEY `mobile_number` (`mobile_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `name`, `aadhar_card_no`, `pan_card`, `mobile_number`, `department_name`, `job_role`, `employee_type`) VALUES
('DM001', 'NANDINI', '123457866666', 'BFEDDLLAP', '111111111111111', 'Web', 'intern', 1),
('DM004', 'pqrs', '1213213', '323232', '33213213', NULL, NULL, 2),
('DM005', 'John Doe', '111111111111', 'BFHGDEEP', '111111111111112', '', 'HR head', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employeetasks`
--

DROP TABLE IF EXISTS `employeetasks`;
CREATE TABLE IF NOT EXISTS `employeetasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `attendance_date` date NOT NULL,
  `attendance` int(11) DEFAULT NULL,
  `entry_time` datetime NOT NULL DEFAULT current_timestamp(),
  `emp_id` varchar(10) NOT NULL,
  `task1` text DEFAULT NULL,
  `task2` text DEFAULT NULL,
  `task3` text DEFAULT NULL,
  `task4` text DEFAULT NULL,
  `task5` text DEFAULT NULL,
  `workdone1` text DEFAULT NULL,
  `workdone2` text DEFAULT NULL,
  `workdone3` text DEFAULT NULL,
  `workdone4` text DEFAULT NULL,
  `workdone5` text DEFAULT NULL,
  `backlog` text DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `opening` tinyint(1) DEFAULT NULL,
  `closing` tinyint(1) DEFAULT NULL,
  `emp_image` blob DEFAULT NULL,
  `opening_time` datetime DEFAULT NULL,
  `closing_time` datetime DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  UNIQUE KEY `uc_emp_attendance` (`emp_id`,`attendance_date`) USING BTREE,
  UNIQUE KEY `Date_Attendance` (`attendance_date`,`attendance`,`emp_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeetasks`
--

INSERT INTO `employeetasks` (`task_id`, `attendance_date`, `attendance`, `entry_time`, `emp_id`, `task1`, `task2`, `task3`, `task4`, `task5`, `workdone1`, `workdone2`, `workdone3`, `workdone4`, `workdone5`, `backlog`, `reason`, `opening`, `closing`, `emp_image`, `opening_time`, `closing_time`) VALUES
(1, '2023-12-19', 1, '2023-12-20 16:17:09', 'DM001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nil', 'nil', 0, 1, NULL, '2023-12-19 10:30:00', '2023-12-19 19:00:00'),
(3, '2023-12-21', 0, '2023-12-22 12:23:28', 'DM004', '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', NULL, NULL, NULL, '2023-12-22 10:48:50', NULL),
(4, '2023-12-20', 1, '2023-12-22 12:28:46', 'DM004', 'Task 1', 'Task 4', 'Task 3', '', '', 'Work Done 1', 'Work Done 2', '', 'Work Done 4', '', 'none', 'none', NULL, NULL, NULL, '2023-12-22 10:53:20', '2023-12-22 10:54:55'),
(7, '2023-12-21', 0, '2023-12-22 17:32:43', 'DM005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ill', NULL, NULL, NULL, NULL, NULL),
(8, '2023-12-20', 1, '2023-12-22 17:39:39', 'DM005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL),
(9, '2023-12-22', 1, '2023-12-22 17:56:54', 'DM004', 'Update Attendance', 'Write Code for it', 'Task 3', 'Task 4', '', 'Finished Task !', 'Finished Task 2', '', '', '', '', '', NULL, NULL, NULL, '2023-12-22 12:39:23', '2023-12-22 12:38:53'),
(10, '2023-12-18', 1, '2023-12-22 19:01:29', 'DM001', 'Task 1', 'Task 2', 'Task 3', NULL, NULL, 'Work Done 1', 'Finished Task !', NULL, NULL, NULL, 'none', '', NULL, NULL, NULL, '2023-12-22 13:32:58', '2023-12-22 13:33:18'),
(11, '2023-12-23', 1, '2023-12-23 12:16:11', 'DM001', 'Change Login Page Add Camera And Location', 'Make UI Changes improve UI', 'Add Time Columns of Opening and CLosing', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, '2023-12-23 10:15:01', '2023-12-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` int(255) NOT NULL,
  `date` varchar(100) NOT NULL,
  `visitor` int(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `designation`, `company`, `address`, `mobile`, `email`, `city`, `state`, `pincode`, `date`, `visitor`, `language`, `languages`, `image`, `feedback`) VALUES
(3, 'xjjbzjkv', 'ddvsjdvsv', 'ddvdvksndv', 'vdbsjvd', 3423423, 'dfsf@gmail.com', 'gg', 'gdfg', 345454, '', 2, '', '', '', 'vdsgfdsf'),
(4, 'deepanhu', 'dfdg', 'fgff', 'fdgfgf', 4545435, 'rtrtret@gmail.com', 'fdgfd', 'fdgdfg', 4545, '4/12/34', 4, 'gfgf', 'fg', 'fgfg', 'dfg'),
(5, 'eeeeee', 'dddd', 'fffff', 'ccccc', 33333, 'dsd@gmail.com', 'dfg', 'fgdf', 343, '', 2, '', '', '', 'sdfdfvdv'),
(6, 'eeeeee', 'dddd', 'fffff', 'ccccc', 33333, 'dsd@gmail.com', 'dfg', 'fgdf', 343, '', 2, '', '', '', 'sdfdfvdv'),
(7, 'eeeeee', 'dddd', 'fffff', 'ccccc', 33333, 'dsd@gmail.com', 'dfg', 'fgdf', 343, '', 2, '', '', '', 'sdfdfvdv'),
(8, 'eeeeee', 'dddd', 'fffff', 'ccccc', 33333, 'dsd@gmail.com', 'dfg', 'fgdf', 343, '', 2, '', '', '', 'sdfdfvdv'),
(9, 'eeeeee', 'dddd', 'fffff', 'ccccc', 33333, 'dsd@gmail.com', 'dfg', 'fgdf', 343, '', 2, '', '', '', 'sdfdfvdv'),
(10, 'eeeeee', 'dddd', 'fffff', 'ccccc', 33333, 'dsd@gmail.com', 'dfg', 'fgdf', 343, '', 2, '', '', '', 'sdfdfvdv'),
(11, 'dfsf', 'dsff', 'dfs', 'sdf', 0, 'dsf', 'dsfd', 'sdf', 0, '', 4, 'NO', 'NO', '', 'dsffdsf'),
(12, 'dfsf', 'dsff', 'dfs', 'sdf', 0, 'dsf', 'dsfd', 'sdf', 0, '', 4, 'NO', 'NO', '', 'dsffdsf'),
(13, 'dfsf', 'dsff', 'dfs', 'sdf', 0, 'dsf', 'dsfd', 'sdf', 0, '', 4, 'NO', 'NO', '', 'dsffdsf'),
(14, 'dfsf', 'dsff', 'dfs', 'sdf', 0, 'dsf', 'dsfd', 'sdf', 0, '', 4, 'NO', 'NO', '', 'dsffdsf'),
(15, 'dfsf', 'dsff', 'dfs', 'sdf', 0, 'dsf', 'dsfd', 'sdf', 0, '', 4, 'NO', 'NO', '', 'dsffdsf'),
(16, 'dfsf', 'dsff', 'dfs', 'sdf', 0, 'dsf', 'dsfd', 'sdf', 0, '', 4, 'NO', 'NO', '', 'dsffdsf'),
(17, 'dfsf', 'dsff', 'dfs', 'sdf', 0, 'dsf', 'dsfd', 'sdf', 0, '', 4, 'NO', 'NO', '', 'dsffdsf'),
(18, 'errrr', 'rrrrr', 'rrwww', 'wwwww', 333223, 'ewe@gmail.com', 'rf', 'sd', 2, '', 2, 'NO', 'NO', '', 'dsf'),
(19, '', '', '', '', 0, '', '', '', 0, '', 0, '', '', '', ''),
(21, '', '', '', '', 0, '', '', '', 0, '', 0, '', '', '', ''),
(22, 'rrre', 'fdgdf', 'fd', 'df', 4365, 'dfgd@gmail.com', 'rfgd', 'fdgfd', 43545, '01-01-1970', 4, '', '', '', 'fdbcvvbcvv'),
(23, 'fdhg', 'cfd', 'gdf', 'gdf', 5465454, 'dfd@gmail.com', 'retrr', 'rfyt', 435, '01-01-1970', 5, '', '', '', 'dfgbgdfgf');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employeetasks`
--
ALTER TABLE `employeetasks`
  ADD CONSTRAINT `Employee_Task` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
