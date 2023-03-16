-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 10:14 AM
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
(1, 1, 2, '	Diploma in Community Health and Development'),
(2, 1, 4, '	BSc. in Community Health and Development'),
(3, 1, 4, '	BSc. In Sport Science'),
(4, 2, 2, '	Diploma in Information Technology'),
(5, 2, 2, '	Diploma in Library and Information Science'),
(6, 2, 2, '	Diploma in Archives and Records Management'),
(7, 2, 4, '	BSc. in Computer Science'),
(8, 2, 4, '	BSc. in Library and Information Science'),
(9, 3, 4, '	BSc. in Actuarial Science'),
(10, 3, 4, '	BSc. In Mathematics'),
(11, 3, 1, '	MSc. in Mathematics'),
(12, 3, 3, '	PhD in Mathematics'),
(13, 4, 4, '	BSc. In Biology'),
(14, 4, 4, '	BSc. In Chemistry'),
(15, 4, 4, '	BSc. In Physics');

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
(1, 1, 3),
(2, 2, 3),
(3, 3, 2),
(4, 4, 2),
(5, 5, 4),
(6, 6, 4),
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
(1, '2023-01-06 12:11:36', '1974-03-01', 1, 7, 10),
(2, '2020-01-01 12:10:11', '2001-03-01', 4, 8, 10),
(3, '2023-01-06 12:11:36', '2003-02-11', 1, 9, 7),
(4, '2021-01-01 12:10:11', '2003-12-11', 3, 10, 7),
(5, '2023-01-06 12:11:36', '1999-03-01', 1, 11, 13),
(6, '2020-01-01 12:10:11', '2003-11-17', 4, 12, 13),
(17, '2023-01-06 12:11:36', '2005-01-23', 1, 38, 10);

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

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitID`, `title`, `lecturerID`, `year`, `courseID`) VALUES
('1', 'Calculus 1', 1, 1, 10),
('10', 'Numerical Analysis', 2, 3, 10),
('11', 'Analysis 2', 2, 4, 10),
('12', 'Differential Equations', 2, 4, 10),
('13', 'Combinatorics', 2, 4, 10),
('14', 'Applied Mathematics', 2, 4, 10),
('15', 'Algebraic Structures', 2, 4, 10),
('16', 'Introduction to Programming', 3, 1, 7),
('17', 'Discrete Mathematics', 3, 1, 7),
('18', 'Database Systems', 3, 1, 7),
('19', 'Computer Organization and Architecture', 3, 1, 7),
('2', 'Linear Algebra', 1, 1, 10),
('20', 'Web Development', 3, 2, 7),
('21', 'Data Structures and Algorithms', 3, 2, 7),
('22', 'Operating Systems', 3, 2, 7),
('23', 'Computer Networks', 3, 2, 7),
('24', 'Software Engineering', 4, 3, 7),
('25', 'Artificial Intelligence', 4, 3, 7),
('26', 'Advanced Programming', 4, 3, 7),
('27', 'Database Administration', 4, 3, 7),
('28', 'Computer Security', 4, 4, 7),
('29', 'Distributed Systems', 4, 4, 7),
('3', 'Statistics 1', 1, 1, 10),
('30', 'Mobile App Development', 4, 4, 7),
('31', 'Introduction to Biology', 5, 1, 13),
('32', 'General Chemistry', 5, 1, 13),
('33', 'Introduction to Biotechnology', 5, 1, 13),
('34', 'Cell Biology', 5, 1, 13),
('35', 'Principles of Genetics', 5, 2, 13),
('36', 'Principles of Biochemistry', 5, 2, 13),
('37', 'Evolutionary Biology', 5, 2, 13),
('38', 'Environmental Science', 6, 3, 13),
('39', 'Animal Physiology', 6, 3, 13),
('4', 'Discrete Mathematics', 1, 1, 10),
('40', 'Immunology', 6, 3, 13),
('41', 'Neurobiology', 6, 3, 13),
('42', 'Human Anatomy', 6, 4, 13),
('43', 'Molecular Biology', 6, 4, 13),
('44', 'Medical Microbiology', 6, 4, 13),
('45', 'Pharmacology', 6, 4, 13),
('5', 'Calculus 2', 1, 2, 10),
('6', 'Mathematical Modelling', 1, 2, 10),
('7', 'Probability Theory', 1, 2, 10),
('8', 'Analysis 1', 1, 3, 10),
('9', 'Geometry and Topology', 2, 3, 10);

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
(1, 'Juma', 'Hassan', 'jh@gmail.com', '702874369', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'male', 3),
(2, 'Beatrice', 'Maina', 'bmaina@gmail.com', '702874369', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'female', 3),
(3, 'Tom ', 'Omollo', 'tm@gmail.com', '722789654', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'male', 3),
(4, 'Catherine', 'Nafula', 'cnafs@gmail.com', '789654214', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'female', 3),
(5, 'Jackie', 'Moraa', 'jmoraa@gmail.com', '726987254', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'female', 3),
(6, 'Phillip', 'Kibet', 'pkibet@gmail.com', '720877254', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'male', 3),
(7, 'Andrew', 'Barasa', 'adb@gmail.com', '203698129', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'male', 2),
(8, 'Rachel', 'Kamau', 'rchk@gmail.com', '516936578', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'female', 2),
(9, 'Mercy', 'Mueni', 'mm@gmail.com', '789542411', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'female', 2),
(10, 'John ', 'Kyalo', 'jkyalo@gmail.com', '754136941', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'male', 2),
(11, 'Georgina', 'Aketch', 'gaketch@gmail.com', '874632569', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'female', 2),
(12, 'Dennis', 'Ian', 'dian@gmail.com', '234567123', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'male', 2),
(37, 'Admin', 'admin', 'admin@gmail.com', '722733456', '$2y$10$8hfHc.9W8AMvNl3/LjKtX.PQbCi9oY7dI/d/GPyS3RQSTkUeCMsTq', 'male', 1),
(38, 'Student', 'Student', 'student@gmail.com', '702926976', '$2y$10$qvEDeizbVlR/.3pMBwYQL.kigfbcMtr5WGkdMYbkBkAppYQ/hThFC', 'male', 2),
(39, 'Lec', 'Lec', 'lec@gmail.com', '745637465', '$2y$10$j.Unry0e4LnPjGLUaxnEE.Ixp2l7.2PRA.2jgx.PZJYZJTXK94fsq', 'male', 3);

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
