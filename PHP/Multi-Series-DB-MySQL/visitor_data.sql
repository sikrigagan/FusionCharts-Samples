-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2016 at 10:37 PM
-- Server version: 5.6.29-76.2
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `s0m9t1f7_fcdemodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `visitor_data`
--

CREATE TABLE IF NOT EXISTS `visitor_data` (
  `seq` int(11) NOT NULL,
  `month` varchar(30) NOT NULL,
  `year_a` varchar(30) NOT NULL,
  `year_b` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor_data`
--

INSERT INTO `visitor_data` (`seq`, `month`, `year_a`, `year_b`) VALUES
(1, 'Jan', '13000', '9000'),
(2, 'Feb', '14500', '9800'),
(3, 'Mar', '13500', '9500'),
(4, 'Apr', '15000', '13000'),
(5, 'May', '15500', '17000'),
(6, 'Jun', '17650', '11000'),
(7, 'Jul', '19650', '10000'),
(8, 'Aug', '18500', '10500'),
(9, 'Sep', '18000', '15800'),
(10, 'Oct', '19500', '16800'),
(11, 'Nov', '17500', '19500'),
(12, 'Dec', '13500', '17000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
