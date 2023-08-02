-- MySQL dump 10.13  Distrib 8.0.33, for Linux (aarch64)
--
-- Host: localhost    Database: db_raccoon
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `author_id` int NOT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (4,12,9,'kknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1','2023-07-05 10:51:54'),(5,12,9,'kknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1','2023-07-05 10:51:56'),(6,12,9,'kknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1','2023-07-05 10:52:01'),(7,12,9,'kknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1','2023-07-05 10:52:02'),(8,12,9,'kknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1','2023-07-05 10:52:03'),(18,12,9,'new','2023-07-06 15:43:43'),(19,12,9,'new','2023-07-06 15:44:00'),(20,12,9,'new2\r\n','2023-07-06 15:46:48'),(21,12,9,'dd','2023-07-06 15:55:25'),(36,12,7,'helloworld','2023-07-06 17:34:47'),(39,25,9,'dda','2023-07-19 02:44:59');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_drive`
--

DROP TABLE IF EXISTS `file_drive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `file_drive` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_drive`
--

LOCK TABLES `file_drive` WRITE;
/*!40000 ALTER TABLE `file_drive` DISABLE KEYS */;
INSERT INTO `file_drive` VALUES (1,'Screenshot 2023-07-16 at 12.32.03.png','20230716063809_Screenshot 2023-07-16 at 12.32.03.png'),(2,'Screenshot 2023-07-16 at 12.32.03_2.png','20230716064828_Screenshot 2023-07-16 at 12.32.03.png'),(3,'Screenshot 2023-07-16 at 12.32.03_3.png','20230716065005_Screenshot 2023-07-16 at 12.32.03.png'),(4,'1433827_1654187066260403.jpg','20230718054458_1433827_1654187066260403.jpg');
/*!40000 ALTER TABLE `file_drive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author_id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `views` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (9,'hello world!',7,'helle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\nhelle world!!\r\n','2023-06-30 04:44:43','2023-07-05 11:00:14',5),(12,'kknock no1',9,'kknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no1\r\nkknock no111\r\n','2023-06-30 04:49:16','2023-07-16 05:58:05',351),(14,'test',10,'test\r\ntesttesttest\r\ntesttesttest\r\ntest\r\ntest\r\ntest\r\n','2023-06-30 04:50:12','2023-06-30 06:31:24',3),(15,'test',10,'test','2023-06-30 05:16:25','2023-07-16 05:32:11',5),(16,'131',9,'131','2023-06-30 05:19:22','2023-07-05 12:50:27',7),(17,'t',7,'t','2023-06-30 05:26:34','2023-07-05 07:44:46',4),(19,'fsdkdsfkjdlf',9,'dslfkjdslkfjsdlfkjsdlsdlkj','2023-07-03 15:33:12','2023-08-02 04:26:33',64),(21,'fsdkdsfkjdlf',9,'edited222','2023-07-04 13:55:17','2023-07-06 17:34:35',289),(24,'kknock a',9,'d','2023-07-06 17:05:04','2023-07-06 17:32:44',13),(25,'kknock b',9,'aa','2023-07-06 17:05:12','2023-07-19 02:45:04',7);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'test3','$2y$10$eksLgDEvD5aaZgkFOTRqje03YkgKxIzUwiQP5JKfOLnx..6FvzdzG','2023-06-25 17:02:32'),(7,'test4','$2y$10$mdxIEih0LktszrMfO3xaQ.6Glki2rgwMJBGFOmUFDpqkSiQPOOmGy','2023-06-26 05:26:09'),(8,'abc','$2y$10$InWg4vxavVuDt8n1C0uO8e9hFQ8z9O8MPX/t1iI6kNOqU0DSBqKPG','2023-06-26 13:37:45'),(9,'admin','$2y$10$O.r7YcIaQEsKssTq5DWUdeYSY.iPne6omStOJygIhYYyecMj6GDA2','2023-06-29 16:38:29'),(10,'test5','$2y$10$KqTE0V9M3qtg3rjlvjyP8etOYuhzqmYP3RDBxK3uZgo0LYKG3tKdm','2023-06-29 16:38:47'),(11,'test6','$2y$10$KW1x3fZPkma2QsXA/7uagujfLuLwicUSs2aQNCGJoOcy8AhkvShQa','2023-06-29 16:38:59'),(12,'dy','$2y$10$rZ3ypuOFLBWecNeoosFeCeeoyAH6J8s/q6Qh0ZQ6RmaSN0MB9eRfe','2023-07-03 07:23:37');
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

-- Dump completed on 2023-08-02  7:51:04
