-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 28 mai 2018 à 03:57
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Structure de la table `lang`
--

DROP TABLE IF EXISTS `lang`;
CREATE TABLE IF NOT EXISTS `lang` (
  `tag` varchar(255) NOT NULL,
  `FR` longtext NOT NULL,
  `EN` longtext NOT NULL,
  `DE` longtext NOT NULL,
  PRIMARY KEY (`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lang`
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
('user_still_connected', 'Vous êtes toujours connecté au site!', 'You are always connected to the site!', 'Sie sind an die Website immer angeschlossen!'),
('user_removed', 'Cet utilisateur vient d\'être supprimé!', 'This user has just been deleted!', 'Dieser Benutzer ist gerade beseitigt!'),
('you_are_ban', 'Navré mais vous êtes banni de ce site!', 'Sorry but you are banished from this site!', 'Betrübt aber sind Sie aus dieser Website verbannt!'),
('account_not_exist', 'Votre compte n\'existe pas!', 'Your account does not exist!', 'Ihr Konto existiert nicht!'),
('menu_home', 'Accueil', 'Home', 'Home'),
('menu_contact', 'Contact', 'Contact', 'Contact'),
('menu_disconnect', 'Déconnexion', 'Disconnect', 'Abschalten'),
('connection', 'Se connecter', 'Connect', 'einloggen'),
('menu_vprofil', 'Voir profil', 'See profile', 'Sieh Profil'),
('user_disconnect', 'Vous venez de vous déconnecter!', 'You have just disconnected!', 'Sie haben gerade abgeschaltet!'),
('user_still_disconnect', 'Vous n\'êtes pas connecté!', 'You are not connected!', 'Sie sind nicht angeschlossen!'),
('menu_connection', 'Se Connecter', 'Connect', 'einloggen');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext NOT NULL,
  `lang` longtext NOT NULL,
  `always` int(1) NOT NULL DEFAULT '0',
  `logged` int(1) NOT NULL DEFAULT '0',
  `admin` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `name`, `lang`, `always`, `logged`, `admin`) VALUES
(1, 'index', 'menu_home', 1, 0, 0),
(2, 'contact', 'menu_contact', 1, 0, 0),
(3, 'disconnect', 'menu_disconnect', 0, 1, 0),
(4, 'connection', 'menu_connection', 0, 0, 0),
(5, 'vprofil', 'menu_vprofil', 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `pass`, `ip`, `descr`, `avatar`, `banni`, `reason_ban`, `last_co`, `admin`, `lang`) VALUES
(3, 'Carnage', 'coin@minegamers.fr', '678aac7e986b456e2e2d300db29159e5', '::1', '', '', 0, '', 1527423484, 0, 'FR'),
(5, '1', '1', '1', '1', '1', '1', 0, '1', 1, 0, 'FR');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
