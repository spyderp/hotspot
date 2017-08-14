-- MySQL dump 10.15  Distrib 10.0.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.0.29-MariaDB-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cliente` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (8,'Ricardo Portillo','spyderp@gmail.com','2666055',0),(9,'Oracio Perez','oracio.perez@gmail.com','511-4536',1);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registers`
--

DROP TABLE IF EXISTS `registers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registers`
--

LOCK TABLES `registers` WRITE;
/*!40000 ALTER TABLE `registers` DISABLE KEYS */;
INSERT INTO `registers` VALUES (1,'2017-08-13 21:13:34',8),(2,'2017-08-13 21:38:13',8),(3,'2017-08-13 22:09:56',8),(4,'2017-08-13 22:10:44',9),(5,'2018-06-10 03:15:36',9),(6,'2018-05-11 06:44:06',9),(7,'2017-10-15 14:53:46',8),(8,'2018-06-20 15:38:14',8),(9,'2017-10-05 17:40:38',9),(10,'2017-10-22 16:13:58',9),(11,'2018-06-30 14:46:11',8),(12,'2017-09-22 02:37:33',9),(13,'2018-01-18 13:08:54',8),(14,'2018-04-22 13:32:51',8),(15,'2018-04-22 13:18:23',9),(16,'2018-04-25 05:02:47',8),(17,'2018-07-20 04:42:32',8),(18,'2018-06-16 16:34:28',9),(19,'2018-04-17 01:32:23',9),(20,'2017-11-11 08:16:23',8),(21,'2017-11-12 22:36:05',9),(22,'2017-12-13 12:59:02',9),(23,'2017-09-19 15:45:27',9),(24,'2018-08-13 20:09:53',9),(25,'2017-10-21 10:36:37',8),(26,'2017-10-27 20:14:14',9),(27,'2017-09-03 04:41:18',8),(28,'2017-09-06 10:39:44',9),(29,'2018-04-12 07:31:57',9),(30,'2017-08-30 16:16:11',9),(31,'2017-11-13 05:00:51',9),(32,'2017-09-14 18:21:55',9),(33,'2017-12-23 22:04:49',8),(34,'2018-06-05 20:28:10',9),(35,'2017-09-18 08:33:50',9),(36,'2018-02-02 00:29:18',8),(37,'2018-07-31 22:48:31',8),(38,'2018-04-26 17:21:42',9),(39,'2017-11-25 20:44:39',9),(40,'2018-05-03 15:35:07',9),(41,'2018-05-24 22:45:35',9),(42,'2017-12-11 18:02:35',8),(43,'2018-02-19 10:03:56',8),(44,'2017-10-04 16:49:23',9),(45,'2017-08-14 20:19:25',9),(46,'2018-01-11 04:00:19',9),(47,'2017-09-20 00:27:37',9),(48,'2018-07-08 00:31:47',9),(49,'2017-09-20 07:40:35',8),(50,'2017-10-04 08:13:56',8),(51,'2018-03-05 18:28:29',9),(52,'2018-07-31 10:02:45',8),(53,'2018-04-22 14:11:05',9),(54,'2018-05-20 10:41:08',8),(55,'2018-06-23 23:57:56',8),(56,'2017-11-05 12:36:57',8),(57,'2017-12-03 14:21:46',9),(58,'2018-05-15 23:00:08',9),(59,'2018-01-10 11:43:40',8),(60,'2018-02-10 08:26:10',8),(61,'2017-12-03 17:28:39',8),(62,'2018-08-02 14:24:55',8),(63,'2017-10-29 17:33:58',9),(64,'2018-06-12 02:38:46',8),(65,'2017-11-09 12:01:48',8),(66,'2017-08-07 04:54:32',9),(67,'2018-03-25 05:05:02',8),(68,'2018-01-15 19:05:59',8),(69,'2018-05-22 21:47:00',8),(70,'2018-05-05 05:31:26',8),(71,'2017-12-05 15:25:52',9),(72,'2018-06-12 07:58:21',8),(73,'2017-09-30 12:43:39',8),(74,'2018-02-15 10:58:01',9),(75,'2017-10-15 20:53:57',9),(76,'2017-12-30 05:30:14',8),(77,'2017-11-11 10:28:57',8),(78,'2018-02-19 16:55:25',8),(79,'2018-07-20 05:19:06',9),(80,'2017-10-12 04:44:48',8),(81,'2017-11-07 05:09:07',9),(82,'2018-03-06 05:54:47',9),(83,'2017-08-20 11:52:14',8),(84,'2018-04-01 20:37:56',8),(85,'2018-06-08 03:37:41',8),(86,'2017-08-16 10:22:30',9),(87,'2017-09-10 01:09:03',9),(88,'2017-10-31 02:55:45',8),(89,'2018-02-13 23:30:53',8),(90,'2017-11-05 15:18:13',9),(91,'2018-06-03 00:41:38',8),(92,'2017-08-23 11:55:30',9),(93,'2017-10-24 11:15:04',9),(94,'2017-09-23 03:12:39',9),(95,'2017-08-12 17:53:28',9),(96,'2018-07-16 22:40:02',8),(97,'2018-07-01 16:50:08',9),(98,'2018-03-30 19:34:39',8),(99,'2018-04-08 21:58:01',9),(100,'2017-12-04 19:35:58',9),(101,'2017-10-18 17:04:16',8),(102,'2017-11-21 10:12:54',8),(103,'2017-09-03 12:59:39',8),(104,'2017-10-17 08:47:32',9);
/*!40000 ALTER TABLE `registers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','$2y$10$uxhBvA6xjrY.AkN2cgX7s.bTrqmC13AjINq3t8rQPF1pW7pV6MpfO','admin','2017-08-13 23:26:55','2017-08-13 23:26:55');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-13 21:53:30
