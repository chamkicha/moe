-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 41.59.227.219    Database: MOE_live
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address_name` varchar(200) DEFAULT NULL,
  `pobox` varchar(100) DEFAULT NULL,
  `office_id` int DEFAULT NULL,
  `office_type` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `administration_areas_view`
--

DROP TABLE IF EXISTS `administration_areas_view`;
/*!50001 DROP VIEW IF EXISTS `administration_areas_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `administration_areas_view` AS SELECT 
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ded_box`,
 1 AS `ngazi_ya_wilaya`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `zone_name`,
 1 AS `zone_box`,
 1 AS `region_box`,
 1 AS `has_zone_office`,
 1 AS `district_box`,
 1 AS `district_sqa_box`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `algorthm`
--

DROP TABLE IF EXISTS `algorthm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `algorthm` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_type` varchar(10) DEFAULT NULL,
  `last_number` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `application_categories`
--

DROP TABLE IF EXISTS `application_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `app_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `application_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `application_statuses`
--

DROP TABLE IF EXISTS `application_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foreign_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `registry_type_id` bigint unsigned DEFAULT NULL,
  `application_category_id` bigint unsigned NOT NULL,
  `is_approved` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `staff_id` int DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `approved_by` bigint DEFAULT NULL,
  `control_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `payment_status_id` bigint unsigned DEFAULT '2',
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `expire_date` timestamp NULL DEFAULT NULL,
  `kumb_na` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '1',
  `folio` int DEFAULT '1',
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `applications_user_id_index` (`user_id`),
  KEY `applications_registry_type_id_index` (`registry_type_id`),
  KEY `applications_payment_status_id_index` (`payment_status_id`),
  KEY `application_category_id_index` (`application_category_id`),
  KEY `idx_applications_is_complete` (`is_complete`),
  KEY `idx_applications_is_approved` (`is_approved`),
  KEY `idx_applications_tracking_number` (`tracking_number`),
  KEY `idx_applications_secure_token` (`secure_token`),
  KEY `idx_applications_foreign_token` (`foreign_token`),
  KEY `idx_applications_staff_id` (`staff_id`),
  KEY `idx_applications_status_id` (`status_id`),
  CONSTRAINT `applications_payment_status_id_foreign` FOREIGN KEY (`payment_status_id`) REFERENCES `payment_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attachment_types`
--

DROP TABLE IF EXISTS `attachment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachment_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `registry_type_id` bigint unsigned DEFAULT NULL,
  `attachment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `application_category_id` bigint unsigned DEFAULT NULL,
  `registration_structure_id` bigint DEFAULT '0',
  `file_size` double(4,2) DEFAULT NULL,
  `file_format` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `no_of_views` int DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `application_attachment_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_backend` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `attachment_types_registry_type_id_index` (`registry_type_id`),
  KEY `attachment_types_application_category_id_index` (`application_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uploader_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attachment_type_id` bigint unsigned DEFAULT NULL,
  `attachment_path` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `user_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `attachments_tracking_number_index` (`tracking_number`),
  KEY `attachments_attachment_type_id_index` (`attachment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2568 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_trail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `event_type` varchar(10) DEFAULT NULL,
  `old_body` json DEFAULT NULL,
  `new_body` json DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `ip_address` varchar(150) DEFAULT NULL,
  `api_router` varchar(50) DEFAULT NULL,
  `browser_used` text,
  `rollId` int DEFAULT NULL,
  `message` text,
  `tableName` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2087 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `building_structures`
--

DROP TABLE IF EXISTS `building_structures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `building_structures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `building` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `building_types`
--

DROP TABLE IF EXISTS `building_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `building_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `building_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `number` int NOT NULL,
  `sq_meter` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `bweni_change_view`
--

DROP TABLE IF EXISTS `bweni_change_view`;
/*!50001 DROP VIEW IF EXISTS `bweni_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `bweni_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `gender_type`,
 1 AS `number_of_students`,
 1 AS `category`,
 1 AS `subcategory`,
 1 AS `old_subcategory`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `certificate_types`
--

DROP TABLE IF EXISTS `certificate_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certificate_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `certificate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `school_category_id` bigint unsigned DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certificate_types_school_category_id_index` (`school_category_id`),
  CONSTRAINT `certificate_types_school_category_id_foreign` FOREIGN KEY (`school_category_id`) REFERENCES `school_categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `class_rooms`
--

DROP TABLE IF EXISTS `class_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class_rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `class_range` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `combination_subjects`
--

DROP TABLE IF EXISTS `combination_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `combination_subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `combination_id` bigint unsigned NOT NULL,
  `subject_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `combination_subjects_combination_id_index` (`combination_id`),
  KEY `combination_subjects_subject_id_index` (`subject_id`),
  CONSTRAINT `combination_subjects_combination_id_foreign` FOREIGN KEY (`combination_id`) REFERENCES `combinations` (`id`),
  CONSTRAINT `combination_subjects_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `combinations`
--

DROP TABLE IF EXISTS `combinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `combinations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_specialization_id` bigint unsigned DEFAULT NULL,
  `combination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `certificate_type_id` bigint unsigned DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `combinations_school_specialization_id_index` (`school_specialization_id`),
  KEY `combinations_certificate_type_id_index` (`certificate_type_id`),
  CONSTRAINT `combinations_certificate_type_id_foreign` FOREIGN KEY (`certificate_type_id`) REFERENCES `certificate_types` (`id`),
  CONSTRAINT `combinations_school_specialization_id_foreign` FOREIGN KEY (`school_specialization_id`) REFERENCES `school_specializations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `curricula`
--

DROP TABLE IF EXISTS `curricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curricula` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `curriculum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `dahalia_change_view`
--

DROP TABLE IF EXISTS `dahalia_change_view`;
/*!50001 DROP VIEW IF EXISTS `dahalia_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `dahalia_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `is_hostel`,
 1 AS `was_hostel`,
 1 AS `category`,
 1 AS `number_of_students`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `denominations`
--

DROP TABLE IF EXISTS `denominations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `denominations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ownership_sub_type_id` bigint unsigned NOT NULL,
  `denomination` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `denominations_ownership_sub_type_id_index` (`ownership_sub_type_id`),
  CONSTRAINT `denominations_ownership_sub_type_id_foreign` FOREIGN KEY (`ownership_sub_type_id`) REFERENCES `ownership_sub_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `deregistration_change_view`
--

DROP TABLE IF EXISTS `deregistration_change_view`;
/*!50001 DROP VIEW IF EXISTS `deregistration_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `deregistration_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`,
 1 AS `reg_status`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `districts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `RegionCode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `LgaCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `LgaName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ngazi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sqa_box` int DEFAULT NULL,
  `district_box` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_districts_RegionCode` (`RegionCode`),
  KEY `idx_districts_LgaCode` (`LgaCode`),
  KEY `idx_districts_id` (`id`),
  KEY `districts_ngazi_index` (`ngazi`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `established_schools_view`
--

DROP TABLE IF EXISTS `established_schools_view`;
/*!50001 DROP VIEW IF EXISTS `established_schools_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `established_schools_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `establishing_schools`
--

DROP TABLE IF EXISTS `establishing_schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `establishing_schools` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `school_category_id` bigint unsigned DEFAULT NULL,
  `school_sub_category_id` bigint unsigned DEFAULT NULL,
  `school_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_size` double(8,2) DEFAULT NULL,
  `area` double(8,2) DEFAULT NULL,
  `stream` int DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `language_id` bigint unsigned DEFAULT NULL,
  `building_structure_id` bigint unsigned DEFAULT NULL,
  `school_gender_type_id` bigint unsigned DEFAULT NULL,
  `school_specialization_id` bigint unsigned DEFAULT NULL,
  `ward_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `village_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `registration_structure_id` bigint unsigned DEFAULT NULL,
  `curriculum_id` bigint unsigned DEFAULT NULL,
  `certificate_type_id` bigint unsigned DEFAULT NULL,
  `sect_name_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `po_box` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `stage` int NOT NULL DEFAULT '0',
  `school_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `number_of_students` int DEFAULT NULL,
  `lessons_and_courses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `number_of_teachers` int DEFAULT NULL,
  `teacher_student_ratio_recommendation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `teacher_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `is_for_disabled` tinyint(1) NOT NULL DEFAULT '0',
  `control_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_hostel` tinyint(1) NOT NULL DEFAULT '0',
  `file_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_folio` int DEFAULT NULL,
  `max_folio` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `establishing_schools_school_category_id_index` (`school_category_id`),
  KEY `establishing_schools_school_sub_category_id_index` (`school_sub_category_id`),
  KEY `establishing_schools_language_id_index` (`language_id`),
  KEY `establishing_schools_building_structure_id_index` (`building_structure_id`),
  KEY `establishing_schools_school_gender_type_id_index` (`school_gender_type_id`),
  KEY `establishing_schools_school_specialization_id_index` (`school_specialization_id`),
  KEY `establishing_schools_ward_id_index` (`ward_id`),
  KEY `establishing_schools_registration_structure_id_index` (`registration_structure_id`),
  KEY `establishing_schools_curriculum_id_index` (`curriculum_id`),
  KEY `establishing_schools_certificate_type_id_index` (`certificate_type_id`),
  KEY `establishing_schools_sect_name_id_index` (`sect_name_id`),
  KEY `school_establishment_indexes` (`id`,`school_category_id`,`tracking_number`),
  KEY `idx_establishing_schools_school_category_id` (`school_category_id`),
  KEY `idx_establishing_schools_village_id` (`village_id`),
  KEY `establishing_school_secure_token_index` (`secure_token`)
) ENGINE=InnoDB AUTO_INCREMENT=26821 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fee_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `former_managers`
--

DROP TABLE IF EXISTS `former_managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `former_managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `establishing_school_id` bigint unsigned DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ward_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `house_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `education_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `expertise_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manager_cv` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `manager_certificate` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`),
  KEY `former_managers_establishing_school_id_index` (`establishing_school_id`),
  KEY `former_managers_ward_id_foreign` (`ward_id`),
  KEY `idx_former_managers_ward_id` (`ward_id`),
  KEY `idx_former_managers_tracking_number` (`tracking_number`),
  CONSTRAINT `former_managers_establishing_school_id_foreign` FOREIGN KEY (`establishing_school_id`) REFERENCES `establishing_schools` (`id`),
  CONSTRAINT `former_managers_ward_id_foreign` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`WardCode`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `former_owner_referees`
--

DROP TABLE IF EXISTS `former_owner_referees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `former_owner_referees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `former_owner_id` bigint unsigned DEFAULT NULL,
  `ward_id` bigint unsigned DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `former_owner_referees_former_owner_id_index` (`former_owner_id`),
  KEY `former_owner_referees_ward_id_index` (`ward_id`),
  KEY `idx_former_owner_referees_ward_id` (`ward_id`),
  CONSTRAINT `former_owner_referees_former_owner_id_foreign` FOREIGN KEY (`former_owner_id`) REFERENCES `former_owners` (`id`),
  CONSTRAINT `former_owner_referees_ward_id_foreign` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `former_owners`
--

DROP TABLE IF EXISTS `former_owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `former_owners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `establishing_school_id` bigint unsigned DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `owner_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `authorized_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `owner_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `former_owners_establishing_school_id_index` (`establishing_school_id`),
  KEY `idx_former_owners_tracking_number` (`tracking_number`),
  CONSTRAINT `former_owners_establishing_school_id_foreign` FOREIGN KEY (`establishing_school_id`) REFERENCES `establishing_schools` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `former_school_combination_view`
--

DROP TABLE IF EXISTS `former_school_combination_view`;
/*!50001 DROP VIEW IF EXISTS `former_school_combination_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `former_school_combination_view` AS SELECT 
 1 AS `establishing_school_id`,
 1 AS `combinations`,
 1 AS `tracking_number`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `former_school_combinations`
--

DROP TABLE IF EXISTS `former_school_combinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `former_school_combinations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `establishing_school_id` bigint unsigned DEFAULT NULL,
  `combination_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `former_school_combinations_establishing_school_id_index` (`establishing_school_id`),
  KEY `former_school_combinations_combination_id_index` (`combination_id`),
  KEY `idx_former_school_combinations_establishing_school_id` (`establishing_school_id`),
  KEY `idx_former_school_combinations_tracking_number` (`tracking_number`),
  CONSTRAINT `former_school_combinations_combination_id_foreign` FOREIGN KEY (`combination_id`) REFERENCES `combinations` (`id`),
  CONSTRAINT `former_school_combinations_establishing_school_id_foreign` FOREIGN KEY (`establishing_school_id`) REFERENCES `establishing_schools` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `former_school_infos`
--

DROP TABLE IF EXISTS `former_school_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `former_school_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `establishing_school_id` bigint unsigned DEFAULT NULL,
  `school_category_id` bigint unsigned DEFAULT NULL,
  `school_sub_category_id` bigint unsigned DEFAULT NULL,
  `school_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_size` double(8,2) DEFAULT NULL,
  `area` double(8,2) DEFAULT NULL,
  `stream` int DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `language_id` bigint unsigned DEFAULT NULL,
  `building_structure_id` bigint unsigned DEFAULT NULL,
  `school_gender_type_id` bigint unsigned DEFAULT NULL,
  `school_specialization_id` bigint unsigned DEFAULT NULL,
  `ward_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `village_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `registration_structure_id` bigint unsigned DEFAULT NULL,
  `curriculum_id` bigint unsigned DEFAULT NULL,
  `certificate_type_id` bigint unsigned DEFAULT NULL,
  `sect_name_id` bigint unsigned DEFAULT NULL,
  `is_for_disabled` tinyint(1) NOT NULL DEFAULT '0',
  `is_hostel` tinyint(1) NOT NULL DEFAULT '0',
  `number_of_students` int DEFAULT NULL,
  `school_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `lessons_and_courses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `number_of_teachers` int DEFAULT NULL,
  `teacher_student_ratio_recommendation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `teacher_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `former_school_infos_establishing_school_id_index` (`establishing_school_id`),
  KEY `former_school_infos_school_category_id_index` (`school_category_id`),
  KEY `former_school_infos_school_sub_category_id_index` (`school_sub_category_id`),
  KEY `former_school_infos_language_id_index` (`language_id`),
  KEY `former_school_infos_building_structure_id_index` (`building_structure_id`),
  KEY `former_school_infos_school_gender_type_id_index` (`school_gender_type_id`),
  KEY `former_school_infos_school_specialization_id_index` (`school_specialization_id`),
  KEY `former_school_infos_ward_id_index` (`ward_id`),
  KEY `former_school_infos_registration_structure_id_index` (`registration_structure_id`),
  KEY `former_school_infos_curriculum_id_index` (`curriculum_id`),
  KEY `former_school_infos_certificate_type_id_index` (`certificate_type_id`),
  KEY `former_school_infos_sect_name_id_index` (`sect_name_id`),
  KEY `idx_former_school_infos_tracking_number` (`tracking_number`),
  KEY `idx_former_school_infos_ward_id` (`ward_id`),
  CONSTRAINT `former_school_infos_building_structure_id_foreign` FOREIGN KEY (`building_structure_id`) REFERENCES `building_structures` (`id`),
  CONSTRAINT `former_school_infos_certificate_type_id_foreign` FOREIGN KEY (`certificate_type_id`) REFERENCES `certificate_types` (`id`),
  CONSTRAINT `former_school_infos_curriculum_id_foreign` FOREIGN KEY (`curriculum_id`) REFERENCES `curricula` (`id`),
  CONSTRAINT `former_school_infos_establishing_school_id_foreign` FOREIGN KEY (`establishing_school_id`) REFERENCES `establishing_schools` (`id`),
  CONSTRAINT `former_school_infos_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  CONSTRAINT `former_school_infos_registration_structure_id_foreign` FOREIGN KEY (`registration_structure_id`) REFERENCES `registration_structures` (`id`),
  CONSTRAINT `former_school_infos_school_category_id_foreign` FOREIGN KEY (`school_category_id`) REFERENCES `school_categories` (`id`),
  CONSTRAINT `former_school_infos_school_gender_type_id_foreign` FOREIGN KEY (`school_gender_type_id`) REFERENCES `school_gender_types` (`id`),
  CONSTRAINT `former_school_infos_school_specialization_id_foreign` FOREIGN KEY (`school_specialization_id`) REFERENCES `school_specializations` (`id`),
  CONSTRAINT `former_school_infos_school_sub_category_id_foreign` FOREIGN KEY (`school_sub_category_id`) REFERENCES `school_sub_categories` (`id`),
  CONSTRAINT `former_school_infos_sect_name_id_foreign` FOREIGN KEY (`sect_name_id`) REFERENCES `sect_names` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `handover`
--

DROP TABLE IF EXISTS `handover`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `handover` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint NOT NULL,
  `handover_by` bigint NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `identity_types`
--

DROP TABLE IF EXISTS `identity_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `identity_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `institute_attachments`
--

DROP TABLE IF EXISTS `institute_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `institute_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `institute_info_id` bigint unsigned DEFAULT NULL,
  `attachment_type_id` bigint unsigned DEFAULT NULL,
  `attachment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `institute_attachments_institute_info_id_index` (`institute_info_id`),
  KEY `institute_attachments_attachment_type_id_index` (`attachment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=567 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `institute_infos`
--

DROP TABLE IF EXISTS `institute_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `institute_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `registration_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `institute_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `institute_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `box` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ward_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `registration_certificate_copy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `organizational_constitution` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `agreement_document` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `institute_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`),
  KEY `institute_infos_ward_id_index` (`ward_id`),
  KEY `institute_info_secure_info_index` (`secure_token`),
  KEY `institute_info_village_id` (`street`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `login_activity`
--

DROP TABLE IF EXISTS `login_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_activity` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `staff_id` bigint unsigned NOT NULL,
  `browser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `login_activity_staff_id_foreign` (`staff_id`),
  CONSTRAINT `login_activity_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3444 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `managers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `establishing_school_id` bigint unsigned DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ward_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `house_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `street` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `manager_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `education_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `expertise_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manager_cv` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `manager_certificate` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`id`),
  KEY `managers_establishing_school_id_index` (`establishing_school_id`),
  KEY `managers_ward_id_index` (`ward_id`),
  CONSTRAINT `managers_establishing_school_id_foreign` FOREIGN KEY (`establishing_school_id`) REFERENCES `establishing_schools` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `managers_change_view`
--

DROP TABLE IF EXISTS `managers_change_view`;
/*!50001 DROP VIEW IF EXISTS `managers_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `managers_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `old_manager_name`,
 1 AS `manager_name`,
 1 AS `school_name`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `maoni`
--

DROP TABLE IF EXISTS `maoni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maoni` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trackingNo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_from` int DEFAULT NULL,
  `user_to` int DEFAULT NULL,
  `coments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_comment` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_maoni_trackingNo` (`trackingNo`),
  KEY `idx_maoni_user_from` (`user_from`),
  KEY `idx_maoni_user_to` (`user_to`)
) ENGINE=InnoDB AUTO_INCREMENT=6386 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `name_change_view`
--

DROP TABLE IF EXISTS `name_change_view`;
/*!50001 DROP VIEW IF EXISTS `name_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `name_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `old_school_name`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `owners`
--

DROP TABLE IF EXISTS `owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `owners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `establishing_school_id` bigint unsigned DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `owner_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `authorized_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `owner_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `purpose` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_manager` tinyint(1) NOT NULL DEFAULT '0',
  `ownership_sub_type_id` bigint unsigned DEFAULT NULL,
  `denomination_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owners_establishing_school_id_index` (`establishing_school_id`),
  KEY `owners_ownership_sub_type_id_index` (`ownership_sub_type_id`),
  KEY `owners_denomination_id_index` (`denomination_id`),
  KEY `idx_owners_establishing_school_id` (`establishing_school_id`),
  KEY `idx_owners_owner_email` (`owner_email`),
  KEY `idx_owners_tracking_number` (`tracking_number`),
  CONSTRAINT `owners_denomination_id_foreign` FOREIGN KEY (`denomination_id`) REFERENCES `denominations` (`id`),
  CONSTRAINT `owners_establishing_school_id_foreign` FOREIGN KEY (`establishing_school_id`) REFERENCES `establishing_schools` (`id`),
  CONSTRAINT `owners_ownership_sub_type_id_foreign` FOREIGN KEY (`ownership_sub_type_id`) REFERENCES `ownership_sub_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26385 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `owners_change_view`
--

DROP TABLE IF EXISTS `owners_change_view`;
/*!50001 DROP VIEW IF EXISTS `owners_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `owners_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `old_owner_name`,
 1 AS `owner_name`,
 1 AS `school_name`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `ownership_sub_types`
--

DROP TABLE IF EXISTS `ownership_sub_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ownership_sub_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ownership_type_id` bigint unsigned NOT NULL,
  `sub_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ownership_sub_types_ownership_type_id_index` (`ownership_type_id`),
  CONSTRAINT `ownership_sub_types_ownership_type_id_foreign` FOREIGN KEY (`ownership_type_id`) REFERENCES `ownership_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ownership_types`
--

DROP TABLE IF EXISTS `ownership_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ownership_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `payment_statuses`
--

DROP TABLE IF EXISTS `payment_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permission_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11228 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(100) DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6899 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personal_infos`
--

DROP TABLE IF EXISTS `personal_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `personal_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `personal_phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `identity_type_id` bigint unsigned DEFAULT NULL,
  `personal_id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `personal_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ward_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_infos_identity_type_id_index` (`identity_type_id`),
  KEY `personal_infos_ward_id_index` (`ward_id`),
  KEY `personal_info_secure_token_index` (`secure_token`)
) ENGINE=InnoDB AUTO_INCREMENT=26454 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ranks`
--

DROP TABLE IF EXISTS `ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ranks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status_id` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `referees`
--

DROP TABLE IF EXISTS `referees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `occupation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `owner_id` bigint unsigned DEFAULT NULL,
  `ward_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `village_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referees_owner_id_index` (`owner_id`),
  KEY `referees_ward_id_index` (`ward_id`),
  CONSTRAINT `referees_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `RegionCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `RegionName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `zone_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `box` int DEFAULT '0',
  `sqa_zone` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_regions_RegionCode` (`RegionCode`),
  KEY `idx_regions_zone_id` (`zone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `registered_schools_view`
--

DROP TABLE IF EXISTS `registered_schools_view`;
/*!50001 DROP VIEW IF EXISTS `registered_schools_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `registered_schools_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `registration_number`,
 1 AS `registration_date`,
 1 AS `is_seminary`,
 1 AS `sharti`,
 1 AS `school_name`,
 1 AS `stream`,
 1 AS `school_sub_category_id`,
 1 AS `school_id`,
 1 AS `subcategory`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `language`,
 1 AS `language_id`,
 1 AS `school_gender_type_id`,
 1 AS `gender_type`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `registration_change_view`
--

DROP TABLE IF EXISTS `registration_change_view`;
/*!50001 DROP VIEW IF EXISTS `registration_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `registration_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `category`,
 1 AS `old_category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `registration_fees`
--

DROP TABLE IF EXISTS `registration_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registration_fees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registration_structures`
--

DROP TABLE IF EXISTS `registration_structures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registration_structures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `structure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registry_types`
--

DROP TABLE IF EXISTS `registry_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registry_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `registry` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `role_management`
--

DROP TABLE IF EXISTS `role_management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_management` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vyeoId` int DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_roles_vyeoId` (`vyeoId`),
  KEY `idx_roles_status_id` (`status_id`),
  KEY `namex_roles` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `school_categories`
--

DROP TABLE IF EXISTS `school_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uk_msambao` double(8,2) DEFAULT NULL,
  `uk_ghorofa` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_room_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_categories_class_room_id_index` (`class_room_id`),
  CONSTRAINT `school_categories_class_room_id_foreign` FOREIGN KEY (`class_room_id`) REFERENCES `class_rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `school_combination_view`
--

DROP TABLE IF EXISTS `school_combination_view`;
/*!50001 DROP VIEW IF EXISTS `school_combination_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `school_combination_view` AS SELECT 
 1 AS `establishing_school_id`,
 1 AS `combinations`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `school_combinations`
--

DROP TABLE IF EXISTS `school_combinations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_combinations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_registration_id` bigint unsigned DEFAULT NULL,
  `combination_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_combinations_school_registration_id_index` (`school_registration_id`),
  KEY `school_combinations_combination_id_index` (`combination_id`),
  CONSTRAINT `school_combinations_combination_id_foreign` FOREIGN KEY (`combination_id`) REFERENCES `combinations` (`id`),
  CONSTRAINT `school_combinations_school_registration_id_foreign` FOREIGN KEY (`school_registration_id`) REFERENCES `school_registrations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `school_detours`
--

DROP TABLE IF EXISTS `school_detours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_detours` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_registration_id` bigint unsigned DEFAULT NULL,
  `school_specialization_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_detours_school_registration_id_index` (`school_registration_id`),
  KEY `school_detours_school_specialization_id_index` (`school_specialization_id`),
  CONSTRAINT `school_detours_school_registration_id_foreign` FOREIGN KEY (`school_registration_id`) REFERENCES `school_registrations` (`id`),
  CONSTRAINT `school_detours_school_specialization_id_foreign` FOREIGN KEY (`school_specialization_id`) REFERENCES `school_specializations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `school_gender_types`
--

DROP TABLE IF EXISTS `school_gender_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_gender_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `school_managers_view`
--

DROP TABLE IF EXISTS `school_managers_view`;
/*!50001 DROP VIEW IF EXISTS `school_managers_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `school_managers_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `manager_name`,
 1 AS `school_name`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `school_owners_view`
--

DROP TABLE IF EXISTS `school_owners_view`;
/*!50001 DROP VIEW IF EXISTS `school_owners_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `school_owners_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `owner_name`,
 1 AS `school_name`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `ownership_sub_type_id`,
 1 AS `denomination_id`,
 1 AS `denomination`,
 1 AS `sub_type`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `school_registrations`
--

DROP TABLE IF EXISTS `school_registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_registrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `establishing_school_id` bigint unsigned DEFAULT NULL,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `school_opening_date` date DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `level_of_education` bigint unsigned DEFAULT NULL,
  `is_seminary` tinyint(1) NOT NULL DEFAULT '0',
  `registration_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `reg_status` tinyint(1) DEFAULT '2',
  `sharti` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_registrations_establishing_school_id_index` (`establishing_school_id`),
  KEY `reg_status_index` (`reg_status`),
  KEY `idx_school_registrations_tracking_number` (`tracking_number`),
  KEY `idx_school_registrations_level_of_education` (`level_of_education`),
  CONSTRAINT `school_registrations_establishing_school_id_foreign` FOREIGN KEY (`establishing_school_id`) REFERENCES `establishing_schools` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26352 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `school_registries`
--

DROP TABLE IF EXISTS `school_registries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_registries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `registry_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_registries_school_token_index` (`school_token`),
  KEY `school_registries_registry_token_index` (`registry_token`)
) ENGINE=InnoDB AUTO_INCREMENT=1012 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `school_specializations`
--

DROP TABLE IF EXISTS `school_specializations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_specializations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `specialization` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `school_sub_categories`
--

DROP TABLE IF EXISTS `school_sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subcategory` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sect_names`
--

DROP TABLE IF EXISTS `sect_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sect_names` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `word` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_status` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_notify` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `station_level` int DEFAULT NULL,
  `office` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `zone_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `region_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `district_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `signature` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `kaimu` int NOT NULL DEFAULT '0',
  `kaimu_cheo` int DEFAULT NULL,
  `twofa` tinyint(1) DEFAULT '0',
  `twofa_digit` int DEFAULT NULL,
  `token_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `login_id` int DEFAULT '0',
  `new_role_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_staffs_username` (`username`),
  KEY `idx_staffs_user_status` (`user_status`),
  KEY `idx_staffs_email` (`email`),
  KEY `idx_staffs_user_level` (`user_level`),
  KEY `idx_staffs_role_id` (`role_id`),
  KEY `idx_staffs_station_level` (`station_level`),
  KEY `idx_staffs_office` (`office`),
  KEY `idx_staffs_zone_id` (`zone_id`),
  KEY `idx_staffs_region_code` (`region_code`),
  KEY `idx_staffs_district_code` (`district_code`),
  KEY `idx_staffs_kaimu_cheo` (`kaimu_cheo`),
  KEY `idx_staffs_kaimu` (`kaimu`),
  KEY `idx_staffs_login_id` (`login_id`),
  KEY `idx_staffs_new_role_id` (`new_role_id`),
  KEY `namex_staffs_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `streams_change_view`
--

DROP TABLE IF EXISTS `streams_change_view`;
/*!50001 DROP VIEW IF EXISTS `streams_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `streams_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `stream`,
 1 AS `old_stream`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `streets`
--

DROP TABLE IF EXISTS `streets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `streets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `StreetCode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `StreetName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `WardCode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `streets_streetcode_unique` (`StreetCode`),
  KEY `street_uid_index` (`id`,`StreetCode`),
  KEY `ward_code_index` (`WardCode`),
  KEY `idx_streets_StreetCode` (`StreetCode`),
  KEY `idx_streets_WardCode` (`WardCode`)
) ENGINE=InnoDB AUTO_INCREMENT=13410 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_staff_infos`
--

DROP TABLE IF EXISTS `student_staff_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_staff_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school_registration_id` bigint unsigned DEFAULT NULL,
  `number_of_students` int DEFAULT NULL,
  `lessons_and_courses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `number_of_teachers` int DEFAULT NULL,
  `teacher_student_ratio_recommendation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `teacher_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_staff_infos_school_registration_id_index` (`school_registration_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `tahasusi_change_view`
--

DROP TABLE IF EXISTS `tahasusi_change_view`;
/*!50001 DROP VIEW IF EXISTS `tahasusi_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `tahasusi_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `school_id`,
 1 AS `category`,
 1 AS `old_combinations`,
 1 AS `combinations`,
 1 AS `school_category_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `transfer_change_view`
--

DROP TABLE IF EXISTS `transfer_change_view`;
/*!50001 DROP VIEW IF EXISTS `transfer_change_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `transfer_change_view` AS SELECT 
 1 AS `tracking_number`,
 1 AS `app_name`,
 1 AS `user_id`,
 1 AS `staff_id`,
 1 AS `created_at`,
 1 AS `payment_status_id`,
 1 AS `school_name`,
 1 AS `category`,
 1 AS `school_category_id`,
 1 AS `school_id`,
 1 AS `registry_type_id`,
 1 AS `registration_structure_id`,
 1 AS `structure`,
 1 AS `registry`,
 1 AS `region`,
 1 AS `district`,
 1 AS `ward`,
 1 AS `street`,
 1 AS `old_region`,
 1 AS `old_district`,
 1 AS `old_ward`,
 1 AS `old_street`,
 1 AS `is_approved`,
 1 AS `approved_at`,
 1 AS `region_code`,
 1 AS `district_code`,
 1 AS `ward_code`,
 1 AS `street_code`,
 1 AS `zone_id`,
 1 AS `zone_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `secure_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=338 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `vyeo`
--

DROP TABLE IF EXISTS `vyeo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vyeo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int DEFAULT '1',
  `rank_level` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_vyeo_status_id` (`status_id`),
  KEY `idx_vyeo_rank_level` (`rank_level`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wards`
--

DROP TABLE IF EXISTS `wards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `LgaCode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `WardCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `WardName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ward_uid_index` (`id`,`WardCode`),
  KEY `wards_code_index` (`WardCode`),
  KEY `lga_code_index` (`LgaCode`),
  KEY `idx_wards_WardCode` (`WardCode`),
  KEY `idx_wards_LgaCode` (`LgaCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3939 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `work_flow`
--

DROP TABLE IF EXISTS `work_flow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_flow` (
  `id` int NOT NULL AUTO_INCREMENT,
  `application_category_id` bigint NOT NULL,
  `start_from` int NOT NULL,
  `end_to` int NOT NULL,
  `_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `start_from_end_to_unique` (`start_from`,`end_to`,`application_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workflow` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `tracking_number` varchar(150) DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zones` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `zone_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `zone_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `box` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx_zones_id` (`id`),
  KEY `idx_zones_zone_code` (`zone_code`),
  KEY `idx_zones_status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Final view structure for view `administration_areas_view`
--

/*!50001 DROP VIEW IF EXISTS `administration_areas_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `administration_areas_view` AS select `r`.`RegionCode` AS `region_code`,`d`.`LgaCode` AS `district_code`,`w`.`WardCode` AS `ward_code`,`s`.`StreetCode` AS `street_code`,`r`.`zone_id` AS `zone_id`,`r`.`RegionName` AS `region`,`d`.`LgaName` AS `district`,`d`.`district_box` AS `ded_box`,`d`.`ngazi` AS `ngazi_ya_wilaya`,`w`.`WardName` AS `ward`,`s`.`StreetName` AS `street`,`z`.`zone_name` AS `zone_name`,`z`.`box` AS `zone_box`,`r`.`box` AS `region_box`,`r`.`sqa_zone` AS `has_zone_office`,`d`.`district_box` AS `district_box`,`d`.`sqa_box` AS `district_sqa_box` from ((((`regions` `r` join `districts` `d` on((`d`.`RegionCode` = `r`.`RegionCode`))) join `wards` `w` on((`w`.`LgaCode` = `d`.`LgaCode`))) join `streets` `s` on((`s`.`WardCode` = `w`.`WardCode`))) left join `zones` `z` on((`z`.`id` = `r`.`zone_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `bweni_change_view`
--

/*!50001 DROP VIEW IF EXISTS `bweni_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `bweni_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`sgt`.`gender_type` AS `gender_type`,`e`.`number_of_students` AS `number_of_students`,`sc`.`category` AS `category`,`ssc`.`subcategory` AS `subcategory`,`ossc`.`subcategory` AS `old_subcategory`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from ((((((((((`applications` `a` join `former_school_infos` `fsi` on((`fsi`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fsi`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `school_sub_categories` `ossc` on((`ossc`.`id` = `fsi`.`school_sub_category_id`))) left join `school_sub_categories` `ssc` on((`ssc`.`id` = `e`.`school_sub_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) left join `school_gender_types` `sgt` on((`sgt`.`id` = `e`.`school_gender_type_id`))) where (`a`.`application_category_id` = 14) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `dahalia_change_view`
--

/*!50001 DROP VIEW IF EXISTS `dahalia_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `dahalia_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`e`.`is_hostel` AS `is_hostel`,`fsi`.`is_hostel` AS `was_hostel`,`sc`.`category` AS `category`,`e`.`number_of_students` AS `number_of_students`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from (((((((`applications` `a` join `former_school_infos` `fsi` on((`fsi`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fsi`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 13) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `deregistration_change_view`
--

/*!50001 DROP VIEW IF EXISTS `deregistration_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `deregistration_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name`,`sr`.`reg_status` AS `reg_status` from ((((((((`applications` `a` join `former_school_infos` `fsi` on((`fsi`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fsi`.`establishing_school_id`))) join `school_registrations` `sr` on((`sr`.`establishing_school_id` = `e`.`id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where ((`a`.`application_category_id` = 11) and (`sr`.`reg_status` in (0,1))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `established_schools_view`
--

/*!50001 DROP VIEW IF EXISTS `established_schools_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `established_schools_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from ((((((`applications` `a` join `establishing_schools` `e` on((`e`.`tracking_number` = `a`.`tracking_number`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `former_school_combination_view`
--

/*!50001 DROP VIEW IF EXISTS `former_school_combination_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `former_school_combination_view` AS select `fsc`.`establishing_school_id` AS `establishing_school_id`,group_concat(`c`.`combination` separator ',') AS `combinations`,`fsc`.`tracking_number` AS `tracking_number` from (`former_school_combinations` `fsc` join `combinations` `c` on((`c`.`id` = `fsc`.`combination_id`))) where ((`c`.`status_id` = 1) and (`fsc`.`establishing_school_id` is not null) and (`fsc`.`tracking_number` is not null)) group by `fsc`.`establishing_school_id`,`fsc`.`tracking_number` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `managers_change_view`
--

/*!50001 DROP VIEW IF EXISTS `managers_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `managers_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,lower(concat(`fm`.`manager_first_name`,' ',`fm`.`manager_middle_name`,' ',`fm`.`manager_last_name`)) AS `old_manager_name`,lower(concat(`m`.`manager_first_name`,' ',`m`.`manager_middle_name`,' ',`m`.`manager_last_name`)) AS `manager_name`,`e`.`school_name` AS `school_name`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from ((((((((`applications` `a` join `former_managers` `fm` on((`fm`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fm`.`establishing_school_id`))) join `managers` `m` on((`m`.`establishing_school_id` = `e`.`id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 8) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `name_change_view`
--

/*!50001 DROP VIEW IF EXISTS `name_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `name_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`fsi`.`school_name` AS `old_school_name`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from (((((((`applications` `a` join `former_school_infos` `fsi` on((`fsi`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fsi`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) left join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 9) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `owners_change_view`
--

/*!50001 DROP VIEW IF EXISTS `owners_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `owners_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`fo`.`owner_name` AS `old_owner_name`,`o`.`owner_name` AS `owner_name`,`e`.`school_name` AS `school_name`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from ((((((((`applications` `a` join `former_owners` `fo` on((`fo`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fo`.`establishing_school_id`))) join `owners` `o` on((`o`.`establishing_school_id` = `e`.`id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 7) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `registered_schools_view`
--

/*!50001 DROP VIEW IF EXISTS `registered_schools_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `registered_schools_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`sr`.`registration_number` AS `registration_number`,`sr`.`registration_date` AS `registration_date`,`sr`.`is_seminary` AS `is_seminary`,`sr`.`sharti` AS `sharti`,`e`.`school_name` AS `school_name`,`e`.`stream` AS `stream`,`e`.`school_sub_category_id` AS `school_sub_category_id`,`e`.`id` AS `school_id`,lower(`ssc`.`subcategory`) AS `subcategory`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`l`.`language` AS `language`,`e`.`language_id` AS `language_id`,`e`.`school_gender_type_id` AS `school_gender_type_id`,lower(`sgt`.`gender_type`) AS `gender_type`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from ((((((((((`applications` `a` join `school_registrations` `sr` on((`sr`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `sr`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `school_sub_categories` `ssc` on((`ssc`.`id` = `e`.`school_sub_category_id`))) left join `languages` `l` on((`l`.`id` = `e`.`language_id`))) left join `school_gender_types` `sgt` on((`sgt`.`id` = `e`.`school_gender_type_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) left join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 4) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `registration_change_view`
--

/*!50001 DROP VIEW IF EXISTS `registration_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `registration_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`sc`.`category` AS `category`,`scf`.`category` AS `old_category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from ((((((((`applications` `a` join `former_school_infos` `fsi` on((`fsi`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fsi`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `school_categories` `scf` on((`scf`.`id` = `fsi`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 6) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `school_combination_view`
--

/*!50001 DROP VIEW IF EXISTS `school_combination_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `school_combination_view` AS select `sc`.`school_registration_id` AS `establishing_school_id`,group_concat(`c`.`combination` separator ',') AS `combinations` from (`school_combinations` `sc` join `combinations` `c` on((`c`.`id` = `sc`.`combination_id`))) where ((`c`.`status_id` = 1) and (`sc`.`school_registration_id` is not null)) group by `sc`.`school_registration_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `school_managers_view`
--

/*!50001 DROP VIEW IF EXISTS `school_managers_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `school_managers_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,concat(`m`.`manager_first_name`,' ',`m`.`manager_middle_name`,' ',`m`.`manager_last_name`) AS `manager_name`,`e`.`school_name` AS `school_name`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from (((((((`applications` `a` join `managers` `m` on((`m`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `m`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 2) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `school_owners_view`
--

/*!50001 DROP VIEW IF EXISTS `school_owners_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `school_owners_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`o`.`owner_name` AS `owner_name`,`e`.`school_name` AS `school_name`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`o`.`ownership_sub_type_id` AS `ownership_sub_type_id`,`o`.`denomination_id` AS `denomination_id`,`de`.`denomination` AS `denomination`,`ost`.`sub_type` AS `sub_type`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from (((((((((`applications` `a` join `owners` `o` on((`o`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `o`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `ownership_sub_types` `ost` on((`ost`.`id` = `o`.`ownership_sub_type_id`))) left join `denominations` `de` on((`de`.`id` = `o`.`denomination_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) left join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 2) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `streams_change_view`
--

/*!50001 DROP VIEW IF EXISTS `streams_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `streams_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`e`.`stream` AS `stream`,`fsi`.`stream` AS `old_stream`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from (((((((`applications` `a` join `former_school_infos` `fsi` on((`fsi`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fsi`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 5) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `tahasusi_change_view`
--

/*!50001 DROP VIEW IF EXISTS `tahasusi_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `tahasusi_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`e`.`id` AS `school_id`,`sc`.`category` AS `category`,`fsci`.`combinations` AS `old_combinations`,`csc`.`combinations` AS `combinations`,`e`.`school_category_id` AS `school_category_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from ((((((((`applications` `a` join `former_school_combination_view` `fsci` on((`fsci`.`tracking_number` = `a`.`tracking_number`))) left join `school_combination_view` `csc` on((`csc`.`establishing_school_id` = `fsci`.`establishing_school_id`))) left join `establishing_schools` `e` on((`e`.`id` = `fsci`.`establishing_school_id`))) left join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) left join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 12) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `transfer_change_view`
--

/*!50001 DROP VIEW IF EXISTS `transfer_change_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */

/*!50001 VIEW `transfer_change_view` AS select `a`.`tracking_number` AS `tracking_number`,`ac`.`app_name` AS `app_name`,`a`.`user_id` AS `user_id`,`a`.`staff_id` AS `staff_id`,`a`.`created_at` AS `created_at`,`a`.`payment_status_id` AS `payment_status_id`,`e`.`school_name` AS `school_name`,`sc`.`category` AS `category`,`e`.`school_category_id` AS `school_category_id`,`e`.`id` AS `school_id`,`a`.`registry_type_id` AS `registry_type_id`,`e`.`registration_structure_id` AS `registration_structure_id`,`rs`.`structure` AS `structure`,`rt`.`registry` AS `registry`,`aav`.`region` AS `region`,`aav`.`district` AS `district`,`aav`.`ward` AS `ward`,`aav`.`street` AS `street`,`oaav`.`region` AS `old_region`,`oaav`.`district` AS `old_district`,`oaav`.`ward` AS `old_ward`,`oaav`.`street` AS `old_street`,`a`.`is_approved` AS `is_approved`,`a`.`approved_at` AS `approved_at`,`aav`.`region_code` AS `region_code`,`aav`.`district_code` AS `district_code`,`aav`.`ward_code` AS `ward_code`,`aav`.`street_code` AS `street_code`,`aav`.`zone_id` AS `zone_id`,`aav`.`zone_name` AS `zone_name` from ((((((((`applications` `a` join `former_school_infos` `fsi` on((`fsi`.`tracking_number` = `a`.`tracking_number`))) join `establishing_schools` `e` on((`e`.`id` = `fsi`.`establishing_school_id`))) join `administration_areas_view` `aav` on(((`aav`.`ward_code` = `e`.`ward_id`) and (`aav`.`street_code` = `e`.`village_id`)))) join `administration_areas_view` `oaav` on(((`oaav`.`ward_code` = `fsi`.`ward_id`) and (`oaav`.`street_code` = `fsi`.`village_id`)))) left join `school_categories` `sc` on((`sc`.`id` = `e`.`school_category_id`))) left join `registration_structures` `rs` on((`rs`.`id` = `e`.`registration_structure_id`))) left join `registry_types` `rt` on((`rt`.`id` = `a`.`registry_type_id`))) join `application_categories` `ac` on((`ac`.`id` = `a`.`application_category_id`))) where (`a`.`application_category_id` = 10) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-18 23:11:35
