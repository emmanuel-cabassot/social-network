-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 mai 2021 à 19:21
-- Version du serveur :  8.0.21
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
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(200) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `birth` date NOT NULL,
  `creation` date NOT NULL,
  `role` varchar(100) NOT NULL,
  `blocked` varchar(3) NOT NULL,
  `period_block` date DEFAULT NULL,
  `banner` varchar(200) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `name`, `lastname`, `avatar`, `city`, `country`, `birth`, `creation`, `role`, `blocked`, `period_block`, `banner`) VALUES
(31, 'dd@dd.fr', '$2y$04$dQj.RUhZj8I/maH8lEvV3.oTffO0.brLjWE5HfNF32N2PlZHvbttW', 'dd', 'dd', 'dd', 'dd', 'dd', '1965-08-10', '2021-05-01', 'user', 'non', '0000-00-00', 'dd');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
