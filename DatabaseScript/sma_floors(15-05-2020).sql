-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2020 at 01:03 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_scot`
--

-- --------------------------------------------------------

--
-- Table structure for table `sma_floors`
--

CREATE TABLE `sma_floors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lift_option` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sma_floors`
--

INSERT INTO `sma_floors` (`id`, `name`, `lift_option`, `created_at`, `updated_at`) VALUES
(4, 'Basement', 0, '2020-05-15 14:05:02', '2020-05-15 10:05:02'),
(5, 'Ground floor', 0, '2020-05-15 14:05:25', '2020-05-15 10:05:25'),
(6, '1st floor', 1, '2020-05-15 14:05:40', '2020-05-15 10:05:40'),
(7, '2nd floor', 1, '2020-05-15 14:05:52', '2020-05-15 10:05:52'),
(8, '3rd floor', 1, '2020-05-15 14:06:07', '2020-05-15 10:06:07'),
(9, '4th floor', 1, '2020-05-15 14:06:24', '2020-05-15 10:06:24'),
(10, '5th floor', 1, '2020-05-15 14:06:36', '2020-05-15 10:07:07'),
(11, '6th floor', 1, '2020-05-15 14:06:47', '2020-05-15 10:06:47'),
(12, 'Above 6th floor', 1, '2020-05-15 14:07:23', '2020-05-15 10:07:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sma_floors`
--
ALTER TABLE `sma_floors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sma_floors`
--
ALTER TABLE `sma_floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
