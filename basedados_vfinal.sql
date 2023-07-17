-- MySQL dump 10.13  Distrib 8.0.22, for macos10.15 (x86_64)
--
-- Host: localhost    Database: Votos
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `Eleitor`
--

DROP TABLE IF EXISTS `Eleitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Eleitor` (
  `id_eleitor` int NOT NULL AUTO_INCREMENT,
  `password` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `administrador` tinyint NOT NULL,
  `tipo_id` varchar(45) NOT NULL,
  `nr_id` int NOT NULL,
  PRIMARY KEY (`id_eleitor`),
  UNIQUE KEY `nr_id_UNIQUE` (`nr_id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Eleitor`
--

LOCK TABLES `Eleitor` WRITE;
/*!40000 ALTER TABLE `Eleitor` DISABLE KEYS */;
INSERT INTO `Eleitor` VALUES (1,'admin','Admin','sequirei.costa11@icloud.com',1,'cc',12345),(2,'12345','Marco','Sequirei.costa11@gmail.com',0,'cc',12345566),(3,'12345','Pedro','pedrocunhasantos25@gmail.com',0,'cc',123455678),(4,'12345','utilizador1','goncalo.pinho0@gmail.com',0,'cc',12345611),(5,'12345','utilizador2','dragonite.costa@gmail.com',0,'bi',12344324);
/*!40000 ALTER TABLE `Eleitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Evento`
--

DROP TABLE IF EXISTS `Evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Evento` (
  `evento_id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descricao` longtext NOT NULL,
  `instrucoes` longtext NOT NULL,
  `observacoes` longtext NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  PRIMARY KEY (`evento_id`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evento`
--

LOCK TABLES `Evento` WRITE;
/*!40000 ALTER TABLE `Evento` DISABLE KEYS */;
INSERT INTO `Evento` VALUES (17,'Apresentação','Evento de demonstração','Demonstrar a votação','Votar','2021-05-12','2021-05-15');
/*!40000 ALTER TABLE `Evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Opcao`
--

DROP TABLE IF EXISTS `Opcao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Opcao` (
  `opcao_id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `evento_id` int NOT NULL,
  PRIMARY KEY (`opcao_id`),
  KEY `fk_Opcao_Evento1_idx` (`evento_id`),
  CONSTRAINT `fk_Opcao_Evento1` FOREIGN KEY (`evento_id`) REFERENCES `Evento` (`evento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Opcao`
--

LOCK TABLES `Opcao` WRITE;
/*!40000 ALTER TABLE `Opcao` DISABLE KEYS */;
INSERT INTO `Opcao` VALUES (32,'Jose',17),(33,'Pedro',17),(34,'Marco',17),(35,'Gonçalo',17);
/*!40000 ALTER TABLE `Opcao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Voto`
--

DROP TABLE IF EXISTS `Voto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Voto` (
  `voto_id` int NOT NULL AUTO_INCREMENT,
  `data_voto` date NOT NULL,
  `eleitor_id` int NOT NULL,
  `evento_id` int NOT NULL,
  `opcao_id` int NOT NULL,
  `anonimo` tinyint NOT NULL,
  PRIMARY KEY (`voto_id`),
  KEY `fk_Voto_Eleitor_idx` (`eleitor_id`),
  KEY `fk_Voto_Evento1_idx` (`evento_id`),
  KEY `fk_Voto_Opcao1_idx` (`opcao_id`),
  CONSTRAINT `fk_Voto_Eleitor` FOREIGN KEY (`eleitor_id`) REFERENCES `Eleitor` (`id_eleitor`),
  CONSTRAINT `fk_Voto_Evento1` FOREIGN KEY (`evento_id`) REFERENCES `Evento` (`evento_id`),
  CONSTRAINT `fk_Voto_Opcao1` FOREIGN KEY (`opcao_id`) REFERENCES `Opcao` (`opcao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Voto`
--

LOCK TABLES `Voto` WRITE;
/*!40000 ALTER TABLE `Voto` DISABLE KEYS */;
/*!40000 ALTER TABLE `Voto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-11 20:51:15
