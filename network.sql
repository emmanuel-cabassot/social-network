-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 30 avr. 2021 à 08:08
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
CREATE DATABASE IF NOT EXISTS `network` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `network`;

-- --------------------------------------------------------

--
-- Structure de la table `belong`
--

DROP TABLE IF EXISTS `belong`;
CREATE TABLE IF NOT EXISTS `belong` (
  `id_belong` int(11) NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_belong`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comment_post`
--

DROP TABLE IF EXISTS `comment_post`;
CREATE TABLE IF NOT EXISTS `comment_post` (
  `id_comment_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title_comment_post` varchar(100) NOT NULL,
  `text_comment_post` longtext NOT NULL,
  `date_comment_post` datetime NOT NULL,
  `signalized` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_comment_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comment_story`
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
-- Structure de la table `connected`
--

DROP TABLE IF EXISTS `connected`;
CREATE TABLE IF NOT EXISTS `connected` (
  `id_connected` int(11) NOT NULL AUTO_INCREMENT,
  `str_connect` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_connected`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title_event` varchar(200) NOT NULL,
  `text_event` mediumtext NOT NULL,
  `date_event` datetime NOT NULL,
  `public_event` tinyint(1) NOT NULL,
  `signalized` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `friend`
--

DROP TABLE IF EXISTS `friend`;
CREATE TABLE IF NOT EXISTS `friend` (
  `id_friend` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_user_friend` int(11) NOT NULL,
  PRIMARY KEY (`id_friend`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `name_group` varchar(250) NOT NULL,
  `description` mediumtext NOT NULL,
  `img_group` varchar(250) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `images_posts`
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
-- Structure de la table `images_stories`
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
-- Structure de la table `img_post`
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
-- Structure de la table `img_story`
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
-- Structure de la table `like_event`
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
-- Structure de la table `like_post`
--

DROP TABLE IF EXISTS `like_post`;
CREATE TABLE IF NOT EXISTS `like_post` (
  `id_like_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `liked` int(11) NOT NULL,
  `disliked` int(11) NOT NULL,
  PRIMARY KEY (`id_like_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `like_story`
--

DROP TABLE IF EXISTS `like_story`;
CREATE TABLE IF NOT EXISTS `like_story` (
  `id_like_story` int(11) NOT NULL AUTO_INCREMENT,
  `id_story` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `liked` int(11) NOT NULL,
  `disliked` int(11) NOT NULL,
  PRIMARY KEY (`id_like_story`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `part_event`
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
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title_post` varchar(250) NOT NULL,
  `text_post` longtext NOT NULL,
  `date_post` datetime NOT NULL,
  `public` tinyint(1) NOT NULL,
  `signalized` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  `video` varchar(250) NOT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `story`
--

DROP TABLE IF EXISTS `story`;
CREATE TABLE IF NOT EXISTS `story` (
  `id_story` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
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
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` int(250) NOT NULL,
  `name` varchar(200) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `birth` date NOT NULL,
  `creation` date NOT NULL,
  `role` varchar(100) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  `period_bock` date NOT NULL,
  `banner` varchar(200) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
