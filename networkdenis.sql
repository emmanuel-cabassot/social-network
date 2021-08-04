-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 04 août 2021 à 17:28
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.8

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
-- Structure de la table `belong`
--

CREATE TABLE `belong` (
  `id_belong` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
(19, 6, 38);

-- --------------------------------------------------------

--
-- Structure de la table `comment_event`
--

CREATE TABLE `comment_event` (
  `id_comment_event` int(11) NOT NULL,
  `text_comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comment_group`
--

CREATE TABLE `comment_group` (
  `id_comment_group` int(11) NOT NULL,
  `text_comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment_group`
--

INSERT INTO `comment_group` (`id_comment_group`, `text_comment`, `date_comment`, `id_group`, `id_user`) VALUES
(9, 'fdsqqs', '2021-06-16 22:02:30', 4, 33),
(8, 'Vous êtes les bienvenus même si vous êtes un étudiant ou si vous voulez devenir développeur.', '2021-06-14 19:53:02', 3, 32);

-- --------------------------------------------------------

--
-- Structure de la table `comment_post`
--

CREATE TABLE `comment_post` (
  `id_comment_post` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text_comment_post` longtext NOT NULL,
  `date_comment_post` datetime NOT NULL,
  `signalized` varchar(10) DEFAULT 'non',
  `blocked` varchar(10) DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment_post`
--

INSERT INTO `comment_post` (`id_comment_post`, `id_post`, `id_user`, `text_comment_post`, `date_comment_post`, `signalized`, `blocked`) VALUES
(43, 139, 32, 'Je pense que ton homme va apprécier la surprise lol', '2021-07-18 21:56:24', 'non', 'non'),
(44, 139, 33, 'Je m\'invite tout le week-end alors. Comme ça je pourrai t\'aider pour les caresses.\nJe ramène une pelote de laine.', '2021-07-18 22:00:08', 'non', 'non'),
(45, 144, 32, 'D\'un côté j\'ai hâte de pouvoir l\'utiliser, de l\'autre y\'aura besoin de moins\nde développeurs vu que l\'on sera plus productif.\nOui mais non ça a vraiment l\'air trop efficace.  ', '2021-07-18 22:08:17', 'oui', 'non'),
(46, 141, 32, 'Welcome home Mélanie.\nPas trop triste de rentrer?', '2021-07-18 22:09:06', 'non', 'non'),
(47, 140, 32, 'Tu vas prendre un chat?', '2021-07-18 22:09:42', 'oui', 'non'),
(49, 139, 35, 'Oui, oui. On va pouponner.\nMême si je pense que le terme n\'est pas le bon.\nSi tu as une petite lampe aussi.', '2021-07-18 22:13:17', 'non', 'non'),
(50, 143, 35, 'Ça donne vraiment envie.\nCela fait partie de mes projets.\nDans 2 ans si le gouvernement nous le permet.', '2021-07-18 22:15:29', 'non', 'non'),
(51, 142, 35, 'On dirait Marseille......\nNon je plaisante, c\'est vraiment beau.\nTu m\'amènes avec toi la prochaine fois?', '2021-07-18 22:16:57', 'non', 'non'),
(52, 144, 35, 'Ça y est une nouvelle techno sort et les voilà déjà tous en stresse.\nCalmer vous un peu. Vous avez dit pareil pour WordPress. ', '2021-07-18 22:20:16', 'non', 'non'),
(53, 141, 35, 'Apéro ce Samedi?', '2021-07-18 22:21:23', 'non', 'non'),
(54, 144, 36, 'Allez, au chômage.\nVous pourrez toujours faire des sites wordPress lol.', '2021-07-19 07:36:32', 'non', 'non'),
(55, 140, 36, 'Pas assez flashy pour moi.', '2021-07-19 07:37:21', 'non', 'non'),
(56, 139, 36, 'Aspirateur robot en prévision.', '2021-07-19 07:38:15', 'non', 'non'),
(59, 144, 32, 'jkmkmmkmkjmkn\n\n\njiopjiop*', '2021-07-19 12:43:40', 'non', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `comment_story`
--

CREATE TABLE `comment_story` (
  `id_comment_story` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_story` int(11) NOT NULL,
  `tittle_comment_story` varchar(250) NOT NULL,
  `text_comment_story` longtext NOT NULL,
  `date_comment_story` datetime NOT NULL,
  `signalized` tinyint(1) NOT NULL,
  `blocked` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `connected`
--

CREATE TABLE `connected` (
  `id_connected` int(11) NOT NULL,
  `str_connect` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connected`
--

INSERT INTO `connected` (`id_connected`, `str_connect`, `id_user`) VALUES
(111, 1628084402, 38);

-- --------------------------------------------------------

--
-- Structure de la table `dislike_post`
--

CREATE TABLE `dislike_post` (
  `id_dislike_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dislike_post`
--

INSERT INTO `dislike_post` (`id_dislike_post`, `id_user`, `id_post`) VALUES
(14, 32, 140),
(15, 36, 144),
(16, 36, 140);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `id_user_creator` int(11) NOT NULL,
  `title_event` varchar(200) NOT NULL,
  `text_event` mediumtext NOT NULL,
  `date_event` datetime NOT NULL,
  `city_event` varchar(250) NOT NULL,
  `img_event` varchar(250) NOT NULL,
  `public_event` varchar(3) NOT NULL,
  `signalized` varchar(3) NOT NULL,
  `blocked` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

CREATE TABLE `friend` (
  `id_follow` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL,
  `id_followed` int(11) NOT NULL,
  `confirmed` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `friend`
--

INSERT INTO `friend` (`id_follow`, `id_follower`, `id_followed`, `confirmed`) VALUES
(64, 32, 35, 'oui'),
(71, 32, 33, 'non'),
(67, 36, 32, 'oui'),
(65, 35, 33, 'oui'),
(68, 36, 35, 'non'),
(69, 33, 36, 'oui'),
(70, 37, 36, 'oui'),
(72, 38, 32, 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_group` int(11) NOT NULL,
  `name_group` varchar(250) NOT NULL,
  `description` mediumtext NOT NULL,
  `img_group` varchar(250) NOT NULL,
  `id_user_create` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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

CREATE TABLE `image_post` (
  `id_image_post` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_image_post` varchar(200) NOT NULL,
  `chemin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `image_post`
--

INSERT INTO `image_post` (`id_image_post`, `id_post`, `id_user`, `name_image_post`, `chemin`) VALUES
(25, 139, 35, 'chaton2.jpg', 'assets/images/upload/post/139'),
(26, 140, 35, 'arbre.jpg', 'assets/images/upload/post/140'),
(27, 141, 36, 'welcome.jpg', 'assets/images/upload/post/141'),
(28, 142, 32, 'digue4.jpg', 'assets/images/upload/post/142'),
(29, 143, 32, 'Cape-Reinga1.jpg', 'assets/images/upload/post/143'),
(30, 144, 33, '8IR-4FUVt.jpeg', 'assets/images/upload/post/144'),
(32, 147, 32, 'les-trolls-de-la-vie-reelle.jpg', 'assets/images/upload/post/147'),
(33, 148, 32, 'les-trolls-de-la-vie-reelle.jpg', 'assets/images/upload/post/148'),
(34, 150, 38, 'abstract_background_beach_coast_desert_desolate_dry_603502.jpg', 'assets/images/upload/post/150');

-- --------------------------------------------------------

--
-- Structure de la table `like_event`
--

CREATE TABLE `like_event` (
  `id_like_event` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `like_event` int(11) NOT NULL,
  `dislike_event` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `like_post`
--

CREATE TABLE `like_post` (
  `id_like_post` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `like_post`
--

INSERT INTO `like_post` (`id_like_post`, `id_post`, `id_user`) VALUES
(21, 139, 32),
(22, 144, 33),
(24, 141, 32),
(25, 143, 35),
(26, 142, 35),
(27, 141, 35),
(29, 143, 33),
(30, 142, 33),
(31, 141, 33),
(32, 140, 33),
(33, 139, 33),
(34, 143, 36),
(35, 142, 36),
(36, 139, 36),
(37, 144, 32);

-- --------------------------------------------------------

--
-- Structure de la table `part_event`
--

CREATE TABLE `part_event` (
  `id_part_event` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `part_event`
--

INSERT INTO `part_event` (`id_part_event`, `id_event`, `id_user`) VALUES
(1, 2, 38);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `text_post` longtext CHARACTER SET utf8mb4 NOT NULL,
  `date_post` datetime NOT NULL,
  `public` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `signalized` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `blocked` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `image_post` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `video_post` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT 'non',
  `story_post` varchar(3) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `id_user`, `text_post`, `date_post`, `public`, `signalized`, `blocked`, `image_post`, `video_post`, `story_post`) VALUES
(139, 35, 'Tout juste adopté 😁😁\n', '2021-07-18 17:42:25', 'non', 'non', 'non', 'oui', 'non', 'non'),
(140, 35, 'Un avis sur cet arbre à chat ?\n', '2021-07-18 17:44:41', 'non', 'non', 'non', 'oui', 'non', 'non'),
(141, 36, 'De retour au pays !\n', '2021-07-18 17:49:23', 'non', 'non', 'non', 'oui', 'non', 'non'),
(142, 32, 'De retour des Seychelles avec plein de photos dans a tête mais aussi dans le disque dur 😁😍\n', '2021-07-18 21:51:24', 'non', 'non', 'non', 'oui', 'non', 'non'),
(143, 32, 'La Nouvelle-Zélande.\n\nEncore une île, on ne se refait pas 😇\n\n', '2021-07-18 21:53:10', 'non', 'non', 'non', 'oui', 'non', 'non'),
(144, 33, 'Copilot.... Moi en tant que développeur ca me fait peur.\n', '2021-07-18 22:04:34', 'non', 'non', 'non', 'oui', 'non', 'non'),
(147, 32, 'Test gros troll\n', '2021-07-19 11:14:29', 'non', 'non', 'non', 'oui', 'non', 'non'),
(148, 32, 'klmmlkjlùjskflmq', '2021-07-19 12:45:35', 'non', 'non', 'non', 'oui', 'non', 'non'),
(149, 32, '', '2021-07-19 12:45:57', 'non', 'non', 'non', 'non', 'oui', 'oui'),
(150, 38, 'Bon, aujourd\'hui il pleut, demain peut être soleil?', '2021-08-04 16:28:30', 'non', 'non', 'non', 'oui', 'non', 'non');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
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
  `banner` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `name`, `lastname`, `avatar`, `city`, `country`, `birth`, `creation`, `role`, `blocked`, `period_block`, `banner`) VALUES
(35, 'aouicha@hotmail.fr', '$2y$04$CYZ/FQ2b2oMMxGbKW.CiVefrfF32KtXzCCh.xSjV8o/KDG8U2ocEC', 'BELID', 'Aouicha', 'chaton1.jpg', 'Marseille', 'FRANCE', '1983-03-20', '2021-07-15', 'user', 'non', '2209-01-11', 'defaultbanner.png'),
(33, 'lou@hotmail.fr', '$2y$04$xXUid05gNnL.OjLYW1iC6OOJdX5kx.0g6a3DHOihIvycRwk2/1Oo2', 'Lou', 'Cabassot', 'default.png', 'Marseille', 'France', '2012-06-03', '2021-06-16', 'admin', 'oui', '0001-01-01', 'defaultbanner.png'),
(32, 'emmanuel.cabassot@laplateforme.io', '$2y$04$9t14sAfAnCdIS0tax9Pe3eqIgZxM3RKh7syjEdW2xTZbFblkUAkLC', 'Emmanuel', 'Cabassot', 'profilEmmanuel.jpg', 'Marseille', 'France', '1979-02-01', '2021-06-14', 'admin', 'oui', '0001-01-01', 'defaultbanner.png'),
(36, 'melanie@camoin.fr', '$2y$04$8Nc2MNUymJflqDdcyo7lK.2w3QdN.QpRO907jHt8o76beN5R5UeMe', 'CAMOIN', 'Mélanie', 'drapeau.png', 'Sydney', 'Australia', '1986-11-05', '2021-07-18', 'user', 'non', '0001-01-01', 'defaultbanner.png'),
(37, 'troll@hotmail.fr', '$2y$04$C3BKu9OLCDx.Mn6TCIkImeqfNybUG.yCQJXa8BLVKMsG9hTCJ4fUe', 'Troll', 'Forever', 'les-trolls-de-la-vie-reelle.jpg', 'Paris', 'France', '2000-02-01', '2021-07-19', 'user', 'oui', '0001-01-01', 'defaultbanner.png'),
(38, 'denkrus@yahoo.com', '$2y$04$zy3UH0D0ipP6fTB1EyM8me8USOOOS05gqN1lg6sPdJVpHXTlfiKny', 'denis', 'farkas', 'default.png', 'Marseille', 'France', '1939-10-10', '2021-08-04', 'user', 'non', '0001-01-01', 'defaultbanner.png');

-- --------------------------------------------------------

--
-- Structure de la table `video_post`
--

CREATE TABLE `video_post` (
  `id_video_post` int(11) NOT NULL,
  `name_video_post` varchar(200) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `chemin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `video_post`
--

INSERT INTO `video_post` (`id_video_post`, `name_video_post`, `id_post`, `id_user`, `chemin`) VALUES
(1, 'Fish-16166.mp4', 149, 32, 'assets/videos/upload/post/149');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `belong`
--
ALTER TABLE `belong`
  ADD PRIMARY KEY (`id_belong`);

--
-- Index pour la table `comment_event`
--
ALTER TABLE `comment_event`
  ADD PRIMARY KEY (`id_comment_event`);

--
-- Index pour la table `comment_group`
--
ALTER TABLE `comment_group`
  ADD PRIMARY KEY (`id_comment_group`);

--
-- Index pour la table `comment_post`
--
ALTER TABLE `comment_post`
  ADD PRIMARY KEY (`id_comment_post`),
  ADD KEY `fk_commentPost_post` (`id_post`);

--
-- Index pour la table `comment_story`
--
ALTER TABLE `comment_story`
  ADD PRIMARY KEY (`id_comment_story`);

--
-- Index pour la table `connected`
--
ALTER TABLE `connected`
  ADD PRIMARY KEY (`id_connected`);

--
-- Index pour la table `dislike_post`
--
ALTER TABLE `dislike_post`
  ADD PRIMARY KEY (`id_dislike_post`),
  ADD KEY `fk_dislikePost_post` (`id_post`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id_follow`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_group`);

--
-- Index pour la table `image_post`
--
ALTER TABLE `image_post`
  ADD PRIMARY KEY (`id_image_post`),
  ADD KEY `fk_imagePost_post` (`id_post`);

--
-- Index pour la table `like_event`
--
ALTER TABLE `like_event`
  ADD PRIMARY KEY (`id_like_event`);

--
-- Index pour la table `like_post`
--
ALTER TABLE `like_post`
  ADD PRIMARY KEY (`id_like_post`),
  ADD KEY `fk_like_post` (`id_post`);

--
-- Index pour la table `part_event`
--
ALTER TABLE `part_event`
  ADD PRIMARY KEY (`id_part_event`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `video_post`
--
ALTER TABLE `video_post`
  ADD PRIMARY KEY (`id_video_post`),
  ADD KEY `fk_video_post_post` (`id_post`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `belong`
--
ALTER TABLE `belong`
  MODIFY `id_belong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `comment_event`
--
ALTER TABLE `comment_event`
  MODIFY `id_comment_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comment_group`
--
ALTER TABLE `comment_group`
  MODIFY `id_comment_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `comment_post`
--
ALTER TABLE `comment_post`
  MODIFY `id_comment_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `comment_story`
--
ALTER TABLE `comment_story`
  MODIFY `id_comment_story` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `connected`
--
ALTER TABLE `connected`
  MODIFY `id_connected` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT pour la table `dislike_post`
--
ALTER TABLE `dislike_post`
  MODIFY `id_dislike_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `friend`
--
ALTER TABLE `friend`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_group` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `image_post`
--
ALTER TABLE `image_post`
  MODIFY `id_image_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `like_event`
--
ALTER TABLE `like_event`
  MODIFY `id_like_event` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `like_post`
--
ALTER TABLE `like_post`
  MODIFY `id_like_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `part_event`
--
ALTER TABLE `part_event`
  MODIFY `id_part_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `video_post`
--
ALTER TABLE `video_post`
  MODIFY `id_video_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
