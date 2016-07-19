-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2016 at 11:52 PM
-- Server version: 5.6.29-76.2
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `drilldown`
--

-- --------------------------------------------------------

--
-- Table structure for table `monthly_sales`
--

CREATE TABLE IF NOT EXISTS `monthly_sales` (
  `Month` varchar(50) NOT NULL,
  `Sales` int(10) unsigned NOT NULL,
  `Year` int(10) unsigned NOT NULL,
  `Quarter` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_sales`
--

INSERT INTO `monthly_sales` (`Month`, `Sales`, `Year`, `Quarter`) VALUES
('Feb', 2300, 2011, 'Q1'),
('Jan', 2000, 2011, 'Q1'),
('Mar', 3200, 2011, 'Q1'),
('Apr', 2800, 2011, 'Q2'),
('Jun', 2350, 2011, 'Q2'),
('May', 3000, 2011, 'Q2'),
('Aug', 3000, 2011, 'Q3'),
('Jul', 2850, 2011, 'Q3'),
('Sep', 3500, 2011, 'Q3'),
('Dec', 1250, 2011, 'Q4'),
('Nov', 2895, 2011, 'Q4'),
('Oct', 3000, 2011, 'Q4'),
('Feb', 2345, 2012, 'Q1'),
('Jan', 1585, 2012, 'Q1'),
('Mar', 3070, 2012, 'Q1'),
('Apr', 2856, 2012, 'Q2'),
('Jun', 822, 2012, 'Q2'),
('May', 2500, 2012, 'Q2'),
('Aug', 3296, 2012, 'Q3'),
('Jul', 1500, 2012, 'Q3'),
('Sep', 3204, 2012, 'Q3'),
('Dec', 2011, 2012, 'Q4'),
('Nov', 3200, 2012, 'Q4'),
('Oct', 3689, 2012, 'Q4'),
('Feb', 500, 2013, 'Q1'),
('Jan', 1200, 2013, 'Q1'),
('Mar', 400, 2013, 'Q1'),
('Apr', 900, 2013, 'Q2'),
('Jun', 1535, 2013, 'Q2'),
('May', 1565, 2013, 'Q2'),
('Aug', 1246, 2013, 'Q3'),
('Jul', 1200, 2013, 'Q3'),
('Sep', 1090, 2013, 'Q3'),
('Dec', 1520, 2013, 'Q4'),
('Nov', 1500, 2013, 'Q4'),
('Oct', 980, 2013, 'Q4'),
('Feb', 1600, 2014, 'Q1'),
('Jan', 1875, 2014, 'Q1'),
('Mar', 1565, 2014, 'Q1'),
('Apr', 2389, 2014, 'Q2'),
('Jun', 1922, 2014, 'Q2'),
('May', 1289, 2014, 'Q2'),
('Aug', 1854, 2014, 'Q3'),
('Jul', 2006, 2014, 'Q3'),
('Sep', 1100, 2014, 'Q3'),
('Dec', 2188, 2014, 'Q4'),
('Nov', 1500, 2014, 'Q4'),
('Oct', 875, 2014, 'Q4'),
('Feb', 3965, 2015, 'Q1'),
('Jan', 4087, 2015, 'Q1'),
('Mar', 2684, 2015, 'Q1'),
('Apr', 2983, 2015, 'Q2'),
('Jun', 2315, 2015, 'Q2'),
('May', 3265, 2015, 'Q2'),
('Aug', 3998, 2015, 'Q3'),
('Jul', 3215, 2015, 'Q3'),
('Sep', 3787, 2015, 'Q3'),
('Dec', 2148, 2015, 'Q4'),
('Nov', 2654, 2015, 'Q4'),
('Oct', 4098, 2015, 'Q4'),
('Feb', 3965, 2016, 'Q1'),
('Jan', 2983, 2016, 'Q1'),
('Mar', 2952, 2016, 'Q1'),
('Apr', 3998, 2016, 'Q2'),
('Jun', 2737, 2016, 'Q2'),
('May', 3265, 2016, 'Q2'),
('Aug', 3787, 2016, 'Q3'),
('Jul', 3215, 2016, 'Q3'),
('Sep', 4171, 2016, 'Q3'),
('Dec', 1256, 2016, 'Q4'),
('Nov', 3566, 2016, 'Q4'),
('Oct', 4078, 2016, 'Q4');

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

-- --------------------------------------------------------

--
-- Table structure for table `yearly_sales`
--

CREATE TABLE IF NOT EXISTS `yearly_sales` (
  `Year` varchar(20) NOT NULL,
  `Sales` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `yearly_sales`
--

INSERT INTO `yearly_sales` (`Year`, `Sales`) VALUES
('2011', '32145'),
('2012', '30078'),
('2013', '14536'),
('2014', '20163'),
('2015', '39163'),
('2016', '39973');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monthly_sales`
--
ALTER TABLE `monthly_sales`
  ADD PRIMARY KEY (`Year`,`Quarter`,`Month`) USING BTREE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
