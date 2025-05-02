-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: gest_app
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `version` varchar(10) NOT NULL,
  `idarch` int DEFAULT NULL,
  `idmopl` int DEFAULT NULL,
  `idnicou` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idarch` (`idarch`),
  KEY `idmopl` (`idmopl`),
  KEY `idnicou` (`idnicou`),
  CONSTRAINT `application_ibfk_1` FOREIGN KEY (`idarch`) REFERENCES `architecture` (`id`),
  CONSTRAINT `application_ibfk_2` FOREIGN KEY (`idmopl`) REFERENCES `mode_deploiement` (`id`),
  CONSTRAINT `application_ibfk_3` FOREIGN KEY (`idnicou`) REFERENCES `niveau_couche` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4455577 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (2,'mic-reporting','Un reporting est une application de la gestion des comptes comptables ','en cours','3.1.2',1,2,1),(4455555,'mic-utilisateur-api','une application qui permet de gere les utilisateurs','terminer','2.1.2',1,1,1),(4455556,'affoue kanga','une application qui permet de gere les utilisateurs','terminer','2.1.2',1,1,1),(4455557,'affoue kanga','une application qui permet de gere les utilisateurs','terminer','2.1.2',1,1,1);
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `architecture`
--

DROP TABLE IF EXISTS `architecture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `architecture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architecture`
--

LOCK TABLES `architecture` WRITE;
/*!40000 ALTER TABLE `architecture` DISABLE KEYS */;
INSERT INTO `architecture` VALUES (1,'microservice','Un microservice est ensemble d architecture qui separe une application en plusieurs petites service'),(2,'monolytique','monolytique est un ensemble d architecture qui regroupe plusieurs petit service dans une seule appli'),(3,'nomolytique','givsdgruiuiuiu'),(4,'microservice',' un microservice est l\'ensemble des petites services '),(5,'microservice',' un microservice est l\'ensemble des petites services '),(6,'nomolytique','une application monolytique est une application qui regroupe plusieurs petite services'),(7,'nomolytique','une application monolytique est une application qui regroupe plusieurs petite services'),(8,'microservice',''),(9,'microservice','un microservice est une architeture pour les applications  qui separe plusieursapplication en petite'),(10,'microservice','un microservice est une architeture pour les applications  qui separe plusieursapplication en petite'),(11,'microservice',''),(12,'microservice','');
/*!40000 ALTER TABLE `architecture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `developper`
--

DROP TABLE IF EXISTS `developper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `developper` (
  `idpers` int NOT NULL,
  `idapp` int NOT NULL,
  PRIMARY KEY (`idpers`,`idapp`),
  KEY `idapp` (`idapp`),
  CONSTRAINT `developper_ibfk_1` FOREIGN KEY (`idpers`) REFERENCES `personne` (`id`),
  CONSTRAINT `developper_ibfk_2` FOREIGN KEY (`idapp`) REFERENCES `application` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developper`
--

LOCK TABLES `developper` WRITE;
/*!40000 ALTER TABLE `developper` DISABLE KEYS */;
/*!40000 ALTER TABLE `developper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libelles`
--

DROP TABLE IF EXISTS `libelles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libelles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libelles`
--

LOCK TABLES `libelles` WRITE;
/*!40000 ALTER TABLE `libelles` DISABLE KEYS */;
/*!40000 ALTER TABLE `libelles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mode_deploiement`
--

DROP TABLE IF EXISTS `mode_deploiement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mode_deploiement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mode_deploiement`
--

LOCK TABLES `mode_deploiement` WRITE;
/*!40000 ALTER TABLE `mode_deploiement` DISABLE KEYS */;
INSERT INTO `mode_deploiement` VALUES (1,'container','Un container est un ensemble léger et portable de composants logiciel permettent de déployer des app'),(2,'serveur','Un serveur est un ordinateur des données ou des ressources a autres ordinateurs (clients) sur un rés'),(3,'instalable','Un instalable est un fichier contenant un logiciel prêt à être installé sur un système d exploitatio'),(4,' container','Un container est un ensemble léger et portable de composants logiciel permettent de déployer des app'),(5,'instalable','l\'instalable c\'est le faite d\'installé des logiciel sur une machine physique'),(6,'server','Un serveur est un ordinateur des données '),(7,'server','Un serveur est un ordinateur des données '),(8,' container','givsdgruiuiuiu'),(9,'server','Un serveur est un ordinateur des données '),(10,'server','Un serveur est un ordinateur des données '),(11,' container','Un conteneur sert à structurer et centraliser le contenu sur une page web.'),(12,'server','Un serveur est un ordinateur des données '),(13,'server','Un serveur est un ordinateur des données '),(14,'server','Un serveur est un ordinateur des données ');
/*!40000 ALTER TABLE `mode_deploiement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveau_couche`
--

DROP TABLE IF EXISTS `niveau_couche`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `niveau_couche` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(15) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveau_couche`
--

LOCK TABLES `niveau_couche` WRITE;
/*!40000 ALTER TABLE `niveau_couche` DISABLE KEYS */;
INSERT INTO `niveau_couche` VALUES (1,'back-end','Le back-end est tout ce qui se passe du niveau serveur est aussi ce qu on ne voit pas a oeil nu'),(2,'front-end','Le front-end est la partie visible d une application'),(3,'full-stack','Un développeur full-stack est un professionnel capable de gérer à la fois le développement front-end'),(4,' back-end','Le back-end est tout ce qui se passe du niveau serveur est aussi ce qu on ne voit pas a oeil nu');
/*!40000 ALTER TABLE `niveau_couche` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personne`
--

DROP TABLE IF EXISTS `personne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personne` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(15) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `idtypers` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idtypers` (`idtypers`),
  CONSTRAINT `personne_ibfk_1` FOREIGN KEY (`idtypers`) REFERENCES `type_personne` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personne`
--

LOCK TABLES `personne` WRITE;
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` VALUES (4,'hambi','ange','hambi13@gmail.com','75469812',2),(6,'Balde ','fanta','balde18@gmail.com','542316879',1),(7,'Bamba','moussa','bamba19@gmail.com','65231478',1),(8,'Traore','moutapha','traore13@gmail.com','5214378',2),(9,'Kobenan','christ','kobenan25@gmail.com','9857412',1),(14,'diallo','hambe','diallo15@gmail.com','12457869',1),(19,'sylla','madou','sylla@gmail.com','52314687',1),(20,'diarrassouba','ramatou','diarrassouba1312@gmail.com','23564198',1);
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_personne`
--

DROP TABLE IF EXISTS `type_personne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_personne` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(15) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_personne`
--

LOCK TABLES `type_personne` WRITE;
/*!40000 ALTER TABLE `type_personne` DISABLE KEYS */;
INSERT INTO `type_personne` VALUES (1,'personne physiq','une personne physique est un ensemble information personnelle'),(2,'personne morale','une personne morale est un ensemble d entreprise'),(3,'physique','Une  personne physique est un ensemble information personnelle'),(4,'morale','une personne morale est un ensemble d entreprise'),(5,' physique','Une  personne physique est un ensemble information personnelle'),(6,'morale','une personne morale presente est entreprise'),(7,' physique','Une  personne physique est un ensemble information personnelle'),(8,' physique','Une  personne physique est un ensemble information personnelle'),(9,' physique','Une  personne physique est un ensemble information personnelle'),(10,' physique','Une  personne physique est un ensemble information personnelle'),(11,'morale','une personne morale est un ensemble d entreprise'),(12,' physique','Une  personne physique est un ensemble information personnelle'),(13,' physique','Une  personne physique est un ensemble information personnelle'),(14,' physique','Une  personne physique est un ensemble information personnelle'),(15,' physique','Une  personne physique est un ensemble information personnelle'),(16,'morale','une personne morale est un ensemble d entreprise');
/*!40000 ALTER TABLE `type_personne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gest_app'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-08 16:56:28
