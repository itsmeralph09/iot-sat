-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 02:38 AM
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
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `ext_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `deleted` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `first_name`, `middle_name`, `last_name`, `ext_name`, `email`, `deleted`) VALUES
(1, 'ADMINIS', '', 'TRAITOR', '', 'admin@pcb.edu.ph', 0),
(6, 'ADMIN', 'IS', 'TRAITOR', '', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_tbl`
--

CREATE TABLE `attendance_tbl` (
  `attendance_id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `date_time` datetime NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_tbl`
--

INSERT INTO `attendance_tbl` (`attendance_id`, `uid`, `student_id`, `type`, `date_time`, `deleted`) VALUES
(233, '7B86B812', 6, 1, '2024-04-27 07:52:39', 0),
(234, '7B86B812', 6, 2, '2024-04-27 07:52:42', 0),
(235, '7B86B812', 6, 1, '2024-04-27 07:52:46', 0),
(236, '7B86B812', 6, 2, '2024-04-27 07:52:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_tbl`
--

CREATE TABLE `class_tbl` (
  `class_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `year` int(2) NOT NULL,
  `section` varchar(10) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_tbl`
--

INSERT INTO `class_tbl` (`class_id`, `program_id`, `year`, `section`, `deleted`) VALUES
(1, 4, 3, 'A', 0),
(4, 4, 3, 'B', 0),
(5, 4, 2, 'A', 0),
(6, 4, 2, 'B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE `department_tbl` (
  `department_id` int(11) NOT NULL,
  `department_code` varchar(50) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`department_id`, `department_code`, `department_name`, `deleted`) VALUES
(31, 'IED', 'INSTITUTE OF EDUCATION', 0),
(32, 'ICS', 'INSTITUTE OF COMPUTING STUDIES', 0);

-- --------------------------------------------------------

--
-- Table structure for table `device_tbl`
--

CREATE TABLE `device_tbl` (
  `device_id` int(11) NOT NULL,
  `device_code` varchar(100) NOT NULL,
  `last_active` datetime NOT NULL,
  `deleted` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_tbl`
--

INSERT INTO `device_tbl` (`device_id`, `device_code`, `last_active`, `deleted`) VALUES
(2, 'primaria', '2024-04-26 19:37:08', 0),
(3, 'exitus', '2024-04-26 19:45:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program_tbl`
--

CREATE TABLE `program_tbl` (
  `program_id` int(11) NOT NULL,
  `program_code` varchar(50) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_tbl`
--

INSERT INTO `program_tbl` (`program_id`, `program_code`, `program_name`, `department_id`, `deleted`) VALUES
(4, 'BSIT', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY', 31, 0),
(5, 'BEED', 'BACHELOR IN ELEMENTARY EDUCATION', 32, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `student_id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `ext_name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `guardian_contact` varchar(11) NOT NULL,
  `deleted` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`student_id`, `uid`, `first_name`, `middle_name`, `last_name`, `ext_name`, `class_id`, `email`, `contact`, `guardian_contact`, `deleted`) VALUES
(1, '62369751', 'KAREN', 'USBAL', 'DAGSAAN', '', 1, 'karendagsaan@pcb.edu.ph', '09111111111', '09111111111', 0),
(6, '7B86B812', 'ANGELA', 'LODI', 'DE LEON', '', 4, 'angeladeleon@pcb.edu.ph', '09333333333', '09333333333', 0),
(7, '6A2F081', 'KC', '', 'PETERS', '', 1, 'kcpeters@pcb.edu.ph', '09222222222', '09222222222', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` tinyint(2) NOT NULL,
  `deleted` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `email`, `password`, `usertype`, `deleted`) VALUES
(1, 'karendagsaan@pcb.edu.ph', '$2y$10$Lf3MUJKPBc8joNtdn61MGuODAA1pd9nwNAitbOQoi8c/KMpiMwI6i', 2, 0),
(2, 'admin@pcb.edu.ph', '$2y$10$A1gr88qyhkLMqj19y5mVqOaNo2Vj6qgSVONAs1A1cxDZcriPszxKS', 1, 0),
(10, 'angeladeleon@pcb.edu.ph', '$2y$10$HuNtCGLLJNxA6hlsqq6EGOdAm5er2SpmEf6cLuQJzy8WfKb4s17A.', 2, 0),
(11, 'kcpeters@pcb.edu.ph', '$2y$10$ztIule2qWpFAK4XjVSVdouswZc14A/gVlg4pcX.k6g5MKOhey8NtS', 2, 0),
(13, 'admin', '$2y$10$pJLMjxZels0wBkmn.uhJuuN.lmMcxzU8OCcZn4KELePqyQswb8djS', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `class_tbl`
--
ALTER TABLE `class_tbl`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `department_tbl`
--
ALTER TABLE `department_tbl`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `device_tbl`
--
ALTER TABLE `device_tbl`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `program_tbl`
--
ALTER TABLE `program_tbl`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendance_tbl`
--
ALTER TABLE `attendance_tbl`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `class_tbl`
--
ALTER TABLE `class_tbl`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_tbl`
--
ALTER TABLE `department_tbl`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `device_tbl`
--
ALTER TABLE `device_tbl`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_tbl`
--
ALTER TABLE `program_tbl`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
