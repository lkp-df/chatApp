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
-- Base de données :  `chatapp2`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `emetteur_id` int(255) NOT NULL,
  `recepteur_id` int(255) NOT NULL,
  `message` varchar(700) COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `emetteur_id`, `recepteur_id`, `message`) VALUES
(5, 581224321, 1359530381, 'djoneska est excellent'),
(4, 581224321, 1359530381, 'allo djo'),
(6, 581224321, 1359530381, 'a'),
(7, 1359530381, 581224321, 'hey'),
(8, 1359530381, 581224321, 'allo'),
(9, 1359530381, 581224321, 'comment vas tu?'),
(10, 1359530381, 581224321, 'allo'),
(11, 1359530381, 581224321, 'aaa'),
(12, 581224321, 1359530381, 'oui'),
(13, 581224321, 1359530381, 'bonsoir'),
(14, 581224321, 1359530381, 'bonjour'),
(15, 1359530381, 581224321, 'bonjour king'),
(16, 581224321, 1359530381, 'comment vas tu?'),
(17, 1359530381, 581224321, 'je vais bien et toi?'),
(18, 581224321, 1359530381, 'cool moi de meme beautÃ© et les affaires?'),
(19, 581224321, 1359530381, 'Ã§a avance, nos affaires madame?'),
(20, 1359530381, 581224321, 'oui monsieur pepin'),
(21, 581224321, 1359530381, 'ok madame alice'),
(22, 908264973, 581224321, 'salut tonton pepin'),
(23, 1359530381, 908264973, 'salut alicia, comment vas tu?'),
(24, 1359530381, 908264973, 'lalzadeljhdkdfjhjsv,nv,bv,sbvbsbhdbxv,xnb,wcxxxxbxbxvxvxv'),
(25, 908264973, 1359530381, 'oui salut alicia, excuse moi je m\'etais trompe'),
(26, 1359530381, 908264973, 'd\'accord'),
(27, 1359530381, 908264973, 'ok'),
(28, 908264973, 1359530381, 'cool ma belle'),
(29, 908264973, 1359530381, 'et eden Ã§a va?'),
(30, 1359530381, 908264973, 'oui elle va bien dada'),
(31, 1359530381, 908264973, 'et la famille'),
(32, 908264973, 1359530381, 'ca va bien alice'),
(33, 1140545654, 1359530381, 'salut'),
(34, 1359530381, 1140545654, 'bro comment vas tu?'),
(35, 1140545654, 581224321, 'allo'),
(36, 581224321, 1140545654, 'oui king'),
(37, 1140545654, 530529434, 'allo'),
(38, 530529434, 1140545654, 'yes'),
(39, 1140545654, 530529434, 'yes'),
(40, 530529434, 1140545654, 'oui'),
(41, 530529434, 908264973, 'ok'),
(42, 530529434, 908264973, 'dada'),
(43, 908264973, 530529434, 'petit'),
(44, 908264973, 530529434, 'comment'),
(45, 530529434, 581224321, 'azert');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(200) NOT NULL,
  `prenom` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `pwd` varchar(300) COLLATE utf8_general_mysql500_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `prenom`, `nom`, `email`, `pwd`, `img`, `status`) VALUES
(1, 581224321, 'lkp', 'ng', 'lkp@gmail.com', '$2y$10$wsH5GuwL0YP.8f5lsoHC3eBtHQ8cAC.yCM6sdiG8ZfyRq9CqYFFTe', '1624286871IMG_20210222_154144_629.jpg', 'deconnecter'),
(2, 1359530381, 'alice', 'mous', 'allegra@gmail.com', '$2y$10$GgZrqTmSnvQaCviUYvYEQOviWdmEll75uFbNdpgb4ya7ojFNAS4Ia', '1624366395IMG_20210405_125924_892.jpg', 'En Ligne'),
(3, 908264973, 'dada', 'okan', 'oka@gmail.com', '$2y$10$GhbcYTXXidwcWoprUyZhMOYD.a6ucLjVPRMgVkmMCCb8tvgVunvjK', '1624450535IMG_20210222_154107_747.jpg', 'deconnecter'),
(4, 1140545654, 'test', 't', 'test@gmail.com', '$2y$10$Jnyi7ziPM59fzyDiTMYTTOFjLQTn67XD61IaaOSgLlWBrsvcdOLGa', '1624454665IMG_20201202_171511_448.jpg', 'deconnecter'),
(5, 530529434, 'm', 'zs', 'm@gmail.com', '$2y$10$sutgomCpzaLZ0oIvUTpRSO2HgxO0ukax3BF8DC3KBoCqIvJ.6nF1C', '1624455142IMG_20210405_125405_915.jpg', 'En Ligne');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
