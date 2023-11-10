-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: buspassms
-- ------------------------------------------------------
-- Server version 	10.4.28-MariaDB
-- Date: Fri, 10 Nov 2023 17:31:33 +0100

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
INSERT INTO `bus_terminals` VALUES (1,'Surat','21.1702','72.8311'),(2,'Bardoli','21.1230','73.1169'),(3,'Ahmedabad','23.0225','72.5714'),(4,'Vadodara',' 22.3072','73.1812'),(5,'Rajkot','22.3039','70.8022'),(6,'Gandhinagar','23.2156','72.6369'),(7,'Bhavnagar','21.7645','72.1519'),(8,'Jamnagar','22.4707','70.0577'),(9,'Junagadh','21.5222','70.4579'),(10,'Anand','22.5524','72.9550'),(11,'Bharuch','21.7051','72.9959'),(12,'Nadiad','22.6975','72.8616'),(13,'Mehsana','23.5865','72.3693'),(14,'Gandhidham','23.0787','70.1328'),(15,'Porbandar','21.6415','69.6293'),(16,'Navsari','20.9467','72.9306'),(17,'Veraval','20.9142','70.3679'),(18,'Ankleshwar','21.6279','72.9932'),(19,'Morbi','22.8170','70.8342'),(20,'Surendranagar','22.7253','71.6370'),(22,'Godhra','22.8311','73.6147'),(23,'Palanpur','24.1848','72.8328'),(24,'Valsad','20.5994','72.9342'),(25,'Bhuj','23.2533','69.6693'),(26,'Vapi','20.3718','72.9045'),(27,'Amreli','21.6032','71.2221'),(28,'Himatnagar','23.5990','72.9623'),(29,'Dahod','22.8362','74.2579'),(30,'Botad','22.1713','71.6662'),(31,'Keshod','21.3069','70.2462'),(32,'Visnagar','23.7059','72.5499'),(33,'Mangrol','21.1143','70.1167'),(34,'Wadhwan','22.7454','71.7273'),(35,'Modasa','23.4664','73.2986'),(36,'Jetpur','21.7539','70.6234'),(37,'Dhoraji','21.7383','70.4520'),(38,'Kalol','23.2547','72.4994'),(39,'Dholka','22.7297','72.6561'),(40,'Dhandhuka','22.3744','71.9826'),(41,'Kadi','23.2972','72.3306'),(42,'Thangadh','22.5641','71.1870'),(43,'Unjha','23.8014','72.3900'),(44,'Siddhpur','23.9176','72.3831'),(45,'Mansa','23.2361','72.6624'),(46,'Limbdi','22.5732','71.8064'),(47,'Borsad','22.4162','73.1092'),(48,'Halvad','23.0181','71.1770'),(49,'Rajula','21.0345','71.4557'),(50,'Mahuva','21.1070','71.7705'),(51,'Kutch','23.6333','69.8333'),(52,'Palitana','21.5173','71.8235'),(53,'Kapadvanj','23.0217','73.1229'),(54,'Lunawada','23.1264','73.6111'),(55,'Viramgam','23.1240','73.1336'),(56,'Visavadar','21.3645','70.1471'),(57,'Wankaner','22.6110','70.9375'),(58,'Padra','22.2978','73.1785'),(59,'Dabhoi','22.1761','73.4227'),(60,'Bhujodi','23.2825','69.7189'),(61,'Porbandar','21.6439','69.6080'),(62,'Gandhidham','23.0863','70.1311'),(63,'Dwarka','22.2394','68.9678'),(64,'Palitana','21.5202','71.8310'),(65,'Morbi','22.8122','70.8393'),(66,'Bhuj','23.2625','69.6648'),(67,'Anjar','23.1100','70.1170'),(68,'Buhari','20.967659','73.3069363');
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
-- Table structure for table `document`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_type_id` int(11) NOT NULL,
  `document_file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `document` VALUES (321,1,'202311098884Screenshot 2023-10-06 191819.png'),(323,2,'202311098089Screenshot 2023-10-06 191819.png'),(324,2,'202311093591Screenshot 2023-10-06 191819.png'),(325,2,'202311094246Screenshot 2023-10-06 191819.png');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `document` with 4 row(s)
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
-- Table structure for table `otps`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `otps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `otp` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otps`
--

LOCK TABLES `otps` WRITE;
/*!40000 ALTER TABLE `otps` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `otps` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `otps` with 0 row(s)
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
  `passType` int(11) NOT NULL,
  `bus_type` int(11) NOT NULL,
  `start_term_id` int(11) NOT NULL,
  `ends_term_id` int(11) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `image_id` int(11) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `is_verify` tinyint(4) NOT NULL COMMENT '0 - panding \r\n1 - apruv\r\n2 - rejection',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=288 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pass`
--

LOCK TABLES `pass` WRITE;
/*!40000 ALTER TABLE `pass` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `pass` VALUES (283,316,18,30,1,1,2,'pay_MyOzhN6yLuNxxb',1,'2023-11-09','2023-12-09',0),(284,317,18,90,1,4,10,'pay_MyPrpCkSqe3QYi',1,'2023-11-09','2024-02-07',1),(285,318,18,90,1,4,10,'pay_MyPrpCkSqe3QYi',1,'2023-11-09','2024-02-07',0),(286,319,18,90,1,4,10,'pay_MyPrpCkSqe3QYi',1,'2023-11-09','2024-02-07',0),(287,320,18,90,1,4,10,'pay_MyPrpCkSqe3QYi',1,'2023-11-09','2024-02-07',0);
/*!40000 ALTER TABLE `pass` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `pass` with 5 row(s)
--

--
-- Table structure for table `passenger`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passenger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `educationp` varchar(100) NOT NULL,
  `com_name` varchar(200) NOT NULL,
  `com_address` varchar(200) NOT NULL,
  `pass_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
  `role` varchar(15) NOT NULL COMMENT 'Role which define the actual role (passenger , student )',
  `r_id` int(11) NOT NULL COMMENT 'Role_id which defines the users id ex (student id , pasanger_id)',
  `user_id` int(11) NOT NULL,
  `validate_through` date NOT NULL,
  `dob` date NOT NULL,
  `user_img_path` varchar(255) NOT NULL DEFAULT 'admin.ico',
  PRIMARY KEY (`id`),
  KEY `user_id_foreign` (`user_id`),
  KEY `document_id_foregin` (`document_id`),
  CONSTRAINT `document_id_foregin` FOREIGN KEY (`document_id`) REFERENCES `document` (`id`),
  CONSTRAINT `user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passenger_info`
--

LOCK TABLES `passenger_info` WRITE;
/*!40000 ALTER TABLE `passenger_info` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `passenger_info` VALUES (317,'Kushal Pipaliya','Hari Hari 2',323,'Male','Student',304,18,'2024-05-09','2001-02-01','202311097656kp (1).jpeg');
/*!40000 ALTER TABLE `passenger_info` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `passenger_info` with 1 row(s)
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
INSERT INTO `price` VALUES (1,15);
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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `report` VALUES (62,'Kushal H Pipalioya','Kushalhpipaliya01@gmail.com','Hello');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `report` with 1 row(s)
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
  `pass_id` int(11) DEFAULT NULL,
  `bono_pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `student` VALUES (303,'Higher Secondary','Uka','Bardoli ',283,'20231109784bono.jpg'),(304,'Middle/Higher Primary','OOpp','KKPP',284,'202311099273bono.jpg'),(305,'Middle/Higher Primary','OOpp','KKPP',285,'202311098157bono.jpg'),(306,'Middle/Higher Primary','OOpp','KKPP',286,'202311091438bono.jpg'),(307,'Middle/Higher Primary','OOpp','KKPP',287,'202311098357bono.jpg');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `student` with 5 row(s)
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
  `user_img_path` varchar(255) NOT NULL DEFAULT 'admin.ico',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `users` VALUES (1,'Admin',1234567891,'21bmiit129@gmail.com','$2y$10$omAf0m3yrxH/cFklDaeIj.fnVTQxAxV6cNjv3a0DM5MTRzawacrou',0,'../img/admin.ico'),(18,'Kushal Pipaliya',9574476496,'kushalhpipaliya01@gmail.com','$2y$10$pv557YKfAOdPebNSwfWFCu5UcSW9gJfDESXPrz1fcxm5bWh/eWZi.',1,'202311092681kp (1).jpeg'),(20,'Henvi kaklotar',9913402465,'henvi08@gmail.com','$2y$10$w9SrwUkHdwp9cH.Ej.wxKewj8zPzEAC1eesgXlBq.VxzdVBaGQjEe',1,'202311067015kp (1).jpeg'),(21,'Aruna Pipaliya',9099260609,'annu01@gmail.com','$2y$10$o5GcQMI/IGH92lF1Vhfu3Ok5OwpUyjDBj8VUHqF2f8UCl.susD.FK',1,'admin.ico'),(24,'rohan Narigara',7894561239,'21bmiit137@gmail.com','$2y$10$AILqKVTy62bP8K3o7gRhUu0TsG3Vj2WQYPZ7Og1tQwcbqIdbIICmC',1,'admin.ico'),(25,'Jaimin Ghoghari',9537006635,'jaiminghoghari12345@gmail.com','$2y$10$ODj7QzpCTzzmVBnnrZpm3O8CK3TuHfDc9WCN0gYgHsQtsEKrx4bbK',1,'202311063317kp (1).jpeg'),(28,'Vency Italiya',8866005608,'21bmiit136@gmail.com','$2y$10$bgAdmC1FGe1erGsmFLgbk.zvjAoBx2nXV8YVGKBnxKPuaPDXzFlHG',1,'20231107103kp (1).jpeg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `users` with 7 row(s)
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

-- Dump completed on: Fri, 10 Nov 2023 17:31:33 +0100
