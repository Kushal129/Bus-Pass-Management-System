-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: buspassms
-- ------------------------------------------------------
-- Server version 	10.4.28-MariaDB
-- Date: Mon, 30 Oct 2023 15:04:55 +0100

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40101 SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bus_terminals`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus_terminals` (
  `ter_id` int(11) NOT NULL AUTO_INCREMENT,
  `ter_name` varchar(150) NOT NULL,
  `city_id` int(11) NOT NULL,
  `lati` text NOT NULL COMMENT 'Latitude',
  `long` text NOT NULL COMMENT 'Longitude',
  PRIMARY KEY (`ter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_terminals`
--

LOCK TABLES `bus_terminals` WRITE;
/*!40000 ALTER TABLE `bus_terminals` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `bus_terminals` VALUES (1,'Surat',1,'21.1702','72.8311'),(2,'Bardoli',1,'21.1230','73.1169'),(3,'Ahmedabad',1,'23.0225','72.5714'),(4,'Vadodara',1,' 22.3072','73.1812'),(5,'Rajkot',1,'22.3039','70.8022'),(6,'Gandhinagar',1,'23.2156','72.6369'),(7,'Bhavnagar',1,'21.7645','72.1519'),(8,'Jamnagar',1,'22.4707','70.0577'),(9,'Junagadh',1,'21.5222','70.4579'),(10,'Anand',1,'22.5524','72.9550'),(11,'Bharuch',1,'21.7051','72.9959'),(12,'Nadiad',1,'22.6975','72.8616'),(13,'Mehsana',1,'23.5865','72.3693'),(14,'Gandhidham',1,'23.0787','70.1328'),(15,'Porbandar',1,'21.6415','69.6293'),(16,'Navsari',1,'20.9467','72.9306'),(17,'Veraval',1,'20.9142','70.3679'),(18,'Ankleshwar',1,'21.6279','72.9932'),(19,'Morbi',1,'22.8170','70.8342'),(20,'Surendranagar',1,'22.7253','71.6370'),(22,'Godhra',1,'22.8311','73.6147'),(23,'Palanpur',1,'24.1848','72.8328'),(24,'Valsad',1,'20.5994','72.9342'),(25,'Bhuj',1,'23.2533','69.6693'),(26,'Vapi',1,'20.3718','72.9045'),(27,'Amreli',1,'21.6032','71.2221'),(28,'Himatnagar',1,'23.5990','72.9623'),(29,'Dahod',1,'22.8362','74.2579'),(30,'Botad',1,'22.1713','71.6662'),(31,'Keshod',1,'21.3069','70.2462'),(32,'Visnagar',1,'23.7059','72.5499'),(33,'Mangrol',1,'21.1143','70.1167'),(34,'Wadhwan',1,'22.7454','71.7273'),(35,'Modasa',1,'23.4664','73.2986'),(36,'Jetpur',1,'21.7539','70.6234'),(37,'Dhoraji',1,'21.7383','70.4520'),(38,'Kalol',1,'23.2547','72.4994'),(39,'Dholka',1,'22.7297','72.6561'),(40,'Dhandhuka',1,'22.3744','71.9826'),(41,'Kadi',1,'23.2972','72.3306'),(42,'Thangadh',1,'22.5641','71.1870'),(43,'Unjha',1,'23.8014','72.3900'),(44,'Siddhpur',1,'23.9176','72.3831'),(45,'Mansa',1,'23.2361','72.6624'),(46,'Limbdi',1,'22.5732','71.8064'),(47,'Borsad',1,'22.4162','73.1092'),(48,'Halvad',1,'23.0181','71.1770'),(49,'Rajula',1,'21.0345','71.4557'),(50,'Mahuva',1,'21.1070','71.7705'),(51,'Kutch',1,'23.6333','69.8333'),(52,'Palitana',1,'21.5173','71.8235'),(53,'Kapadvanj',1,'23.0217','73.1229'),(54,'Lunawada',1,'23.1264','73.6111'),(55,'Viramgam',1,'23.1240','73.1336'),(56,'Visavadar',1,'21.3645','70.1471'),(57,'Wankaner',1,'22.6110','70.9375'),(58,'Padra',1,'22.2978','73.1785'),(59,'Dabhoi',1,'22.1761','73.4227'),(60,'Bhujodi',1,'23.2825','69.7189'),(61,'Porbandar',1,'21.6439','69.6080'),(62,'Gandhidham',1,'23.0863','70.1311'),(63,'Dwarka',1,'22.2394','68.9678'),(64,'Palitana',1,'21.5202','71.8310'),(65,'Morbi',1,'22.8122','70.8393'),(66,'Bhuj',1,'23.2625','69.6648'),(67,'Anjar',1,'23.1100','70.1170'),(68,'Buhari',1,'20.967659','73.3069363');
/*!40000 ALTER TABLE `bus_terminals` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `bus_terminals` with 67 row(s)
--

--
-- Table structure for table `bus_type`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus_type` (
  `bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(120) NOT NULL,
  `price_multiply` float NOT NULL,
  PRIMARY KEY (`bus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_type`
--

LOCK TABLES `bus_type` WRITE;
/*!40000 ALTER TABLE `bus_type` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `bus_type` VALUES (1,'LOCAL',1),(2,'EXPRESS',1.3),(3,'GURJARNAGRI',1.5);
/*!40000 ALTER TABLE `bus_type` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `bus_type` with 3 row(s)
--

--
-- Table structure for table `cast`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cast` (
  `cast_id` int(11) NOT NULL AUTO_INCREMENT,
  `cast_name` varchar(150) NOT NULL,
  PRIMARY KEY (`cast_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cast`
--

LOCK TABLES `cast` WRITE;
/*!40000 ALTER TABLE `cast` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `cast` VALUES (1,'General'),(2,'SCBC'),(3,'ST'),(4,'SC');
/*!40000 ALTER TABLE `cast` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `cast` with 4 row(s)
--

--
-- Table structure for table `city`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(200) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `city` VALUES (1,'Ahmedabad'),(2,'Vadodara'),(3,'Surat'),(4,'Rajkot'),(5,'Gandhinagar'),(6,'Bhavnagar'),(7,'Jamnagar'),(8,'Junagadh'),(9,'Anand'),(10,'Bharuch'),(11,'Nadiad'),(12,'Mehsana'),(13,'Gandhidham'),(14,'Porbandar'),(15,'Navsari'),(16,'Veraval'),(17,'Ankleshwar'),(18,'Morbi'),(19,'Surendranagar'),(20,'Godhra'),(21,'Palanpur'),(22,'Valsad'),(23,'Bhuj'),(24,'Bardoli'),(25,'Vapi'),(26,'Amreli'),(27,'Himatnagar'),(28,'Dahod'),(29,'Botad'),(30,'Keshod'),(31,'Visnagar'),(32,'Mangrol'),(33,'Wadhwan'),(34,'Modasa'),(35,'Jetpur'),(36,'Dhoraji'),(37,'Kalol'),(38,'Dholka'),(39,'Dhandhuka'),(40,'Kadi'),(41,'Thangadh'),(42,'Unjha'),(43,'Siddhpur'),(44,'Mansa'),(45,'Limbdi'),(46,'Borsad'),(47,'Halvad'),(48,'Rajula'),(49,'Mahuva'),(50,'Kutch'),(51,'Palitana'),(52,'Kapadvanj'),(53,'Lunawada'),(54,'Viramgam'),(55,'Visavadar'),(56,'Wankaner'),(57,'Padra'),(58,'Dabhoi');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `city` with 58 row(s)
--

--
-- Table structure for table `disability_type`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disability_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disability_type`
--

LOCK TABLES `disability_type` WRITE;
/*!40000 ALTER TABLE `disability_type` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `disability_type` VALUES (1,'Physical Disability'),(2,'Intellectual Disability'),(3,'Visual Disability'),(4,'Hearing Disability'),(5,'Other');
/*!40000 ALTER TABLE `disability_type` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `disability_type` with 5 row(s)
--

--
-- Table structure for table `document`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type_id` int(11) NOT NULL,
  `document_file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `document` VALUES (1,3,'2023092976Screenshot 2023-09-13 194148.png'),(2,3,'202309298502Screenshot 2023-09-13 194148.png'),(3,3,'202309298657Screenshot 2023-09-13 194148.png'),(4,3,'202309291770Screenshot 2023-09-13 194148.png'),(5,4,'202309294584Screenshot 2023-09-13 194148.png'),(6,3,'202309305978Screenshot 2023-09-13 194148.png'),(7,6,'202309303415Screenshot 2023-09-13 194148.png'),(8,1,'202309308166Screenshot 2023-09-13 194148.png'),(9,9,'202309306405Screenshot 2023-09-13 194148.png'),(10,1,'202309305986Screenshot 2023-09-13 194148.png'),(11,1,'202309305951Screenshot 2023-09-13 194148.png'),(12,1,'202309303695Screenshot 2023-09-13 194148.png'),(13,1,'20230930753Screenshot 2023-09-13 194148.png'),(14,1,'202309305510fenil-removebg-preview.png'),(15,1,'202309303765fenil-removebg-preview.png'),(16,1,'202309306696fenil-removebg-preview.png'),(17,1,'202309303218fenil-removebg-preview.png'),(18,1,'202309302448fenil-removebg-preview.png'),(19,1,'202309308987Screenshot 2023-09-13 194148.png'),(20,1,'202309301151Screenshot 2023-09-13 194148.png'),(21,7,'202309307764Screenshot 2023-09-13 194148.png'),(22,2,'202309306287Screenshot 2023-09-13 194148.png'),(23,2,'202310014601Screenshot 2023-09-13 194148.png'),(24,2,'202310014220Screenshot 2023-09-13 194148.png'),(25,1,'202310037014Screenshot 2023-09-13 194148.png'),(26,1,'202310076318Screenshot 2023-10-06 191819.png'),(27,1,'202310128647Screenshot 2023-10-06 191819.png'),(28,1,'20231012881Screenshot 2023-10-06 191819.png'),(29,3,'202310125802Screenshot 2023-10-06 191819.png'),(30,2,'202310121351Screenshot 2023-10-06 191819.png'),(31,1,'202310121616Screenshot 2023-10-06 191819.png'),(32,1,'202310129139Screenshot 2023-10-06 191819.png'),(33,1,'202310123893Screenshot 2023-10-06 191819.png'),(34,1,'202310128671Screenshot 2023-10-06 191819.png'),(35,1,'202310121641Screenshot 2023-10-06 191819.png'),(36,1,'202310122785Screenshot 2023-10-06 191819.png'),(37,2,'202310217047Screenshot 2023-10-06 191819.png'),(38,2,'20231021849Screenshot 2023-10-06 191819.png'),(39,0,'202310218524'),(40,1,'202310214562Screenshot 2023-10-06 191819.png'),(41,1,'202310213452Screenshot 2023-10-06 191819.png'),(42,1,'202310215444Screenshot 2023-10-06 191819.png'),(43,1,'202310212940Screenshot 2023-10-06 191819.png'),(44,1,'202310219186Screenshot 2023-10-06 191819.png'),(45,1,'202310213416Screenshot 2023-10-06 191819.png'),(46,2,'20231021762Screenshot 2023-10-06 191819.png'),(47,2,'202310211939Screenshot 2023-10-06 191819.png'),(48,2,'202310216894Screenshot 2023-10-06 191819.png'),(49,2,'202310213280Screenshot 2023-10-06 191819.png'),(50,2,'202310213689Screenshot 2023-10-06 191819.png'),(51,2,'202310217897Screenshot 2023-10-06 191819.png'),(52,2,'202310214535Screenshot 2023-10-06 191819.png'),(53,2,'202310212038Screenshot 2023-10-06 191819.png'),(54,2,'202310216025Screenshot 2023-10-06 191819.png'),(55,2,'202310212249Screenshot 2023-10-06 191819.png'),(56,2,'20231021574Screenshot 2023-10-06 191819.png'),(57,2,'202310216019Screenshot 2023-10-06 191819.png'),(58,2,'202310218968Screenshot 2023-10-06 191819.png'),(59,2,'202310214743Screenshot 2023-10-06 191819.png'),(60,2,'202310219765Screenshot 2023-10-06 191819.png'),(61,2,'202310214494Screenshot 2023-10-06 191819.png'),(62,2,'202310214926Screenshot 2023-10-06 191819.png'),(63,2,'202310212732Screenshot 2023-10-06 191819.png'),(64,2,'202310217168Screenshot 2023-10-06 191819.png'),(65,2,'202310216776Screenshot 2023-10-06 191819.png'),(66,2,'202310217331Screenshot 2023-10-06 191819.png'),(67,2,'20231021157Screenshot 2023-10-06 191819.png'),(68,2,'202310217549Screenshot 2023-10-06 191819.png'),(69,2,'202310212941Screenshot 2023-10-06 191819.png'),(70,2,'202310211747Screenshot 2023-10-06 191819.png'),(71,2,'202310215405Screenshot 2023-10-06 191819.png'),(72,2,'202310213971Screenshot 2023-10-06 191819.png'),(73,2,'202310219937Screenshot 2023-10-06 191819.png'),(74,2,'202310218895Screenshot 2023-10-06 191819.png'),(75,2,'202310219836Screenshot 2023-10-06 191819.png'),(76,2,'202310212761Screenshot 2023-10-06 191819.png'),(77,2,'202310217227Screenshot 2023-10-06 191819.png'),(78,2,'202310218304Screenshot 2023-10-06 191819.png'),(79,2,'202310216086Screenshot 2023-10-06 191819.png'),(80,2,'202310219428Screenshot 2023-10-06 191819.png'),(81,2,'202310213053Screenshot 2023-10-06 191819.png'),(82,2,'202310212841Screenshot 2023-10-06 191819.png'),(83,2,'202310216041Screenshot 2023-10-06 191819.png'),(84,2,'202310211072Screenshot 2023-10-06 191819.png'),(85,2,'202310211510Screenshot 2023-10-06 191819.png'),(86,2,'202310218252Screenshot 2023-10-06 191819.png'),(87,2,'202310217912Screenshot 2023-10-06 191819.png'),(88,2,'20231021910Screenshot 2023-10-06 191819.png'),(89,2,'202310216306Screenshot 2023-10-06 191819.png'),(90,2,'202310216Screenshot 2023-10-06 191819.png'),(91,2,'202310219510Screenshot 2023-10-06 191819.png'),(92,2,'202310218438Screenshot 2023-10-06 191819.png'),(93,2,'202310211372Screenshot 2023-10-06 191819.png'),(94,2,'202310212588Screenshot 2023-10-06 191819.png'),(95,2,'202310219990Screenshot 2023-10-06 191819.png'),(96,2,'202310211637Screenshot 2023-10-06 191819.png'),(97,2,'202310212251Screenshot 2023-10-06 191819.png'),(98,2,'202310219481Screenshot 2023-10-06 191819.png'),(99,2,'202310219804Screenshot 2023-10-06 191819.png'),(100,2,'20231021557Screenshot 2023-10-06 191819.png'),(101,2,'202310218566Screenshot 2023-10-06 191819.png'),(102,2,'202310214444Screenshot 2023-10-06 191819.png'),(103,2,'202310213552Screenshot 2023-10-06 191819.png'),(104,2,'20231021338Screenshot 2023-10-06 191819.png'),(105,2,'202310213704Screenshot 2023-10-06 191819.png'),(106,2,'202310211451Screenshot 2023-10-06 191819.png'),(107,2,'202310218121Screenshot 2023-10-06 191819.png'),(108,2,'202310219119Screenshot 2023-10-06 191819.png'),(109,2,'202310212477Screenshot 2023-10-06 191819.png'),(110,2,'202310214372Screenshot 2023-10-06 191819.png'),(111,2,'202310217521Screenshot 2023-10-06 191819.png'),(112,2,'202310214460Screenshot 2023-10-06 191819.png'),(113,2,'202310214126Screenshot 2023-10-06 191819.png'),(114,2,'202310211440Screenshot 2023-10-06 191819.png'),(115,2,'20231021449Screenshot 2023-10-06 191819.png'),(116,2,'202310219124Screenshot 2023-10-06 191819.png'),(117,1,'202310213267Screenshot 2023-10-06 191819.png'),(118,1,'202310216377Screenshot 2023-10-06 191819.png'),(119,1,'202310217559Screenshot 2023-10-06 191819.png'),(120,1,'202310215858Screenshot 2023-10-06 191819.png'),(121,1,'202310219150Screenshot 2023-10-06 191819.png'),(122,1,'202310219172Screenshot 2023-10-06 191819.png'),(123,1,'202310211431Screenshot 2023-10-06 191819.png'),(124,1,'202310212988Screenshot 2023-10-06 191819.png'),(125,1,'202310217037Screenshot 2023-10-06 191819.png'),(126,1,'202310217645Screenshot 2023-10-06 191819.png'),(127,1,'202310218205Screenshot 2023-10-06 191819.png'),(128,1,'202310216867Screenshot 2023-10-06 191819.png'),(129,1,'202310215037Screenshot 2023-10-06 191819.png'),(130,1,'202310217432Screenshot 2023-10-06 191819.png'),(131,1,'202310214068Screenshot 2023-10-06 191819.png'),(132,1,'202310216412Screenshot 2023-10-06 191819.png'),(133,1,'202310212263Screenshot 2023-10-06 191819.png'),(134,1,'202310219097Screenshot 2023-10-06 191819.png'),(135,1,'202310219960Screenshot 2023-10-06 191819.png'),(136,1,'202310218897Screenshot 2023-10-06 191819.png'),(137,1,'202310217856Screenshot 2023-10-06 191819.png'),(138,1,'202310218197Screenshot 2023-10-06 191819.png'),(139,1,'202310211109Screenshot 2023-10-06 191819.png'),(140,1,'202310213712Screenshot 2023-10-06 191819.png'),(141,1,'202310215636Screenshot 2023-10-06 191819.png'),(142,1,'202310216493Screenshot 2023-10-06 191819.png'),(143,1,'202310219969Screenshot 2023-10-06 191819.png'),(144,1,'202310215974Screenshot 2023-10-06 191819.png'),(145,1,'202310213007Screenshot 2023-10-06 191819.png'),(146,1,'202310214012Screenshot 2023-10-06 191819.png'),(147,1,'202310281922Screenshot 2023-10-06 191819.png'),(148,1,'202310292798Screenshot 2023-10-06 191819.png'),(149,1,'202310296972Screenshot 2023-10-06 191819.png'),(150,1,'202310291901Screenshot 2023-10-06 191819.png'),(151,1,'202310296658Screenshot 2023-10-06 191819.png'),(152,1,'202310291400Screenshot 2023-10-06 191819.png'),(153,1,'20231029267Screenshot 2023-10-06 191819.png'),(154,1,'202310296394Screenshot 2023-10-06 191819.png'),(155,1,'202310291321Screenshot 2023-10-06 191819.png'),(156,1,'202310297409Screenshot 2023-10-06 191819.png'),(157,1,'202310295100Screenshot 2023-10-06 191819.png'),(158,1,'202310298744Screenshot 2023-10-06 191819.png'),(159,1,'20231029766Screenshot 2023-10-06 191819.png'),(160,1,'202310297808Screenshot 2023-10-06 191819.png'),(161,1,'202310295298Screenshot 2023-10-06 191819.png'),(162,1,'202310292964Screenshot 2023-10-06 191819.png'),(163,1,'202310294508Screenshot 2023-10-06 191819.png'),(164,1,'202310293789Screenshot 2023-10-06 191819.png'),(165,1,'202310299012Screenshot 2023-10-06 191819.png'),(166,2,'202310299515Screenshot 2023-10-06 191819.png'),(167,2,'202310292671Screenshot 2023-10-06 191819.png'),(168,2,'202310297902Screenshot 2023-10-06 191819.png'),(169,2,'202310291243Screenshot 2023-10-06 191819.png'),(170,1,'202310293045Screenshot 2023-10-06 191819.png'),(171,1,'202310291508Screenshot 2023-10-06 191819.png'),(172,1,'202310293930Screenshot 2023-10-06 191819.png'),(173,1,'202310294065Screenshot 2023-10-06 191819.png'),(174,1,'202310292860Screenshot 2023-10-06 191819.png'),(175,1,'202310294281Screenshot 2023-10-06 191819.png'),(176,1,'202310292185Screenshot 2023-10-06 191819.png'),(177,1,'202310299035Screenshot 2023-10-06 191819.png'),(178,1,'202310294749Screenshot 2023-10-06 191819.png'),(179,1,'202310296732Screenshot 2023-10-06 191819.png'),(180,1,'20231029925Screenshot 2023-10-06 191819.png'),(181,1,'202310299237Screenshot 2023-10-06 191819.png'),(182,1,'202310292348Screenshot 2023-10-06 191819.png'),(183,1,'202310295588Screenshot 2023-10-06 191819.png'),(184,1,'202310291796Screenshot 2023-10-06 191819.png'),(185,1,'202310297260Screenshot 2023-10-06 191819.png'),(186,1,'202310296380Screenshot 2023-10-06 191819.png'),(187,1,'202310294689Screenshot 2023-10-06 191819.png'),(188,1,'202310296930Screenshot 2023-10-06 191819.png'),(189,1,'202310295928Screenshot 2023-10-06 191819.png'),(190,1,'202310294074Screenshot 2023-10-06 191819.png'),(191,3,'202310297142Screenshot 2023-10-06 191819.png'),(192,1,'202310293427Screenshot 2023-10-06 191819.png'),(193,1,'202310296810Screenshot 2023-10-06 191819.png'),(194,1,'202310293325Screenshot 2023-10-06 191819.png'),(195,2,'202310297462Screenshot 2023-10-06 191819.png'),(196,1,'20231029382Screenshot 2023-10-06 191819.png'),(197,1,'202310309021Screenshot 2023-10-06 191819.png'),(198,1,'202310301613Screenshot 2023-10-06 191819.png'),(199,1,'202310305211Screenshot 2023-10-06 191819.png'),(200,1,'202310301925Screenshot 2023-10-06 191819.png'),(201,1,'202310303608Screenshot 2023-10-06 191819.png'),(202,1,'202310308023Screenshot 2023-10-06 191819.png'),(203,1,'20231030199Screenshot 2023-10-06 191819.png'),(204,1,'202310305889Screenshot 2023-10-06 191819.png'),(205,1,'202310309880Screenshot 2023-10-06 191819.png'),(206,1,'202310305423Screenshot 2023-10-06 191819.png'),(207,1,'20231030641Screenshot 2023-10-06 191819.png'),(208,1,'202310305361Screenshot 2023-10-06 191819.png'),(209,1,'202310301084Screenshot 2023-10-06 191819.png'),(210,1,'2023103058Screenshot 2023-10-06 191819.png'),(211,1,'202310303711Screenshot 2023-10-06 191819.png'),(212,1,'202310308021Screenshot 2023-10-06 191819.png'),(213,1,'20231030107Screenshot 2023-10-06 191819.png'),(214,1,'202310302434Screenshot 2023-10-06 191819.png'),(215,1,'202310305104Screenshot 2023-10-06 191819.png'),(216,1,'202310305403Screenshot 2023-10-06 191819.png'),(217,1,'20231030547Screenshot 2023-10-06 191819.png'),(218,1,'202310302313Screenshot 2023-10-06 191819.png'),(219,1,'202310303143Screenshot 2023-10-06 191819.png');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `document` with 219 row(s)
--

--
-- Table structure for table `document_type`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_type`
--

LOCK TABLES `document_type` WRITE;
/*!40000 ALTER TABLE `document_type` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `document_type` VALUES (1,'Aadhaar card'),(2,'Address card with photo issued by Deptt. Of Posts, Govt. of India'),(3,'Arms License'),(4,'Cast and Domicile Certificate with address and photo issued by State G'),(5,'Certificate of address having Photo issued by MP/MLA/Group-A Gazetted '),(6,'Certificate of address issued by Village Panchayat head or its equival'),(7,'Certificate of address with photo from Govt. recognized educational in'),(8,'CGHS/ECHS Card'),(9,'Credit Card Statement (not older than last three months)'),(10,'Current Passbook of Post Office/any Schedule Bank'),(11,'Driving License'),(12,'Electricity Bill (not older than last three months)'),(13,'Freedom Fighter Card with address'),(14,'Income Tax Assessment Order'),(15,'Kissan Passbook with address'),(16,'Pensioner\'s Card with address'),(17,'Passport'),(18,'Photo Identity Card having address (of Central Govt./PSU or State Govt'),(19,'Ration Card'),(20,'Registered Sale/Lease Agreement'),(21,'Sri Lankan Refugees Identity Card'),(22,'Telephone Bill of Fixed line (not older than last three months)'),(23,'Vehicle Registration Certificate'),(24,'Voter Id'),(25,'Water Bill (not older than last three months)'),(26,'Other (Domicile Certificate)');
/*!40000 ALTER TABLE `document_type` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `document_type` with 26 row(s)
--

--
-- Table structure for table `handicap`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `handicap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `disease` varchar(200) NOT NULL,
  `hand_doc_id` int(11) NOT NULL,
  `disability_area` varchar(80) NOT NULL,
  `disability_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `handicap`
--

LOCK TABLES `handicap` WRITE;
/*!40000 ALTER TABLE `handicap` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `handicap` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `handicap` with 0 row(s)
--

--
-- Table structure for table `otps`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `otp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otps`
--

LOCK TABLES `otps` WRITE;
/*!40000 ALTER TABLE `otps` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `otps` VALUES (163,'22@112.121',694241),(164,'21bmiit134@gmail.com',309937),(167,'21bmiit129@gmail.com',458397),(171,'Kushalhpipaliya01@gmail.com',487856);
/*!40000 ALTER TABLE `otps` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `otps` with 4 row(s)
--

--
-- Table structure for table `pass`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passenger_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bus_type` int(11) NOT NULL,
  `start_term_id` int(11) NOT NULL,
  `ends_term_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `image_id` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pass`
--

LOCK TABLES `pass` WRITE;
/*!40000 ALTER TABLE `pass` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `pass` VALUES (117,142,18,1,1,2,'pay_MqwHO4PXPmnO7l',1,'2023-10-21','2023-11-20'),(118,143,18,1,1,2,'pay_Mtj3Z5tybiALPF',1,'2023-10-28','2024-01-26'),(119,145,21,1,10,4,'pay_MtuHRl2KbgVAbi',1,'2023-10-29','2023-11-28'),(120,146,21,1,10,4,'pay_MtuHRl2KbgVAbi',1,'2023-10-29','2023-11-28'),(121,147,21,1,10,4,'pay_MtuHRl2KbgVAbi',1,'2023-10-29','2023-11-28'),(122,148,21,1,4,10,'pay_MtukDLVAv8MGDW',1,'2023-10-29','2023-11-28'),(123,149,21,1,4,10,'pay_MtukDLVAv8MGDW',1,'2023-10-29','2023-11-28'),(124,150,21,1,4,10,'pay_MtukDLVAv8MGDW',1,'2023-10-29','2023-11-28'),(125,151,21,1,4,10,'pay_MtukDLVAv8MGDW',1,'2023-10-29','2023-11-28'),(126,152,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(127,153,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(128,154,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(129,155,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(130,156,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(131,157,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(132,158,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(133,159,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(134,160,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(135,161,21,1,1,2,'pay_Mtuq7b3kvWakDL',1,'2023-10-29','2023-11-28'),(136,162,21,1,1,2,'pay_Mtw7ZUI10CPD6r',1,'2023-10-29','2023-11-28'),(137,163,21,1,1,2,'pay_Mtw7ZUI10CPD6r',1,'2023-10-29','2023-11-28'),(138,164,21,1,1,2,'pay_Mtw7ZUI10CPD6r',1,'2023-10-29','2023-11-28'),(139,165,21,1,1,2,'pay_Mtw7ZUI10CPD6r',1,'2023-10-29','2023-11-28'),(140,166,21,1,1,2,'pay_MtwO1aOoTgXP3d',1,'2023-10-29','2023-11-28'),(141,167,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(142,168,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(143,169,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(144,170,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(145,171,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(146,172,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(147,173,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(148,174,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(149,175,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(150,176,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(151,177,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(152,178,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(153,179,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(154,180,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(155,181,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(156,182,21,1,2,1,'pay_MtwXwIaLX1D2pG',1,'2023-10-29','2023-11-28'),(157,183,21,1,1,2,'pay_Mtx2gvkZ53u0Qu',1,'2023-10-29','2023-11-28'),(158,184,21,1,1,2,'pay_Mtx7BzYcppD5FZ',1,'2023-10-29','2023-11-28'),(159,185,21,1,2,1,'pay_MtxAg1Dq3mJa7B',1,'2023-10-29','2023-11-28'),(160,186,18,1,1,2,'pay_Mu1Vh8rDx1lYm0',1,'2023-10-29','2023-11-28'),(161,187,18,1,1,2,'pay_Mu1e5e7AtxERIA',1,'2023-10-29','2023-11-28'),(162,188,18,1,1,2,'pay_Mu1nKMZsc1IEds',1,'2023-10-29','2023-11-28'),(163,189,18,1,1,2,'pay_Mu26MfM2EjuOio',1,'2023-10-29','2023-11-28'),(164,190,18,1,1,2,'pay_Mu26MfM2EjuOio',1,'2023-10-29','2023-11-28'),(165,191,18,1,1,2,'pay_Mu2MPzFnXJcz9b',1,'2023-10-29','2023-11-28'),(166,192,22,1,1,2,'pay_Mu2smfB3DaRLPq',1,'2023-10-29','2023-11-28'),(167,193,18,1,1,2,'pay_MuGr7gJXVOucUn',1,'2023-10-30','2023-11-29'),(168,194,18,1,1,2,'pay_MuGr7gJXVOucUn',1,'2023-10-30','2023-11-29'),(169,195,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(170,201,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(171,202,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(172,203,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(173,204,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(174,205,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(175,206,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(176,207,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(177,208,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(178,209,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(179,210,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(180,211,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(181,212,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(182,213,24,1,10,4,'pay_MuIP6VRq05n9iN',1,'2023-10-30','2023-11-29'),(183,214,18,1,1,2,'pay_MuQjT6L3WNNa6Q',1,'2023-10-30','2024-01-28'),(184,215,18,1,1,2,'pay_MuR44um14jSeXf',1,'2023-10-30','2023-11-29');
/*!40000 ALTER TABLE `pass` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `pass` with 68 row(s)
--

--
-- Table structure for table `passenger`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passenger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_type` varchar(100) NOT NULL,
  `com_name` varchar(200) NOT NULL,
  `com_address` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passenger`
--

LOCK TABLES `passenger` WRITE;
/*!40000 ALTER TABLE `passenger` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `passenger` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `passenger` with 0 row(s)
--

--
-- Table structure for table `passenger_info`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passenger_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` char(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `document_id` int(11) NOT NULL,
  `gender` char(20) NOT NULL,
  `role` int(11) NOT NULL COMMENT 'Role which define the actual role (passenger , student , handicapt)',
  `r_id` int(11) NOT NULL COMMENT 'Role_id which defines the users id ex (student id , handicap_id)',
  `user_id` int(11) NOT NULL,
  `validate_through` date NOT NULL,
  `dob` date NOT NULL,
  `user_img_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_foreign` (`user_id`),
  KEY `document_id_foregin` (`document_id`),
  CONSTRAINT `document_id_foregin` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`),
  CONSTRAINT `user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passenger_info`
--

LOCK TABLES `passenger_info` WRITE;
/*!40000 ALTER TABLE `passenger_info` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `passenger_info` VALUES (215,'Kushal Pipaliya','Hari hari 2',219,'Male',0,242,18,'2024-04-30','2004-08-12','../uploads/kp (1).jpeg');
/*!40000 ALTER TABLE `passenger_info` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `passenger_info` with 1 row(s)
--

--
-- Table structure for table `pass_method`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pass_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `duration` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pass_method`
--

LOCK TABLES `pass_method` WRITE;
/*!40000 ALTER TABLE `pass_method` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `pass_method` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `pass_method` with 0 row(s)
--

--
-- Table structure for table `payment_method`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_method`
--

LOCK TABLES `payment_method` WRITE;
/*!40000 ALTER TABLE `payment_method` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `payment_method` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `payment_method` with 0 row(s)
--

--
-- Table structure for table `price`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'price per km\r\n',
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price`
--

LOCK TABLES `price` WRITE;
/*!40000 ALTER TABLE `price` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `price` VALUES (1,13);
/*!40000 ALTER TABLE `price` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `price` with 1 row(s)
--

--
-- Table structure for table `report`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `note` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `report` VALUES (53,'Kushal Pipaliya','21bmiit134@gmail.com','kskdjdaskdhjfkbs'),(54,'Kushal','kushalhpipaliya@gmail.com','asd'),(55,'Kushal H Pipalioya','21bmiit129@gmail.com','CNNSS'),(58,'Kushal Pipaliya','21bmiit129@gmail.com','adfgafgsaaga');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `report` with 4 row(s)
--

--
-- Table structure for table `state`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(200) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `state` with 0 row(s)
--

--
-- Table structure for table `student`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education` varchar(50) NOT NULL,
  `Institute_name` varchar(150) NOT NULL,
  `Institute_address` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `student` VALUES (2,'3','asda','asd'),(3,'1','ffffgggggg','gggg'),(4,'','',''),(5,'1','ffffft','ttttt'),(6,'2','xhx','dfghgh'),(7,'1','sgfsdfh','sdfg'),(8,'3','dgbbgb','sfgbgfbsgfdb'),(9,'2','ffffff','gggggg'),(10,'2','UTU','Bardoili'),(11,'','',''),(12,'Middle/Higher Primary','ddddd','dddddd'),(13,'Middle/Higher Primary','ddddd','dddddd'),(14,'Senior Secondary','UTU','Bardoli'),(15,'Primary','UTU','drfffrfr'),(16,'Primary','UTU','drfffrfr'),(17,'Primary','UTU','drfffrfr'),(18,'Primary','UTU','drfffrfr'),(19,'Primary','UTU','drfffrfr'),(20,'','',''),(21,'Middle/Higher Primary','kkxkxkxx','kkjjjfj'),(22,'Middle/Higher Primary','kkxkxkxx','kkjjjfj'),(23,'Primary','dddd','dddd'),(24,'Middle/Higher Primary','asdf','asdfasdf'),(25,'Middle/Higher Primary','as','vadf'),(26,'Middle/Higher Primary','asdfafafsaasdfdsa','asdfsfds'),(27,'Graduate','Uka ','Bardoli'),(28,'','',''),(29,'Graduate','utu','bardoli'),(30,'Senior Secondary','UTU','asdaf'),(31,'Senior Secondary','UTU','asdaf'),(32,'','',''),(33,'','',''),(34,'','',''),(35,'Primary','utu','caa'),(36,'','',''),(37,'Primary','asfj','aejf'),(38,'','',''),(39,'Middle/Higher Primary','KK','sd'),(40,'','',''),(41,'Middle/Higher Primary','LL','ddd'),(42,'','',''),(43,'Middle/Higher Primary','JJJFJDJ','ndfndfnfn'),(44,'','',''),(45,'Primary','UTU','lll'),(46,'','',''),(47,'Middle/Higher Primary','UKA','hhhhhhh'),(48,'','',''),(49,'Primary','OOOO','dsddsd'),(50,'','',''),(51,'','',''),(52,'','',''),(53,'PG Diploma','Uka Tarsadiya ','bardoli , surat'),(54,'PG Diploma','Uka Tarsadiya ','bardoli , surat'),(55,'','',''),(56,'','',''),(57,'','',''),(58,'','',''),(59,'','',''),(60,'','',''),(61,'','',''),(62,'Middle/Higher Primary','ad','asd'),(63,'Middle/Higher Primary','ad','asd'),(64,'Middle/Higher Primary','ad','asd'),(65,'Middle/Higher Primary','ad','asd'),(66,'Middle/Higher Primary','ad','asd'),(67,'Middle/Higher Primary','ad','asd'),(68,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(69,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(70,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(71,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(72,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(73,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(74,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(75,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(76,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(77,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(78,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(79,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(80,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(81,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(82,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(83,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(84,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(85,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(86,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(87,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(88,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(89,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(90,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(91,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(92,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(93,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(94,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(95,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(96,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(97,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(98,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(99,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(100,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(101,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(102,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(103,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(104,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(105,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(106,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(107,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(108,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(109,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(110,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(111,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(112,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(113,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(114,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(115,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(116,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(117,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(118,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(119,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(120,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(121,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(122,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(123,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(124,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(125,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(126,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(127,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(128,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(129,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(130,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(131,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(132,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(133,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(134,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(135,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(136,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(137,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(138,'Post Graduate','Uka Tarsadiya ','Maliba collage , Bardoli , surat'),(139,'Diploma','Uka Tarsadiya ','Maliba collage , bardoli  '),(140,'Primary','aa','aa'),(141,'Primary','aa','aa'),(142,'Primary','aa','aa'),(143,'Primary','aa','aa'),(144,'Primary','aa','aa'),(145,'Primary','aa','aa'),(146,'Primary','aa','aa'),(147,'Primary','aa','aa'),(148,'Primary','aa','aa'),(149,'Primary','aa','aa'),(150,'Primary','aa','aa'),(151,'Primary','aa','aa'),(152,'Primary','aa','aa'),(153,'Primary','aa','aa'),(154,'Primary','aa','aa'),(155,'Primary','aa','aa'),(156,'Primary','aa','aa'),(157,'Primary','aa','aa'),(158,'Primary','aa','aa'),(159,'Primary','df','sffsg'),(160,'Primary','df','sffsg'),(161,'Primary','df','sffsg'),(162,'Primary','df','sffsg'),(163,'Primary','df','sffsg'),(164,'Primary','df','sffsg'),(165,'Primary','df','sffsg'),(166,'Primary','df','sffsg'),(167,'Primary','df','sffsg'),(168,'Primary','df','sffsg'),(169,'Senior Secondary','Uka Tarsadiya ','Mahuwa Road , Bardoli '),(170,'Middle/Higher Primary','saf','afd'),(171,'Middle/Higher Primary','saf','afd'),(172,'Middle/Higher Primary','saf','afd'),(173,'Middle/Higher Primary','saf','afd'),(174,'Primary','KKK','afdf'),(175,'Primary','KKK','afdf'),(176,'Primary','KKK','afdf'),(177,'Primary','KKK','afdf'),(178,'Primary','ads','asd'),(179,'Primary','ads','asd'),(180,'Primary','ads','asd'),(181,'Primary','ads','asd'),(182,'Primary','ads','asd'),(183,'Primary','ads','asd'),(184,'Primary','ads','asd'),(185,'Primary','ads','asd'),(186,'Primary','ads','asd'),(187,'Primary','ads','asd'),(188,'Primary','UTU','sadvas'),(189,'Primary','UTU','sadvas'),(190,'Primary','UTU','sadvas'),(191,'Primary','UTU','sadvas'),(192,'Middle/Higher Primary','adasd','asdf'),(193,'Primary','sdc','asd'),(194,'Primary','sdc','asd'),(195,'Primary','sdc','asd'),(196,'Primary','sdc','asd'),(197,'Primary','sdc','asd'),(198,'Primary','sdc','asd'),(199,'Primary','sdc','asd'),(200,'Primary','sdc','asd'),(201,'Primary','sdc','asd'),(202,'Primary','sdc','asd'),(203,'Primary','sdc','asd'),(204,'Primary','sdc','asd'),(205,'Primary','sdc','asd'),(206,'Primary','sdc','asd'),(207,'Primary','sdc','asd'),(208,'Primary','sdc','asd'),(209,'Primary','UTU','dfdf'),(210,'Primary','acsdv','asdfvads'),(211,'Primary','afvf','asdfvf'),(212,'','',''),(213,'Middle/Higher Primary','asdvv','asdv'),(214,'Primary','dfgn','fgh'),(215,'Middle/Higher Primary','dfhgfsh','dghmdghq'),(216,'Primary','gyuj','uytf'),(217,'Primary','gyuj','uytf'),(218,'Primary','UTU','vjhh'),(219,'Higher Secondary','UTU','vkhjvjh'),(220,'Primary','asd','asdfsa'),(221,'Primary','asd','asdfsa'),(222,'Primary','daf','ADFG'),(223,'Primary','daf','ADFG'),(224,'Primary','daf','ADFG'),(225,'Primary','daf','ADFG'),(226,'Primary','daf','ADFG'),(227,'Primary','daf','ADFG'),(228,'Primary','daf','ADFG'),(229,'Primary','daf','ADFG'),(230,'Primary','daf','ADFG'),(231,'Primary','daf','ADFG'),(232,'Primary','daf','ADFG'),(233,'Primary','daf','ADFG'),(234,'Primary','daf','ADFG'),(235,'Primary','daf','ADFG'),(236,'Primary','daf','ADFG'),(237,'Primary','daf','ADFG'),(238,'Primary','daf','ADFG'),(239,'Primary','daf','ADFG'),(240,'Primary','daf','ADFG'),(241,'Graduate','Uka Tarsadiya','Maliba collage , Mahuva Road , Bardoli  '),(242,'Graduate','uka','asd');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `student` with 241 row(s)
--

--
-- Table structure for table `users`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` char(120) NOT NULL,
  `phone_number` bigint(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1- user 0- admin',
  `user_img_path` varchar(255) NOT NULL DEFAULT '../img/admin.ico',
  PRIMARY KEY (`email`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Admin',1234567891,'21bmiit129@gmail.com','$2y$10$omAf0m3yrxH/cFklDaeIj.fnVTQxAxV6cNjv3a0DM5MTRzawacrou',0,''),(24,'rohan Narigara',7894561239,'21bmiit137@gmail.com','$2y$10$AILqKVTy62bP8K3o7gRhUu0TsG3Vj2WQYPZ7Og1tQwcbqIdbIICmC',1,'202310309233kp (1).jpeg'),(22,'Aruna Pipaliya',9913402465,'abc@gmail.com','$2y$10$NGkvSEyyivA/9rCm/44lbes7NbKO46n096sOhaBCCLxNY6qI43Hma',1,''),(21,'Aruna Pipaliya',9099260609,'annu01@gmail.com','$2y$10$o5GcQMI/IGH92lF1Vhfu3Ok5OwpUyjDBj8VUHqF2f8UCl.susD.FK',1,''),(20,'Henvi kaklotar',9913402465,'henvi08@gmail.com','$2y$10$w9SrwUkHdwp9cH.Ej.wxKewj8zPzEAC1eesgXlBq.VxzdVBaGQjEe',1,'../img/admin.ico'),(18,'Kushal Pipaliya',9574476496,'kushalhpipaliya01@gmail.com','$2y$10$jZFytD5hUf7VDq4F8X9KfOWAb4IR0jla1UB4ZeFdjtLw9sjAbjkIW',1,'../uploads/kp (1).jpeg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 6 row(s)
--

--
-- Table structure for table `user_image`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_image`
--

LOCK TABLES `user_image` WRITE;
/*!40000 ALTER TABLE `user_image` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `user_image` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `user_image` with 0 row(s)
--

--
-- Table structure for table `user_type`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` char(150) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `user_type` with 0 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET AUTOCOMMIT=@OLD_AUTOCOMMIT */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Mon, 30 Oct 2023 15:04:55 +0100
