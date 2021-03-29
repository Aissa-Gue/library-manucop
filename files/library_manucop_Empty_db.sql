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

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.b_subjects
CREATE TABLE IF NOT EXISTS `b_subjects` (
  `subj_id` int(11) NOT NULL,
  `subj_name` varchar(40) NOT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.cabinets
CREATE TABLE IF NOT EXISTS `cabinets` (
  `cabinet_id` int(11) NOT NULL,
  `cabinet_name` varchar(120) NOT NULL,
  PRIMARY KEY (`cabinet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(25) NOT NULL,
  PRIMARY KEY (`city_id`),
  UNIQUE KEY `city_name` (`city_name`),
  UNIQUE KEY `city_name_2` (`city_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `count_id` int(11) NOT NULL AUTO_INCREMENT,
  `count_name` varchar(25) NOT NULL,
  PRIMARY KEY (`count_id`),
  UNIQUE KEY `count_name` (`count_name`),
  UNIQUE KEY `count_name_2` (`count_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.c_authors
CREATE TABLE IF NOT EXISTS `c_authors` (
  `auth_id` int(11) NOT NULL,
  `auth_name` varchar(90) NOT NULL,
  `creation_date` datetime NOT NULL,
  `last_edit_date` datetime NOT NULL,
  PRIMARY KEY (`auth_id`),
  UNIQUE KEY `auth_name` (`auth_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.d_colors
CREATE TABLE IF NOT EXISTS `d_colors` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(10) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.d_manutypes
CREATE TABLE IF NOT EXISTS `d_manutypes` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(10) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.d_motifs
CREATE TABLE IF NOT EXISTS `d_motifs` (
  `motif_id` int(11) NOT NULL,
  `motif_name` varchar(15) NOT NULL,
  PRIMARY KEY (`motif_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.e_manuscripts
CREATE TABLE IF NOT EXISTS `e_manuscripts` (
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

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.f_books_subjects
CREATE TABLE IF NOT EXISTS `f_books_subjects` (
  `book_id` int(11) NOT NULL,
  `subj_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`subj_id`),
  KEY `subj_id` (`subj_id`),
  CONSTRAINT `f_books_subjects_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `a_books` (`book_id`) ON UPDATE CASCADE,
  CONSTRAINT `f_books_subjects_ibfk_2` FOREIGN KEY (`subj_id`) REFERENCES `b_subjects` (`subj_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.g_books_authors
CREATE TABLE IF NOT EXISTS `g_books_authors` (
  `book_id` int(11) NOT NULL,
  `auth_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`auth_id`),
  KEY `auth_id` (`auth_id`),
  CONSTRAINT `g_books_authors_ibfk_1` FOREIGN KEY (`auth_id`) REFERENCES `c_authors` (`auth_id`) ON UPDATE CASCADE,
  CONSTRAINT `g_books_authors_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `a_books` (`book_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table library_manucop_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
