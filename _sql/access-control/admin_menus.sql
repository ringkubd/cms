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
-- Table structure for table `admin_menus`
--

DROP TABLE IF EXISTS `admin_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_uri` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_menus_name_index` (`name`),
  KEY `admin_menus_route_uri_index` (`route_uri`),
  KEY `admin_menus_method_index` (`method`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menus`
--

LOCK TABLES `admin_menus` WRITE;
/*!40000 ALTER TABLE `admin_menus` DISABLE KEYS */;
INSERT INTO `admin_menus` VALUES (1,1,'Access Control','fa-lock','#','GET',0,0,1,'Access Control Main Menu.',0,1,'2019-08-29 05:05:58','2019-08-29 05:17:29'),(2,1,'Admin Menu','fa-list','#','GET',1,0,1,'Parent Menu! ',0,1,'2019-08-29 05:07:10','2019-08-29 05:17:29'),(3,1,'All admin-menu','fa-list','admin-menu','GET',2,0,1,'Data Tables! ',0,1,'2019-08-29 05:07:11','2019-08-29 05:17:29'),(4,1,'Save admin-menu','','admin-menu','POST',2,NULL,0,'Store! ',0,1,'2019-08-29 05:07:11','2019-08-29 05:07:11'),(5,1,'Add admin-menu','fa-pencil-square-o','admin-menu/create','GET',2,1,1,'Create! ',0,1,'2019-08-29 05:07:11','2019-08-29 05:17:29'),(6,1,'Update admin-menu','','admin-menu/{admin_menu}','PUT',2,NULL,0,'Update! ',0,1,'2019-08-29 05:07:11','2019-08-29 05:07:11'),(7,1,'Show admin-menu','','admin-menu/{admin_menu}','GET',2,NULL,0,'Show! ',0,1,'2019-08-29 05:07:11','2019-08-29 05:07:11'),(8,1,'Destroy admin-menu','','admin-menu/{admin_menu}','DELETE',2,NULL,0,'Destroy! ',0,1,'2019-08-29 05:07:11','2019-08-29 05:07:11'),(9,1,'Edit admin-menu','','admin-menu/{admin_menu}/edit','GET',2,NULL,0,'Edit! ',0,1,'2019-08-29 05:07:11','2019-08-29 05:07:11'),(10,1,'Save Resource Menu','','save-resource-menu','POST',2,NULL,0,'Save Resource Menu',0,1,'2019-08-29 05:07:59','2019-08-29 05:08:11'),(11,1,'Clone Admin Menu','','admin-menu/{admin_menu}/clone','GET',2,NULL,0,'Clone Admin Menu',0,1,'2019-08-29 05:08:58','2019-08-29 05:08:58'),(12,1,'Users','fa-users','#','GET',1,2,1,'Parent Menu! ',0,1,'2019-08-29 05:10:47','2019-08-29 05:17:29'),(13,1,'All user','fa-list','user','GET',12,0,1,'Data Tables! ',0,1,'2019-08-29 05:10:48','2019-08-29 05:17:42'),(14,1,'Save user','','user','POST',12,NULL,0,'Store! ',0,1,'2019-08-29 05:10:48','2019-08-29 05:10:48'),(15,1,'Add user','fa-pencil-square-o','user/create','GET',12,1,1,'Create! ',0,1,'2019-08-29 05:10:48','2019-08-29 05:17:42'),(16,1,'Update user','','user/{user}','PUT',12,NULL,0,'Update! ',0,1,'2019-08-29 05:10:48','2019-08-29 05:10:48'),(17,1,'Show user','','user/{user}','GET',12,NULL,0,'Show! ',0,1,'2019-08-29 05:10:48','2019-08-29 05:10:48'),(18,1,'Destroy user','','user/{user}','DELETE',12,NULL,0,'Destroy! ',0,1,'2019-08-29 05:10:48','2019-08-29 05:10:48'),(19,1,'Edit user','','user/{user}/edit','GET',12,NULL,0,'Edit! ',0,1,'2019-08-29 05:10:48','2019-08-29 05:10:48'),(20,1,'Role','fa-user','#','GET',1,1,1,'Parent Menu! ',0,1,'2019-08-29 05:11:38','2019-08-29 05:17:29'),(21,1,'All role','fa-list','role','GET',20,0,1,'Data Tables! ',0,1,'2019-08-29 05:11:38','2019-08-29 05:17:37'),(22,1,'Save role','','role','POST',20,NULL,0,'Store! ',0,1,'2019-08-29 05:11:38','2019-08-29 05:11:38'),(23,1,'Add role','fa-pencil-square-o','role/create','GET',20,1,1,'Create! ',0,1,'2019-08-29 05:11:38','2019-08-29 05:17:37'),(24,1,'Update role','','role/{role}','PUT',20,NULL,0,'Update! ',0,1,'2019-08-29 05:11:38','2019-08-29 05:11:38'),(25,1,'Show role','','role/{role}','GET',20,NULL,0,'Show! ',0,1,'2019-08-29 05:11:38','2019-08-29 05:11:38'),(26,1,'Destroy role','','role/{role}','DELETE',20,NULL,0,'Destroy! ',0,1,'2019-08-29 05:11:38','2019-08-29 05:11:38'),(27,1,'Edit role','','role/{role}/edit','GET',20,NULL,0,'Edit! ',0,1,'2019-08-29 05:11:38','2019-08-29 05:11:38'),(28,1,'Setup Access','fa-check-square-o','#','GET',1,3,1,'Parent Menu!',0,1,'2019-08-29 05:12:14','2019-08-29 05:17:29'),(29,1,'Alignment','fa-list','setup-access','GET',28,0,1,'Data Tables!',0,1,'2019-08-29 05:12:14','2019-08-29 05:17:47'),(30,1,'Save setup-access','','setup-access','POST',28,NULL,0,'Store! ',0,1,'2019-08-29 05:12:14','2019-08-29 05:12:14'),(31,1,'Permission','fa-pencil-square-o','setup-access/create','GET',28,1,1,'Create!',0,1,'2019-08-29 05:12:14','2019-08-29 05:17:47'),(32,1,'Update setup-access','','setup-access/{setup_access}','PUT',28,NULL,0,'Update! ',0,1,'2019-08-29 05:12:14','2019-08-29 05:12:14'),(33,1,'Show setup-access','','setup-access/{setup_access}','GET',28,NULL,0,'Show! ',0,1,'2019-08-29 05:12:14','2019-08-29 05:12:14'),(34,1,'Destroy setup-access','','setup-access/{setup_access}','DELETE',28,NULL,0,'Destroy! ',0,1,'2019-08-29 05:12:14','2019-08-29 05:12:14'),(35,1,'Edit setup-access','','setup-access/{setup_access}/edit','GET',28,NULL,0,'Edit! ',0,1,'2019-08-29 05:12:14','2019-08-29 05:12:14'),(36,1,'Find Admin Menu','','find-admin-menu','POST',28,NULL,0,'Find Admin Menu BY AJAX Request',0,1,'2019-08-29 05:13:30','2019-08-29 05:13:30'),(37,1,'Find Alignment Menu','','find-alignment-menu','POST',28,NULL,0,'Find Alignment Menu by AJAX request.',0,1,'2019-08-29 05:14:16','2019-08-29 05:14:16'),(38,1,'Save Alignment','','save-alignment','POST',28,NULL,0,'Save Menu Alignment.',0,1,'2019-08-29 05:15:00','2019-08-29 05:15:00'),(39,1,'Artisan','fa-terminal','artisan','GET',1,4,1,'This menu control the artisan command.',0,1,'2019-09-01 04:07:37','2019-09-01 06:06:17'),(40,1,'Artisan Caching','','artisan/cache/{key}','GET',39,NULL,0,'This menu for Artisan Caching command.',0,1,'2019-09-01 04:51:28','2019-09-01 05:36:22'),(41,1,'Artisan Clear Caching','','artisan/clear-cache/{key}','GET',39,NULL,0,'This menu for Artisan Clear Cache command.',0,1,'2019-09-01 05:16:47','2019-09-01 05:36:12'),(42,1,'Artisan migration with seed.','','artisan/migrate-seed/{app_key}','GET',39,NULL,0,'This menu for Artisan migration with seed command.',0,1,'2019-09-01 05:47:51','2019-09-01 05:47:51'),(43,1,'Artisan Database seed','','artisan/db-seed/{app_key}','GET',39,NULL,0,'This menu for Artisan Database seed command.',0,1,'2019-09-01 06:10:00','2019-09-01 06:10:00'),(44,1,'Artisan Command Down','','artisan/down/{app_key}','GET',39,NULL,0,'This menu for Artisan Command Down command.',0,1,'2019-09-01 06:13:49','2019-09-01 06:13:49'),(45,1,'Artisan Command Up','','artisan/up/{app_key}','GET',39,NULL,0,'This menu for Artisan Command Up command.',0,1,'2019-09-01 06:14:06','2019-09-01 06:14:06');
/*!40000 ALTER TABLE `admin_menus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-01 12:31:30
