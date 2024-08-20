-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 05:19 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accident`
--

-- --------------------------------------------------------

--
-- Table structure for table `accident_detection`
--

CREATE TABLE `accident_detection` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL DEFAULT 6,
  `latitude` float(10,6) DEFAULT NULL,
  `longitude` float(10,6) DEFAULT NULL,
  `impact_detected` int(11) DEFAULT NULL,
  `dtime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accident_detection`
--

INSERT INTO `accident_detection` (`id`, `vehicle_id`, `latitude`, `longitude`, `impact_detected`, `dtime`) VALUES
(1, 1, 1.234567, 2.345678, 1, '2024-08-08 17:28:25'),
(2, 4, -1.984446, 30.092817, 1, '2024-08-08 18:20:44'),
(3, 3, -1.984446, 30.092817, 1, '2024-08-08 18:21:42'),
(10, 6, -1.984446, 30.092817, 0, '2024-08-13 17:39:30'),
(11, 2, -1.984446, 30.092817, 1, '2024-08-13 18:54:01'),
(12, 4, -1.982846, 30.065817, 1, '2024-08-13 18:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `accident_records`
--

CREATE TABLE `accident_records` (
  `id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `accident_numbers` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accident_records`
--

INSERT INTO `accident_records` (`id`, `date_time`, `accident_numbers`) VALUES
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

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locationid` int(11) NOT NULL,
  `vehicleid` int(11) DEFAULT 3,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `dtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationid`, `vehicleid`, `latitude`, `longitude`, `dtime`, `status`) VALUES
(1, 1, -1.98495, 30.0926, '2024-08-02 10:47:31', 0),
(2, 2, -1.98451, 30.0927, '2024-08-02 10:47:31', 0),
(6, 1, -1.984446, 30.092817, '2024-08-04 16:45:26', 0),
(7, 4, -1.98444, 30.092812, '2024-08-06 15:42:04', 0),
(8, 3, -1.984436, 30.09282, '2024-08-06 16:16:43', 0),
(10, 2, -1.984449, 30.092838, '2024-08-06 16:21:14', 0),
(11, 1, -1.984419, 30.092858, '2024-08-06 16:39:03', 0),
(12, 4, -1.982319, 30.093868, '2024-08-06 16:41:21', 0),
(13, 3, -1.984235, 30.091415, '2024-08-06 16:47:00', 0),
(14, 1, -1.984524, 30.092739, '2024-08-06 17:48:23', 0),
(15, 1, -1.984331, 30.092945, '2024-08-06 17:51:14', 0),
(24, 1, -1.985345, 30.092154, '2024-08-07 07:13:52', 0);

--
-- Triggers `location`
--
DELIMITER $$
CREATE TRIGGER `after_location_insert` AFTER INSERT ON `location` FOR EACH ROW BEGIN
  INSERT INTO notifications (message) VALUES (CONCAT('Accident detected : Latitude - ', NEW.latitude, ', Longitude - ', NEW.longitude));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `ownerid` int(50) NOT NULL,
  `nationalid` int(100) NOT NULL,
  `fnames` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `familyphone` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`ownerid`, `nationalid`, `fnames`, `phone`, `familyphone`, `address`) VALUES
(1, 2147483647, 'Peter', '027823', '731679843', 'Kigali'),
(2, 1197220323, 'Matayo', '02328473', '788845872', 'Musanze'),
(3, 1199928734, 'Luke', '03487342', '720563421', 'Rubavu'),
(4, 834472404, 'samuel', '07834954', '795674360', 'Musanze'),
(5, 1200080150, 'Shema', '0789091938', '0722823538', 'Kigali'),
(6, 55555555, 'Kiza', '0788405012', '0787940048', 'Kigali');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `phone`, `type`) VALUES
(1, 'Herbez', '123', 'shemaherbez@gmail.com', '0789091938', 1),
(4, 'Admin', '123', 'admin@gmail.com', '0788709965', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleid` int(11) NOT NULL,
  `licenseplate` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `gpsmodid` varchar(50) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ownerid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleid`, `licenseplate`, `type`, `gpsmodid`, `regdate`, `ownerid`) VALUES
(1, 'RAB 123 C', 'Car', 'Tracker_001', '2024-08-02 10:17:39', 1),
(2, 'RAB 123 E', 'Bus', 'Tracker_002', '2024-08-02 10:17:39', 3),
(3, 'RAD 101 F', 'Motorcycle', 'tracker_003', '2024-08-06 15:05:28', 2),
(4, 'RAG 214 A', 'truck', 'tracker_004', '2024-08-06 15:06:24', 4),
(5, 'RAG 777 A', 'Car', 'tracker_001', '2024-08-10 10:31:32', 5),
(6, 'RAC 104 D', 'Motorcycle', 'tracker_001', '2024-08-13 15:14:17', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accident_detection`
--
ALTER TABLE `accident_detection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locationid`),
  ADD KEY `vehicleid` (`vehicleid`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`ownerid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleid`),
  ADD KEY `ownerid` (`ownerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accident_detection`
--
ALTER TABLE `accident_detection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `ownerid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accident_detection`
--
ALTER TABLE `accident_detection`
  ADD CONSTRAINT `accident_detection_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicleid`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`vehicleid`) REFERENCES `vehicle` (`vehicleid`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`ownerid`) REFERENCES `owner` (`ownerid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
