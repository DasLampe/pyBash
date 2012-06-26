-- MySQL dump 10.13  Distrib 5.5.25, for Linux (i686)
--
-- Host: localhost    Database: pyBash
-- ------------------------------------------------------
-- Server version	5.5.25-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pyBash_debug`
--

DROP TABLE IF EXISTS `pyBash_debug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pyBash_debug` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  `exception_id` varchar(5) NOT NULL,
  `trace` text NOT NULL,
  `exception_file` text NOT NULL,
  `exception_line` int(11) NOT NULL,
  `request_uri` text NOT NULL,
  `request_referer` text NOT NULL,
  `request_method` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pyBash_debug`
--

LOCK TABLES `pyBash_debug` WRITE;
/*!40000 ALTER TABLE `pyBash_debug` DISABLE KEYS */;
/*!40000 ALTER TABLE `pyBash_debug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pyBash_quotes`
--

DROP TABLE IF EXISTS `pyBash_quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pyBash_quotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reporter_name` text NOT NULL,
  `quote` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pyBash_quotes`
--

LOCK TABLES `pyBash_quotes` WRITE;
/*!40000 ALTER TABLE `pyBash_quotes` DISABLE KEYS */;
INSERT INTO `pyBash_quotes` VALUES (32,'2012-06-16 17:24:10','DasLampe','<Ditti> Ich hab gerade schon wieder in mein syslog geschaut. Sehe viele Einträge mit \'Login failed\'. Blöder Mail-Client. :D\r\n<Achtzig> Tja - auf SSH und HTTP wird es dann auch so richtig zur Sache gehen :-D\r\n<Ditti> Wie jetzt?\r\n<Achtzig> Oder meinst Du Dich selbst? :-D\r\n<Ditti> Ich meine mich selbst :D\r\n<Achtzig> Achsio :-D\r\n<Ditti> Du hast doch auch Zugriff auf deine Logs, oder?\r\n<Achtzig> Wenn ich in die Logdateien reinschaue, sind da immer massenhaft \"feindliche\" Anfragen :-)\r\n<Achtzig> Jo - klar :-D\r\n<Achtzig> Die Firewall hält mir da aber schon mal eine ganze Menge Einträge ab ;-)\r\n<Achtzig> Speziell auf SSH\r\n<Ditti> Kannst du mir mal eine Mail senden und dann schauen, was als relay drin steht? Also bei ricod@riditt.de\r\n<Achtzig> Jo ...\r\n<Ditti> Danke.\r\n<Achtzig> Ok :-)\r\n<Ditti> Sonst dreh ich hier noch durch :D\r\n<Achtzig> ALso ist draußen, sollte das heißen :-D\r\n<Ditti> Und das relay? :D\r\n<Achtzig> Achso - schon wieder vergesen :-D\r\n<Ditti> :D\r\n<Achtzig> Ähm - Relay? Wieso sollte ich das sehen? :-D\r\n<Ditti> relay=local steht nämlich nur bei mir :D\r\n<Ditti> Weil ich auch deins sehe? :D\r\n<Achtzig> Achso - nein - die Mail-Logs sehe ich nicht :-D\r\n<Achtzig> Jetzt verstehe ich ;-)\r\n<Ditti> Mensch! :D\r\n<Achtzig> Die sieht 1und1 :-)\r\n<Ditti> Arsch! :D\r\n<Achtzig> :-D',2),(33,'2012-06-18 13:18:04','12','22',1);
/*!40000 ALTER TABLE `pyBash_quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pyBash_users`
--

DROP TABLE IF EXISTS `pyBash_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pyBash_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pyBash_users`
--

LOCK TABLES `pyBash_users` WRITE;
/*!40000 ALTER TABLE `pyBash_users` DISABLE KEYS */;
INSERT INTO `pyBash_users` VALUES (1,'DasLampe','9975dbf90ed38fcc2967368be617726282548cff0ef6605bc8217be0d9be954f31358a743ca2827b1574ad7a9858cdec82190c0be9bbab9b7597d7340f5fcbbc','Ebio1aiv','daslampe@lano-crew.org');
/*!40000 ALTER TABLE `pyBash_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-26 16:26:13
