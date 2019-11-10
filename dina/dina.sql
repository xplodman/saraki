-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2018 at 10:07 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dina`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(45) NOT NULL,
  `admin_nickname` varchar(45) NOT NULL,
  `admin_password` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_nickname`, `admin_password`, `created_at`, `modified_at`) VALUES
(1, '1', 'admin', '1', '2018-12-13 11:46:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `group_name`, `created_at`, `modified_at`) VALUES
(1, 'Data entry alex', '2018-12-13 13:24:46', NULL),
(2, 'فريق عمل العدالة الجنائيه', '2018-12-13 13:24:46', NULL),
(3, 'العدالة الجنائية اسكندرية', '2018-12-13 13:24:46', NULL),
(4, 'التابعين للجهاز اسكندريه', '2018-12-13 13:24:46', NULL),
(5, 'Admins', '2018-12-13 13:24:46', NULL),
(6, 'asdasd', '2018-12-13 14:55:04', NULL),
(7, 'adfasdfasdf', '2018-12-13 14:55:48', NULL),
(8, 'asdasdasdfsdf', '2018-12-13 14:58:08', NULL),
(9, '', '2018-12-13 14:58:11', NULL),
(10, 'Data Entry', '2018-12-22 09:25:28', NULL),
(11, 'All Alex DE', '2018-12-23 13:04:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_name` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`issue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`issue_id`, `issue_name`, `created_at`, `modified_at`) VALUES
(1, 'بطىء', '2018-12-13 13:26:34', NULL),
(2, 'متوقف', '2018-12-13 13:26:34', NULL),
(3, 'خروج اكونتات', '2018-12-13 13:26:34', NULL),
(4, 'عدم ظهور المرفقات', '2018-12-13 13:26:34', NULL),
(5, 'ADF_FACES_60096', '2018-12-13 13:26:34', NULL),
(6, 'خروج اكونتات الرؤساء', '2018-12-13 13:26:34', NULL),
(7, 'Data table warning ajax error', '2018-12-13 13:26:34', NULL),
(8, 'erro 503 service unavailable', '2018-12-13 13:26:34', NULL),
(9, 'توقف الأسكان', '2018-12-13 13:26:34', NULL),
(10, 'asdklfja;sjdlkfasldfkasdfasdgasdg', '2018-12-13 14:59:57', NULL),
(11, 'عدم ظهور بعض القضايا على السيستم', '2018-12-22 10:39:46', NULL),
(12, 'وجود مشكله فى ارفاق على القضايا', '2018-12-22 10:59:31', NULL),
(13, 'اختفاء بعض القضايا المنشأه سابقا', '2018-12-23 11:49:49', NULL),
(14, 'وقوف اد سيرافيرات الأبليكشين', '2018-12-23 13:37:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pros`
--

CREATE TABLE IF NOT EXISTS `pros` (
  `pros_id` int(11) NOT NULL AUTO_INCREMENT,
  `pros_name` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pros_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `pros`
--

INSERT INTO `pros` (`pros_id`, `pros_name`, `created_at`, `modified_at`) VALUES
(1, 'رمل اول', '2018-12-13 13:27:42', NULL),
(2, 'رمل ثان', '2018-12-13 13:27:42', NULL),
(3, 'منتزه اول', '2018-12-13 13:27:42', NULL),
(4, 'منتزه ثان', '2018-12-13 13:27:42', NULL),
(5, 'منتزه ثالث', '2018-12-13 13:27:42', NULL),
(6, 'باب شرقى', '2018-12-13 13:27:42', NULL),
(7, 'المنشيه', '2018-12-13 13:27:42', NULL),
(8, 'محرم بك', '2018-12-13 13:27:42', NULL),
(9, 'العطارين', '2018-12-13 13:27:42', NULL),
(10, 'ميناء البصل', '2018-12-13 13:27:42', NULL),
(11, 'كرموز', '2018-12-13 13:27:42', NULL),
(12, 'اللبان', '2018-12-13 13:27:42', NULL),
(13, 'الأحداث', '2018-12-13 13:27:42', NULL),
(14, 'الميناء', '2018-12-13 13:27:42', NULL),
(15, 'العامرية اول', '2018-12-13 13:27:42', NULL),
(16, 'العامرية ثان', '2018-12-13 13:27:42', NULL),
(17, 'دخيله', '2018-12-13 13:27:42', NULL),
(18, 'برج العرب', '2018-12-13 13:27:42', NULL),
(19, 'سيدى جابر', '2018-12-13 13:27:42', NULL),
(20, 'السويس', '2018-12-13 13:27:42', NULL),
(21, 'الأسماعيليه', '2018-12-13 13:27:42', NULL),
(22, 'القاهرة الجديدة', '2018-12-13 13:27:42', NULL),
(23, 'asdasdasd', '2018-12-13 14:58:41', NULL),
(24, 'شرق الكليه', '2018-12-22 09:52:42', NULL),
(25, 'الجمرك', '2018-12-22 10:58:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `user_phone_num` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_phone_num`, `created_at`, `modified_at`) VALUES
(1, 'omnia magdy', '01001282672', '2018-12-13 13:49:17', NULL),
(2, 'Esraa Adel Abdelazeem', '01003675538', '2018-12-13 13:49:17', NULL),
(3, 'mohamed gouda', '01006266533', '2018-12-13 13:49:17', NULL),
(4, 'omnia Fathy Aly', '01006841116', '2018-12-13 13:49:17', NULL),
(5, 'Nada Sabry Mahmoud', '01011968189', '2018-12-13 13:49:17', NULL),
(6, 'Marwa mohamed abd elhamid', '01013422055', '2018-12-13 13:49:17', NULL),
(7, 'basama mohamed', '01026607405', '2018-12-13 13:49:17', NULL),
(8, 'Eman shehata', '01030934896', '2018-12-13 13:49:17', NULL),
(9, 'Samer Ibrahim rafaiy', '01063564362', '2018-12-13 13:49:17', NULL),
(10, NULL, '01064931374', '2018-12-13 13:49:17', NULL),
(11, 'Esraa Mohamed Hassan', '01067112143', '2018-12-13 13:49:17', NULL),
(12, 'Mustafa Mohamed Moghazi', '01094303638', '2018-12-13 13:49:17', NULL),
(13, 'Doaa Aly Lotfy', '01097002823', '2018-12-13 13:49:17', NULL),
(14, 'Fathia Mohamed Mahmoud', '01099455963', '2018-12-13 13:49:17', NULL),
(15, 'sara Saber Abdelsalam', '01112670446', '2018-12-13 13:49:17', NULL),
(16, 'mahmoud gaber', '01150745577', '2018-12-13 13:49:17', NULL),
(17, 'Mona aly', '01201404716', '2018-12-13 13:49:17', NULL),
(18, 'marwa elsayed', '01201404929', '2018-12-13 13:49:17', NULL),
(19, 'ahmed sabry', '01202005889', '2018-12-13 13:49:17', NULL),
(20, 'Bassent saeed Ibrahim', '01202780734', '2018-12-13 13:49:17', NULL),
(21, 'khaled Taher hafeny', '01204399233', '2018-12-13 13:49:17', NULL),
(22, 'Bassma hussien ismail', '01205723273', '2018-12-13 13:49:17', NULL),
(23, 'Mohamed Salah Eldin Mohamed', '01205805274', '2018-12-13 13:49:17', NULL),
(24, 'zaynab elkhatteb', '01206181976', '2018-12-13 13:49:17', NULL),
(25, 'sedky mohamed', '01206362519', '2018-12-13 13:49:17', NULL),
(26, 'Zhraa Mustafa Ahmed', '01207282922', '2018-12-13 13:49:17', NULL),
(27, 'mohamed mustafa abdelsalam', '01220422010', '2018-12-13 13:49:17', NULL),
(28, 'Mustafa Ahmed Mohamed', '01221804935', '2018-12-13 13:49:17', NULL),
(29, NULL, '01223058304', '2018-12-13 13:49:17', NULL),
(30, NULL, '01223521073', '2018-12-13 13:49:17', NULL),
(31, 'Nermeen Elsayed Abdelatty', '01224012789', '2018-12-13 13:49:17', NULL),
(32, 'omar Alaa Aly', '01224064431', '2018-12-13 13:49:17', NULL),
(33, 'Maha Fathy Elsaman', '01225895828', '2018-12-13 13:49:17', NULL),
(34, 'mahmoud elmagraby', '01226402960', '2018-12-13 13:49:17', NULL),
(35, 'Mohamed Ibrahim Mohamed Ibrahim', '01226693248', '2018-12-13 13:49:17', NULL),
(36, 'yara Gaber elsayed', '01227054553', '2018-12-13 13:49:17', NULL),
(37, 'Mohamed abdelmongy abelbaai', '01227296214', '2018-12-13 13:49:17', NULL),
(38, 'Marwa Adel Gaber', '01272276460', '2018-12-13 13:49:17', NULL),
(39, 'mahmoud alaa', '01273450877', '2018-12-13 13:49:17', NULL),
(40, 'mohamed abdelrazek', '01275003525', '2018-12-13 13:49:17', NULL),
(41, 'salma mansour', '01276778157', '2018-12-13 13:49:17', NULL),
(42, 'Ahmed Ramaden Mohamed', '01277273224', '2018-12-13 13:49:17', NULL),
(43, 'ahmed alazhary', '01277748683', '2018-12-13 13:49:17', NULL),
(44, 'yasmin Ahmed Mohamed', '01277796459', '2018-12-13 13:49:17', NULL),
(45, 'nada gomaa', '01278560713', '2018-12-13 13:49:17', NULL),
(46, 'heba allah mohamed maslhiy', '01280019336', '2018-12-13 13:49:17', NULL),
(47, 'Randa Mohamed Henady', '01281449009', '2018-12-13 13:49:17', NULL),
(48, NULL, '01282827480', '2018-12-13 13:49:17', NULL),
(49, 'Sara Ibrahim Abbas', '01283280269', '2018-12-13 13:49:17', NULL),
(50, 'Amira Zakria Lotfy', '01285364434', '2018-12-13 13:49:17', NULL),
(51, 'Mirana Gaber Elsayed', '01287220575', '2018-12-13 13:49:17', NULL),
(52, NULL, '01554557480', '2018-12-13 13:49:17', NULL),
(72, 'alaa shaker', '01000542171', '2018-12-13 13:49:17', NULL),
(73, NULL, '01000793862', '2018-12-13 13:49:17', NULL),
(74, 'mohamed ahmed', '01001243982', '2018-12-13 13:49:17', NULL),
(75, 'mohamed gad', '01003918391', '2018-12-13 13:49:17', NULL),
(76, 'hussien nabil', '01007758405', '2018-12-13 13:49:17', NULL),
(77, 'hossam elkhassef', '01022575722', '2018-12-13 13:49:17', NULL),
(78, NULL, '01114420104', '2018-12-13 13:49:17', NULL),
(79, NULL, '01141406007', '2018-12-13 13:49:17', NULL),
(80, 'ahmed yahia', '01202020850', '2018-12-13 13:49:17', NULL),
(81, 'belal salma', '01228484885', '2018-12-13 13:49:17', NULL),
(83, 'samar Tark', '01023795772', '2018-12-13 13:49:17', NULL),
(84, 'Sara Mahmoud Gomaa', '01064750978', '2018-12-13 13:49:17', NULL),
(85, 'Marwa Ahmed Fouad', '01003037734', '2018-12-13 13:49:17', NULL),
(86, 'Marwa Nabil elsayed', '01010942095', '2018-12-13 13:49:17', NULL),
(87, 'Ahmed Gamel Hafez', '01016170415', '2018-12-13 13:49:17', NULL),
(88, 'Dina Mohamed Aly omar', '01111874154', '2018-12-13 13:49:17', NULL),
(89, 'Esraa Mousad mohamed', '01112769569', '2018-12-13 13:49:17', NULL),
(90, 'mohamed Tarek Mohamed gamel', '01127932480', '2018-12-13 13:49:17', NULL),
(91, 'Somia mohamed osama', '01154435921', '2018-12-13 13:49:17', NULL),
(92, 'Hazem yehia saad', '01155583316', '2018-12-13 13:49:17', NULL),
(94, 'mohamed ali', '01200057838', '2018-12-13 13:49:17', NULL),
(95, 'dalia said', '01201063922', '2018-12-13 13:49:17', NULL),
(96, 'Amr Taha Hanafy', '01210859994', '2018-12-13 13:49:17', NULL),
(97, 'Khaled elsayed shehata', '01212413554', '2018-12-13 13:49:17', NULL),
(98, 'Mohamed abd elgawad aly', '01212451424', '2018-12-13 13:49:17', NULL),
(99, 'tyson', '01223633073', '2018-12-13 13:49:17', NULL),
(100, 'sally Abdelhalim Mohamed', '01225206711', '2018-12-13 13:49:17', NULL),
(101, 'Rania Abdelgaleel Ahmed', '01271023087', '2018-12-13 13:49:17', NULL),
(102, 'Pasent saad', '01272811815', '2018-12-13 13:49:17', NULL),
(103, 'karim mohamed', '01274781249', '2018-12-13 13:49:17', NULL),
(104, 'sara mahmoud', '01276545096', '2018-12-13 13:49:17', NULL),
(105, 'shaimaa gaser', '01285812953', '2018-12-13 13:49:17', NULL),
(106, 'eslam rabee youssef', '01286813641', '2018-12-13 13:49:17', NULL),
(107, 'Bassent saad zagloul', '01288696679', '2018-12-13 13:49:17', NULL),
(108, 'mohamed wagdy', '01289810827', '2018-12-13 13:49:17', NULL),
(109, 'jklhlkjhkljhlkjh', 'jklhlkjhljkh', '2018-12-13 15:03:57', NULL),
(110, 'Samer Mohamed Tarek', '01023795772', '2018-12-23 12:04:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_issue_in_group_at_pros`
--

CREATE TABLE IF NOT EXISTS `user_has_issue_in_group_at_pros` (
  `user_user_id` int(11) NOT NULL,
  `issue_issue_id` int(11) NOT NULL,
  `pros_pros_id` int(11) NOT NULL,
  `group_group_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  KEY `fk_user_has_issue_issue1_idx` (`issue_issue_id`),
  KEY `fk_user_has_issue_user1_idx` (`user_user_id`),
  KEY `fk_user_has_issue_in_group_at_pros_pros1_idx` (`pros_pros_id`),
  KEY `fk_user_has_issue_in_group_at_pros_group1_idx` (`group_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_has_issue_in_group_at_pros`
--

INSERT INTO `user_has_issue_in_group_at_pros` (`user_user_id`, `issue_issue_id`, `pros_pros_id`, `group_group_id`, `date`) VALUES
(1, 1, 18, 1, '2018-12-05'),
(1, 3, 18, 1, '2018-12-02'),
(9, 12, 25, 1, '2018-12-02'),
(11, 3, 2, 1, '2018-12-09'),
(17, 9, 15, 1, '2018-12-02'),
(18, 2, 11, 1, '2018-12-05'),
(25, 1, 15, 1, '2018-12-05'),
(33, 1, 2, 1, '2018-12-09'),
(101, 11, 2, 4, '2018-12-02'),
(107, 1, 3, 4, '2018-12-06'),
(33, 1, 2, 1, '2018-12-10'),
(38, 2, 16, 1, '2018-12-11'),
(35, 1, 17, 1, '2018-12-11'),
(21, 1, 8, 1, '2018-12-11'),
(44, 13, 12, 1, '2018-12-12'),
(110, 1, 19, 4, '2018-12-08'),
(33, 1, 2, 1, '2018-12-15'),
(49, 1, 8, 1, '2018-12-16'),
(9, 2, 12, 11, '2018-12-23'),
(33, 1, 2, 11, '2018-12-23'),
(31, 1, 19, 11, '2018-12-23'),
(9, 1, 25, 11, '2018-12-23'),
(49, 1, 8, 11, '2018-12-23'),
(45, 13, 15, 11, '2018-12-23'),
(14, 1, 3, 1, '2018-11-13'),
(22, 1, 17, 1, '2018-11-13'),
(31, 1, 6, 1, '2018-11-13'),
(14, 2, 3, 1, '2018-11-13'),
(22, 14, 17, 1, '2018-11-13'),
(41, 3, 14, 1, '2018-11-13'),
(9, 1, 25, 1, '2018-11-14'),
(19, 14, 9, 1, '2018-11-14'),
(22, 1, 17, 1, '2018-11-14'),
(49, 2, 8, 11, '2018-12-24'),
(9, 2, 25, 11, '2018-12-24'),
(5, 2, 9, 11, '2018-12-24'),
(31, 2, 19, 11, '2018-12-24'),
(11, 2, 2, 11, '2018-12-24'),
(34, 2, 6, 11, '2018-12-24'),
(46, 2, 24, 11, '2018-12-24');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_has_issue_in_group_at_pros`
--
ALTER TABLE `user_has_issue_in_group_at_pros`
  ADD CONSTRAINT `fk_user_has_issue_in_group_at_pros_group1` FOREIGN KEY (`group_group_id`) REFERENCES `group` (`group_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_issue_in_group_at_pros_pros1` FOREIGN KEY (`pros_pros_id`) REFERENCES `pros` (`pros_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_issue_issue1` FOREIGN KEY (`issue_issue_id`) REFERENCES `issue` (`issue_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_issue_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
