-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-07-2015 a las 17:28:15
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8
CREATE DATABASE control;
USE control;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `control`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
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
  KEY `fk_asistencia_horario` (`horario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `carrera_id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_nombre` varchar(100) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`carrera_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cc`
--

CREATE TABLE IF NOT EXISTS `cc` (
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
  KEY `fk_cc_carrera` (`carrera_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `curso_id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_nombre` varchar(100) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`curso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE IF NOT EXISTS `docente` (
  `docente_dni` varchar(8) NOT NULL,
  `docente_nombre` varchar(45) NOT NULL,
  `docente_apellido_pat` varchar(45) NOT NULL,
  `docente_apellido_mat` varchar(45) DEFAULT NULL,
  `docente_email` varchar(45) DEFAULT NULL,
  `docente_direccion` varchar(100) DEFAULT NULL,
  `docente_telefono` varchar(45) DEFAULT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`docente_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `horario_id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_id` int(11) NOT NULL,
  `docente_dni` varchar(8) NOT NULL,
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
  KEY `fk_horario_docente` (`docente_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(20) NOT NULL,
  `usuario_pass` varchar(20) NOT NULL,
  `state` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `changed_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_horario` FOREIGN KEY (`horario_id`) REFERENCES `horario` (`horario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cc`
--
ALTER TABLE `cc`
  ADD CONSTRAINT `fk_cc_carrera` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`carrera_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cc_curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`curso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `fk_horario_cc` FOREIGN KEY (`cc_id`) REFERENCES `cc` (`cc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_horario_docente` FOREIGN KEY (`docente_dni`) REFERENCES `docente` (`docente_dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;