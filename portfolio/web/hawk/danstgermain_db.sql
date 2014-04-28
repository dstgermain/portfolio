-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2013 at 09:03 AM
-- Server version: 5.0.51
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `danstgermain_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `CAT_ID` int(11) NOT NULL auto_increment,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY  (`CAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CAT_ID`, `category`) VALUES
(1, 'Mufflers'),
(2, 'Controls'),
(3, 'Lights'),
(4, 'Helmets');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `CO_ID` int(11) NOT NULL auto_increment,
  `company` varchar(255) NOT NULL,
  PRIMARY KEY  (`CO_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`CO_ID`, `company`) VALUES
(1, 'Hawk Concepts'),
(2, 'Dime City Cycles'),
(3, 'Biltwell'),
(4, 'Roccity');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `ITEM_NUM` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_price` varchar(255) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_stock` varchar(255) NOT NULL,
  KEY `fk_ITEMS` (`ITEM_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ITEM_NUM`, `item_name`, `item_description`, `item_price`, `item_image`, `item_stock`) VALUES
(1, 'Megaphone', 'Chrome, stainless steel exhaust 1.5". Loud enough for the neighbors to hear, and with all the extra HP.', '99.99', 'hawk_mega.jpg', '10'),
(2, 'Throttle Body', 'Billet Aluminum machined throttle body. Custom machined out of quality aluminum. Made in the USA.', '50.99', 'dcc_throttle.jpg', '15'),
(3, '7" Headlight', '7" Headlight with chrome band and halogen bulb. Can fit most applications. Made in the USA.', '39.99', '7_headlight_bw.jpg', '23'),
(4, 'Aero Bucket', 'Old School white dot approved bucket for your head.', '99.99', 'aero_bucket.jpg', '10');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `CO_ID` int(11) NOT NULL,
  `CAT_ID` int(11) NOT NULL,
  `ITEM_NUM` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`ITEM_NUM`),
  KEY `fk_CAT` (`CAT_ID`),
  KEY `ITEM_NUM` (`CO_ID`,`CAT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`CO_ID`, `CAT_ID`, `ITEM_NUM`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_ITEMS` FOREIGN KEY (`ITEM_NUM`) REFERENCES `items` (`ITEM_NUM`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_CAT` FOREIGN KEY (`CAT_ID`) REFERENCES `categories` (`CAT_ID`),
  ADD CONSTRAINT `fk_CO` FOREIGN KEY (`CO_ID`) REFERENCES `companies` (`CO_ID`);
