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

-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `badge_id` int(11) NOT NULL,
  `badge_desc` varchar(255) NOT NULL,
  `badge_img` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `badge_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`badge_id`, `badge_desc`, `badge_img`, `user_id`, `badge_title`) VALUES
(2, 'dfsfd', 'Untitled Diagram.jpg', 1, 'asdas'),
(3, 'asd', '06D439C5-6E12-447F-87BB-77750DB927BE.png', 3, 'asd'),
(4, 'great 2', 'images/badges/lol2@gmail.com/659abe011aba64.77854818.png', 3, 'great'),
(5, 'sdv szvsvsv', 'images/badges/lol2@gmail.com/659ac19dd2b956.68060309.png', 3, 'sdvsdv');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`badge_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `badge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `act_id` int(11) NOT NULL,
  `act_title` varchar(255) NOT NULL,
  `act_desc` text NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `act_startdate` date NOT NULL DEFAULT '2023-01-01',
  `act_enddate` date NOT NULL DEFAULT '2023-01-01',
  `act_starttime` time NOT NULL,
  `act_endtime` time NOT NULL,
  `act_venue` varchar(255) NOT NULL,
  `act_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`act_id`, `act_title`, `act_desc`, `user_id`, `act_startdate`, `act_enddate`, `act_starttime`, `act_endtime`, `act_venue`, `act_image`) VALUES
(1, 'yolo', 'yololo', '1', '2023-01-01', '2023-01-01', '00:00:00', '00:00:00', '', ''),
(2, 'Entrepreneurship', 'DAQ', '1', '2023-01-02', '2023-01-20', '18:00:00', '16:00:00', 'DAC', 'event management subsystem class diagram (1).jpg'),
(4, 'matrix', 'weaponised virtue', '1', '2023-01-10', '2023-01-11', '12:00:00', '16:00:00', 'romania', 'images/activities/lol2@gmail.com/659ab77543bed2.26885543.jpg'),
(5, 'test time2', 'test time2', '1', '2023-01-01', '2023-01-01', '00:00:00', '00:00:00', '', ''),
(7, 'test time4', 'test time4', '1', '2023-01-01', '2023-01-01', '00:00:00', '00:00:00', '', ''),
(8, 'test time5', 'test time5', '1', '2023-01-01', '2023-01-01', '00:00:00', '00:00:00', '', ''),
(9, 'test time6', 'test time6', '1', '2023-01-01', '2023-01-01', '00:00:00', '00:00:00', '', ''),
(10, 'zsrhzsrhb', 'zsdrhbzer', '1', '2023-01-01', '2023-01-01', '00:00:00', '00:00:00', '', ''),
(11, 'zsegzsdvcxcx', 'zsdfdvzvdv', '1', '2023-01-01', '2023-01-01', '00:00:00', '00:00:00', '', ''),
(12, 'marathon', 'marathon2.0', '1', '2023-01-26', '2023-01-26', '16:00:00', '15:00:00', 'k9k10', 'images/activities/lol2@gmail.com/659ab73a083823.53161648.jpg'),
(13, '123asdasda', 'n28', '1', '2023-01-02', '2023-01-03', '15:00:00', '16:00:00', 'n28a', 'event management subsystem class diagram (1).jpg'),
(14, 'testnew1', 'testnew1', '1', '2023-12-14', '2023-12-15', '04:25:00', '05:25:00', 'testnew1', 'Untitled Diagram (2).jpg'),
(15, '213', 'wedewd', '1', '2023-12-21', '2023-12-06', '22:35:00', '22:35:00', 'wwedew', 'Untitled Diagram.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`act_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
