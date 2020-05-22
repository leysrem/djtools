-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 22 mai 2020 à 14:32
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `djtools`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `nom_album` varchar(255) NOT NULL,
  `annee_album` int(4) NOT NULL,
  `pochette_album` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `album`
--

INSERT INTO `album` (`id_album`, `nom_album`, `annee_album`, `pochette_album`) VALUES
(1, 'deux freres', 2019, 'P:/cours/sio2/C#/djtools/DjTools/images/pochettes_albums/2_freres.png'),
(2, 'Dans la legende', 2016, 'P:/cours/sio2/C#/djtools/DjTools/images/pochettes_albums/dans_la_legende.jpg'),
(3, 'Le monde chico', 2015, 'P:/cours/sio2/C#/djtools/DjTools/images/pochettes_albums/le_monde_chico.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `album_morceau`
--

DROP TABLE IF EXISTS `album_morceau`;
CREATE TABLE IF NOT EXISTS `album_morceau` (
  `Ref_morceau` int(11) NOT NULL,
  `Ref_album` int(11) NOT NULL,
  `url_morceau` varchar(255) NOT NULL,
  PRIMARY KEY (`Ref_morceau`,`Ref_album`),
  KEY `Ref_album` (`Ref_album`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `album_morceau`
--


-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

DROP TABLE IF EXISTS `artiste`;
CREATE TABLE IF NOT EXISTS `artiste` (
  `id_artiste` int(11) NOT NULL AUTO_INCREMENT,
  `nom_artiste` char(255) NOT NULL,
  PRIMARY KEY (`id_artiste`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `artiste`
--

INSERT INTO `artiste` (`id_artiste`, `nom_artiste`) VALUES
(1, 'PNL'),
(2, 'SCH'),
(3, 'Koba la D'),
(9, 'TK 13'),
(10, 'JUL');

-- --------------------------------------------------------

--
-- Structure de la table `artiste_morceau`
--

DROP TABLE IF EXISTS `artiste_morceau`;
CREATE TABLE IF NOT EXISTS `artiste_morceau` (
  `Ref_artiste` int(11) NOT NULL,
  `Ref_morceau` int(11) NOT NULL,
  PRIMARY KEY (`Ref_morceau`,`Ref_artiste`),
  KEY `Ref_artiste` (`Ref_artiste`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `artiste_morceau`
--

INSERT INTO `artiste_morceau` (`Ref_artiste`, `Ref_morceau`) VALUES
(1, 37);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nom_genre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id_genre`, `nom_genre`) VALUES
(1, 'Rap'),
(5, 'Rock'),
(6, 'Punk'),
(7, 'Electro');

-- --------------------------------------------------------

--
-- Structure de la table `morceau`
--

DROP TABLE IF EXISTS `morceau`;
CREATE TABLE IF NOT EXISTS `morceau` (
  `id_morceau` int(11) NOT NULL AUTO_INCREMENT,
  `titre_morceau` varchar(255) NOT NULL,
  `duree_morceau` varchar(255) DEFAULT NULL,
  `fk_id_genre` int(11) NOT NULL,
  PRIMARY KEY (`id_morceau`),
  KEY `fk_id_genre` (`fk_id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `morceau`
--

INSERT INTO `morceau` (`id_morceau`, `titre_morceau`, `duree_morceau`,`fk_id_genre`) VALUES
(37, 'TEST M', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
CREATE TABLE IF NOT EXISTS `playlist` (
  `id_playlist` int(11) NOT NULL AUTO_INCREMENT,
  `nom_playlist` varchar(255) NOT NULL,
  PRIMARY KEY (`id_playlist`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `playlist`
--

INSERT INTO `playlist` (`id_playlist`, `nom_playlist`) VALUES
(1, 'Booska hit'),
(2, 'Booska Bangers');

-- --------------------------------------------------------

--
-- Structure de la table `playlist_morceau`
--

DROP TABLE IF EXISTS `playlist_morceau`;
CREATE TABLE IF NOT EXISTS `playlist_morceau` (
  `Ref_playlist` int(11) NOT NULL,
  `Ref_morceau` int(11) NOT NULL,
  PRIMARY KEY (`Ref_morceau`,`Ref_playlist`),
  KEY `Ref_playlist` (`Ref_playlist`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `album_morceau`
--
ALTER TABLE `album_morceau`
  ADD CONSTRAINT `album_morceau_ibfk_1` FOREIGN KEY (`Ref_morceau`) REFERENCES `morceau` (`id_morceau`) ON DELETE CASCADE,
  ADD CONSTRAINT `album_morceau_ibfk_2` FOREIGN KEY (`Ref_album`) REFERENCES `album` (`id_album`) ON DELETE CASCADE;

--
-- Contraintes pour la table `artiste_morceau`
--
ALTER TABLE `artiste_morceau`
  ADD CONSTRAINT `artiste_morceau_ibfk_1` FOREIGN KEY (`Ref_morceau`) REFERENCES `morceau` (`id_morceau`) ON DELETE CASCADE,
  ADD CONSTRAINT `artiste_morceau_ibfk_2` FOREIGN KEY (`Ref_artiste`) REFERENCES `artiste` (`id_artiste`) ON DELETE CASCADE;

--
-- Contraintes pour la table `morceau`
--
ALTER TABLE `morceau`
  ADD CONSTRAINT `morceau_ibfk_1` FOREIGN KEY (`fk_id_genre`) REFERENCES `genre` (`id_genre`);

--
-- Contraintes pour la table `playlist_morceau`
--
ALTER TABLE `playlist_morceau`
  ADD CONSTRAINT `playlist_morceau_ibfk_1` FOREIGN KEY (`Ref_morceau`) REFERENCES `morceau` (`id_morceau`) ON DELETE CASCADE,
  ADD CONSTRAINT `playlist_morceau_ibfk_2` FOREIGN KEY (`Ref_playlist`) REFERENCES `playlist` (`id_playlist`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
