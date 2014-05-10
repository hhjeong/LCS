-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2014 at 03:16 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS `__tb_prefix___account` (
  `id` varchar(8) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `perm` varchar(8) NOT NULL,
  `nmember` int(11) NOT NULL,
  `extra` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `__tb_prefix___account` (`id`, `password`, `name`, `perm`, `nmember`, `extra`) VALUES
('admin', 'admin', 'Administrator', 'admin', 0, 0),
('team0', 'team0', 'team0', '', 3, 1);

CREATE TABLE IF NOT EXISTS `__tb_prefix___clar` (
  `clar_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` varchar(8) NOT NULL,
  `category` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `response` text NOT NULL,
  `public` tinyint(1) NOT NULL,
  PRIMARY KEY (`clar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `__tb_prefix___login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` varchar(8) NOT NULL,
  `success` tinyint(1) NOT NULL,
  `IP` varchar(32) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

CREATE TABLE IF NOT EXISTS `__tb_prefix___problemset` (
  `pid` varchar(8) NOT NULL,
  `score` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `differ` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `__tb_prefix___problemset` (`pid`, `score`, `title`, `differ`, `answer`) VALUES
('A1', 1, '정리 못하는 정리베', 'default', 'output/A1.txt'),
('A2', 2, '정리 못하는 정리베', 'default', 'output/A2.txt'),
('B1', 1, '퀴즈 퀴즈!', 'quiz', 'bootstrapping'),
('B2', 2, '퀴즈 퀴즈!', 'quiz', 'pda');

CREATE TABLE IF NOT EXISTS `__tb_prefix___status` (
  `run_id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` varchar(8) NOT NULL,
  `pid` varchar(8) NOT NULL,
  `result` varchar(8) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(64) NOT NULL,
  `output` varchar(255) NOT NULL,
  `solution` varchar(255) NOT NULL,
  PRIMARY KEY (`run_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
