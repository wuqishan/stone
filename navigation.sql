/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50173
Source Host           : localhost:3306
Source Database       : stone

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-08-31 17:57:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for navigation
-- ----------------------------
DROP TABLE IF EXISTS `navigation`;
CREATE TABLE `navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(32) NOT NULL DEFAULT '' COMMENT '只有二级分类和三次分类才会有',
  `spread` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示默认展开，1表示默认关闭',
  `href` varchar(128) NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='头部分类为一级分类，左侧为二级分类和三级分类';
