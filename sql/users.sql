←
phpMyAdmin
HomephpMyAdmin documentationDocumentationReload navigation panel
RecentFavorites
Collapse allUnlink from main panel
New
Expand/CollapseDatabase operationsinformation_schema
Expand/CollapseDatabase operationsmysql
Expand/CollapseDatabase operationsperformance_schema
Database operationsproject3b
NewNew
Expand/CollapseStructureorders
Expand/CollapseStructureusers
Expand/CollapseStructureusers_join_orders
Database operationsroot
Server: localhost:3306 »Database: project3b »Table: users
Browse Browse
Structure Structure
SQL SQL
Search Search
Insert Insert
Export Export
Import Import
Privileges Privileges
Operations Operations
Triggers Triggers
Click on the bar to scroll to top of page
SQL Query ConsoleConsole
OptionsSet default
Always expand query messages
Show query history at start
Show current browsing query
[ Back ]


-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2016 at 07:10 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `project3b`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` int(8) NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
[ Back ]

Open new phpMyAdmin window