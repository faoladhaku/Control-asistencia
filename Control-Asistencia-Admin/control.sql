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
-- Create schema control
--

CREATE DATABASE IF NOT EXISTS control;
USE control;

--
-- Definition of table `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia` (
  `asistencia_id` int(11) NOT NULL AUTO_INCREMENT,
  `horario_id` int(11) NOT NULL,
  `asistencia_fecha` date NOT NULL,
  `asistencia_hora_ingreso` time NOT NULL,
  `asistencia_hora_salida` time NOT NULL,
  `asistencia_tema` varchar(200) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`asistencia_id`),
  KEY `fk_asistencia_horario` (`horario_id`),
  CONSTRAINT `fk_asistencia_horario` FOREIGN KEY (`horario_id`) REFERENCES `horario` (`horario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asistencia`
--

/*!40000 ALTER TABLE `asistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `asistencia` ENABLE KEYS */;


--
-- Definition of table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
CREATE TABLE `carrera` (
  `carrera_id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_nombre` varchar(100) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`carrera_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carrera`
--

/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` (`carrera_id`,`carrera_nombre`,`state`,`created_on`,`changed_on`) VALUES 
 (2,'Agronomia Industrial',1,'2015-07-28 17:38:08','2015-07-28 17:38:23'),
 (3,'Ciencia de la Computacion',1,'2015-07-28 18:29:39','2015-07-28 18:29:39'),
 (4,'Administracion',1,'2015-07-28 18:29:52','2015-07-28 18:29:52');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;


--
-- Definition of table `cc`
--

DROP TABLE IF EXISTS `cc`;
CREATE TABLE `cc` (
  `cc_id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `cc_codigo` varchar(10) DEFAULT NULL,
  `cc_fecha_ini` date DEFAULT NULL,
  `cc_fecha_fin` date DEFAULT NULL,
  `cc_horas_sem` int(11) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cc_id`),
  KEY `fk_cc_curso` (`curso_id`),
  KEY `fk_cc_carrera` (`carrera_id`),
  CONSTRAINT `fk_cc_carrera` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`carrera_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cc_curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cc`
--

/*!40000 ALTER TABLE `cc` DISABLE KEYS */;
INSERT INTO `cc` (`cc_id`,`carrera_id`,`curso_id`,`cc_codigo`,`cc_fecha_ini`,`cc_fecha_fin`,`cc_horas_sem`,`state`,`created_on`,`changed_on`) VALUES 
 (34,2,12,'QUIAGR1507','2015-07-01','2015-07-05',6,1,'2015-07-29 00:19:47','2015-07-29 00:19:47'),
 (35,4,14,'MATADM1507','2015-07-01','2015-07-26',10,1,'2015-07-29 02:35:46','2015-07-29 02:35:46'),
 (37,2,16,'FISAGR1507','2015-07-02','2015-10-31',5,1,'2015-07-29 06:27:46','2015-07-29 06:27:46');
/*!40000 ALTER TABLE `cc` ENABLE KEYS */;


--
-- Definition of table `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_nombre` varchar(100) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`curso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curso`
--

/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` (`curso_id`,`curso_nombre`,`state`,`created_on`,`changed_on`) VALUES 
 (12,'Quimica',1,'2015-07-28 22:56:47','2015-07-28 22:56:47'),
 (14,'Matematica',1,'2015-07-29 02:35:46','2015-07-29 02:35:46'),
 (16,'Fisica',1,'2015-07-29 06:27:46','2015-07-29 06:27:46');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;


--
-- Definition of table `docente`
--

DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
  `docente_id` int(11) NOT NULL AUTO_INCREMENT,
  `docente_dni` varchar(8) NOT NULL,
  `docente_nombre` varchar(45) NOT NULL,
  `docente_apellido_pat` varchar(45) NOT NULL,
  `docente_apellido_mat` varchar(45) DEFAULT NULL,
  `docente_email` varchar(45) DEFAULT NULL,
  `docente_direccion` varchar(100) NOT NULL,
  `docente_telefono` varchar(45) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`docente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docente`
--

/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` (`docente_id`,`docente_dni`,`docente_nombre`,`docente_apellido_pat`,`docente_apellido_mat`,`docente_email`,`docente_direccion`,`docente_telefono`,`state`,`created_on`,`changed_on`) VALUES 
 (3,'45634913','Julio','Quispe','Quicano','julioqq29@gmail.com','Av 13 de junio','959285233',1,'2015-07-28 16:27:37','2015-07-28 16:27:37'),
 (9,'56652100','Claudia','Laos','Carpio','clau@gmail.co','los olmos 545','',1,'2015-07-29 03:51:42','2015-07-29 03:51:42');
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;


--
-- Definition of table `horario`
--

DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `horario_id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL,
  `horario_dia` varchar(45) NOT NULL,
  `horario_hora_ini` time NOT NULL,
  `horario_hora_fin` time NOT NULL,
  `horario_fecha` date DEFAULT NULL,
  `horario_tipo` tinyint(1) DEFAULT '1',
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`horario_id`),
  KEY `fk_horario_cc` (`cc_id`),
  KEY `fk_horario_docente` (`docente_id`),
  CONSTRAINT `fk_horario_docente` FOREIGN KEY (`docente_id`) REFERENCES `docente` (`docente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_horario_cc` FOREIGN KEY (`cc_id`) REFERENCES `cc` (`cc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `horario`
--

/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` (`horario_id`,`cc_id`,`docente_id`,`horario_dia`,`horario_hora_ini`,`horario_hora_fin`,`horario_fecha`,`horario_tipo`,`state`,`created_on`,`changed_on`) VALUES 
 (1,35,3,'Lunes','08:00:00','10:15:00',NULL,1,1,'2015-07-29 03:25:50','2015-07-29 03:25:50'),
 (2,34,3,'Jueves','10:15:00','12:30:00',NULL,1,1,'2015-07-29 03:25:50','2015-07-29 04:27:46'),
 (3,34,9,'Sabado','09:30:00','12:30:00',NULL,1,1,'2015-07-29 03:52:12','2015-07-29 03:52:12'),
 (5,35,9,'Lunes','18:00:00','20:15:00',NULL,1,1,'2015-07-29 05:07:25','2015-07-29 05:07:25'),
 (7,35,9,'Miercoles','08:00:00','11:00:00',NULL,1,1,'2015-07-29 05:07:50','2015-07-29 05:07:50'),
 (8,34,3,'','08:00:00','11:00:00','2015-07-28',0,1,'2015-07-29 05:29:57','2015-07-29 06:19:13');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(20) NOT NULL,
  `usuario_pass` varchar(20) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`usuario_id`,`usuario_nombre`,`usuario_pass`,`state`,`created_on`,`changed_on`) VALUES 
 (1,'root','root',1,'2015-07-27 03:25:50','2015-07-29 06:27:05');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
