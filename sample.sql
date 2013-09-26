CREATE DATABASE  IF NOT EXISTS `sample` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sample`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: sample
-- ------------------------------------------------------
-- Server version	5.5.24-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `connection`
--

DROP TABLE IF EXISTS `connection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `friendId` int(11) NOT NULL,
  PRIMARY KEY (`id`,`userId`,`friendId`),
  UNIQUE KEY `userId_friendId_UNIQUE` (`userId`,`friendId`),
  KEY `fk_connection_user_idx` (`userId`),
  KEY `fk_connection_user1_idx` (`friendId`),
  CONSTRAINT `fk_connection_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_connection_user1` FOREIGN KEY (`friendId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connection`
--

LOCK TABLES `connection` WRITE;
/*!40000 ALTER TABLE `connection` DISABLE KEYS */;
INSERT INTO `connection` VALUES (1,1,6),(2,1,2),(3,2,4),(4,5,8);
/*!40000 ALTER TABLE `connection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'johnsmith','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(2,'janesmith','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(3,'katemiddleton','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(4,'cyborg1','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(5,'katana','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(6,'georgeway','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(7,'shane','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'),(8,'harrypotter','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-26 17:11:17
