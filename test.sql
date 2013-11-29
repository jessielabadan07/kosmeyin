-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 19, 2012 at 09:45 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STRING`(str VARCHAR(255), delim VARCHAR(12), pos INT) RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(str,delim,pos),
			LENGTH(SUBSTRING_INDEX(str,delim,pos-1) ) + 1 ),
delim, '')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `article_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_content` text COLLATE utf8_unicode_ci NOT NULL,
  `article_textdisplay` text COLLATE utf8_unicode_ci NOT NULL,
  `optional_image` text COLLATE utf8_unicode_ci NOT NULL,
  `date_published` datetime NOT NULL,
  `article_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `id`, `article_title`, `article_content`, `article_textdisplay`, `optional_image`, `date_published`, `article_status`) VALUES
(6, 1, 'The Korean rookie Yan Hsiu Hong summer beach makeup', '<p>\r\n	&nbsp;</p>\r\n<div id="cke_pastebin">\r\n	<span style="color:#dda0dd;">The Korean rookie Yan Hsiu Hong summer beach makeup</span></div>\r\n<div id="cke_pastebin">\r\n	Assad. Security PLA slimming afraid. The room police will lose weight lose weight oh ah feel ah! Chili powder called kosmeyin Jian&#39;an fee built!</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Welcome Again</div>\r\n', '<p>\r\n	Assad. Security PLA slimming afraid. The room police will lose weight lose weight oh ah feel ah! Chili powder called kosmeyin Jian&#39;an fee built!</p>\r\n', '1347429943g3.png', '2012-10-24 01:40:10', 1),
(7, 1, 'Makeup tips - 3 Basic Blush', '<p>\r\n	<span style="font-family:comic sans ms,cursive;"><span style="font-size: 16px; "><span style="color: rgb(221, 160, 221); ">Makeup tips - 3 Basic Blush</span></span></span></p>\r\n', '<p>\r\n	Fell in love with the crime incident loudly. Fell in love oh ah teach ah. Our household near! Called me to even look both codes sirens.</p>\r\n', '1347429975g2.png', '2012-10-24 01:40:04', 1),
(8, 1, 'Beauty Tips - Summer glamorous fluorescent makeup', '<p>\r\n	<span style="color:#dda0dd;">Beauty Tips - Summer glamorous fluorescent makeup</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<div>\r\n	<span style="font-family:georgia,serif;">Austrian Master comfortable Caesar called sister Oh. Do weight loss sterile auxiliary towel oga to poke Gillian oh. Tonight integral Feng Fei Fei! The proud of furniture Owen home.</span></div>\r\n<div id="cke_pastebin">\r\n	&nbsp;</div>\r\n<div id="cke_pastebin">\r\n	<span style="font-family:georgia,serif;">Fell in love with the crime incident loudly. Fell in love oh ah teach ah. Our household near! Called me to even look both codes sirens.</span></div>\r\n<div>\r\n	<div>\r\n		<span style="font-family: georgia, serif; ">Austrian Master comfortable Caesar called sister Oh. Do weight loss sterile auxiliary towel oga to poke Gillian oh. Tonight integral Feng Fei Fei! The proud of furniture Owen home.</span></div>\r\n	<div id="cke_pastebin">\r\n		&nbsp;</div>\r\n	<div id="cke_pastebin">\r\n		<span style="font-family: georgia, serif; ">Fell in love with the crime incident loudly. Fell in love oh ah teach ah. Our household near! Called me to even look both codes sirens.</span></div>\r\n	<div>\r\n		<div>\r\n			<span style="font-family: georgia, serif; ">Austrian Master comfortable Caesar called sister Oh. Do weight loss sterile auxiliary towel oga to poke Gillian oh. Tonight integral Feng Fei Fei! The proud of furniture Owen home.</span></div>\r\n		<div id="cke_pastebin">\r\n			&nbsp;</div>\r\n		<div id="cke_pastebin">\r\n			<span style="font-family: georgia, serif; ">Fell in love with the crime incident loudly. Fell in love oh ah teach ah. Our household near! Called me to even look both codes sirens.</span></div>\r\n		<div>\r\n			<div>\r\n				<span style="font-family: georgia, serif; ">Austrian Master comfortable Caesar called sister Oh. Do weight loss sterile auxiliary towel oga to poke Gillian oh. Tonight integral Feng Fei Fei! The proud of furniture Owen home.</span></div>\r\n			<div id="cke_pastebin">\r\n				&nbsp;</div>\r\n			<div id="cke_pastebin">\r\n				<span style="font-family: georgia, serif; ">Fell in love with the crime incident loudly. Fell in love oh ah teach ah. Our household near! Called me to even look both codes sirens.</span></div>\r\n			<div>\r\n				<div>\r\n					<span style="font-family: georgia, serif; ">Austrian Master comfortable Caesar called sister Oh. Do weight loss sterile auxiliary towel oga to poke Gillian oh. Tonight integral Feng Fei Fei! The proud of furniture Owen home.</span></div>\r\n				<div id="cke_pastebin">\r\n					&nbsp;</div>\r\n				<div id="cke_pastebin">\r\n					<span style="font-family: georgia, serif; ">Fell in love with the crime incident loudly. Fell in love oh ah teach ah. Our household near! Called me to even look both codes sirens.</span></div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n</div>\r\n', '<div id="cke_pastebin">\r\n	<h4 style="font-weight: normal; font-size: 14px; margin: 0px; padding: 0px 0px 10px; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; ">\r\n		Austrian Master comfortable Caesar called sister Oh. Do weight loss sterile auxiliary towel oga to poke Gillian oh. Tonight integral Feng Fei Fei! The proud of furniture Owen home.</h4>\r\n</div>\r\n', '1347430028g1.png', '2012-10-24 01:39:58', 1),
(12, 1, 'ARTICLE WITH CATEGORY AND TAGS', '<p>\r\n	<strong style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify; ">Lorem Ipsum</strong><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify; ">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;</span><strong style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify; ">Lorem Ipsum</strong><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify; ">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n', '<p>\r\n	FRON CATEGORY ARTICLE</p>\r\n', '1348820948anthemum.jpg', '2012-10-24 01:39:52', 1),
(13, 1, 'SAMPLE', '<p>\r\n	SAMPLE EDWIN LACIERDA</p>\r\n<p>\r\n	<img alt="" src="/admin-panel/userfiles/image/Desert.jpg" style="width: 500px; height: 375px; float: left; " /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	THIS IS MY SECOND IMAGE</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<img alt="" src="/admin-panel/userfiles/image/Penguins.jpg" style="width: 200px; height: 150px; " /></p>\r\n', '<p>\r\n	SAMPLE</p>\r\n', '', '2012-10-24 01:39:46', 1),
(14, 1, 'ERNIE', '<p>\r\n	WERNKEWJRJNWER ]WR</p>\r\n<p>\r\n	]&nbsp;</p>\r\n<p>\r\n	SDF</p>\r\n<p>\r\n	DS<img alt="" src="/admin-panel/userfiles/image/Lighthouse.jpg" style="width: 200px; height: 150px; " /></p>\r\n<p>\r\n	SDA</p>\r\n<p>\r\n	&nbsp;D</p>\r\n<p>\r\n	&nbsp;GD</p>\r\n<p>\r\n	<img alt="" src="/admin-panel/userfiles/image/ernie/Hydrangeas.jpg" style="width: 500px; height: 375px; " /></p>\r\n<p>\r\n	SG S</p>\r\n<p>\r\n	DG</p>\r\n', '<h1>\r\n	<span style="color:#ee82ee;">ERNIE MAN</span></h1>\r\n', '1349851662anthemum.jpg', '2012-10-24 01:39:39', 1),
(16, 1, 'ANOTHER ARTICLE', '<p>\r\n	MY ANOTHER ARTICLE</p>\r\n', '<p>\r\n	YM ARTICLE</p>\r\n', '1349759391ngeas.jpg', '2012-10-18 16:12:30', 1),
(17, 1, 'Jessie Article', '<p>\r\n	Lorem Epsum Dolor Este.&nbsp;Lorem Epsum Dolor Este</p>\r\n<p>\r\n	Lorem Epsum Dolor EsteLorem Epsum Dolor Este</p>\r\n<p>\r\n	Lorem Epsum Dolor EsteLorem Epsum Dolor Este</p>\r\n<p>\r\n	<img alt="" src="/admin-panel/userfiles/image/Tulips.jpg" style="width: 200px; height: 150px; " /></p>\r\n', '<p>\r\n	The quick brown fox jumps over the lazy dog.&nbsp;The quick brown fox jumps over the lazy dog.</p>\r\n<p>\r\n	The quick brown fox jumps over the lazy dog.The quick brown fox jumps over the lazy dog.</p>\r\n', '1351012696ins.jpg', '2012-10-24 01:39:27', 1),
(18, 1, 'Programmer Article', '<p>\r\n	HELLO WORLD&#39;S GREATEST PROGRAMMER</p>\r\n', '<p>\r\n	HELLO WORLD</p>\r\n<p>\r\n	THIS IS MY TEXT&#39;S</p>\r\n', '1351013072anthemum.jpg', '2012-10-24 01:24:31', 1),
(19, 1, 'MY ARTICLE', '<p>\r\n	HELLO WORLDHELLO WORLDHELLO WORLD</p>\r\n<p>\r\n	HELLO WORLDHELLO WORLDHELLO WORLD</p>\r\n<p>\r\n	HELLO WORLDHELLO WORLDHELLO WORLD</p>\r\n', '<p>\r\n	HELLO WORLDHELLO WORLDHELLO WORLDHELLO WORLD</p>\r\n<p>\r\n	HELLO WORLDHELLO WORLDHELLO WORLD</p>\r\n<p>\r\n	HELLO WORLDHELLO WORLD</p>\r\n', '', '2012-10-24 01:40:53', 1),
(20, 1, 'DESIGNER ARTICLE', '', '<p>\r\n	I LOVE WEB DESIGNI LOVE WEB DESIGNI LOVE WEB DESIGNI LOVE WEB DESIGN</p>\r\n<p>\r\n	I LOVE WEB DESIGN</p>\r\n<p>\r\n	I LOVE WEB DESIGNI LOVE WEB DESIGN</p>\r\n', '', '2012-10-24 01:43:34', 1),
(21, 1, 'November Article', '<p>\r\n	THIS IS MY TEXT&nbsp;<img alt="" src="/admin-panel/userfiles/image/Penguins.jpg" style="width: 200px; height: 150px; " /></p>\r\n<p>\r\n	THE INSIDE CONTENT</p>\r\n<p>\r\n	TEXT</p>\r\n', '<p>\r\n	<span style="background-color:#f00;">This is the front text of November</span></p>\r\n<p>\r\n	<span style="color:#00ff00;">Happy Halloween to Everyone</span></p>\r\n', '1352093988.jpg', '2012-11-05 13:49:42', 0),
(22, 1, 'hello world article', '<p>\r\n	THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG</p>\r\n<p>\r\n	THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG</p>\r\n<p>\r\n	THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG</p>\r\n<p>\r\n	THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG</p>\r\n<p>\r\n	THE QUICK BROWN FOX JUMPS OVER THE LAZY DOG</p>\r\n', '<p>\r\n	THIS IS MY ARTICLE HELLO WORLD</p>\r\n', '1352102655s.jpg', '2012-11-05 16:04:47', 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id`, `article_id`, `cat_id`, `status`, `dateadded`) VALUES
(1, 16, 22, 1, '2012-10-18 16:12:30'),
(6, 18, 22, 1, '2012-10-24 01:24:31'),
(7, 17, 21, 1, '2012-10-24 01:39:27'),
(8, 17, 22, 1, '2012-10-24 01:39:27'),
(9, 14, 22, 1, '2012-10-24 01:39:40'),
(10, 13, 22, 1, '2012-10-24 01:39:46'),
(11, 12, 22, 1, '2012-10-24 01:39:52'),
(12, 8, 22, 1, '2012-10-24 01:39:58'),
(13, 7, 22, 1, '2012-10-24 01:40:04'),
(14, 6, 22, 1, '2012-10-24 01:40:10'),
(15, 19, 22, 1, '2012-10-24 01:40:53'),
(16, 20, 22, 1, '2012-10-24 01:43:34'),
(22, 21, 22, 1, '2012-11-05 13:49:42'),
(24, 22, 23, 1, '2012-11-05 16:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `article_comment`
--

CREATE TABLE IF NOT EXISTS `article_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `article_comment`
--

INSERT INTO `article_comment` (`id`, `article_id`, `user_id`, `comments`, `status`, `dateadded`) VALUES
(1, 8, 17, 'The quick brown fox jumps over the lazy dog.', 1, '2012-10-04 11:51:38'),
(2, 8, 17, '<b>Hello Comment</b> <i>This is a comment</i>', 1, '2012-10-04 12:05:34'),
(3, 13, 17, 'This is a great website!', 1, '2012-10-04 12:24:58'),
(5, 13, 18, 'This is my comment - jessie07', 1, '2012-10-04 12:42:30'),
(6, 13, 18, 'yes!', 1, '2012-10-04 13:07:03'),
(7, 13, 18, 'hey!', 1, '2012-10-04 13:31:53'),
(8, 14, 18, 'Nice!', 1, '2012-10-04 13:55:43'),
(9, 14, 18, 'My comment!', 1, '2012-10-04 13:56:19'),
(10, 13, 18, 'great', 1, '2012-10-12 14:29:26'),
(11, 16, 18, 'hello', 1, '2012-10-12 14:29:41'),
(12, 6, 18, 'great', 1, '2012-10-12 14:30:09'),
(13, 7, 18, 'wew', 1, '2012-10-12 14:30:16'),
(14, 16, 1, 'werwerwer', 1, '2012-10-24 03:33:37'),
(15, 16, 1, 'Hello World', 1, '2012-10-24 03:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `article_dislike`
--

CREATE TABLE IF NOT EXISTS `article_dislike` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `article_dislike`
--

INSERT INTO `article_dislike` (`id`, `article_id`, `cat_id`, `user_id`, `date_added`) VALUES
(5, 14, 4, 20, '2012-10-05 12:41:31'),
(6, 13, 3, 1, '2012-10-05 13:53:02'),
(7, 14, 0, 1, '2012-10-09 14:29:27');

-- --------------------------------------------------------

--
-- Table structure for table `article_featured`
--

CREATE TABLE IF NOT EXISTS `article_featured` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `article_featured`
--

INSERT INTO `article_featured` (`id`, `article_id`, `dateadded`, `sort_order`) VALUES
(103, 22, '2012-11-05 16:07:56', 1),
(104, 18, '2012-11-05 16:07:56', 2),
(105, 17, '2012-11-05 16:07:56', 3),
(106, 20, '2012-11-05 16:07:56', 4),
(107, 8, '2012-11-05 16:07:57', 5),
(108, 12, '2012-11-05 16:07:57', 6),
(109, 16, '2012-11-05 16:07:57', 7),
(110, 14, '2012-11-05 16:07:57', 8);

-- --------------------------------------------------------

--
-- Table structure for table `article_likes`
--

CREATE TABLE IF NOT EXISTS `article_likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `article_likes`
--

INSERT INTO `article_likes` (`id`, `article_id`, `cat_id`, `user_id`, `date_added`) VALUES
(1, 8, 1, 17, '2012-10-04 10:15:09'),
(7, 12, 1, 17, '2012-10-04 10:56:27'),
(13, 13, 3, 17, '2012-10-04 12:24:00'),
(20, 13, 3, 18, '2012-10-04 13:06:29'),
(24, 14, 0, 18, '2012-10-04 14:05:18'),
(25, 12, 1, 18, '2012-10-04 14:05:56'),
(26, 12, 0, 1, '2012-10-04 16:33:14'),
(37, 14, 4, 20, '2012-10-05 12:40:15'),
(38, 16, 1, 1, '2012-10-05 13:53:08'),
(39, 13, 3, 1, '2012-10-09 14:17:14'),
(40, 8, 0, 1, '2012-10-09 14:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `bonus_points`
--

CREATE TABLE IF NOT EXISTS `bonus_points` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `bonus_pts` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`bid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `bonus_points`
--

INSERT INTO `bonus_points` (`bid`, `uid`, `bonus_pts`, `description`, `dateadded`) VALUES
(16, 17, 50, 'user-register', '2012-10-15 13:31:03'),
(17, 18, 50, 'user-register', '2012-10-15 13:31:03'),
(18, 20, 50, 'user-register', '2012-10-15 13:31:03'),
(19, 23, 50, 'user-register', '2012-10-15 13:31:03'),
(20, 24, 50, 'user-register', '2012-10-15 13:31:03'),
(22, 26, 50, 'user-register', '2012-10-15 13:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_alias` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_type` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cat_status` tinyint(4) NOT NULL,
  `cat_dateupdate` datetime NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`, `cat_description`, `cat_alias`, `cat_type`, `cat_status`, `cat_dateupdate`) VALUES
(21, '产品介绍', '', 'product-review', 'article', 1, '2012-10-11 13:31:38'),
(22, '美容教程', '', 'beauty-how-to', 'article', 1, '2012-10-11 14:40:01'),
(23, 'HelloWorld', '', 'helloworld', 'article', 1, '2012-11-05 16:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `gift_points`
--

CREATE TABLE IF NOT EXISTS `gift_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `description` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `image_gallery`
--

CREATE TABLE IF NOT EXISTS `image_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gallery_image` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `image_gallery`
--

INSERT INTO `image_gallery` (`id`, `gallery_image`, `description`, `status`, `dateadded`) VALUES
(18, '1349426725360asiana1.jpg', '', 1, '2012-10-05 16:45:25'),
(19, '1349426725380asiana2.png', '', 1, '2012-10-05 16:45:25'),
(20, '1349426725925asiana3.png', '', 1, '2012-10-05 16:45:25'),
(21, '1349426725483asiana4.png', '', 1, '2012-10-05 16:45:25'),
(22, '134942672581asiana5.png', '', 1, '2012-10-05 16:45:25'),
(23, '1349426725289asiana6.png', '', 1, '2012-10-05 16:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `ip_add`
--

CREATE TABLE IF NOT EXISTS `ip_add` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_addr` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_addr` (`ip_addr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE IF NOT EXISTS `menu_category` (
  `menucat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `category_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`menucat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`menucat_id`, `category_id`, `menu_id`, `category_type`, `dateadded`) VALUES
(20, 15, 5, 'page', '2012-10-10 15:44:19'),
(22, 21, 2, 'article', '2012-10-11 15:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `menu_submenu_link`
--

CREATE TABLE IF NOT EXISTS `menu_submenu_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sitemenu_id` int(11) NOT NULL,
  `submenu_id` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `menu_submenu_link`
--

INSERT INTO `menu_submenu_link` (`id`, `sitemenu_id`, `submenu_id`, `dateadded`) VALUES
(1, 2, 1, '2012-10-07 09:41:50'),
(2, 2, 3, '2012-10-07 09:43:08'),
(5, 3, 6, '2012-10-07 09:54:10'),
(8, 5, 9, '2012-10-07 09:55:29'),
(14, 3, 4, '2012-10-09 10:27:30'),
(15, 3, 5, '2012-10-09 10:27:40'),
(17, 3, 8, '2012-10-09 10:28:11'),
(18, 5, 10, '2012-10-09 10:28:32'),
(19, 5, 11, '2012-10-09 10:28:43'),
(20, 3, 7, '2012-10-09 10:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `page_tags` text NOT NULL,
  `page_link` varchar(255) NOT NULL,
  `page_status` tinyint(4) NOT NULL,
  `dateupdate` datetime NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_content`, `page_tags`, `page_link`, `page_status`, `dateupdate`) VALUES
(5, 'More ABOUT US', '<p>\r\n	THIS IS A CONTENT FOR MORE ABOUT US</p>\r\n', 'aboutus, policy, groups', 'http://localhost/kosmeyin/?pages&view_id=5', 1, '2012-09-27 15:47:00'),
(6, 'new page', '<p>\r\n	none</p>\r\n', 'none', 'http://localhost/kosmeyin/?pages&view_id=6', 1, '2012-09-27 15:27:58'),
(12, 'About Us', '<p>\r\n	THIS IS THE ABOUT US PAGE</p>\r\n', 'page', 'http://localhost/kosmeyin/?pages&view_id=12', 1, '2012-10-10 13:50:46'),
(15, 'Video Promotion', '<h1>\r\n	THIS IS A STATIC PAGE FOR MY VIDEO PROMOTION&nbsp;</h1>\r\n<p>\r\n	<span style="font-size:14px;"><span style="color: rgb(238, 130, 238); ">EMBED OTHER MEDIA HERE</span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	SOME TEXT HERE</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	SOME TEXT HERE</p>\r\n', 'page', 'http://localhost/kosmeyin/?pages/video-promotion', 1, '2012-10-10 15:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `page_widget`
--

CREATE TABLE IF NOT EXISTS `page_widget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `dateaddedd` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `page_widget`
--

INSERT INTO `page_widget` (`id`, `page_id`, `widget_id`, `dateaddedd`) VALUES
(1, 6, 5, '2012-10-09 16:48:51'),
(2, 6, 3, '2012-10-09 16:48:51'),
(23, 12, 1, '2012-10-10 13:50:46'),
(24, 12, 2, '2012-10-10 13:50:46'),
(25, 15, 3, '2012-10-10 15:38:59'),
(26, 15, 1, '2012-10-10 15:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `p_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `p_name` varchar(255) NOT NULL,
  `p_desc` text NOT NULL,
  `p_price` decimal(10,0) NOT NULL,
  `p_dateadded` date NOT NULL,
  `p_stock` int(11) NOT NULL,
  `p_image` text,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_desc`, `p_price`, `p_dateadded`, `p_stock`, `p_image`) VALUES
(1, 'NGenius Mouse', 'Best Mouse', 15, '2012-07-19', 15, 'genius-mouse.png'),
(2, 'Samsung Keyboard', 'Best Keyboard', 20, '2012-07-19', 12, 'keyboard.png'),
(3, 'LG Monitor', 'Best quality screen', 105, '2012-07-19', 18, 'flat-monitor.png'),
(4, 'Transcend USB 32GB', 'Easy save data', 40, '2012-07-19', 50, 'usb-transcend.png'),
(5, 'Transcend Ext. HDD 1TB', 'Great easy save large data', 145, '2012-07-19', 30, 'ext-hdd-transcend.png'),
(6, 'Samsung HDD 500GB', 'samsung harddisk 500gb', 120, '2012-07-19', 40, 'samsung-hdd.png'),
(7, 'Headset', 'headset', 20, '2012-07-19', 27, 'headset.png'),
(8, 'WebCam', 'best webcam', 22, '2012-07-19', 68, 'webcam.png'),
(9, 'LG Bluray', 'Best LG Bluray can read and write', 140, '2012-07-19', 25, 'lg-bluray.png'),
(10, 'Power Fox ', 'AVR Power Fox', 21, '2012-07-19', 10, 'powerfox-avr.png');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_products`
--

CREATE TABLE IF NOT EXISTS `purchased_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_items` int(11) NOT NULL,
  `p_description` text NOT NULL,
  `purchased_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `referrer_points`
--

CREATE TABLE IF NOT EXISTS `referrer_points` (
  `ref_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `friend_id` int(11) NOT NULL,
  `new_user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `r_points` int(11) NOT NULL,
  `datetime_added` datetime NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `referrer_points`
--

INSERT INTO `referrer_points` (`ref_id`, `friend_id`, `new_user_id`, `description`, `r_points`, `datetime_added`) VALUES
(2, 17, 20, 'New user: mark@localhost.com successfully registered, referred to User: hello@localhost.com', 50, '2012-10-01 10:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `send_codelink`
--

CREATE TABLE IF NOT EXISTS `send_codelink` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `friend_email` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `secret_link` text NOT NULL,
  `status_link` tinyint(4) NOT NULL,
  `ip_address` varchar(120) NOT NULL,
  `datetime_send` datetime NOT NULL,
  `lastdatetime_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `send_codelink`
--

INSERT INTO `send_codelink` (`id`, `uid`, `friend_email`, `subject`, `secret_link`, `status_link`, `ip_address`, `datetime_send`, `lastdatetime_update`) VALUES
(5, 17, 'mark@localhost.com', 'Hi Mark, Please click the link to join our page :D', 'f757bffce3dd5a93ebfa5f3f0b253a73d1931cd9', 1, '192.168.1.38', '2012-10-01 08:00:27', '2012-10-01 10:04:42'),
(10, 20, 'wizard@localhost.com', '一起来做 IN GIRL 玩转 因我IN', '0dfd5f3120f7ad1e471d7903aa349238a26d10b9', 0, '::1', '2012-10-25 18:33:26', '2012-10-25 18:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `sitemenu_content`
--

CREATE TABLE IF NOT EXISTS `sitemenu_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sitemenu_id` int(11) NOT NULL,
  `sitemenu_content` text NOT NULL,
  `sitemenu_status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `sitemenu_content`
--

INSERT INTO `sitemenu_content` (`id`, `sitemenu_id`, `sitemenu_content`, `sitemenu_status`, `date_added`) VALUES
(3, 2, '<p>\r\n	<span style="color:#f00;"><font size="3">HOW - TOS CONTENT</font></span></p>\r\n', 1, '2012-09-21 16:52:18'),
(5, 6, '<h1>\r\n	THIS IS THE CONTENT OF THE ABOUT US</h1>\r\n<p>\r\n	UPLOAD ANY IMAGES HERE</p>\r\n<p>\r\n	EMBED ANY VIDEOS</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	click <a href="http://localhost/kosmeyin/?pages/video-promotion">here</a> for more info</p>\r\n', 1, '2012-09-26 11:01:05'),
(6, 5, '', 1, '2012-09-26 17:13:45'),
(7, 3, '<p>\r\n	This is the trend</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	click <a href="http://localhost/kosmeyin/?pages&amp;view_id=5">here</a> for more info</p>\r\n', 1, '2012-09-27 15:38:34'),
(8, 7, '<h1>\r\n	SHOP AT WORKS</h1>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	GREATE SHOPT AT WORKS</p>\r\n', 0, '2012-10-04 14:07:19'),
(9, 18, '<p>\r\n	JESSIE</p>\r\n', 1, '2012-10-04 14:10:51'),
(14, 17, '', 1, '2012-10-04 14:20:59'),
(15, 16, '<p>\r\n	NICE</p>\r\n', 1, '2012-10-04 15:49:14'),
(16, 1, '', 1, '2012-10-08 15:03:14'),
(22, 0, '', 0, '2012-10-09 16:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `sitemenu_widget`
--

CREATE TABLE IF NOT EXISTS `sitemenu_widget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sitemenu_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;

--
-- Dumping data for table `sitemenu_widget`
--

INSERT INTO `sitemenu_widget` (`id`, `sitemenu_id`, `widget_id`, `date_added`) VALUES
(58, 4, 3, '2012-10-09 10:00:51'),
(59, 4, 4, '2012-10-09 10:00:51'),
(76, 6, 5, '2012-10-11 15:33:00'),
(77, 3, 2, '2012-10-11 15:40:20'),
(79, 7, 5, '2012-10-12 14:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `site_menu`
--

CREATE TABLE IF NOT EXISTS `site_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `menu_text` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menu_type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `menu_link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `menu_status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `site_menu`
--

INSERT INTO `site_menu` (`id`, `uid`, `menu_text`, `menu_type`, `menu_link`, `date_added`, `menu_status`) VALUES
(1, 1, '首页', 'top_menu', '', '2012-09-21 10:45:33', 1),
(2, 1, '美容教程', 'top_menu', '', '2012-09-21 08:28:36', 1),
(3, 1, '文章全集', 'top_menu', '', '2012-09-21 00:00:00', 1),
(4, 1, '游戏中心', 'top_menu', '游戏中心', '2012-09-21 08:37:29', 1),
(5, 1, '新闻和活动', 'top_menu', '新闻和活动', '2012-09-21 09:43:27', 1),
(6, 1, '关于我们', 'top_menu', 'about-us', '2012-09-21 17:32:32', 1),
(7, 1, '玩转因我IN', 'top_menu', 'how-it-works', '2012-09-21 07:25:39', 0),
(8, 1, 'Contributors', 'bottom_menu', 'contributor', '2012-09-21 08:32:13', 1),
(9, 1, 'Trends', 'bottom_menu', 'trend', '2012-09-21 09:20:35', 1),
(10, 1, 'News & Events', 'bottom_menu', 'newsandevents', '2012-09-21 09:45:25', 1),
(11, 1, 'Game Center', 'bottom_menu', 'gamecenter', '2012-09-21 07:30:19', 1),
(12, 1, 'Create an Account', 'bottom_menu', 'register', '2012-09-21 00:00:00', 1),
(13, 1, 'Login', 'bottom_menu', 'login', '2012-09-21 00:00:00', 1),
(14, 1, 'About Kosmeyin', 'bottom_menu', 'aboutus', '2012-09-21 00:00:00', 1),
(15, 1, 'Contact Us', 'bottom_menu', 'contactus', '2012-09-21 00:00:00', 1),
(16, 1, 'FAQs', 'bottom_menu', 'faq', '2012-09-21 00:00:00', 1),
(17, 1, 'Legal', 'bottom_menu', 'legal', '2012-09-21 00:00:00', 1),
(18, 1, 'JESSIE', 'bottom_menu', 'jessie', '2012-09-21 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_submenu`
--

CREATE TABLE IF NOT EXISTS `site_submenu` (
  `submenu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `submenu_name` varchar(255) NOT NULL,
  `submenu_content` text NOT NULL,
  `submenu_link` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`submenu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `site_submenu`
--

INSERT INTO `site_submenu` (`submenu_id`, `submenu_name`, `submenu_content`, `submenu_link`, `status`, `dateadded`) VALUES
(1, 'Articles', '', 'articles', 1, '2012-10-07 09:41:42'),
(3, 'Videos', '', 'videos', 1, '2012-10-07 09:43:08'),
(4, 'Beauty Trends', '', 'beautytrends', 1, '2012-10-07 09:53:41'),
(5, 'Fashion Trends', '', 'fashiontrends', 1, '2012-10-07 09:53:55'),
(6, 'Lifestyle', '', 'lifestyle', 1, '2012-10-07 09:54:10'),
(7, 'Product Reviews', '', 'productreviews', 1, '2012-10-07 09:54:33'),
(8, 'Miss K Picks', '', 'misskpicks', 1, '2012-10-07 09:54:51'),
(9, 'Promotions', '', 'promotions', 1, '2012-10-07 09:55:29'),
(10, 'Latest News', '', 'latestnews', 1, '2012-10-07 09:55:43'),
(11, 'IN GIRL Testimonials', '<p>\r\n	THIS IS THE IN GIRL CONTENT WITH IMAGES</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<img alt="" src="/admin-panel/userfiles/image/Lighthouse.jpg" style="width: 300px; height: 225px; " /></p>\r\n', 'ingirltestimonials', 1, '2012-10-07 09:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `subject_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `submenu_widget`
--

CREATE TABLE IF NOT EXISTS `submenu_widget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `submenu_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `submenu_widget`
--

INSERT INTO `submenu_widget` (`id`, `submenu_id`, `widget_id`, `dateadded`) VALUES
(1, 6, 5, '2012-10-09 16:49:06'),
(2, 6, 3, '2012-10-09 16:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE IF NOT EXISTS `survey` (
  `survey_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `survey_title` varchar(255) NOT NULL,
  `survey_type` varchar(255) NOT NULL,
  `survey_status` tinyint(4) NOT NULL,
  `survey_dateupdated` date NOT NULL,
  PRIMARY KEY (`survey_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`survey_id`, `survey_title`, `survey_type`, `survey_status`, `survey_dateupdated`) VALUES
(1, 'Company Website Design', 'company', 1, '2012-07-26'),
(2, 'company survey', 'company', 1, '2012-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `survey_status`
--

CREATE TABLE IF NOT EXISTS `survey_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `s_status` tinyint(4) NOT NULL,
  `s_update` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tags` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dateadded` datetime NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tags`, `status`, `dateadded`) VALUES
(1, 'fashion', 1, '2012-10-03 13:56:03'),
(2, 'beauty', 1, '2012-10-03 13:56:04'),
(3, 'health', 1, '2012-10-03 14:04:12'),
(4, 'product', 1, '2012-10-03 14:04:30'),
(5, 'makeup', 1, '2012-10-03 14:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `tag_article`
--

CREATE TABLE IF NOT EXISTS `tag_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `tag_article`
--

INSERT INTO `tag_article` (`id`, `tag_id`, `article_id`, `status`) VALUES
(64, 2, 0, 1),
(68, 3, 18, 1),
(69, 2, 17, 1),
(70, 3, 14, 1),
(71, 1, 12, 1),
(72, 2, 12, 1),
(73, 3, 8, 1),
(74, 5, 7, 1),
(75, 2, 6, 1),
(76, 4, 6, 1),
(77, 2, 19, 1),
(78, 3, 19, 1),
(79, 4, 19, 1),
(85, 3, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topweek_scorer`
--

CREATE TABLE IF NOT EXISTS `topweek_scorer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `first_day_on_week` date NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `first_day_on_week` (`first_day_on_week`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `topweek_scorer`
--

INSERT INTO `topweek_scorer` (`id`, `uid`, `first_day_on_week`, `points`) VALUES
(1, 17, '2012-10-08', 160),
(2, 18, '2012-10-15', 200),
(3, 18, '2012-10-22', 260),
(4, 18, '2012-10-29', 260),
(5, 18, '2012-11-05', 260),
(6, 18, '2012-11-19', 260);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE IF NOT EXISTS `user_activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stored_type` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `uid`, `content`, `stored_type`, `date_added`) VALUES
(13, 17, 'The New member <span class="listRed">hello2012</span> gets 50 gold coins.', 'newuser', '2012-09-21 14:48:45'),
(14, 18, 'The New member <span class="listRed">jessie07</span> gets 50 gold coins.', 'newuser', '2012-10-01 11:17:21'),
(15, 18, '<span class="listRed">jessie07</span> gets 10 gold coins for reading article <span class="listRed">Beauty Tips - Summer glamorous fluorescent makeup.</span>', 'readarticle', '2012-10-01 11:43:05'),
(16, 17, '<span class="listRed">hello2012</span> gets 10 gold coins for reading article <span class="listRed">ARTICLE WITH CATEGORY AND TAGS.</span>', 'readarticle', '2012-10-01 12:39:46'),
(17, 20, '<span class="listRed">hello2012</span> gets 50 gold coins through friend referral.', 'viafriendemail', '2012-10-01 16:04:42'),
(18, 20, 'The New member <span class="listRed">mark006</span> gets 50 gold coins.', 'newuser', '2012-10-01 16:05:19'),
(19, 20, '<span class="listRed">mark006</span> gets 10 gold coins for reading article <span class="listRed">SAMPLE.</span>', 'readarticle', '2012-10-08 08:56:32'),
(20, 20, '<span class="listRed">mark006</span> gets 10 gold coins for reading article <span class="listRed">Makeup tips - 3 Basic Blush.</span>', 'readarticle', '2012-10-08 08:57:01'),
(21, 23, 'The New member <span class="listRed">ryan2012</span> gets 50 gold coins.', 'newuser', '2012-10-08 13:16:41'),
(22, 24, 'The New member <span class="listRed">newuser2012</span> gets 50 gold coins.', 'newuser', '2012-10-08 13:31:36'),
(25, 26, 'The New member <span class="listRed">testuser01</span> gets 50 gold coins.', 'newuser', '2012-10-08 14:01:46'),
(26, 18, '<span class="listRed">jessie07</span> gets 10 gold coins for reading article <span class="listRed">ANOTHER ARTICLE.</span>', 'readarticle', '2012-10-12 14:29:34'),
(27, 18, '<span class="listRed">jessie07</span> gets 10 gold coins for reading article <span class="listRed">The Korean rookie Yan Hsiu Hong summer beach makeup.</span>', 'readarticle', '2012-10-12 14:30:00'),
(28, 18, '<span class="listRed">jessie07</span> gets 10 gold coins for reading article <span class="listRed">Makeup tips - 3 Basic Blush.</span>', 'readarticle', '2012-10-12 14:30:13'),
(29, 17, '<span class="listRed">hello2012</span> gets 10 gold coins for reading article <span class="listRed">ERNIE.</span>', 'readarticle', '2012-10-12 14:58:23'),
(30, 17, '<span class="listRed">hello2012</span>  阅读了 <span class="listRed">ANOTHER ARTICLE.</span> 文章 获得 <span class="listRed">10 K币</span>', 'readarticle', '2012-10-24 04:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_forgotpassword`
--

CREATE TABLE IF NOT EXISTS `user_forgotpassword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `user_field` text NOT NULL,
  `validation_code` text NOT NULL,
  `current_status` tinyint(4) NOT NULL,
  `generate_newpassword` text NOT NULL,
  `date_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL,
  `aboutme` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` text NOT NULL,
  `gender` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bdate` date NOT NULL,
  `city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `aboutme`, `profile_image`, `gender`, `bdate`, `city`, `phone`) VALUES
(1, 'none', '', 'male', '0000-00-00', 'cebu city', '123'),
(17, '', 'f8a1fc8cc1240aadf5259a95d38c5271b2090525.jpg', 'female', '1995-09-15', '', '123-4567'),
(18, '', '', 'male', '1995-09-18', '', '269-7250'),
(20, '', 'a207eea1f1704ccfdc200c426eaa7a37a0ccbc4a.jpg', 'male', '1998-09-19', '', ''),
(21, 'programmer', '', 'male', '2012-10-01', 'cebu city', '112-6645'),
(22, 'simple', '', 'male', '0000-00-00', 'manila', '456-7123'),
(23, 'I am simple and great!', '8fe0275335face1f92b235ffe27269832c26a7cf.jpg', 'male', '1975-06-17', 'Cebu', '269-7250'),
(24, '', '', 'male', '1997-10-19', '', '269-7250'),
(26, '', '', 'male', '2000-09-16', '', '556-3123');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `datetime_login` datetime NOT NULL,
  `ip_address` varchar(120) NOT NULL,
  `points_log` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `uid`, `datetime_login`, `ip_address`, `points_log`) VALUES
(1, 20, '2012-10-02 11:46:52', '::1', 10),
(2, 18, '2012-10-02 12:01:22', '::1', 10),
(3, 17, '2012-10-04 08:54:38', '::1', 10),
(8, 20, '2012-10-05 14:40:46', '::1', 10),
(9, 18, '2012-10-05 14:53:12', '::1', 10),
(10, 20, '2012-10-08 08:54:36', '::1', 10),
(11, 23, '2012-10-08 13:16:50', '::1', 10),
(12, 24, '2012-10-08 13:31:47', '::1', 10),
(13, 17, '2012-10-11 16:48:38', '::1', 10),
(14, 17, '2012-10-12 10:30:56', '::1', 10),
(15, 26, '2012-10-12 11:56:47', '::1', 10),
(16, 23, '2012-10-12 11:57:21', '::1', 10),
(17, 18, '2012-10-12 14:29:16', '::1', 10),
(18, 24, '2012-10-12 14:54:11', '::1', 10),
(19, 20, '2012-10-12 14:55:46', '::1', 10),
(20, 20, '2012-10-15 13:22:28', '::1', 10),
(21, 18, '2012-10-15 13:24:52', '::1', 10),
(25, 18, '2012-10-16 16:24:56', '::1', 10),
(26, 23, '2012-10-23 23:20:45', '::1', 10),
(27, 20, '2012-10-23 23:57:54', '::1', 10),
(28, 20, '2012-10-24 00:01:03', '::1', 10),
(29, 17, '2012-10-24 04:15:50', '::1', 10),
(30, 20, '2012-10-25 22:41:00', '::1', 10),
(31, 23, '2012-10-30 10:58:07', '::1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL,
  `user_type` tinyint(4) NOT NULL,
  `status_code` text NOT NULL,
  `status_link` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `email`, `username`, `password`, `join_date`, `user_type`, `status_code`, `status_link`) VALUES
(1, 'admin@kosmeyin.com', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2012-09-11 11:51:49', 2, '', 0),
(17, 'hello@localhost.com', 'hello2012', '6adfb183a4a2c94a2f92dab5ade762a47889a5a1', '2012-09-21 14:48:12', 1, '0c192e862d788929b1588946f1b1bd5300ec023b-a12e462de3d6c25dcc1e9e0bd430a06e43576414-02accd046b57a80566a30fa31bd983838ec71b47', 1),
(18, 'jessie@localhost.com', 'jessie07', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2012-10-01 11:16:49', 1, '37f68cdbc3bc7b3e6490245a41ea9ec40b94257f-814c01d9e7801f45bed6076ec7685a70bfc41ffe-8725540bf8e000f509e6d8c7712e9221b7484eb8', 1),
(20, 'mark@localhost.com', 'mark2012', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2012-10-01 16:04:42', 1, 'ff3524c6ddd6f4e6a93b6480c924d3b42747c544-774fe6a7ff10709b8d98495f240c2d016a427571-7f2759843631b08dd679fdb706a3edfe4e5fee27', 1),
(21, 'jc07.programmer@gmail.com', 'jlabadan', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2012-10-08 13:08:44', 1, 'df77b1752e804fac085f02daf644277d5f3a5420-367dea7ac60f9f9952bbce85cd090f46c267a125-df1831a5a6ca16fd58c387ce4fcc602a95e401c2', 0),
(22, 'jc07_guitarist@yahoo.com', 'jess2012', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2012-10-08 13:10:39', 1, '9a91258874f90636c136d43903df750c1534ad15-0054b11c816c811172c5568be4d4513c4880f08c-1a30e59ec8ffb3e5c126beef1c126b1704d83bbc', 0),
(23, 'ryan@localhost.com', 'ryan2012', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2012-10-08 13:14:37', 1, 'bb107756cc0116dec8a7f491e057406086bfccca-5bdc2f806ac562541751aee4d1d750af932bbc5a-3b3d46cd3ab05dd0bff4c9f29334561f35bdd9d9', 1),
(24, 'newuser@localhost.com', 'newuser2012', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2012-10-08 13:31:24', 1, '138a5efcb8c7bcdde667d7eec8e31bf5fb397e85-2ccb6e3e5d151e38b0bb415e97aaaba33533cd7c-f1de09fc5e39e9715c91e6b00bee2d705c9faf1a', 1),
(26, 'testuser@localhost.com', 'testuser01', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2012-10-08 13:57:36', 1, 'c669cf78dc879c668a0e248fc2bd7589d33a97f0-279585f737732cf50f6d993cbe6f8a5b84244197-1e24ba59bb705922353c3c79ece381e67f471877', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_read_articles`
--

CREATE TABLE IF NOT EXISTS `user_read_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `points` bigint(20) NOT NULL,
  `ip_addres` varchar(100) NOT NULL,
  `date_read` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user_read_articles`
--

INSERT INTO `user_read_articles` (`id`, `uid`, `article_id`, `points`, `ip_addres`, `date_read`) VALUES
(1, 18, 8, 10, '::1', '2012-10-01 10:42:22'),
(2, 17, 12, 10, '::1', '2012-10-01 12:39:46'),
(3, 18, 14, 10, '::1', '2012-10-04 13:55:30'),
(4, 18, 13, 10, '::1', '2012-10-04 14:05:40'),
(5, 18, 12, 10, '::1', '2012-10-04 14:05:52'),
(6, 20, 14, 10, '::1', '2012-10-05 11:39:26'),
(7, 20, 8, 10, '::1', '2012-10-05 14:52:29'),
(8, 20, 13, 10, '::1', '2012-10-08 08:56:32'),
(9, 20, 7, 10, '::1', '2012-10-08 08:57:01'),
(10, 18, 16, 10, '::1', '2012-10-12 14:29:34'),
(11, 18, 6, 10, '::1', '2012-10-12 14:30:00'),
(12, 18, 7, 10, '::1', '2012-10-12 14:30:13'),
(13, 17, 14, 10, '::1', '2012-10-12 14:58:23'),
(14, 17, 16, 10, '::1', '2012-10-24 04:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_survey`
--

CREATE TABLE IF NOT EXISTS `user_survey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `s_answer` varchar(255) NOT NULL,
  `s_points` int(11) NOT NULL,
  `s_dateanswered` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `widgets`
--

CREATE TABLE IF NOT EXISTS `widgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `widget_name` varchar(150) NOT NULL,
  `widget_image` text NOT NULL,
  `widget_type` varchar(50) NOT NULL,
  `widget_function` varchar(100) NOT NULL,
  `widget_status` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `widgets`
--

INSERT INTO `widgets` (`id`, `uid`, `widget_name`, `widget_image`, `widget_type`, `widget_function`, `widget_status`, `date_added`) VALUES
(1, 1, 'Latest Articles', 'wid_article.png', 'latest-article-widget', '$this->latestArticle();', 1, '2012-09-21 09:39:27'),
(2, 1, 'Featured Brands', 'wid_featuredbrand.png', 'featured-brand-widget', '$this->featuredBrand();', 1, '2012-09-21 10:51:23'),
(3, 1, 'Activity', 'wid_activity.png', 'activity-widget', '$this->currentActivity();', 1, '2012-09-21 09:36:28'),
(4, 1, 'Game Center', 'wid_gamecenter.png', 'game-center-widget', '$this->gameCenter();', 1, '2012-09-21 10:35:22'),
(5, 1, 'Invite and Share', 'wid_inviteshare.png', 'invite-and-share', '$this->inviteShare(); ', 1, '2012-09-26 14:52:30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
