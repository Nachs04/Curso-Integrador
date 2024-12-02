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
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(30) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `Estado` int DEFAULT NULL,
  `Stock` varchar(45) DEFAULT NULL,
  `cod_control_producto` int DEFAULT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_cod_control_producto_idx` (`cod_control_producto`),
  CONSTRAINT `fk_cod_control_producto` FOREIGN KEY (`cod_control_producto`) REFERENCES `control` (`cod_control_producto`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Torta de Chocolate',10,1,'80',2020,'../recursos/imagenes/choco.webp'),(2,'	Torta de Tres leches',12,1,'35',2021,'../recursos/imagenes/leche.webp'),(3,'	Soufflé de fresas',8,1,'40',2022,'../recursos/imagenes/fresa.png'),(4,'	Torta de selva negra',15,1,'15',2023,'../recursos/imagenes/selva.webp'),(5,'	Chocolate Lover 02',10,1,'50',2024,'../recursos/imagenes/chocolate.jpg'),(6,'	Strawberry Antoinette 02',5,1,'60',2025,'../recursos/imagenes/02.jpg'),(7,'	Strawberry Antoinette 04',18,1,'20',2026,'../recursos/imagenes/04.jpg'),(8,'Mariposa Junior Rosa',14,1,'12',2027,'../recursos/imagenes/rosa.jpg'),(9,'Rosetas',7,1,'35',2028,'../recursos/imagenes/rosetas.jpg'),(10,'	Stand de macarons-Arcoiris',11,1,'22',2029,'../recursos/imagenes/maca.jpg'),(11,'	Strawberry Antoinette',9,1,'28',2030,'../recursos/imagenes/Dulcefina-13.jpg'),(12,'	Torta de Ajedrez',6,1,'40',2031,'../recursos/imagenes/tortaajedrez-324x324.jpg');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-02 11:11:06
