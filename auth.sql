/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50173
Source Host           : localhost:3306
Source Database       : stone

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-09-07 17:21:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth
-- ----------------------------
DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `navigation_id` int(11) NOT NULL DEFAULT '0',
  `auth` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth
-- ----------------------------
INSERT INTO `auth` VALUES ('1', '权限列表', '29', 'auth.index', '2017-09-07 17:18:11', '2017-09-07 17:18:11');
INSERT INTO `auth` VALUES ('2', '权限添加', '29', 'auth.store', '2017-09-07 17:18:53', '2017-09-07 17:18:53');
INSERT INTO `auth` VALUES ('3', '权限编辑', '29', 'auth.update', '2017-09-07 17:19:15', '2017-09-07 17:19:15');
