-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	5.7.22

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
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branches_company_id_foreign` (`company_id`),
  CONSTRAINT `branches_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,1,'DZ','#F64272','Wagramerstraße 94, Top 1A','+43 1 3694001','2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,1,'DZ Neu','#0a9901','Wagramerstraße 94, Top 1A','+43 1 3694001','2019-10-29 10:57:49','2019-10-29 10:57:49'),(3,1,'KG','#0970c7','Kirchengasse 1, Mariahilferstraße 50','+43 1 3694001','2019-10-29 10:57:49','2019-10-29 10:57:49'),(4,1,'Huma','#ec9a5d','Landwehrstraße 6, Top 126A','+43 1 7670666','2019-10-29 10:57:49','2019-10-29 10:57:49');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Apple','https://image.flaticon.com/icons/png/128/37/37150.png','2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,'Samsung','http://assets.stickpng.com/thumbs/580b57fcd9996e24bc43c533.png','2019-10-29 10:57:49','2019-10-29 10:57:49'),(3,'Huawei','https://www.freepnglogos.com/uploads/huawei-logo-png/huawei-logo-icon-11.png','2019-10-29 10:57:49','2019-10-29 10:57:49'),(4,'LG','http://www.myiconfinder.com/uploads/iconsets/256-256-d14c8c035b3c8f8d7c74085ce761c24e-lg.png','2019-10-29 10:57:49','2019-10-29 10:57:49'),(5,'Sony','https://etree.de/wp-content/uploads/2018/09/sony-logo-etree.jpg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(6,'OnePlus','https://cdn.iconscout.com/icon/free/png-256/oneplus-282590.png','2019-10-29 10:57:49','2019-10-29 10:57:49'),(7,'Oppo','https://hashmart.co.ke/media/brand/o/p/oppo.png','2019-10-29 10:57:49','2019-10-29 10:57:49'),(8,'Vivo','https://cdn.iconscout.com/icon/free/png-256/vivo-1-285323.png','2019-10-29 10:57:49','2019-10-29 10:57:49'),(9,'Xiaomi','https://cdn.iconscout.com/icon/free/png-256/xiaomi-2-722656.png','2019-10-29 10:57:49','2019-10-29 10:57:49');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cashboxes`
--

DROP TABLE IF EXISTS `cashboxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cashboxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cashboxes`
--

LOCK TABLES `cashboxes` WRITE;
/*!40000 ALTER TABLE `cashboxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cashboxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colors`
--

LOCK TABLES `colors` WRITE;
/*!40000 ALTER TABLE `colors` DISABLE KEYS */;
INSERT INTO `colors` VALUES (1,'none','2019-10-29 10:57:51','2019-10-29 10:57:51'),(2,'Black','2019-10-29 10:57:51','2019-10-29 10:57:51'),(3,'White','2019-10-29 10:57:51','2019-10-29 10:57:51'),(4,'Silver','2019-10-29 10:57:51','2019-10-29 10:57:51'),(5,'Product Red','2019-10-29 10:57:51','2019-10-29 10:57:51'),(6,'Space Gray','2019-10-29 10:57:51','2019-10-29 10:57:51'),(7,'Midnight Green','2019-10-29 10:57:51','2019-10-29 10:57:51'),(8,'Gold','2019-10-29 10:57:51','2019-10-29 10:57:51'),(9,'Blue','2019-10-29 10:57:51','2019-10-29 10:57:51'),(10,'Pink','2019-10-29 10:57:51','2019-10-29 10:57:51'),(11,'Yellow','2019-10-29 10:57:51','2019-10-29 10:57:51'),(12,'Green','2019-10-29 10:57:51','2019-10-29 10:57:51');
/*!40000 ALTER TABLE `colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` int(10) unsigned NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_name_unique` (`name`),
  KEY `companies_currency_id_foreign` (`currency_id`),
  CONSTRAINT `companies_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'PhoneFactory',1,'Wagramerstraße 94, Top 1A','+43 1 3694001','2019-10-29 10:57:49','2019-10-29 10:57:49');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currencies_name_unique` (`name`),
  UNIQUE KEY `currencies_symbol_unique` (`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'Euro','EUR','2019-10-29 10:57:49','2019-10-29 10:57:49');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_has_branches`
--

DROP TABLE IF EXISTS `customer_has_branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_has_branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_has_branches_customer_id_foreign` (`customer_id`),
  KEY `customer_has_branches_branch_id_foreign` (`branch_id`),
  CONSTRAINT `customer_has_branches_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `customer_has_branches_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_has_branches`
--

LOCK TABLES `customer_has_branches` WRITE;
/*!40000 ALTER TABLE `customer_has_branches` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_has_branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_types`
--

DROP TABLE IF EXISTS `customer_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_types`
--

LOCK TABLES `customer_types` WRITE;
/*!40000 ALTER TABLE `customer_types` DISABLE KEYS */;
INSERT INTO `customer_types` VALUES (1,'Person','2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,'Company','2019-10-29 10:57:49','2019-10-29 10:57:49');
/*!40000 ALTER TABLE `customer_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` int(10) unsigned NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stars_number` double DEFAULT NULL,
  `type_id` int(10) unsigned DEFAULT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_person_id_unique` (`person_id`),
  KEY `customers_type_id_foreign` (`type_id`),
  KEY `customers_company_id_foreign` (`company_id`),
  KEY `customers_created_by_foreign` (`created_by`),
  CONSTRAINT `customers_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `customers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `customers_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  CONSTRAINT `customers_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `customer_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discount_codes`
--

DROP TABLE IF EXISTS `discount_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discount_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `procent` double(8,2) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discount_codes`
--

LOCK TABLES `discount_codes` WRITE;
/*!40000 ALTER TABLE `discount_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_user_id_foreign` (`user_id`),
  KEY `employees_role_id_foreign` (`role_id`),
  CONSTRAINT `employees_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,1,1,'2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,2,5,'2019-10-29 11:03:41','2019-10-29 11:03:41');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenditure_items`
--

DROP TABLE IF EXISTS `expenditure_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenditure_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenditure_items`
--

LOCK TABLES `expenditure_items` WRITE;
/*!40000 ALTER TABLE `expenditure_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenditure_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `from_transactions`
--

DROP TABLE IF EXISTS `from_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `from_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `from_transactions`
--

LOCK TABLES `from_transactions` WRITE;
/*!40000 ALTER TABLE `from_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `from_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(10) unsigned NOT NULL,
  `brand_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `submodel_id` int(10) unsigned NOT NULL,
  `part_id` int(10) unsigned NOT NULL,
  `color_id` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goods_branch_id_foreign` (`branch_id`),
  KEY `goods_brand_id_foreign` (`brand_id`),
  KEY `goods_model_id_foreign` (`model_id`),
  KEY `goods_submodel_id_foreign` (`submodel_id`),
  KEY `goods_part_id_foreign` (`part_id`),
  KEY `goods_color_id_foreign` (`color_id`),
  CONSTRAINT `goods_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `goods_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  CONSTRAINT `goods_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  CONSTRAINT `goods_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`),
  CONSTRAINT `goods_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`),
  CONSTRAINT `goods_submodel_id_foreign` FOREIGN KEY (`submodel_id`) REFERENCES `submodels` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods_categories`
--

DROP TABLE IF EXISTS `goods_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `header_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods_categories`
--

LOCK TABLES `goods_categories` WRITE;
/*!40000 ALTER TABLE `goods_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `goods_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `artikelbeschreibung` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menge` int(11) NOT NULL,
  `preis` double NOT NULL,
  `kostenvoranschlag_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `items_kostenvoranschlag_id_foreign` (`kostenvoranschlag_id`),
  CONSTRAINT `items_kostenvoranschlag_id_foreign` FOREIGN KEY (`kostenvoranschlag_id`) REFERENCES `kostenvoranschlags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kaufvertrags`
--

DROP TABLE IF EXISTS `kaufvertrags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kaufvertrags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ort_plz` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobil` tinyint(4) NOT NULL DEFAULT '0',
  `tablet` tinyint(4) NOT NULL DEFAULT '0',
  `modell` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imei` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_body` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ort_datum` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kaufvertrags`
--

LOCK TABLES `kaufvertrags` WRITE;
/*!40000 ALTER TABLE `kaufvertrags` DISABLE KEYS */;
/*!40000 ALTER TABLE `kaufvertrags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kostenvoranschlags`
--

DROP TABLE IF EXISTS `kostenvoranschlags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kostenvoranschlags` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kost29` tinyint(4) NOT NULL DEFAULT '0',
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kundenbetreuer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zahlungsmodalitat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunde` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunde_tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunde_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_head` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_body` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kostenvoranschlags`
--

LOCK TABLES `kostenvoranschlags` WRITE;
/*!40000 ALTER TABLE `kostenvoranschlags` DISABLE KEYS */;
/*!40000 ALTER TABLE `kostenvoranschlags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `logins_username_unique` (`username`),
  UNIQUE KEY `logins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` VALUES (1,'me@phonefactory.at','$2y$10$.WQ9nMrzD.sj20xQZgjDAOIVzQcR9Ao/PzDXVQh0i4upx4h8ecds6',1,NULL,'me@phonefactory.at','2019-10-29'),(2,'support@relist.at','$2y$10$rkmPsLluuxXS5VWcbY7u3.PoD3RNJDErUZNGFQoWiDdtg8wwC1q3m',1,NULL,'support@relist.at',NULL);
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2016_06_01_000001_create_oauth_auth_codes_table',1),(2,'2016_06_01_000002_create_oauth_access_tokens_table',1),(3,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(4,'2016_06_01_000004_create_oauth_clients_table',1),(5,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(6,'2019_03_13_120937_create_currencies_table',1),(7,'2019_03_14_195207_create_logins_table',1),(8,'2019_03_23_113619_create_password_resets_table',1),(9,'2019_04_05_212220_create_people_table',1),(10,'2019_04_10_221652_create_kostenvoranschlags_table',1),(11,'2019_04_11_163205_create_kaufvertrags_table',1),(12,'2019_04_12_123618_create_rechnung_hand_difs_table',1),(13,'2019_04_12_135709_create_rechnung_items_table',1),(14,'2019_04_14_100016_create_companies_table',1),(15,'2019_04_14_100028_create_branches_table',1),(16,'2019_05_09_222450_create_items_table',1),(17,'2019_05_14_195438_create_users_table',1),(18,'2019_05_23_181316_create_user_has_branches_table',1),(19,'2019_07_11_101454_create_payment_types_table',1),(20,'2019_07_11_144103_create_customer_types_table',1),(21,'2019_07_11_144204_create_customers_table',1),(22,'2019_07_11_181522_create_customer_has_branches_table',1),(23,'2019_07_11_183418_create_order_statuses_table',1),(24,'2019_07_12_183706_create_devices_table',1),(25,'2019_07_12_183722_create_repair_order_has_services_table',1),(26,'2019_07_12_183740_create_repair_order_has_goods_table',1),(27,'2019_07_12_183755_create_repair_order_has_warranties_table',1),(28,'2019_07_12_183815_create_warranties_table',1),(29,'2019_07_12_183834_create_sell_order_has_goods_table',1),(30,'2019_07_12_183841_create_sell_order_has_services_table',1),(31,'2019_07_12_183918_create_discount_codes_table',1),(32,'2019_07_12_183945_create_orders_table',1),(33,'2019_07_12_183954_create_repair_orders_table',1),(34,'2019_07_12_184000_create_sales_orders_table',1),(35,'2019_07_12_192828_create_repair_order_types_table',1),(36,'2019_07_12_225105_create_goods_categories_table',1),(37,'2019_07_12_225133_create_services_categories_table',1),(38,'2019_07_12_225308_create_services_table',1),(39,'2019_07_12_225430_create_warehouses_table',1),(40,'2019_07_12_225445_create_locations_table',1),(41,'2019_07_12_225509_create_brands_table',1),(42,'2019_07_12_225528_create_models_table',1),(43,'2019_07_12_225611_create_cashboxes_table',1),(44,'2019_07_12_225633_create_expenditure_items_table',1),(45,'2019_07_12_225649_create_transactions_table',1),(46,'2019_07_12_225828_create_to_transactions_table',1),(47,'2019_07_12_225836_create_from_transactions_table',1),(48,'2019_07_12_225856_create_transaction_statuses_table',1),(49,'2019_07_12_225928_create_suppliers_table',1),(50,'2019_07_12_225939_create_supplier_orders_table',1),(51,'2019_07_12_232333_create_warehouse_items_table',1),(52,'2019_08_23_104634_create_roles_table',1),(53,'2019_08_23_105634_create_employees_table',1),(54,'2019_10_19_060827_create_submodels_table',1),(55,'2019_10_19_060836_create_parts_table',1),(56,'2019_10_19_061046_create_colors_table',1),(57,'2019_10_20_061047_create_goods_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `models`
--

DROP TABLE IF EXISTS `models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `models_brand_id_foreign` (`brand_id`),
  CONSTRAINT `models_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `models`
--

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;
INSERT INTO `models` VALUES (1,1,'iPhone','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,1,'iPad','https://image.flaticon.com/icons/svg/114/114703.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(3,1,'Apple Watch','https://image.flaticon.com/icons/svg/916/916337.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(4,1,'MacBook','https://image.flaticon.com/icons/svg/65/65732.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(5,2,'Smartphones','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(6,2,'Tablets','https://image.flaticon.com/icons/svg/114/114703.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(7,2,'Watches','https://image.flaticon.com/icons/svg/916/916337.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(8,2,'Laptops','https://image.flaticon.com/icons/svg/65/65732.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(9,3,'Smartphones','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(10,3,'Tablets','https://image.flaticon.com/icons/svg/114/114703.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(11,3,'Watches','https://image.flaticon.com/icons/svg/916/916337.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(12,3,'Laptops','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(13,4,'Smartphones','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(14,4,'Tablets','https://image.flaticon.com/icons/svg/114/114703.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(15,5,'Smartphones','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(16,6,'Smartphones','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(17,7,'Smartphones','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(18,8,'Smartphones','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(19,9,'Smartphones','https://image.flaticon.com/icons/svg/114/114702.svg','2019-10-29 10:57:49','2019-10-29 10:57:49'),(20,9,'Laptops','https://image.flaticon.com/icons/svg/65/65732.svg','2019-10-29 10:57:49','2019-10-29 10:57:49');
/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('387cf09224357c33b0c2b44c561bc1504a898bb1b67d48c42b73a4fd08a58d16a10d99d0f6a34209',1,1,'Personal Access Token','[]',0,'2019-10-29 11:00:14','2019-10-29 11:00:14','2019-10-29 21:00:14'),('81f3ced6a4fad9a788222ebafb0f50de45da81d84f24f2a82a3961c03523aa00d126602e22057a34',1,1,'Personal Access Token','[]',0,'2019-10-29 11:10:31','2019-10-29 11:10:31','2019-10-29 21:10:31'),('e3ed3ca0c72bfca9bfc8469e2e5cb5e49a3a40f3bb5eda9c140ad1964eb1190fd928471dd798d237',2,1,'Personal Access Token','[]',0,'2019-10-29 11:08:11','2019-10-29 11:08:11','2019-10-29 21:08:11'),('f8b1dcef6abdc72e79e946f150fdac9e036763a595223aa526fdfa1efd3a4e38290676d3f1da566c',1,1,'Personal Access Token','[]',0,'2019-10-29 11:01:02','2019-10-29 11:01:02','2019-10-29 21:01:02');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'Relist Personal Access Client','3jLMNDV7Iy3npLuuFPtbxTt1yNIfS2AEsYXC9zyg','http://localhost',1,0,0,'2019-10-29 10:58:00','2019-10-29 10:58:00'),(2,NULL,'Relist Password Grant Client','XI8HjI6KiNtYWWSDQkqRjfQpuVqrWJmxDttxfEYk','http://localhost',0,1,0,'2019-10-29 10:58:00','2019-10-29 10:58:00');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2019-10-29 10:58:00','2019-10-29 10:58:00');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_statuses`
--

LOCK TABLES `order_statuses` WRITE;
/*!40000 ALTER TABLE `order_statuses` DISABLE KEYS */;
INSERT INTO `order_statuses` VALUES (1,'Accepted for repair','2019-10-29 10:57:51','2019-10-29 10:57:51'),(2,'In progress','2019-10-29 10:57:51','2019-10-29 10:57:51'),(3,'Order parts','2019-10-29 10:57:51','2019-10-29 10:57:51'),(4,'Waiting for parts','2019-10-29 10:57:51','2019-10-29 10:57:51'),(5,'Repaired','2019-10-29 10:57:51','2019-10-29 10:57:51'),(6,'Not repairable','2019-10-29 10:57:51','2019-10-29 10:57:51'),(7,'Called to client','2019-10-29 10:57:51','2019-10-29 10:57:51'),(8,'Returned to client','2019-10-29 10:57:51','2019-10-29 10:57:51'),(9,'Warranty','2019-10-29 10:57:51','2019-10-29 10:57:51');
/*!40000 ALTER TABLE `order_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accept_date` date NOT NULL,
  `price` double NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_branch_id_foreign` (`branch_id`),
  KEY `orders_created_by_foreign` (`created_by`),
  CONSTRAINT `orders_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `logins` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts`
--

DROP TABLE IF EXISTS `parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts`
--

LOCK TABLES `parts` WRITE;
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` VALUES (1,'Display','2019-10-29 10:57:50','2019-10-29 10:57:50'),(2,'Battery','2019-10-29 10:57:50','2019-10-29 10:57:50'),(3,'Side Buttons','2019-10-29 10:57:50','2019-10-29 10:57:50'),(4,'Vibration motor','2019-10-29 10:57:50','2019-10-29 10:57:50'),(5,'Home-button','2019-10-29 10:57:50','2019-10-29 10:57:50'),(6,'Front-camera','2019-10-29 10:57:50','2019-10-29 10:57:50'),(7,'Main-camera','2019-10-29 10:57:50','2019-10-29 10:57:50');
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
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
-- Table structure for table `payment_types`
--

DROP TABLE IF EXISTS `payment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_types`
--

LOCK TABLES `payment_types` WRITE;
/*!40000 ALTER TABLE `payment_types` DISABLE KEYS */;
INSERT INTO `payment_types` VALUES (1,'Cash','2019-10-29 10:57:51','2019-10-29 10:57:51'),(2,'Card','2019-10-29 10:57:51','2019-10-29 10:57:51');
/*!40000 ALTER TABLE `payment_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,'Mustafa','+43 1 3694001','Wagramerstraße 94','2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,'Support Relist','067762337470',NULL,'2019-10-29 11:03:40','2019-10-29 11:03:40');
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rechnung_hand_difs`
--

DROP TABLE IF EXISTS `rechnung_hand_difs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rechnung_hand_difs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kundenbetreuer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zahlungsmodalitat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunde` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunde_tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kunde_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_head` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_body` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rechnung_hand_difs`
--

LOCK TABLES `rechnung_hand_difs` WRITE;
/*!40000 ALTER TABLE `rechnung_hand_difs` DISABLE KEYS */;
/*!40000 ALTER TABLE `rechnung_hand_difs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rechnung_items`
--

DROP TABLE IF EXISTS `rechnung_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rechnung_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `artikelbeschreibung` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menge` int(11) NOT NULL,
  `preis` double NOT NULL,
  `rechnung_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rechnung_items_rechnung_id_foreign` (`rechnung_id`),
  CONSTRAINT `rechnung_items_rechnung_id_foreign` FOREIGN KEY (`rechnung_id`) REFERENCES `rechnung_hand_difs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rechnung_items`
--

LOCK TABLES `rechnung_items` WRITE;
/*!40000 ALTER TABLE `rechnung_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `rechnung_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_order_has_goods`
--

DROP TABLE IF EXISTS `repair_order_has_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair_order_has_goods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `good_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_order_has_goods`
--

LOCK TABLES `repair_order_has_goods` WRITE;
/*!40000 ALTER TABLE `repair_order_has_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair_order_has_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_order_has_services`
--

DROP TABLE IF EXISTS `repair_order_has_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair_order_has_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_order_has_services`
--

LOCK TABLES `repair_order_has_services` WRITE;
/*!40000 ALTER TABLE `repair_order_has_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair_order_has_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_order_has_warranties`
--

DROP TABLE IF EXISTS `repair_order_has_warranties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair_order_has_warranties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `warranty_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_order_has_warranties`
--

LOCK TABLES `repair_order_has_warranties` WRITE;
/*!40000 ALTER TABLE `repair_order_has_warranties` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair_order_has_warranties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_order_types`
--

DROP TABLE IF EXISTS `repair_order_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair_order_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_order_types`
--

LOCK TABLES `repair_order_types` WRITE;
/*!40000 ALTER TABLE `repair_order_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair_order_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_orders`
--

DROP TABLE IF EXISTS `repair_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `order_nr` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `defect_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `prepay_sum` double DEFAULT NULL,
  `located_in` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `repair_orders_order_id_foreign` (`order_id`),
  KEY `repair_orders_customer_id_foreign` (`customer_id`),
  KEY `repair_orders_status_id_foreign` (`status_id`),
  KEY `repair_orders_located_in_foreign` (`located_in`),
  CONSTRAINT `repair_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `repair_orders_located_in_foreign` FOREIGN KEY (`located_in`) REFERENCES `branches` (`id`),
  CONSTRAINT `repair_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `repair_orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_orders`
--

LOCK TABLES `repair_orders` WRITE;
/*!40000 ALTER TABLE `repair_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Head',NULL,NULL),(2,'Top Manager',NULL,NULL),(3,'Tech',NULL,NULL),(4,'Sales Manager',NULL,NULL),(5,'Courier',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_orders`
--

DROP TABLE IF EXISTS `sales_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `article_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_orders_order_id_foreign` (`order_id`),
  KEY `sales_orders_payment_type_id_foreign` (`payment_type_id`),
  CONSTRAINT `sales_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `sales_orders_payment_type_id_foreign` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_orders`
--

LOCK TABLES `sales_orders` WRITE;
/*!40000 ALTER TABLE `sales_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sell_order_has_goods`
--

DROP TABLE IF EXISTS `sell_order_has_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sell_order_has_goods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `good_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sell_order_has_goods`
--

LOCK TABLES `sell_order_has_goods` WRITE;
/*!40000 ALTER TABLE `sell_order_has_goods` DISABLE KEYS */;
/*!40000 ALTER TABLE `sell_order_has_goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sell_order_has_services`
--

DROP TABLE IF EXISTS `sell_order_has_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sell_order_has_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sell_order_has_services`
--

LOCK TABLES `sell_order_has_services` WRITE;
/*!40000 ALTER TABLE `sell_order_has_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `sell_order_has_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services_categories`
--

DROP TABLE IF EXISTS `services_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services_categories`
--

LOCK TABLES `services_categories` WRITE;
/*!40000 ALTER TABLE `services_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `services_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `submodels`
--

DROP TABLE IF EXISTS `submodels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submodels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submodels_model_id_foreign` (`model_id`),
  CONSTRAINT `submodels_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submodels`
--

LOCK TABLES `submodels` WRITE;
/*!40000 ALTER TABLE `submodels` DISABLE KEYS */;
INSERT INTO `submodels` VALUES (1,1,'5','2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,1,'5s','2019-10-29 10:57:49','2019-10-29 10:57:49'),(3,1,'6','2019-10-29 10:57:49','2019-10-29 10:57:49'),(4,1,'6 Plus','2019-10-29 10:57:49','2019-10-29 10:57:49'),(5,1,'6s','2019-10-29 10:57:49','2019-10-29 10:57:49'),(6,1,'6s Plus','2019-10-29 10:57:49','2019-10-29 10:57:49'),(7,1,'7','2019-10-29 10:57:49','2019-10-29 10:57:49'),(8,1,'7 Plus','2019-10-29 10:57:49','2019-10-29 10:57:49'),(9,1,'8','2019-10-29 10:57:49','2019-10-29 10:57:49'),(10,1,'8 Plus','2019-10-29 10:57:49','2019-10-29 10:57:49'),(11,1,'X','2019-10-29 10:57:49','2019-10-29 10:57:49'),(12,1,'Xr','2019-10-29 10:57:49','2019-10-29 10:57:49'),(13,1,'Xs','2019-10-29 10:57:49','2019-10-29 10:57:49'),(14,1,'Xs Max','2019-10-29 10:57:49','2019-10-29 10:57:49'),(15,1,'11','2019-10-29 10:57:49','2019-10-29 10:57:49'),(16,1,'11 Pro','2019-10-29 10:57:49','2019-10-29 10:57:49'),(17,2,'iPad','2019-10-29 10:57:49','2019-10-29 10:57:49'),(18,2,'iPad 2','2019-10-29 10:57:49','2019-10-29 10:57:49'),(19,2,'iPad 3rd Generation','2019-10-29 10:57:49','2019-10-29 10:57:49'),(20,2,'iPad 4rd Generation','2019-10-29 10:57:49','2019-10-29 10:57:49'),(21,2,'iPad 5rd Generation','2019-10-29 10:57:49','2019-10-29 10:57:49'),(22,2,'iPad 6rd Generation','2019-10-29 10:57:49','2019-10-29 10:57:49'),(23,2,'iPad 7rd Generation','2019-10-29 10:57:49','2019-10-29 10:57:49'),(24,2,'iPad mini','2019-10-29 10:57:49','2019-10-29 10:57:49'),(25,2,'iPad mini 2','2019-10-29 10:57:49','2019-10-29 10:57:49'),(26,2,'iPad mini 3','2019-10-29 10:57:49','2019-10-29 10:57:49'),(27,2,'iPad mini 4','2019-10-29 10:57:49','2019-10-29 10:57:49'),(28,2,'iPad mini 5','2019-10-29 10:57:49','2019-10-29 10:57:49'),(29,2,'iPad Air','2019-10-29 10:57:49','2019-10-29 10:57:49'),(30,2,'iPad Air 2','2019-10-29 10:57:49','2019-10-29 10:57:49'),(31,2,'iPad Air 3','2019-10-29 10:57:49','2019-10-29 10:57:49'),(32,2,'iPad Pro 12.9 inch','2019-10-29 10:57:49','2019-10-29 10:57:49'),(33,2,'iPad Pro 12.9 inch 2nd Generation','2019-10-29 10:57:49','2019-10-29 10:57:49'),(34,2,'iPad Pro 12.9 inch 3rd Generation','2019-10-29 10:57:49','2019-10-29 10:57:49'),(35,3,'Apple Watch Series 1','2019-10-29 10:57:49','2019-10-29 10:57:49'),(36,3,'Apple Watch Series 2','2019-10-29 10:57:49','2019-10-29 10:57:49'),(37,3,'Apple Watch Series 3','2019-10-29 10:57:49','2019-10-29 10:57:49'),(38,3,'Apple Watch Series 4','2019-10-29 10:57:49','2019-10-29 10:57:49'),(39,3,'Apple Watch Series 5','2019-10-29 10:57:49','2019-10-29 10:57:49'),(40,4,'A1181','2019-10-29 10:57:49','2019-10-29 10:57:49'),(41,4,'A1278','2019-10-29 10:57:49','2019-10-29 10:57:49'),(42,4,'A1342','2019-10-29 10:57:49','2019-10-29 10:57:49'),(43,4,'A1534','2019-10-29 10:57:49','2019-10-29 10:57:49'),(44,4,'A1237','2019-10-29 10:57:49','2019-10-29 10:57:49'),(45,4,'A1304','2019-10-29 10:57:49','2019-10-29 10:57:49'),(46,4,'A1370','2019-10-29 10:57:49','2019-10-29 10:57:49'),(47,4,'A1369','2019-10-29 10:57:49','2019-10-29 10:57:49'),(48,4,'A1465','2019-10-29 10:57:49','2019-10-29 10:57:49'),(49,4,'A1466','2019-10-29 10:57:49','2019-10-29 10:57:49'),(50,4,'A1932','2019-10-29 10:57:49','2019-10-29 10:57:49'),(51,4,'A1150','2019-10-29 10:57:49','2019-10-29 10:57:49'),(52,4,'A1151','2019-10-29 10:57:49','2019-10-29 10:57:49'),(53,4,'A1211','2019-10-29 10:57:49','2019-10-29 10:57:49'),(54,4,'A1212','2019-10-29 10:57:49','2019-10-29 10:57:49'),(55,4,'A1226','2019-10-29 10:57:49','2019-10-29 10:57:49'),(56,4,'A1229','2019-10-29 10:57:49','2019-10-29 10:57:49'),(57,4,'A1260','2019-10-29 10:57:49','2019-10-29 10:57:49'),(58,4,'A1261','2019-10-29 10:57:49','2019-10-29 10:57:49'),(59,4,'A1286','2019-10-29 10:57:49','2019-10-29 10:57:49'),(60,4,'A1297','2019-10-29 10:57:49','2019-10-29 10:57:49'),(61,4,'A1398','2019-10-29 10:57:49','2019-10-29 10:57:49'),(62,4,'A1425','2019-10-29 10:57:49','2019-10-29 10:57:49'),(63,4,'A1502','2019-10-29 10:57:49','2019-10-29 10:57:49'),(64,4,'A1708','2019-10-29 10:57:49','2019-10-29 10:57:49'),(65,4,'A1706','2019-10-29 10:57:49','2019-10-29 10:57:49'),(66,4,'A1707','2019-10-29 10:57:49','2019-10-29 10:57:49'),(67,4,'A1989','2019-10-29 10:57:49','2019-10-29 10:57:49'),(68,4,'A1990','2019-10-29 10:57:49','2019-10-29 10:57:49'),(69,4,'A1212','2019-10-29 10:57:49','2019-10-29 10:57:49'),(70,5,'Galaxy S5','2019-10-29 10:57:49','2019-10-29 10:57:49'),(71,5,'Galaxy S5 Plus','2019-10-29 10:57:49','2019-10-29 10:57:49'),(72,5,'Galaxy S6','2019-10-29 10:57:49','2019-10-29 10:57:49'),(73,5,'Galaxy S6 Edge','2019-10-29 10:57:49','2019-10-29 10:57:49'),(74,5,'Galaxy S6 Edge+','2019-10-29 10:57:49','2019-10-29 10:57:49'),(75,5,'Galaxy S7','2019-10-29 10:57:49','2019-10-29 10:57:49'),(76,5,'Galaxy S7 Edge','2019-10-29 10:57:49','2019-10-29 10:57:49'),(77,5,'Galaxy S7 Edge+','2019-10-29 10:57:49','2019-10-29 10:57:49'),(78,5,'Galaxy S8','2019-10-29 10:57:49','2019-10-29 10:57:49'),(79,5,'Galaxy S8+','2019-10-29 10:57:49','2019-10-29 10:57:49'),(80,5,'Galaxy S9','2019-10-29 10:57:49','2019-10-29 10:57:49'),(81,5,'Galaxy S9+','2019-10-29 10:57:49','2019-10-29 10:57:49'),(82,5,'Galaxy S10','2019-10-29 10:57:49','2019-10-29 10:57:49'),(83,5,'Galaxy S10+','2019-10-29 10:57:49','2019-10-29 10:57:49'),(84,5,'Galaxy S10e','2019-10-29 10:57:49','2019-10-29 10:57:49'),(85,5,'Galaxy S10+','2019-10-29 10:57:49','2019-10-29 10:57:49'),(86,5,'Galaxy Note 4','2019-10-29 10:57:49','2019-10-29 10:57:49'),(87,5,'Galaxy Note 5','2019-10-29 10:57:49','2019-10-29 10:57:49'),(88,5,'Galaxy Note 6','2019-10-29 10:57:49','2019-10-29 10:57:49'),(89,5,'Galaxy Note 7','2019-10-29 10:57:49','2019-10-29 10:57:49'),(90,5,'Galaxy Note 8','2019-10-29 10:57:49','2019-10-29 10:57:49'),(91,5,'Galaxy Note 9','2019-10-29 10:57:49','2019-10-29 10:57:49'),(92,5,'Galaxy Note 10','2019-10-29 10:57:49','2019-10-29 10:57:49'),(93,5,'Galaxy Note 10+','2019-10-29 10:57:49','2019-10-29 10:57:49'),(94,5,'Galaxy A3','2019-10-29 10:57:49','2019-10-29 10:57:49'),(95,5,'Galaxy  A3 (2018)','2019-10-29 10:57:49','2019-10-29 10:57:49'),(96,5,'Galaxy A5','2019-10-29 10:57:49','2019-10-29 10:57:49'),(97,5,'Galaxy  A5 (2016)','2019-10-29 10:57:49','2019-10-29 10:57:49'),(98,5,'Galaxy  A5 (2017)','2019-10-29 10:57:49','2019-10-29 10:57:49'),(99,5,'Galaxy  A5 (2018)','2019-10-29 10:57:49','2019-10-29 10:57:49'),(100,5,'Galaxy A6','2019-10-29 10:57:49','2019-10-29 10:57:49'),(101,5,'Galaxy  A6 (2016)','2019-10-29 10:57:49','2019-10-29 10:57:49'),(102,5,'Galaxy  A6 (2017)','2019-10-29 10:57:49','2019-10-29 10:57:49'),(103,5,'Galaxy  A6 (2018)','2019-10-29 10:57:49','2019-10-29 10:57:49'),(104,5,'Galaxy A7','2019-10-29 10:57:49','2019-10-29 10:57:49'),(105,5,'Galaxy  A7 (2016)','2019-10-29 10:57:49','2019-10-29 10:57:49'),(106,5,'Galaxy  A7 (2017)','2019-10-29 10:57:50','2019-10-29 10:57:50'),(107,5,'Galaxy  A7 (2018)','2019-10-29 10:57:50','2019-10-29 10:57:50'),(108,5,'Galaxy A8','2019-10-29 10:57:50','2019-10-29 10:57:50'),(109,5,'Galaxy  A8 (2016)','2019-10-29 10:57:50','2019-10-29 10:57:50'),(110,5,'Galaxy  A8 (2017)','2019-10-29 10:57:50','2019-10-29 10:57:50'),(111,5,'Galaxy A9','2019-10-29 10:57:50','2019-10-29 10:57:50'),(112,5,'Galaxy  A9 (2016)','2019-10-29 10:57:50','2019-10-29 10:57:50'),(113,5,'Galaxy  A9 (2017)','2019-10-29 10:57:50','2019-10-29 10:57:50'),(114,5,'Galaxy  A10','2019-10-29 10:57:50','2019-10-29 10:57:50'),(115,5,'Galaxy  A10e','2019-10-29 10:57:50','2019-10-29 10:57:50'),(116,5,'Galaxy  A10s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(117,5,'Galaxy  A20','2019-10-29 10:57:50','2019-10-29 10:57:50'),(118,5,'Galaxy  A20e','2019-10-29 10:57:50','2019-10-29 10:57:50'),(119,5,'Galaxy  A20s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(120,5,'Galaxy  A30','2019-10-29 10:57:50','2019-10-29 10:57:50'),(121,5,'Galaxy  A30s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(122,5,'Galaxy  A40','2019-10-29 10:57:50','2019-10-29 10:57:50'),(123,5,'Galaxy  A40s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(124,5,'Galaxy  A50','2019-10-29 10:57:50','2019-10-29 10:57:50'),(125,5,'Galaxy  A50s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(126,5,'Galaxy  A60','2019-10-29 10:57:50','2019-10-29 10:57:50'),(127,5,'Galaxy  A60s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(128,5,'Galaxy  A70','2019-10-29 10:57:50','2019-10-29 10:57:50'),(129,5,'Galaxy  A70s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(130,5,'Galaxy  A80','2019-10-29 10:57:50','2019-10-29 10:57:50'),(131,5,'Galaxy J 330','2019-10-29 10:57:50','2019-10-29 10:57:50'),(132,5,'Galaxy J 530','2019-10-29 10:57:50','2019-10-29 10:57:50'),(133,5,'Galaxy M10','2019-10-29 10:57:50','2019-10-29 10:57:50'),(134,5,'Galaxy M10s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(135,5,'Galaxy M20','2019-10-29 10:57:50','2019-10-29 10:57:50'),(136,5,'Galaxy M30','2019-10-29 10:57:50','2019-10-29 10:57:50'),(137,5,'Galaxy M30s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(138,5,'Galaxy M40','2019-10-29 10:57:50','2019-10-29 10:57:50'),(139,9,'Mate 8','2019-10-29 10:57:50','2019-10-29 10:57:50'),(140,9,'Mate 9','2019-10-29 10:57:50','2019-10-29 10:57:50'),(141,9,'Mate 9 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50'),(142,9,'Mate 9 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(143,9,'Mate 9 Porsche','2019-10-29 10:57:50','2019-10-29 10:57:50'),(144,9,'Mate 10','2019-10-29 10:57:50','2019-10-29 10:57:50'),(145,9,'Mate 10 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(146,9,'Mate 10 Porsche','2019-10-29 10:57:50','2019-10-29 10:57:50'),(147,9,'Mate 20','2019-10-29 10:57:50','2019-10-29 10:57:50'),(148,9,'Mate 20 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(149,9,'Mate 20 Porsche','2019-10-29 10:57:50','2019-10-29 10:57:50'),(150,9,'Mate 30','2019-10-29 10:57:50','2019-10-29 10:57:50'),(151,9,'Mate 30 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(152,9,'Mate 30 Porsche','2019-10-29 10:57:50','2019-10-29 10:57:50'),(153,9,'P Smart','2019-10-29 10:57:50','2019-10-29 10:57:50'),(154,9,'P Smart +','2019-10-29 10:57:50','2019-10-29 10:57:50'),(155,9,'P Smart Z','2019-10-29 10:57:50','2019-10-29 10:57:50'),(156,9,'P8','2019-10-29 10:57:50','2019-10-29 10:57:50'),(157,9,'P8 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50'),(158,9,'P8 Max','2019-10-29 10:57:50','2019-10-29 10:57:50'),(159,9,'P9','2019-10-29 10:57:50','2019-10-29 10:57:50'),(160,9,'P9 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50'),(161,9,'P9 Max','2019-10-29 10:57:50','2019-10-29 10:57:50'),(162,9,'P9 Plus','2019-10-29 10:57:50','2019-10-29 10:57:50'),(163,9,'P9 Lite Mini','2019-10-29 10:57:50','2019-10-29 10:57:50'),(164,9,'P10','2019-10-29 10:57:50','2019-10-29 10:57:50'),(165,9,'P10 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50'),(166,9,'P10 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(167,9,'P20','2019-10-29 10:57:50','2019-10-29 10:57:50'),(168,9,'P20 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50'),(169,9,'P20 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(170,9,'P30','2019-10-29 10:57:50','2019-10-29 10:57:50'),(171,9,'P30 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50'),(172,9,'P30 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(173,9,'Nova 2','2019-10-29 10:57:50','2019-10-29 10:57:50'),(174,9,'Nova 2 Plus','2019-10-29 10:57:50','2019-10-29 10:57:50'),(175,9,'Nova 2s','2019-10-29 10:57:50','2019-10-29 10:57:50'),(176,9,'Nova 3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(177,9,'Nova 4','2019-10-29 10:57:50','2019-10-29 10:57:50'),(178,9,'Nova 5','2019-10-29 10:57:50','2019-10-29 10:57:50'),(179,15,'Xperia 5','2019-10-29 10:57:50','2019-10-29 10:57:50'),(180,15,'Xperia 1','2019-10-29 10:57:50','2019-10-29 10:57:50'),(181,15,'Xperia 10','2019-10-29 10:57:50','2019-10-29 10:57:50'),(182,15,'Xperia 10 Plus','2019-10-29 10:57:50','2019-10-29 10:57:50'),(183,15,'Xperia L3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(184,15,'Xperia XZ3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(185,15,'Xperia XZ2','2019-10-29 10:57:50','2019-10-29 10:57:50'),(186,15,'Xperia XZ2 Compact','2019-10-29 10:57:50','2019-10-29 10:57:50'),(187,15,'Xperia XZ1','2019-10-29 10:57:50','2019-10-29 10:57:50'),(188,15,'Xperia XZ1 Compact','2019-10-29 10:57:50','2019-10-29 10:57:50'),(189,15,'Xperia XZ Premium','2019-10-29 10:57:50','2019-10-29 10:57:50'),(190,15,'Xperia Z1','2019-10-29 10:57:50','2019-10-29 10:57:50'),(191,15,'Xperia Z1 Compact','2019-10-29 10:57:50','2019-10-29 10:57:50'),(192,15,'Xperia Z Ultra','2019-10-29 10:57:50','2019-10-29 10:57:50'),(193,15,'Xperia Z2','2019-10-29 10:57:50','2019-10-29 10:57:50'),(194,15,'Xperia Z3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(195,15,'Xperia Z5','2019-10-29 10:57:50','2019-10-29 10:57:50'),(196,15,'Xperia Z5 Compact','2019-10-29 10:57:50','2019-10-29 10:57:50'),(197,15,'Xperia Z5 Premium','2019-10-29 10:57:50','2019-10-29 10:57:50'),(198,15,'Xperia M4 Aqua','2019-10-29 10:57:50','2019-10-29 10:57:50'),(199,15,'Xperia M5 Aqua','2019-10-29 10:57:50','2019-10-29 10:57:50'),(200,15,'Xperia L1','2019-10-29 10:57:50','2019-10-29 10:57:50'),(201,16,'3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(202,16,'5','2019-10-29 10:57:50','2019-10-29 10:57:50'),(203,16,'6','2019-10-29 10:57:50','2019-10-29 10:57:50'),(204,16,'7','2019-10-29 10:57:50','2019-10-29 10:57:50'),(205,16,'7 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(206,16,'3T','2019-10-29 10:57:50','2019-10-29 10:57:50'),(207,16,'5T','2019-10-29 10:57:50','2019-10-29 10:57:50'),(208,16,'6T','2019-10-29 10:57:50','2019-10-29 10:57:50'),(209,16,'6T McLaren','2019-10-29 10:57:50','2019-10-29 10:57:50'),(210,16,'7T','2019-10-29 10:57:50','2019-10-29 10:57:50'),(211,16,'7T Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(212,16,'7T McLaren','2019-10-29 10:57:50','2019-10-29 10:57:50'),(213,17,'A9','2019-10-29 10:57:50','2019-10-29 10:57:50'),(214,17,'A9 2020','2019-10-29 10:57:50','2019-10-29 10:57:50'),(215,17,'A5 2020','2019-10-29 10:57:50','2019-10-29 10:57:50'),(216,17,'K3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(217,17,'Reno2','2019-10-29 10:57:50','2019-10-29 10:57:50'),(218,17,'Reno2 F','2019-10-29 10:57:50','2019-10-29 10:57:50'),(219,17,'Reno2 Z','2019-10-29 10:57:50','2019-10-29 10:57:50'),(220,17,'Reno Z','2019-10-29 10:57:50','2019-10-29 10:57:50'),(221,17,'Reno 10x Zoom','2019-10-29 10:57:50','2019-10-29 10:57:50'),(222,17,'F11','2019-10-29 10:57:50','2019-10-29 10:57:50'),(223,17,'F11 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(224,18,'V17 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(225,18,'V15 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(226,18,'V15','2019-10-29 10:57:50','2019-10-29 10:57:50'),(227,18,'V11','2019-10-29 10:57:50','2019-10-29 10:57:50'),(228,18,'V11i','2019-10-29 10:57:50','2019-10-29 10:57:50'),(229,18,'V9 Youth','2019-10-29 10:57:50','2019-10-29 10:57:50'),(230,18,'V9','2019-10-29 10:57:50','2019-10-29 10:57:50'),(231,18,'V7','2019-10-29 10:57:50','2019-10-29 10:57:50'),(232,18,'V7+','2019-10-29 10:57:50','2019-10-29 10:57:50'),(233,18,'Y95','2019-10-29 10:57:50','2019-10-29 10:57:50'),(234,18,'Y91C','2019-10-29 10:57:50','2019-10-29 10:57:50'),(235,18,'Y93','2019-10-29 10:57:50','2019-10-29 10:57:50'),(236,18,'Y17','2019-10-29 10:57:50','2019-10-29 10:57:50'),(237,18,'Y85','2019-10-29 10:57:50','2019-10-29 10:57:50'),(238,18,'Y81i','2019-10-29 10:57:50','2019-10-29 10:57:50'),(239,18,'Y83','2019-10-29 10:57:50','2019-10-29 10:57:50'),(240,18,'Y71','2019-10-29 10:57:50','2019-10-29 10:57:50'),(241,18,'X21','2019-10-29 10:57:50','2019-10-29 10:57:50'),(242,18,'NEX','2019-10-29 10:57:50','2019-10-29 10:57:50'),(243,18,'NEX Dual Display','2019-10-29 10:57:50','2019-10-29 10:57:50'),(244,18,'S1','2019-10-29 10:57:50','2019-10-29 10:57:50'),(245,19,'Redmi 8','2019-10-29 10:57:50','2019-10-29 10:57:50'),(246,19,'Redmi 8A','2019-10-29 10:57:50','2019-10-29 10:57:50'),(247,19,'Redmi Note 8','2019-10-29 10:57:50','2019-10-29 10:57:50'),(248,19,'Redmi Note 8 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(249,19,'Redmi 7A','2019-10-29 10:57:50','2019-10-29 10:57:50'),(250,19,'Redmi 7','2019-10-29 10:57:50','2019-10-29 10:57:50'),(251,19,'Redmi Note 7','2019-10-29 10:57:50','2019-10-29 10:57:50'),(252,19,'Redmi 6','2019-10-29 10:57:50','2019-10-29 10:57:50'),(253,19,'Redmi 6A','2019-10-29 10:57:50','2019-10-29 10:57:50'),(254,19,'Redmi Note 6 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(255,19,'Redmi S2','2019-10-29 10:57:50','2019-10-29 10:57:50'),(256,19,'POCOPHONE F1','2019-10-29 10:57:50','2019-10-29 10:57:50'),(257,19,'Mi Mix Alpha','2019-10-29 10:57:50','2019-10-29 10:57:50'),(258,19,'Mi Mix 3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(259,19,'Mi Mix 2S','2019-10-29 10:57:50','2019-10-29 10:57:50'),(260,19,'Mi 9 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50'),(261,19,'Mi 9T','2019-10-29 10:57:50','2019-10-29 10:57:50'),(262,19,'Mi 9T Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(263,19,'Mi 9 SE','2019-10-29 10:57:50','2019-10-29 10:57:50'),(264,19,'Mi 9','2019-10-29 10:57:50','2019-10-29 10:57:50'),(265,19,'Mi 8','2019-10-29 10:57:50','2019-10-29 10:57:50'),(266,19,'Mi 8 Pro','2019-10-29 10:57:50','2019-10-29 10:57:50'),(267,19,'Mi 8 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50'),(268,19,'Mi Max 3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(269,19,'Mi A3','2019-10-29 10:57:50','2019-10-29 10:57:50'),(270,19,'Mi A2','2019-10-29 10:57:50','2019-10-29 10:57:50'),(271,19,'Mi A2 Lite','2019-10-29 10:57:50','2019-10-29 10:57:50');
/*!40000 ALTER TABLE `submodels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier_orders`
--

DROP TABLE IF EXISTS `supplier_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `supplier_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier_orders`
--

LOCK TABLES `supplier_orders` WRITE;
/*!40000 ALTER TABLE `supplier_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `person_id` bigint(20) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `to_transactions`
--

DROP TABLE IF EXISTS `to_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `to_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `to_transactions`
--

LOCK TABLES `to_transactions` WRITE;
/*!40000 ALTER TABLE `to_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `to_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_statuses`
--

DROP TABLE IF EXISTS `transaction_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_statuses`
--

LOCK TABLES `transaction_statuses` WRITE;
/*!40000 ALTER TABLE `transaction_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `cashbox_id` bigint(20) NOT NULL,
  `expenditure_item_id` bigint(20) NOT NULL,
  `contractor_id` bigint(20) NOT NULL,
  `responsible_id` bigint(20) NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `transaction_date` date NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_has_branches`
--

DROP TABLE IF EXISTS `user_has_branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_has_branches` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_has_branches_user_id_foreign` (`user_id`),
  KEY `user_has_branches_branch_id_foreign` (`branch_id`),
  CONSTRAINT `user_has_branches_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_has_branches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_has_branches`
--

LOCK TABLES `user_has_branches` WRITE;
/*!40000 ALTER TABLE `user_has_branches` DISABLE KEYS */;
INSERT INTO `user_has_branches` VALUES (1,1,1,'2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,1,2,'2019-10-29 10:57:49','2019-10-29 10:57:49'),(3,1,3,'2019-10-29 10:57:49','2019-10-29 10:57:49'),(4,1,4,'2019-10-29 10:57:49','2019-10-29 10:57:49'),(9,2,1,'2019-10-29 11:07:54','2019-10-29 11:07:54'),(10,2,2,'2019-10-29 11:07:54','2019-10-29 11:07:54'),(11,2,3,'2019-10-29 11:07:54','2019-10-29 11:07:54'),(12,2,4,'2019-10-29 11:07:54','2019-10-29 11:07:54');
/*!40000 ALTER TABLE `user_has_branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_id` int(10) unsigned NOT NULL,
  `person_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_id_unique` (`login_id`),
  KEY `users_person_id_foreign` (`person_id`),
  KEY `users_company_id_foreign` (`company_id`),
  CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_login_id_foreign` FOREIGN KEY (`login_id`) REFERENCES `logins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,1,1,'2019-10-29 10:57:49','2019-10-29 10:57:49'),(2,2,2,1,'2019-10-29 11:03:40','2019-10-29 11:03:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouse_items`
--

DROP TABLE IF EXISTS `warehouse_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouse_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `good_id` bigint(20) NOT NULL,
  `location_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouse_items`
--

LOCK TABLES `warehouse_items` WRITE;
/*!40000 ALTER TABLE `warehouse_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `warehouse_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warehouses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warehouses`
--

LOCK TABLES `warehouses` WRITE;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `warranties`
--

DROP TABLE IF EXISTS `warranties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `warranties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `warranties`
--

LOCK TABLES `warranties` WRITE;
/*!40000 ALTER TABLE `warranties` DISABLE KEYS */;
/*!40000 ALTER TABLE `warranties` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-29 11:21:18
