/*
Navicat MySQL Data Transfer

Source Server         : 本地库
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : projcom

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-01-03 17:29:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pc_config`
-- ----------------------------
DROP TABLE IF EXISTS `pc_config`;
CREATE TABLE `pc_config` (
  `configKey` varchar(128) NOT NULL DEFAULT '' COMMENT '配置键名',
  `configName` varchar(128) NOT NULL DEFAULT '' COMMENT '配型名称',
  `configValue` varchar(255) NOT NULL DEFAULT '' COMMENT '配置内容',
  PRIMARY KEY (`configKey`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='网站配置表';

-- ----------------------------
-- Records of pc_config
-- ----------------------------
INSERT INTO `pc_config` VALUES ('siteName', '网站名字', '跨境电商系统');
INSERT INTO `pc_config` VALUES ('alipayParent', '支付宝账号', '');
INSERT INTO `pc_config` VALUES ('alipayToken', '支付宝TOKEN', '');
INSERT INTO `pc_config` VALUES ('alipayMsg', '短信参数', '');
INSERT INTO `pc_config` VALUES ('alipayAccess', '短信TOKEN', '');
INSERT INTO `pc_config` VALUES ('wechatId', '微信支付ID', '');
INSERT INTO `pc_config` VALUES ('wechatToken', '微信支付TOKEN', '');

-- ----------------------------
-- Table structure for `pc_module`
-- ----------------------------
DROP TABLE IF EXISTS `pc_module`;
CREATE TABLE `pc_module` (
  `moduleId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `moduleName` varchar(32) NOT NULL DEFAULT '' COMMENT '模块名称',
  `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父模块ID',
  `describe` varchar(255) NOT NULL DEFAULT '' COMMENT '模块描述',
  `hourCost` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '花费天数(时间成本)',
  `devCount` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '开发人数（人力成本）',
  `salaryCost` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '薪资成本',
  `filePaths` text NOT NULL COMMENT '文件路径（英文逗号隔开）',
  PRIMARY KEY (`moduleId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pc_module
-- ----------------------------

-- ----------------------------
-- Table structure for `pc_project`
-- ----------------------------
DROP TABLE IF EXISTS `pc_project`;
CREATE TABLE `pc_project` (
  `projectId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `projectName` varchar(128) NOT NULL DEFAULT '' COMMENT '项目名',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '项目备注',
  `applyId` int(10) unsigned NOT NULL DEFAULT '0',
  `createAt` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`projectId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pc_project
-- ----------------------------
