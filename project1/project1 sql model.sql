-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2014 at 08:09 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `libcat`
--

CREATE TABLE IF NOT EXISTS `libcat` (
`id` int(5) NOT NULL,
  `publisher` varchar(56) DEFAULT NULL,
  `title` varchar(159) DEFAULT NULL,
  `doctype` varchar(50) DEFAULT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `url` varchar(104) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3495 ;

--
-- Dumping data for table `libcat`
--

INSERT INTO `libcat` (`id`, `publisher`, `title`, `doctype`, `subject`, `url`) VALUES
(1, 'Taylor & Francis Group', 'Advanced Robotics', 'Journal ', 'UNCATEGORIZED', 'http://www.tandfonline.com');
