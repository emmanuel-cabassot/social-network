-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 15, 2021 at 06:52 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `network`
--
CREATE DATABASE IF NOT EXISTS `network` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `network`;

-- --------------------------------------------------------

--
-- Table structure for table `belong`
--

DROP TABLE IF EXISTS `belong`;
CREATE TABLE IF NOT EXISTS `belong` (
  `id_belong` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_belong`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `belong`
--

INSERT INTO `belong` (`id_belong`, `id_group`, `id_user`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(14, 2, 1),
(16, 3, 32);

-- --------------------------------------------------------

--
-- Table structure for table `comment_event`
--

DROP TABLE IF EXISTS `comment_event`;
CREATE TABLE IF NOT EXISTS `comment_event` (
  `id_comment_event` int(11) NOT NULL AUTO_INCREMENT,
  `text_comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_comment_event`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comment_group`
--

DROP TABLE IF EXISTS `comment_group`;
CREATE TABLE IF NOT EXISTS `comment_group` (
  `id_comment_group` int(11) NOT NULL AUTO_INCREMENT,
  `text_comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_comment_group`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_group`
--

INSERT INTO `comment_group` (`id_comment_group`, `text_comment`, `date_comment`, `id_group`, `id_user`) VALUES
(8, 'Vous êtes les bienvenus même si vous êtes un étudiant ou si vous voulez devenir développeur.', '2021-06-14 19:53:02', 3, 32);

-- --------------------------------------------------------

--
-- Table structure for table `comment_post`
--

DROP TABLE IF EXISTS `comment_post`;
CREATE TABLE IF NOT EXISTS `comment_post` (
  `id_comment_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text_comment_post` longtext NOT NULL,
  `date_comment_post` datetime NOT NULL,
  `signalized` varchar(10) DEFAULT 'non',
  `blocked` varchar(10) DEFAULT 'non',
  PRIMARY KEY (`id_comment_post`),
  --KEY `fk_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment_post`
--

INSERT INTO `comment_post` (`id_comment_post`, `id_post`, `id_user`, `text_comment_post`, `date_comment_post`, `signalized`, `blocked`) VALUES
(1, 100, 32, 'Je commente mon propre post pour un test', '2021-06-14 20:38:01', 'non', 'non'),
(2, 100, 32, 'test', '2021-06-14 20:42:07', 'non', 'non');

-- --------------------------------------------------------

--
-- Table structure for table `comment_story`
--

DROP TABLE IF EXISTS `comment_story`;
CREATE TABLE IF NOT EXISTS `comment_story` (
  `id_comment_story` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `tittle_comment_story` varchar(250) NOT NULL,
  `text_comment_story` longtext NOT NULL,
  `date_comment_story` datetime NOT NULL,
  `signalized` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_comment_story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `connected`
--

DROP TABLE IF EXISTS `connected`;
CREATE TABLE IF NOT EXISTS `connected` (
  `id_connected` int(11) NOT NULL AUTO_INCREMENT,
  `str_connect` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_connected`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `connected`
--

INSERT INTO `connected` (`id_connected`, `str_connect`, `id_user`) VALUES
(32, 1623698626, 32);

-- --------------------------------------------------------

--
-- Table structure for table `dislike_post`
--

DROP TABLE IF EXISTS `dislike_post`;
CREATE TABLE IF NOT EXISTS `dislike_post` (
  `id_dislike_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_dislike_post`),
  --KEY `fk_dislikePost_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dislike_post`
--

INSERT INTO `dislike_post` (`id_dislike_post`, `id_user`, `id_post`) VALUES
(1, 32, 99);

-- --------------------------------------------------------

--
-- Table structure for table `events`
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `id_user_creator`, `title_event`, `text_event`, `date_event`, `city_event`, `img_event`, `public_event`, `signalized`, `blocked`) VALUES
(1, 1, 'COMICcon 2021', 'Invitation pour la Comic con de San Diego.\nRendez vous Aéroport Orly entrée C', '2021-08-08 19:07:00', 'Paris - San Diego', 'sandiego.jpg', 'oui', 'non', 'non');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

DROP TABLE IF EXISTS `friend`;
CREATE TABLE IF NOT EXISTS `friend` (
  `id_follow` int(11) NOT NULL AUTO_INCREMENT,
  `id_follower` int(11) NOT NULL,
  `id_followed` int(11) NOT NULL,
  `confirmed` varchar(10) NOT NULL,
  PRIMARY KEY (`id_follow`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(250) NOT NULL,
  `description` mediumtext NOT NULL,
  `img_group` varchar(250) NOT NULL,
  `id_user_create` int(11) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id_group`, `name_group`, `description`, `img_group`, `id_user_create`) VALUES
(3, 'Les développeurs en folie', 'Comme vous l\'aurez deviné notre point commun c\'est d\'être développeur. Ici on parle de tout mais surtout de code.', 'groupedev.jpg', 32);

-- --------------------------------------------------------

--
-- Table structure for table `images_posts`
--

DROP TABLE IF EXISTS `images_posts`;
CREATE TABLE IF NOT EXISTS `images_posts` (
  `id_images_posts` int(11) NOT NULL AUTO_INCREMENT,
  `id_img_post` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_images_posts`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `images_stories`
--

DROP TABLE IF EXISTS `images_stories`;
CREATE TABLE IF NOT EXISTS `images_stories` (
  `id_images_stories` int(11) NOT NULL AUTO_INCREMENT,
  `id_img_story` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  PRIMARY KEY (`id_images_stories`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image_post`
--

DROP TABLE IF EXISTS `image_post`;
CREATE TABLE IF NOT EXISTS `image_post` (
  `id_image_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_image_post` varchar(200) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image_post`),
  KEY `fk_image_post_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_post`
--

INSERT INTO `image_post` (`id_image_post`, `id_post`, `id_user`, `name_image_post`, `chemin`) VALUES
(9, 99, 32, 'digue3.jpg', 'assets/images/upload/post/99'),
(10, 99, 32, 'digue5.jpg', 'assets/images/upload/post/99'),
(11, 100, 32, 'Cape-Reinga3.jpg', 'assets/images/upload/post/100'),
(12, 100, 32, 'Réserve-te1.jpg', 'assets/images/upload/post/100');

-- --------------------------------------------------------

--
-- Table structure for table `img_post`
--

DROP TABLE IF EXISTS `img_post`;
CREATE TABLE IF NOT EXISTS `img_post` (
  `id_img_post` int(11) NOT NULL AUTO_INCREMENT,
  `image_post` varchar(250) NOT NULL,
  `descript_post` varchar(250) NOT NULL,
  PRIMARY KEY (`id_img_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `img_story`
--

DROP TABLE IF EXISTS `img_story`;
CREATE TABLE IF NOT EXISTS `img_story` (
  `id_img_story` int(11) NOT NULL AUTO_INCREMENT,
  `image_story` varchar(250) NOT NULL,
  `descript_story` varchar(250) NOT NULL,
  PRIMARY KEY (`id_img_story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `like_event`
--

DROP TABLE IF EXISTS `like_event`;
CREATE TABLE IF NOT EXISTS `like_event` (
  `id_like_event` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) NOT NULL,
  `like_event` int(11) NOT NULL,
  `dislike_event` int(11) NOT NULL,
  PRIMARY KEY (`id_like_event`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `like_post`
--

DROP TABLE IF EXISTS `like_post`;
CREATE TABLE IF NOT EXISTS `like_post` (
  `id_like_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_like_post`),
  KEY `fk_like_post_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `like_post`
--

INSERT INTO `like_post` (`id_like_post`, `id_post`, `id_user`) VALUES
(2, 100, 32);

-- --------------------------------------------------------

--
-- Table structure for table `part_event`
--

DROP TABLE IF EXISTS `part_event`;
CREATE TABLE IF NOT EXISTS `part_event` (
  `id_part_event` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_part_event`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `text_post` longtext CHARACTER SET utf8mb4 NOT NULL,
  `date_post` datetime NOT NULL,
  `public` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `signalized` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `blocked` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `image_post` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `video_post` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `story_post` varchar(3) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `text_post`, `date_post`, `public`, `signalized`, `blocked`, `image_post`, `video_post`, `story_post`) VALUES
(99, 32, 'De retour du paradis des Seychelles avec plein de photos dans la tête mais aussi dans le disque dur 😉😍😍\n', '2021-06-14 19:40:34', 'non', 'non', 'non', 'oui', 'non', 'non'),
(100, 32, 'La Nouvelle-Zélande \n\nEncore une île? On se refait pas.... 😇\n', '2021-06-14 19:44:18', 'non', 'non', 'non', 'oui', 'non', 'non');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `name`, `lastname`, `avatar`, `city`, `country`, `birth`, `creation`, `role`, `blocked`, `period_block`, `banner`) VALUES
(32, 'emmanuel.cabassot@laplateforme.io', '$2y$04$9t14sAfAnCdIS0tax9Pe3eqIgZxM3RKh7syjEdW2xTZbFblkUAkLC', 'Emmanuel', 'Cabassot', 'profilEmmanuel.jpg', 'Marseille', 'France', '1979-02-01', '2021-06-14', 'user', 'non', '0001-01-01', 'defaultbanner.png');

-- --------------------------------------------------------

--
-- Table structure for table `video_post`
--

DROP TABLE IF EXISTS `video_post`;
CREATE TABLE IF NOT EXISTS `video_post` (
  `id_video_post` int(11) NOT NULL AUTO_INCREMENT,
  `name_video_post` varchar(200) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_video_post`),
  KEY `fk_video_post_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dislike_post`
--
ALTER TABLE `dislike_post`
  ADD CONSTRAINT `fk_dislikePost_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Constraints for table `video_post`
--
ALTER TABLE `video_post`
  ADD CONSTRAINT `fk_video_post_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
