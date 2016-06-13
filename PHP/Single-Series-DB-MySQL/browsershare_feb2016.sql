-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 12, 2016 at 09:56 PM
-- Server version: 5.6.29-76.2
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fcdemodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `browsershare_feb2016`
--

CREATE TABLE IF NOT EXISTS `browsershare_feb2016` (
  `browser` varchar(30) NOT NULL,
  `shareval` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `browsershare_feb2016`
--

INSERT INTO `browsershare_feb2016` (`browser`, `shareval`) VALUES
('Chrome', '69'),
('Firefox', '18.6'),
('IE', '6.2'),
('Safari', '3.7'),
('Opera', '1.3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
