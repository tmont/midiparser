/*
SQLyog Enterprise - MySQL GUI v8.16 
MySQL - 5.1.39-community : Database - midiparser
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`midiparser` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `midiparser`;

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_id`),
  KEY `created` (`created`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `news` */

insert  into `news`(`news_id`,`title`,`content`,`created`) values (1,'1.0 Released!','<p>\n	PHP MIDI Parser 1.0 has been released, along with the site \n	dedicated to it. It&#039;s obviously total overkill, but I had \n	fun making it.\n</p>\n<p>\n	Check out the <a href=\"/demo\">demo</a> page to get a feel \n	for what this library can do. The <a href=\"/docs/\">API \n	documentation</a> is also available to help with using the \n	library.\n</p>\n<p>\n	The PHP MIDI Parser library is basically set of well-defined \n	APIs for parsing a MIDI file. It also comes with a set of\n	output generators (textual and HTML) that display the results\n	of a parse. Every part of the library was built with\n	extensibility and customizability in mind, so that others\n	could easiliy adapt it to their needs.\n</p>\n<p>\n	Viewing the <a href=\"/docs/\">documentation</a> will help\n	developers get started in using the APIs, and how everything\n	is wired together.\n</p>\n<p>\n	Thanks for coming, and <a href=\"/contact\">drop me a\n	line</a> to report bugs or if you have any questions.\n</p>\n','2009-10-26 00:06:30');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
