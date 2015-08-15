
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountId`, `UserName`, `Email`, `Password`, `AccountType`) VALUES
(1, 'bot', 'bot@bot.com', 'bot', 'bot');

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
  `login_url` text NOT NULL,
  `login_data` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`home_url`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `job_xpath`
--

INSERT INTO `job_xpath` (`home_url`, `base_url`, `xpath_code`, `job_xpath`, `company_xpath`, `location_xpath`, `description_xpath`, `salary_xpath`, `requirement_xpath`, `benifit_xpath`, `expired_xpath`, `tags_xpath`, `login_url`, `login_data`, `id`) VALUES
('http://www.vietnamworks.com/it-hardware-networking-it-software-jobs-i55,35-en/page-', '', '//*[@id="job-list"]/div[1]/table/tbody/tr/td/div/div[1]/div[2]/div[1]/a', '//*[@id="section-job-detail"]/div[3]/div/div[2]/div[2]/div[1]/div[1]/div/div/h1', '//*[@id="section-job-detail"]/div[3]/div/div[2]/div[2]/div[1]/div[1]/div/div/span[1]/strong', '//*[@id="section-job-detail"]/div[3]/div/div[2]/div[2]/div[1]/div[1]/div/div/span[2]', '//*[@id="job-description"]', '//*[@id="section-job-detail"]/div[3]/div/div[2]/div[2]/div[2]/div[1]/div/span', '//*[@id="job-requirement"]/div/div', '//*[@id="what-we-offer"]/div/div[2]/div', '', '//*[@id="job-detail"]/div[1]/div', 'http://www.vietnamworks.com/login/?redirectURL=http%3A%2F%2Fwww.vietnamworks.com%2Fit-hardware-networking-it-software-jobs-i55%2C35-en%2F', 'form%5Busername%5D=anhtuyenpro94%40gmail.com&form%5Bpassword%5D=anhtuyenpro_at&form%5Bsign_in%5D=', 1),
('https://itviec.com/?page=', 'https://itviec.com', '/div[class="first-group"]/div[class="job"]/div/div[2]/div[1]/a', '//*[@id]/div[2]/div/div[3]/div[1]/div/h1', '//*[@id]/div[2]/div/div[2]/div[1]/h3', '//*[@id="job-details-mobile"]/div[3]/div/div[1]', '//*[@id]/div[6]/div/div', '//*[@id]/div[3]/div/div[2]/span[2]', '//*[@id]/div[7]/div/div', '//*[@id]/div[8]/div/div[1]', '//*[@id]/div[2]/div/div[3]/div[1]/div/div[5]', '//*[@id]/div[3]/div/div[3]/div', '', '', 2),
('https://www.careerlink.vn/vieclam/tim-kiem-viec-lam?sid=34134145&token=LjKUHJM0&page=', 'https://www.careerlink.vn', '//*[@id="save-job-form"]/div/div/h2/a', '/html/body/div[2]/div[1]/h1', '/html/body/div[2]/div[2]/div[1]/div/ul[1]/li[1]/a', '/html/body/div[2]/div[2]/div[1]/div/ul[1]/li[2]', '/html/body/div[2]/div[2]/div[1]/div/ul[2]', '/html/body/div[2]/div[2]/div[1]/div/ul[1]/li[3]', '/html/body/div[2]/div[2]/div[1]/div/div[3]', '', '/html/body/div[2]/div[2]/div[1]/div/dl/dd[2]', '/html/body/div[2]/div[2]/div[1]/div/p', '', '', 3);

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
