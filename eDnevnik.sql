/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.22-MariaDB : Database - ednevnik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ednevnik` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ednevnik`;

/*Table structure for table `grades` */

DROP TABLE IF EXISTS `grades`;

CREATE TABLE `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `predmet_id` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `subject_id` (`predmet_id`),
  CONSTRAINT `fk_predmet` FOREIGN KEY (`predmet_id`) REFERENCES `predmeti` (`id`),
  CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1019 DEFAULT CHARSET=utf8mb4;

/*Data for the table `grades` */

insert  into `grades`(`id`,`student_id`,`predmet_id`,`points`,`note`) values 
(1010,12,4,10,'Student je polozio ispit i ostvario ocenu 10'),
(1011,24,14,6,'Student je polozio ispit i ostvario ocenu 6'),
(1012,12,6,5,'Student nije polozio ispit, potrebno je da ponovo slusa predavanja'),
(1013,26,13,7,'Student je polozio ispit i ostvario ocenu 7'),
(1018,2,4,5,'Plozio');

/*Table structure for table `predmeti` */

DROP TABLE IF EXISTS `predmeti`;

CREATE TABLE `predmeti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `teacher` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `predmeti` */

insert  into `predmeti`(`id`,`name`,`teacher`,`department`,`points`) values 
(1,'Engleski jezik','Marija Savic','Katedra za engleski jezik',4),
(2,'Matematika','Natasa Cicic','Katedra za matematiku',5),
(3,'Nemacki jezik','Maja Vulijanac','Katedra za nemacki jezik',4),
(4,'Statistika','Maja Grujic','Katedra za statistiku',4),
(5,'Verovatnoca','Dragana Velickovic','Katedra za statistiku',1),
(6,'Istorija racunara','Novica Zabarac','Katedra za informatiku',1),
(7,'Programiranje','Snezana Milosevic','Katedra za informatiku',5),
(8,'Multimedije','Dragan Kostic','Katedra za informatiku',3),
(9,'EPOS','Tamara Naumovic','Katedra za elektronsko poslovanje',5),
(10,'ITEH','Zorica Bogdanovic','Katedra za elektronsko poslovanje',1),
(11,'SISJ','Dusan Barac','Katedra za elektronsko poslovanje',2),
(12,'Digitalni marketing','Aleksandra Labus','Aleksandra Labus',4),
(13,'Teorija sistema','Pavle Milosevic','Katedra za upravljanje sistemima',5),
(14,'Neuronske mreze','Aleksandar Rakicevic','Katedra za upravljanje sistemima',5);

/*Table structure for table `students` */

DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4;

/*Data for the table `students` */

insert  into `students`(`id`,`name`,`dob`,`email`,`address`,`city`) values 
(1,'Mina Petrovic','1999-08-13','mina@gmail','Glasinacka 6','Beograd'),
(2,'Ksenija Petrovic','1999-08-25','ksenija@gmail.com','Vidovdanska 2','Brus'),
(12,'Andjelija Randjelovic','2003-09-09','andjelija@gmail.com','Vojislava Ilica 234','Uzice'),
(24,'Aleksandra Petrovic','2000-08-27','aleks@gmail.com','Masukina 4','Cacak'),
(26,'Milan Djordjevic','2002-09-15','milan@gmail.com','Ustanicka 4','Velika Plana'),
(69,'Marjan Nikolic','2002-12-17','maki@gmail.com','Nikole Pasica 5','Smederevo');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`) values 
(1,'mina','mina'),
(2,'admin','admin');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
