-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: buspassms
-- ------------------------------------------------------
-- Server version 	10.4.28-MariaDB
-- Date: Thu, 12 Oct 2023 09:42:14 +0200

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `document` VALUES (1,3,'2023092976Screenshot 2023-09-13 194148.png'),(2,3,'202309298502Screenshot 2023-09-13 194148.png'),(3,3,'202309298657Screenshot 2023-09-13 194148.png'),(4,3,'202309291770Screenshot 2023-09-13 194148.png'),(5,4,'202309294584Screenshot 2023-09-13 194148.png'),(6,3,'202309305978Screenshot 2023-09-13 194148.png'),(7,6,'202309303415Screenshot 2023-09-13 194148.png'),(8,1,'202309308166Screenshot 2023-09-13 194148.png'),(9,9,'202309306405Screenshot 2023-09-13 194148.png'),(10,1,'202309305986Screenshot 2023-09-13 194148.png'),(11,1,'202309305951Screenshot 2023-09-13 194148.png'),(12,1,'202309303695Screenshot 2023-09-13 194148.png'),(13,1,'20230930753Screenshot 2023-09-13 194148.png'),(14,1,'202309305510fenil-removebg-preview.png'),(15,1,'202309303765fenil-removebg-preview.png'),(16,1,'202309306696fenil-removebg-preview.png'),(17,1,'202309303218fenil-removebg-preview.png'),(18,1,'202309302448fenil-removebg-preview.png'),(19,1,'202309308987Screenshot 2023-09-13 194148.png'),(20,1,'202309301151Screenshot 2023-09-13 194148.png'),(21,7,'202309307764Screenshot 2023-09-13 194148.png'),(22,2,'202309306287Screenshot 2023-09-13 194148.png'),(23,2,'202310014601Screenshot 2023-09-13 194148.png'),(24,2,'202310014220Screenshot 2023-09-13 194148.png'),(25,1,'202310037014Screenshot 2023-09-13 194148.png'),(26,1,'202310076318Screenshot 2023-10-06 191819.png'),(27,1,'202310128647Screenshot 2023-10-06 191819.png'),(28,1,'20231012881Screenshot 2023-10-06 191819.png'),(29,3,'202310125802Screenshot 2023-10-06 191819.png'),(30,2,'202310121351Screenshot 2023-10-06 191819.png'),(31,1,'202310121616Screenshot 2023-10-06 191819.png'),(32,1,'202310129139Screenshot 2023-10-06 191819.png'),(33,1,'202310123893Screenshot 2023-10-06 191819.png'),(34,1,'202310128671Screenshot 2023-10-06 191819.png'),(35,1,'202310121641Screenshot 2023-10-06 191819.png'),(36,1,'202310122785Screenshot 2023-10-06 191819.png');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `document` with 36 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pass`
--

LOCK TABLES `pass` WRITE;
/*!40000 ALTER TABLE `pass` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `pass` VALUES (1,24,18,1,1,2,'pay_MnC0ZUapPioHam',1,NULL,NULL),(2,26,18,1,1,2,'pay_MnCiN9lHU0DDtn',1,'0000-00-00','0000-00-00'),(3,27,18,1,1,2,'pay_MnCu5YxFtLADVG',1,'2023-10-12','2023-11-11'),(4,28,18,1,1,2,'pay_MnCyvBkOkBsXXa',1,'2023-10-12','2023-11-11'),(5,29,18,1,1,2,'pay_MnD9aEUW4T6w6e',1,'2023-10-12','2023-11-11'),(6,30,18,1,1,2,'pay_MnDGMB2WSAxXvp',1,'2023-10-12','2023-11-11'),(7,31,18,1,1,2,'pay_MnDMjKVA32JPWl',1,'2023-10-12','2023-11-11'),(8,32,18,1,1,2,'pay_MnDQpNCIfFlJGL',1,'2023-10-12','2023-11-11');
/*!40000 ALTER TABLE `pass` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `pass` with 8 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passenger_info`
--

LOCK TABLES `passenger_info` WRITE;
/*!40000 ALTER TABLE `passenger_info` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `passenger_info` VALUES (1,'Kushal Pipaliya','vvvv',5,'M',0,5,18,'2024-03-29','2004-08-12','202309293691fenil.jpg'),(2,'Kushal Pipaliya','xgfbv',6,'M',0,6,18,'2024-03-30','2004-08-12','202309301268fenil.jpg'),(3,'Kushal Pipaliya','sbv',7,'M',0,7,18,'2024-03-30','2004-08-12','202309308428fenil.jpg'),(4,'df','snfg',8,'M',0,8,18,'2024-03-30','2004-08-12','202309305907fenil.jpg'),(5,'Kushal Pipaliya','ccxcxc',9,'M',0,9,18,'2024-03-30','2004-08-12','202309301837fenil.jpg'),(6,'Kushal Pipaliya','54 hari hari soc 2',10,'M',0,10,18,'2024-03-30','2004-08-12','202309304660fenil.jpg'),(7,'Kushal Pipaliya','ddddd',11,'M',0,12,18,'2024-03-30','2000-07-12','202309305610fenil.jpg'),(8,'Kushal Pipaliya','ddddd',12,'M',0,13,18,'2024-03-30','2000-07-12','202309306025fenil.jpg'),(9,'Kushal Pipaliya','ABC',13,'M',0,14,18,'2024-03-30','2004-08-12','202309307066fenil.jpg'),(10,'Kushal Pipaliya','ffrfffr',14,'M',0,15,18,'2024-03-30','1222-08-12','202309308861fenil.jpg'),(11,'Kushal Pipaliya','ffrfffr',15,'M',0,16,18,'2024-03-30','1222-08-12','202309302757fenil.jpg'),(12,'Kushal Pipaliya','ffrfffr',16,'M',0,17,18,'2024-03-30','1222-08-12','202309307790fenil.jpg'),(13,'Kushal Pipaliya','ffrfffr',17,'M',0,18,18,'2024-03-30','1222-08-12','202309301181fenil.jpg'),(14,'Kushal Pipaliya','ffrfffr',18,'M',0,19,18,'2024-03-30','1222-08-12','202309304410fenil.jpg'),(15,'Kushal Pipaliya','xxxxxx',19,'M',0,21,18,'2024-03-30','2004-08-12','202309307095fenil.jpg'),(16,'Kushal Pipaliya','xxxxxx',20,'M',0,22,18,'2024-03-30','2004-08-12','202309305092fenil.jpg'),(17,'Kushal Pipaliya','cccccc',21,'M',0,23,18,'2024-03-30','2004-08-12','202309308760fenil.jpg'),(18,'Kushal Pipaliya','Klkjasdlkjnasdvksdjn',22,'M',0,24,18,'2024-03-30','2004-08-12','202309308067fenil.jpg'),(19,'xZ','adsfsdf',23,'M',0,25,18,'2024-04-01','2004-08-12','202310012941fenil.jpg'),(20,'Dcsfadsfa','asdfsadff',24,'M',0,26,18,'2024-04-01','2004-08-12','202310015535fenil.jpg'),(21,'Kushal Pipaliya','Hari Hari Soc-2 ',25,'M',0,27,18,'2024-04-03','2004-08-12','202310035900fenil.jpg'),(22,'Kushal Pipaliya','54 b ',26,'Male',0,29,18,'2024-04-07','2004-08-12','202310079296kp (1).jpeg'),(23,'Kushal Pipaliya','BBBB',27,'Male',0,30,18,'2024-04-12','2004-08-12','20231012121kp (1).jpeg'),(24,'Kushal Pipaliya','BBBB',28,'Male',0,31,18,'2024-04-12','2004-08-12','202310129657kp (1).jpeg'),(25,'Kushal Pipaliya','ABCC',29,'Male',0,35,18,'2024-04-12','2004-08-12','202310129110kp (1).jpeg'),(26,'Kushal Pipaliya','ASS',30,'Male',0,37,18,'2024-04-12','2004-08-12','202310124075kp (1).jpeg'),(27,'JK','kk',31,'Male',0,39,18,'2024-04-12','2004-08-12','202310123700kp (1).jpeg'),(28,'Kushal Pipaliya','ss',32,'Male',0,41,18,'2024-04-12','2004-09-12','202310128095kp (1).jpeg'),(29,'Kushal Pipaliya','KKK',33,'Male',0,43,18,'2024-04-12','2004-08-12','202310128717kp (1).jpeg'),(30,'Kushal Pipaliya','lop',34,'Male',0,45,18,'2024-04-12','2004-08-12','202310129275kp (1).jpeg'),(31,'Kushal Pipaliya','LLLLLLLLLLLLLLLNJSJNSJNJSJNJNCJ',35,'Male',0,47,18,'2024-04-12','2004-08-12','202310125174kp (1).jpeg'),(32,'Kushal Pipaliya','KKK',36,'Male',0,49,18,'2024-04-12','2004-08-12','202310128059kp (1).jpeg');
/*!40000 ALTER TABLE `passenger_info` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `passenger_info` with 32 row(s)
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
INSERT INTO `report` VALUES (52,'NaNCH','KJADKJ @GMAILC.COM','KJASDSKJBASKLJLBASFKJBASKLJKASDFAJKASD'),(53,'Kushal Pipaliya','21bmiit134@gmail.com','kskdjdaskdhjfkbs'),(54,'Kushal','kushalhpipaliya@gmail.com','asd'),(55,'Kushal H Pipalioya','21bmiit129@gmail.com','CNNSS'),(58,'Kushal Pipaliya','21bmiit129@gmail.com','adfgafgsaaga');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `report` with 5 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `student` VALUES (2,'3','asda','asd'),(3,'1','ffffgggggg','gggg'),(4,'','',''),(5,'1','ffffft','ttttt'),(6,'2','xhx','dfghgh'),(7,'1','sgfsdfh','sdfg'),(8,'3','dgbbgb','sfgbgfbsgfdb'),(9,'2','ffffff','gggggg'),(10,'2','UTU','Bardoili'),(11,'','',''),(12,'Middle/Higher Primary','ddddd','dddddd'),(13,'Middle/Higher Primary','ddddd','dddddd'),(14,'Senior Secondary','UTU','Bardoli'),(15,'Primary','UTU','drfffrfr'),(16,'Primary','UTU','drfffrfr'),(17,'Primary','UTU','drfffrfr'),(18,'Primary','UTU','drfffrfr'),(19,'Primary','UTU','drfffrfr'),(20,'','',''),(21,'Middle/Higher Primary','kkxkxkxx','kkjjjfj'),(22,'Middle/Higher Primary','kkxkxkxx','kkjjjfj'),(23,'Primary','dddd','dddd'),(24,'Middle/Higher Primary','asdf','asdfasdf'),(25,'Middle/Higher Primary','as','vadf'),(26,'Middle/Higher Primary','asdfafafsaasdfdsa','asdfsfds'),(27,'Graduate','Uka ','Bardoli'),(28,'','',''),(29,'Graduate','utu','bardoli'),(30,'Senior Secondary','UTU','asdaf'),(31,'Senior Secondary','UTU','asdaf'),(32,'','',''),(33,'','',''),(34,'','',''),(35,'Primary','utu','caa'),(36,'','',''),(37,'Primary','asfj','aejf'),(38,'','',''),(39,'Middle/Higher Primary','KK','sd'),(40,'','',''),(41,'Middle/Higher Primary','LL','ddd'),(42,'','',''),(43,'Middle/Higher Primary','JJJFJDJ','ndfndfnfn'),(44,'','',''),(45,'Primary','UTU','lll'),(46,'','',''),(47,'Middle/Higher Primary','UKA','hhhhhhh'),(48,'','',''),(49,'Primary','OOOO','dsddsd'),(50,'','','');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `student` with 49 row(s)
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
  PRIMARY KEY (`email`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Admin',1234567891,'21bmiit129@gmail.com','$2y$10$omAf0m3yrxH/cFklDaeIj.fnVTQxAxV6cNjv3a0DM5MTRzawacrou',0),(19,'Nancy Monpara',7990589392,'21bmiit134@gmail.com','$2y$10$lvqiA0yhDX664OxVdFNGKOkPZ1BQM1fmPZ4/s9brFLYyMusPjwRFW',1),(20,'Henvi kaklotar',9913402465,'henvi08@gmail.com','$2y$10$w9SrwUkHdwp9cH.Ej.wxKewj8zPzEAC1eesgXlBq.VxzdVBaGQjEe',1),(18,'Kushal Pipaliya',9574476496,'kushalhpipaliya01@gmail.com','$2y$10$3Tcnl8tCbgk57TSl25gqhO.eB6XyhM6W6BQf6F2GchMIWHK/ksb1m',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 4 row(s)
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

-- Dump completed on: Thu, 12 Oct 2023 09:42:14 +0200
