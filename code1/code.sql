-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.16-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema trainingcode
--

CREATE DATABASE IF NOT EXISTS trainingcode;
USE trainingcode;

--
-- Definition of table `judge`
--

DROP TABLE IF EXISTS `judge`;
CREATE TABLE `judge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `url` char(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `judge`
--

/*!40000 ALTER TABLE `judge` DISABLE KEYS */;
/*!40000 ALTER TABLE `judge` ENABLE KEYS */;


--
-- Definition of table `problem`
--

DROP TABLE IF EXISTS `problem`;
CREATE TABLE `problem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `memory` int(11) DEFAULT '-1',
  `judge` int(11) NOT NULL,
  `description` text,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `judge` (`judge`),
  CONSTRAINT `problem_ibfk_1` FOREIGN KEY (`judge`) REFERENCES `judge` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem`
--

/*!40000 ALTER TABLE `problem` DISABLE KEYS */;
/*!40000 ALTER TABLE `problem` ENABLE KEYS */;


--
-- Definition of table `solution`
--

DROP TABLE IF EXISTS `solution`;
CREATE TABLE `solution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `problem` int(11) NOT NULL,
  `date_solved` date NOT NULL,
  `languaje` char(50) NOT NULL,
  `time_solved` int(11) NOT NULL,
  `memory_solved` int(11) NOT NULL,
  `word` char(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `problem` (`problem`),
  CONSTRAINT `solution_ibfk_1` FOREIGN KEY (`problem`) REFERENCES `problem` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `solution`
--

/*!40000 ALTER TABLE `solution` DISABLE KEYS */;
/*!40000 ALTER TABLE `solution` ENABLE KEYS */;


--
-- Definition of table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`,`nick`,`pass`,`state`,`created`,`modified`) VALUES 
 (1,'admin','admin',1,'0000-00-00 00:00:00','2015-07-27 00:22:26');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
