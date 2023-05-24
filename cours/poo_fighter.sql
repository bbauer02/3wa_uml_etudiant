-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2023 at 02:09 PM
-- Server version: 5.7.40
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poo_fighter`
--

-- --------------------------------------------------------

--
-- Table structure for table `character`
--

DROP TABLE IF EXISTS `character`;
CREATE TABLE IF NOT EXISTS `character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `health` int(11) NOT NULL DEFAULT '0',
  `mana` int(11) NOT NULL DEFAULT '0',
  `rage` int(11) NOT NULL DEFAULT '0',
  `equipment_id` int(11) NOT NULL,
  `guild_id` int(11) DEFAULT NULL,
  `party_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_CharacterGuild_idx` (`guild_id`),
  KEY `FK_CharacterParty_idx` (`party_id`),
  KEY `FK_CharacterEquipment` (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `guild`
--

DROP TABLE IF EXISTS `guild`;
CREATE TABLE IF NOT EXISTS `guild` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `droprate` int(11) NOT NULL,
  `bonusDamage` int(11) NOT NULL,
  `bonusHp` int(11) NOT NULL,
  `bonusRage` int(11) NOT NULL,
  `bonusMana` int(11) NOT NULL,
  `bonusProtection` int(11) NOT NULL,
  `itemCategory_id` int(11) NOT NULL,
  `itemQuality_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_category_idx` (`itemCategory_id`),
  KEY `FK_quality_idx` (`itemQuality_id`),
  KEY `FK_equipment_idx` (`equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `itemcategory`
--

DROP TABLE IF EXISTS `itemcategory`;
CREATE TABLE IF NOT EXISTS `itemcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `itemquality`
--

DROP TABLE IF EXISTS `itemquality`;
CREATE TABLE IF NOT EXISTS `itemquality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mob`
--

DROP TABLE IF EXISTS `mob`;
CREATE TABLE IF NOT EXISTS `mob` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `health` int(11) NOT NULL,
  `rage` int(11) NOT NULL,
  `mana` int(11) NOT NULL,
  `isElite` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

DROP TABLE IF EXISTS `party`;
CREATE TABLE IF NOT EXISTS `party` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tableloot`
--

DROP TABLE IF EXISTS `tableloot`;
CREATE TABLE IF NOT EXISTS `tableloot` (
  `mob_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  KEY `fk_mob_idx` (`mob_id`),
  KEY `fk_item_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `character`
--
ALTER TABLE `character`
  ADD CONSTRAINT `FK_CharacterEquipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CharacterGuild` FOREIGN KEY (`guild_id`) REFERENCES `guild` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_CharacterParty` FOREIGN KEY (`party_id`) REFERENCES `party` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_category` FOREIGN KEY (`itemCategory_id`) REFERENCES `itemcategory` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_quality` FOREIGN KEY (`itemQuality_id`) REFERENCES `itemquality` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `tableloot`
--
ALTER TABLE `tableloot`
  ADD CONSTRAINT `fk_item` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mob` FOREIGN KEY (`mob_id`) REFERENCES `mob` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
