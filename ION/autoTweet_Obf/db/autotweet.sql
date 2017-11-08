-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2014 at 04:55 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cdemos_autotweet`
--

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `tweet` varchar(250) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `loop` tinyint(1) NOT NULL,
  `interval` int(50) NOT NULL,
  `last_access` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oauth_uid` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `oauth_provider` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_oauth_token` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_oauth_token_secret` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `accessToken` varchar(200) CHARACTER SET utf8 NOT NULL,
  `accessTokenSecret` varchar(200) CHARACTER SET utf8 NOT NULL,
  `screen_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
