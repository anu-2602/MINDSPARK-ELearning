-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 10:23 AM
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
-- Database: `mindspark_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addcourse`
--

CREATE TABLE `addcourse` (
  `id` int(3) NOT NULL,
  `course_title` varchar(30) NOT NULL,
  `course_category` varchar(30) NOT NULL,
  `course_description` varchar(150) NOT NULL,
  `course_thumbnail` varchar(150) NOT NULL,
  `video_link` varchar(150) NOT NULL,
  `pdfFileInput` varchar(150) NOT NULL,
  `handwrittenFileInput` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addcourse`
--

INSERT INTO `addcourse` (`id`, `course_title`, `course_category`, `course_description`, `course_thumbnail`, `video_link`, `pdfFileInput`, `handwrittenFileInput`) VALUES
(1, 'java development', 'Beginner', 'The Java Development Basic Course is designed for beginners to learn the fundamentals of Java programming. ', 'java.jpeg', 'https://youtu.be/fmX84zu-5gs?si=1VnbXTWuBHiX7SDU', 'java.pdf', 'java_handwritten_compressed.pdf'),
(2, 'cloud computing', 'Intermediate', 'The Cloud Computing Basic Course introduces the fundamentals of cloud technology and its applications. ', 'cloud.jpeg', 'https://youtu.be/gIWel4gFZaY?si=jdhGO3kthiIFQoiY', 'cloud.pdf', 'handwritten-cloud-computing.pdf'),
(3, 'java development', 'Intermediate', 'java is a computer language . This course is helps you with the java language learning .', 'cloud.jpeg', 'EUDHFCUQEAF', 'datbase.pdf', '104802585_ExamForm.PDF'),
(4, 'web development', 'Advanced', 'this web development course contains the knowledge for making attractive and proper websites.', 'webdev.jpeg', 'https://youtu.be/k2DSi1zGEc8?si=stIOqKHm_hPDUqHI', 'WEB APPLICATION DEVELOPMENT.pdf', '658986890-Web-Dev-Handwritten-Notes.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `interest` varchar(30) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `interest`, `message`) VALUES
(0, 'Unde Anushka', 'undeanushka2602@gmail.com', 'java', 'want to know more about the java cources.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`) VALUES
(0, 'Unde Anushka', 'undeanushka2602@gmail.com', 'very helpfull and interesting');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(3) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `expertise` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `fname`, `lname`, `username`, `email`, `pass`, `expertise`) VALUES
(1, 'Unde', 'Anushka', 'anushka', 'undeanushka@gmail.com', '1234', 'full stack development'),
(2, 'rushi', 'ushir', 'rushikesh', 'rushi@gmail.com', 'rushi123', 'cloud computing'),
(3, '', '', '', '', '', ''),
(4, 'sneha', 'murtadak', 'sneha', 'sneha@gmail.com', 'sneha', 'web development'),
(5, 'sneha', 'murtadak', 'sneha', 'sneha@gmail.com', 'sneha', 'web development'),
(6, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(3) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fname`, `lname`, `username`, `email`, `pass`) VALUES
(1, 'Anushka ', 'Unde', 'anu2602', 'undeanushka2602@gmail.com', 'anu@2602'),
(2, 'Rushi', 'Ushir', 'rushi1911', 'rushiushir@gmail.com', 'rushi@1911'),
(3, 'ankita ', 'katware', 'anku', 'ankita@gmail.com', 'anku'),
(4, 'ankita ', 'katware', 'anku', 'ankita@gmail.com', 'anku');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addcourse`
--
ALTER TABLE `addcourse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addcourse`
--
ALTER TABLE `addcourse`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
