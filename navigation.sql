/*
Navicat MySQL Data Transfer

Source Server         : vagrant
Source Server Version : 50173
Source Host           : localhost:3306
Source Database       : stone

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-09-07 17:01:04
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
  `spread` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示关闭，1表示展开',
  `href` varchar(128) NOT NULL DEFAULT '',
  `level` tinyint(4) DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='头部分类为一级分类，左侧为二级分类和三级分类';

-- ----------------------------
-- Records of navigation
-- ----------------------------
INSERT INTO `navigation` VALUES ('29', '25', '后台权限管理', 'fa-cubes', '1', '', '2', '2', '2017-09-06 17:10:28', '2017-09-06 17:11:43');
INSERT INTO `navigation` VALUES ('19', '0', '内容管理', '', '0', '', '1', '5', '2017-09-03 15:53:11', '2017-09-03 15:53:11');
INSERT INTO `navigation` VALUES ('30', '29', '权限列表', 'fa-navicon', '0', '/admin/auth', '3', '1', '2017-09-06 17:12:57', '2017-09-06 17:12:57');
INSERT INTO `navigation` VALUES ('23', '19', '商品管理', 'fa-cubes', '1', '', '2', '1', '2017-09-06 13:13:37', '2017-09-06 13:13:37');
INSERT INTO `navigation` VALUES ('24', '23', '商品列表', 'fa-navicon', '0', '/admin/goods/index', '3', '1', '2017-09-06 13:14:46', '2017-09-06 13:19:47');
INSERT INTO `navigation` VALUES ('25', '0', '后台管理', '', '0', '', '1', '1', '2017-09-06 13:16:25', '2017-09-06 13:16:25');
INSERT INTO `navigation` VALUES ('26', '25', '导航管理', 'fa-cubes', '1', '', '2', '1', '2017-09-06 13:17:07', '2017-09-06 13:17:07');
INSERT INTO `navigation` VALUES ('28', '26', '导航列表', 'fa-navicon', '0', '/admin/navigation', '3', '1', '2017-09-06 13:18:53', '2017-09-06 13:18:53');
