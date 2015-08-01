-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2015 at 07:46 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jobsrec`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `Account_id` int(11) NOT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `Resume_id` int(11) NOT NULL
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
  `Logo` text
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
  `Resume_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `Resume_id` int(11) DEFAULT NULL,
  `Experience_id` int(11) NOT NULL,
  `Company_name` text,
  `Position` text,
  `Description` text,
  `Period` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `Job_id` int(11) NOT NULL,
  `Job_title` text CHARACTER SET latin1,
  `Location` text CHARACTER SET latin1,
  `Salary` text CHARACTER SET latin1,
  `Description` text CHARACTER SET latin1,
  `Tag` text CHARACTER SET latin1,
  `Company_name` text NOT NULL,
  `Company_sumary_id` int(11) DEFAULT NULL,
  `Requirement` text CHARACTER SET latin1,
  `Benifit` text CHARACTER SET latin1,
  `Expired` text,
  `Source` varchar(200) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4411 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job_xpath`
--

CREATE TABLE IF NOT EXISTS `job_xpath` (
  `home_url` varchar(200) NOT NULL,
  `base_url` text,
  `xpath_code` text,
  `job_xpath` text,
  `company_xpath` text,
  `location_xpath` text,
  `description_xpath` text,
  `salary_xpath` text,
  `requirement_xpath` text,
  `benifit_xpath` text,
  `expired_xpath` text,
  `tags_xpath` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `Hobby` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE IF NOT EXISTS `resume` (
  `Profile_id` int(11) DEFAULT NULL,
  `Account_id` int(11) DEFAULT NULL,
  `Experience_id` int(11) DEFAULT NULL,
  `Resume_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Account_id`), ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `career_objective`
--
ALTER TABLE `career_objective`
  ADD PRIMARY KEY (`Resume_id`);

--
-- Indexes for table `company_sumary`
--
ALTER TABLE `company_sumary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`Education_id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`Experience_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`Job_id`), ADD UNIQUE KEY `Source` (`Source`);

--
-- Indexes for table `job_xpath`
--
ALTER TABLE `job_xpath`
  ADD PRIMARY KEY (`home_url`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`Profile_id`);

--
-- Indexes for table `resume`
--
ALTER TABLE `resume`
  ADD PRIMARY KEY (`Resume_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `Account_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `Experience_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `Job_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4411;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
