-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 05:16 AM
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
-- Database: `ajaxcrud`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `lname`, `city`, `email`, `gender`, `created_at`, `updted_at`) VALUES
(2, 'ketan', 'patel', 'rajkot', 'ketan@gmail.com', 'male', '2024-09-25 06:22:00', '2024-09-25 06:22:00'),
(3, 'kalpesh', 'chauhand', 'rajkot', 'kalpesh915@gmail.com', 'male', '2024-09-26 12:11:22', '2024-09-27 04:23:20'),
(8, 'kalpesh', 'chauhan', 'rajkot', 'k111w51@gmail.com', 'male', '2024-09-26 12:16:12', '2024-09-26 12:16:12'),
(9, 'sample', 'user', 'rajkot', 'udit@gmail.com', 'male', '2024-09-26 12:17:15', '2024-09-26 12:17:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
