-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: senteurdangie
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `76_admin`
--

DROP TABLE IF EXISTS `76_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_admin` (
  `adm_id` int NOT NULL AUTO_INCREMENT,
  `adm_mail` varchar(250) DEFAULT NULL,
  `adm_mdp` varchar(250) NOT NULL,
  PRIMARY KEY (`adm_id`),
  UNIQUE KEY `adm_mail` (`adm_mail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_admin`
--

LOCK TABLES `76_admin` WRITE;
/*!40000 ALTER TABLE `76_admin` DISABLE KEYS */;
INSERT INTO `76_admin` VALUES (1,'Mattong','00000000'),(2,'Mattong@gmail.com','00000000');
/*!40000 ALTER TABLE `76_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_avis`
--

DROP TABLE IF EXISTS `76_avis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_avis` (
  `avi_id` int NOT NULL AUTO_INCREMENT,
  `avi_description` varchar(500) NOT NULL,
  `avi_date` date NOT NULL,
  `pro_id` int NOT NULL,
  `use_id` int NOT NULL,
  PRIMARY KEY (`avi_id`),
  KEY `pro_id` (`pro_id`),
  KEY `use_id` (`use_id`),
  CONSTRAINT `76_avis_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `76_produits` (`pro_id`),
  CONSTRAINT `76_avis_ibfk_2` FOREIGN KEY (`use_id`) REFERENCES `76_users` (`use_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_avis`
--

LOCK TABLES `76_avis` WRITE;
/*!40000 ALTER TABLE `76_avis` DISABLE KEYS */;
INSERT INTO `76_avis` VALUES (1,'Très bon produit, je recommande !','2025-04-01',1,1),(2,'Qualité moyenne, pourrait être amélioré.','2025-04-02',2,2),(3,'Excellent rapport qualité/prix.','2025-04-03',3,1),(4,'Pas satisfait, produit arrivé défectueux.','2025-04-04',1,2),(5,'Livraison rapide et produit conforme.','2025-04-05',2,1),(6,'Odeur sympa, un peu légère mais agréable.','2025-04-23',7,3),(7,'Très frais, ça sent bon l\'été !','2025-04-23',3,4),(8,'L\'odeur de forêt est apaisante, j\'aime bien.','2025-04-23',6,5);
/*!40000 ALTER TABLE `76_avis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_commande`
--

DROP TABLE IF EXISTS `76_commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_commande` (
  `com_id` int NOT NULL AUTO_INCREMENT,
  `com_dateCommande` date NOT NULL,
  `com_dateLivraison` date NOT NULL,
  `pro_id` int NOT NULL,
  `use_id` int NOT NULL,
  `com_quantitéCommande` int DEFAULT NULL,
  PRIMARY KEY (`com_id`),
  KEY `pro_id` (`pro_id`),
  KEY `use_id` (`use_id`),
  CONSTRAINT `76_commande_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `76_produits` (`pro_id`),
  CONSTRAINT `76_commande_ibfk_2` FOREIGN KEY (`use_id`) REFERENCES `76_users` (`use_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_commande`
--

LOCK TABLES `76_commande` WRITE;
/*!40000 ALTER TABLE `76_commande` DISABLE KEYS */;
INSERT INTO `76_commande` VALUES (1,'2025-04-23','2025-04-26',2,3,3),(2,'2025-04-23','2025-04-26',5,3,7),(3,'2025-04-23','2025-04-27',6,4,5),(4,'2025-04-23','2025-04-28',1,5,2),(5,'2025-04-23','2025-04-28',3,5,6),(6,'2025-04-23','2025-04-28',4,5,9),(7,'2025-04-25','2025-04-28',2,1,4),(8,'2025-04-26','2025-04-29',3,1,2),(9,'2025-04-25','2025-04-28',5,2,6),(10,'2025-04-27','2025-04-30',6,2,1);
/*!40000 ALTER TABLE `76_commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_produits`
--

DROP TABLE IF EXISTS `76_produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_produits` (
  `pro_id` int NOT NULL AUTO_INCREMENT,
  `pro_nom` varchar(200) NOT NULL,
  `pro_img` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pro_description` varchar(1000) NOT NULL,
  `pro_prix` int NOT NULL,
  `pro_quantité` int NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_produits`
--

LOCK TABLES `76_produits` WRITE;
/*!40000 ALTER TABLE `76_produits` DISABLE KEYS */;
INSERT INTO `76_produits` VALUES (1,'Composition','composition37e.jpg','Plongez dans un univers de bien-être avec cette composition de bougies artisanales soigneusement sélectionnées. Parfumées avec délicatesse et présentées dans une box élégante, elles sont accompagnées d’échantillons pour une expérience sensorielle complète. Idéales pour offrir ou se faire plaisir, elles allient esthétique et senteurs raffinées.',37,100),(2,'Gourmande rose','gourmanderose15e.jpg','Découvrez une bougie parfumée à la rose au caractère artisanal et à la fragrance envoûtante. Faite à la main avec des ingrédients de qualité, elle diffuse un parfum floral doux et apaisant. Parfaite pour créer une ambiance romantique ou relaxante dans votre intérieur.',50,80),(3,'Bougie Gourmande Citron','gourmandecitron15e.jpg','Laissez-vous séduire par cette bougie artisanale au parfum vivifiant de citron. Son arôme frais et sucré apporte une touche de peps et de légèreté à n’importe quelle pièce. Fabriquée avec soin, elle illumine vos moments de détente tout en parfumant délicatement l’air.',15,30),(4,'Bougie Gourmande Bleu Océan','gourmandebleuocean15e.jpg','Inspirée par la brise marine, cette bougie artisanale Bleu Océan évoque des souvenirs de bord de mer et de fraîcheur. Son parfum iodé et légèrement sucré apporte un souffle d’évasion dans votre intérieur. Idéale pour se détendre après une longue journée ou rafraîchir l’ambiance.',18,45),(5,'Bougie Gourmande Chocolat','gourmandechocolat15e.jpg','Véritable gourmandise olfactive, cette bougie au chocolat diffuse un arôme intense et réconfortant. Fabriquée à la main, elle crée une atmosphère chaleureuse et sucrée qui rappelle les desserts maison. Parfaite pour les amateurs de douceurs et de cocooning.',20,50),(6,'Bougie Gourmande Sapin','gourmandesapin15e.jpg','Apportez un air de forêt dans votre maison avec cette bougie au parfum naturel de sapin. Son odeur boisée et vivifiante vous plonge au cœur de la nature. Elle est idéale pendant les fêtes ou pour créer une ambiance fraîche toute l’année.',17,35),(7,'Bougie Gourmande Violette','gourmandeviolett15e.jpg','Élégante et florale, cette bougie à la violette est parfaite pour créer une ambiance douce et romantique. Son parfum délicat rappelle les jardins en fleurs et les bonbons d’antan. Une touche vintage et raffinée pour parfumer vos soirées.',19,40);
/*!40000 ALTER TABLE `76_produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_users`
--

DROP TABLE IF EXISTS `76_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_users`
--

LOCK TABLES `76_users` WRITE;
/*!40000 ALTER TABLE `76_users` DISABLE KEYS */;
INSERT INTO `76_users` VALUES (1,'Jourdain','Ichem','tanjiro76610@outlook.fr','00000000','16 rue des sports',76620,'Le Havre'),(2,'Fadli','Saïd','said@fadli.com','$2y$10$FFVt6wRT0p.g6GxKxV16E./lEqW/3vFmuqsHSp6ZPscEzrdwW.GGy','2 rue de l&#039;Afpa',76610,'Le Havre'),(3,'Dubois','Claire','claire.dubois@example.com','00000000','5 rue des lilas',76600,'Le Havre'),(4,'Martin','Lucas','lucas.martin@example.com','00000000','10 avenue Victor Hugo',76620,'Le Havre'),(5,'Lemoine','Julie','julie.lemoine@example.com','00000000','33 rue des écoles',76610,'Le Havre');
/*!40000 ALTER TABLE `76_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-25 11:48:31
