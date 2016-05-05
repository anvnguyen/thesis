-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2013 at 05:24 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `xpath`
--

CREATE TABLE IF NOT EXISTS `xpath` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(300) NOT NULL,
  `WebsiteID` int(11) NOT NULL,
  `Name` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Price` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `OriginalPrice` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ExpiredDate` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Purchases` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ImageURL` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Address` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Description` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Condition` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `WebsiteID` (`WebsiteID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `xpath`
--

INSERT INTO `xpath` (`ID`, `URL`, `WebsiteID`, `Name`, `Price`, `OriginalPrice`, `ExpiredDate`, `Purchases`, `ImageURL`, `Address`, `Description`, `Condition`) VALUES
(5, '', 14, '//div[@class=''v3_SC_title'']/h1', '//div[@class=''v3_SC_price'']/div', '//div[@class=''v3_SC_price_promotion mBottom10'']', '//div[@class=''pBottom10 lh20 deal_tos_info'']/ul/li/span/strong', '//div[@class=''main_view main-boxcontFull v3_SC_borderTop v3_SC_buyer pTop15 pBottom10'']/div[@class=''mainBlueBoxNew pTop10'']/ul/li/a/span', '//div[@class=''v3_sizecolor_left'']/div/img/attribute::src', './/*[@id=''viewline1'']/div[1]', '//div[@class=''v3_SC_boxAdvan lh20 deal_fea_info'']', '//div[@class=''v3_SC_boxDKSD'']'),
(6, '', 24, '//h1[@class=''title-dealdt'']', '//p[@class=''pro-price'']/span', '//p[@class=''save-price'']/del', '//div[@class=''pBottom10 lh20 deal_tos_info'']/ul/li/span/strong', '//div[@class=''count-buy one-city'']/p/span', '//div[@class=''thumbnail'']/ul/li/a/img/attribute::src', '//ul[@class=''points'']/li/p/span', '//li[@class=''liCond\n'']/div', '//ul[@class=''highlights-cond'']/li/div');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `xpath`
--
ALTER TABLE `xpath`
  ADD CONSTRAINT `xpath_ibfk_1` FOREIGN KEY (`WebsiteID`) REFERENCES `website` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
