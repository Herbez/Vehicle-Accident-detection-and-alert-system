-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 04:15 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bitcoin_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `bitcoin_prices`
--

CREATE TABLE `bitcoin_prices` (
  `id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bitcoin_prices`
--

INSERT INTO `bitcoin_prices` (`id`, `date_time`, `price`) VALUES
(5, '2024-04-24 20:00:19', '0'),
(13, '2024-04-24 19:59:52', '2'),
(14, '2024-04-24 19:59:52', '7'),
(15, '2024-04-24 20:00:19', '9'),
(17, '2024-04-24 20:00:33', '19'),
(18, '2024-04-24 20:00:33', '20'),
(19, '2024-04-24 20:01:03', '5'),
(20, '2024-04-24 20:01:03', '12'),
(21, '2024-04-24 20:03:48', '70'),
(22, '2024-04-24 20:03:48', '12'),
(23, '2024-05-01 16:06:37', '22'),
(24, '2024-05-01 16:06:37', '24'),
(25, '2024-05-01 16:08:22', '90'),
(26, '2024-05-01 16:08:22', '100'),
(27, '2024-07-31 18:03:59', '80'),
(28, '2024-07-31 18:03:59', '60');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitcoin_prices`
--
ALTER TABLE `bitcoin_prices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitcoin_prices`
--
ALTER TABLE `bitcoin_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
