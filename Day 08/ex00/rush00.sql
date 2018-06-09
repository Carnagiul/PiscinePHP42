-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2018 at 12:53 PM
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
-- Table structure for table `arms`
--

CREATE TABLE `arms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `short_range` int(2) NOT NULL,
  `medium_range` int(2) NOT NULL,
  `large_range` int(3) NOT NULL,
  `short_dmg` int(3) NOT NULL,
  `medium_dmg` int(3) NOT NULL,
  `long_dmg` int(3) NOT NULL,
  `reload_duration` int(2) NOT NULL,
  `type` int(1) NOT NULL,
  `sleeper` int(1) NOT NULL,
  `radius` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `arms`
--

INSERT INTO `arms` (`id`, `name`, `short_range`, `medium_range`, `large_range`, `short_dmg`, `medium_dmg`, `long_dmg`, `reload_duration`, `type`, `sleeper`, `radius`) VALUES
(1, 'Laser MK1', 10, 25, 50, 20, 15, 10, 0, 1, 0, 1),
(2, 'Laser MK2', 15, 30, 50, 35, 25, 10, 1, 1, 0, 2),
(3, 'Laser MK3', 10, 30, 35, 30, 30, 20, 2, 1, 0, 3),
(4, 'Laser MK7', 15, 20, 30, 40, 25, 25, 3, 1, 0, 3),
(5, 'Missile', 10, 30, 50, 8, 7, 5, 0, 2, 0, 1),
(6, 'Missile Neutro', 15, 40, 70, 12, 10, 8, 1, 2, 0, 1),
(7, 'Missile Antimatiere', 20, 50, 100, 22, 13, 10, 3, 2, 0, 1),
(8, 'Mine', 3, 5, 7, 12, 10, 8, 1, 3, 0, 3),
(9, 'Imperator', 10, 15, 20, 40, 30, 30, 10, 4, 1, 0),
(10, 'Mine IEM', 6, 10, 14, 15, 15, 15, 2, 3, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `fight`
--

CREATE TABLE `fight` (
  `id` int(11) NOT NULL,
  `vessel_id` int(4) NOT NULL,
  `vessel_health` int(4) NOT NULL,
  `vessel_shield` int(4) NOT NULL,
  `vessel_turn` int(3) NOT NULL,
  `vessel_posx` int(4) NOT NULL,
  `vessel_posy` int(4) NOT NULL,
  `vessel_power` int(1) NOT NULL,
  `vessel_shoot` int(11) NOT NULL,
  `vessel_owner` int(11) NOT NULL,
  `vessel_played` int(1) NOT NULL,
  `game_id` int(3) NOT NULL,
  `vessel_move` int(4) NOT NULL,
  `vessel_chance` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fight`
--

INSERT INTO `fight` (`id`, `vessel_id`, `vessel_health`, `vessel_shield`, `vessel_turn`, `vessel_posx`, `vessel_posy`, `vessel_power`, `vessel_shoot`, `vessel_owner`, `vessel_played`, `game_id`, `vessel_move`, `vessel_chance`) VALUES
(89, 1, 25, 12, 2, 2, 26, 0, 1, 1, 1, 1, -1, 1),
(90, 1, 25, 6, 0, 25, 25, 1, 1, 2, 1, 1, 6, 0),
(91, 1, 25, 6, 0, 50, 50, 1, 1, 3, 1, 1, 6, 0),
(92, 1, 25, 6, 0, 70, 70, 1, 1, 4, 1, 1, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `user1_id` int(4) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `user3_id` int(11) NOT NULL,
  `user4_id` int(11) NOT NULL,
  `vessel_user1` longtext NOT NULL,
  `vessel_user2` longtext NOT NULL,
  `vessel_user3` longtext NOT NULL,
  `vessel_user4` longtext NOT NULL,
  `turn` int(11) NOT NULL,
  `player` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `user1_id`, `user2_id`, `user3_id`, `user4_id`, `vessel_user1`, `vessel_user2`, `vessel_user3`, `vessel_user4`, `turn`, `player`) VALUES
(1, 1, 2, 3, 4, '1', '2', '3', '4', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE `lang` (
  `tag` varchar(255) NOT NULL,
  `FR` longtext NOT NULL,
  `EN` longtext NOT NULL,
  `DE` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lang`
--

INSERT INTO `lang` (`tag`, `FR`, `EN`, `DE`) VALUES
('user_not_exist', 'Cette utilisateur n\'existe pas!', 'This user does\'nt exist!', 'Dies existiert Benutzer nicht!'),
('not_an_admin', 'Vous n\'êtes pas administrateur!', 'You are not an administrator!', 'Sie sind kein Verwalter!'),
('user_is_ban', 'Cet utilisateur est déjà banni!', 'This user is already banished!', 'Dieser Benutzer ist schon verbannt!'),
('user_is_you', 'Vous êtes cet utilisateur!', 'You are this user!', 'Sie sind dieser Benutzer!'),
('user_is_admin', 'Cet utilisateur est un administrateur!', 'This user is an administrator!', 'Dieser Benutzer ist ein Verwalter!'),
('user_ban', 'Vous venez de bannir cet utilisateur!', 'You have just banished this user!', 'Sie haben diesen Benutzer gerade verbannt!'),
('username_is_missing', 'Le nom d\'utilisateur n\'es pas spécifié!', 'The user name are not specified!', 'Der Name von Benutzer bist nicht genau angegeben!'),
('email_is_missing', 'L\'email est manquant!', 'The email is missing!', 'Der email ist ein Fehlender!'),
('password_is_missing', 'Le mot de passe est manquant!', 'The password is missing!', 'Das Kennwort ist ein Fehlendes!'),
('username_already_exist', 'Ce nom d\'utilisateur est déjà pris!', 'This user name is already taken!', 'Dieser Name von Benutzer ist schon genommen!'),
('email_already_exist', 'Cet email est déjà utilisé!', 'This email is already used!', 'Dieser email ist schon benutzt!'),
('email_equals_password', 'Votre mot de passe correspond à votre email, veuillez le changez!', 'Your password corresponds to your email, want change him!', 'Ihr Kennwort entspricht Ihrem email, w Sie, ändern es!'),
('username_equals_password', 'Votre nom d\'utilisateur correspond à votre mot de passe!', 'Your user name corresponds to your password!', 'Ihr Name von Benutzer entspricht Ihrem Kennwort!'),
('username_rev_equals_password', 'Votre nom d\'utilisateur correspond à votre mot de passe!', 'Your user name corresponds to your password!', 'Ihr Name von Benutzer entspricht Ihrem Kennwort!'),
('password_too_short', 'Votre mot de passe est trop court!', 'Your password is too short!', 'Ihr Kennwort ist zu kurz!'),
('user_succesfully_created', 'L\'utilisateur à correctement été créer!', 'The user in correctly be to create!', 'Der Benutzer in richtig, zu schaffen gewesen!'),
('user_is_not_ban', 'Cet utilisateur n\'es pas banni!', 'This user are not banished!', 'Dieser Benutzer bist nicht verbannt!'),
('user_unban', 'Cet utilisateur a été débanni!', 'This user was unban!', 'Dieser Benutzer ist débanni gewesen!'),
('wrong_credential', 'Votre mot de passe est incorrect!', 'Your password is wrong!', 'Ihr Kennwort ist inkorrekt!'),
('user_connected', 'Vous venez de vous connecter!', 'You have just connected!', 'Sie haben sich gerade angeschlossen!'),
('user_still_connected', 'Vous êtes toujours connecté au site!', 'You are always connected to the site!', 'Sie sind an die Website immer angeschlossen!');

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

-- --------------------------------------------------------

--
-- Table structure for table `vessel`
--

CREATE TABLE `vessel` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `width` int(2) NOT NULL,
  `height` int(2) NOT NULL,
  `max_health` int(4) NOT NULL,
  `max_shield` int(4) NOT NULL,
  `tile` varchar(50) NOT NULL,
  `move` int(3) NOT NULL,
  `power` int(3) NOT NULL,
  `Arms` varchar(50) NOT NULL,
  `posX` int(3) NOT NULL,
  `posY` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vessel`
--

INSERT INTO `vessel` (`id`, `name`, `width`, `height`, `max_health`, `max_shield`, `tile`, `move`, `power`, `Arms`, `posX`, `posY`) VALUES
(1, 'Endeavor', 1, 3, 25, 6, 'endeaor', 6, 6, '1;2', 4, 4),
(2, 'Wraith\'s Erator', 1, 3, 6, 3, 'erator', 12, 2, '3;4', 5, 5),
(3, 'Evil Jumper', 2, 2, 6, 3, 'jumper', 12, 3, '5;6', 120, 80),
(4, 'D0OMSD4Y', 15, 10, 200, 30, 'dooms', 1, 9, '1;2;3;4;5;6;7;8;9;10', 120, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arms`
--
ALTER TABLE `arms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fight`
--
ALTER TABLE `fight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lang`
--
ALTER TABLE `lang`
  ADD PRIMARY KEY (`tag`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vessel`
--
ALTER TABLE `vessel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arms`
--
ALTER TABLE `arms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fight`
--
ALTER TABLE `fight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vessel`
--
ALTER TABLE `vessel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
