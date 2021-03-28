-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: library_manucop_db
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

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
-- Table structure for table `a_books`
--

DROP TABLE IF EXISTS `a_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a_books` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_edit_date` datetime NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a_books`
--

LOCK TABLES `a_books` WRITE;
/*!40000 ALTER TABLE `a_books` DISABLE KEYS */;
INSERT INTO `a_books` VALUES (1,'كتاب الإيضاح','2021-02-18 19:43:57','2021-03-23 08:03:42'),(2,'عنوان الكتاب 2','2021-02-19 10:55:17','2021-03-09 16:04:26'),(3,'الكتاب 3','2021-03-09 12:30:22','2021-03-23 10:39:33'),(4,'تعلم قواعد اللغة العربية','2021-03-10 00:22:21','2021-03-10 00:22:21'),(5,'العلم نور والجهل ظلام','2021-03-21 15:48:02','2021-03-21 15:48:02'),(6,'Corona virus - covid-19','2021-03-23 07:47:04','2021-03-23 08:17:10'),(7,'تعلم اللغة العربية للمبتدئين','2021-03-27 09:35:37','2021-03-27 09:35:37'),(8,'Title book','2021-03-28 10:08:31','2021-03-28 10:08:31');
/*!40000 ALTER TABLE `a_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `b_subjects`
--

DROP TABLE IF EXISTS `b_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `b_subjects` (
  `subj_id` int(11) NOT NULL,
  `subj_name` varchar(25) NOT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `b_subjects`
--

LOCK TABLES `b_subjects` WRITE;
/*!40000 ALTER TABLE `b_subjects` DISABLE KEYS */;
INSERT INTO `b_subjects` VALUES (1,'تفسير القرآن الكريم'),(2,'علوم القرآن'),(3,'العقيدة وأصول الدين'),(4,'أصول الفقه'),(5,'فقه العبادات والمعاملات'),(6,'الحديث الشريف وعلومه'),(7,'اللغة العربية وعلومها'),(8,'الدواوين'),(9,'المنطق'),(10,'الفلسفة'),(11,'الرثاء'),(12,'الرؤيا والتعبير'),(13,'الخطب والوصايا'),(14,'التصوف'),(15,'الزهد والرقائق'),(16,'الأخلاق'),(17,'آداب البحث'),(18,'السياسة وتدبير الملك'),(19,'حدود العلم'),(21,'المدائح النبوية'),(22,'الوعظ، النصح، الحكم، التض'),(23,'الأدعية والأذكار'),(24,'الفضائل'),(25,'التاريخ والجغرافيا'),(26,'الخواص، الجداول والأوفاق'),(27,'العلوم الرياضية'),(28,'العلوم التجريبية'),(29,'المواضيع المتنوعة');
/*!40000 ALTER TABLE `b_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `c_authors`
--

DROP TABLE IF EXISTS `c_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_authors` (
  `auth_id` int(11) NOT NULL,
  `auth_name` varchar(35) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_edit_date` datetime NOT NULL,
  PRIMARY KEY (`auth_id`),
  UNIQUE KEY `auth_name` (`auth_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_authors`
--

LOCK TABLES `c_authors` WRITE;
/*!40000 ALTER TABLE `c_authors` DISABLE KEYS */;
INSERT INTO `c_authors` VALUES (1,'mohammed guellil','2021-03-23 08:03:23','2021-03-23 08:03:23'),(2,'ابراهيم بن محمد رمضان','2021-02-16 08:35:51','2021-02-16 08:35:51'),(3,'Nadir korar','2021-03-23 08:02:30','2021-03-23 08:02:30'),(4,'حواش داود بن حمو','2021-03-27 09:40:23','2021-03-27 09:40:23');
/*!40000 ALTER TABLE `c_authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cabinets`
--

DROP TABLE IF EXISTS `cabinets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cabinets` (
  `cabinet_id` int(11) NOT NULL,
  `cabinet_name` varchar(120) NOT NULL,
  PRIMARY KEY (`cabinet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabinets`
--

LOCK TABLES `cabinets` WRITE;
/*!40000 ALTER TABLE `cabinets` DISABLE KEYS */;
INSERT INTO `cabinets` VALUES (1,'الخزانة العامّة'),(2,'خزانة الشيخ حَمُّو بابا وْموسى'),(3,'الخزائن الثلاث: الشيخ صالح بن كاسي؛ الحاج بكير بوكَرْموشْ؛ بَاحْمَدْ اشْقَبْقَبْ'),(4,'مكتبة الأستاذ محمّد بن أيوب الحاج سعيد (لَخْبوراتْ)'),(5,'خزانة دار التعليم (للمشايخ الثلاثة: مامَّهْ بنت سليمان بَبَّازْ؛ بكير بن عمر موسى وعْلي؛ بكير بن عليّ موسى وعْلي)'),(6,'خزانة الشيخ القاضي أبي بكر بن مسعود الغرداوي الشهير بالشيخ الحاج بَبْكَرْ'),(7,'خزانة دار التلاميذ (إرْوانْ) بجامع غرداية الكبير'),(8,'الخزائن العمانيّة'),(9,'خزانتيْ الشيخين: بَنوح بن أحمد مَصباح / صالح بن حَمُّو بابُهونْ'),(10,'خزانة الشيخ باسَّهْ بن أَمي موسى الوارجلاني'),(11,'خزانة آل اشْقَبْقَبْ (للناسخ المحترف إبراهيم بن سليمان اشقبقب ونجله صالح'),(12,'خزانتيْ الشيخين: بنوح مَصباح وصالح بابُهون'),(13,'مكتبة معهد الإصلاح بغرداية'),(14,'خزانة الشيخ محمّد بن سليمان بن ادْريسُو اليسجني ونجليه صالح وسليمان'),(15,'مكتبة الأستاذ سليمان بن محمّد بومَعْقَلْ (وارجلان)'),(16,'خزانة البَكري للشيخ العلاّمة عبد الرحمن بن عمر بَكَلِّي'),(17,'خزانة الشيخ باحْمد بن صالح كِيوْكِيوْ'),(18,'خزانة الشيخ الحاج حَمُّو بن إبراهيم تامْتَلْتْ'),(19,'خزانة جمعيّة الشيخ أبي إسحاق اطفيش لخدمة التراث'),(20,'خزانة جمعيّة الشيخ أبي إسحاق اطفيش لخدمة التراث'),(21,'خزانة دار العلم للشيخ الحاج عمر بن الحاج مسعود القراري');
/*!40000 ALTER TABLE `cabinets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(25) NOT NULL,
  PRIMARY KEY (`city_id`),
  UNIQUE KEY `city_name` (`city_name`),
  UNIQUE KEY `city_name_2` (`city_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (5,'تمنراست'),(7,'جربة'),(1,'غرداية'),(4,'غليزان'),(3,'قالمة'),(2,'قسنطينة'),(6,'وهران');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `count_id` int(11) NOT NULL AUTO_INCREMENT,
  `count_name` varchar(25) NOT NULL,
  PRIMARY KEY (`count_id`),
  UNIQUE KEY `count_name` (`count_name`),
  UNIQUE KEY `count_name_2` (`count_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'الجزائر'),(5,'تركيا'),(2,'تونس'),(6,'فرنسا'),(3,'ليبيا'),(4,'مصر');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_colors`
--

DROP TABLE IF EXISTS `d_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_colors` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(10) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_colors`
--

LOCK TABLES `d_colors` WRITE;
/*!40000 ALTER TABLE `d_colors` DISABLE KEYS */;
INSERT INTO `d_colors` VALUES (1,'البني'),(2,'الأسود'),(3,'الأحمر'),(4,'الآجوري'),(5,'البنفسجي'),(6,'الوردي'),(7,'البرتقالي'),(8,'الأصفر'),(9,'الأخضر'),(10,'الأزرق'),(11,'المذهب');
/*!40000 ALTER TABLE `d_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_copiers`
--

DROP TABLE IF EXISTS `d_copiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_copiers` (
  `cop_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `descent1` varchar(15) NOT NULL,
  `descent2` varchar(15) NOT NULL,
  `descent3` varchar(15) NOT NULL,
  `descent4` varchar(15) NOT NULL,
  `descent5` varchar(15) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `nickname` varchar(25) NOT NULL,
  `other_name1` varchar(50) NOT NULL,
  `other_name2` varchar(50) NOT NULL,
  `other_name3` varchar(50) NOT NULL,
  `other_name4` varchar(50) NOT NULL,
  `count_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  `last_edit_date` datetime NOT NULL,
  PRIMARY KEY (`cop_id`),
  KEY `count_id` (`count_id`,`city_id`),
  KEY `d_copiers_ibfk_1` (`city_id`),
  CONSTRAINT `d_copiers_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON UPDATE CASCADE,
  CONSTRAINT `d_copiers_ibfk_2` FOREIGN KEY (`count_id`) REFERENCES `countries` (`count_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_copiers`
--

LOCK TABLES `d_copiers` WRITE;
/*!40000 ALTER TABLE `d_copiers` DISABLE KEYS */;
INSERT INTO `d_copiers` VALUES (1,'الإسم الكامل للناسخ رقم 1','النسبة1','النسبة2','النسبة 3','','','اللقب (اسم الشهرة)','الكنية','صيغ أخرى لاسم الناسخ1','صيغ أخرى لاسم الناسخ2','','',2,3,'2021-02-18 19:41:07','2021-03-12 00:59:40'),(2,'اسم الناسخ2','النسبة','','','','','','','','','','',1,1,'2021-02-18 19:44:54','2021-03-12 11:01:31'),(3,'اسم الناسخ 3','الهويريني','العميد','','','','لقبه','كنيته','صيغته 1','صيغته 2','','',NULL,NULL,'2021-03-10 00:48:34','2021-03-10 00:48:34'),(4,'اسم الناسخ','nisba','','','','','','','','','','',NULL,NULL,'2021-03-10 01:13:22','2021-03-22 12:27:34'),(5,'Aissa Guellil','Mzabi','','','','','Guellil','Aissawi','Aissa Star','Aissa King best','','',1,1,'2021-03-22 14:36:49','2021-03-22 14:36:49'),(6,'Ilyes Histoire','mosawi','Kadir','','','','','','','','','',NULL,NULL,'2021-03-25 19:31:15','2021-03-25 19:31:15'),(7,'copier name 7','copier','','','','','','','','','','',NULL,NULL,'2021-03-26 10:44:28','2021-03-26 10:44:28'),(8,'الناسخ الكامل رقم 8','','','','','','','','','','','',NULL,NULL,'2021-03-26 10:57:21','2021-03-27 09:45:11');
/*!40000 ALTER TABLE `d_copiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_manutypes`
--

DROP TABLE IF EXISTS `d_manutypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_manutypes` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(10) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_manutypes`
--

LOCK TABLES `d_manutypes` WRITE;
/*!40000 ALTER TABLE `d_manutypes` DISABLE KEYS */;
INSERT INTO `d_manutypes` VALUES (1,'تصحيح'),(2,'تصويب'),(3,'مقابلة'),(4,'تعليق');
/*!40000 ALTER TABLE `d_manutypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_motifs`
--

DROP TABLE IF EXISTS `d_motifs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_motifs` (
  `motif_id` int(11) NOT NULL,
  `motif_name` varchar(15) NOT NULL,
  PRIMARY KEY (`motif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_motifs`
--

LOCK TABLES `d_motifs` WRITE;
/*!40000 ALTER TABLE `d_motifs` DISABLE KEYS */;
INSERT INTO `d_motifs` VALUES (1,'دائرة منقطة'),(2,'فواصل'),(3,'وريدات'),(4,'مراوح'),(5,'براعم'),(6,'فصوص');
/*!40000 ALTER TABLE `d_motifs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_manuscripts`
--

DROP TABLE IF EXISTS `e_manuscripts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `e_manuscripts` (
  `manu_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `cop_day` varchar(8) NOT NULL,
  `cop_day_nbr` int(11) DEFAULT NULL,
  `cop_month` varchar(15) NOT NULL,
  `cop_syear` int(11) DEFAULT NULL,
  `cop_eyear` int(11) DEFAULT NULL,
  `date_type` tinyint(1) DEFAULT NULL,
  `cop_place` varchar(35) NOT NULL,
  `signing` tinyint(1) DEFAULT NULL,
  `cabinet_id` int(11) DEFAULT NULL,
  `cabinet_nbr` int(11) DEFAULT NULL,
  `manu_type` varchar(2) DEFAULT NULL,
  `index_nbr` int(11) DEFAULT NULL,
  `font` varchar(8) NOT NULL,
  `font_style` varchar(25) NOT NULL,
  `regular_lines` tinyint(1) DEFAULT NULL,
  `lines_notes` varchar(35) NOT NULL,
  `paper_size` tinyint(1) DEFAULT NULL,
  `copied_from` varchar(35) NOT NULL,
  `copied_to` varchar(35) NOT NULL,
  `manu_level` varchar(5) NOT NULL,
  `cop_level` varchar(5) NOT NULL,
  `rost_completion` tinyint(1) DEFAULT NULL,
  `count_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `notes` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_edit_date` datetime NOT NULL,
  PRIMARY KEY (`manu_id`),
  KEY `book_id` (`book_id`),
  KEY `count_id` (`count_id`,`city_id`),
  KEY `city_id` (`city_id`),
  KEY `cabinet_id` (`cabinet_id`),
  CONSTRAINT `e_manuscripts_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `a_books` (`book_id`) ON UPDATE CASCADE,
  CONSTRAINT `e_manuscripts_ibfk_2` FOREIGN KEY (`count_id`) REFERENCES `countries` (`count_id`) ON UPDATE CASCADE,
  CONSTRAINT `e_manuscripts_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON UPDATE CASCADE,
  CONSTRAINT `e_manuscripts_ibfk_4` FOREIGN KEY (`cabinet_id`) REFERENCES `cabinets` (`cabinet_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_manuscripts`
--

LOCK TABLES `e_manuscripts` WRITE;
/*!40000 ALTER TABLE `e_manuscripts` DISABLE KEYS */;
INSERT INTO `e_manuscripts` VALUES (1,1,'',NULL,'',2001,NULL,0,'طريق اللور',1,8,322,'مج',324,'مشرقي','المبسوط',1,'ملاحظات على المسطرة',2,'الأصل المنسوخ منه','ابراهيم الخليل','حسن','جيد',0,3,6,'ملاحظات أخرى','2021-02-18 19:50:42','2021-03-22 12:19:53'),(2,4,'',NULL,'',2000,2016,0,'place',0,NULL,321,'مج',231,'مغربي','المجوهر',0,'',1,'الأصل المنسوخ منه','المنسوخ له','جيد','جيد',1,5,3,'ملاحظات أخرى','2021-02-18 20:24:08','2021-03-21 20:33:36'),(3,1,'الإثنين',25,'جمادى الثانية',2013,2013,0,'',0,21,0,'دغ',0,'','',0,'',3,'','','','',0,NULL,NULL,'','2021-02-19 09:39:37','2021-02-19 09:39:37'),(4,1,'',NULL,'',NULL,NULL,0,'',1,3,0,'مج',0,'','',0,'',1,'','','','',0,NULL,NULL,'','2021-02-19 09:41:36','2021-02-19 09:41:36'),(5,2,'',NULL,'',NULL,NULL,0,'',0,5,0,'مج',0,'','',0,'',3,'','','','',0,NULL,NULL,'','2021-02-19 09:53:38','2021-03-22 12:24:53'),(6,3,'الإثنين',NULL,'جمادى الثانية',NULL,NULL,0,'مكان النسخ',1,NULL,0,'مص',0,'','',0,'',1,'','','','',0,NULL,NULL,'','2021-03-09 23:42:02','2021-03-09 23:42:02'),(7,1,'',NULL,'',NULL,NULL,0,'',NULL,10,0,'',0,'','',0,'',1,'','','','',0,NULL,5,'','2021-02-19 10:31:57','2021-02-19 10:31:57'),(8,3,'',NULL,'',NULL,NULL,0,'',0,NULL,0,'مج',0,'','',0,'',1,'','','','',0,NULL,NULL,'','2021-03-09 23:52:35','2021-03-09 23:52:35'),(9,4,'',NULL,'',NULL,NULL,0,'',NULL,16,NULL,'مج',NULL,'','',NULL,'',NULL,'','','','',NULL,2,NULL,'','2021-03-12 00:53:34','2021-03-12 00:53:34'),(10,4,'الأربعاء',NULL,'جمادى الثانية',2004,NULL,0,'',NULL,NULL,NULL,'مص',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-12 16:10:47','2021-03-12 16:10:47'),(11,3,'',NULL,'',NULL,NULL,0,'',NULL,18,NULL,'مج',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-12 16:22:09','2021-03-12 16:22:09'),(12,3,'الثلاثاء',NULL,'رمضان',4241,NULL,0,'مكان النسخ',0,NULL,32,'',211,'مشرقي','المدمج',1,'',2,'الأصل المنسوخ منه','المنسوخ له','متوسط','رديء',1,2,7,'ملاحظات أخرى','2021-03-21 13:06:49','2021-03-21 13:06:49'),(13,4,'الإثنين',NULL,'جمادى الأولى',3232,NULL,0,'مكان النسخ',1,NULL,32,'دغ',241,'مغربي','المسند (الزمامي)',1,'ملاحظات على المسطرة',2,'الأصل المنسوخ منه','المنسوخ له','جيد','متوسط',1,5,7,'ملاحظات أخرى','2021-03-21 17:23:02','2021-03-21 17:23:02'),(14,3,'',NULL,'',NULL,NULL,0,'',NULL,NULL,NULL,'مج',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-22 12:03:32','2021-03-22 12:03:32'),(15,3,'الثلاثاء',NULL,'ربيع الثاني',2213,NULL,1,'',0,NULL,NULL,'مج',NULL,'','',0,'',NULL,'','','','',0,NULL,NULL,'','2021-03-22 13:23:20','2021-03-22 13:24:25'),(16,1,'',NULL,'',432,432,0,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-22 13:28:26','2021-03-22 13:28:26'),(17,4,'',NULL,'',211,211,0,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-22 13:29:02','2021-03-22 13:29:02'),(18,4,'',NULL,'',23,23,0,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-22 13:30:34','2021-03-22 13:30:34'),(19,1,'',NULL,'',NULL,4322,1,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-22 13:33:50','2021-03-22 13:33:50'),(20,3,'',NULL,'',324,4532,1,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-22 13:42:22','2021-03-22 13:42:22'),(26,3,'',NULL,'',2000,2001,1,'cop_place',1,1,123,'',123,'','',1,'lines_notes',1,'copied_from','copied_to','','',1,1,1,'notes','0000-00-00 00:00:00','2021-03-27 11:07:53'),(27,5,'',NULL,'',NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-25 19:54:59','2021-03-25 19:54:59'),(28,6,'',NULL,'صفر',NULL,NULL,0,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-25 19:56:20','2021-03-25 22:01:49'),(29,2,'',NULL,'',NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-26 07:25:29','2021-03-26 07:25:29'),(30,2,'',NULL,'',NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-26 08:01:16','2021-03-26 08:01:16'),(31,1,'',NULL,'',NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-26 08:02:30','2021-03-26 08:02:30'),(32,3,'',NULL,'',NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-26 08:03:49','2021-03-26 08:03:49'),(33,2,'',NULL,'',NULL,NULL,NULL,'',0,NULL,NULL,'',NULL,'','',0,'',NULL,'','','','',0,NULL,NULL,'','2021-03-26 08:17:43','2021-03-26 10:43:59'),(34,1,'الأحد',11,'جانفي',2003,2003,0,'place',1,14,23,'مص',230,'مغربي','المبسوط',1,'notes',2,'some text','','جيد','جيد',0,6,3,'some notes','2021-03-26 15:29:03','2021-03-27 08:54:43'),(35,2,'',NULL,'',NULL,NULL,NULL,'',NULL,NULL,NULL,'',NULL,'','',NULL,'',NULL,'','','','',NULL,NULL,NULL,'','2021-03-27 11:09:00','2021-03-27 11:09:00');
/*!40000 ALTER TABLE `e_manuscripts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `f_books_subjects`
--

DROP TABLE IF EXISTS `f_books_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `f_books_subjects` (
  `book_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`subj_id`),
  KEY `subj_id` (`subj_id`),
  CONSTRAINT `f_books_subjects_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `a_books` (`book_id`) ON UPDATE CASCADE,
  CONSTRAINT `f_books_subjects_ibfk_2` FOREIGN KEY (`subj_id`) REFERENCES `b_subjects` (`subj_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `f_books_subjects`
--

LOCK TABLES `f_books_subjects` WRITE;
/*!40000 ALTER TABLE `f_books_subjects` DISABLE KEYS */;
INSERT INTO `f_books_subjects` VALUES (1,1),(1,3),(1,4),(1,5),(1,6),(2,2),(2,6),(3,3),(3,5),(5,2),(5,3),(5,6),(6,1),(6,2),(6,3),(7,1),(7,2),(8,4),(8,26);
/*!40000 ALTER TABLE `f_books_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g_books_authors`
--

DROP TABLE IF EXISTS `g_books_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `g_books_authors` (
  `book_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`auth_id`),
  KEY `auth_id` (`auth_id`),
  CONSTRAINT `g_books_authors_ibfk_1` FOREIGN KEY (`auth_id`) REFERENCES `c_authors` (`auth_id`) ON UPDATE CASCADE,
  CONSTRAINT `g_books_authors_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `a_books` (`book_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g_books_authors`
--

LOCK TABLES `g_books_authors` WRITE;
/*!40000 ALTER TABLE `g_books_authors` DISABLE KEYS */;
INSERT INTO `g_books_authors` VALUES (1,1),(1,2),(1,3),(2,2),(3,2),(5,2),(6,1),(6,2),(7,2),(7,3),(8,3);
/*!40000 ALTER TABLE `g_books_authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `h_manuscripts_copiers`
--

DROP TABLE IF EXISTS `h_manuscripts_copiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `h_manuscripts_copiers` (
  `manu_id` int(11) NOT NULL,
  `cop_id` int(11) NOT NULL,
  `name_in_manu` varchar(50) NOT NULL,
  PRIMARY KEY (`manu_id`,`cop_id`),
  KEY `cop_id` (`cop_id`),
  CONSTRAINT `h_manuscripts_copiers_ibfk_1` FOREIGN KEY (`cop_id`) REFERENCES `d_copiers` (`cop_id`) ON UPDATE CASCADE,
  CONSTRAINT `h_manuscripts_copiers_ibfk_2` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `h_manuscripts_copiers`
--

LOCK TABLES `h_manuscripts_copiers` WRITE;
/*!40000 ALTER TABLE `h_manuscripts_copiers` DISABLE KEYS */;
INSERT INTO `h_manuscripts_copiers` VALUES (1,1,'name aiisawi ben name in manu'),(1,2,''),(2,1,''),(2,2,''),(2,3,''),(2,4,''),(3,1,'الاسم كما ورد في النسخة'),(4,2,''),(5,2,''),(6,1,''),(7,1,''),(8,1,''),(9,2,''),(10,4,''),(11,3,''),(12,1,''),(13,4,''),(14,1,''),(15,2,''),(16,3,''),(17,3,''),(18,2,''),(19,3,''),(20,3,''),(26,1,'fdsfdsa'),(27,2,'fsdsda'),(29,2,'sadsad'),(30,1,'fdsfsda'),(30,2,'dsasfaw'),(31,1,'fdsvdsa'),(31,2,'dsfsa'),(31,4,'dycxy<y<'),(32,1,'fdsfdsaf'),(33,2,'sasaas'),(33,3,'fsfdsf'),(34,2,'fdsfa'),(34,4,'cop 4'),(34,5,'ssad'),(35,4,'trgrefe');
/*!40000 ALTER TABLE `h_manuscripts_copiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `i_cop_fm`
--

DROP TABLE IF EXISTS `i_cop_fm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `i_cop_fm` (
  `cop_id` int(11) NOT NULL,
  `cop_fm` int(11) NOT NULL,
  `manu_id` int(11) NOT NULL,
  PRIMARY KEY (`cop_id`,`cop_fm`,`manu_id`),
  KEY `i_cop_fm_ibfk_2` (`cop_fm`),
  KEY `i_cop_fm_ibfk_3` (`manu_id`),
  CONSTRAINT `i_cop_fm_ibfk_1` FOREIGN KEY (`cop_id`) REFERENCES `d_copiers` (`cop_id`) ON UPDATE CASCADE,
  CONSTRAINT `i_cop_fm_ibfk_2` FOREIGN KEY (`cop_fm`) REFERENCES `d_copiers` (`cop_id`) ON UPDATE CASCADE,
  CONSTRAINT `i_cop_fm_ibfk_3` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `i_cop_fm`
--

LOCK TABLES `i_cop_fm` WRITE;
/*!40000 ALTER TABLE `i_cop_fm` DISABLE KEYS */;
INSERT INTO `i_cop_fm` VALUES (1,2,1),(1,3,12),(1,4,30),(1,4,31),(2,1,2),(2,3,1),(2,3,30),(2,3,33),(2,3,34),(2,6,31),(3,1,2),(4,3,13),(4,5,13),(4,6,34),(5,3,34);
/*!40000 ALTER TABLE `i_cop_fm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j_manuscripts_colors`
--

DROP TABLE IF EXISTS `j_manuscripts_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j_manuscripts_colors` (
  `manu_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  PRIMARY KEY (`manu_id`,`color_id`),
  KEY `manu_id` (`manu_id`),
  KEY `color_id` (`color_id`),
  CONSTRAINT `j_manuscripts_colors_ibfk_1` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE,
  CONSTRAINT `j_manuscripts_colors_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `d_colors` (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j_manuscripts_colors`
--

LOCK TABLES `j_manuscripts_colors` WRITE;
/*!40000 ALTER TABLE `j_manuscripts_colors` DISABLE KEYS */;
INSERT INTO `j_manuscripts_colors` VALUES (1,1),(1,2),(1,3),(2,1),(2,4),(2,7),(2,8),(13,2),(13,3),(13,5),(34,2),(34,7);
/*!40000 ALTER TABLE `j_manuscripts_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j_manuscripts_manutypes`
--

DROP TABLE IF EXISTS `j_manuscripts_manutypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j_manuscripts_manutypes` (
  `manu_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`manu_id`,`type_id`),
  KEY `manu_id` (`manu_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `j_manuscripts_manutypes_ibfk_1` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE,
  CONSTRAINT `j_manuscripts_manutypes_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `d_manutypes` (`type_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j_manuscripts_manutypes`
--

LOCK TABLES `j_manuscripts_manutypes` WRITE;
/*!40000 ALTER TABLE `j_manuscripts_manutypes` DISABLE KEYS */;
INSERT INTO `j_manuscripts_manutypes` VALUES (1,1),(1,2),(2,1),(2,2),(2,3),(2,4),(13,1),(13,2),(13,3),(13,4),(34,1),(34,2);
/*!40000 ALTER TABLE `j_manuscripts_manutypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `j_manuscripts_motifs`
--

DROP TABLE IF EXISTS `j_manuscripts_motifs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `j_manuscripts_motifs` (
  `manu_id` int(11) NOT NULL,
  `motif_id` int(11) NOT NULL,
  PRIMARY KEY (`manu_id`,`motif_id`),
  KEY `manu_id` (`manu_id`),
  KEY `motif_id` (`motif_id`),
  CONSTRAINT `j_manuscripts_motifs_ibfk_1` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE,
  CONSTRAINT `j_manuscripts_motifs_ibfk_2` FOREIGN KEY (`motif_id`) REFERENCES `d_motifs` (`motif_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `j_manuscripts_motifs`
--

LOCK TABLES `j_manuscripts_motifs` WRITE;
/*!40000 ALTER TABLE `j_manuscripts_motifs` DISABLE KEYS */;
INSERT INTO `j_manuscripts_motifs` VALUES (1,1),(1,2),(1,5),(2,1),(2,2),(2,3),(2,5),(13,2),(13,4),(34,1),(34,3);
/*!40000 ALTER TABLE `j_manuscripts_motifs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','21232f297a57a5a743894a0e4a801fc3'),(2,'maktaba','7b7a53e239400a13bd6be6c91c4f6c4e');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-28 13:53:47
