-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2014 at 06:59 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cdemos_retweet`
--

-- --------------------------------------------------------

--
-- Table structure for table `re_auto`
--

CREATE TABLE IF NOT EXISTS `re_auto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `twitter_account` varchar(255) NOT NULL,
  `type` varchar(5) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `counts` int(11) NOT NULL,
  `forT` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `re_auto`
--

-- --------------------------------------------------------

--
-- Table structure for table `re_log`
--

CREATE TABLE IF NOT EXISTS `re_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweetID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `re_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `re_options`
--

CREATE TABLE IF NOT EXISTS `re_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL,
  `option_value` text NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `re_options`
--

INSERT INTO `re_options` (`id`, `option_name`, `option_value`, `admin_id`) VALUES
(1, 'settings', 'a:2:{s:14:"accountsPaging";s:2:"20";s:13:"retweetPaging";s:2:"20";}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `re_temp`
--

CREATE TABLE IF NOT EXISTS `re_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweetID` varchar(255) NOT NULL,
  `counts` int(11) NOT NULL,
  `type` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `re_tweets`
--

CREATE TABLE IF NOT EXISTS `re_tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `tweet` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `loop` tinyint(1) NOT NULL,
  `interval` int(50) NOT NULL,
  `last_access` datetime NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `re_users`
--

CREATE TABLE IF NOT EXISTS `re_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `oauth_uid` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `oauth_provider` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_oauth_token` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_oauth_token_secret` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `accessToken` varchar(200) CHARACTER SET utf8 NOT NULL,
  `accessTokenSecret` varchar(200) CHARACTER SET utf8 NOT NULL,
  `screen_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `re_users`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
