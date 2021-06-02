-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.38-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for library_manucop_db
CREATE DATABASE IF NOT EXISTS `library_manucop_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `library_manucop_db`;

-- Dumping structure for table library_manucop_db.a_books
CREATE TABLE IF NOT EXISTS `a_books` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(150) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_edit_date` datetime NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.a_books: ~8 rows (approximately)
DELETE FROM `a_books`;
/*!40000 ALTER TABLE `a_books` DISABLE KEYS */;
INSERT INTO `a_books` (`book_id`, `book_title`, `creation_date`, `last_edit_date`) VALUES
	(1, 'شرح تنقيح الفصول في اختصار المحصول في علم الأصول', '2021-02-18 19:43:57', '2021-03-29 12:38:22'),
	(2, 'مجموع عطية المفيض في حساب المريض وحل الكتاب في حالة المريض', '2021-02-19 10:55:17', '2021-03-29 12:52:31'),
	(3, 'الدر الثمين والمورد المعين في شرح المرشد المعين', '2021-03-09 12:30:22', '2021-03-29 12:37:32'),
	(4, 'المعلقات في أخبار وروايات أهل الدعوة', '2021-03-10 00:22:21', '2021-03-29 12:39:36'),
	(5, 'شرح ألفية ابن مالك', '2021-03-21 15:48:02', '2021-03-29 12:38:36'),
	(6, 'حاشية على شرح الجلال شمس الدين', '2021-03-23 07:47:04', '2021-03-29 12:37:52'),
	(7, 'تخريج الدلالات السمعية على ما كان في عهد رسول الله من الحرف والصنائع والعمالات الشرعية', '2021-03-27 09:35:37', '2021-03-29 13:02:03'),
	(8, 'نثار الجوهر في علم الشرع الأزهر', '2021-03-28 10:08:31', '2021-03-29 12:36:23');
/*!40000 ALTER TABLE `a_books` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.b_subjects
CREATE TABLE IF NOT EXISTS `b_subjects` (
  `subj_id` int(11) NOT NULL,
  `subj_name` varchar(40) NOT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.b_subjects: ~28 rows (approximately)
DELETE FROM `b_subjects`;
/*!40000 ALTER TABLE `b_subjects` DISABLE KEYS */;
INSERT INTO `b_subjects` (`subj_id`, `subj_name`) VALUES
	(1, 'تفسير القرآن الكريم'),
	(2, 'علوم القرآن'),
	(3, 'العقيدة وأصول الدين'),
	(4, 'أصول الفقه'),
	(5, 'فقه العبادات والمعاملات'),
	(6, 'الحديث الشريف وعلومه'),
	(7, 'اللغة العربية وعلومها'),
	(8, 'الدواوين'),
	(9, 'المنطق'),
	(10, 'الفلسفة'),
	(11, 'الرثاء'),
	(12, 'الرؤيا والتعبير'),
	(13, 'الخطب والوصايا'),
	(14, 'التصوف'),
	(15, 'الزهد والرقائق'),
	(16, 'الأخلاق'),
	(17, 'آداب البحث'),
	(18, 'السياسة وتدبير الملك'),
	(19, 'حدود العلم'),
	(21, 'المدائح النبوية'),
	(22, 'الوعظ، النصح، الحكم، التضرع والابتهال'),
	(23, 'الأدعية والأذكار'),
	(24, 'الفضائل'),
	(25, 'التاريخ والجغرافيا'),
	(26, 'الخواص، الجداول والأوفاق'),
	(27, 'العلوم الرياضية'),
	(28, 'العلوم التجريبية'),
	(29, 'المواضيع المتنوعة');
/*!40000 ALTER TABLE `b_subjects` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.cabinets
CREATE TABLE IF NOT EXISTS `cabinets` (
  `cabinet_id` int(11) NOT NULL,
  `cabinet_name` varchar(120) NOT NULL,
  PRIMARY KEY (`cabinet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.cabinets: ~21 rows (approximately)
DELETE FROM `cabinets`;
/*!40000 ALTER TABLE `cabinets` DISABLE KEYS */;
INSERT INTO `cabinets` (`cabinet_id`, `cabinet_name`) VALUES
	(1, 'الخزانة العامّة'),
	(2, 'خزانة الشيخ حَمُّو بابا وْموسى'),
	(3, 'الخزائن الثلاث: الشيخ صالح بن كاسي؛ الحاج بكير بوكَرْموشْ؛ بَاحْمَدْ اشْقَبْقَبْ'),
	(4, 'مكتبة الأستاذ محمّد بن أيوب الحاج سعيد (لَخْبوراتْ)'),
	(5, 'خزانة دار التعليم (للمشايخ الثلاثة: مامَّهْ بنت سليمان بَبَّازْ؛ بكير بن عمر موسى وعْلي؛ بكير بن عليّ موسى وعْلي)'),
	(6, 'خزانة الشيخ القاضي أبي بكر بن مسعود الغرداوي الشهير بالشيخ الحاج بَبْكَرْ'),
	(7, 'خزانة دار التلاميذ (إرْوانْ) بجامع غرداية الكبير'),
	(8, 'الخزائن العمانيّة'),
	(9, 'خزانتيْ الشيخين: بَنوح بن أحمد مَصباح / صالح بن حَمُّو بابُهونْ'),
	(10, 'خزانة الشيخ باسَّهْ بن أَمي موسى الوارجلاني'),
	(11, 'خزانة آل اشْقَبْقَبْ (للناسخ المحترف إبراهيم بن سليمان اشقبقب ونجله صالح'),
	(12, 'خزانتيْ الشيخين: بنوح مَصباح وصالح بابُهون'),
	(13, 'مكتبة معهد الإصلاح بغرداية'),
	(14, 'خزانة الشيخ محمّد بن سليمان بن ادْريسُو اليسجني ونجليه صالح وسليمان'),
	(15, 'مكتبة الأستاذ سليمان بن محمّد بومَعْقَلْ (وارجلان)'),
	(16, 'خزانة البَكري للشيخ العلاّمة عبد الرحمن بن عمر بَكَلِّي'),
	(17, 'خزانة الشيخ باحْمد بن صالح كِيوْكِيوْ'),
	(18, 'خزانة الشيخ الحاج حَمُّو بن إبراهيم تامْتَلْتْ'),
	(19, 'خزانة جمعيّة الشيخ أبي إسحاق اطفيش لخدمة التراث'),
	(20, 'خزانة جمعيّة الشيخ أبي إسحاق اطفيش لخدمة التراث'),
	(21, 'خزانة دار العلم للشيخ الحاج عمر بن الحاج مسعود القراري');
/*!40000 ALTER TABLE `cabinets` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(25) NOT NULL,
  PRIMARY KEY (`city_id`),
  UNIQUE KEY `city_name` (`city_name`),
  UNIQUE KEY `city_name_2` (`city_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.cities: ~7 rows (approximately)
DELETE FROM `cities`;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`city_id`, `city_name`) VALUES
	(5, 'تمنراست'),
	(7, 'جربة'),
	(1, 'غرداية'),
	(4, 'غليزان'),
	(3, 'قالمة'),
	(2, 'قسنطينة'),
	(6, 'وهران');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `count_id` int(11) NOT NULL AUTO_INCREMENT,
  `count_name` varchar(25) NOT NULL,
  PRIMARY KEY (`count_id`),
  UNIQUE KEY `count_name` (`count_name`),
  UNIQUE KEY `count_name_2` (`count_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.countries: ~6 rows (approximately)
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`count_id`, `count_name`) VALUES
	(1, 'الجزائر'),
	(3, 'السعودية'),
	(5, 'تركيا'),
	(2, 'تونس'),
	(6, 'فرنسا'),
	(4, 'مصر');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.c_authors
CREATE TABLE IF NOT EXISTS `c_authors` (
  `auth_id` int(11) NOT NULL,
  `auth_name` varchar(90) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_edit_date` datetime NOT NULL,
  PRIMARY KEY (`auth_id`),
  UNIQUE KEY `auth_name` (`auth_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.c_authors: ~5 rows (approximately)
DELETE FROM `c_authors`;
/*!40000 ALTER TABLE `c_authors` DISABLE KEYS */;
INSERT INTO `c_authors` (`auth_id`, `auth_name`, `creation_date`, `last_edit_date`) VALUES
	(1, 'محمد بن صالح العثيمين', '2021-03-23 08:03:23', '2021-03-29 12:42:19'),
	(2, 'ابراهيم بن محمد رمضان', '2021-02-16 08:35:51', '2021-03-29 12:42:31'),
	(3, 'جلال الدين عبد الرحمان بن أبي بكر السيوطي', '2021-03-23 08:02:30', '2021-03-29 13:02:15'),
	(4, 'أبو محمد عبد الله بن أبي البشير', '2021-03-27 09:40:23', '2021-03-29 12:41:22'),
	(5, 'أبو عبد الله بن محمد بن حسين الرحبي', '2021-03-29 12:42:51', '2021-03-29 12:42:51');
/*!40000 ALTER TABLE `c_authors` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.d_colors
CREATE TABLE IF NOT EXISTS `d_colors` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(10) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.d_colors: ~11 rows (approximately)
DELETE FROM `d_colors`;
/*!40000 ALTER TABLE `d_colors` DISABLE KEYS */;
INSERT INTO `d_colors` (`color_id`, `color_name`) VALUES
	(1, 'البني'),
	(2, 'الأسود'),
	(3, 'الأحمر'),
	(4, 'الآجوري'),
	(5, 'البنفسجي'),
	(6, 'الوردي'),
	(7, 'البرتقالي'),
	(8, 'الأصفر'),
	(9, 'الأخضر'),
	(10, 'الأزرق'),
	(11, 'المذهب');
/*!40000 ALTER TABLE `d_colors` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.d_copiers
CREATE TABLE IF NOT EXISTS `d_copiers` (
  `cop_id` int(11) NOT NULL,
  `full_name` varchar(90) NOT NULL,
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

-- Dumping data for table library_manucop_db.d_copiers: ~8 rows (approximately)
DELETE FROM `d_copiers`;
/*!40000 ALTER TABLE `d_copiers` DISABLE KEYS */;
INSERT INTO `d_copiers` (`cop_id`, `full_name`, `descent1`, `descent2`, `descent3`, `descent4`, `descent5`, `last_name`, `nickname`, `other_name1`, `other_name2`, `other_name3`, `other_name4`, `count_id`, `city_id`, `creation_date`, `last_edit_date`) VALUES
	(1, 'عيسى بن سعد بن محمد', 'الموساوي', 'القسنطيني', 'المالكي', '', '', 'عمار', 'البطاشي', 'عبد القادر بن محمد', 'محمد بن البشير', '', '', 2, 7, '2021-02-18 19:41:07', '2021-03-29 12:23:32'),
	(2, 'المعتصم بن سعيد بن سيف', 'المعولي', 'البوسعيدي', 'العماني', '', '', 'أبو مسلم', '', '', '', '', '', 6, 1, '2021-02-18 19:44:54', '2021-03-29 12:33:35'),
	(3, 'أبو مسلم ناصر بن الحاج محمد', 'الهويريني', 'الإباضي', 'النزوي', 'العماني', '', 'ابن كثير', 'المعتصم بالله', 'مسلم بن الناصر بن أحمد', 'صيغته 2', '', '', 4, 2, '2021-03-10 00:48:34', '2021-04-01 10:58:05'),
	(4, 'عبد الستار بن موسى بن إلياس', 'السمدي', 'النزوي', 'العماني', '', '', 'أبو غدة', 'الكندي', '', '', '', '', 3, 1, '2021-03-10 01:13:22', '2021-03-29 12:32:48'),
	(5, 'إبراهيم بن قاسم بن موسى', 'النفوسي', 'الجربي', '', '', '', 'العبري', '', 'إبراهيم بن قاسم الموساوي', '', '', '', 1, 1, '2021-03-22 14:36:49', '2021-03-29 12:32:08'),
	(6, 'إلياس بن موسى بن أحمد', 'الجربي', 'النفوسي', 'الأمازيغي', '', '', 'أبو القاسم', '', 'إلياس بن موسى بن حمو', '', '', '', 5, 1, '2021-03-25 19:31:15', '2021-03-29 12:31:05'),
	(7, 'قاسم بن بابصالح بن قاسم بن عمر', 'الغرداوي', 'الميزابي', 'المصعبي', 'الأمازيغي', '', 'اشقبقب', '', 'قاسم بن صالح بن عمر', 'يحي بن الحاج أحمد بن عمر', '', '', 4, 4, '2021-03-26 10:44:28', '2021-03-29 12:27:35'),
	(8, 'محمد بن الهاشمي سعود', 'المستغانمي', 'الميزابي', 'الجزائري', '', '', 'الجناوي', '', 'أحمد بن سعود الهاشمي', 'حمو بن سعود الهاشمي', '', '', 1, 5, '2021-03-26 10:57:21', '2021-03-29 12:25:21');
/*!40000 ALTER TABLE `d_copiers` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.d_manutypes
CREATE TABLE IF NOT EXISTS `d_manutypes` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(10) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.d_manutypes: ~4 rows (approximately)
DELETE FROM `d_manutypes`;
/*!40000 ALTER TABLE `d_manutypes` DISABLE KEYS */;
INSERT INTO `d_manutypes` (`type_id`, `type_name`) VALUES
	(1, 'تصحيح'),
	(2, 'تصويب'),
	(3, 'مقابلة'),
	(4, 'تعليق');
/*!40000 ALTER TABLE `d_manutypes` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.d_motifs
CREATE TABLE IF NOT EXISTS `d_motifs` (
  `motif_id` int(11) NOT NULL,
  `motif_name` varchar(15) NOT NULL,
  PRIMARY KEY (`motif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.d_motifs: ~7 rows (approximately)
DELETE FROM `d_motifs`;
/*!40000 ALTER TABLE `d_motifs` DISABLE KEYS */;
INSERT INTO `d_motifs` (`motif_id`, `motif_name`) VALUES
	(1, 'دائرة منقطة'),
	(2, 'فواصل'),
	(3, 'وريدات'),
	(4, 'مراوح'),
	(5, 'براعم'),
	(6, 'فصوص');
/*!40000 ALTER TABLE `d_motifs` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.e_manuscripts
CREATE TABLE IF NOT EXISTS `e_manuscripts` (
  `manu_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `cop_day` varchar(8) NOT NULL,
  `cop_day_nbr` int(11) DEFAULT NULL,
  `cop_month` varchar(15) NOT NULL,
  `cop_syear` int(11) DEFAULT NULL,
  `cop_eyear` int(11) DEFAULT NULL,
  `cop_day_m` varchar(8) NOT NULL,
  `cop_day_nbr_m` int(11) DEFAULT NULL,
  `cop_month_m` varchar(15) NOT NULL,
  `cop_syear_m` int(11) DEFAULT NULL,
  `cop_eyear_m` int(11) DEFAULT NULL,
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

-- Dumping data for table library_manucop_db.e_manuscripts: ~29 rows (approximately)
DELETE FROM `e_manuscripts`;
/*!40000 ALTER TABLE `e_manuscripts` DISABLE KEYS */;
INSERT INTO `e_manuscripts` (`manu_id`, `book_id`, `cop_day`, `cop_day_nbr`, `cop_month`, `cop_syear`, `cop_eyear`, `cop_day_m`, `cop_day_nbr_m`, `cop_month_m`, `cop_syear_m`, `cop_eyear_m`, `cop_place`, `signing`, `cabinet_id`, `cabinet_nbr`, `manu_type`, `index_nbr`, `font`, `font_style`, `regular_lines`, `lines_notes`, `paper_size`, `copied_from`, `copied_to`, `manu_level`, `cop_level`, `rost_completion`, `count_id`, `city_id`, `notes`, `creation_date`, `last_edit_date`) VALUES
	(1, 1, '', NULL, '', 2001, NULL, '', NULL, '', NULL, NULL, 'طريق اللور', 1, 8, 322, 'مج', 324, 'مشرقي', 'المبسوط', 1, 'ملاحظات على المسطرة', 2, 'الأصل المنسوخ منه', 'ابراهيم الخليل', 'حسن', 'جيد', 0, 3, 6, 'ملاحظات أخرى', '2021-02-18 19:50:42', '2021-03-22 12:19:53'),
	(2, 4, '', NULL, '', 2000, 2016, '', NULL, '', NULL, NULL, 'place', 0, NULL, 321, 'مج', 231, 'مغربي', 'المجوهر', 0, '', 1, 'الأصل المنسوخ منه', 'المنسوخ له', 'جيد', 'جيد', 1, 5, 3, 'ملاحظات أخرى', '2021-02-18 20:24:08', '2021-03-21 20:33:36'),
	(3, 1, 'الإثنين', 25, 'جمادى الثانية', 2013, 2013, '', NULL, '', NULL, NULL, '', 0, 21, 0, 'دغ', 0, '', '', 0, '', 3, '', '', '', '', 0, NULL, NULL, '', '2021-02-19 09:39:37', '2021-02-19 09:39:37'),
	(4, 1, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', 1, 3, 0, 'مج', 0, '', '', 0, '', 1, '', '', '', '', 0, NULL, NULL, '', '2021-02-19 09:41:36', '2021-02-19 09:41:36'),
	(5, 2, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', 0, 5, 0, 'مج', 0, '', '', 0, '', 3, '', '', '', '', 0, NULL, NULL, '', '2021-02-19 09:53:38', '2021-03-22 12:24:53'),
	(6, 3, 'الإثنين', NULL, 'جمادى الثانية', NULL, NULL, '', NULL, '', NULL, NULL, 'مكان النسخ', 1, NULL, 0, 'مص', 0, '', '', 0, '', 1, '', '', '', '', 0, NULL, NULL, '', '2021-03-09 23:42:02', '2021-03-09 23:42:02'),
	(7, 1, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, 10, 0, '', 0, '', '', 0, '', 1, '', '', '', '', 0, NULL, 5, '', '2021-02-19 10:31:57', '2021-02-19 10:31:57'),
	(8, 3, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', 0, NULL, 0, 'مج', 0, '', '', 0, '', 1, '', '', '', '', 0, NULL, NULL, '', '2021-03-09 23:52:35', '2021-03-09 23:52:35'),
	(9, 4, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, 16, NULL, 'مج', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, 2, NULL, '', '2021-03-12 00:53:34', '2021-03-12 00:53:34'),
	(10, 4, 'الأربعاء', NULL, 'جمادى الثانية', 2004, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, 'مص', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-12 16:10:47', '2021-03-12 16:10:47'),
	(11, 3, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, 18, NULL, 'مج', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-12 16:22:09', '2021-03-12 16:22:09'),
	(12, 3, 'الثلاثاء', NULL, 'رمضان', 4241, NULL, '', NULL, '', NULL, NULL, 'مكان النسخ', 0, NULL, 32, '', 211, 'مشرقي', 'المدمج', 1, '', 2, 'الأصل المنسوخ منه', 'المنسوخ له', 'متوسط', 'رديء', 1, 2, 7, 'ملاحظات أخرى', '2021-03-21 13:06:49', '2021-03-21 13:06:49'),
	(13, 4, 'الإثنين', NULL, 'جمادى الأولى', 3232, NULL, '', NULL, '', NULL, NULL, 'مكان النسخ', 1, NULL, 32, 'دغ', 241, 'مغربي', 'المسند (الزمامي)', 1, 'ملاحظات على المسطرة', 2, 'الأصل المنسوخ منه', 'المنسوخ له', 'جيد', 'متوسط', 1, 5, 7, 'ملاحظات أخرى', '2021-03-21 17:23:02', '2021-03-21 17:23:02'),
	(14, 3, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, 'مج', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-22 12:03:32', '2021-03-22 12:03:32'),
	(15, 3, 'الثلاثاء', NULL, 'ربيع الثاني', 2213, NULL, '', NULL, '', NULL, NULL, '', 0, NULL, NULL, 'مج', NULL, '', '', 0, '', NULL, '', '', '', '', 0, NULL, NULL, '', '2021-03-22 13:23:20', '2021-03-22 13:24:25'),
	(16, 1, '', NULL, '', 432, 432, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-22 13:28:26', '2021-03-22 13:28:26'),
	(17, 4, '', NULL, '', 211, 211, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-22 13:29:02', '2021-03-22 13:29:02'),
	(18, 4, '', NULL, '', 23, 23, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-22 13:30:34', '2021-03-22 13:30:34'),
	(19, 1, '', NULL, '', NULL, 4322, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-22 13:33:50', '2021-03-22 13:33:50'),
	(27, 5, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-25 19:54:59', '2021-03-25 19:54:59'),
	(28, 6, '', NULL, '', 1230, 1350, '', NULL, '', NULL, NULL, '', 1, 1, 45, 'مج', 33, 'مغربي', 'الكوفي المغربي', 1, '', 3, '', '', 'حسن', 'متوسط', 0, 2, 7, '', '2021-03-25 19:56:20', '2021-03-29 13:13:06'),
	(29, 2, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-26 07:25:29', '2021-03-26 07:25:29'),
	(30, 2, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-26 08:01:16', '2021-03-26 08:01:16'),
	(31, 1, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-26 08:02:30', '2021-03-26 08:02:30'),
	(32, 3, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-26 08:03:49', '2021-03-26 08:03:49'),
	(33, 2, 'الأحد', 8, 'رجب', 1430, 1430, '', NULL, '', NULL, NULL, '', 0, 8, 11, 'دغ', 230, 'مشرقي', 'الثلث المغربي', 0, '', 2, '', '', 'رديء', 'حسن', 0, 6, 4, '', '2021-03-26 08:17:43', '2021-03-29 13:09:20'),
	(34, 6, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-29 12:17:49', '2021-03-29 12:17:49'),
	(35, 5, '', NULL, '', NULL, NULL, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-03-29 12:18:19', '2021-03-29 12:18:19'),
	(36, 4, 'السبت', 6, 'جمادى الثانية', 1346, 1346, '', NULL, '', NULL, NULL, 'غابة أكفادو', 1, 3, 23, 'مص', 320, 'مغربي', 'المجوهر', 1, '', 1, '', '', 'جيد', 'جيد', 0, 1, 5, '', '2021-03-29 12:18:46', '2021-03-29 13:04:59'),
	(37, 1, '', NULL, '', 100, 200, '', NULL, '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, '', '', NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', '2021-05-05 11:19:02', '2021-05-05 12:20:00');
/*!40000 ALTER TABLE `e_manuscripts` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.f_books_subjects
CREATE TABLE IF NOT EXISTS `f_books_subjects` (
  `book_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`subj_id`),
  KEY `subj_id` (`subj_id`),
  CONSTRAINT `f_books_subjects_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `a_books` (`book_id`) ON UPDATE CASCADE,
  CONSTRAINT `f_books_subjects_ibfk_2` FOREIGN KEY (`subj_id`) REFERENCES `b_subjects` (`subj_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.f_books_subjects: ~22 rows (approximately)
DELETE FROM `f_books_subjects`;
/*!40000 ALTER TABLE `f_books_subjects` DISABLE KEYS */;
INSERT INTO `f_books_subjects` (`book_id`, `subj_id`) VALUES
	(1, 1),
	(1, 3),
	(1, 4),
	(1, 5),
	(1, 6),
	(2, 2),
	(2, 6),
	(3, 3),
	(3, 5),
	(4, 4),
	(4, 8),
	(5, 2),
	(5, 3),
	(5, 6),
	(6, 1),
	(6, 2),
	(6, 3),
	(7, 1),
	(7, 2),
	(8, 4),
	(8, 26);
/*!40000 ALTER TABLE `f_books_subjects` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.g_books_authors
CREATE TABLE IF NOT EXISTS `g_books_authors` (
  `book_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`auth_id`),
  KEY `auth_id` (`auth_id`),
  CONSTRAINT `g_books_authors_ibfk_1` FOREIGN KEY (`auth_id`) REFERENCES `c_authors` (`auth_id`) ON UPDATE CASCADE,
  CONSTRAINT `g_books_authors_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `a_books` (`book_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.g_books_authors: ~8 rows (approximately)
DELETE FROM `g_books_authors`;
/*!40000 ALTER TABLE `g_books_authors` DISABLE KEYS */;
INSERT INTO `g_books_authors` (`book_id`, `auth_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(2, 2),
	(3, 2),
	(4, 2),
	(5, 2),
	(6, 1),
	(6, 2),
	(7, 2),
	(7, 3),
	(8, 3);
/*!40000 ALTER TABLE `g_books_authors` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.h_manuscripts_copiers
CREATE TABLE IF NOT EXISTS `h_manuscripts_copiers` (
  `manu_id` int(11) NOT NULL,
  `cop_id` int(11) NOT NULL,
  `name_in_manu` varchar(90) NOT NULL,
  PRIMARY KEY (`manu_id`,`cop_id`),
  KEY `cop_id` (`cop_id`),
  CONSTRAINT `h_manuscripts_copiers_ibfk_1` FOREIGN KEY (`cop_id`) REFERENCES `d_copiers` (`cop_id`) ON UPDATE CASCADE,
  CONSTRAINT `h_manuscripts_copiers_ibfk_2` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.h_manuscripts_copiers: ~37 rows (approximately)
DELETE FROM `h_manuscripts_copiers`;
/*!40000 ALTER TABLE `h_manuscripts_copiers` DISABLE KEYS */;
INSERT INTO `h_manuscripts_copiers` (`manu_id`, `cop_id`, `name_in_manu`) VALUES
	(1, 1, 'name aiisawi ben name in manu'),
	(1, 2, ''),
	(2, 1, ''),
	(2, 2, ''),
	(2, 3, ''),
	(2, 4, ''),
	(3, 1, 'الاسم كما ورد في النسخة'),
	(4, 2, ''),
	(5, 2, ''),
	(6, 1, ''),
	(7, 1, ''),
	(8, 1, ''),
	(9, 2, 'إلياس بن موسى بن أحمد'),
	(10, 4, 'إلياس بن موسى بن أحمد'),
	(11, 3, 'إلياس بن موسى بن أحمد'),
	(12, 1, 'إلياس بن موسى بن أحمد'),
	(13, 4, 'إلياس بن موسى بن أحمد'),
	(14, 1, 'إلياس بن موسى بن أحمد'),
	(15, 2, 'إبراهيم بن قاسم بن موسى'),
	(16, 3, 'إلياس بن موسى بن أحمد'),
	(17, 3, 'قاسم بن بابصالح بن قاسم بن عمر	'),
	(18, 2, 'عيسى بن سعد بن محمد'),
	(19, 3, 'أبو مسلم ناصر بن الحاج محمد'),
	(27, 2, 'عيسى بن سعد بن محمد	'),
	(28, 2, 'المعتصم بن سعيد بن سيف'),
	(29, 2, 'عيسى بن سعد بن محمد	'),
	(30, 1, 'محمد بن الهاشمي سعود	'),
	(30, 2, 'قاسم بن بابصالح بن قاسم بن عمر	'),
	(31, 1, 'إلياس بن موسى بن أحمد	'),
	(31, 2, 'إبراهيم بن قاسم بن موسى'),
	(31, 4, 'عبد الستار بن موسى بن إلياس'),
	(32, 1, 'المعتصم بن سعيد بن سيف'),
	(33, 2, 'المعتصم بن سعيد بن سيف'),
	(33, 3, 'أبو مسلم ناصر بن الحاج محمد'),
	(34, 5, 'إبراهيم بن قاسم بن موسى'),
	(35, 5, 'إبراهيم بن قاسم بن موسى'),
	(36, 6, 'إلياس بن موسى بن أحمد'),
	(37, 1, 'hhh');
/*!40000 ALTER TABLE `h_manuscripts_copiers` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.i_cop_fm
CREATE TABLE IF NOT EXISTS `i_cop_fm` (
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

-- Dumping data for table library_manucop_db.i_cop_fm: ~15 rows (approximately)
DELETE FROM `i_cop_fm`;
/*!40000 ALTER TABLE `i_cop_fm` DISABLE KEYS */;
INSERT INTO `i_cop_fm` (`cop_id`, `cop_fm`, `manu_id`) VALUES
	(1, 2, 1),
	(1, 3, 12),
	(1, 4, 30),
	(1, 4, 31),
	(2, 1, 2),
	(2, 3, 1),
	(2, 3, 30),
	(2, 3, 33),
	(2, 6, 31),
	(3, 1, 2),
	(4, 3, 13),
	(4, 5, 13),
	(5, 3, 34),
	(5, 4, 35),
	(5, 6, 34),
	(6, 3, 36),
	(6, 8, 36);
/*!40000 ALTER TABLE `i_cop_fm` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.j_manuscripts_colors
CREATE TABLE IF NOT EXISTS `j_manuscripts_colors` (
  `manu_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  PRIMARY KEY (`manu_id`,`color_id`),
  KEY `manu_id` (`manu_id`),
  KEY `color_id` (`color_id`),
  CONSTRAINT `j_manuscripts_colors_ibfk_1` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE,
  CONSTRAINT `j_manuscripts_colors_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `d_colors` (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.j_manuscripts_colors: ~13 rows (approximately)
DELETE FROM `j_manuscripts_colors`;
/*!40000 ALTER TABLE `j_manuscripts_colors` DISABLE KEYS */;
INSERT INTO `j_manuscripts_colors` (`manu_id`, `color_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(2, 1),
	(2, 4),
	(2, 7),
	(2, 8),
	(13, 2),
	(13, 3),
	(13, 5),
	(28, 2),
	(33, 1),
	(33, 9),
	(36, 2),
	(36, 5);
/*!40000 ALTER TABLE `j_manuscripts_colors` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.j_manuscripts_manutypes
CREATE TABLE IF NOT EXISTS `j_manuscripts_manutypes` (
  `manu_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`manu_id`,`type_id`),
  KEY `manu_id` (`manu_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `j_manuscripts_manutypes_ibfk_1` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE,
  CONSTRAINT `j_manuscripts_manutypes_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `d_manutypes` (`type_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.j_manuscripts_manutypes: ~16 rows (approximately)
DELETE FROM `j_manuscripts_manutypes`;
/*!40000 ALTER TABLE `j_manuscripts_manutypes` DISABLE KEYS */;
INSERT INTO `j_manuscripts_manutypes` (`manu_id`, `type_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 4),
	(13, 1),
	(13, 2),
	(13, 3),
	(13, 4),
	(28, 1),
	(28, 4),
	(33, 1),
	(33, 3),
	(36, 1),
	(36, 2);
/*!40000 ALTER TABLE `j_manuscripts_manutypes` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.j_manuscripts_motifs
CREATE TABLE IF NOT EXISTS `j_manuscripts_motifs` (
  `manu_id` int(11) NOT NULL,
  `motif_id` int(11) NOT NULL,
  PRIMARY KEY (`manu_id`,`motif_id`),
  KEY `manu_id` (`manu_id`),
  KEY `motif_id` (`motif_id`),
  CONSTRAINT `j_manuscripts_motifs_ibfk_1` FOREIGN KEY (`manu_id`) REFERENCES `e_manuscripts` (`manu_id`) ON UPDATE CASCADE,
  CONSTRAINT `j_manuscripts_motifs_ibfk_2` FOREIGN KEY (`motif_id`) REFERENCES `d_motifs` (`motif_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.j_manuscripts_motifs: ~14 rows (approximately)
DELETE FROM `j_manuscripts_motifs`;
/*!40000 ALTER TABLE `j_manuscripts_motifs` DISABLE KEYS */;
INSERT INTO `j_manuscripts_motifs` (`manu_id`, `motif_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 5),
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 5),
	(13, 2),
	(13, 4),
	(28, 3),
	(33, 3),
	(33, 6),
	(36, 1),
	(36, 2);
/*!40000 ALTER TABLE `j_manuscripts_motifs` ENABLE KEYS */;

-- Dumping structure for table library_manucop_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table library_manucop_db.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
	(2, 'maktaba', '7b7a53e239400a13bd6be6c91c4f6c4e');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
