-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 13 déc. 2021 à 14:04
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `memo_e1975958`
--
CREATE DATABASE IF NOT EXISTS `memo_e1975958` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `memo_e1975958`;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `texte` varchar(200) CHARACTER SET latin1 NOT NULL COMMENT 'Texte de la tâche.',
  `accomplie` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Valeur 0 pour non-accomplie, et 1 pour accomplie.',
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'La date à laquelle la tâche est ajoutée',
  `utilisateur_id` int(11) DEFAULT NULL COMMENT 'Ce champ n''est pas utilisé dans le TP, ignorez-le!'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id`, `texte`, `accomplie`, `date_ajout`, `utilisateur_id`) VALUES
(1, 'Obtenir permis de conduire', 0, '2021-12-12 11:35:53', NULL),
(2, 'Acheter PS5', 0, '2021-12-12 11:36:35', NULL),
(3, 'Jouer à GTA  V', 0, '2021-12-12 11:37:38', NULL),
(4, 'Finir Zelda Breath of the Wild à 100%', 1, '2021-12-12 11:38:42', NULL),
(5, 'Trouver un autre travail', 0, '2021-12-12 11:39:04', NULL),
(6, 'Commencer TP2', 1, '2021-12-12 11:42:06', NULL),
(7, 'Remettre TP2', 1, '2021-12-12 11:42:52', NULL),
(8, 'Payer ma facture de cellulaire', 1, '2021-11-09 09:35:05', NULL),
(9, 'Réparer la voiture accidenté', 0, '2021-12-12 18:51:58', NULL),
(10, 'Régler problème date', 1, '2021-12-13 11:35:21', NULL),
(11, 'Acheter cadeaux de Noël', 0, '2021-12-13 13:04:55', NULL),
(12, 'Préparer 1er Janvier', 0, '2021-12-13 13:21:57', NULL),
(13, 'Congédié Marc Bergevin ', 1, '2021-11-29 15:31:21', NULL),
(14, 'Gagner Coupe Stanley', 1, '1993-06-09 13:58:18', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
