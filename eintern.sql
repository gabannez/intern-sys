-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2015 at 04:49 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eintern`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullName` text NOT NULL,
  `ic` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `company` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `officeNo` varchar(20) NOT NULL,
  `mobileNo` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `DT_CREATE` datetime NOT NULL,
  `IDENT` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fullName`, `ic`, `gender`, `company`, `position`, `officeNo`, `mobileNo`, `email`, `DT_CREATE`, `IDENT`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'anonymous', '', '', '', '', '', '', '', '2015-08-18 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE IF NOT EXISTS `institute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appellation` text NOT NULL,
  `DT_CREATE` datetime NOT NULL,
  `IDENT` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`id`, `appellation`, `DT_CREATE`, `IDENT`) VALUES
(1, 'University Putra Malaysia', '2015-08-17 05:51:50', 'administrator'),
(2, 'Open University Malaysia', '2015-08-16 15:36:46', 'admin'),
(3, 'University Malaysia Sabah', '2015-08-16 15:37:35', 'admin'),
(4, 'University Malaysia Sarawak', '2015-08-16 15:38:02', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullName` text NOT NULL,
  `ic` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `university` text NOT NULL,
  `address` text NOT NULL,
  `state` varchar(50) NOT NULL,
  `postcode` varchar(15) NOT NULL,
  `officeNo` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `mobileNo` varchar(15) NOT NULL,
  `DT_CREATE` datetime NOT NULL,
  `IDENT` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `username`, `password`, `fullName`, `ic`, `gender`, `nationality`, `university`, `address`, `state`, `postcode`, `officeNo`, `email`, `mobileNo`, `DT_CREATE`, `IDENT`) VALUES
(1, 'lecturer', '81dc9bdb52d04dc20036dbd8313ed055', 'Michael Kent', '701122-12-5339', '1', 'Malaysia', '1', 'Petaling Jaya KL', '1', '88400', '03-2798865', 'mkent@yahoo.com', '019-8697720', '2015-08-17 05:22:58', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

CREATE TABLE IF NOT EXISTS `logbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_student` int(11) NOT NULL,
  `date` date NOT NULL,
  `day` varchar(20) NOT NULL,
  `task_activities` text NOT NULL,
  `remarks` text NOT NULL,
  `DT_CREATE` datetime NOT NULL,
  `IDENT` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`id`, `id_student`, `date`, `day`, `task_activities`, `remarks`, `DT_CREATE`, `IDENT`) VALUES
(1, 2, '2015-08-19', 'Wednesay', 'Nothing', 'Nothing', '2015-08-19 00:00:00', ''),
(2, 4, '2015-08-20', 'Thursday', 'This is it.', 'How is it.', '2015-08-19 22:10:45', 'admin'),
(3, 3, '2015-08-24', 'Monday', 'Hello', 'Testing', '2015-08-19 22:34:48', ''),
(4, 3, '2015-08-25', 'Tuesday', 'dasd', 'dsadas', '2015-08-19 22:37:41', 'jackblack');

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE IF NOT EXISTS `major` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appellation` text NOT NULL,
  `DT_CREATE` datetime NOT NULL,
  `IDENT` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`id`, `appellation`, `DT_CREATE`, `IDENT`) VALUES
(1, 'Information Technology', '2015-08-16 15:39:09', 'admin'),
(2, 'Business Administration', '2015-08-16 15:39:44', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appellation` text NOT NULL,
  `DT_CREATE` datetime NOT NULL,
  `IDENT` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `appellation`, `DT_CREATE`, `IDENT`) VALUES
(1, 'Sabah', '2015-08-16 15:34:59', 'admin'),
(2, 'Sarawak', '2015-08-16 15:35:28', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supervisor` int(11) NOT NULL,
  `id_lecturer` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullName` text NOT NULL,
  `ic_no` varchar(20) NOT NULL,
  `matric_no` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `major` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL,
  `university` text NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `stu_address` text NOT NULL,
  `state` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `homeTel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileNo` varchar(15) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `DT_CREATE` datetime NOT NULL,
  `IDENT` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `id_supervisor`, `id_lecturer`, `username`, `password`, `fullName`, `ic_no`, `matric_no`, `dob`, `gender`, `major`, `level`, `university`, `nationality`, `stu_address`, `state`, `postcode`, `homeTel`, `email`, `mobileNo`, `date_start`, `date_end`, `DT_CREATE`, `IDENT`) VALUES
(2, 11, 1, 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'abc', '1234', '1234', '2015-08-17', '2', '1', '1', '1', 'Malaysia', 'abcd', '1', '88990', '12345', 'test@abc.com', '12345', '2015-08-17', '2015-10-19', '2015-08-16 15:32:58', 'administrator'),
(3, 0, 0, 'jackblack', '81dc9bdb52d04dc20036dbd8313ed055', 'Jack Black', '812211125322', '126678', '0000-00-00', '1', '2', '2', '2', 'Malaysia', 'Kg Likas', '2', '88400', '0884235567', 'jacblack@yahoo.com', '0128863324', '0000-00-00', '0000-00-00', '2015-08-07 12:27:38', NULL),
(4, 11, 0, 'jeffandrew', '827ccb0eea8a706c4c34a16891f84e7b', 'Jeff Andrew', '901122-12-5369', '129981', '1990-11-22', '1', '1', '3', '1', 'Malaysia', 'Kg Kobusak Penampang', '1', '88400', '088-287833', 'jeffandrew@hotmail.com', '012-8417786', '0000-00-00', '0000-00-00', '2015-08-16 12:52:43', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE IF NOT EXISTS `supervisors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullName` text NOT NULL,
  `ic` varchar(20) NOT NULL,
  `position` varchar(50) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `compName` text NOT NULL,
  `address` text NOT NULL,
  `state` varchar(50) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `officeNo` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `mobileNo` varchar(15) NOT NULL,
  `DT_CREATE` datetime NOT NULL,
  `IDENT` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `username`, `password`, `fullName`, `ic`, `position`, `gender`, `nationality`, `compName`, `address`, `state`, `postcode`, `officeNo`, `email`, `mobileNo`, `DT_CREATE`, `IDENT`) VALUES
(11, 'miketyson', 'e10adc3949ba59abbe56e057f20f883e', 'Mike Tyson', '881122-12-5343', 'Supervisor', '1', 'Malaysia', 'Robonet Sdn Bhd', 'KK Sabah', '1', '88400', '088-7211345', 'miketyson@gmail.com', '013-8417744', '2015-08-16 17:04:53', 'administrator');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
