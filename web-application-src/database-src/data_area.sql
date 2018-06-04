-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2018 at 11:08 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `permpany_smartm`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_area`
--

CREATE TABLE IF NOT EXISTS `data_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `device_id` varchar(50) NOT NULL,
  `month_status` int(11) NOT NULL,
  `cal_day` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_name` (`user_name`,`user_password`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `data_area`
--

INSERT INTO `data_area` (`id`, `user_name`, `user_password`, `user_email`, `device_id`, `month_status`, `cal_day`) VALUES
(13, 'kiadtisak', 'buangam', 'game@hotmail.com', 'Bjf825qW', 3, 32),
(24, 'godprogrammer', '87654321', 'god@gmail.com', 'test1234', 0, 0),
(25, 'damrong', 'damrong', 'damrong@hh.com', 'XXXY', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
