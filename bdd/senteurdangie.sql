-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 27 juin 2025 à 09:11
-- Version du serveur : 8.4.3
-- Version de PHP : 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `senteurdangie`
--
CREATE DATABASE IF NOT EXISTS `senteurdangie` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `senteurdangie`;

-- --------------------------------------------------------

--
-- Structure de la table `76_admin`
--

CREATE TABLE IF NOT EXISTS `76_admin` (
  `adm_id` int NOT NULL AUTO_INCREMENT,
  `adm_pseudo` varchar(250) NOT NULL,
  `adm_mdp` varchar(250) NOT NULL,
  PRIMARY KEY (`adm_id`),
  UNIQUE KEY `adm_pseudo` (`adm_pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `76_admin`
--

INSERT INTO `76_admin` (`adm_id`, `adm_pseudo`, `adm_mdp`) VALUES
(1, 'Mattong', '$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm');

-- --------------------------------------------------------

--
-- Structure de la table `76_avis`
--

CREATE TABLE IF NOT EXISTS `76_avis` (
  `avi_id` int NOT NULL AUTO_INCREMENT,
  `avi_description` varchar(500) NOT NULL,
  `avi_date` date NOT NULL,
  `pro_id` int NOT NULL,
  `use_id` int NOT NULL,
  PRIMARY KEY (`avi_id`),
  KEY `use_id` (`use_id`),
  KEY `76_avis_ibfk_1` (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `76_avis`
--

INSERT INTO `76_avis` (`avi_id`, `avi_description`, `avi_date`, `pro_id`, `use_id`) VALUES
(1, 'Très bon produit, je recommande !', '2025-04-01', 1, 1),
(3, 'Bonne qualité mais livraison lente.', '2025-04-02', 3, 3),
(5, 'J’adore le parfum de cette bougie.', '2025-04-03', 5, 5),
(8, 'Un classique, toujours aussi bien.', '2025-04-05', 1, 3),
(10, 'Livraison rapide et soignée.', '2025-04-07', 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `76_commande`
--

CREATE TABLE IF NOT EXISTS `76_commande` (
  `com_id` int NOT NULL AUTO_INCREMENT,
  `com_dateCommande` date NOT NULL,
  `com_dateLivraison` date NOT NULL,
  `use_id` int NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `use_id` (`use_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `76_commande`
--

INSERT INTO `76_commande` (`com_id`, `com_dateCommande`, `com_dateLivraison`, `use_id`) VALUES
(1, '2025-04-01', '2025-04-03', 1),
(2, '2025-04-02', '2025-04-05', 2),
(3, '2025-04-03', '2025-04-07', 3),
(4, '2025-04-04', '2025-04-08', 4),
(5, '2025-04-05', '2025-04-09', 5),
(6, '2025-04-06', '2025-04-10', 1),
(7, '2025-04-07', '2025-04-11', 2),
(8, '2025-04-08', '2025-04-12', 3),
(9, '2025-04-09', '2025-04-13', 4),
(10, '2025-04-10', '2025-04-14', 5);

-- --------------------------------------------------------

--
-- Structure de la table `76_commande_ligne`
--

CREATE TABLE IF NOT EXISTS `76_commande_ligne` (
  `pro_id` int NOT NULL,
  `com_id` int NOT NULL,
  `comlig_quantité` int NOT NULL,
  PRIMARY KEY (`pro_id`,`com_id`),
  KEY `com_id` (`com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `76_commande_ligne`
--

INSERT INTO `76_commande_ligne` (`pro_id`, `com_id`, `comlig_quantité`) VALUES
(1, 1, 1),
(1, 8, 3),
(3, 1, 1),
(3, 3, 1),
(3, 10, 2),
(5, 5, 1),
(7, 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `76_produits`
--

CREATE TABLE IF NOT EXISTS `76_produits` (
  `pro_id` int NOT NULL AUTO_INCREMENT,
  `pro_nom` varchar(200) NOT NULL,
  `pro_description` varchar(1000) NOT NULL,
  `pro_prix` int NOT NULL,
  `pro_quantite` int NOT NULL,
  `pro_img` varchar(250) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `76_produits`
--

INSERT INTO `76_produits` (`pro_id`, `pro_nom`, `pro_description`, `pro_prix`, `pro_quantite`, `pro_img`) VALUES
(1, 'Composition', 'Une harmonie parfaite entre douceur florale et notes sucrées. Cette bougie dévoile une composition raffinée, mêlant fleurs délicates et touches gourmandes pour une ambiance à la fois élégante et réconfortante. Idéale pour créer un cocon de bien-être, elle parfume subtilement ton intérieur tout en apportant une touche de charme et de gourmandise.', 37, 10, 'composition37e.jpg'),
(3, 'Gourmande Chocolats', 'Plonge dans une ambiance chaleureuse avec cette bougie au parfum gourmand de chocolat. Sa senteur riche et sucrée évoque une tablette fondante tout juste cassée, idéale pour créer une atmosphère cosy et réconfortante. Parfaite pour les amateurs de douceurs, elle apporte une touche de gourmandise irrésistible à ton intérieur.', 15, 10, 'gourmandechocolat15e.jpg'),
(5, 'Gourmande Rose', 'Laisse-toi envoûter par cette bougie à la senteur gourmande et douce, délicatement parfumée à la rose. Son arôme floral et sucré crée une ambiance chaleureuse et réconfortante, idéale pour un moment de détente ou une touche romantique à ton intérieur. Fabriquée avec soin, elle transforme chaque pièce en un cocon parfumé et apaisant.', 15, 10, 'gourmanderose15e.jpg'),
(29, 'Pomme de pin', 'Bougie parfumée évoquant la fraîcheur boisée de la pomme de pin, idéale pour créer une ambiance chaleureuse et naturelle. Son design rustique s’inspire des forêts d’hiver, apportant une touche authentique à votre intérieur.', 10, 15, '681f3c778be6e_pommedepin.jpg'),
(31, 'Fraise nain de jardin', 'Ajoutez une touche de fantaisie fruitée à votre intérieur avec cette bougie artisanale en forme de nain de jardin, délicieusement parfumée à la fraise.', 10, 25, '681f42a98da01_fraisenaindejardin.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `76_users`
--

CREATE TABLE IF NOT EXISTS `76_users` (
  `use_id` int NOT NULL AUTO_INCREMENT,
  `use_nom` varchar(100) NOT NULL,
  `use_prenom` varchar(100) NOT NULL,
  `use_mail` varchar(250) NOT NULL,
  `use_mdp` varchar(200) NOT NULL,
  `use_adresse` varchar(250) NOT NULL,
  `use_codePostal` int NOT NULL,
  `use_ville` varchar(200) NOT NULL,
  PRIMARY KEY (`use_id`),
  UNIQUE KEY `use_mail` (`use_mail`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `76_users`
--

INSERT INTO `76_users` (`use_id`, `use_nom`, `use_prenom`, `use_mail`, `use_mdp`, `use_adresse`, `use_codePostal`, `use_ville`) VALUES
(1, 'Durand', 'Alice', 'alice.durand@example.com', '$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm', '10 rue des Lilas', 75000, 'Paris'),
(2, 'Martin', 'Bob', 'bob.martin@example.com', '$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm', '25 avenue Victor Hugo', 69000, 'Lyon'),
(3, 'Petit', 'Chloé', 'chloe.petit@example.com', '$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm', '5 chemin du Parc', 33000, 'Bordeaux'),
(4, 'Bernard', 'David', 'david.bernard@example.com', '$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm', '32 boulevard Saint-Michel', 31000, 'Toulouse'),
(5, 'Moreau', 'Emma', 'emma.moreau@example.com', '$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm', '8 impasse des Fleurs', 44000, 'Nantes'),
(6, 'jourdain', 'ichem', 'ichem76610@hotmail.com', '$2y$10$lg1EYK6MyEDdeoitSHqjGuYkCfzObGI8GlLP2MaVDbmTyqBu7Am4O', '2 avenue rouget de lisle', 76610, '76610 - LE HAVRE'),
(7, 'jourdain', 'ichem', 'tanjiro76610@outlook.fr', '$2y$10$3CL9x.1Cd4HkBqoI99tguOHmellFXq6OgfGN.jUoYXtWoEEEPILZW', '16 rue des sports', 76610, '76610 - LE HAVRE');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `76_avis`
--
ALTER TABLE `76_avis`
  ADD CONSTRAINT `76_avis_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `76_produits` (`pro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `76_avis_ibfk_2` FOREIGN KEY (`use_id`) REFERENCES `76_users` (`use_id`);

--
-- Contraintes pour la table `76_commande`
--
ALTER TABLE `76_commande`
  ADD CONSTRAINT `76_commande_ibfk_1` FOREIGN KEY (`use_id`) REFERENCES `76_users` (`use_id`);

--
-- Contraintes pour la table `76_commande_ligne`
--
ALTER TABLE `76_commande_ligne`
  ADD CONSTRAINT `76_commande_ligne_ibfk_2` FOREIGN KEY (`com_id`) REFERENCES `76_commande` (`com_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
