-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2015 at 06:02 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jobsrec`
--
CREATE DATABASE IF NOT EXISTS `jobsrec` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jobsrec`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `Account_id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Account_id`),
  UNIQUE KEY `Username` (`Username`)  
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `career_objective`
--

CREATE TABLE IF NOT EXISTS `career_objective` (
  `Position` text,
  `Desire_Salary` int(11) DEFAULT NULL,
  `Recent_Salary` int(11) DEFAULT NULL,
  `Desire_location` text,
  `Willing_to_relocate` tinyint(1) DEFAULT NULL,
  `Willing_to_travel` tinyint(1) DEFAULT NULL,
  `Career_objective` text,
  `Resume_id` int(11) NOT NULL,
  PRIMARY KEY (`Resume_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_sumary`
--

CREATE TABLE IF NOT EXISTS `company_sumary` (
  `id` int(11) NOT NULL,
  `Account_id` int(11) DEFAULT NULL,
  `Company_name` text,
  `Company_description` text,
  `Email` text,
  `Phone` char(15) DEFAULT NULL,
  `Fax` char(20) DEFAULT NULL,
  `Address` text,
  `Website` char(50) DEFAULT NULL,
  `Logo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `Education_id` int(11) NOT NULL,
  `Level` text,
  `School` text,
  `Expertise` text,
  `School_year` text,
  `Resume_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Education_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `Resume_id` int(11) DEFAULT NULL,
  `Experience_id` int(11) NOT NULL AUTO_INCREMENT,
  `Company_name` text,
  `Position` text,
  `Description` text,
  `Period` text,
  PRIMARY KEY (`Experience_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `Job_id` int(11) NOT NULL AUTO_INCREMENT,
  `Job_title` text,
  `Location` text,
  `Salary` text,
  `Description` text,
  `Tag` text,
  `Company_sumary_id` int(11) DEFAULT NULL,
  `Requirement` text,
  `Benifit` text,
  `Post_date` datetime DEFAULT NULL,
  `Source` text,
  PRIMARY KEY (`Job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `Profile_id` int(11) NOT NULL,
  `Name` text,
  `Date_of_birth` datetime DEFAULT NULL,
  `Gender` text,
  `Marital_status` tinyint(1) DEFAULT NULL,
  `Place_of_birth` text,
  `Hometown` text,
  `Nationality` text,
  `Avatar` text,
  `Address` text,
  `Email` text,
  `Phone` char(15) DEFAULT NULL,
  `Hobby` text,
  PRIMARY KEY (`Profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE IF NOT EXISTS `resume` (
  `Profile_id` int(11) DEFAULT NULL,
  `Account_id` int(11) DEFAULT NULL,
  `Experience_id` int(11) DEFAULT NULL,
  `Resume_id` int(11) NOT NULL,
  PRIMARY KEY (`Resume_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
