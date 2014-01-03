/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50516
Source Host           : 127.0.0.1:3306
Source Database       : thinksns

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2012-10-23 16:57:34
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `ts_channel`
-- ----------------------------
DROP TABLE IF EXISTS `ts_channel`;
CREATE TABLE `ts_channel` (
  `feed_channel_link_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `feed_id` int(11) NOT NULL COMMENT '微博ID',
  `channel_category_id` int(11) NOT NULL COMMENT '频道分类ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '审核状态 1审核 0未审核',
  `width` int(11) NOT NULL DEFAULT '0' COMMENT '图片宽度',
  `height` int(11) NOT NULL DEFAULT '0' COMMENT '图片高度',
  `uid` int(11) NOT NULL COMMENT '用户UID',
  PRIMARY KEY (`feed_channel_link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ts_channel
-- ----------------------------

-- ----------------------------
-- Table structure for `ts_channel_category`
-- ----------------------------
DROP TABLE IF EXISTS `ts_channel_category`;
CREATE TABLE `ts_channel_category` (
  `channel_category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '频道分类ID',
  `title` varchar(225) NOT NULL COMMENT '频道分类名称',
  `pid` int(11) NOT NULL COMMENT '父分类ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序字段',
  `ext` text COMMENT '分类配置相关信息序列化',
  PRIMARY KEY (`channel_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ts_channel_category
-- ----------------------------

-- ----------------------------
-- Table structure for `ts_channel_follow`
-- ----------------------------
DROP TABLE IF EXISTS `ts_channel_follow`;
CREATE TABLE `ts_channel_follow` (
  `channel_follow_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '频道关注主键',
  `uid` int(11) NOT NULL COMMENT '关注用户ID',
  `channel_category_id` int(11) NOT NULL COMMENT '频道分类ID',
  PRIMARY KEY (`channel_follow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='频道关注表';

-- ----------------------------
-- Records of ts_channel_follow
-- ----------------------------


-- ----------------------------
-- 语言包
-- ----------------------------
DELETE FROM `ts_lang` WHERE `key` = 'PUBLIC_APPNAME_CHANNEL';
INSERT INTO `ts_lang` (`key`, `appname`, `filetype`, `zh-cn`, `en`, `zh-tw`) VALUES ('PUBLIC_APPNAME_CHANNEL', 'PUBLIC', '0', '频道', 'Channel', '頻道');