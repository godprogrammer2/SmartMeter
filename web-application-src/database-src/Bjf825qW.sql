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
-- Table structure for table `Bjf825qW`
--

CREATE TABLE IF NOT EXISTS `Bjf825qW` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `watt` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `money` double NOT NULL,
  `ampere` double NOT NULL,
  `limit_ampere` double NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `Bjf825qW`
--

INSERT INTO `Bjf825qW` (`id`, `time`, `watt`, `money`, `ampere`, `limit_ampere`) VALUES
(1, '-2', '-2', -1, 0, -1),
(2, '31/01/2017.23:59:59', '57.45', 183.3, 0, -1),
(3, '28/02/2017.23:59:59', '102.35', 346.06, 0, -1),
(4, '31/03/2017.23:59:59', '155.37', 545.51, 0, -1),
(5, '30/04/2017.23:59:59', '212.22', 787.89, 0, -1),
(6, '31/05/2017.23:59:59', '198.55', 728.36, 0, -1),
(7, '30/06/2017.23:59:59', '156.77', 548.02, 0, -1),
(8, '31/07/2017.23:59:59', '133.26', 467.93, 0, -1),
(9, '31/08/2017.23:59:59', '140.1', 490.4, 0, -1),
(10, '30/09/2017.23:59:59', '122.1', 432.61, 0, -1),
(11, '31/10/2017.23:59:59', '112.66', 383.18, 0, -1),
(30, '03/11/2017.13:26:30', '0.0037513611111113', 0, 0, -1),
(31, '165/85/2009.37:165:', '3.4297222222222E-5', 0, 0, -1),
(32, '27/11/2017.17:32:53', '0.026835002777769', 0, 0, -1),
(33, '20/12/2017.08:32:53', '0.042929725000001', 0, 0.16, -1),
(34, '165/85/2009.37:165:', '2.5422222222222E-5', 0, 0.38, -1),
(35, '20/12/2017.08:34:41', '7.6255555555555E-5', 0, 0.14, -1),
(36, '165/85/2009.37:165:', '2.5363888888889E-5', 0, 0.38, -1),
(37, '20/12/2017.08:38:53', '3.5233333333333E-5', 0, 0.15, -1),
(38, '165/85/2009.37:165:', '2.5230555555556E-5', 0, 0.38, -1),
(39, '22/12/2017.16:57:17', '0.037681461111127', 0, 0, -1),
(40, '15/01/2018.09:18:20', '0.00029900833333334', 0, 0, -1),
(41, '', '0', 0, 0, -1),
(42, '18/01/2018.13:56:59', '0.030333366666684', 0, 0, -1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
