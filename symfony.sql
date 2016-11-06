/*
Navicat MariaDB Data Transfer

Source Server         : local
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : symfony

Target Server Type    : MariaDB
Target Server Version : 100113
File Encoding         : 65001

Date: 2016-11-06 14:20:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fos_user
-- ----------------------------
DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fos_user
-- ----------------------------
INSERT INTO `fos_user` VALUES ('1', 'mishamart', 'mishamart', 'mishamart@rambler.ru', 'mishamart@rambler.ru', '1', 'a8p9e59xk8gscokkco88kgww4sko400', '$2y$13$Mh7E7rYHeJYyOYmrtrBx8ewvJibtXJSurPgfT33vtIQh9WpQWenQ2', '2016-11-03 13:54:50', '0', '0', null, null, null, 'a:0:{}', '0', null);
INSERT INTO `fos_user` VALUES ('2', 'Natan', 'natan', 'han.solo@g.com', 'han.solo@g.com', '1', 'cchzcz12t0oog8848o8gsgc8swc44wg', '$2y$13$RVZFg5O2J/jxA9lCKxVtBex2iRT0q4jOLfC5W//.SdtwA1SsHJoky', '2016-11-06 09:14:01', '0', '0', null, null, null, 'a:0:{}', '0', null);
INSERT INTO `fos_user` VALUES ('3', 'Viktor', 'viktor', 'antel@g.com', 'antel@g.com', '1', 'a8b4h66j6l4cogsw0cssg0owwgkkg4c', '$2y$13$pG7JB1D0fTd6Wi7ZKbv7JOAIEQ9wYpWOAFkTYsMFTbCF//4JEnFVO', '2016-11-06 09:14:58', '0', '0', null, null, null, 'a:0:{}', '0', null);

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'Cookies', '10');
INSERT INTO `product` VALUES ('3', 'Mellon', '30');
INSERT INTO `product` VALUES ('4', 'New product name!', '30');
INSERT INTO `product` VALUES ('5', 'sldkn', '30');
INSERT INTO `product` VALUES ('7', 'Keyboard', '19.99');
INSERT INTO `product` VALUES ('8', 'Keyboard', '25');
INSERT INTO `product` VALUES ('13', 'pr', '23');
INSERT INTO `product` VALUES ('14', 'peech', '25');
