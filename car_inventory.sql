-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2019 at 08:24 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `car_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(300) NOT NULL,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_id`, `manufacturer_name`) VALUES
(1, 'Maruti'),
(2, 'Tata ');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE IF NOT EXISTS `model` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `manufacturing_year` int(10) NOT NULL,
  `registration_number` int(20) NOT NULL,
  `note` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `manufacturer_id`, `model_name`, `color`, `manufacturing_year`, `registration_number`, `note`, `image`) VALUES
(1, 2, 'Nano', 'Red', 2000, 3647692, 'Best city car you can buy, Nanos AMT version is best compared to its competitors (Kwid Auto & Celerio AMT) both costs above 5L and Nano AMT will be on the road for 3.7L.', 'tata-nano_red.PNG'),
(2, 1, 'WagonR', 'Blue', 2001, 3895678, 'Maruti has launched the CNG fuel option of the WagonR. The major update, though, has been made under the hood, with the WagonR now coming with two engine options.', 'wagonR_blue.PNG '),
(3, 1, 'WagonR', 'Red', 2001, 3895679, 'Maruti has launched the CNG fuel option of the WagonR. The major update, though, has been made under the hood, with the WagonR now coming with two engine options.', 'wagonR_red.PNG ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
