-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2023 at 10:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `hobby` varchar(255) DEFAULT NULL,
  `exprience` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `gender`, `education`, `hobby`, `exprience`, `picture`, `message`, `created_at`, `updated_at`) VALUES
(7, 'sunil', 'botadara@email.com', '8000369595', 'male', 'BCA', 'writing-coding', '12', '1683779094_download (5).jpg', NULL, '2023-05-10 22:54:54', '2023-05-10 22:54:54'),
(8, 'sunil', 'dinesh@gmail.com', '20145784510', 'male', 'BCA', 'writing-coding', '1', '645d418634e97.jpg', 'hello test sunil', '2023-05-11 13:57:02', '2023-05-11 14:36:43'),
(9, 'sunil12', 'dinesh@gmail.com', '20145784510', 'male', 'BCA', 'writing-coding', '1', '645d420f4272f.jpg', 'hello testsdv', '2023-05-11 13:59:19', '2023-05-11 13:59:19'),
(10, 'sunil', 'dineshbotadara2001@gmail.com', '7894561230', 'male', '12', 'coding', '12', '645d423b68037.jpg', 'ysd sdv', '2023-05-11 14:00:03', '2023-05-11 14:00:03'),
(11, 'kama', 'kama@gmail.com', '9632587410', 'male', 'sadv', 'writing-coding', '1', '645d4a2a94c12.jpg', 'sdgve adsvav dv asv', '2023-05-11 14:33:54', '2023-05-11 14:33:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
