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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Super-Admin',NULL,'male',1,0,'photos/shares/Avatar/2019-09/1567319260-head-659652_960_720.png','superadmin@email.com','2019-08-29 05:03:02','$2y$10$3W/P5xsaKoaoYYP2uzceBO1CPOjDpi/SBUTQOI8NKB66Nd982as/u',NULL,'2019-08-29 05:01:17','2019-08-29 05:03:02'),(2,1,'Administrator',NULL,'male',2,0,'photos/shares/Avatar/2019-09/1567319260-head-659652_960_720.png','administrator@email.com',NULL,'$2y$10$TWuH1/gOOz7ZpZYtsbQf6OKVLvQYSkfSNx42T.PrwhG0PX0bpDDWq',NULL,'2019-08-29 05:27:53','2019-09-01 06:27:40'),(3,1,'Editor',NULL,'male',3,0,'photos/shares/Avatar/2019-09/1567319279-dummy-profile-pic-1.jpg','editor@email.com',NULL,'$2y$10$GjBnfevpGSBjkofuCVt1Eebs3QjoHvss/QcosSYeurrKD4WAw5TrS',NULL,'2019-08-29 05:28:19','2019-09-01 06:27:59'),(4,1,'Contributor',NULL,'male',4,0,'photos/shares/Avatar/2019-09/1567319297-user-307993__340.png','contributor@email.com',NULL,'$2y$10$VI7H.V.MAzyuburyYvcQZu99UPVIsrkT9aIUv00Nq1UDCABZHj1ge',NULL,'2019-08-29 05:28:45','2019-09-01 06:28:18'),(5,1,'Subscriber',NULL,'male',5,0,'photos/shares/Avatar/2019-09/1567319311-images.png','Subscriber@email.com',NULL,'$2y$10$ZqfN/Afb4cYa7xLCwHPehu2Lyex10HzvI0vYNSSZ1EE0FapPXesH6',NULL,'2019-08-29 05:29:08','2019-09-01 06:28:31');
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

-- Dump completed on 2019-09-03  9:44:45
