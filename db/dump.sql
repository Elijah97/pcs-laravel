-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: pcsdb
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

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
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicantId` int NOT NULL,
  `categoryId` int NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unitPrice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalPrice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neededBy` date DEFAULT NULL,
  `reviewStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Pending, 1: Reviewed, 2: Revoked',
  `reviewerId` int DEFAULT NULL,
  `reviewedDate` date DEFAULT NULL,
  `approveStatus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Pending, 1: Approved, 2: Revoked',
  `approverId` int DEFAULT NULL,
  `approvedDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,'Transport to carry staff',3,1,'Transport to carry staff\'s to the museum','2','1','2','2022-11-17','1',2,'2022-11-07','1',4,'2022-11-08','2022-11-02 12:48:49','2022-11-08 08:15:40'),(2,'Staff\'s Laptops',1,2,'Laptops needed for daily use of staffs.','4','1000000','4000000','2022-11-10','1',2,NULL,'2',4,'2022-11-08','2022-11-03 10:55:52','2022-11-08 08:13:57'),(3,'Markers needed',5,2,'We need markers in all offices for brainstorming.','100','1000','100000','2022-11-05','0',NULL,NULL,'0',NULL,NULL,'2022-11-03 14:50:29','2022-11-03 14:50:29'),(4,'HDMI cables',6,2,'We need HDMI cables.','5','10000','50000','2022-11-15','0',NULL,NULL,'0',NULL,NULL,'2022-11-03 15:39:11','2022-11-03 15:39:11'),(5,'Water dispanser',7,2,'We need water dispanser...','3','1000','3000','2022-11-13','1',8,'2022-11-07','1',4,'2022-11-08','2022-11-04 04:31:26','2022-11-08 08:22:22'),(6,'Test application',3,2,'Test application reason','100','100','10000','2022-11-09','1',2,NULL,'1',4,NULL,'2022-11-04 04:51:45','2022-11-04 04:53:11');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budgets`
--

DROP TABLE IF EXISTS `budgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `budgets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateFrom` date DEFAULT NULL,
  `dateTo` date DEFAULT NULL,
  `amount` int NOT NULL,
  `expenses` int DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Pending, 1: Active, 2: Revoked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budgets`
--

LOCK TABLES `budgets` WRITE;
/*!40000 ALTER TABLE `budgets` DISABLE KEYS */;
INSERT INTO `budgets` VALUES (1,'November\'s budget','2022-11-01','2022-11-30',96998,3002,'This Novermber\'s budget','1','2022-11-02 11:23:06','2022-11-08 08:22:22'),(2,'December\'s budget','2022-12-01','2022-12-31',200000,NULL,'This is December\'s budget','1','2022-11-02 11:23:40','2022-11-08 07:12:54'),(3,'Test Budget','2023-01-01','2023-01-31',210909,NULL,'Tets budget','1','2022-11-08 06:36:30','2022-11-08 07:13:17');
/*!40000 ALTER TABLE `budgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Pending, 1: Active, 2: Revoked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Transport','This is Transport','1','2022-11-02 11:21:32','2022-11-02 11:21:32'),(2,'Office equipment','This is office equipment','1','2022-11-02 11:21:51','2022-11-02 11:21:51'),(3,'Toiletries','This is toiletries','1','2022-11-02 11:22:15','2022-11-02 11:22:15');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboards`
--

DROP TABLE IF EXISTS `dashboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboards`
--

LOCK TABLES `dashboards` WRITE;
/*!40000 ALTER TABLE `dashboards` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (33,'2014_10_12_000000_create_users_table',1),(34,'2014_10_12_100000_create_password_resets_table',1),(35,'2019_08_19_000000_create_failed_jobs_table',1),(36,'2019_12_14_000001_create_personal_access_tokens_table',1),(37,'2022_10_31_144248_create_dashboards_table',1),(38,'2022_11_01_140607_create_categories_table',1),(39,'2022_11_01_142055_create_budgets_table',1),(40,'2022_11_01_142156_create_applications_table',1),(41,'2022_11_02_135308_add_needed_by_to_applications_table',2),(42,'2022_11_07_090402_add_dates_to_applications_table',3),(43,'2022_11_08_074904_add_date_to_budgets_table',4),(44,'2022_11_08_090719_add_date_to_to_budgets_table',5),(45,'2022_11_08_094634_update_date_to_date_from_to_budgets_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `serv_no` int DEFAULT NULL,
  `rank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `names` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int NOT NULL COMMENT '0: Head DRD, 1: Superior, 2: Applicant, 99: System Admin',
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0: Pending, 1: Active, 2: Revoked',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,NULL,'Elie Kagabo',NULL,'ekagabo@minadef.gov.rw','$2y$10$o5wve1cY7Dnfp4568Q2eD.4jfKIHqJaqmChntA0ZtsXKxNhJzLxO.','0789746476',NULL,NULL,99,NULL,NULL,'1',NULL,'2022-11-02 10:42:08','2022-11-03 16:39:02'),(2,1234,'Captain','JMV Sendanyoye','Male','directoranalytics@minadef.gov.rw','$2y$10$g1ToSPj/pG.EGQ./74fnsufZgDlZpN81ET11zg5CJblayGzsmQ28m','0789794268','Test Function','Test Unit',1,'Analytics',NULL,'1',NULL,'2022-11-02 11:03:55','2022-11-02 11:03:55'),(3,1234,'Lieutenant','Joyeuse Mahoro','Female','joyeusemah@gmail.com','$2y$10$v9.jWf5eUfeSekjfW/NNp.lHk0XTsNBVmhAASliwaExXHs5DVyRvC','0789795478','Test Function','Test unit',2,'Analytics',NULL,'1',NULL,'2022-11-02 11:04:53','2022-11-02 11:04:53'),(4,3223,'Captain','Alexia Munyeshyaka','Female','alexia@minadef.gov.rw','$2y$10$sLeat2jEstz1jYW.UQQ/PuYDC9gwzAXbo.sK72CHt35R1cILg27Au','0789765765','The function','The unit',0,'N/A',NULL,'1',NULL,'2022-11-02 11:20:19','2022-11-02 11:20:19'),(5,84398,'2nd Lieutenant','Frank Habimana','Male','frank@minadef.gov.rw','$2y$10$TZLmLtRLxI0F8LSiLHpHXuvC8X9JoBhs7ki6PFeT7U4M1HwBBqBjq','0789797657','Test function','Test unit',2,'Analytics',NULL,'1',NULL,'2022-11-03 14:48:29','2022-11-03 14:48:29'),(6,8548,'Lieutenant','Job Maniragaba','Male','job@minadef.gov.rw','$2y$10$w1kHRaWalxgIzB1XYauOH.B415NrNsI6SiLpI.7yksKsW0GfHbS1u','0789774658','Another test function','Another test unit',2,'Industries',NULL,'1',NULL,'2022-11-03 15:00:34','2022-11-03 15:00:34'),(7,9090,'2nd Lieutenant','Janvier Muhoza Muhoranyi','Male','janvier@minadef.gov.rw','$2y$10$4h8NPsUS/tGg1tV2tt31wuKSWhbN4UQU0y.63GZ2mLZJWI88lRJAm','0789797677','Test function','Test unit',2,'Science',NULL,'1',NULL,'2022-11-04 04:30:03','2022-11-04 04:31:56'),(8,89898,'Captain','Sam Gatete','Male','sam@minadef.gov.rw','$2y$10$Mx8K1aTubFqQAnAuI.JymOsyNDdBvc8V1UWT6vk/Cvhld8HgdrWOG','087898898','Test function','Test unit',1,'Science',NULL,'1',NULL,'2022-11-04 04:34:09','2022-11-04 04:34:09');
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

-- Dump completed on 2022-11-08 18:19:40
