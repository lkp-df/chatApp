-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 10 sep. 2021 à 19:31
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chatphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `chats`
--

DROP TABLE IF EXISTS `chats`;
CREATE TABLE IF NOT EXISTS `chats` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `message` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `openned` tinyint(1) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Déchargement des données de la table `chats`
--

INSERT INTO `chats` (`chat_id`, `from_id`, `to_id`, `message`, `openned`, `create_at`) VALUES
(1, 3, 2, 'hello dada', 1, '2021-06-10 12:32:22'),
(2, 2, 3, 'hello pepinho\n            ', 1, '2021-06-10 12:32:53'),
(3, 3, 2, 'comment vas tu?', 1, '2021-06-10 12:33:07'),
(4, 2, 3, 'ca va et toi', 1, '2021-06-10 12:33:12'),
(5, 1, 2, 'salut darelle\n            ', 1, '2021-06-10 12:33:41'),
(6, 2, 1, 'salut comment vas tu ma belle?\n            ', 1, '2021-06-10 12:34:05'),
(7, 1, 2, 'bien et toi\n            ', 1, '2021-06-10 12:34:12'),
(8, 2, 1, 'idem', 1, '2021-06-10 12:34:18'),
(9, 1, 2, 'tu as les news de pepin', 1, '2021-06-10 12:34:27'),
(10, 2, 1, 'oui on cause avec lui meme en ce moment, quoi il te manque?', 1, '2021-06-10 12:34:46'),
(11, 1, 2, 'oh oui un peu, je voulais juste demander', 1, '2021-06-10 12:35:03'),
(12, 2, 1, 'attend le lui passe ton adresse', 1, '2021-06-10 12:35:16'),
(13, 1, 2, 'ok, merci beaucoup que Dieu te benisse', 1, '2021-06-10 12:35:30'),
(14, 2, 1, 'toi de meme', 1, '2021-06-10 12:35:35'),
(15, 2, 3, 'oui ca va, alice te demander?\n            ', 1, '2021-06-10 12:35:54'),
(16, 3, 2, 'je vais bien, ', 1, '2021-06-10 12:36:08'),
(17, 3, 2, 'ah bon, elle me demande pour quoi?', 1, '2021-06-10 12:36:25'),
(18, 2, 3, 'je ne sais pas ', 1, '2021-06-10 12:36:32'),
(19, 3, 2, 'ok,je vais lui ecrire', 1, '2021-06-10 12:36:41');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`msg_id`, `user_1`, `user_2`) VALUES
(1, 3, 2),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `pasword` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `profile_p` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL DEFAULT 'user-default.png',
  `last_seen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `name`, `user_name`, `pasword`, `profile_p`, `last_seen`) VALUES
(1, 'moussavou', 'alice', '$2y$10$Tn5/EP6WQnMiQKH3Qas8O.sKtoVJ3eGr.Uu6YdcTzZxFA.KLOlVFu', 'alice.jpg', '2021-06-10 12:37:08'),
(2, 'okandji', 'darelle', '$2y$10$TFbzZZT62g/hL1hEIdgluegFiT2rEQzAqXuZFK0EFmdvKn1y0q1Vu', 'darelle.jpg', '2021-06-10 12:37:10'),
(3, 'pepin', 'lkp', '$2y$10$pJu2sqNAaXb3YhvEVsv/f.Z7ksndlwmiPG.S/pzUHfi292gm/f2Ye', 'lkp.jpg', '2021-06-10 12:37:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
