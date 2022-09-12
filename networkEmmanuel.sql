-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 12 sep. 2022 à 20:51
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

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
CREATE DATABASE IF NOT EXISTS `network` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `belong`
--

INSERT INTO `belong` (`id_belong`, `id_group`, `id_user`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(14, 2, 1),
(16, 3, 32),
(17, 4, 33),
(18, 5, 32),
(19, 6, 38),
(20, 4, 32);

-- --------------------------------------------------------

--
-- Structure de la table `comment_event`
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
-- Structure de la table `comment_group`
--

DROP TABLE IF EXISTS `comment_group`;
CREATE TABLE IF NOT EXISTS `comment_group` (
  `id_comment_group` int(11) NOT NULL AUTO_INCREMENT,
  `text_comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_comment_group`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment_group`
--

INSERT INTO `comment_group` (`id_comment_group`, `text_comment`, `date_comment`, `id_group`, `id_user`) VALUES
(9, 'fdsqqs', '2021-06-16 22:02:30', 4, 33),
(8, 'Vous êtes les bienvenus même si vous êtes un étudiant ou si vous voulez devenir développeur.', '2021-06-14 19:53:02', 3, 32),
(10, 'kl,lkl', '2022-05-17 01:07:20', 4, 32);

-- --------------------------------------------------------

--
-- Structure de la table `comment_post`
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
  KEY `fk_commentPost_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment_post`
--

INSERT INTO `comment_post` (`id_comment_post`, `id_post`, `id_user`, `text_comment_post`, `date_comment_post`, `signalized`, `blocked`) VALUES
(43, 139, 32, 'Je pense que ton homme va apprécier la surprise lol', '2021-07-18 21:56:24', 'non', 'non'),
(44, 139, 33, 'Je m\'invite tout le week-end alors. Comme ça je pourrai t\'aider pour les caresses.\nJe ramène une pelote de laine.', '2021-07-18 22:00:08', 'non', 'non'),
(45, 144, 32, 'D\'un côté j\'ai hâte de pouvoir l\'utiliser, de l\'autre y\'aura besoin de moins\nde développeurs vu que l\'on sera plus productif.\nOui mais non ça a vraiment l\'air trop efficace.  ', '2021-07-18 22:08:17', 'non', 'non'),
(46, 141, 32, 'Welcome home Mélanie.\nPas trop triste de rentrer?', '2021-07-18 22:09:06', 'non', 'non'),
(49, 139, 35, 'Oui, oui. On va pouponner.\nMême si je pense que le terme n\'est pas le bon.\nSi tu as une petite lampe aussi.', '2021-07-18 22:13:17', 'non', 'non'),
(53, 141, 35, 'Apéro ce Samedi?', '2021-07-18 22:21:23', 'non', 'non'),
(54, 144, 36, 'Allez, au chômage.\nVous pourrez toujours faire des sites wordPress lol.', '2021-07-19 07:36:32', 'non', 'non'),
(55, 140, 36, 'Pas assez flashy pour moi.', '2021-07-19 07:37:21', 'non', 'non'),
(59, 144, 32, 'jkmkmmkmkjmkn\n\n\njiopjiop*', '2021-07-19 12:43:40', 'non', 'non'),
(61, 150, 32, 'Dire que c\'était la mer avant :)', '2022-05-17 00:58:10', 'non', 'non'),
(62, 139, 32, 'Pour aspirer le chat?', '2022-05-17 00:58:53', 'non', 'non'),
(63, 139, 32, 'test', '2022-05-17 00:59:25', 'non', 'non'),
(64, 161, 32, 'blabla', '2022-05-29 23:21:43', 'non', 'non'),
(65, 161, 32, 'dkdk', '2022-05-29 23:22:41', 'non', 'non'),
(70, 140, 32, 'jkldfsjldmjs', '2022-06-12 16:49:22', 'non', 'non'),
(71, 140, 32, 'jlkfjld', '2022-06-12 16:49:26', 'non', 'non'),
(72, 166, 32, 'kmdfkmlms', '2022-06-12 16:51:48', 'non', 'non'),
(73, 166, 32, 'bhjgjhgjk', '2022-06-12 16:52:44', 'non', 'non'),
(75, 150, 32, 'jdkjfslm', '2022-08-03 17:56:38', 'non', 'non'),
(76, 168, 32, 'dfjmlf', '2022-08-03 18:01:27', 'non', 'non'),
(77, 168, 32, 'fdflgjfjsgm', '2022-08-03 18:01:53', 'non', 'non'),
(78, 168, 32, 'dkfdjmds', '2022-08-03 18:02:07', 'non', 'non'),
(79, 168, 32, 'blop blop', '2022-08-03 18:02:44', 'non', 'non'),
(80, 162, 32, 'njknknk', '2022-08-03 23:33:40', 'non', 'non'),
(81, 139, 32, 'THGDFHSD', '2022-08-04 00:41:01', 'non', 'non'),
(82, 173, 32, 'jkhjkhkhjlk\njkkjlkhjkhklj', '2022-08-05 07:59:36', 'non', 'non'),
(83, 173, 32, 'rflmzerglmkez', '2022-08-05 07:59:40', 'non', 'non'),
(84, 173, 32, 'fjkvjklqsd', '2022-08-05 07:59:47', 'non', 'non'),
(85, 173, 32, 'ildsfjmsjqml', '2022-08-05 08:00:00', 'non', 'non'),
(86, 173, 32, 'djfjldsjkf', '2022-08-05 08:00:11', 'non', 'non'),
(87, 175, 35, 'Trop biien, bonne vacance !!', '2022-08-05 08:20:22', 'non', 'non'),
(88, 179, 33, 'dkfsklmjmdflsq', '2022-08-05 08:37:26', 'non', 'non'),
(90, 180, 33, 'super post', '2022-08-05 08:37:58', 'non', 'non'),
(91, 178, 32, 'dfjskljsdl', '2022-08-05 08:41:04', 'non', 'non'),
(92, 176, 32, 'gkljfjgdklm', '2022-08-05 08:41:22', 'non', 'non'),
(93, 176, 32, 'mauvais scommmentaire', '2022-08-05 08:41:27', 'non', 'non'),
(94, 166, 32, 'FJGDJFLMFDS', '2022-08-05 09:41:08', 'non', 'non'),
(95, 180, 32, 'KLJDFIJISDSDFDS', '2022-08-05 09:42:00', 'non', 'non');

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
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connected`
--

INSERT INTO `connected` (`id_connected`, `str_connect`, `id_user`) VALUES
(140, 1659694901, 32),
(138, 1659688435, 33);

-- --------------------------------------------------------

--
-- Structure de la table `dislike_post`
--

DROP TABLE IF EXISTS `dislike_post`;
CREATE TABLE IF NOT EXISTS `dislike_post` (
  `id_dislike_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_dislike_post`),
  KEY `fk_dislikePost_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dislike_post`
--

INSERT INTO `dislike_post` (`id_dislike_post`, `id_user`, `id_post`) VALUES
(15, 36, 144),
(16, 36, 140),
(21, 32, 139),
(26, 32, 140),
(27, 32, 166),
(28, 32, 144),
(29, 32, 162),
(32, 32, 141),
(33, 32, 171),
(34, 32, 169),
(35, 32, 172),
(37, 35, 173),
(38, 33, 180),
(39, 33, 178),
(42, 32, 164),
(43, 32, 180);

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
(1, 1, 'COMICcon 2021', 'Invitation pour la Comic con de San Diego.\nRendez vous Aéroport Orly entrée C', '2021-08-08 19:07:00', 'Paris - San Diego', 'sandiego.jpg', 'oui', 'non', 'non'),
(2, 38, 'allons nous jeter dans la riviére!', 'Rendez vous au pont de tancarville, préparez vos ulm, parachutes, ailes...', '2021-08-30 16:21:00', 'Tancarville', 'pontdetancarville-960x640.jpg', 'oui', 'non', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `friend`
--

DROP TABLE IF EXISTS `friend`;
CREATE TABLE IF NOT EXISTS `friend` (
  `id_follow` int(11) NOT NULL AUTO_INCREMENT,
  `id_follower` int(11) NOT NULL,
  `id_followed` int(11) NOT NULL,
  `confirmed` varchar(10) NOT NULL,
  PRIMARY KEY (`id_follow`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friend`
--

INSERT INTO `friend` (`id_follow`, `id_follower`, `id_followed`, `confirmed`) VALUES
(64, 32, 35, 'oui'),
(71, 32, 33, 'non'),
(73, 32, 36, 'non'),
(65, 35, 33, 'oui'),
(68, 36, 35, 'non'),
(69, 33, 36, 'oui'),
(70, 37, 36, 'oui'),
(72, 38, 32, 'oui');

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
  `id_user_create` int(11) NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_group`, `name_group`, `description`, `img_group`, `id_user_create`) VALUES
(4, 'fgfgqf', 'fsqfq', 'groupedev.jpg', 33),
(3, 'Les développeurs en folie', 'Comme vous l\'aurez deviné notre point commun c\'est d\'être développeur. Ici on parle de tout mais surtout de code.', 'groupedev.jpg', 32),
(5, 'tgtrgtrz', 'gqfqgf', 'profilEmmanuel.jpg', 32),
(6, 'les amis du web', 'Sauvons les meubles!', 'black-hole-simulation.webp', 38);

-- --------------------------------------------------------

--
-- Structure de la table `image_post`
--

DROP TABLE IF EXISTS `image_post`;
CREATE TABLE IF NOT EXISTS `image_post` (
  `id_image_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_image_post` varchar(200) NOT NULL,
  `chemin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image_post`),
  KEY `fk_imagePost_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image_post`
--

INSERT INTO `image_post` (`id_image_post`, `id_post`, `id_user`, `name_image_post`, `chemin`) VALUES
(25, 139, 35, 'chaton2.jpg', 'assets/images/upload/post/139'),
(26, 140, 35, 'arbre.jpg', 'assets/images/upload/post/140'),
(27, 141, 36, 'welcome.jpg', 'assets/images/upload/post/141'),
(30, 144, 33, '8IR-4FUVt.jpeg', 'assets/images/upload/post/144'),
(34, 150, 38, 'abstract_background_beach_coast_desert_desolate_dry_603502.jpg', 'assets/images/upload/post/150'),
(39, 154, 32, 'voyages.png', 'assets/images/upload/post/154'),
(43, 159, 32, 'GitHub.png', 'assets/images/upload/post/159'),
(44, 161, 32, 'sql.png', 'assets/images/upload/post/161'),
(45, 162, 32, 'profilewhite.png', 'assets/images/upload/post/162'),
(46, 164, 32, 'CvEMMANUELCABASSOT.png', 'assets/images/upload/post/164'),
(48, 166, 32, 'chaton1.jpg', 'assets/images/upload/post/166'),
(49, 168, 32, 'rencontredu3emtype.jpg', 'assets/images/upload/post/168'),
(50, 169, 32, 'api-platform(1).png', 'assets/images/upload/post/169'),
(51, 170, 32, 'api-platform(1).png', 'assets/images/upload/post/170'),
(52, 172, 32, 'rencontredu3emtype.jpg', 'assets/images/upload/post/172'),
(53, 173, 32, 'voyages.png', 'assets/images/upload/post/173'),
(54, 174, 35, 'symfony_black_02.png', 'assets/images/upload/post/174'),
(55, 175, 35, 'seychelles.jpg', 'assets/images/upload/post/175'),
(56, 177, 35, 'ToDoList.png', 'assets/images/upload/post/177'),
(57, 178, 35, 'boutiqueConnexionXS.png', 'assets/images/upload/post/178'),
(58, 180, 33, 'racket.jpg', 'assets/images/upload/post/180'),
(59, 181, 32, 'crudAdmPosts.png', 'assets/images/upload/post/181');

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
  PRIMARY KEY (`id_like_post`),
  KEY `fk_like_post` (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `like_post`
--

INSERT INTO `like_post` (`id_like_post`, `id_post`, `id_user`) VALUES
(22, 144, 33),
(27, 141, 35),
(31, 141, 33),
(32, 140, 33),
(33, 139, 33),
(36, 139, 36),
(42, 154, 32),
(49, 163, 32),
(50, 150, 32),
(52, 167, 32),
(53, 168, 32),
(55, 170, 32),
(57, 173, 32),
(59, 177, 35),
(60, 175, 35),
(61, 174, 35),
(62, 179, 33);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `part_event`
--

INSERT INTO `part_event` (`id_part_event`, `id_event`, `id_user`) VALUES
(1, 2, 38);

-- --------------------------------------------------------

--
-- Structure de la table `post`
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
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `text_post`, `date_post`, `public`, `signalized`, `blocked`, `image_post`, `video_post`, `story_post`) VALUES
(139, 35, 'Tout juste adopté 😁😁\n', '2021-07-18 17:42:25', 'non', 'non', 'non', 'oui', 'non', 'non'),
(140, 35, 'Un avis sur cet arbre à chat ?\n', '2021-07-18 17:44:41', 'non', 'oui', 'non', 'oui', 'non', 'non'),
(141, 36, 'De retour au pays !\n', '2021-07-18 17:49:23', 'non', 'oui', 'non', 'oui', 'non', 'non'),
(144, 33, 'Copilot.... Moi en tant que développeur ca me fait peur.\n', '2021-07-18 22:04:34', 'non', 'oui', 'non', 'oui', 'non', 'non'),
(150, 38, 'Bon, aujourd\'hui il pleut, demain peut être soleil?', '2021-08-04 16:28:30', 'non', 'oui', 'non', 'oui', 'non', 'non'),
(154, 32, '😍😊😆😀Re test😇😇😇😇', '2022-05-17 01:06:11', 'non', 'non', 'non', 'oui', 'non', 'non'),
(159, 32, '😇😇gitHub😆😀 ', '2022-05-29 23:07:25', 'non', 'non', 'non', 'oui', 'non', 'non'),
(160, 32, '😇😆😀 dfdsdf😄😄😄', '2022-05-29 23:13:45', 'non', 'non', 'non', 'oui', 'non', 'non'),
(161, 32, 'SQL pour la vie 😇', '2022-05-29 23:15:34', 'non', 'non', 'non', 'oui', 'non', 'non'),
(162, 32, 'logo ', '2022-05-30 00:13:49', 'non', 'non', 'non', 'oui', 'non', 'non'),
(163, 32, 'fsdfq', '2022-05-30 00:22:01', 'non', 'non', 'non', 'non', 'non', 'non'),
(164, 32, 'Un cv tout beau 😆😀😄😇', '2022-05-30 00:47:37', 'non', 'non', 'non', 'oui', 'non', 'non'),
(166, 32, 'komfkgkdslmkm  😇😆😀😄', '2022-06-12 16:51:42', 'non', 'non', 'non', 'oui', 'non', 'oui'),
(167, 32, 'Soirée film avec Mamie et les enfants 😆😀\nRencontre du 3em type', '2022-08-03 18:00:17', 'non', 'non', 'non', 'non', 'non', 'non'),
(168, 32, 'Soirée film avec Mamie et les enfants 😆😀\nRencontre du 3em type', '2022-08-03 18:01:06', 'non', 'non', 'non', 'oui', 'non', 'non'),
(169, 32, 'C\'est un bon bundle de symfony pour créer des Api ', '2022-08-03 19:00:24', 'non', 'non', 'non', 'oui', 'non', 'non'),
(170, 32, 'jdfsmdskm', '2022-08-03 23:04:47', 'non', 'non', 'non', 'oui', 'non', 'non'),
(171, 32, 'kl,fmm,m', '2022-08-03 23:46:41', 'non', 'non', 'non', 'non', 'non', 'non'),
(172, 32, '', '2022-08-03 23:50:50', 'non', 'non', 'non', 'oui', 'non', 'non'),
(173, 32, 'kjlrjekmjfekmlfja 😇😆😀', '2022-08-05 07:59:23', 'non', 'non', 'non', 'oui', 'non', 'oui'),
(174, 35, 'Aujourd\'hui je me lance sur le framework Symfony', '2022-08-05 08:12:44', 'non', 'oui', 'non', 'oui', 'non', 'oui'),
(175, 35, 'Voyage au paradis.\nVous voulez venir avec moi?', '2022-08-05 08:17:04', 'non', 'oui', 'non', 'oui', 'non', 'non'),
(176, 35, 'Salut,\nBonne chance pour l\'examen !', '2022-08-05 08:18:12', 'non', 'non', 'non', 'non', 'non', 'oui'),
(177, 35, 'My to do list', '2022-08-05 08:19:26', 'non', 'non', 'non', 'oui', 'non', 'non'),
(178, 35, 'A tte, 😜🤩', '2022-08-05 08:23:18', 'non', 'non', 'non', 'oui', 'non', 'non'),
(179, 35, 'Hello l Plateforme !!!🤩😊', '2022-08-05 08:24:12', 'non', 'non', 'non', 'non', 'non', 'oui'),
(180, 33, 'Mon grand bonheur la chance,\n\nGrande soirée de ping pong a coup de victoire sql. 🤣', '2022-08-05 08:37:03', 'non', 'oui', 'non', 'oui', 'non', 'non'),
(181, 32, 'DSFJKLDSJJMLDSJQFLMK 🙂🤪', '2022-08-05 09:43:13', 'non', 'non', 'non', 'oui', 'non', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `name`, `lastname`, `avatar`, `city`, `country`, `birth`, `creation`, `role`, `blocked`, `period_block`, `banner`) VALUES
(35, 'aouicha@hotmail.fr', '$2y$04$CYZ/FQ2b2oMMxGbKW.CiVefrfF32KtXzCCh.xSjV8o/KDG8U2ocEC', 'BELID', 'Aouicha', 'chaton1.jpg', 'Marseille', 'FRANCE', '1983-03-20', '2021-07-15', 'admin', 'non', '2209-01-11', 'defaultbanner.png'),
(33, 'lou@hotmail.fr', '$2y$04$xXUid05gNnL.OjLYW1iC6OOJdX5kx.0g6a3DHOihIvycRwk2/1Oo2', 'Lou', 'Cabassot', 'default.png', 'Marseille', 'France', '2012-06-03', '2021-06-16', 'user', 'non', '0001-01-01', 'defaultbanner.png'),
(32, 'emmanuel.cabassot@laplateforme.io', '$2y$04$9t14sAfAnCdIS0tax9Pe3eqIgZxM3RKh7syjEdW2xTZbFblkUAkLC', 'Emmanuel', 'Cabassot', 'profilEmmanuel.jpg', 'Marseille', 'France', '1979-02-01', '2021-06-14', 'admin', 'non', '0001-01-01', 'defaultbanner.png'),
(36, 'melanie@camoin.fr', '$2y$04$8Nc2MNUymJflqDdcyo7lK.2w3QdN.QpRO907jHt8o76beN5R5UeMe', 'CAMOIN', 'Mélanie', 'drapeau.png', 'Sydney', 'Australia', '1986-11-05', '2021-07-18', 'user', 'oui', '0014-09-16', 'defaultbanner.png'),
(37, 'troll@hotmail.fr', '$2y$04$C3BKu9OLCDx.Mn6TCIkImeqfNybUG.yCQJXa8BLVKMsG9hTCJ4fUe', 'Troll', 'Forever', 'les-trolls-de-la-vie-reelle.jpg', 'Paris', 'France', '2000-02-01', '2021-07-19', 'user', 'non', '0001-01-01', 'defaultbanner.png'),
(38, 'denkrus@yahoo.com', '$2y$04$zy3UH0D0ipP6fTB1EyM8me8USOOOS05gqN1lg6sPdJVpHXTlfiKny', 'denis', 'farkas', 'default.png', 'Marseille', 'France', '1939-10-10', '2021-08-04', 'user', 'non', '0001-01-01', 'defaultbanner.png');

-- --------------------------------------------------------

--
-- Structure de la table `video_post`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment_post`
--
ALTER TABLE `comment_post`
  ADD CONSTRAINT `fk_commentPost_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Contraintes pour la table `dislike_post`
--
ALTER TABLE `dislike_post`
  ADD CONSTRAINT `fk_dislikePost_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Contraintes pour la table `image_post`
--
ALTER TABLE `image_post`
  ADD CONSTRAINT `fk_imagePost_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Contraintes pour la table `like_post`
--
ALTER TABLE `like_post`
  ADD CONSTRAINT `fk_like_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;

--
-- Contraintes pour la table `video_post`
--
ALTER TABLE `video_post`
  ADD CONSTRAINT `fk_video_post_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
