-- phpMyAdmin SQL Dump
-- version 4.3.2deb0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 15, 2014 at 05:49 PM
-- Server version: 5.5.40-0ubuntu1
-- PHP Version: 5.5.12-2ubuntu4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maya-notes-app-demo`
--
DROP DATABASE IF EXISTS `maya-notes-app-demo`;
CREATE DATABASE IF NOT EXISTS `maya-notes-app-demo` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `maya-notes-app-demo`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Dec 14, 2014 at 04:45 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referral_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--
-- Creation: Dec 02, 2014 at 02:31 AM
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(20) unsigned NOT NULL,
  `user_id` int(20) unsigned DEFAULT NULL,
  `note_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Untitled',
  `note_body` text COLLATE utf8_unicode_ci,
  `note_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uncategorized` tinyint(1) NOT NULL DEFAULT '1',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `trashed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `notes`:
--   `user_id`
--       `users` -> `id`
--

--
-- Truncate table before insert `notes`
--

--
-- Triggers `notes`
--
DROP TRIGGER IF EXISTS `before_insert_notes`;
DELIMITER $$
CREATE TRIGGER `before_insert_notes` BEFORE INSERT ON `notes`
 FOR EACH ROW SET NEW.`note_modified` = NOW()
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_notes`;
DELIMITER $$
CREATE TRIGGER `before_update_notes` BEFORE UPDATE ON `notes`
 FOR EACH ROW SET NEW.`note_modified` = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `u_id` (`id`), ADD UNIQUE KEY `referral_link` (`referral_link`), ADD KEY `email` (`email`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `u_id` (`id`), ADD KEY `fk_user_id` (`user_id`);

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
ADD CONSTRAINT `fk_user_id_notes` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;
