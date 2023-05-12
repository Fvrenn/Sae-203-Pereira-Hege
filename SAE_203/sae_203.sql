-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 mai 2023 à 21:50
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae_203`
--

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id_demande` int NOT NULL AUTO_INCREMENT,
  `date_de_debut` date DEFAULT NULL,
  `date_de_fin` date DEFAULT NULL,
  `statuts` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `idmat` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_demande`),
  KEY `idmat` (`idmat`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `date_de_debut`, `date_de_fin`, `statuts`, `idmat`, `id_user`) VALUES
(11, '2023-05-04', '2023-05-11', 'demande refusée', 3, 25),
(10, '2023-05-18', '2023-05-16', 'demande acceptée', 3, 25),
(12, '2023-05-18', '2023-05-18', 'demande acceptée', 3, 25),
(13, '2023-03-29', '2023-05-23', 'demande acceptée', 3, 25),
(14, '2023-03-10', '2023-05-31', 'demande refusée', 3, 25),
(15, '2023-05-11', '2023-05-16', 'demande acceptée', 3, 25),
(16, '2023-05-18', '2023-06-11', 'demande refusée', 3, 25),
(17, '2023-05-20', '2023-05-18', 'demande acceptée', 3, 25),
(18, '2023-05-12', '2023-05-23', 'demande acceptée', 3, 25),
(19, '2023-05-11', '2023-06-06', 'demande refusée', 3, 25),
(20, '2023-05-11', '2023-05-31', 'demande acceptée', 3, 25),
(21, '2023-05-06', '2023-05-31', 'demande acceptée', 3, 25),
(22, '2023-05-28', '2023-05-25', 'demande acceptée', 3, 25),
(23, '2023-05-28', '2023-06-01', 'demande acceptée', 3, 25),
(24, '2023-05-19', '2023-05-30', 'demande acceptée', 3, 25),
(25, '2023-05-19', '2023-05-17', 'demande refusée', 3, 25),
(26, '2023-05-19', '2023-05-17', 'demande acceptée', 3, 25),
(27, '2023-05-20', '2023-06-08', 'demande acceptée', 3, 25),
(28, '2023-05-12', '2023-06-01', 'demande acceptée', 3, 25),
(29, '2023-05-12', '2023-05-22', 'demande en attente', 3, 25);

-- --------------------------------------------------------

--
-- Structure de la table `matériel`
--

DROP TABLE IF EXISTS `matériel`;
CREATE TABLE IF NOT EXISTS `matériel` (
  `idmat` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idmat`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matériel`
--

INSERT INTO `matériel` (`idmat`, `nom`, `reference`, `type`, `description`) VALUES
(3, 'camera v5', '015544vgt4', 'camera', 'ceci est une camera'),
(5, 'microphone', '5265165', 'option2', 'micro incroyable'),
(6, 'microphone drg', '55484', 'Caméra', '488484'),
(7, 'microphone drg', '98465846', 'Caméra', '444444'),
(8, 'microphone drg', '55484', 'Caméra', '54\r\n54\r\n4'),
(9, 'microphone drg', '55484', 'Caméra', '54\r\n54\r\n4'),
(10, 'microphone drg', '17', 'Caméra', 'je ss');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(35) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_de_naissance` date DEFAULT NULL,
  `role` binary(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `nom`, `prenom`, `email`, `password`, `date_de_naissance`, `role`) VALUES
(25, 'Monsieur', 'Admin', 'killian@gmail.com', '91b4d142823f7d20c5f08df69122de43f35f057a988d9619f6d3138485c9a203', '2023-04-11', 0x31),
(21, 'pereira', 'Nicolas', 'k839071@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2023-05-05', 0x30);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
