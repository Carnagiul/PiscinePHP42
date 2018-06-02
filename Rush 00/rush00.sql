-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2018 at 06:42 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `group_merchs`
--

CREATE TABLE `group_merchs` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `merchs`
--

CREATE TABLE `merchs` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `description` longtext NOT NULL,
  `price` longtext NOT NULL,
  `amount` longtext NOT NULL,
  `image` longtext NOT NULL,
  `group_id` int(8) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchs`
--

INSERT INTO `merchs` (`id`, `name`, `description`, `price`, `amount`, `image`, `group_id`) VALUES
(1, 'Evian 1L', 'Bouteille d\'Evian 1 litre', '2,30', '17', 'http://www.france-export-fv.com/WebRoot/Orange/Shops/6449c484-4b17-11e1-a012-000d609a287c/502D/2AE7/C2A3/994A/A602/0A0C/05EA/8D24/Evian.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
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
  `lang` varchar(3) NOT NULL DEFAULT 'FR'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `pass`, `ip`, `descr`, `avatar`, `banni`, `reason_ban`, `last_co`, `admin`, `lang`) VALUES
(1, 'Admin', 'qwerty@gmail.com', '901aae706ec1ebcd827f7b28771ebdc7', '0.0.0.0', 'Aucune Description', '', 0, '', 1527922049, 0, 'FR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group_merchs`
--
ALTER TABLE `group_merchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchs`
--
ALTER TABLE `merchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group_merchs`
--
ALTER TABLE `group_merchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchs`
--
ALTER TABLE `merchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
