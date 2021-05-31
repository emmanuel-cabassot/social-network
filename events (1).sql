-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 31 mai 2021 à 12:44
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `network`
--

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_creator` int(11) NOT NULL,
  `title_event` varchar(200) NOT NULL,
  `text_event` mediumtext NOT NULL,
  `date_event` datetime NOT NULL,
  `city_event` varchar(250) NOT NULL,
  `img_event` varchar(250) NOT NULL,
  `public_event` varchar(3) NOT NULL,
  `signalized` varchar(3) NOT NULL,
  `blocked` varchar(3) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_event`, `id_user_creator`, `title_event`, `text_event`, `date_event`, `city_event`, `img_event`, `public_event`, `signalized`, `blocked`) VALUES
(2, 32, 'diner campagne', 'à la campagne', '2021-05-28 12:21:00', 'aix', 'Black with Orange Globe Icon Education Logo.png', 'oui', 'non', 'non');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
