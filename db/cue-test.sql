-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2018 at 05:44 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cue-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `title`, `category_id`) VALUES
(1, 'PHP', 1),
(2, 'Javascript', 1),
(3, 'ASP', 1),
(4, 'Perl', 1),
(5, 'Ruby', 1),
(6, 'C', 2),
(7, 'C++', 2),
(8, 'JAVA', 2),
(9, 'Delphi', 2),
(10, 'MySQL', 3),
(11, 'MSSQL', 3),
(12, 'Oracle', 3),
(13, 'PostgreSQL', 3),
(14, 'Communication', 4),
(15, 'Leadership', 4),
(16, 'Diligence', 4);

-- --------------------------------------------------------

--
-- Table structure for table `skill_categories`
--

CREATE TABLE `skill_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skill_categories`
--

INSERT INTO `skill_categories` (`id`, `title`) VALUES
(1, 'Scripting Languages'),
(2, 'Other Languages'),
(3, 'Databases'),
(4, 'Personal Skills');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_skills`
--

CREATE TABLE `user_skills` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `marks` tinyint(1) NOT NULL,
  `created_at` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill_categories`
--
ALTER TABLE `skill_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_skills`
--
ALTER TABLE `user_skills`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `skill_categories`
--
ALTER TABLE `skill_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_skills`
--
ALTER TABLE `user_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
