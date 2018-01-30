-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2018 at 09:08 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conference`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`, `profile_image`) VALUES
(1, 'Admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, ''),
(2, 'Test', 'test@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, ''),
(3, 'Test2', 'test2@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, ''),
(7, 'Test3', 'test3@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `call_user`
--

CREATE TABLE `call_user` (
  `id` int(11) NOT NULL,
  `caller_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_user`
--

INSERT INTO `call_user` (`id`, `caller_id`, `receiver_id`, `status`, `date`) VALUES
(9, 2, 1, 1, '2018-01-30 19:38:42'),
(10, 1, 2, 1, '2018-01-30 19:40:27'),
(11, 1, 2, 1, '2018-01-30 19:42:29'),
(12, 2, 1, 1, '2018-01-30 19:46:33'),
(13, 1, 2, 1, '2018-01-30 19:48:37'),
(14, 1, 2, 1, '2018-01-30 19:51:19'),
(15, 1, 2, 1, '2018-01-30 19:56:53'),
(16, 1, 2, 1, '2018-01-30 20:05:31'),
(17, 1, 2, 1, '2018-01-30 20:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE `conferences` (
  `id` int(11) NOT NULL,
  `conference_created_by` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `conference_id` varchar(30) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conferences`
--

INSERT INTO `conferences` (`id`, `conference_created_by`, `name`, `conference_id`, `start_time`) VALUES
(3, 1, 'Hello World', '1516177977', '2018-01-18 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `conference_attend_users`
--

CREATE TABLE `conference_attend_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `conference_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conference_attend_users`
--

INSERT INTO `conference_attend_users` (`id`, `user_id`, `conference_id`, `status`) VALUES
(3, 1, 3, 0),
(4, 2, 3, 0),
(5, 7, 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_user`
--
ALTER TABLE `call_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conferences`
--
ALTER TABLE `conferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conference_attend_users`
--
ALTER TABLE `conference_attend_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `call_user`
--
ALTER TABLE `call_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `conferences`
--
ALTER TABLE `conferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `conference_attend_users`
--
ALTER TABLE `conference_attend_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
