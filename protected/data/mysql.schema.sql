/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE TABLE IF NOT EXISTS `tbl_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `tbl_lookup` DISABLE KEYS */;
INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
	(1, 'unlisted', 1, 'PostStatus', 1),
	(2, 'public', 2, 'PostStatus', 2),
	(6, '10 мин', 600, 'PostTtl', 1),
	(7, '1 час', 3600, 'PostTtl', 2),
	(8, '3 часа', 10800, 'PostTtl', 3),
	(9, '1 день', 86400, 'PostTtl', 4),
	(10, '1 неделя', 604800, 'PostTtl', 5),
	(11, '1 месяц', 2419200, 'PostTtl', 6),
	(12, 'без огранич', 1000000000, 'PostTtl', 7);
/*!40000 ALTER TABLE `tbl_lookup` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tbl_post` (
  `id` char(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '123',
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) unsigned DEFAULT NULL,
  `author_id` int(11) NOT NULL DEFAULT '0',
  `expire_time` int(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_author` (`author_id`),
  CONSTRAINT `FK_post_author` FOREIGN KEY (`author_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `tbl_post` DISABLE KEYS */;
INSERT INTO `tbl_post` (`id`, `title`, `content`, `status`, `create_time`, `update_time`, `author_id`, `expire_time`) VALUES
	('068067e08dae10f5268361abdb564e0a', 'post5', 'code', 2, 1580138942, 1580138942, 0, 1580225342),
	('0fe84760f833efd763b7b93c3e52d8f0', 'post6', 'code', 2, 1580138955, 1580138955, 0, 1580743755),
	('28816a11f261c64985be4d7f653e30c1', 'post7', 'code', 2, 1580138966, 1580138966, 0, 1580743766),
	('3677ec39bf03344263ef0260ec714d15', 'post4', 'code', 2, 1580138930, 1580138930, 0, 1580225330),
	('404dddf2f28ba8c094708bd4af61883f', 'post1', 'code', 2, 1580138736, 1580138736, 0, 1580225136),
	('477cd2be255ab592a53603aeac8bae0f', 'post11', 'code', 2, 1580139044, 1580139044, 0, 1580743844),
	('48ec77a236fd400ebd85a01e596a15cb', 'post12', 'code', 2, 1580641613, 1580641613, 0, 1581246413),
	('547ade3ba4cd49bc21932d50f60ea1ce', 'post9', 'code', 2, 1580139015, 1580139015, 0, 1580743815),
	('945468abc5092f06593a90cd5ca3f25c', 'post8', 'code', 2, 1580138999, 1580138999, 0, 1580225399),
	('9f8c9f4fb6a78587c01e62cdd466104a', 'post3', 'code', 2, 1580138917, 1580138917, 0, 1580225317),
	('e2e3c129c5febc8d0fd7c5a8bc9d9b53', 'post10', 'code', 2, 1580139031, 1580139031, 0, 1580225431),
	('f382e2502997b98f14481a47c954a63c', 'post2', 'code', 2, 1580138908, 1580138908, 0, 1580225308);
/*!40000 ALTER TABLE `tbl_post` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`, `profile`) VALUES
	(0, 'guest', 'isudifa34i34iu34u4hhj34gh34g_9fdf88df8df8df', 'guest@mail.ru', NULL),
	(1, 'demo', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 'webmaster@example.com', NULL),
	(2, 'qops', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 'webmaste2r@example.com', NULL),
	(5, 'demo2', '$2y$13$saCc.QeW8sU2J7.badmv4uIzRU2je/kN5P3o73/zGih3leByeCFIq', 'demo2', NULL),
	(6, 'demo3', '$2y$13$.eEmppGKz0UurSaIrrk4A.rck2znrgQLMl1lsH0d66q8M59p7VRnq', 'demo3', NULL),
	(7, 'demo4', '$2y$13$P28lCO9U81loj5k38FNN5O8eqM2mRcQYl86ojbwnuOnNSJ26AnHlq', 'demo4', NULL),
	(8, 'demo5', '$2y$13$ngMxVhqw2cxo7yFGWe3V6OznIJEazE/bygFQtzzBp2xQTdpjLpV.2', 'demo5', NULL),
	(9, 'demo6', '$2y$13$PlwpbqbmXAOGG88HzUge8OxC.dA4Qn8d0vGJTa5mkF9zPPwFsVWW.', 'demo6', NULL),
	(10, 'demo7', '$2y$13$jrPfW9Ih1Qk65P9KYwsQQuxiYqPUvbBDj5ZbDvhRjNZbc6NmcD1fy', 'demo7', NULL),
	(11, 'demo9', '$2y$13$DzuVhyhA0Mo9W9g4Mdx0uOM7Qdo7ySc3q.ADpvyChyesZNbfJCbky', 'demo', NULL),
	(12, 'demo10', '$2y$13$BRKoEC5tB0m.f5yfxkJYZ.hi0tWI/V6Vws500KNTbD07NiCYpf9GS', 'jjkljk', NULL),
	(18, 'demo11', '$2y$13$WdU9R/0t5onNGj6vmlBOuOsndMxX/27AIYKW4KaefNoegb6OjPwVW', '111', NULL),
	(19, 'demo11', '$2y$13$Cd238HIzghLKUhXvQFr3oOH/bRbBOJu10rzOOgtrREQlZt1eH2Due', '111', NULL),
	(20, 'demo12', '$2y$13$JZRJ0W73eq419I5aePOVwOMWA1EMZA8TYcyTo.PI4RVgJVQn9YeaC', NULL, NULL),
	(35, 'demo13', '$2y$13$dVCqnropvMuJTLjWJNVM8urxLMtfAyCgyfKQWAtLmHkJL5WIoQ1eS', NULL, NULL),
	(36, '43307412', '$2y$13$/hwQrmfrdFcnDjuHMa6wIerjTKDhAUxSVxtxXxq5aCVlGMKxEGPr.', NULL, NULL);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `generateMD5forID` BEFORE INSERT ON `tbl_post` FOR EACH ROW BEGIN 
SET NEW.`ID` = md5(RAND());
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
