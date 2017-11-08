-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2015 at 12:43 م
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demos_autofollow`
--

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE IF NOT EXISTS `follows` (
  `id` int(11) NOT NULL,
  `account_f` varchar(250) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `f_count` int(11) NOT NULL DEFAULT '10',
  `next_cursor` varchar(255) NOT NULL DEFAULT '0',
  `previous_cursor` varchar(255) NOT NULL DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `unfollow` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `oauth_uid` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `oauth_provider` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_oauth_token` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `twitter_oauth_token_secret` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `accessToken` varchar(200) CHARACTER SET utf8 NOT NULL,
  `accessTokenSecret` varchar(200) CHARACTER SET utf8 NOT NULL,
  `screen_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `friends_count_n` varchar(10) DEFAULT NULL,
  `friends_count` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
