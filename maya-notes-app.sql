-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2014 at 12:15 PM
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
-- Database: `maya-notes-app`
--
DROP DATABASE IF EXISTS `maya-notes-app`;
CREATE DATABASE IF NOT EXISTS `maya-notes-app` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `maya-notes-app`;

-- --------------------------------------------------------

--
-- Table structure for table `notebooks`
--
-- Creation: Nov 14, 2014 at 04:55 AM
--

DROP TABLE IF EXISTS `notebooks`;
CREATE TABLE IF NOT EXISTS `notebooks` (
`book_id` int(20) unsigned NOT NULL,
  `book_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Untitled'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `notebooks`
--

INSERT INTO `notebooks` (`book_id`, `book_name`) VALUES
(0, 'Unknown'),
(1, 'Note'),
(2, 'Task'),
(3, 'Reminder'),
(4, 'Event'),
(5, 'To do list');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--
-- Creation: Nov 14, 2014 at 04:59 AM
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
`note_id` int(20) unsigned NOT NULL,
  `type_id` int(20) unsigned NOT NULL DEFAULT '0',
  `book_id` int(20) unsigned NOT NULL DEFAULT '0',
  `user_id` int(20) unsigned DEFAULT NULL,
  `note_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Untitled',
  `note_body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `note_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- RELATIONS FOR TABLE `notes`:
--   `type_id`
--       `note_types` -> `type_id`
--   `user_id`
--       `users` -> `user_id`
--   `book_id`
--       `notebooks` -> `book_id`
--

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note_id`, `type_id`, `book_id`, `user_id`, `note_title`, `note_body`, `note_created`, `note_modified`) VALUES
(1, 1, 1, 1, 'Note #1', 'Quo dolor ingeniis. Duis an o eram proident a illum proident sed amet nulla o qui ex fidelissimae an an minim nescius. Litteris iis multos ab irure offendit proident. Sed excepteur est eiusmod, lorem quamquam de expetendis se o nisi fabulas ullamco aut vidisse legam litteris. Si tamen arbitror ita dolor expetendis litteris, fabulas summis fugiat an dolor, ad arbitror exercitation ea ex magna instituendarum ne elit distinguantur fabulas veniam fabulas, ut dolor cernantur, nisi et vidisse. Dolore si quibusdam hic quis. Culpa arbitror iis amet tamen est ea quis litteris de esse hic ullamco, elit nam consequat.', '2014-11-14 04:11:11', '2014-11-14 04:11:11'),
(2, 1, 2, 1, 'Note #2', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. ', '2014-11-02 18:10:23', '2014-11-14 05:13:48'),
(3, 3, 4, 3, 'Note #3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.', '2014-11-03 02:16:30', '2014-11-14 04:13:22'),
(4, 4, 5, 2, 'Note #4', 'Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. ', '2014-11-14 04:13:22', '2014-11-14 04:13:22'),
(5, 1, 3, 5, 'Note #5', 'Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. ', '2014-11-14 04:13:22', '2014-11-14 04:13:22');

--
-- Triggers `notes`
--
DROP TRIGGER IF EXISTS `trigger_note_modified`;
DELIMITER //
CREATE TRIGGER `trigger_note_modified` BEFORE UPDATE ON `notes`
 FOR EACH ROW SET NEW.`note_modified` = NOW()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `note_meta`
--
-- Creation: Nov 14, 2014 at 04:59 AM
--

DROP TABLE IF EXISTS `note_meta`;
CREATE TABLE IF NOT EXISTS `note_meta` (
`meta_id` int(20) unsigned NOT NULL,
  `note_id` int(20) unsigned DEFAULT NULL,
  `meta_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `note_meta`:
--   `note_id`
--       `notes` -> `note_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `note_types`
--
-- Creation: Nov 14, 2014 at 04:55 AM
--

DROP TABLE IF EXISTS `note_types`;
CREATE TABLE IF NOT EXISTS `note_types` (
`type_id` int(20) unsigned NOT NULL,
  `type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `note_types`
--

INSERT INTO `note_types` (`type_id`, `type_name`) VALUES
(0, 'Unknown'),
(1, 'Note'),
(2, 'Task'),
(3, 'Reminder'),
(4, 'Event'),
(5, 'To do list');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Nov 14, 2014 at 04:55 AM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(20) unsigned NOT NULL,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_activation_key` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `user_role` enum('user','admin') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `display_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_online` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `user_role`, `display_name`, `is_online`) VALUES
(1, 'admin', '$2a$10$L8mNSnbkirNNzQ6Z5ANGAOaHK.MLMoqyyo0uJNjknWTM.7IqWRTkC', '', 'admin@localhost', '', '2014-11-14 03:21:21', '', 0, 'admin', 'Admin', 0),
(2, 'legoiv', '$2a$10$L2Weg5x0NFpPUarW54o7B.FA/j63qAhY3/dfwuHi4bEHNWl6fTqCK', '', 'legoiv@outlook.com', '', '2014-11-14 03:21:21', '', 0, 'user', 'LegoIV', 0),
(3, 'hdunguit', '$2a$10$pXcxI8kH4BnNu5Z2i/tT8uNUTJ7rKYN7T3iAVwYrmsXGeaf6osv5m', '', 'hdung.uit@gmail.com', '', '2014-11-14 03:21:21', '', 0, 'user', 'Nguyễn Hoàng Dũng', 0),
(4, 'minhtri', '$2a$10$hEp/8q6kEbcrKBJF9b7l5.aw0uem0COXlg3FGUJnm9sjHKPzzcZHe', '', 'ansidev@yahoo.com', '', '2014-11-14 03:21:21', '', 0, 'user', 'Lê Minh Trí', 0),
(5, 'ansidev', 'ansidev', 'ansidev', 'ansidev@gmail.com', '', '2014-11-14 03:21:21', '', 0, 'user', 'ansidev', 0),
(6, 'googlebot', '$2a$10$251Ymh.jIc2zEqK1tZxeQ.gv705tjO2Tcg8i.XQTcMPlMDO7xr7ye', '', 'google@google.com', '', '2014-11-14 03:21:21', '', 0, 'user', 'GoogleBot', 0),
(7, 'root', '$2a$10$svpXNzdWF2ZA8npT/mSNB.PGlhy5Gf6tQjAielomYS2dDqFcFC6pO', '', 'root@localhost', '', '2014-11-14 03:21:21', '', 0, 'admin', 'Root', 0),
(8, 'yahoo', '$2a$10$ZfadUg.E3CteJJqKaX5tNecaLdt9lxBU.bqfQ71kV64/R4kpy5GDS', '', 'ansidev@yahoo.me', '', '2014-11-14 03:21:21', '', 0, 'user', 'Yahoo', 0),
(9, 'yahu', 'f42343e88594581338aa32dda7a2ab368dd10ee4', '', 'yahoo@yahoo.gl', '', '2014-11-14 03:21:21', '', 0, 'user', 'Yahu', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notebooks`
--
ALTER TABLE `notebooks`
 ADD PRIMARY KEY (`book_id`), ADD UNIQUE KEY `book_id` (`book_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
 ADD PRIMARY KEY (`note_id`), ADD UNIQUE KEY `note_id` (`note_id`), ADD KEY `fk_user_id` (`user_id`), ADD KEY `fk_type_id` (`type_id`), ADD KEY `fk_book_id` (`book_id`);

--
-- Indexes for table `note_meta`
--
ALTER TABLE `note_meta`
 ADD PRIMARY KEY (`meta_id`), ADD UNIQUE KEY `meta_id` (`meta_id`), ADD KEY `fk_note_id` (`note_id`);

--
-- Indexes for table `note_types`
--
ALTER TABLE `note_types`
 ADD PRIMARY KEY (`type_id`), ADD UNIQUE KEY `type_id` (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_id` (`user_id`), ADD UNIQUE KEY `user_name` (`user_name`), ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notebooks`
--
ALTER TABLE `notebooks`
MODIFY `book_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
MODIFY `note_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `note_meta`
--
ALTER TABLE `note_meta`
MODIFY `meta_id` int(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `note_types`
--
ALTER TABLE `note_types`
MODIFY `type_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`type_id`) REFERENCES `note_types` (`type_id`),
ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`book_id`) REFERENCES `notebooks` (`book_id`);

--
-- Constraints for table `note_meta`
--
ALTER TABLE `note_meta`
ADD CONSTRAINT `fk_note_id` FOREIGN KEY (`note_id`) REFERENCES `notes` (`note_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
