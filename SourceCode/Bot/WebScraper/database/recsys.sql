-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2015 at 10:29 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `recsys`
--
CREATE DATABASE IF NOT EXISTS `recsys` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `recsys`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `AccountId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) DEFAULT NULL,
  `Email` text,
  `Password` text,
  `AccountType` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`AccountId`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `career_objective`
--

CREATE TABLE IF NOT EXISTS `career_objective` (
  `ObjectiveId` int(11) NOT NULL AUTO_INCREMENT,
  `ResumeId` int(11) DEFAULT NULL,
  `Position` text,
  `DesireSalary` int(11) DEFAULT NULL,
  `RecentSalary` int(11) DEFAULT NULL,
  `DesireLocation` text,
  `WillingToRelocate` blob,
  `WillingToTravel` blob,
  `CareerObjective` text,
  PRIMARY KEY (`ObjectiveId`),
  KEY `t1` (`ResumeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `company_sumary`
--

CREATE TABLE IF NOT EXISTS `company_sumary` (
  `CompanyId` int(11) NOT NULL AUTO_INCREMENT,
  `AccountId` int(11) DEFAULT NULL,
  `CompanyName` text,
  `CompanyDescription` text,
  `Email` text,
  `Phone` char(15) DEFAULT NULL,
  `Fax` char(20) DEFAULT NULL,
  `Address` text,
  `Website` char(50) DEFAULT NULL,
  `Logo` text,
  PRIMARY KEY (`CompanyId`),
  KEY `t2` (`AccountId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE IF NOT EXISTS `degree` (
  `DegreeId` int(11) NOT NULL AUTO_INCREMENT,
  `ResumeId` int(11) NOT NULL,
  `Level` text,
  `School` text,
  `Expertise` text,
  `SchoolYear` text,
  PRIMARY KEY (`DegreeId`),
  KEY `t3` (`ResumeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `ExperienceId` int(11) NOT NULL AUTO_INCREMENT,
  `ResumeId` int(11) NOT NULL,
  `CompanyName` text,
  `Position` text,
  `Description` text,
  `Period` text,
  PRIMARY KEY (`ExperienceId`),
  KEY `t4` (`ResumeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `JobId` int(11) NOT NULL AUTO_INCREMENT,
  `AccountId` int(11) NOT NULL,
  `JobName` text,
  `Location` text,
  `Salary` text,
  `Description` text,
  `Company` text,
  `Tags` text,
  `Requirement` text,
  `Benifit` text,
  `Expired` text,
  `Source` text,
  PRIMARY KEY (`JobId`),
  KEY `t5` (`AccountId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `tags_xpath` text,
  PRIMARY KEY (`home_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

CREATE TABLE IF NOT EXISTS `resume` (
  `ResumeId` int(11) NOT NULL AUTO_INCREMENT,
  `AccountId` int(11) DEFAULT NULL,
  `Name` text,
  `Birthday` datetime DEFAULT NULL,
  `Gender` text,
  `MaritalStatus` blob,
  `PlaceOfBirth` text,
  `Hometown` text,
  `Nationality` text,
  `Avatar` text,
  `Address` text,
  `Email` text,
  `Phone` char(15) DEFAULT NULL,
  `Hobby` text,
  PRIMARY KEY (`ResumeId`),
  UNIQUE KEY `AccountId` (`AccountId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `SkillId` int(11) NOT NULL AUTO_INCREMENT,
  `ResumeId` int(11) NOT NULL,
  `SkillName` text,
  `Description` text,
  PRIMARY KEY (`SkillId`),
  KEY `t7` (`ResumeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `career_objective`
--
ALTER TABLE `career_objective`
  ADD CONSTRAINT `t1` FOREIGN KEY (`ResumeId`) REFERENCES `resume` (`ResumeId`);

--
-- Constraints for table `company_sumary`
--
ALTER TABLE `company_sumary`
  ADD CONSTRAINT `t2` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`);

--
-- Constraints for table `degree`
--
ALTER TABLE `degree`
  ADD CONSTRAINT `t3` FOREIGN KEY (`ResumeId`) REFERENCES `resume` (`ResumeId`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `t4` FOREIGN KEY (`ResumeId`) REFERENCES `resume` (`ResumeId`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `t5` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`);

--
-- Constraints for table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `t6` FOREIGN KEY (`AccountId`) REFERENCES `account` (`AccountId`);

--
-- Constraints for table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `t7` FOREIGN KEY (`ResumeId`) REFERENCES `resume` (`ResumeId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
