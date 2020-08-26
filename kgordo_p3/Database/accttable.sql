-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Aug 24, 2020 at 10:06 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `accttable`
--

DROP TABLE IF EXISTS `accttable`;
CREATE TABLE IF NOT EXISTS `accttable` (
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Pwd` varchar(255) DEFAULT NULL,
  `createOn` timestamp NULL DEFAULT NULL,
  `isAdmin` int(1) NOT NULL,
  `Course_Access` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accttable`
--

INSERT INTO `accttable` (`FirstName`, `LastName`, `Username`, `Email`, `Pwd`, `createOn`, `isAdmin`, `Course_Access`) VALUES
('Kevin', 'G', 'Overlord', 'tutoring@gxstudio.org', '12345678', '0000-00-00 00:00:00', 1, 'AnimationWorld'),
('Bruce', 'Banner', 'Hulk', 'hulk@g.com', '12345678', '0000-00-00 00:00:00', 0, 'FutureRealities');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
