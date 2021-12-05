-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2021 at 10:33 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inote_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `s_no` int(11) NOT NULL,
  `u_no` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `note` varchar(500) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`s_no`, `u_no`, `title`, `note`, `timestamp`) VALUES
(1, 1, 'Myname', 'my name is anwesha', '2021-11-22 19:38:41.000000'),
(2, 1, 'dbms', 'candidate key is minimal super key', '2021-11-25 18:22:53.000000'),
(3, 1, 'machine learning', 'machine learning is science to make computer learn and behave like human by feeding data and information without being programmed explicitly ', '2021-11-20 20:46:32.171581'),
(4, 1, 'class', 'tomorrow sng class at 10 am', '2021-11-20 20:47:12.018664'),
(5, 1, 'python', 'today i have to teach python from 1 am', '2021-11-21 17:54:24.872570'),
(7, 2, 'daughter ', 'my daughter is anwesha pal', '2021-11-22 19:32:43.000000'),
(9, 2, 'tea leaf', 'add warm water and tea leaf and add sugar', '2021-11-22 19:18:14.621651'),
(10, 1, 'class', 'i have no class today', '2021-11-25 18:28:32.359148'),
(14, 1, 'hola', 'holaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2021-11-27 20:45:31.743327'),
(18, 1, 'error', 'error \')', '2021-11-27 21:05:13.219391'),
(19, 1, 'name', 'o\'relly', '2021-11-27 21:12:09.961894'),
(20, 1, 'error', 'hi\')', '2021-11-27 21:12:31.586998');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_no` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_no`, `username`, `email`, `password`) VALUES
(1, 'Anwesha Pal', 'anweshapal617@gmail.com', '$2y$10$bOzA9MDWYSZpGFiBCsB2VOKrEdpvbqcx15KD7aRk.DDnKXwBnlvGC'),
(2, 'Anjana Pal', 'anjana@gmail.com', '$2y$10$P3ZtRm.vd.NXAMeOsewsW.Mb.njloy.7veuLkX.wOw2B8Tklg45WW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `u_no` (`u_no`);
ALTER TABLE `notes` ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`u_no`) REFERENCES `users` (`u_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
