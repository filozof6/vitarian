-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Ne 22.Jún 2014, 17:52
-- Verzia serveru: 5.6.16
-- Verzia PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `vitarian`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Sťahujem dáta pre tabuľku `category`
--

INSERT INTO `category` (`id`, `name`, `parent`) VALUES
(3, 'Recipes', NULL),
(4, 'Articles', NULL),
(5, 'Deserts', 3),
(6, 'Drinks', 3),
(7, 'Main courses', 3),
(8, 'Smoothies', 3),
(9, 'Snacks', 3),
(10, 'Soups', 3),
(11, 'Others', 3),
(12, 'Example', 4);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `ct_cat`
--

CREATE TABLE IF NOT EXISTS `ct_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `ct_links`
--

CREATE TABLE IF NOT EXISTS `ct_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(2000) COLLATE utf8_bin NOT NULL,
  `url` varchar(1000) COLLATE utf8_bin NOT NULL,
  `author` int(11) DEFAULT NULL,
  `geo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`,`geo`),
  KEY `geo` (`geo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `fos_user_group`
--

CREATE TABLE IF NOT EXISTS `fos_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_583D1F3E5E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `geo`
--

CREATE TABLE IF NOT EXISTS `geo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` double NOT NULL,
  `longtitude` double NOT NULL,
  `title` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(1000) COLLATE utf8_bin NOT NULL,
  `report` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Sťahujem dáta pre tabuľku `geo`
--

INSERT INTO `geo` (`id`, `latitude`, `longtitude`, `title`, `description`, `report`) VALUES
(1, 50, 14, 'Title', 'Popis', 0),
(2, 30, 30, 'Title2', 'Description ', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Sťahujem dáta pre tabuľku `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`) VALUES
(1, 'Apple'),
(2, 'Bannana');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Sťahujem dáta pre tabuľku `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `active`) VALUES
(1, 'roman.zahradnik@zoznam.sk', 1),
(2, 'em@em.com', 1),
(3, 'katka@katka.com', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `newslist`
--

CREATE TABLE IF NOT EXISTS `newslist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `title` varchar(45) NOT NULL,
  `text` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `published` datetime NOT NULL,
  `liked` int(11) DEFAULT NULL,
  `disliked` int(11) DEFAULT NULL,
  `id_author` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_author` (`id_author`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Sťahujem dáta pre tabuľku `post`
--

INSERT INTO `post` (`id`, `title`, `body`, `published`, `liked`, `disliked`, `id_author`, `category`, `photo`) VALUES
(1, 's', 'ss', '2014-06-13 19:29:40', NULL, NULL, NULL, 4, '1402680580photo.png'),
(2, 'ss', 'sssss', '2014-06-18 00:00:00', NULL, NULL, 1, 4, '1402680580photo.png'),
(3, 'ssss', 'sssss', '0000-00-00 00:00:00', NULL, NULL, 1, 4, '1402680580photo.png');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `post_ingredients`
--

CREATE TABLE IF NOT EXISTS `post_ingredients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `ingredients_id` int(11) NOT NULL,
  `amount` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `ingredients_id` (`ingredients_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Sťahujem dáta pre tabuľku `post_ingredients`
--

INSERT INTO `post_ingredients` (`id`, `post_id`, `ingredients_id`, `amount`) VALUES
(1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `date_of_birth` datetime DEFAULT NULL,
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `website` varchar(64) DEFAULT NULL,
  `biography` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `locale` varchar(8) DEFAULT NULL,
  `timezone` varchar(64) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `facebook_uid` varchar(255) DEFAULT NULL,
  `facebook_name` varchar(255) DEFAULT NULL,
  `facebook_data` longtext COMMENT '(DC2Type:json)',
  `twitter_uid` varchar(255) DEFAULT NULL,
  `twitter_name` varchar(255) DEFAULT NULL,
  `twitter_data` longtext COMMENT '(DC2Type:json)',
  `gplus_uid` varchar(255) DEFAULT NULL,
  `gplus_name` varchar(255) DEFAULT NULL,
  `gplus_data` longtext COMMENT '(DC2Type:json)',
  `token` varchar(255) DEFAULT NULL,
  `two_step_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Sťahujem dáta pre tabuľku `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `username_canonical`, `email_canonical`, `enabled`, `salt`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `created_at`, `updated_at`, `date_of_birth`, `firstname`, `lastname`, `website`, `biography`, `gender`, `locale`, `timezone`, `phone`, `facebook_uid`, `facebook_name`, `facebook_data`, `twitter_uid`, `twitter_name`, `twitter_data`, `gplus_uid`, `gplus_name`, `gplus_data`, `token`, `two_step_code`) VALUES
(1, 'filozof', 'roman.zahradnik@zoznam.sk', '123456', '', '', 0, '', NULL, 0, 0, NULL, NULL, NULL, '', 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'katka', 'katka@katka.com', 'zahradka', '', '', 0, '', NULL, 0, 0, NULL, NULL, NULL, '', 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'pokus', 'pokus@pokus.sk', 'UWuWzTtIsdm2a5RBPtGwX7lUQ9+yL4UxWciY7WPfbGKEdrDMmaogbflsY33UlKYHtibQRahyre5d6FW6A/kQ5A==', 'pokus', 'pokus@pokus.sk', 1, '6tiquwo2em4gcc8wk4oc40skw40cks4', '2014-04-04 17:11:43', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'admintest', 'admin@test.com', '8DhoCadUsuhxPXmIHkJd2pd2sKZ8zQAcoCVF3ygWoEepOK6I2e00MbrKQFgqRDB3jNtu/KaEl/r8KLyOeTdqpg==', 'admintest', 'admin@test.com', 1, 'cr8y6dhx2c08wkk8gc4cocsskwgsok', '2014-04-04 17:41:56', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '2014-04-04 17:27:30', '2014-04-04 17:41:56', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL),
(5, 'user', 'user@user.sl', 'Lo3yjr64nF9Eoif/AyARkmzr6n0iErK8dqXzvZzsy7uhD4hStyG4kyjhf0SG4wJELq0PPSpuOn9aDUWf9yM45Q==', 'user', 'user@user.sl', 1, 'mhuwzflgllw444gosok8ssc40sg4c40', NULL, 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, '2014-04-18 13:41:57', '2014-04-18 13:41:57', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL, 'null', NULL, NULL);

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `ct_cat`
--
ALTER TABLE `ct_cat`
  ADD CONSTRAINT `ct_cat_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `ct_cat` (`id`);

--
-- Obmedzenie pre tabuľku `ct_links`
--
ALTER TABLE `ct_links`
  ADD CONSTRAINT `ct_links_ibfk_2` FOREIGN KEY (`geo`) REFERENCES `geo` (`id`),
  ADD CONSTRAINT `ct_links_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`id`);

--
-- Obmedzenie pre tabuľku `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8D9B986D25` FOREIGN KEY (`id_author`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Obmedzenie pre tabuľku `post_ingredients`
--
ALTER TABLE `post_ingredients`
  ADD CONSTRAINT `post_ingredients_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `post_ingredients_ibfk_2` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
