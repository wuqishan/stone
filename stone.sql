/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50173
Source Host           : localhost:3306
Source Database       : stone

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-09-19 17:18:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bg_admin
-- ----------------------------
DROP TABLE IF EXISTS `bg_admin`;
CREATE TABLE `bg_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(32) NOT NULL DEFAULT '',
  `is_super` tinyint(1) NOT NULL DEFAULT '0',
  `last_login_time` int(11) NOT NULL DEFAULT '0',
  `last_login_ip` varchar(32) NOT NULL DEFAULT '',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_admin
-- ----------------------------

-- ----------------------------
-- Table structure for bg_auth
-- ----------------------------
DROP TABLE IF EXISTS `bg_auth`;
CREATE TABLE `bg_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `navigation_id` int(11) NOT NULL DEFAULT '0',
  `auth` varchar(255) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_auth
-- ----------------------------
INSERT INTO `bg_auth` VALUES ('1', '权限列表', '29', 'auth.index', '2017-09-07 17:18:11', '2017-09-07 17:18:11');
INSERT INTO `bg_auth` VALUES ('2', '权限添加', '29', 'auth.store|auth.create', '2017-09-07 17:18:53', '2017-09-07 17:18:53');
INSERT INTO `bg_auth` VALUES ('3', '权限编辑', '29', 'auth.update|auth.edit', '2017-09-07 17:19:15', '2017-09-07 17:19:15');
INSERT INTO `bg_auth` VALUES ('4', '权限删除', '29', 'auth.destroy', '2017-09-08 14:47:03', '2017-09-08 14:47:03');
INSERT INTO `bg_auth` VALUES ('5', '商品列表', '23', 'goods.index', '2017-09-08 14:48:19', '2017-09-08 14:48:19');
INSERT INTO `bg_auth` VALUES ('6', '商品更新', '23', 'goods.update|goods.edit', '2017-09-08 14:48:49', '2017-09-08 14:48:49');
INSERT INTO `bg_auth` VALUES ('7', '商品添加', '23', 'goods.store|goods.create', '2017-09-08 14:49:28', '2017-09-08 14:49:28');
INSERT INTO `bg_auth` VALUES ('8', '商品删除', '23', 'goods.delete', '2017-09-08 14:49:44', '2017-09-08 14:49:44');
INSERT INTO `bg_auth` VALUES ('9', '商品图片上传', '23', 'admin.image.upload', '2017-09-08 14:51:05', '2017-09-08 14:51:05');
INSERT INTO `bg_auth` VALUES ('10', '商品图片删除', '23', 'admin.image.delete', '2017-09-08 14:51:24', '2017-09-08 14:51:24');
INSERT INTO `bg_auth` VALUES ('11', '后台导航列表', '26', 'navigation.index', '2017-09-08 14:51:50', '2017-09-08 14:51:50');
INSERT INTO `bg_auth` VALUES ('12', '后台导航添加', '26', 'navigation.store|navigation.create', '2017-09-08 14:52:11', '2017-09-08 14:52:11');
INSERT INTO `bg_auth` VALUES ('13', '后台导航更新', '26', 'navigation.update|navigation.edit', '2017-09-08 14:52:38', '2017-09-08 14:52:38');
INSERT INTO `bg_auth` VALUES ('14', '后台导航删除', '26', 'navigation.destroy', '2017-09-08 14:53:04', '2017-09-08 16:27:40');

-- ----------------------------
-- Table structure for bg_goods
-- ----------------------------
DROP TABLE IF EXISTS `bg_goods`;
CREATE TABLE `bg_goods` (
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_goods
-- ----------------------------
INSERT INTO `bg_goods` VALUES ('30', '大理石', '12', '33', '44', '12', '23.00', '', '1', '2017-08-30 15:12:34', '2017-08-30 15:12:34');
INSERT INTO `bg_goods` VALUES ('31', '房子', '21', '34', '23', '111', '33.00', '', '1', '2017-08-30 15:12:56', '2017-08-30 15:12:56');
INSERT INTO `bg_goods` VALUES ('32', '汽车', '123', '34', '45', '11', '23.00', '', '1', '2017-08-30 15:13:09', '2017-08-30 15:13:09');
INSERT INTO `bg_goods` VALUES ('33', '小草', '12', '34', '44', '33', '22.00', '', '1', '2017-08-30 15:13:22', '2017-08-30 15:13:22');
INSERT INTO `bg_goods` VALUES ('34', '玻璃', '12', '23', '34', '12', '3.00', '', '1', '2017-08-30 15:13:37', '2017-08-30 15:13:37');
INSERT INTO `bg_goods` VALUES ('35', '自行车', '12', '33', '22', '12', '23.00', '', '1', '2017-08-30 15:13:52', '2017-08-30 15:13:52');
INSERT INTO `bg_goods` VALUES ('36', '斑马线', '123', '34', '23', '434', '22.00', '', '1', '2017-08-30 15:14:06', '2017-08-30 15:14:06');
INSERT INTO `bg_goods` VALUES ('37', '火车', '122', '33', '44', '232', '11.00', '', '1', '2017-08-30 15:14:18', '2017-08-30 15:14:18');
INSERT INTO `bg_goods` VALUES ('38', '电脑', '21', '3', '22', '23', '11.00', '', '0', '2017-08-30 15:14:45', '2017-08-30 15:51:41');
INSERT INTO `bg_goods` VALUES ('39', '水杯', '12', '23', '34', '32', '1.00', '', '1', '2017-08-30 15:14:59', '2017-08-30 15:51:44');
INSERT INTO `bg_goods` VALUES ('40', '雨伞', '11', '11', '22', '12', '32.00', '', '0', '2017-08-30 15:15:09', '2017-08-30 15:51:44');

-- ----------------------------
-- Table structure for bg_goods_images
-- ----------------------------
DROP TABLE IF EXISTS `bg_goods_images`;
CREATE TABLE `bg_goods_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `images_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `goods` (`goods_id`) USING BTREE,
  KEY `images` (`images_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_goods_images
-- ----------------------------

-- ----------------------------
-- Table structure for bg_group
-- ----------------------------
DROP TABLE IF EXISTS `bg_group`;
CREATE TABLE `bg_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `comments` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_group
-- ----------------------------
INSERT INTO `bg_group` VALUES ('1', '编辑', '编辑人员的权限', '2017-09-19 16:59:48', '2017-09-19 16:59:48');
INSERT INTO `bg_group` VALUES ('2', '产品', '产品人员的权限', '2017-09-19 17:00:02', '2017-09-19 17:00:02');
INSERT INTO `bg_group` VALUES ('3', '管理', '管理员拥有的权限', '2017-09-19 17:00:16', '2017-09-19 17:00:16');

-- ----------------------------
-- Table structure for bg_images
-- ----------------------------
DROP TABLE IF EXISTS `bg_images`;
CREATE TABLE `bg_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  `ext` varchar(8) NOT NULL DEFAULT '',
  `origin_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_images
-- ----------------------------

-- ----------------------------
-- Table structure for bg_navigation
-- ----------------------------
DROP TABLE IF EXISTS `bg_navigation`;
CREATE TABLE `bg_navigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(32) NOT NULL DEFAULT '' COMMENT '只有二级分类和三次分类才会有',
  `spread` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示关闭，1表示展开',
  `href` varchar(128) NOT NULL DEFAULT '',
  `level` tinyint(4) DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='头部分类为一级分类，左侧为二级分类和三级分类';

-- ----------------------------
-- Records of bg_navigation
-- ----------------------------
INSERT INTO `bg_navigation` VALUES ('34', '29', '权限组列表', 'fa-navicon', '0', '/admin/group', '3', '2', '2017-09-08 17:08:57', '2017-09-19 16:36:43');
INSERT INTO `bg_navigation` VALUES ('29', '25', '权限管理', 'fa-cubes', '0', '', '2', '2', '2017-09-06 17:10:28', '2017-09-08 16:40:42');
INSERT INTO `bg_navigation` VALUES ('19', '0', '内容管理', '', '0', '', '1', '5', '2017-09-03 15:53:11', '2017-09-03 15:53:11');
INSERT INTO `bg_navigation` VALUES ('30', '29', '权限列表', 'fa-navicon', '0', '/admin/auth', '3', '1', '2017-09-06 17:12:57', '2017-09-06 17:12:57');
INSERT INTO `bg_navigation` VALUES ('33', '29', '管理员列表', 'fa-navicon', '0', '/admin/admin', '3', '2', '2017-09-08 16:42:49', '2017-09-08 16:42:49');
INSERT INTO `bg_navigation` VALUES ('23', '19', '商品管理', 'fa-cubes', '1', '', '2', '1', '2017-09-06 13:13:37', '2017-09-06 13:13:37');
INSERT INTO `bg_navigation` VALUES ('24', '23', '商品列表', 'fa-navicon', '0', '/admin/goods/index', '3', '1', '2017-09-06 13:14:46', '2017-09-06 13:19:47');
INSERT INTO `bg_navigation` VALUES ('25', '0', '后台管理', '', '0', '', '1', '1', '2017-09-06 13:16:25', '2017-09-06 13:16:25');
INSERT INTO `bg_navigation` VALUES ('26', '25', '导航管理', 'fa-cubes', '0', '', '2', '100', '2017-09-06 13:17:07', '2017-09-08 16:30:37');
INSERT INTO `bg_navigation` VALUES ('28', '26', '导航列表', 'fa-navicon', '0', '/admin/navigation', '3', '1', '2017-09-06 13:18:53', '2017-09-06 13:18:53');
