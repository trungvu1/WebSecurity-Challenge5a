





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





DROP TABLE IF EXISTS `do_exercise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `do_exercise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `exercise_id` int NOT NULL,
  `user` varchar(45) NOT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `file_result` varchar(500) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `createdtime` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_user_idx` (`user`),
  KEY `fk_status_idx` (`status`),
  KEY `fk_exercise_idx` (`exercise_id`),
  CONSTRAINT `fk_exercise` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`id`),
  CONSTRAINT `fk_status` FOREIGN KEY (`status`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;





LOCK TABLES `do_exercise` WRITE;
/*!40000 ALTER TABLE `do_exercise` DISABLE KEYS */;
INSERT INTO `do_exercise` VALUES (1,23,'student1',NULL,'cropper.jpg',NULL,'2021-01-03 08:53:26am'),(2,22,'student1',NULL,'prod-4.jpg',NULL,'2021-01-03 09:09:49am'),(3,24,'student1',NULL,'prod-1.jpg',NULL,'2021-01-03 09:10:29am'),(13,26,'student1','con voi',NULL,NULL,'2021-01-04 05:33:25am'),(16,26,'student3','con voi',NULL,NULL,'2021-01-04 08:03:49am'),(24,27,'student3','con huou cao co',NULL,NULL,'2021-01-04 08:39:59am'),(25,29,'student3','cai chan',NULL,NULL,'2021-01-04 08:45:19am');
/*!40000 ALTER TABLE `do_exercise` ENABLE KEYS */;
UNLOCK TABLES;





DROP TABLE IF EXISTS `exercise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `exercise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_created` varchar(45) NOT NULL,
  `type_id` int NOT NULL,
  `content` varchar(1000) NOT NULL,
  `file_name` varchar(500) DEFAULT 'N/A',
  `createdtime` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_user_created_idx` (`user_created`),
  KEY `fk_type_exercise_idx` (`type_id`),
  CONSTRAINT `fk_type_exercise` FOREIGN KEY (`type_id`) REFERENCES `type_exercise` (`id`),
  CONSTRAINT `fk_user_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;





LOCK TABLES `exercise` WRITE;
/*!40000 ALTER TABLE `exercise` DISABLE KEYS */;
INSERT INTO `exercise` VALUES (22,'trungvt',1,'bài tập sô 1','N/A','2021-01-02 06:55:13pm'),(23,'trungvt',1,'bài tập số 2','img.jpg','2021-01-02 06:55:31pm'),(24,'trungvt',1,'bài tập số 3','N/A','2021-01-02 06:57:00pm'),(25,'trungvt',1,'Bài tập số 5','paypal.png','2021-01-03 09:22:34am'),(26,'trungvt',2,'Challenge 01: Con gì có vòi','con voi.txt','2021-01-03 09:42:32am'),(27,'trungvt',2,'Challenge 02: Con gì cổ dài nhất thế giới','con huou cao co.txt','2021-01-03 09:43:36am'),(29,'trungvt',2,'Challenge 03: Cái gì lúc nằm thì đứng lúc đứng thì nằm','cai chan.txt','2021-01-04 07:56:22am');
/*!40000 ALTER TABLE `exercise` ENABLE KEYS */;
UNLOCK TABLES;





DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sent_user` varchar(45) NOT NULL,
  `recv_user` varchar(45) NOT NULL,
  `content` varchar(5000) DEFAULT NULL,
  `subject` varchar(200) NOT NULL,
  `createdtime` varchar(45) NOT NULL,
  `modifiedtime` varchar(45) NOT NULL,
  `enable` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_sent_user_idx` (`sent_user`),
  KEY `fk_recv_user_idx` (`recv_user`),
  CONSTRAINT `fk_recv_user` FOREIGN KEY (`recv_user`) REFERENCES `user` (`username`),
  CONSTRAINT `fk_sent_user` FOREIGN KEY (`sent_user`) REFERENCES `user` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;





LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'trungvt','student3','bẩn vcđ nuônnnnn aasyyyyy, làm cho sạch vàooooo\r\nMai kiểm tra','V/v xử lý chất thải','2020-12-27 04:24:28pm','2021-01-04 07:32:40am',1),(2,'trungvt','student3','bẩn vcđ nuônnnnn\r\n1\r\n2\r\n3\r\n4\r\n5\r\n6','V/v xử lý chất thải 2','2020-12-27 04:26:02pm','2020-12-27 04:26:02pm',0),(3,'trungvt','student3',NULL,'V/v upload webshell','2021-01-04 07:31:06am','2021-01-04 07:31:06am',1),(4,'student3','trungvt','V/v test định kỳ','V/v test định kỳ','2021-01-04 07:31:37am','2021-01-04 07:31:37am',1);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;





DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;





LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Student'),(2,'Teacher');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;





DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;





LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Open'),(2,'Done'),(3,'Can Not Handle');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;





DROP TABLE IF EXISTS `type_exercise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `type_exercise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idtype_exercise_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;





LOCK TABLES `type_exercise` WRITE;
/*!40000 ALTER TABLE `type_exercise` DISABLE KEYS */;
INSERT INTO `type_exercise` VALUES (1,'Homework'),(2,'Game');
/*!40000 ALTER TABLE `type_exercise` ENABLE KEYS */;
UNLOCK TABLES;





DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role_id` int NOT NULL,
  `fullname` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT 'N/A',
  `phonenumber` varchar(45) DEFAULT 'N/A',
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_role_id_idx` (`role_id`),
  CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;





LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('student1','123456a@A',1,'Student Ngoan','gmail@gmail.com','N/A'),('student2','123456a@A',1,'N/A','N/A','N/A'),('student3','123qweaA@',1,'Student Hư','N/A','N/A'),('student4','123qweaA@',1,'Son of The4','N/A','N/A'),('teacher1','123456a@A',2,'Nguyen Van B','b@gmail.com','0987654321'),('teacher2','123456a@A',2,'Nguyễn Thị Z','z@gmail.com','N/A'),('trungvt','123qweaA@',2,'Nguyen Van A','b@gmail.com','0123456789'),('tvgnurt','123qweaA@',1,'Trung Vũ','abc@yahoo.com','N/A');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;








/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


