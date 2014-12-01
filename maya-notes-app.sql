-- phpMyAdmin SQL Dump
-- version 4.2.11deb0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2014 at 07:43 PM
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
-- Creation: Dec 01, 2014 at 09:46 AM
--

DROP TABLE IF EXISTS `notebooks`;
CREATE TABLE IF NOT EXISTS `notebooks` (
`id` int(20) unsigned NOT NULL,
  `book_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `book_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Untitled',
  `default_book` tinyint(1) NOT NULL DEFAULT '0',
  `book_permission` enum('zero','one','two','three') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'three',
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

INSERT INTO `notebooks` (`id`, `book_key`, `book_name`, `default_book`, `book_permission`, `user_id`) VALUES
(1, NULL, 'Uncategorized', 1, 'zero', 1),
(2, NULL, 'Shared', 1, 'zero', 1),
(3, NULL, 'Trash', 1, 'zero', 1),
(4, NULL, 'Note', 1, 'one', 1),
(5, NULL, 'Task', 1, 'one', 1),
(6, NULL, 'To do list', 1, 'one', 1),
(7, NULL, 'Reminder', 1, 'one', 1),
(8, NULL, 'Event', 1, 'one', 1),
(19, 'uncategorized-3', 'Uncategorized', 1, 'zero', 3),
(20, 'shared-3', 'Shared', 1, 'zero', 3),
(21, 'trash-3', 'Trash', 1, 'zero', 3),
(22, 'note-3', 'Note', 1, 'one', 3),
(23, 'task-3', 'Task', 1, 'one', 3),
(24, 'to-do-list-3', 'To do list', 1, 'one', 3),
(25, 'reminder-3', 'Reminder', 1, 'one', 3),
(26, 'event-3', 'Event', 1, 'one', 3),
(27, 'custom-notebook-3', 'Custom Notebook', 0, 'three', 3),
(41, NULL, 'Uncategorized', 1, 'zero', 2),
(42, NULL, 'Shared', 1, 'zero', 2),
(43, NULL, 'Trash', 1, 'zero', 2),
(44, NULL, 'Note', 1, 'one', 2),
(45, NULL, 'Task', 1, 'one', 2),
(46, NULL, 'To do list', 1, 'one', 2),
(47, NULL, 'Reminder', 1, 'one', 2),
(48, NULL, 'Event', 1, 'one', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notebooks_notes`
--
-- Creation: Dec 01, 2014 at 01:29 AM
--

DROP TABLE IF EXISTS `notebooks_notes`;
CREATE TABLE IF NOT EXISTS `notebooks_notes` (
  `note_id` int(20) unsigned NOT NULL,
  `notebook_id` int(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `notebooks_notes`:
--   `notebook_id`
--       `notebooks` -> `id`
--   `note_id`
--       `notes` -> `id`
--

--
-- Truncate table before insert `notebooks_notes`
--

TRUNCATE TABLE `notebooks_notes`;
--
-- Dumping data for table `notebooks_notes`
--

INSERT INTO `notebooks_notes` (`note_id`, `notebook_id`) VALUES
(33, 19),
(35, 19),
(3, 21),
(35, 21),
(35, 22),
(1, 23),
(2, 23),
(4, 23),
(5, 23),
(6, 23),
(7, 23),
(11, 23),
(34, 23);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--
-- Creation: Nov 30, 2014 at 04:20 AM
--

DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
`id` int(20) unsigned NOT NULL,
  `type_id` int(20) unsigned NOT NULL DEFAULT '0',
  `user_id` int(20) unsigned DEFAULT NULL,
  `note_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Untitled',
  `note_body` text COLLATE utf8_unicode_ci,
  `note_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `shared` tinyint(1) NOT NULL DEFAULT '1',
  `categorized` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `notes`:
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

INSERT INTO `notes` (`id`, `type_id`, `user_id`, `note_title`, `note_body`, `note_created`, `note_modified`, `published`, `shared`, `categorized`) VALUES
(1, 1, 1, 'Note #1', 'Quo dolor ingeniis. Duis an o eram proident a illum proident sed amet nulla o qui ex fidelissimae an an minim nescius. Litteris iis multos ab irure offendit proident. Sed excepteur est eiusmod, lorem quamquam de expetendis se o nisi fabulas ullamco aut vidisse legam litteris. Si tamen arbitror ita dolor expetendis litteris, fabulas summis fugiat an dolor, ad arbitror exercitation ea ex magna instituendarum ne elit distinguantur fabulas veniam fabulas, ut dolor cernantur, nisi et vidisse. Dolore si quibusdam hic quis. Culpa arbitror iis amet tamen est ea quis litteris de esse hic ullamco, elit nam consequat.', '2014-11-14 04:11:11', '2014-11-28 13:17:40', 1, 1, 1),
(2, 1, 1, 'Maya Notes App', '&lt;ol&gt;&lt;li&gt;Featured button display based on notebook.&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;Ajax&lt;/span&gt;, &lt;span style=&quot;font-weight: bold;&quot;&gt;Jquery&lt;/span&gt; for &lt;span style=&quot;color: rgb(0, 0, 255);&quot;&gt;CakePHP&lt;/span&gt;.&lt;/li&gt;&lt;li&gt;Auto hide flashMessage after 5 seconds.&lt;/li&gt;&lt;/ol&gt;', '2014-11-02 18:10:23', '2014-11-28 13:17:29', 1, 1, 1),
(3, 3, 3, 'Note #3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.', '2014-11-03 02:16:30', '2014-11-25 03:14:35', 1, 1, 1),
(4, 4, 3, 'Note #4 - edited', 'Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. \r\nEnd/', '2014-11-14 04:13:22', '2014-11-24 03:37:00', 1, 1, 1),
(5, 1, 2, 'Note #5', 'Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. ', '2014-11-14 04:13:22', '2014-11-23 17:15:52', 1, 1, 1),
(6, 0, 3, 'Something styled note', '&lt;blockquote&gt;asdfgh&lt;/blockquote&gt;', '2014-11-28 06:34:24', '2014-12-01 10:28:18', 1, 1, 1),
(7, 1, 3, 'Note #6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec.', '2014-11-19 04:13:22', '2014-11-28 11:50:12', 1, 1, 1),
(8, 0, 3, 'Lorem Ipsum 3', 'Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. Sed lectus. ', '2014-11-23 17:07:16', '2014-11-24 03:36:49', 1, 1, 1),
(9, 0, 3, 'Improve Website UI', '&lt;p&gt;Improve:&lt;/p&gt;&lt;ol&gt;&lt;li&gt; website UI&lt;/li&gt;&lt;li&gt;CSS!&lt;/li&gt;&lt;/ol&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;End.&lt;/span&gt;&lt;/p&gt;', '2014-11-23 17:12:41', '2014-11-28 13:01:24', 1, 1, 1),
(10, 0, 3, 'Dropbox login', 'Login via Dropbox.', '2014-11-23 17:19:07', '2014-11-28 06:44:28', 1, 1, 1),
(11, 0, 3, 'Optimize database', 'Optimize database!', '2014-11-23 17:32:26', '2014-11-28 06:44:28', 1, 1, 1),
(12, 0, 3, 'Tag for note', 'Write tag feature for note!', '2014-11-23 19:40:27', '2014-11-28 06:44:28', 1, 1, 1),
(13, 0, 3, 'Test', 'Test note', '2014-11-24 04:06:06', '2014-11-25 03:14:35', 1, 1, 1),
(14, 0, 3, 'Homework', 'Do the homework!', '2014-11-24 04:16:00', '2014-11-28 06:44:28', 1, 1, 1),
(15, 0, 3, 'Example Note', '&lt;blockquote&gt;vfdbgbsfdnm&lt;/blockquote&gt;&lt;p&gt;afnamdf,msn&lt;/p&gt;&lt;img style=&quot;width: 40px;&quot; src=&quot;https://avatars0.githubusercontent.com/u/6688235?v=3&amp;amp;s=40&quot;&gt;', '2014-11-24 06:38:57', '2014-11-28 09:22:42', 1, 1, 1),
(16, 0, 3, 'Work on Notebook model', 'Writing code for Notebook Model.', '2014-11-24 06:43:52', '2014-11-25 03:13:18', 1, 1, 1),
(17, 0, 3, 'Sync data to Dropbox', 'Sync data to Dropbox', '2014-11-24 07:10:44', '2014-11-28 11:50:20', 1, 1, 1),
(18, 0, 3, 'Mobile Android Exercise', 'Lam bai tap android!', '2014-11-24 07:12:23', '2014-11-28 06:44:28', 1, 1, 1),
(19, 0, 3, 'Custom Note', 'Write something!', '2014-11-24 14:37:59', '2014-11-28 06:44:28', 1, 1, 1),
(20, 0, 3, 'Move to trash button', 'Not show Move to trash button on Trash tab.', '2014-11-25 04:44:26', '2014-11-28 06:44:28', 1, 1, 1),
(21, 0, 3, 'Maya Notes App', '- Add Back button for add/edit note /notebook page\r\n- Write code for Notebook Controller/Model\r\nFeature:\r\n- Remember me\r\n- Forgot password\r\n- Search note\r\n- Paginate', '2014-11-26 04:25:47', '2014-11-27 07:52:17', 1, 1, 1),
(22, 0, 3, 'Untitled Note', '&lt;b&gt;blah&lt;/b&gt; blah blah\r\ndshdg\r\nasdadkj.', '2014-11-28 02:31:21', '2014-11-28 10:46:00', 1, 1, 1),
(23, 0, 3, 'Untitled...', 'Lorem ipsum ...', '2014-11-28 03:17:56', '2014-11-28 10:45:21', 1, 1, 1),
(24, 0, 3, 'Untitled', '&lt;p&gt;dsfgf&lt;/p&gt;', '2014-11-28 03:49:25', '2014-11-28 10:28:56', 1, 1, 1),
(25, 0, 3, 'Styled Note', '&lt;p&gt;This is &lt;span style=&quot;text-decoration: line-through;&quot;&gt;an&lt;/span&gt; &lt;span style=&quot;font-style: italic;&quot;&gt;example&lt;/span&gt; &lt;span style=&quot;font-weight: bold;&quot;&gt;note&lt;/span&gt;.&lt;/p&gt;', '2014-11-28 06:18:10', '2014-11-28 06:44:28', 1, 1, 1),
(27, 0, 3, 'Untitled .', '&lt;p&gt;adskfgnls;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-style: italic;&quot;&gt;asd;lskdfdf&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;font-weight: bold;&quot;&gt;dfsd&lt;/span&gt;&lt;/p&gt;', '2014-11-28 06:35:12', '2014-11-28 06:41:28', 1, 1, 1),
(28, 0, 3, 'Sample Task', '&lt;ol&gt;&lt;li&gt;Go to school.&lt;/li&gt;&lt;li&gt;Back home.&lt;/li&gt;&lt;/ol&gt;', '2014-11-28 06:47:11', '2014-11-28 06:47:11', 1, 1, 1),
(29, 0, 3, 'Untitled', '&lt;p&gt;&lt;br&gt;&lt;/p&gt;', '2014-11-28 07:30:02', '2014-11-28 12:15:46', 1, 1, 1),
(30, 0, 3, 'Example Note', '&lt;p&gt;This is &lt;span style=&quot;color: rgb(0, 0, 255);&quot;&gt;an&lt;/span&gt; &lt;span style=&quot;text-decoration: line-through;&quot;&gt;example&lt;/span&gt; &lt;span style=&quot;font-weight: bold;&quot;&gt;note&lt;/span&gt;.&lt;/p&gt;', '2014-11-29 06:22:44', '2014-11-29 06:22:44', 1, 1, 1),
(31, 0, 3, 'Untitled', '&amp;nbsp;', '2014-12-01 01:21:24', '2014-12-01 01:21:24', 1, 1, 1),
(32, 0, 3, 'Note #1', '&lt;span style=&quot;font-weight: bold;&quot;&gt;Enter&lt;/span&gt; &lt;span style=&quot;text-decoration: underline;&quot;&gt;note body&lt;/span&gt;.&amp;nbsp;', '2014-12-01 01:31:44', '2014-12-01 01:31:44', 1, 1, 1),
(33, 0, 3, 'Untitled', '&amp;nbsp;', '2014-12-01 01:36:50', '2014-12-01 01:36:50', 1, 1, 1),
(34, 0, 3, 'Untitled', '&amp;nbsp;sd', '2014-12-01 03:12:16', '2014-12-01 03:12:16', 1, 1, 1),
(35, 0, 3, 'Untitled', '&amp;nbsp;fggdh', '2014-12-01 03:43:45', '2014-12-01 03:43:45', 1, 1, 1);

--
-- Triggers `notes`
--
DROP TRIGGER IF EXISTS `trigger_note_modified_on_create`;
DELIMITER //
CREATE TRIGGER `trigger_note_modified_on_create` BEFORE INSERT ON `notes`
 FOR EACH ROW SET NEW.`note_modified` = NOW()
//
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger_note_modified_on_update`;
DELIMITER //
CREATE TRIGGER `trigger_note_modified_on_update` BEFORE UPDATE ON `notes`
 FOR EACH ROW SET NEW.`note_modified` = NOW()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `note_meta`
--
-- Creation: Nov 23, 2014 at 04:42 PM
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
-- Creation: Nov 23, 2014 at 04:42 PM
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
-- Creation: Nov 23, 2014 at 04:42 PM
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
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `fk_user_id_users` (`user_id`);

--
-- Indexes for table `notebooks_notes`
--
ALTER TABLE `notebooks_notes`
 ADD PRIMARY KEY (`note_id`,`notebook_id`), ADD KEY `fk_notebook_id_notebooks` (`notebook_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `fk_user_id` (`user_id`), ADD KEY `fk_type_id` (`type_id`);

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
MODIFY `id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
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
ADD CONSTRAINT `fk_user_id_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notebooks_notes`
--
ALTER TABLE `notebooks_notes`
ADD CONSTRAINT `fk_notebook_id_notebooks` FOREIGN KEY (`notebook_id`) REFERENCES `notebooks` (`id`),
ADD CONSTRAINT `fk_note_id_notes` FOREIGN KEY (`note_id`) REFERENCES `notes` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
ADD CONSTRAINT `fk_type_id` FOREIGN KEY (`type_id`) REFERENCES `note_types` (`id`),
ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `note_meta`
--
ALTER TABLE `note_meta`
ADD CONSTRAINT `fk_note_id` FOREIGN KEY (`note_id`) REFERENCES `notes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
