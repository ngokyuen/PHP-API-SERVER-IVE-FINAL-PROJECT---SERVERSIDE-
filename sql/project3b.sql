-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2016 at 09:14 AM
-- Server version: 5.5.44-MariaDB-log
-- PHP Version: 5.5.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project3b`
--

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `infoboard`
--

DROP TABLE IF EXISTS `infoboard`;
CREATE TABLE IF NOT EXISTS `infoboard` (
  `info_bid` int(8) NOT NULL AUTO_INCREMENT,
  `info_title` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `info_desc` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `info_type` varchar(1) CHARACTER SET latin1 DEFAULT NULL COMMENT '0:Maintaince, 1:Update, 2:Coupon',
  PRIMARY KEY (`info_bid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `infoboard_test`
--

DROP TABLE IF EXISTS `infoboard_test`;
CREATE TABLE IF NOT EXISTS `infoboard_test` (
  `id` int(11) NOT NULL,
  `account` varchar(8) NOT NULL,
  `pwd` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'normal' COMMENT 'normal: normal order, share:car share order',
  `status` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'pending' COMMENT 'pending, completed, cancel',
  `origin` varchar(255) COLLATE utf8_bin NOT NULL,
  `destination` varchar(255) COLLATE utf8_bin NOT NULL,
  `origin_remark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `destination_remark` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `book_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `passenger` int(11) DEFAULT NULL COMMENT 'number of passenger',
  `contact_person` varchar(255) COLLATE utf8_bin NOT NULL,
  `contact_no` int(8) NOT NULL,
  `origin_lat` double DEFAULT NULL,
  `origin_lng` double DEFAULT NULL,
  `destination_lat` double DEFAULT NULL,
  `is_five` tinyint(1) DEFAULT NULL,
  `destination_lng` double DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` int(8) NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `home_no` int(8) DEFAULT NULL,
  `sex` varchar(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'm: male, f:male',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_join_orders`
--

DROP TABLE IF EXISTS `users_join_orders`;
CREATE TABLE IF NOT EXISTS `users_join_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'join' COMMENT 'join, cancel',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=131 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
