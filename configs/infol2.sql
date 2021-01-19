-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2020 at 11:30 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `infol2`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidat`
--

CREATE TABLE IF NOT EXISTS `candidat` (
  `candidat_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`candidat_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `candidat`
--

INSERT INTO `candidat` (`candidat_id`, `student_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_section` varchar(2) NOT NULL,
  `student_card` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_section`, `student_card`, `first_name`, `last_name`) VALUES
(1, 'S1', 1000, 'imed', 'eddine'),
(2, 'S1', 2000, 'mohammed', 'mahdi'),
(3, 'S1', 3000, 'safi', 'mahmodi'),
(4, 'S2', 4000, 'mohammed', 'eddine'),
(5, 'S2', 5000, 'mahdi', 'mansori'),
(6, 'S2', 6000, 'khiyat', 'mahdi'),
(7, 'S1', 8000, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `candidat_id` int(11) NOT NULL,
  `candidat_section` varchar(2) NOT NULL,
  `student_id` int(11) NOT NULL,
  `number_vote` int(11) NOT NULL,
  KEY `candidat_id` (`candidat_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`candidat_id`, `candidat_section`, `student_id`, `number_vote`) VALUES
(2, 'S1', 2, 1),
(5, 'S2', 5, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`candidat_id`) REFERENCES `candidat` (`candidat_id`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
