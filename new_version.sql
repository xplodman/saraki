-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2018 at 09:38 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pic`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `fill_date_dimension`(IN startdate DATE,IN stopdate DATE)
BEGIN
    DECLARE currentdate DATE;
    SET currentdate = startdate;
    WHILE currentdate < stopdate DO
        INSERT INTO time_dimension VALUES (
                        YEAR(currentdate)*10000+MONTH(currentdate)*100 + DAY(currentdate),
                        currentdate,
                        YEAR(currentdate),
                        MONTH(currentdate),
                        DAY(currentdate),
                        QUARTER(currentdate),
                        WEEKOFYEAR(currentdate),
                        DATE_FORMAT(currentdate,'%W'),
                        DATE_FORMAT(currentdate,'%M'),
                        'f',
                        CASE DAYOFWEEK(currentdate) WHEN 1 THEN 't' WHEN 7 then 't' ELSE 'f' END,
                        NULL);
        SET currentdate = ADDDATE(currentdate,INTERVAL 1 DAY);
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `attendanceid` int(11) NOT NULL DEFAULT '0',
  `checkindate` date NOT NULL DEFAULT '0000-00-00',
  `checkintime` time DEFAULT NULL,
  `checkoutdate` date DEFAULT NULL,
  `checkouttime` time DEFAULT NULL,
  `idusers` int(11) NOT NULL,
  `ip_address` text,
  `ip_address_2` text,
  PRIMARY KEY (`checkindate`,`idusers`),
  KEY `fk_attendance_users1_idx` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `case`
--

CREATE TABLE IF NOT EXISTS `case` (
  `idcase` int(11) NOT NULL DEFAULT '0',
  `casenum` int(11) NOT NULL,
  `caseyear` int(11) NOT NULL,
  `sarki_idsarki` int(11) NOT NULL,
  `casetype2_idcasetype2` int(11) NOT NULL,
  `casetype_idcasetype` int(11) NOT NULL,
  `departs_iddeparts` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  PRIMARY KEY (`casetype_idcasetype`,`departs_iddeparts`,`casenum`,`caseyear`),
  KEY `fk_case_sarki1_idx` (`sarki_idsarki`),
  KEY `fk_case_casetype21_idx` (`casetype2_idcasetype2`),
  KEY `fk_case_casetype1_idx` (`casetype_idcasetype`),
  KEY `fk_case_departs1_idx` (`departs_iddeparts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `caseentry`
--

CREATE TABLE IF NOT EXISTS `caseentry` (
  `idcaseentry` int(11) NOT NULL AUTO_INCREMENT,
  `idusers` int(11) NOT NULL,
  `idcase` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `idpros` int(11) NOT NULL,
  `sarki_idsarki` int(11) NOT NULL,
  PRIMARY KEY (`idcaseentry`,`idusers`,`idpros`),
  KEY `fk_caseentry_users1_idx` (`idusers`),
  KEY `fk_caseentry_pros1_idx` (`idpros`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=491204 ;

-- --------------------------------------------------------

--
-- Table structure for table `casetype`
--

CREATE TABLE IF NOT EXISTS `casetype` (
  `idcasetype` int(11) NOT NULL AUTO_INCREMENT,
  `casetypename` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcasetype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `casetype`
--

INSERT INTO `casetype` (`idcasetype`, `casetypename`) VALUES
(1, 'جنح'),
(2, 'جنح مباني'),
(3, 'جنح إقتصادية'),
(4, 'إداري'),
(5, 'مخالفات'),
(6, 'عوارض'),
(7, 'جنح أمن دولة طوارئ');

-- --------------------------------------------------------

--
-- Table structure for table `casetype2`
--

CREATE TABLE IF NOT EXISTS `casetype2` (
  `idcasetype2` int(11) NOT NULL AUTO_INCREMENT,
  `casetype2name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcasetype2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `casetype2`
--

INSERT INTO `casetype2` (`idcasetype2`, `casetype2name`) VALUES
(1, 'تلبسات'),
(2, 'إيراد محاضر');

-- --------------------------------------------------------

--
-- Stand-in structure for view `countcase`
--
CREATE TABLE IF NOT EXISTS `countcase` (
`countcase` bigint(21)
,`casetypename` varchar(45)
,`departname` varchar(45)
,`caseyear` int(11)
,`iddeparts` int(11)
,`idcasetype` int(11)
,`nickname` varchar(45)
);
-- --------------------------------------------------------

--
-- Table structure for table `deletedsarki`
--

CREATE TABLE IF NOT EXISTS `deletedsarki` (
  `idsarki` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `from` varchar(300) DEFAULT NULL,
  `to` varchar(300) DEFAULT NULL,
  `year` int(6) DEFAULT NULL,
  `casetype_idcasetype` int(11) NOT NULL,
  `casetype2_idcasetype2` int(11) NOT NULL,
  `departs_iddeparts` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  `idusers` int(11) NOT NULL,
  `notes` varchar(140) NOT NULL,
  `deleteddate` datetime NOT NULL,
  PRIMARY KEY (`idsarki`,`casetype_idcasetype`,`casetype2_idcasetype2`,`departs_iddeparts`,`idusers`),
  KEY `fk_sarki_casetype1_idx` (`casetype_idcasetype`),
  KEY `fk_sarki_casetype21_idx` (`casetype2_idcasetype2`),
  KEY `fk_sarki_departs1_idx` (`departs_iddeparts`),
  KEY `fk_sarki_users1_idx` (`idusers`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18734 ;

-- --------------------------------------------------------

--
-- Table structure for table `departs`
--

CREATE TABLE IF NOT EXISTS `departs` (
  `iddeparts` int(11) NOT NULL AUTO_INCREMENT,
  `departname` varchar(45) DEFAULT NULL,
  `pros_idpros` int(11) NOT NULL,
  PRIMARY KEY (`iddeparts`,`pros_idpros`),
  KEY `fk_departs_pros1_idx` (`pros_idpros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `overallpros`
--

CREATE TABLE IF NOT EXISTS `overallpros` (
  `overallprosid` int(11) NOT NULL AUTO_INCREMENT,
  `overallprosname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`overallprosid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pros`
--

CREATE TABLE IF NOT EXISTS `pros` (
  `idpros` int(11) NOT NULL AUTO_INCREMENT,
  `prosname` varchar(45) DEFAULT NULL,
  `overallprosid` int(11) NOT NULL,
  PRIMARY KEY (`idpros`,`overallprosid`),
  KEY `fk_pros_overallpros1_idx` (`overallprosid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pros_has_users`
--

CREATE TABLE IF NOT EXISTS `pros_has_users` (
  `idpros` int(11) NOT NULL,
  `idusers` int(11) NOT NULL,
  PRIMARY KEY (`idpros`,`idusers`),
  KEY `fk_pros_has_users_users1_idx` (`idusers`),
  KEY `fk_pros_has_users_pros1_idx` (`idpros`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sarki`
--

CREATE TABLE IF NOT EXISTS `sarki` (
  `idsarki` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `from` varchar(300) DEFAULT NULL,
  `to` varchar(300) DEFAULT NULL,
  `year` int(6) DEFAULT NULL,
  `casetype_idcasetype` int(11) NOT NULL,
  `casetype2_idcasetype2` int(11) NOT NULL,
  `departs_iddeparts` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  `updatedate` datetime DEFAULT NULL,
  `idusers` int(11) NOT NULL,
  `notes` varchar(140) NOT NULL,
  PRIMARY KEY (`idsarki`,`casetype_idcasetype`,`casetype2_idcasetype2`,`departs_iddeparts`,`idusers`),
  KEY `fk_sarki_casetype1_idx` (`casetype_idcasetype`),
  KEY `fk_sarki_casetype21_idx` (`casetype2_idcasetype2`),
  KEY `fk_sarki_departs1_idx` (`departs_iddeparts`),
  KEY `fk_sarki_users1_idx` (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `time_dimension`
--

CREATE TABLE IF NOT EXISTS `time_dimension` (
  `id` int(11) NOT NULL,
  `db_date` date NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `day_name` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `month_name` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `holiday_flag` char(1) COLLATE utf8_unicode_ci DEFAULT 'f',
  `weekend_flag` char(1) COLLATE utf8_unicode_ci DEFAULT 'f',
  `event` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `td_ymd_idx` (`year`,`month`,`day`),
  UNIQUE KEY `td_dbdate_idx` (`db_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `nickname` varchar(45) DEFAULT NULL,
  `securitylvl` varchar(4) NOT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `username`, `password`, `nickname`, `securitylvl`) VALUES
(1, '123', '1322', 'Administrator', 'a');

-- --------------------------------------------------------

--
-- Structure for view `countcase`
--
DROP TABLE IF EXISTS `countcase`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `countcase` AS select count(`case`.`departs_iddeparts`) AS `countcase`,`casetype`.`casetypename` AS `casetypename`,`departs`.`departname` AS `departname`,`case`.`caseyear` AS `caseyear`,`departs`.`iddeparts` AS `iddeparts`,`casetype`.`idcasetype` AS `idcasetype`,`users`.`nickname` AS `nickname` from ((((`case` join `casetype` on((`case`.`casetype_idcasetype` = `casetype`.`idcasetype`))) join `departs` on((`departs`.`iddeparts` = `case`.`departs_iddeparts`))) join `sarki` on((`sarki`.`idsarki` = `case`.`sarki_idsarki`))) join `users` on((`sarki`.`idusers` = `users`.`idusers`))) group by `casetype`.`casetypename`,`departs`.`departname`,`case`.`caseyear`,`departs`.`iddeparts`,`casetype`.`idcasetype`,`users`.`nickname` order by `case`.`caseyear` desc,`departs`.`iddeparts`,`casetype`.`idcasetype`,`users`.`nickname`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_users1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `case`
--
ALTER TABLE `case`
  ADD CONSTRAINT `fk_case_casetype1` FOREIGN KEY (`casetype_idcasetype`) REFERENCES `casetype` (`idcasetype`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_case_casetype21` FOREIGN KEY (`casetype2_idcasetype2`) REFERENCES `casetype2` (`idcasetype2`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_case_departs1` FOREIGN KEY (`departs_iddeparts`) REFERENCES `departs` (`iddeparts`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_case_sarki1` FOREIGN KEY (`sarki_idsarki`) REFERENCES `sarki` (`idsarki`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `caseentry`
--
ALTER TABLE `caseentry`
  ADD CONSTRAINT `fk_caseentry_pros1` FOREIGN KEY (`idpros`) REFERENCES `pros` (`idpros`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_caseentry_users1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `departs`
--
ALTER TABLE `departs`
  ADD CONSTRAINT `fk_departs_pros1` FOREIGN KEY (`pros_idpros`) REFERENCES `pros` (`idpros`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pros`
--
ALTER TABLE `pros`
  ADD CONSTRAINT `fk_overallprosid` FOREIGN KEY (`overallprosid`) REFERENCES `overallpros` (`overallprosid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pros_has_users`
--
ALTER TABLE `pros_has_users`
  ADD CONSTRAINT `fk_pros_has_users_pros1` FOREIGN KEY (`idpros`) REFERENCES `pros` (`idpros`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pros_has_users_users1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON UPDATE CASCADE;

--
-- Constraints for table `sarki`
--
ALTER TABLE `sarki`
  ADD CONSTRAINT `fk_sarki_casetype1` FOREIGN KEY (`casetype_idcasetype`) REFERENCES `casetype` (`idcasetype`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sarki_casetype21` FOREIGN KEY (`casetype2_idcasetype2`) REFERENCES `casetype2` (`idcasetype2`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sarki_departs1` FOREIGN KEY (`departs_iddeparts`) REFERENCES `departs` (`iddeparts`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sarki_users1` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
