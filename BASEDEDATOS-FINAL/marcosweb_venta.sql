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
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta` (
  `id_venta` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(255) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (1,'Torta de chocolate',1,10.00,10.00,'2024-12-01'),(72,'Rosetas',1,10.00,10.00,'2024-12-02'),(73,'Rosetas',1,20.00,20.00,'2024-12-02'),(74,'Torta de Tres leches',1,14.00,14.00,'2024-12-02'),(75,'Torta de selva negra',1,12.00,12.00,'2024-12-02'),(76,'Soufflé de fresas',2,17.00,34.00,'2024-12-02'),(77,'Torta de chocolate',1,26.00,26.00,'2024-12-02'),(78,'Soufflé de fresas',2,17.00,34.00,'2024-12-02'),(79,'Mariposa Junior Rosa',1,12.00,12.00,'2024-12-02'),(80,'Strawberry Antoinette 04',1,10.00,10.00,'2024-12-02'),(81,'Soufflé de fresas',1,17.00,17.00,'2024-12-02'),(82,'Torta de Tres leches',1,14.00,14.00,'2024-12-02'),(83,'Torta de Tres leches',4,14.00,56.00,'2024-12-02'),(84,'Stand de macarons-Arcoiris',1,18.00,18.00,'2024-12-02'),(85,'Rosetas',2,25.00,50.00,'2024-12-02'),(86,'Stand de macarons-Arcoiris',1,18.00,18.00,'2024-12-02'),(87,'Soufflé de fresas',1,17.00,17.00,'2024-12-02'),(88,'Torta de Tres leches',1,14.00,14.00,'2024-12-02'),(89,'Strawberry Antoinette 02',1,16.00,16.00,'2024-12-02'),(90,'Torta de chocolate',2,26.00,52.00,'2024-12-02'),(91,'Torta de Tres leches',1,14.00,14.00,'2024-12-02'),(92,'Torta de selva negra',3,12.00,36.00,'2024-12-02'),(93,'Torta de chocolate',2,26.00,52.00,'2024-12-02'),(94,'Torta de chocolate',2,26.00,52.00,'2024-12-02'),(95,'Soufflé de fresas',2,17.00,34.00,'2024-12-02'),(96,'Torta de chocolate',2,26.00,52.00,'2024-12-02'),(97,'Torta de chocolate',5,26.00,130.00,'2024-12-02'),(98,'Torta de Ajedrez',2,15.00,30.00,'2024-12-02'),(99,'Torta de chocolate',5,26.00,130.00,'2024-12-02'),(100,'Torta de chocolate',10,26.00,260.00,'2024-12-02'),(101,'Torta de chocolate',10,26.00,260.00,'2024-12-02'),(102,'Torta de Tres leches',5,14.00,70.00,'2024-12-02'),(103,'Torta de Ajedrez',1,15.00,15.00,'2024-12-02'),(104,'Torta de Ajedrez',4,15.00,60.00,'2024-12-02'),(105,'Rosetas',2,25.00,50.00,'2024-12-02'),(106,'Chocolate Lover 02',2,26.00,52.00,'2024-12-02'),(107,'Chocolate Lover 02',4,26.00,104.00,'2024-12-02'),(108,'Torta de Ajedrez',1,15.00,15.00,'2024-12-02'),(109,'Torta de Ajedrez',1,15.00,15.00,'2024-12-02'),(110,'Torta de Ajedrez',2,15.00,30.00,'2024-12-02'),(111,'Torta de Ajedrez',2,15.00,30.00,'2024-12-02'),(112,'Rosetas',11,25.00,275.00,'2024-12-02'),(113,'Strawberry Antoinette',2,10.00,20.00,'2024-12-02'),(114,'Torta de Ajedrez',2,15.00,30.00,'2024-12-02'),(115,'Rosetas',1,25.00,25.00,'2024-12-02'),(116,'Torta de selva negra',4,12.00,48.00,'2024-12-02');
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
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
