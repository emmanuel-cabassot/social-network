-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 13 juin 2021 à 19:39
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
CREATE DATABASE IF NOT EXISTS `network` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `network`;

-- --------------------------------------------------------

--
-- Structure de la table `belong`
--

DROP TABLE IF EXISTS `belong`;
CREATE TABLE IF NOT EXISTS `belong` (
  `id_belong` int NOT NULL AUTO_INCREMENT,
  `id_group` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_belong`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `belong`
--

INSERT INTO `belong` (`id_belong`, `id_group`, `id_user`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(14, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment_event`
--

DROP TABLE IF EXISTS `comment_event`;
CREATE TABLE IF NOT EXISTS `comment_event` (
  `id_comment_event` int NOT NULL AUTO_INCREMENT,
  `text_comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_event` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_comment_event`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment_event`
--

INSERT INTO `comment_event` (`id_comment_event`, `text_comment`, `date_comment`, `id_event`, `id_user`) VALUES
(1, 'C\'est super j\'adore voyager', '2021-06-13 14:00:19', 1, 3),
(2, 'Cool, à nous les states', '2021-06-13 19:19:26', 1, 1),
(3, 'Mon ami denis me dit qu\'il y a un prob de chat?', '2021-06-13 19:19:39', 1, 3),
(4, 'C\'est bon cela fonctionne', '2021-06-13 19:19:58', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment_group`
--

DROP TABLE IF EXISTS `comment_group`;
CREATE TABLE IF NOT EXISTS `comment_group` (
  `id_comment_group` int NOT NULL AUTO_INCREMENT,
  `text_comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_group` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_comment_group`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment_group`
--

INSERT INTO `comment_group` (`id_comment_group`, `text_comment`, `date_comment`, `id_group`, `id_user`) VALUES
(2, 'Bon je me sens un peu seul. A quand les grandes batailles?', '2021-06-08 19:09:00', 1, 1),
(3, 'C\'est quoi cette photo?', '2021-06-09 09:43:57', 2, 2),
(4, 'Merci de m\'avoir invité.', '2021-06-09 14:49:22', 2, 3),
(7, 'est ce que ça fonctionne?', '2021-06-12 14:07:43', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `comment_post`
--

DROP TABLE IF EXISTS `comment_post`;
CREATE TABLE IF NOT EXISTS `comment_post` (
  `id_comment_post` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `text_comment_post` longtext NOT NULL,
  `date_comment_post` datetime NOT NULL,
  `signalized` varchar(10) DEFAULT 'non',
  `blocked` varchar(10) DEFAULT 'non',
  PRIMARY KEY (`id_comment_post`),
  KEY `fk_post` (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comment_story`
--

DROP TABLE IF EXISTS `comment_story`;
CREATE TABLE IF NOT EXISTS `comment_story` (
  `id_comment_story` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_story` int NOT NULL,
  `tittle_comment_story` varchar(250) NOT NULL,
  `text_comment_story` longtext NOT NULL,
  `date_comment_story` datetime NOT NULL,
  `signalized` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_comment_story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `connected`
--

DROP TABLE IF EXISTS `connected`;
CREATE TABLE IF NOT EXISTS `connected` (
  `id_connected` int NOT NULL AUTO_INCREMENT,
  `str_connect` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_connected`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connected`
--

INSERT INTO `connected` (`id_connected`, `str_connect`, `id_user`) VALUES
(28, 1623611780, 1);

-- --------------------------------------------------------

--
-- Structure de la table `dislike_post`
--

DROP TABLE IF EXISTS `dislike_post`;
CREATE TABLE IF NOT EXISTS `dislike_post` (
  `id_dislike_post` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_dislike_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id_event` int NOT NULL AUTO_INCREMENT,
  `id_user_creator` int NOT NULL,
  `title_event` varchar(200) NOT NULL,
  `text_event` mediumtext NOT NULL,
  `date_event` datetime NOT NULL,
  `city_event` varchar(250) NOT NULL,
  `img_event` varchar(250) NOT NULL,
  `public_event` varchar(3) NOT NULL,
  `signalized` varchar(3) NOT NULL,
  `blocked` varchar(3) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id_event`, `id_user_creator`, `title_event`, `text_event`, `date_event`, `city_event`, `img_event`, `public_event`, `signalized`, `blocked`) VALUES
(1, 1, 'COMICcon 2021', 'Invitation pour la Comic con de San Diego.\nRendez vous Aéroport Orly entrée C', '2021-08-08 19:07:00', 'Paris - San Diego', 'sandiego.jpg', 'oui', 'non', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `friend`
--

DROP TABLE IF EXISTS `friend`;
CREATE TABLE IF NOT EXISTS `friend` (
  `id_follow` int NOT NULL AUTO_INCREMENT,
  `id_follower` int NOT NULL,
  `id_followed` int NOT NULL,
  `confirmed` varchar(10) NOT NULL,
  PRIMARY KEY (`id_follow`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friend`
--

INSERT INTO `friend` (`id_follow`, `id_follower`, `id_followed`, `confirmed`) VALUES
(56, 1, 4, 'non'),
(35, 2, 4, 'oui'),
(51, 3, 2, 'oui'),
(43, 1, 2, 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_group` int NOT NULL AUTO_INCREMENT,
  `name_group` varchar(250) NOT NULL,
  `description` mediumtext NOT NULL,
  `img_group` varchar(250) NOT NULL,
  `id_user_create` int NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_group`, `name_group`, `description`, `img_group`, `id_user_create`) VALUES
(1, 'Les fous de star wars', 'Toi aussi tu vibres au doux vrombrissement de l\'épée laser? Rejoins-nous aux confins de l\'Univers Star Wars', 'starwars.jpg', 1),
(2, 'communauté de Blade Runner', 'Vous êtes fan de Blade Runner rejoignez la communauté', 'banner-xxsm.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `images_posts`
--

DROP TABLE IF EXISTS `images_posts`;
CREATE TABLE IF NOT EXISTS `images_posts` (
  `id_images_posts` int NOT NULL AUTO_INCREMENT,
  `id_img_post` int NOT NULL,
  `id_post` int NOT NULL,
  PRIMARY KEY (`id_images_posts`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `images_stories`
--

DROP TABLE IF EXISTS `images_stories`;
CREATE TABLE IF NOT EXISTS `images_stories` (
  `id_images_stories` int NOT NULL AUTO_INCREMENT,
  `id_img_story` int NOT NULL,
  `id_story` int NOT NULL,
  PRIMARY KEY (`id_images_stories`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `image_post`
--

DROP TABLE IF EXISTS `image_post`;
CREATE TABLE IF NOT EXISTS `image_post` (
  `id_image_post` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `name_image_post` varchar(200) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image_post`),
  KEY `fk_image_post_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image_post`
--

INSERT INTO `image_post` (`id_image_post`, `id_post`, `id_user`, `name_image_post`, `chemin`) VALUES
(1, 1, 1, 'avatar8.png', 'assets/images/upload/post/1'),
(2, 1, 1, 'avatar9.png', 'assets/images/upload/post/1');

-- --------------------------------------------------------

--
-- Structure de la table `img_post`
--

DROP TABLE IF EXISTS `img_post`;
CREATE TABLE IF NOT EXISTS `img_post` (
  `id_img_post` int NOT NULL AUTO_INCREMENT,
  `image_post` varchar(250) NOT NULL,
  `descript_post` varchar(250) NOT NULL,
  PRIMARY KEY (`id_img_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `img_story`
--

DROP TABLE IF EXISTS `img_story`;
CREATE TABLE IF NOT EXISTS `img_story` (
  `id_img_story` int NOT NULL AUTO_INCREMENT,
  `image_story` varchar(250) NOT NULL,
  `descript_story` varchar(250) NOT NULL,
  PRIMARY KEY (`id_img_story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `like_event`
--

DROP TABLE IF EXISTS `like_event`;
CREATE TABLE IF NOT EXISTS `like_event` (
  `id_like_event` int NOT NULL AUTO_INCREMENT,
  `id_event` int NOT NULL,
  `like_event` int NOT NULL,
  `dislike_event` int NOT NULL,
  PRIMARY KEY (`id_like_event`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `like_post`
--

DROP TABLE IF EXISTS `like_post`;
CREATE TABLE IF NOT EXISTS `like_post` (
  `id_like_post` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_like_post`),
  KEY `fk_like_post_post` (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `like_story`
--

DROP TABLE IF EXISTS `like_story`;
CREATE TABLE IF NOT EXISTS `like_story` (
  `id_like_story` int NOT NULL AUTO_INCREMENT,
  `id_story` int NOT NULL,
  `id_user` int NOT NULL,
  `liked` int NOT NULL,
  `disliked` int NOT NULL,
  PRIMARY KEY (`id_like_story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `part_event`
--

DROP TABLE IF EXISTS `part_event`;
CREATE TABLE IF NOT EXISTS `part_event` (
  `id_part_event` int NOT NULL AUTO_INCREMENT,
  `id_event` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_part_event`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `part_event`
--

INSERT INTO `part_event` (`id_part_event`, `id_event`, `id_user`) VALUES
(1, 1, 1),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `text_post` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_post` datetime NOT NULL,
  `public` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'non',
  `signalized` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'non',
  `blocked` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'non',
  `image_post` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'non',
  `video_post` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'non',
  `story_post` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `text_post`, `date_post`, `public`, `signalized`, `blocked`, `image_post`, `video_post`, `story_post`) VALUES
(1, 1, 'test de post', '2021-06-13 19:27:50', 'non', 'non', 'non', 'oui', 'non', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `story`
--

DROP TABLE IF EXISTS `story`;
CREATE TABLE IF NOT EXISTS `story` (
  `id_story` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `title_story` varchar(250) NOT NULL,
  `text_story` longtext NOT NULL,
  `date_story` datetime NOT NULL,
  `public` tinyint(1) NOT NULL,
  `signalized` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  `video` varchar(250) NOT NULL,
  PRIMARY KEY (`id_story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `name`, `lastname`, `avatar`, `city`, `country`, `birth`, `creation`, `role`, `blocked`, `period_block`, `banner`) VALUES
(1, 'denis@yahoo.fr', '$2y$04$47dTh9cSDgYrRpXTvslk.ut9FW0BQGx1MU.dJqNiuPTZfTPpF1gHi', 'Sined', 'Denis', 'default.png', 'Marseille', 'France', '1966-06-06', '2021-06-08', 'user', 'non', '0001-01-01', 'defaultbanner.png'),
(2, 'lili@gmail.com', '$2y$04$WtwJlOmVFAFAOojdQ5ZfI.vUUiPpJGu4RU9bUk6yQGy9B44WnXM7G', 'Moore', 'lili', 'default.png', 'Paris', 'France', '1993-08-11', '2021-06-09', 'user', 'non', '0001-01-01', 'defaultbanner.png'),
(3, 'henri@yahoo.fr', '$2y$04$cTeNbYo1ItZU3AAQjCgAYuwodnLK4IFh9yfXpqbZs00G9V0RlrPoO', 'Henri IV', 'Henri', '15.jpg', 'Bordeaux', 'France', '1966-06-06', '2021-06-09', 'user', 'non', '0001-01-01', 'defaultbanner.png'),
(4, 'leoBB@gmail.com', '$2y$04$mjEQOpSKfw6CRQ1dKviTsO34Y/2AriMLmOOlA4ZyFwsYQcWPiYIua', 'Barry', 'Léo', 'default.png', 'Marseille', 'France', '2005-03-03', '2021-06-09', 'user', 'non', '0001-01-01', 'defaultbanner.png');

-- --------------------------------------------------------

--
-- Structure de la table `video_post`
--

DROP TABLE IF EXISTS `video_post`;
CREATE TABLE IF NOT EXISTS `video_post` (
  `id_video_post` int NOT NULL AUTO_INCREMENT,
  `name_video_post` varchar(200) NOT NULL,
  `id_post` int NOT NULL,
  `id_user` int NOT NULL,
  `chemin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_video_post`),
  KEY `fk_video_post_post` (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `video_story`
--

DROP TABLE IF EXISTS `video_story`;
CREATE TABLE IF NOT EXISTS `video_story` (
  `id_video_story` int NOT NULL AUTO_INCREMENT,
  `name_video_story` varchar(200) NOT NULL,
  `id_story` int NOT NULL,
  PRIMARY KEY (`id_video_story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment_post`
--
ALTER TABLE `comment_post`
  ADD CONSTRAINT `fk_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image_post`
--
ALTER TABLE `image_post`
  ADD CONSTRAINT `fk_image_post_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Contraintes pour la table `like_post`
--
ALTER TABLE `like_post`
  ADD CONSTRAINT `fk_like_post_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Contraintes pour la table `video_post`
--
ALTER TABLE `video_post`
  ADD CONSTRAINT `fk_video_post_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
