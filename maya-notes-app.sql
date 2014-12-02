-- phpMyAdmin SQL Dump
-- version 4.2.11deb0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 02, 2014 at 01:16 PM
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
-- Creation: Dec 01, 2014 at 06:09 PM
--

DROP TABLE IF EXISTS `notebooks`;
CREATE TABLE IF NOT EXISTS `notebooks` (
`id` int(20) unsigned NOT NULL,
  `book_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Untitled',
  `book_permission` enum('zero','one','two','three') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'three',
  `default_book` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(20) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `notebooks`:
--   `user_id`
--       `users` -> `id`
--

--
-- Truncate table before insert `notebooks`
--

TRUNCATE TABLE `notebooks`;
--
-- Dumping data for table `notebooks`
--

INSERT INTO `notebooks` (`id`, `book_name`, `book_permission`, `default_book`, `user_id`) VALUES
(14, 'Note', 'two', 1, 3),
(15, 'Task', 'two', 1, 3),
(16, 'To do list', 'two', 1, 3),
(17, 'Reminder', 'two', 1, 3),
(18, 'Event', 'two', 1, 3),
(19, 'Custom Notebook', 'two', 0, 3),
(36, 'Note', 'two', 1, 1),
(37, 'Task', 'two', 1, 1),
(38, 'To do list', 'two', 1, 1),
(39, 'Reminder', 'two', 1, 1),
(40, 'Event', 'two', 1, 1),
(44, 'Note', 'two', 1, 2),
(45, 'Task', 'two', 1, 2),
(46, 'To do list', 'two', 1, 2),
(47, 'Reminder', 'two', 1, 2),
(48, 'Event', 'two', 1, 2);

--
-- Triggers `notebooks`
--
DROP TRIGGER IF EXISTS `before_update_notebooks`;
DELIMITER //
CREATE TRIGGER `before_update_notebooks` BEFORE UPDATE ON `notebooks`
 FOR EACH ROW BEGIN
		UPDATE `maya-notes-app`.`notes` AS `Note`
    	SET `Note`.`notebook_id` = NEW.`id`
    	WHERE `Note`.`notebook_id` = OLD.`id`;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--
-- Creation: Dec 02, 2014 at 02:31 AM
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
`id` int(20) unsigned NOT NULL,
  `type_id` int(20) unsigned NOT NULL DEFAULT '0',
  `notebook_id` int(20) unsigned DEFAULT NULL,
  `user_id` int(20) unsigned DEFAULT NULL,
  `note_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Untitled',
  `note_body` text COLLATE utf8_unicode_ci,
  `note_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uncategorized` tinyint(1) NOT NULL DEFAULT '1',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `trashed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `notes`:
--   `notebook_id`
--       `notebooks` -> `id`
--   `type_id`
--       `note_types` -> `id`
--   `user_id`
--       `users` -> `id`
--

--
-- Truncate table before insert `notes`
--

TRUNCATE TABLE `notes`;
--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `type_id`, `notebook_id`, `user_id`, `note_title`, `note_body`, `note_created`, `note_modified`, `uncategorized`, `shared`, `trashed`) VALUES
(1, 1, 38, 1, 'Note #1', 'Quo dolor ingeniis. Duis an o eram proident a illum proident sed amet nulla o qui ex fidelissimae an an minim nescius. Litteris iis multos ab irure offendit proident. Sed excepteur est eiusmod, lorem quamquam de expetendis se o nisi fabulas ullamco aut vidisse legam litteris. Si tamen arbitror ita dolor expetendis litteris, fabulas summis fugiat an dolor, ad arbitror exercitation ea ex magna instituendarum ne elit distinguantur fabulas veniam fabulas, ut dolor cernantur, nisi et vidisse. Dolore si quibusdam hic quis. Culpa arbitror iis amet tamen est ea quis litteris de esse hic ullamco, elit nam consequat.', '2014-11-14 04:11:11', '2014-12-02 06:10:48', 0, 0, 0),
(2, 1, 36, 1, 'Note #2', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. ', '2014-11-02 18:10:23', '2014-11-23 17:00:06', 1, 1, 0),
(3, 3, 15, 3, 'Note #3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.', '2014-11-03 02:16:30', '2014-12-01 21:16:44', 0, 0, 0),
(4, 4, 18, 3, 'Note #4', 'Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. ', '2014-11-14 04:13:22', '2014-12-02 03:16:01', 0, 0, 0),
(5, 1, 45, 2, 'Note #5', 'Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. ', '2014-11-14 04:13:22', '2014-11-23 17:15:52', 1, 1, 0),
(7, 1, 14, 3, 'Note #6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec.', '2014-11-19 04:13:22', '2014-12-01 21:16:44', 0, 0, 0),
(8, 0, 17, 3, 'Lorem Ipsum 3', 'Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. Sed lectus. ', '2014-11-23 17:07:16', '2014-12-02 03:16:18', 0, 0, 0),
(9, 0, 15, 3, 'Improve Website UI', 'Improve website UI, CSS!', '2014-11-23 17:12:41', '2014-12-01 21:16:44', 0, 0, 0),
(10, 0, 15, 3, 'Dropbox login', '&lt;p&gt;Login via &lt;a href=&quot;https://dropbox.com/&quot; target=&quot;_blank&quot;&gt;Dropbox&lt;/a&gt;.&lt;/p&gt;', '2014-11-23 17:19:07', '2014-12-02 03:56:26', 0, 0, 0),
(11, 0, 15, 3, 'Optimize database', 'Optimize database!', '2014-11-23 17:32:26', '2014-12-01 21:16:45', 0, 0, 0),
(12, 0, 14, 3, 'Tag for note', 'Write tag feature for note!', '2014-11-23 19:40:27', '2014-12-01 21:16:45', 0, 0, 0),
(13, 1, NULL, 3, 'ASDFGHJ', 'Lorem ipsum generator.', '2014-12-01 20:43:40', '2014-12-01 20:47:09', 1, 0, 0),
(14, 0, NULL, 3, 'Untitled', '&amp;nbsp;fdfgd', '2014-12-01 20:47:45', '2014-12-01 20:47:45', 1, 0, 0),
(15, 0, 14, 3, '02/12/2014', '&lt;p&gt;Today is 2 Dec, 2014&lt;/p&gt;&lt;p&gt;Edited at 10:24 PM&lt;/p&gt;', '2014-12-02 03:24:20', '2014-12-02 03:43:04', 0, 0, 0),
(17, 0, 14, 3, 'Untitled', 'This note was edited!', '2014-12-02 03:31:02', '2014-12-02 03:42:46', 0, 0, 0),
(18, 0, 16, 3, 'Untitled', '&amp;nbsp;', '2014-12-02 03:57:25', '2014-12-02 04:36:10', 0, 0, 1);

--
-- Triggers `notes`
--
DROP TRIGGER IF EXISTS `before_insert_notes`;
DELIMITER //
CREATE TRIGGER `before_insert_notes` BEFORE INSERT ON `notes`
 FOR EACH ROW SET NEW.`note_modified` = NOW()
//
DELIMITER ;
DROP TRIGGER IF EXISTS `before_update_notes`;
DELIMITER //
CREATE TRIGGER `before_update_notes` BEFORE UPDATE ON `notes`
 FOR EACH ROW SET NEW.`note_modified` = NOW()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `note_meta`
--
-- Creation: Dec 01, 2014 at 06:06 PM
--

DROP TABLE IF EXISTS `note_meta`;
CREATE TABLE IF NOT EXISTS `note_meta` (
`id` int(20) unsigned NOT NULL,
  `note_id` int(20) unsigned DEFAULT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `note_meta`:
--   `note_id`
--       `notes` -> `id`
--

--
-- Truncate table before insert `note_meta`
--

TRUNCATE TABLE `note_meta`;
-- --------------------------------------------------------

--
-- Table structure for table `note_types`
--
-- Creation: Dec 01, 2014 at 06:06 PM
--

DROP TABLE IF EXISTS `note_types`;
CREATE TABLE IF NOT EXISTS `note_types` (
`id` int(20) unsigned NOT NULL,
  `type_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `note_types`
--

TRUNCATE TABLE `note_types`;
--
-- Dumping data for table `note_types`
--

INSERT INTO `note_types` (`id`, `type_name`) VALUES
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
-- Creation: Dec 01, 2014 at 06:06 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(20) unsigned NOT NULL,
  `user_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_activation_key` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `user_role` enum('user','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `display_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_online` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `user_role`, `display_name`, `is_online`) VALUES
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
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `fk_user_id_notebooks` (`user_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `fk_user_id` (`user_id`), ADD KEY `fk_type_id` (`type_id`), ADD KEY `fk_book_id` (`notebook_id`);

--
-- Indexes for table `note_meta`
--
ALTER TABLE `note_meta`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `fk_note_id` (`note_id`);

--
-- Indexes for table `note_types`
--
ALTER TABLE `note_types`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `user_name` (`user_name`), ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notebooks`
--
ALTER TABLE `notebooks`
MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `note_meta`
--
ALTER TABLE `note_meta`
MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `note_types`
--
ALTER TABLE `note_types`
MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `notebooks`
--
ALTER TABLE `notebooks`
ADD CONSTRAINT `fk_user_id_notebooks` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
ADD CONSTRAINT `fk_notebook_id_notes` FOREIGN KEY (`notebook_id`) REFERENCES `notebooks` (`id`),
ADD CONSTRAINT `fk_type_id_notes` FOREIGN KEY (`type_id`) REFERENCES `note_types` (`id`),
ADD CONSTRAINT `fk_user_id_notes` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `note_meta`
--
ALTER TABLE `note_meta`
ADD CONSTRAINT `fk_note_id_note_meta` FOREIGN KEY (`note_id`) REFERENCES `notes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
