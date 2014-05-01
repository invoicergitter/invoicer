-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 01 Mai 2014 à 18:48
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `biller`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `id_formule` int(11) NOT NULL,
  `date` date NOT NULL,
  `check` int(11) NOT NULL DEFAULT '0',
  `iban` varchar(40) NOT NULL,
  `mail` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `id_formule`, `date`, `check`, `iban`, `mail`) VALUES
(5, 'invoicer', 0, '2014-05-01', 0, '201547856946', 'abdelrhamane@invoicer.fr'),
(6, 'invoicer2', 0, '2014-05-01', 0, '0', 'abdelrhamane2@invoicer.fr');

-- --------------------------------------------------------

--
-- Structure de la table `formules`
--

CREATE TABLE IF NOT EXISTS `formules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permonth` int(11) NOT NULL DEFAULT '0',
  `peruser` int(11) NOT NULL DEFAULT '0',
  `feature` varchar(50) NOT NULL,
  `maxuser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `formules`
--

INSERT INTO `formules` (`id`, `name`, `permonth`, `peruser`, `feature`, `maxuser`) VALUES
(1, 'basic', 0, 1, 'moins de 10 clients', 10);

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(30) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `check` tinyint(1) NOT NULL DEFAULT '1',
  `tenant` tinyint(1) NOT NULL DEFAULT '0',
  `company` tinyint(1) NOT NULL DEFAULT '0',
  `homeowner` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `psw` varchar(30) NOT NULL,
  `id_account` int(11) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `mail`, `psw`, `id_account`, `access`, `date`) VALUES
(2, 'abdelrhamane', 'benhammou', 'abdelrhamane@invoicer.fr', 'd41d8cd98f00b204e9800998ecf842', 5, 0, '2014-05-01'),
(3, 'abdelrhamane', 'benhammou', 'abdelrhamane2@invoicer.fr', 'd41d8cd98f00b204e9800998ecf842', 6, 0, '2014-05-01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
