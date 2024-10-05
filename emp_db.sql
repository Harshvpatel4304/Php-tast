-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 05, 2024 at 06:30 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `country_code` varchar(5) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `address` text,
  `gender` varchar(10) DEFAULT NULL,
  `hobbies` varchar(100) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `country_code`, `mobile_number`, `address`, `gender`, `hobbies`, `photo`, `created_date`) VALUES
(6, 'harsh', 'patel', 'hvpatel4304@gmail.com', '+1', '5522114466', 'dfghjk', 'Male', 'Reading', 'krishna.jpg', '2024-10-05 05:03:08'),
(9, 'harsh', 'patel', 'harshpatel.v4304@gmail.com', '+91', '9081481208', 'siddhpur', 'Male', 'Traveling, Sports', 'HD-wallpaper-jai-sriram-logo-sreeram.jpg', '2024-10-05 06:23:45'),
(10, 'abc', 'def', 'a@gmail.com', '+91', '6633225544', 'abcdefg', 'Female', 'Reading, Traveling, Sports', 'krishna.jpg', '2024-10-05 06:26:51');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
