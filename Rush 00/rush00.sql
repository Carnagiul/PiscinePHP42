-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2018 at 12:48 PM
-- Server version: 5.7.22
-- PHP Version: 7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rush00`
--
CREATE DATABASE IF NOT EXISTS `rush00` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rush00`;

-- --------------------------------------------------------

--
-- Table structure for table `group_merchs`
--

DROP TABLE IF EXISTS `group_merchs`;
CREATE TABLE IF NOT EXISTS `group_merchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_merchs`
--

INSERT INTO `group_merchs` (`id`, `name`) VALUES
  (2, 'jeux'),
  (3, 'films'),
  (4, 'Series'),
  (5, 'Musique'),
  (6, 'Animaux');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `timestamp` varchar(32) NOT NULL DEFAULT '0',
  `price` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `user_id`, `content`, `timestamp`, `price`) VALUES
  (3, 7, '1-100;2-6000;3-1;', '1528045647', '16209'),
  (4, 7, '1-301;', '1528052957', '331.1');

-- --------------------------------------------------------

--
-- Table structure for table `merchs`
--

DROP TABLE IF EXISTS `merchs`;
CREATE TABLE IF NOT EXISTS `merchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `description` longtext NOT NULL,
  `price` longtext NOT NULL,
  `amount` longtext NOT NULL,
  `image` longtext NOT NULL,
  `group_id` int(8) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchs`
--

INSERT INTO `merchs` (`id`, `name`, `description`, `price`, `amount`, `image`, `group_id`) VALUES
  (1, 'Evian 1L', 'Bouteille d\'Evian 1 litre', '1.10', '399', 'http://www.france-export-fv.com/WebRoot/Orange/Shops/6449c484-4b17-11e1-a012-000d609a287c/502D/2AE7/C2A3/994A/A602/0A0C/05EA/8D24/Evian.png', 1),
  (2, 'Canard', 'Un petit canard\r\n    ', '2', '9000', 'https://www.wanimo.com/veterinaire/images/articles/chien/chiot-prenom.jpg', 6),
  (3, 'Chiot', 'Un petit chioot', '499', '90', 'https://www.toutoupourlechien.com/wp-content/uploads/2015/08/accueil-chiot.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `descr` longtext NOT NULL,
  `avatar` longtext NOT NULL,
  `banni` int(1) NOT NULL DEFAULT '0',
  `reason_ban` longtext NOT NULL,
  `last_co` bigint(20) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  `lang` varchar(3) NOT NULL DEFAULT 'FR',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `pass`, `ip`, `descr`, `avatar`, `banni`, `reason_ban`, `last_co`, `admin`, `lang`) VALUES
  (8, 'Alvis', 'qwerty123@tt.tt', 'bd4b39b37c13a3eca646d9bac11e7d3a3d167e0e3b8f7a88a467ab55032ea52bbe626844bfbb2e9cecb9e00483dd6d9216042ef19e620f121fe6d6fc6e17889f', '0.0.0.0', 'Aucune Description', '', 0, '', 1528054201, 0, 'FR'),
  (7, 'Admin', 'piquerue@student.42.fr', '8ee2923de2b5ef613654492500b833bf9d68716a5d46d3addff126d67c107d2ee692c2be4a72d47d84bcff0f9b797afa81f8f21ef012f29c28fe4c608707104f', '0.0.0.0', 'Aucune Description', '', 0, '', 1528045182, 1, 'FR');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
