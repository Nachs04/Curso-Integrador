-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: marcosweb
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `correo` varchar(30) NOT NULL,
  `nombre_cli` varchar(30) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  PRIMARY KEY (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES ('Jordan@hotmcil.com','Jordan','5415','2024-11-10',NULL,NULL),('jose@gmail.com','Jose','sadc','2024-11-10',NULL,NULL),('my@gmail.com','Mylene','bla','2027-10-24',NULL,NULL),('mylene@gmail.com','Myelene','2805','2024-11-10',NULL,NULL),('nicolas@gmail.com','Nicolas','1608','2024-10-28','053726075447a3dcfd3b96ad515e343adcb4b0a4d390accd12085a354f953f11e5caab70e364dd15fcb72c0cd4f664b925d0','2024-11-28 04:37:42'),('pozo@gmial.com','pozo','1234','2024-11-10',NULL,NULL),('prueba1@gmail.com','prueba1','1234','2024-11-10',NULL,NULL),('romina@gmail.com','Romi','16541','2024-11-10',NULL,NULL),('vale@gmail.com','valeria','654321','2024-11-10',NULL,NULL),('vali@gmail.com','valeria','65','2024-11-10',NULL,NULL),('victor@hotmail.com','Victor','$2y$10$iXVJvC3gvnZ6uxyNuOYSV.oazD/iYVZHQpgubgL3tkZvU5FnRoWky','2024-11-10',NULL,NULL),('victoria@hotmail.com','Victoria','$2y$10$HEt9OwjkzD9ivSeRuKEl3ec4fMbMPCtbAKfDQjRdKwp.Xfw.dUCge','2024-11-10',NULL,NULL),('yaelgabriel2019@gmail.com','yael','$2y$10$oxENCiGPt3hx7qRfjsJ33eWrqTBweABO.dpoGxCzHQEdozz8qwP12','2024-11-28','e10d74d96b6434ee802bb6c950af344b','2024-11-28 21:23:10'),('yagorc2024@gmail.com','yagu','$2y$10$rRWeFA.r12z3IYmsYVlHduA09rjpcdNg5rrhWd0P7HUhLdQPytY6a','2024-11-28','e88d458cade76fd2903e0ea6fb22aca80f30d9a571c8baf238f6f1f18075ad8974aa91dbf3258046cc8baf9c03b0602d2ba6','2024-11-28 06:15:44'),('Yarid@gmail.com','Yarid','1010','2024-11-10',NULL,NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02 11:11:07
