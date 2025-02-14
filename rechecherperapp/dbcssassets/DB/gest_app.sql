-- MySQL dump 10.13  Distrib 8.2.0, for Win64 (x86_64)
--
-- Host: localhost    Database: gest_app
-- ------------------------------------------------------
-- Server version	8.2.0

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
) ENGINE=InnoDB AUTO_INCREMENT=4455666 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (2,'mic-reporting','Un reporting est une application de la gestion des comptes comptables ','en cours','3.1.2',1,2,1),(4455555,'mic-utilisateur-api','une application qui permet de gere les utilisateurs','terminer','2.1.2',1,1,1),(4455556,'gest-Bulletin','une application qui permet de géré les bulletin des fonctionnaires','terminer','2.1.2',2,2,3),(4455557,'gest-parc','une application qui permet de gere les utilisateurs dans un parc','terminer','2.1.2',2,1,1),(4455587,'gest-livreur','les entreprises ont besoin des application mobile qui permet de controleur les differents livreurs sur la livraision des marchandise','termine','2.4.4',2,3,3),(4455588,'gest-route','La gestion de route  l&amp;#039;application va permet de surveiller l&amp;#039;incivisme des usage ','termine','2.4.1',2,2,1),(4455636,'gest-solde','les entreprises ont besoin des application mobile pour mieux travail','terminer','1.3.1',2,2,3),(4455637,'gest-garage','les entreprises ont besoin des application mobile pour mieux travail','terminer','2.4.2',2,1,3),(4455638,'gest-budget','les entreprises ont besoin des application mobile pour mieux travail','en cours','2.4.3',2,3,3),(4455640,'gest-cinema','les entreprises ont besoin des application mobile pour mieux travail','en cours','2.4.4',1,3,3),(4455644,'gest-voiture','une application qui permet de gere les utilisateurs dans les circulations','en cours','2.4.1',2,2,1),(4455645,'gest-voiture','une application qui permet de gere les utilisateurs dans les circulations','en cours','2.4.1',1,2,3),(4455646,'gest-garage','les entreprises ont besoin des application mobile pour mieux travail dans le garage','en cours','1.1.2',1,2,3),(4455647,'gest-stade','La gestion d&#039;un stade consiste à cré unne application mobile qui mettre de détecté les érreurs , les fautes  sur le terrain  ciflé par un arbitre','termine','2.5.4',1,1,3),(4455650,'gest-sotra','La gestion  du sotra est une application mobile qui permet la gestion des ticket','termine','2.4.6',2,1,1),(4455651,'gest-fleur','La gestion  d&amp;amp;#039;une fleur est une application mobile qui permet de surveiller  l&amp;amp;#039;evolution de fleur','termine','2.4.6',2,1,1),(4455653,'gest-immobilier','La gestion des immobiliers  consiste à géré les alarmes électrique','termine','2.4.1',2,1,1),(4455654,'gest-chausseurs','La gestion de chausseure est une application mobile des chausseur électrique','en cours','2.4.4',2,1,1),(4455655,'gest_photographe','les entreprises ont besoin des application mobile pour mieux geré les photo','terminer','1.1.2',1,2,3),(4455657,'gest_ordinateur','les entreprises ont besoin des application mobile pour mieux travail','terminer','2.1.5',1,1,1),(4455658,'gest_station','Gerer une application mobile qui va facilité la gestion du système de a station','en cours','2.4.4',2,2,3),(4455659,'gest_pharmacie','La gestion de la pharmacie  sert à gérer les médicaments ','en cours','2.4.2',1,3,1),(4455660,'gest_contact','La gestion des contactes sert avoir toutes les informations sur une personne dans l&amp;amp;amp;amp;amp;amp;#039;entreprise','termine','2.4.4',2,2,3),(4455665,'gest_programme','La gestion des programmes permettent de construire des application','en cours','2.4.2',1,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `architecture`
--

LOCK TABLES `architecture` WRITE;
/*!40000 ALTER TABLE `architecture` DISABLE KEYS */;
INSERT INTO `architecture` VALUES (1,'microservice','Un microservice est ensemble d architecture qui separe une application en plusieurs petites service'),(2,'monolytique','monolytique est un ensemble d architecture qui regroupe plusieurs petit service dans une seule appli');
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
  KEY `idpers` (`idpers`),
  CONSTRAINT `developper_ibfk_1` FOREIGN KEY (`idpers`) REFERENCES `personne` (`id`),
  CONSTRAINT `developper_ibfk_2` FOREIGN KEY (`idapp`) REFERENCES `application` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `developper`
--

LOCK TABLES `developper` WRITE;
/*!40000 ALTER TABLE `developper` DISABLE KEYS */;
INSERT INTO `developper` VALUES (4,2),(6,2),(58,2),(74,2),(6,4455555),(4,4455556),(6,4455556),(9,4455556),(4,4455557),(8,4455557),(58,4455557),(80,4455557),(6,4455587),(9,4455587),(54,4455587),(58,4455587),(71,4455587),(72,4455587),(7,4455588),(71,4455588),(76,4455588),(78,4455588),(4,4455636),(6,4455636),(14,4455636),(20,4455636),(54,4455636),(76,4455636),(78,4455636),(54,4455637),(74,4455637),(76,4455637),(78,4455637),(19,4455638),(74,4455638),(58,4455640),(72,4455640),(14,4455644),(19,4455644),(72,4455644),(14,4455645),(77,4455645),(4,4455646),(77,4455646),(77,4455647),(74,4455651),(77,4455651),(20,4455653),(72,4455653),(74,4455653),(20,4455654),(54,4455654),(73,4455654),(19,4455655),(20,4455655),(75,4455655),(20,4455657),(74,4455657),(4,4455658),(80,4455660);
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mode_deploiement`
--

LOCK TABLES `mode_deploiement` WRITE;
/*!40000 ALTER TABLE `mode_deploiement` DISABLE KEYS */;
INSERT INTO `mode_deploiement` VALUES (1,'container','Un container est un ensemble léger et portable de composants logiciel permettent de déployer des app'),(2,'serveur','Un serveur est un ordinateur des données ou des ressources a autres ordinateurs (clients) sur un rés'),(3,'instalable','Un instalable est un fichier contenant un logiciel prêt à être installé sur un système d exploitatio');
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveau_couche`
--

LOCK TABLES `niveau_couche` WRITE;
/*!40000 ALTER TABLE `niveau_couche` DISABLE KEYS */;
INSERT INTO `niveau_couche` VALUES (1,'back-end','Le back-end est tout ce qui se passe du niveau serveur est aussi ce qu on ne voit pas a oeil nu'),(3,'full-stack','Un développeur full-stack est un professionnel capable de gérer à la fois le développement front-end'),(4,' front-end','Le front-end est tout ce qui se passe du design visuel joue un rôle clé dans application');
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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personne`
--

LOCK TABLES `personne` WRITE;
/*!40000 ALTER TABLE `personne` DISABLE KEYS */;
INSERT INTO `personne` VALUES (4,'hambi    ','ange','hambi13@gmail.com','0575469812',2),(6,'Balde ','fanta','balde18@gmail.com','0742316879',1),(7,'Bamba','moussa','bamba19@gmail.com','0565231478',1),(8,'Traore','moutapha','traore13@gmail.com','0521437843',2),(9,'Kobenan','christ','kobenan25@gmail.com','0139857412',1),(14,'diallo','hambe','diallo15@gmail.com','0112457869',1),(19,'sylla','madou','sylla@gmail.com','0752314687',1),(20,'diarrassouba','ramatou','diarrassouba1312@gmail.com','0723564198',1),(54,'Aman','kramo','Aman23@gmail','0152345167',14),(58,'Akouya','Fatoumata','konef1387@gmail.com','0501870846',14),(69,'Diabaté','ali','diabate23@gmail.com','0565743231',14),(71,'Gore','Anne','gore16@gmail17.com','0574874924',14),(72,'Kouadio','Joel','Kouadia14@gmail.com','0123546728',NULL),(73,'Edmond','prince','Edmond14@gmail.com','0745657875',NULL),(74,'koffi','Melissa','koffi17@gmail.com','087675654',1),(75,'Belem','yacou','Belem20@gmail.com','0134233145',NULL),(76,'Gare','grace','Gare21@gmail.com','0556473889',11),(77,'Vi ','Christ','Vi21@gmail.com','0768345783',11),(78,'Diabaté','moussa','Diabate21@gmail.com','0523136450',11),(80,'Sane','prince','sane21@gmail.com','0735462767',NULL);
/*!40000 ALTER TABLE `personne` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `selected_applications`
--

DROP TABLE IF EXISTS `selected_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `selected_applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `selected_applications`
--

LOCK TABLES `selected_applications` WRITE;
/*!40000 ALTER TABLE `selected_applications` DISABLE KEYS */;
INSERT INTO `selected_applications` VALUES (1,'mic-reporting'),(2,'mic-utilisateur-api'),(3,'gest-centreformation'),(4,'mic-reporting'),(5,'mic-utilisateur-api'),(6,'gest-centreformation'),(7,'gest-entreprise'),(8,'gest-meuble'),(9,'gest-solde'),(10,'gest-garage'),(11,'mic-reporting'),(12,'mic-utilisateur-api');
/*!40000 ALTER TABLE `selected_applications` ENABLE KEYS */;
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
INSERT INTO `type_personne` VALUES (1,'Personne physiq','une personne physique est un ensemble information personnelle'),(2,'Personne morale','une personne morale est un ensemble d entreprise'),(11,' Personne moral','une personne morale est un ensemble d entreprise'),(14,'Personne physiq','Une  personne physique est un ensemble information personnelle');
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

-- Dump completed on 2025-02-05 11:27:43
