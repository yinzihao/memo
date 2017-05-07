/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : memory

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-05-07 23:34:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_category
-- ----------------------------
DROP TABLE IF EXISTS `m_category`;
CREATE TABLE `m_category` (
  `c_id` int(10) NOT NULL,
  `c_name` varchar(50) DEFAULT NULL,
  `parent_id` int(10) DEFAULT '0',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `c_num` int(10) DEFAULT '0',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for m_memo
-- ----------------------------
DROP TABLE IF EXISTS `m_memo`;
CREATE TABLE `m_memo` (
  `memo_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT ' 备忘编号',
  `user_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT '0',
  `memo_title` varchar(200) DEFAULT NULL,
  `memo_content` text,
  `tag_ids` varchar(200) DEFAULT '',
  `tag_names` varchar(500) DEFAULT '',
  `add_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `data_time` int(10) DEFAULT NULL,
  `plus_num` int(10) DEFAULT '0' COMMENT '加1',
  `minus_num` int(10) DEFAULT '0' COMMENT '减1',
  PRIMARY KEY (`memo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='备忘记忆表';

-- ----------------------------
-- Table structure for m_tag
-- ----------------------------
DROP TABLE IF EXISTS `m_tag`;
CREATE TABLE `m_tag` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'tag编号',
  `tag_name` varchar(50) DEFAULT NULL COMMENT 'tag名称',
  `tag_num` int(10) DEFAULT '0' COMMENT 'tag子集数量',
  `add_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='标签表';

-- ----------------------------
-- Table structure for m_tag_map
-- ----------------------------
DROP TABLE IF EXISTS `m_tag_map`;
CREATE TABLE `m_tag_map` (
  `tag_id` int(10) NOT NULL DEFAULT '0',
  `memo_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tag_id`,`memo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签数据映射表';

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nick_name` varchar(50) DEFAULT NULL,
  `user_mobile` char(11) NOT NULL,
  `add_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';
