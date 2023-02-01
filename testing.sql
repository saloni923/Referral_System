-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2023 at 07:49 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `registered_users`
--

CREATE TABLE `registered_users` (
  `fullname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `referral_code` varchar(200) NOT NULL,
  `referral_point` int(200) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_users`
--

INSERT INTO `registered_users` (`fullname`, `username`, `email`, `password`, `referral_code`, `referral_point`) VALUES
('abc', 'abc', 'abc@gmail.com', '$2y$10$I9XKtWSK3HvDY3MJAaWCQuCLrv0ah.Sd03NUA8IZyfWp6w02qUg3u', 'D4484332', 10),
('aditi', 'aditi', 'aditi@gmail.com', '$2y$10$e7HtnN8zIh1uN3mstOGVJeYYO7aH0EgQRjzTqY1dywV57GAbF2tem', '42488CF3', 0),
('Mahima', 'Mahi123', 'mahi2@gmail.com', '234', '', 0),
('Manasi darade', 'mansi1', 'mansi@gmail.com', '$2y$10$k2Y6SMYGlBfEGDaeWAfZgeuMM6LK3i/Z697KWxqmEvr2JhIUU3Uvi', '', 0),
('Makarand Khiste', 'mk20', 'mk20@gmail.com', '789', '', 0),
('Priya Raut', 'priya213', 'priya@gmail.com', '$2y$10$qALC47bdEEXZs774KOiUyu0wRfGBq1rHTrKruygY9gDRQ6KISZBUW', '88314EA2', 20),
('Saloni wagh', 'saloni923', 'saloniwagh2@gmail.com', '$2y$10$CsK2bx4MGov2NIDndII6Q.YoI3hADZQm2acGUy4cO2uI7elmkEOzC', '', 0),
('Sidharth Sonawane', 'sid45', 'sid@gmail.com', '56789', '', 0),
('xyz', 'xyz', 'xyz@mail.com', '$2y$10$nsAwsRZEf2EBZkGGbRCwhuM1bgnN5GRo1V/3bdkfoHF5z028kLPmq', '84BD1992', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registered_users`
--
ALTER TABLE `registered_users`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
