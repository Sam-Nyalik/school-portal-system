-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2023 at 04:51 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_portal_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attended_lecture`
--

CREATE TABLE `attended_lecture` (
  `attendanceID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `attended` tinyint(1) NOT NULL,
  `lectureID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `classroomID` int(11) NOT NULL,
  `room_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `course_length` int(11) DEFAULT NULL,
  `course_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `departmentID`, `course_length`, `course_name`) VALUES
(1, 1, 2, 'Diploma in Community Health and Development'),
(2, 1, 4, 'BSc. in Community Health and Development'),
(3, 1, 4, 'BSc. In Sport Science'),
(4, 2, 2, 'Diploma in Information Technology'),
(5, 2, 2, 'Diploma in Library and Information Science'),
(6, 2, 2, 'Diploma in Archives and Records Management'),
(7, 2, 4, 'BSc. in Computer Science'),
(8, 2, 4, 'BSc. in Library and Information Science'),
(9, 3, 4, 'BSc. in Actuarial Science'),
(10, 3, 4, 'BSc. In Mathematics'),
(11, 3, 1, 'MSc. in Mathematics'),
(12, 3, 3, 'PhD in Mathematics'),
(13, 4, 4, 'BSc. In Biology'),
(14, 4, 4, 'BSc. In Chemistry'),
(15, 4, 4, 'BSc. In Physics');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `department_name`) VALUES
(1, 'Community Health'),
(2, 'Computer Science'),
(3, 'Mathematics'),
(4, 'Natural Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `lectureID` int(11) NOT NULL,
  `lecturerID` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `classroomID` int(11) NOT NULL,
  `unitID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecturerID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecturerID`, `userID`, `departmentID`) VALUES
(15, 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleID`, `role_name`) VALUES
(1, 'admin'),
(2, 'student'),
(3, 'lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentID` int(11) NOT NULL,
  `enrol_date` datetime NOT NULL DEFAULT current_timestamp(),
  `date_of_birth` date NOT NULL,
  `year` int(11) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentID`, `enrol_date`, `date_of_birth`, `year`, `userID`, `courseID`) VALUES
(17, '2023-03-11 13:41:15', '2023-03-01', 1, 38, 12);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unitID` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `lecturerID` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unit_registration`
--

CREATE TABLE `unit_registration` (
  `registrationID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `unitID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `gender`, `roleID`) VALUES
(37, 'Admin', 'admin', 'admin@gmail.com', '0722733456', '$2y$10$8hfHc.9W8AMvNl3/LjKtX.PQbCi9oY7dI/d/GPyS3RQSTkUeCMsTq', 'male', 1),
(38, 'Student', 'Student', 'student@gmail.com', '0702926976', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'male', 2),
(39, 'Lec', 'Lec', 'lec@gmail.com', '0745637465', '$2y$10$j.Unry0e4LnPjGLUaxnEE.Ixp2l7.2PRA.2jgx.PZJYZJTXK94fsq', 'male', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attended_lecture`
--
ALTER TABLE `attended_lecture`
  ADD PRIMARY KEY (`attendanceID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `lectureID` (`lectureID`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`classroomID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lectureID`),
  ADD KEY `lecturerID` (`lecturerID`),
  ADD KEY `classroomID` (`classroomID`),
  ADD KEY `unitID` (`unitID`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecturerID`),
  ADD KEY `departmentID` (`departmentID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unitID`),
  ADD KEY `lecturerID` (`lecturerID`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `unit_registration`
--
ALTER TABLE `unit_registration`
  ADD PRIMARY KEY (`registrationID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `unitID` (`unitID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleID` (`roleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attended_lecture`
--
ALTER TABLE `attended_lecture`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `classroomID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `lectureID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lecturerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `unit_registration`
--
ALTER TABLE `unit_registration`
  MODIFY `registrationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attended_lecture`
--
ALTER TABLE `attended_lecture`
  ADD CONSTRAINT `attended_lecture_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`),
  ADD CONSTRAINT `attended_lecture_ibfk_2` FOREIGN KEY (`lectureID`) REFERENCES `lecture` (`lectureID`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`);

--
-- Constraints for table `lecture`
--
ALTER TABLE `lecture`
  ADD CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`lecturerID`) REFERENCES `lecturers` (`lecturerID`),
  ADD CONSTRAINT `lecture_ibfk_2` FOREIGN KEY (`classroomID`) REFERENCES `classroom` (`classroomID`),
  ADD CONSTRAINT `lecture_ibfk_3` FOREIGN KEY (`unitID`) REFERENCES `units` (`unitID`);

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `lecturers_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`),
  ADD CONSTRAINT `lecturers_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`);

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_ibfk_1` FOREIGN KEY (`lecturerID`) REFERENCES `lecturers` (`lecturerID`),
  ADD CONSTRAINT `units_ibfk_2` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`);

--
-- Constraints for table `unit_registration`
--
ALTER TABLE `unit_registration`
  ADD CONSTRAINT `unit_registration_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`),
  ADD CONSTRAINT `unit_registration_ibfk_2` FOREIGN KEY (`unitID`) REFERENCES `units` (`unitID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
