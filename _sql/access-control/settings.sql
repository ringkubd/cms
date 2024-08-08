-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: isbd_bisew_2.00
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

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
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,1,'site_title','IsDB-BISEW',1,NULL,'2019-09-04 05:55:19'),(2,1,'tagline','Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf',1,NULL,'2019-09-04 05:55:19'),(3,1,'logo_preview','title',1,NULL,'2019-09-04 05:55:19'),(4,1,'logo_picture','photos/shares/Logos/2019-09/1567575687-logo.png',1,NULL,'2019-09-04 05:41:27'),(5,1,'home_url','http://www.isdb-bisew.org',1,NULL,'2019-09-04 05:55:19'),(6,1,'meta_title','Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf (IsDB-BISEW)',1,NULL,'2019-09-04 05:55:19'),(7,1,'meta_desc','Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf  was established following an agreement between the Islamic Development Bank, Jeddah, Saudi Arabia, and the Government of Bangladesh.',1,NULL,'2019-09-04 05:55:20'),(8,1,'meta_picture','photos/shares/Meta-Picture/2019-09/1567576386-177585.jpg',1,NULL,'2019-09-04 05:53:07'),(9,1,'date_format','d-m-Y',1,NULL,'2019-09-04 05:55:20'),(10,1,'time_format','g:i a',1,NULL,'2019-09-04 05:55:20'),(11,1,'default_theme','default',1,NULL,'2019-09-04 05:00:43'),(12,1,'facebook_url','https://www.youtube.com/channel/UCpkDA8qqR7tfvvTeXna5mkw',1,NULL,'2019-09-04 05:55:20'),(13,1,'linkedin_url','https://www.youtube.com/channel/UCpkDA8qqR7tfvvTeXna5mkw',1,NULL,'2019-09-04 05:55:20'),(14,1,'youtube_url',NULL,1,NULL,'2019-09-04 05:55:20'),(15,1,'meta_key','isdb, isdb-bisew',1,NULL,'2019-09-04 05:55:19');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-04 11:56:11
