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
  `trace` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  `exception_number` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pyBash_debug`
--

LOCK TABLES `pyBash_debug` WRITE;
/*!40000 ALTER TABLE `pyBash_debug` DISABLE KEYS */;
INSERT INTO `pyBash_debug` VALUES (1,'Zitat: ID:5 nicht vorhanden!','#0 /var/www/pyBash/pages/controller/quotes.php(19): QuotesView->QuoteView(\'5\')\n#1 /var/www/pyBash/core/controller/page.controller.php(31): QuotesController->factoryController()\n#2 /var/www/pyBash/index.php(18): pageController->render()\n#3 {main}',1339802849,'1b021'),(2,'Zitat: ID:5 nicht vorhanden!','#0 /var/www/pyBash/pages/controller/quotes.php(19): QuotesView->QuoteView(\'5\')\n#1 /var/www/pyBash/core/controller/page.controller.php(31): QuotesController->factoryController()\n#2 /var/www/pyBash/index.php(18): pageController->render()\n#3 {main}',1339802861,'3d70c'),(3,'Zitat: ID:5 nicht vorhanden!','#0 /var/www/pyBash/pages/controller/quotes.php(19): QuotesView->QuoteView(\'5\')\n#1 /var/www/pyBash/core/controller/page.controller.php(31): QuotesController->factoryController()\n#2 /var/www/pyBash/index.php(18): pageController->render()\n#3 {main}',1339802895,'edb76'),(4,'Zitat: ID:5 nicht vorhanden!','#0 /var/www/pyBash/pages/controller/quotes.php(19): QuotesView->QuoteView(\'5\')\n#1 /var/www/pyBash/core/controller/page.controller.php(31): QuotesController->factoryController()\n#2 /var/www/pyBash/index.php(18): pageController->render()\n#3 {main}',1339802918,'39acf'),(5,'Zitat: ID:5 nicht vorhanden!','#0 /var/www/pyBash/pages/controller/quotes.php(19): QuotesView->QuoteView(\'5\')\n#1 /var/www/pyBash/core/controller/page.controller.php(31): QuotesController->factoryController()\n#2 /var/www/pyBash/index.php(18): pageController->render()\n#3 {main}',1339802964,'aff6f'),(6,'Quote: ID:5 not exist!','#0 /var/www/pyBash/pages/controller/quotes.php(19): QuotesView->QuoteView(\'5\')\n#1 /var/www/pyBash/core/controller/page.controller.php(31): QuotesController->factoryController()\n#2 /var/www/pyBash/index.php(18): pageController->render()\n#3 {main}',1339803042,'6866e');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pyBash_quotes`
--

LOCK TABLES `pyBash_quotes` WRITE;
/*!40000 ALTER TABLE `pyBash_quotes` DISABLE KEYS */;
INSERT INTO `pyBash_quotes` VALUES (1,'2012-06-13 22:30:21','DasLampe','<pyBot Werner> Ja was gibt\'s\r\n<Ditti> Nerv nicht, Werner :D\r\n<pyBot Werner> Ja was gibt\'s\r\n<Ditti> Verdammt :D'),(2,'2012-06-13 22:30:21','Achtzig','<tussi> mmmmmmmmmmmmh... den gibts ja noch immer http://www.pytal.de/nickpage,104267\r\n<Achtzig> Den solte man mal aufessen :-D'),(3,'2012-06-13 23:16:20','Ditti','<Ditti4> Mach ich jeden Abend s. Ab 21:00 \"schlafe\" ich immer, oder soll es zumindest. ;)\r\n<Achtzig> Mit einer Taschenlampe unter der Decke :-D\r\n<Achtzig> So haben wir früher heimlich gelesen ;-)\r\n<Achtzig> Bücher - so Dinger mit Papierseiten :-)'),(4,'2012-06-13 23:16:20','Ditti','<Achtzig> Ja, wenn Du die gleichen meinst, die ich meine. Oder meinst Du Uglu?\r\n<Ditti4> Was fürn Ding?\r\n<Ditti4> Ich kenn nur Iglu. :D');
/*!40000 ALTER TABLE `pyBash_quotes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-16  1:39:05
