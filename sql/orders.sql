-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2016 at 07:29 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `project3b`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
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
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;