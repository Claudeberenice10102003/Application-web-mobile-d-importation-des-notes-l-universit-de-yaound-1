/*
SQLyog Community v11.28 (64 bit)
MySQL - 5.7.20-log : Database - soutenance
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`soutenance` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `soutenance`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `identifiant` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(20) NOT NULL,
  `role` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`mot_de_passe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `admin` */

/*Table structure for table `administrateur` */

DROP TABLE IF EXISTS `administrateur`;

CREATE TABLE `administrateur` (
  `identifiant` varchar(255) DEFAULT NULL,
  `mot_de_passe` varchar(10) NOT NULL,
  `id_ue` varchar(20) DEFAULT NULL,
  `matricule` varchar(7) DEFAULT NULL,
  UNIQUE KEY `mot_de_passe` (`mot_de_passe`),
  KEY `id_ue` (`id_ue`),
  KEY `matricule` (`matricule`),
  CONSTRAINT `administrateur_ibfk_1` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`),
  CONSTRAINT `administrateur_ibfk_2` FOREIGN KEY (`matricule`) REFERENCES `etudiant` (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `administrateur` */

/*Table structure for table `enseignant` */

DROP TABLE IF EXISTS `enseignant`;

CREATE TABLE `enseignant` (
  `id_prof` int(10) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `statut` enum('0','1') DEFAULT NULL,
  `role` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `enseignant` */

insert  into `enseignant`(`id_prof`,`password`,`username`,`statut`,`role`) values (1,'test201','Moyou','1',NULL),(2,'test205','Catcha','0',NULL),(3,'test213','Nkondock','0',NULL),(4,'test307','Valacha','0',NULL);

/*Table structure for table `etudiant` */

DROP TABLE IF EXISTS `etudiant`;

CREATE TABLE `etudiant` (
  `matricule` varchar(7) NOT NULL,
  `noms` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `etudiant` */

insert  into `etudiant`(`matricule`,`noms`) values ('20R3333','Tsoungui Leo'),('21Q2523','Alban Happi'),('21T2314','Ndokou Elat'),('21T2883','Eyenga Claude');

/*Table structure for table `importerfichier` */

DROP TABLE IF EXISTS `importerfichier`;

CREATE TABLE `importerfichier` (
  `nom` varchar(255) NOT NULL,
  `Date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `importerfichier` */

insert  into `importerfichier`(`nom`,`Date`) values ('table(1).xls','2024-05-13 18:53:00');

/*Table structure for table `ue` */

DROP TABLE IF EXISTS `ue`;

CREATE TABLE `ue` (
  `id_ue` varchar(20) NOT NULL,
  `niveau` varchar(20) DEFAULT NULL,
  `statut` enum('0','1') DEFAULT NULL,
  `id_prof` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_ue`),
  KEY `id_prof` (`id_prof`),
  CONSTRAINT `ue_ibfk_1` FOREIGN KEY (`id_prof`) REFERENCES `enseignant` (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ue` */

insert  into `ue`(`id_ue`,`niveau`,`statut`,`id_prof`) values ('ICT201','2','1',1),('ICT205','2','0',2),('ICT313','3','1',1),('INF248','M1','1',1);

/*Table structure for table `uejoinetudiant` */

DROP TABLE IF EXISTS `uejoinetudiant`;

CREATE TABLE `uejoinetudiant` (
  `id_ue` varchar(20) DEFAULT NULL,
  `matricule` varchar(7) DEFAULT NULL,
  `cc` int(2) DEFAULT NULL,
  `tp` int(2) DEFAULT NULL,
  `ee` int(2) DEFAULT NULL,
  KEY `id_ue` (`id_ue`),
  KEY `matricule` (`matricule`),
  CONSTRAINT `uejoinetudiant_ibfk_1` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`),
  CONSTRAINT `uejoinetudiant_ibfk_2` FOREIGN KEY (`matricule`) REFERENCES `etudiant` (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `uejoinetudiant` */

insert  into `uejoinetudiant`(`id_ue`,`matricule`,`cc`,`tp`,`ee`) values ('ICT201','21Q2523',20,19,10),('ICT201','21T2883',11,15,17),('INF248','21T2314',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
