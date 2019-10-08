-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2013 at 01:37 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sh_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) DEFAULT NULL,
  `cat_des` text,
  `cat_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cat_user_id` int(11) DEFAULT NULL,
  `cat_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`cat_id`, `cat_name`, `cat_des`, `cat_date_create`, `cat_user_id`, `cat_status`) VALUES
(56, 'PHP', '', '2013-06-29 15:35:19', 1, 1),
(57, 'HTML', 'Hiper Tage Menuculationg Language', '2013-06-29 15:37:00', 1, 1),
(58, 'Javascript', 'Script type', '2013-06-29 15:37:33', 1, 1),
(68, 'HTML4', '', '2013-07-03 16:39:35', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_counter`
--

CREATE TABLE IF NOT EXISTS `tbl_counter` (
  `coun_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coun_today` int(10) unsigned DEFAULT NULL,
  `coun_yesterday` tinyint(3) unsigned DEFAULT NULL,
  `hite_today` int(10) unsigned DEFAULT NULL,
  `hite_yesterday` int(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`coun_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_counter`
--

INSERT INTO `tbl_counter` (`coun_id`, `coun_today`, `coun_yesterday`, `hite_today`, `hite_yesterday`) VALUES
(1, 2, 3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE IF NOT EXISTS `tbl_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_text` text,
  `post_que_id` int(11) DEFAULT NULL,
  `post_user_id` int(11) DEFAULT NULL,
  `email_reply` varchar(40) DEFAULT NULL,
  `post_status` int(11) DEFAULT NULL,
  `post_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`post_id`, `post_text`, `post_que_id`, `post_user_id`, `email_reply`, `post_status`, `post_create_date`) VALUES
(57, 'Oh, it is not difficult that you just know clear about HTML simple because it just adds new property and some attribute.', 1, 1, 'admin@gmail.com', 1, '2013-08-01 16:30:20'),
(62, 'hi, just learn at bachelor degree you will know clearly ', 2, 2, 'sarat.chan@gmail.com', 1, '2013-08-01 16:32:25'),
(69, '', 3, 2, '', 1, '2013-08-17 14:36:58'),
(68, 'The first you should learn html and css.', 1, 2, 'keang.ung@gmail.com', 1, '2013-08-02 11:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE IF NOT EXISTS `tbl_questions` (
  `que_id` int(11) NOT NULL AUTO_INCREMENT,
  `que_text` text,
  `que_top_id` int(11) DEFAULT NULL,
  `que_user_id` int(11) DEFAULT NULL,
  `que_status` int(11) DEFAULT NULL,
  `que_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`que_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_questions`
--

INSERT INTO `tbl_questions` (`que_id`, `que_text`, `que_top_id`, `que_user_id`, `que_status`, `que_create_date`) VALUES
(1, 'How do i  learn html5 fastest ?', 9, 4, 1, '2013-08-01 16:18:03'),
(2, 'What does J2ee mean? \r\nit different from another language. \r\nwhat can it do or work for what?', 6, 1, 1, '2013-08-01 16:38:24'),
(3, 'How PHP connect to database?', 16, 7, 1, '2013-08-02 13:09:04'),
(4, 'What is HTML5?', 9, 9, 1, '2013-08-02 13:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag`
--

CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) DEFAULT NULL,
  `tag_status` tinyint(3) unsigned DEFAULT NULL,
  `tag_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_tag`
--

INSERT INTO `tbl_tag` (`tag_id`, `tag_name`, `tag_status`, `tag_create`) VALUES
(3, 'General', 1, '2013-06-30 10:17:13'),
(4, 'Public', 1, '2013-06-30 12:20:03'),
(5, 'Important', 1, '2013-06-30 10:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topics`
--

CREATE TABLE IF NOT EXISTS `tbl_topics` (
  `top_id` int(11) NOT NULL AUTO_INCREMENT,
  `top_name` varchar(200) DEFAULT NULL,
  `top_des` text,
  `top_tag` int(100) DEFAULT NULL,
  `top_cat_id` int(11) DEFAULT NULL,
  `top_user_id` int(11) DEFAULT NULL,
  `top_status` int(11) DEFAULT NULL,
  `top_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`top_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_topics`
--

INSERT INTO `tbl_topics` (`top_id`, `top_name`, `top_des`, `top_tag`, `top_cat_id`, `top_user_id`, `top_status`, `top_created`) VALUES
(6, 'J2ee', '', 3, 58, 1, 1, '2013-06-30 12:13:03'),
(9, 'HTML5', 'we have time for learn php and html5', 4, 68, 1, 1, '2013-07-25 15:48:54'),
(16, 'First learner PHP', 'how to learn php for first learner', 4, 56, 4, 1, '2013-07-25 16:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_fname` varchar(50) DEFAULT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `user_password` varchar(200) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_username`, `user_email`, `user_fname`, `user_lname`, `user_password`, `user_role`, `image`, `user_status`) VALUES
(1, 'keang', 'keang.ung@gmail.com', 'keang', 'ung', 'c4ca4238a0b923820dcc509a6f75849b', 1, '3.jpg', 1),
(2, '', '', 'keang', 'ung', '', 0, 'user_v.jpg', 1),
(3, 'a', 'aa@gmail.com', 'a', 'a', 'c4ca4238a0b923820dcc509a6f75849b', 0, '', 1),
(4, 'veasa', 'veasa@gmail.com', 'koung', 'veasa', '6512bd43d9caa6e02c990b0a82652dca', 1, '2.jpg', 1),
(5, 'chan lackand', 'chan.lack@gmail.com', 'lack', 'chan', '', 0, 'product_12.jpg', 0),
(6, 'keang', 'keang@gmail.com', 'keang', 'ung', 'd41d8cd98f00b204e9800998ecf8427e', 0, '1.jpg', 1),
(7, 'sangha.eak', 'sangha.eak@gmail.com', 'Sangha', 'Eak', 'd41d8cd98f00b204e9800998ecf8427e', 0, '001.jpg', 1),
(8, 'dara', 'dara@gmail.com', 'dara', 'thy', 'e5606dfd4d68db8b3d696d0b715892de', 0, 'img.jpg', 0),
(9, 'srey', 'srey@gmail.com', 'srey', 'theary', 'c35e90116cdc164aa19bb858cf1eaf86', 0, 'img.jpg', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
