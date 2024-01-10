-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 04:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcframework`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`) VALUES
(12, '1', 'td', 'test1232131dsad', '0000-00-00 00:00:00'),
(14, '1', 'sdfs', 'sdf', '0000-00-00 00:00:00'),
(16, '1', 'sdfsdf', 'sdf', '0000-00-00 00:00:00'),
(17, '1', 'sdfs', 'fsdf', '0000-00-00 00:00:00'),
(18, '1', 'sdfsdf', 'sdfsf', '0000-00-00 00:00:00'),
(19, '1', 'sdfsdf', 'sdfsf', '0000-00-00 00:00:00'),
(20, '1', 'sdfsdf', 'sdfdf', '0000-00-00 00:00:00'),
(21, '1', 'sfsdf', 'sdfsdf', '0000-00-00 00:00:00'),
(22, '1', 'sdfsdf', 'sdfs', '0000-00-00 00:00:00'),
(23, '1', 'sdfsd', 'fsdf', '0000-00-00 00:00:00'),
(24, '1', 'sdfsdf', 'sdf', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `st_profile`
--

CREATE TABLE `st_profile` (
  `st_email` varchar(255) NOT NULL,
  `st_ic` varchar(255) NOT NULL,
  `st_fullname` varchar(255) NOT NULL,
  `st_gender` varchar(255) NOT NULL,
  `st_race` varchar(255) NOT NULL,
  `st_address` text NOT NULL,
  `univ_code` varchar(255) NOT NULL,
  `st_image` text NOT NULL,
  `st_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_profile`
--

INSERT INTO `st_profile` (`st_email`, `st_ic`, `st_fullname`, `st_gender`, `st_race`, `st_address`, `univ_code`, `st_image`, `st_id`) VALUES
('anaspikri01@gmail.com', '', '', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `datetime_register` datetime DEFAULT NULL,
  `user_reg_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `user_role`, `datetime_register`, `user_reg_status`) VALUES
(1, 'ayam', 'ayam@gmail.com', '$2y$10$MBAyRvGHJb.IDzlhmc.gP.DI3hDHOGYqCQ0xnIJkKq9HAAQItJ2c6', '', NULL, ''),
(2, 'ayam2', 'ayam2@gmail.com', '$2y$10$ntRAygVnM5sH9u9iJbsInOJiGZ83z3q/0XU49DcIDJ7VzKg6rTzx6', '', NULL, ''),
(3, 'muhammadanas', 'anaspikri13@gmail.com', '$2y$10$40t02M6pZIYfTZZ92qW44eq6VkyifxAi5spZSiJlYoNJrrANW3WBW', 'Student', '2023-12-31 22:16:31', 'active'),
(4, 'Anaspikri', 'anaspikri01@gmail.com', '$2y$10$kdLA0l7uhyX4zBTB8BqLp.JLk.JrcgwXDGR2.Pl5f7QQEWk8DjQ9a', 'Student', '2024-01-04 16:23:58', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `st_profile`
--
ALTER TABLE `st_profile`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `st_profile`
--
ALTER TABLE `st_profile`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
