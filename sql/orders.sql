-- phpMyAdmin SQL Dump
-- version 4.1.13
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2016 年 03 月 28 日 22:00
-- 伺服器版本: 5.5.44-MariaDB-log
-- PHP 版本： 5.5.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `project3b`
--

-- --------------------------------------------------------

--
-- 資料表結構 `orders`
--

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
  `passenger` int(11) NOT NULL COMMENT 'number of passenger',
  `contact_person` varchar(255) COLLATE utf8_bin NOT NULL,
  `contact_no` int(8) NOT NULL,
  `origin_lat` float DEFAULT NULL,
  `origin_lng` float DEFAULT NULL,
  `destination_lat` float DEFAULT NULL,
  `destination_lng` float DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
