/*
Navicat MySQL Data Transfer

Source Server         : LocalTest
Source Server Version : 50636
Source Host           : 192.168.0.114:3306
Source Database       : stone

Target Server Type    : MYSQL
Target Server Version : 50636
File Encoding         : 65001

Date: 2017-09-03 15:55:49
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
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='头部分类为一级分类，左侧为二级分类和三级分类';

-- ----------------------------
-- Records of navigation
-- ----------------------------
INSERT INTO `navigation` VALUES ('15', '0', '视频', '', '0', '', '1', '1', '2017-09-03 15:52:03', '2017-09-03 15:52:03');
INSERT INTO `navigation` VALUES ('16', '0', '浏览网站', '', '0', '', '1', '2', '2017-09-03 15:52:20', '2017-09-03 15:52:20');
INSERT INTO `navigation` VALUES ('17', '0', '清除缓存', '', '0', '', '1', '3', '2017-09-03 15:52:46', '2017-09-03 15:52:46');
INSERT INTO `navigation` VALUES ('18', '0', '网站设置', '', '0', '', '1', '4', '2017-09-03 15:52:59', '2017-09-03 15:52:59');
INSERT INTO `navigation` VALUES ('19', '0', '内容管理', '', '0', '', '1', '5', '2017-09-03 15:53:11', '2017-09-03 15:53:11');
INSERT INTO `navigation` VALUES ('20', '0', '后台开发管理', '', '0', '', '1', '7', '2017-09-03 15:53:58', '2017-09-03 15:53:58');
INSERT INTO `navigation` VALUES ('21', '20', '导航管理', '', '1', '', '2', '1', '2017-09-03 15:54:23', '2017-09-03 15:54:23');
INSERT INTO `navigation` VALUES ('22', '21', '导航列表', 'fa-navicon', '0', '', '3', '1', '2017-09-03 15:55:09', '2017-09-03 15:55:09');
