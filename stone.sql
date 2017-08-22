/*
Navicat MySQL Data Transfer

Source Server         : LocalTest
Source Server Version : 50636
Source Host           : 192.168.0.114:3306
Source Database       : stone

Target Server Type    : MYSQL
Target Server Version : 50636
File Encoding         : 65001

Date: 2017-08-22 22:07:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `length` int(11) NOT NULL DEFAULT '0' COMMENT '长(cm)',
  `width` int(11) NOT NULL DEFAULT '0' COMMENT '宽(cm)',
  `height` int(11) NOT NULL DEFAULT '0' COMMENT '高(cm)',
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT '重量(kg)',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `introduce` text NOT NULL,
  `show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 不显示，1显示',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `name` (`name`) USING BTREE,
  KEY `price` (`price`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for goods_images
-- ----------------------------
DROP TABLE IF EXISTS `goods_images`;
CREATE TABLE `goods_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `images_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `goods` (`goods_id`) USING BTREE,
  KEY `images` (`images_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  `ext` varchar(8) NOT NULL DEFAULT '',
  `origin_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
