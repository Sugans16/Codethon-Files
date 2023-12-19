-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 01:16 PM
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
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `ams_admin`
--

CREATE TABLE `ams_admin` (
  `a_username` text NOT NULL,
  `a_password` text NOT NULL,
  `a_fname` text DEFAULT NULL,
  `a_lname` text DEFAULT NULL,
  `a_email` text DEFAULT NULL,
  `a_mobile_no` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ams_admin`
--

INSERT INTO `ams_admin` (`a_username`, `a_password`, `a_fname`, `a_lname`, `a_email`, `a_mobile_no`) VALUES
('Admin', 'admin@123', 'Lokesh', 'Kanagaraj', 'lokesh@gmail.com', '9988776655');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ams_admin`
--
ALTER TABLE `ams_admin`
  ADD UNIQUE KEY `a_username` (`a_username`) USING HASH,
  ADD UNIQUE KEY `a_email` (`a_email`) USING HASH,
  ADD UNIQUE KEY `a_mobile_no` (`a_mobile_no`) USING HASH;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
