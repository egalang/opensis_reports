-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 28, 2020 at 07:13 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opensis`
--

-- --------------------------------------------------------

--
-- Table structure for table `character_building_nursery1`
--

DROP TABLE IF EXISTS `character_building_nursery1`;
CREATE TABLE IF NOT EXISTS `character_building_nursery1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` decimal(10,0) NOT NULL,
  `marking_period_id` decimal(10,0) NOT NULL,
  `section_id` decimal(10,0) NOT NULL,
  `student_id` decimal(10,0) NOT NULL,
  `c_1` decimal(10,0) DEFAULT NULL,
  `c_2` decimal(10,0) DEFAULT NULL,
  `c_3` decimal(10,0) DEFAULT NULL,
  `c_4` decimal(10,0) DEFAULT NULL,
  `c_5` decimal(10,0) DEFAULT NULL,
  `c_6` decimal(10,0) DEFAULT NULL,
  `c_7` decimal(10,0) DEFAULT NULL,
  `c_8` decimal(10,0) DEFAULT NULL,
  `c_9` decimal(10,0) DEFAULT NULL,
  `c_10` decimal(10,0) DEFAULT NULL,
  `c_11` decimal(10,0) DEFAULT NULL,
  `c_12` decimal(10,0) DEFAULT NULL,
  `c_13` decimal(10,0) DEFAULT NULL,
  `gm_1` decimal(10,0) DEFAULT NULL,
  `gm_2` decimal(10,0) DEFAULT NULL,
  `gm_3` decimal(10,0) DEFAULT NULL,
  `gm_4` decimal(10,0) DEFAULT NULL,
  `fm_1` decimal(10,0) DEFAULT NULL,
  `fm_2` decimal(10,0) DEFAULT NULL,
  `fm_3` decimal(10,0) DEFAULT NULL,
  `fm_4` decimal(10,0) DEFAULT NULL,
  `fm_5` decimal(10,0) DEFAULT NULL,
  `ws_1` decimal(10,0) DEFAULT NULL,
  `ws_2` decimal(10,0) DEFAULT NULL,
  `ws_3` decimal(10,0) DEFAULT NULL,
  `ws_4` decimal(10,0) DEFAULT NULL,
  `spd_1` decimal(10,0) DEFAULT NULL,
  `spd_2` decimal(10,0) DEFAULT NULL,
  `spd_3` decimal(10,0) DEFAULT NULL,
  `spd_4` decimal(10,0) DEFAULT NULL,
  `spd_5` decimal(10,0) DEFAULT NULL,
  `spd_6` decimal(10,0) DEFAULT NULL,
  `spd_7` decimal(10,0) DEFAULT NULL,
  `spd_8` decimal(10,0) DEFAULT NULL,
  `spd_9` decimal(10,0) DEFAULT NULL,
  `shs_1` decimal(10,0) DEFAULT NULL,
  `shs_2` decimal(10,0) DEFAULT NULL,
  `shs_3` decimal(10,0) DEFAULT NULL,
  `shs_4` decimal(10,0) DEFAULT NULL,
  `shs_5` decimal(10,0) DEFAULT NULL,
  `sp_1` decimal(10,0) DEFAULT NULL,
  `sp_2` decimal(10,0) DEFAULT NULL,
  `sp_3` decimal(10,0) DEFAULT NULL,
  `sp_4` decimal(10,0) DEFAULT NULL,
  `sp_5` decimal(10,0) DEFAULT NULL,
  `sp_6` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `school_id` (`school_id`),
  KEY `marking_period_id` (`marking_period_id`),
  KEY `section_id` (`section_id`),
  KEY `student_id` (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
