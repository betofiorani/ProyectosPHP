/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.4.18-MariaDB : Database - atenea
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`atenea` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `atenea`;

/*Table structure for table `propiedades` */

DROP TABLE IF EXISTS `propiedades`;

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(200) DEFAULT 'NULL',
  `descripcion` longtext NOT NULL,
  `habitaciones` int(1) NOT NULL,
  `wc` int(1) NOT NULL,
  `cocheras` int(1) NOT NULL,
  `creado` date NOT NULL,
  `vendedorId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendedorId_idx` (`vendedorId`),
  CONSTRAINT `vendedorId` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `propiedades` */

insert  into `propiedades`(`id`,`titulo`,`precio`,`imagen`,`descripcion`,`habitaciones`,`wc`,`cocheras`,`creado`,`vendedorId`) values (4,'Hermosa casa en la playa Anaconda, La Paloma, Uruguay','7000000.00','35f802a15d20d77401f8f76eb9938ef7.jpg','La descripción se me rompe al guardar.\r\nMe parece que no funciona bien.\r\nvoy a probar signos!!\r\nfuncionará bien?',4,2,2,'2021-03-14',1),(5,'Espectacular casa en Barrio Urquiza. Con 1 departamento atrás y cochera. ','3000000.00','4f3c133bfe8b8d8646d930993364e285.jpg','Hermosa casa en un barrio peligroso. Calle cortada. Casa con un departamento atrás totalmente equipado.',4,2,1,'2021-03-15',2),(6,'Espectacular casa de 2 pisos en Barrio Belgrano, Río Segundo.','12000000.00','904e77bab67009f9d5797c4064fc24c9.jpg','Espectacular casa de 4 habitaciones con cochera doble, galería y terraza.\r\nA 3 cuadras del río Xanaes.\r\nZona muy tranquila y sin vecinos molestos.\r\n',4,2,2,'2021-03-15',1),(12,'Hermosa casa de Prueba','3000000.00','76126ee0ababaeb807412f48dbd7fd3b.jpg','fsfgsdgsdg ssdgdfgdfg dfh dfhdfhd fhd fhd h dfhdfhdfhdfhdfh dhdhdfhdhdhfdh dhdfhdfhdfhdfh hdfhdfhdfhdhd hd hdfhdfhdfhdhdhf dhdhdhdhdh dhdhdfhdh df ',3,2,1,'2021-03-26',1),(13,'Hermosa casa de Prueba - actualizada','300000.00','7d49a1aa42be02964a69a38bde9db5f7.jpg','probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando ',5,2,2,'2021-03-26',2),(14,'Hermosa casa de Prueba','300000.00','8167a0758760ee2eb41ebccf630627da.jpg','probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando probando ',5,2,1,'2021-03-26',2),(15,'progsdg sdgsgsdgggg gggggggggg ggggggg ggggggg','3000000.00','b5dc3aa91c717dbb6226d6f4f187de08.jpg','fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg fsgsdgsdgsg ',3,2,2,'2021-03-26',2),(17,'sdfsdfsdfsdfd f2323423','35345345.00','630f74e679ad684c0a7f0091669cfd53.jpg','sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd sdfsdfsdfsdfd ',3,2,1,'2021-03-27',1),(19,'Casa para perros Caniche','14000.00','9b7c8cb97f16f45c10865ec16a9b9930.jpg','casa para perros caniche casa para perros caniche casa para perros caniche casa para perros caniche casa para perros caniche casa para perros caniche casa para perros caniche ',1,1,1,'2021-03-29',2),(20,'Casa nueva MVC','100000.00','a95421a827ad63b930b9ae8c6248b460.jpg','Model View Controller Model View Controller Model View Controller Model View Controller Model View Controller Model View Controller Model View Controller Model View Controller Model View Controller Model View Controller ',3,2,1,'2021-04-03',1),(21,'Casita de muñecas GEMA','455555.00','cd167c8b886993dbaed20220f1b6ec03.jpg','casita de mmv casita de mmv casita de mmv casita de mmv casita de mmv casita de mmv casita de mmv casita de mmv casita de mmv casita de mmv casita de mmv casita de mmv ',4,3,2,'2021-04-03',1),(22,'probando el resultado de la url','4200.00','b1163188d208fabb184f4de03abca265.jpg','como he renegado.  como he renegado. como he renegado. como he renegado. como he renegado. como he renegado. como he renegado. como he renegado. como he renegado. ',5,4,3,'2021-04-03',5);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` char(60) NOT NULL,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`email`,`password`) values (2,'betofiorani@gmail.com','$2y$10$nv7r4I8.OSoxYN/nhEbHI.AHDcBa8i.1RdfDBVbWN3oSG3bbSLwQe');

/*Table structure for table `vendedores` */

DROP TABLE IF EXISTS `vendedores`;

CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `vendedores` */

insert  into `vendedores`(`id`,`nombre`,`apellido`,`telefono`) values (1,'Beto','Fiorani','3514029030'),(2,'Hernán','Garcia','3514029030'),(4,'Daniela','Blati','3512912421'),(5,'Guadi Gema','Fiorani','3514028771');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
