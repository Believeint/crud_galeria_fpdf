-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2016 at 02:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(20) NOT NULL,
  `profissaoUsuario` varchar(50) NOT NULL,
  `imagemUsuario` varchar(200) NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

INSERT INTO `tbl_usuario`(`idUsuario`, `nomeUsuario`, `profissaoUsuario`, `imagemUsuario`) VALUES (1,'João',  'Eletricista','eletricista.jpg');
INSERT INTO `tbl_usuario`(`idUsuario`, `nomeUsuario`, `profissaoUsuario`, `imagemUsuario`) VALUES (2,'Pedro',  'Analista de TI','analista_ti.jpg');
INSERT INTO `tbl_usuario`(`idUsuario`, `nomeUsuario`, `profissaoUsuario`, `imagemUsuario`) VALUES (3,'José',  'Mecânico','mecanico.jpg');
INSERT INTO `tbl_usuario`(`idUsuario`, `nomeUsuario`, `profissaoUsuario`, `imagemUsuario`) VALUES (4,'John',  'Medico','medico.png');
INSERT INTO `tbl_usuario`(`idUsuario`, `nomeUsuario`, `profissaoUsuario`, `imagemUsuario`) VALUES (5,'Josefina',  'Professora','professor.jpg');
INSERT INTO `tbl_usuario`(`idUsuario`, `nomeUsuario`, `profissaoUsuario`, `imagemUsuario`) VALUES (6,'Jorge',  'Pedreiro','pedreiro.jpg');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
