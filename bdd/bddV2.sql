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
  `adm_pseudo` varchar(250) NOT NULL,
  `adm_mdp` varchar(250) NOT NULL,
  PRIMARY KEY (`adm_id`),
  UNIQUE KEY `adm_pseudo` (`adm_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_admin`
--

LOCK TABLES `76_admin` WRITE;
/*!40000 ALTER TABLE `76_admin` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_avis`
--

LOCK TABLES `76_avis` WRITE;
/*!40000 ALTER TABLE `76_avis` DISABLE KEYS */;
INSERT INTO `76_avis` VALUES (1,'Très bon produit, je recommande !','2025-04-01',1,1),(2,'Odeur agréable, top pour offrir.','2025-04-01',2,2),(3,'Bonne qualité mais livraison lente.','2025-04-02',3,3),(4,'Parfait pour une déco zen.','2025-04-03',4,4),(5,'J’adore le parfum de cette bougie.','2025-04-03',5,5),(6,'Un peu petit, mais joli.','2025-04-04',6,1),(7,'Ma préférée, douce et apaisante.','2025-04-05',7,2),(8,'Un classique, toujours aussi bien.','2025-04-05',1,3),(9,'Parfum un peu trop fort pour moi.','2025-04-06',2,4),(10,'Livraison rapide et soignée.','2025-04-07',3,5);
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
  `use_id` int NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `use_id` (`use_id`),
  CONSTRAINT `76_commande_ibfk_1` FOREIGN KEY (`use_id`) REFERENCES `76_users` (`use_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_commande`
--

LOCK TABLES `76_commande` WRITE;
/*!40000 ALTER TABLE `76_commande` DISABLE KEYS */;
INSERT INTO `76_commande` VALUES (1,'2025-04-01','2025-04-03',1),(2,'2025-04-02','2025-04-05',2),(3,'2025-04-03','2025-04-07',3),(4,'2025-04-04','2025-04-08',4),(5,'2025-04-05','2025-04-09',5),(6,'2025-04-06','2025-04-10',1),(7,'2025-04-07','2025-04-11',2),(8,'2025-04-08','2025-04-12',3),(9,'2025-04-09','2025-04-13',4),(10,'2025-04-10','2025-04-14',5);
/*!40000 ALTER TABLE `76_commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `76_commande_ligne`
--

DROP TABLE IF EXISTS `76_commande_ligne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `76_commande_ligne` (
  `pro_id` int NOT NULL,
  `com_id` int NOT NULL,
  `comlig_quantité` int NOT NULL,
  PRIMARY KEY (`pro_id`,`com_id`),
  KEY `com_id` (`com_id`),
  CONSTRAINT `76_commande_ligne_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `76_produits` (`pro_id`),
  CONSTRAINT `76_commande_ligne_ibfk_2` FOREIGN KEY (`com_id`) REFERENCES `76_commande` (`com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_commande_ligne`
--

LOCK TABLES `76_commande_ligne` WRITE;
/*!40000 ALTER TABLE `76_commande_ligne` DISABLE KEYS */;
INSERT INTO `76_commande_ligne` VALUES (1,1,1),(1,8,3),(2,2,2),(2,9,1),(3,1,1),(3,3,1),(3,10,2),(4,4,2),(5,5,1),(6,6,2),(7,7,1);
/*!40000 ALTER TABLE `76_commande_ligne` ENABLE KEYS */;
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
  `pro_description` varchar(1000) NOT NULL,
  `pro_prix` int NOT NULL,
  `pro_quantité` int NOT NULL,
  `pro_img` varchar(250) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `76_produits`
--

LOCK TABLES `76_produits` WRITE;
/*!40000 ALTER TABLE `76_produits` DISABLE KEYS */;
INSERT INTO `76_produits` VALUES (1,'Composition','Composition florale gourmande.',37,10,'composition37e.jpg'),(2,'Gourmande Bleu Océan','Délicieuse création saveur océan.',15,10,'gourmandebleuocean15e.jpg'),(3,'Gourmande Chocolat','Gourmande au bon goût de chocolat.',15,10,'gourmandechocolat15e.jpg'),(4,'Gourmande Citron','Gourmande acidulée au citron.',15,10,'gourmandecitron15e.jpg'),(5,'Gourmande Rose','Gourmande douce parfumée à la rose.',15,10,'gourmanderose15e.jpg'),(6,'Gourmande Sapin','Gourmande fraîcheur sapin.',15,10,'gourmandesapin15e.jpg'),(7,'Gourmande Violette','Gourmande délicate à la violette.',15,10,'gourmandeviolett15e.jpg');
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
INSERT INTO `76_users` VALUES (1,'Durand','Alice','alice.durand@example.com','$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm','10 rue des Lilas',75000,'Paris'),(2,'Martin','Bob','bob.martin@example.com','$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm','25 avenue Victor Hugo',69000,'Lyon'),(3,'Petit','Chloé','chloe.petit@example.com','$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm','5 chemin du Parc',33000,'Bordeaux'),(4,'Bernard','David','david.bernard@example.com','$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm','32 boulevard Saint-Michel',31000,'Toulouse'),(5,'Moreau','Emma','emma.moreau@example.com','$2y$10$zSrxdVrZaeY6IA6/Vdm/Bumkl44VIiHRYw29SGGLYkbrupl52nfOm','8 impasse des Fleurs',44000,'Nantes');
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

-- Dump completed on 2025-04-25 13:31:24
