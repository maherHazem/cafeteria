-- MySQL dump 10.13  Distrib 8.0.41, for Linux (x86_64)
--
-- Host: localhost    Database: cafeteria
-- ------------------------------------------------------
-- Server version	8.0.41-0ubuntu0.24.04.1

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
-- Current Database: `cafeteria`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cafeteria` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `cafeteria`;

--
-- Table structure for table `t_clases`
--

DROP TABLE IF EXISTS `t_clases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_clases` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_clases`
--

LOCK TABLES `t_clases` WRITE;
/*!40000 ALTER TABLE `t_clases` DISABLE KEYS */;
INSERT INTO `t_clases` VALUES (1,'Bebida'),(2,'Comida');
/*!40000 ALTER TABLE `t_clases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_comanda`
--

DROP TABLE IF EXISTS `t_comanda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_comanda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_mesa` int NOT NULL,
  `id_camarero` int NOT NULL,
  `fecha_pedido` datetime DEFAULT CURRENT_TIMESTAMP,
  `pedido` int NOT NULL,
  `detalles_pedido` varchar(255) DEFAULT NULL,
  `barra` tinyint(1) DEFAULT '0',
  `cocina` tinyint(1) DEFAULT '0',
  `servido` tinyint(1) DEFAULT '0',
  `cancelado` tinyint(1) DEFAULT '0',
  `pagado` tinyint(1) DEFAULT '0',
  `deshabilitado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_mesa` (`id_mesa`),
  KEY `id_camarero` (`id_camarero`),
  KEY `pedido` (`pedido`),
  CONSTRAINT `t_comanda_ibfk_1` FOREIGN KEY (`id_mesa`) REFERENCES `t_mesas` (`id`),
  CONSTRAINT `t_comanda_ibfk_2` FOREIGN KEY (`id_camarero`) REFERENCES `t_usuarios` (`id`),
  CONSTRAINT `t_comanda_ibfk_3` FOREIGN KEY (`pedido`) REFERENCES `t_productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_comanda`
--

LOCK TABLES `t_comanda` WRITE;
/*!40000 ALTER TABLE `t_comanda` DISABLE KEYS */;
INSERT INTO `t_comanda` VALUES (1,2,1,'2025-02-18 10:01:00',17,NULL,0,1,0,1,0,1),(2,2,1,'2025-02-18 10:07:58',30,'hola que ase',0,1,0,0,1,1),(3,2,1,'2025-02-18 10:08:06',17,'',1,0,0,0,1,1),(4,6,1,'2025-02-18 10:11:13',1,'',1,0,0,0,1,1),(5,3,1,'2025-02-20 09:14:05',17,'',1,0,0,0,1,1),(6,3,1,'2025-02-20 09:48:09',9,'',1,0,0,0,1,1),(7,3,1,'2025-02-20 09:48:18',26,'',1,0,0,0,1,1),(8,3,1,'2025-02-20 11:42:51',17,'',1,0,0,0,1,1),(9,3,1,'2025-02-20 11:42:57',26,'',1,0,0,0,1,1),(10,1,1,'2025-02-20 11:51:10',1,'',1,0,0,0,1,1),(11,1,1,'2025-02-20 11:51:49',1,'',1,0,0,1,0,1),(12,1,1,'2025-02-20 12:00:19',1,'',1,0,0,0,1,1),(13,3,1,'2025-02-20 12:14:44',17,'',1,0,0,0,1,1),(14,6,1,'2025-02-20 12:18:55',17,'',1,0,0,0,1,1),(15,2,1,'2025-02-20 12:43:27',17,'',1,0,0,1,0,1),(16,2,1,'2025-02-20 12:55:52',17,'',1,0,0,0,1,1),(17,2,1,'2025-02-20 12:55:57',39,'',1,0,0,0,1,1),(18,3,1,'2025-02-20 13:05:25',17,'',1,0,0,0,1,1),(19,3,1,'2025-02-20 13:05:29',29,'',1,0,0,0,1,1),(20,8,9,'2025-02-20 13:10:04',17,'',1,0,0,0,1,1),(21,4,9,'2025-02-20 13:10:08',29,'',1,0,0,0,1,1),(22,4,9,'2025-02-20 13:10:13',1,'',1,0,0,0,1,1),(23,4,9,'2025-02-20 13:10:18',6,'',1,0,0,0,1,1),(24,3,1,'2025-02-20 13:12:52',9,'',1,0,0,0,1,1),(25,8,1,'2025-02-20 13:13:20',17,'',1,0,0,0,1,1),(26,3,1,'2025-02-20 13:14:10',17,'',1,0,0,0,1,1),(27,3,1,'2025-02-20 13:19:51',17,'',1,0,0,1,0,1),(28,3,1,'2025-02-20 13:19:57',10,'',1,0,0,0,1,1),(29,3,1,'2025-02-20 13:20:21',17,'',1,0,0,0,1,1),(30,3,1,'2025-02-20 13:20:34',29,'',1,0,0,1,0,1);
/*!40000 ALTER TABLE `t_comanda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_estados`
--

DROP TABLE IF EXISTS `t_estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_estados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_estados`
--

LOCK TABLES `t_estados` WRITE;
/*!40000 ALTER TABLE `t_estados` DISABLE KEYS */;
INSERT INTO `t_estados` VALUES (1,'Libre'),(2,'Ocupada'),(3,'Reservada');
/*!40000 ALTER TABLE `t_estados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_mesas`
--

DROP TABLE IF EXISTS `t_mesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_mesas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_estado` int NOT NULL,
  `detalles` text,
  `fecha_cambio` datetime DEFAULT CURRENT_TIMESTAMP,
  `n_mesa` int unsigned NOT NULL,
  `hora_reserva` time DEFAULT NULL,
  `nombre_reserva` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `n_mesa` (`n_mesa`),
  KEY `id_estado` (`id_estado`),
  CONSTRAINT `t_mesas_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `t_estados` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_mesas`
--

LOCK TABLES `t_mesas` WRITE;
/*!40000 ALTER TABLE `t_mesas` DISABLE KEYS */;
INSERT INTO `t_mesas` VALUES (1,1,NULL,'2025-02-03 13:47:06',1,NULL,NULL),(2,1,NULL,'2025-02-14 09:45:32',2,NULL,NULL),(3,1,NULL,'2025-02-14 09:45:32',3,NULL,NULL),(4,1,NULL,'2025-02-14 09:45:32',4,NULL,NULL),(5,1,NULL,'2025-02-14 09:45:32',5,NULL,NULL),(6,1,'','2025-02-14 09:45:32',6,'16:30:00','Maher'),(7,1,NULL,'2025-02-14 09:45:32',7,NULL,NULL),(8,1,NULL,'2025-02-14 09:45:32',8,NULL,NULL),(9,1,NULL,'2025-02-14 09:45:32',9,NULL,NULL),(10,1,NULL,'2025-02-14 09:45:32',10,NULL,NULL),(11,1,NULL,'2025-02-14 09:45:32',11,NULL,NULL),(12,1,NULL,'2025-02-14 09:45:32',12,NULL,NULL),(13,1,NULL,'2025-02-14 09:45:32',13,NULL,NULL),(14,1,NULL,'2025-02-14 09:45:32',14,NULL,NULL),(15,1,NULL,'2025-02-14 09:45:32',15,NULL,NULL),(16,1,NULL,'2025-02-14 09:45:32',16,NULL,NULL),(17,1,NULL,'2025-02-14 09:45:32',17,NULL,NULL),(30,1,NULL,'2025-02-17 12:47:31',18,NULL,NULL);
/*!40000 ALTER TABLE `t_mesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_pagos`
--

DROP TABLE IF EXISTS `t_pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_pagos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_comanda` int DEFAULT NULL,
  `total_pagar` decimal(10,2) NOT NULL,
  `fecha_pago` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_comanda` (`id_comanda`),
  CONSTRAINT `t_pagos_ibfk_1` FOREIGN KEY (`id_comanda`) REFERENCES `t_comanda` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_pagos`
--

LOCK TABLES `t_pagos` WRITE;
/*!40000 ALTER TABLE `t_pagos` DISABLE KEYS */;
INSERT INTO `t_pagos` VALUES (1,3,1.50,'2025-02-20 08:48:24'),(2,2,3.00,'2025-02-20 09:13:07'),(3,4,1.20,'2025-02-20 09:13:44'),(4,5,1.50,'2025-02-20 11:41:50'),(5,6,1.50,'2025-02-20 11:41:50'),(6,7,1.80,'2025-02-20 11:41:50'),(7,8,1.50,'2025-02-20 11:43:06'),(8,9,1.80,'2025-02-20 11:43:06'),(9,10,1.20,'2025-02-20 11:51:45'),(10,12,1.20,'2025-02-20 12:00:30'),(11,13,1.50,'2025-02-20 12:14:46'),(12,14,1.50,'2025-02-20 12:19:08'),(13,16,1.50,'2025-02-20 12:56:10'),(14,17,5.00,'2025-02-20 12:56:14'),(15,18,1.50,'2025-02-20 13:07:06'),(16,19,3.00,'2025-02-20 13:07:06'),(17,20,1.50,'2025-02-20 13:10:29'),(18,21,3.00,'2025-02-20 13:10:31'),(19,22,1.20,'2025-02-20 13:10:31'),(20,23,0.20,'2025-02-20 13:10:31'),(21,25,1.50,'2025-02-20 13:13:34'),(22,24,1.50,'2025-02-20 13:13:37'),(23,26,1.50,'2025-02-20 13:20:14'),(24,28,1.50,'2025-02-20 13:20:14'),(25,29,1.50,'2025-02-20 13:20:39');
/*!40000 ALTER TABLE `t_pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_productos`
--

DROP TABLE IF EXISTS `t_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(50) NOT NULL,
  `clase_id` int unsigned NOT NULL,
  `subclase_id` int unsigned NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `stock` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `clase_id` (`clase_id`),
  KEY `subclase_id` (`subclase_id`),
  CONSTRAINT `t_productos_ibfk_1` FOREIGN KEY (`clase_id`) REFERENCES `t_clases` (`id`) ON DELETE CASCADE,
  CONSTRAINT `t_productos_ibfk_2` FOREIGN KEY (`subclase_id`) REFERENCES `t_subclases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_productos`
--

LOCK TABLES `t_productos` WRITE;
/*!40000 ALTER TABLE `t_productos` DISABLE KEYS */;
INSERT INTO `t_productos` VALUES (1,'Café',1,1,1.20,96),(2,'Café descafeinado sobre',1,1,1.20,75),(3,'Café descafeinado máquina',1,1,1.20,90),(4,'Leche vaca',1,2,0.10,110),(5,'Leche soja',1,3,0.20,110),(6,'Leche avena',1,3,0.20,109),(7,'Té Verde',1,4,1.50,50),(8,'Té Negro',1,4,1.50,60),(9,'Manzanilla',1,5,1.50,59),(10,'Mejorana',1,5,1.50,59),(11,'Rooibos',1,5,1.50,60),(12,'Tila',1,5,1.50,60),(13,'Zumo de Naranja',1,6,2.50,30),(14,'Zumo de Naranja',1,7,1.70,30),(15,'Zumo de tomate',1,7,1.70,30),(16,'Zumo de melocotón',1,7,1.70,30),(17,'Agua Mineral',1,8,1.50,192),(18,'Agua Mineral gas',1,8,1.50,200),(19,'Croissant',2,9,1.80,100),(20,'Tarta de Manzana',2,9,2.30,60),(21,'Tarta de Chocolate',2,9,2.50,90),(22,'Tarta de Queso',2,9,2.50,20),(24,'Queque',2,9,1.80,90),(25,'Trucha de batata',2,10,2.80,40),(26,'Magdalenas',2,9,1.80,85),(27,'Pulguita de tierno con membrillo',2,11,2.00,50),(28,'Pulguita de serrano',2,11,2.00,50),(29,'Pulguita de ibérico',2,11,3.00,48),(30,'Pulguita de pollo',2,11,3.00,50),(31,'Pulguita de ternera',2,11,3.00,50),(32,'Sandwitch mixto',2,11,2.50,50),(33,'Sandwitch vegetal',2,11,3.00,50),(34,'Sandwitch pollo',2,11,3.00,50),(35,'Bocadillo de serrano',2,11,3.50,50),(36,'Bocadillo de ibérico',2,11,3.50,50),(37,'Bocadillo de pollo',2,11,3.50,50),(38,'Bocadillo de ternera',2,11,3.50,50),(39,'Ensalada César',2,12,5.00,29);
/*!40000 ALTER TABLE `t_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_roles`
--

DROP TABLE IF EXISTS `t_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_roles`
--

LOCK TABLES `t_roles` WRITE;
/*!40000 ALTER TABLE `t_roles` DISABLE KEYS */;
INSERT INTO `t_roles` VALUES (1,'Administrador'),(2,'Gerente'),(3,'Encargado'),(4,'Camarero');
/*!40000 ALTER TABLE `t_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_subclases`
--

DROP TABLE IF EXISTS `t_subclases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_subclases` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `clase_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `clase_id` (`clase_id`),
  CONSTRAINT `t_subclases_ibfk_1` FOREIGN KEY (`clase_id`) REFERENCES `t_clases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_subclases`
--

LOCK TABLES `t_subclases` WRITE;
/*!40000 ALTER TABLE `t_subclases` DISABLE KEYS */;
INSERT INTO `t_subclases` VALUES (1,'Café',1),(2,'Leche',1),(3,'No leche',1),(4,'Té',1),(5,'Infusión',1),(6,'Zumo natural',1),(7,'Zumo bote',1),(8,'Agua',1),(9,'Pastelería',2),(10,'Empanada',2),(11,'Bocadillo',2),(12,'Ensalada',2);
/*!40000 ALTER TABLE `t_subclases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_usuarios`
--

DROP TABLE IF EXISTS `t_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(20) NOT NULL,
  `clave_usuario` varchar(255) NOT NULL,
  `id_rol` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `t_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `t_roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_usuarios`
--

LOCK TABLES `t_usuarios` WRITE;
/*!40000 ALTER TABLE `t_usuarios` DISABLE KEYS */;
INSERT INTO `t_usuarios` VALUES (1,'maher','$2y$10$3CVayKG8zJfz/ZMs8OA.IeEqF6PoXVSupJDUSlzjlP81DiMfnMUY2',1),(9,'juan','$2y$10$BhYqhT996wxByTeNBOkFwOVPExO9Hru7SdvXoUEPI6EE200p/4Enq',4),(10,'manolo','$2y$10$8bBkX3vwqwQ7j9zkNqqCl.b717p1eP0FTHPP/pcOT5pF9WVKON.VG',3),(11,'eduardo','$2y$10$wsk.v9IyXZEZmM5lmKNFweuYK3wWWF2Zx6v7gSMic2FtYuYFbniA2',2);
/*!40000 ALTER TABLE `t_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-24 13:33:44
