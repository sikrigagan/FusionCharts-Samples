-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2016 at 07:48 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `factorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `quarterly_sales`
--

CREATE TABLE IF NOT EXISTS `quarterly_sales` (
  `Quarter` varchar(20) NOT NULL,
  `Sales` varchar(20) NOT NULL,
  `Year` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quarterly_sales`
--

INSERT INTO `quarterly_sales` (`Quarter`, `Sales`, `Year`) VALUES
('Q1', '7500', '2011'),
('Q2', '8150', '2011'),
('Q3', '9350', '2011'),
('Q4', '7145', '2011'),
('Q1', '7000', '2012'),
('Q2', '6178', '2012'),
('Q3', '8000', '2012'),
('Q4', '8900', '2012'),
('Q1', '3000', '2013'),
('Q2', '4000', '2013'),
('Q2', '3536', '2013'),
('Q4', '4000', '2013'),
('Q1', '5040', '2014'),
('Q2', '5600', '2014'),
('Q3', '4960', '2014'),
('Q4', '4563', '2014'),
('Q1', '10700', '2015'),
('Q2', '8563', '2015'),
('Q3', '11000', '2015'),
('Q4', '8900', '2015'),
('Q1', '9900', '2016'),
('Q2', '10000', '2016'),
('Q3', '11173', '2016'),
('Q4', '8900', '2016');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
