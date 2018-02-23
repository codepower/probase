/*
Navicat MySQL Data Transfer

Source Server         : 本地库
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : appbase

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-01-03 17:30:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ab_admin`
-- ----------------------------
DROP TABLE IF EXISTS `ab_admin`;
CREATE TABLE `ab_admin` (
  `userId` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `encrypt` char(8) NOT NULL DEFAULT '' COMMENT '加密字符串',
  `realname` varchar(32) NOT NULL DEFAULT '真实姓名',
  `lastloginip` varchar(20) NOT NULL DEFAULT '' COMMENT '最后一次登录IP',
  `lastlogintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次登录时间',
  `email` varchar(32) NOT NULL DEFAULT '' COMMENT '邮箱',
  PRIMARY KEY (`userId`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of ab_admin
-- ----------------------------
INSERT INTO `ab_admin` VALUES ('1', 'admin', 'fcaee8ffdbf840855eca703b0f025175', 'FMgzID', '超级管理员', '127.0.0.1', '1454033056', '11111@qq.com');

-- ----------------------------
-- Table structure for `ab_advert`
-- ----------------------------
DROP TABLE IF EXISTS `ab_advert`;
CREATE TABLE `ab_advert` (
  `advertId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `positionId` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '如果是链接，就是链接文字',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片路径',
  `link` varchar(255) NOT NULL DEFAULT '' COMMENT '广告链接',
  `createAt` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`advertId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='广告表';

-- ----------------------------
-- Records of ab_advert
-- ----------------------------
INSERT INTO `ab_advert` VALUES ('1', '0', '这个广告', '', '斯蒂芬斯蒂芬', '1454036455');
INSERT INTO `ab_advert` VALUES ('2', '0', '', 'http://aiyundong.test.com/bms/webapp/attms/uploadfile/2016/0129/20160129014148811.png', '23432432', '1454036552');
INSERT INTO `ab_advert` VALUES ('3', '0', '', 'http://aiyundong.test.com/bms/webapp/attms/uploadfile/2016/0129/20160129015406276.png', '广告标题', '1454046846');

-- ----------------------------
-- Table structure for `ab_config`
-- ----------------------------
DROP TABLE IF EXISTS `ab_config`;
CREATE TABLE `ab_config` (
  `configKey` varchar(128) NOT NULL DEFAULT '' COMMENT '配置键名',
  `configName` varchar(128) NOT NULL DEFAULT '' COMMENT '配型名称',
  `configValue` varchar(255) NOT NULL DEFAULT '' COMMENT '配置内容',
  PRIMARY KEY (`configKey`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='网站配置表';

-- ----------------------------
-- Records of ab_config
-- ----------------------------
INSERT INTO `ab_config` VALUES ('site_name', '网站名字', '铜陵爱运动');

-- ----------------------------
-- Table structure for `ab_member`
-- ----------------------------
DROP TABLE IF EXISTS `ab_member`;
CREATE TABLE `ab_member` (
  `memberId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` char(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `email` varchar(128) NOT NULL COMMENT '注册邮箱',
  `password` char(32) NOT NULL COMMENT '登录密码',
  `encrypt` char(8) NOT NULL DEFAULT '' COMMENT '盐值(8位随机数)',
  `avatar` varchar(128) NOT NULL DEFAULT '' COMMENT '头像',
  `nickname` varchar(64) NOT NULL DEFAULT '' COMMENT '昵称',
  `qqToken` char(64) NOT NULL DEFAULT '' COMMENT 'QQ登录标识',
  `wxToken` char(64) NOT NULL DEFAULT '' COMMENT '微信登录标识',
  `lastLogin` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次登录时间',
  `loginIp` varchar(16) NOT NULL DEFAULT '' COMMENT '最后一次登录IP',
  `registerTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`memberId`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of ab_member
-- ----------------------------
INSERT INTO `ab_member` VALUES ('3', '13366922836', '', '', '', '/upload/avatar/icon3.jpg', '吴玉兰', '', '', '0', '', '1472383061');
INSERT INTO `ab_member` VALUES ('4', '13666878588', '', '', '', '/upload/avatar/icon4.jpg', '上官藏印', '', '', '0', '', '1472383050');
INSERT INTO `ab_member` VALUES ('5', '17985876360', '', '', '', '/upload/avatar/icon5.jpg', '潘盈双', '', '', '0', '', '1472383039');
INSERT INTO `ab_member` VALUES ('6', '18965421212', '', '', '', '/upload/avatar/icon6.jpg', '沐封', '', '', '0', '', '1472383028');
INSERT INTO `ab_member` VALUES ('7', '16882533137', '', '', '', '/upload/avatar/icon7.jpg', '司科', '', '', '0', '', '1472383017');
INSERT INTO `ab_member` VALUES ('8', '13687296601', '', '', '', '/upload/avatar/icon8.jpg', '刘龙', '', '', '0', '', '1472383006');
INSERT INTO `ab_member` VALUES ('9', '15433252269', '', '', '', '/upload/avatar/icon9.jpg', '尚云月', '', '', '0', '', '1472382995');
INSERT INTO `ab_member` VALUES ('10', '13866522287', '', '', '', '/upload/avatar/icon10.jpg', '慕容驰', '', '', '0', '', '1472382984');
INSERT INTO `ab_member` VALUES ('11', '16323329551', '', '', '', '/upload/avatar/icon11.jpg', '凌天', '', '', '0', '', '1472382973');
INSERT INTO `ab_member` VALUES ('12', '13722533698', '', '', '', '/upload/avatar/icon12.jpg', '龙太郎', '', '', '0', '', '1472382962');
INSERT INTO `ab_member` VALUES ('15', '17263245159', '', '', '', '/upload/avatar/icon15.jpg', '十兵卫', '', '', '0', '', '1472382929');
INSERT INTO `ab_member` VALUES ('16', '13462577568', '', '', '', '/upload/avatar/icon16.jpg', '足利君', '', '', '0', '', '1472382918');
INSERT INTO `ab_member` VALUES ('17', '13653245186', '', '', '', '/upload/avatar/icon17.jpg', '弦角', '', '', '0', '', '1472382907');
INSERT INTO `ab_member` VALUES ('18', '17653521687', '', '', '', '/upload/avatar/icon18.jpg', '弦商', '', '', '0', '', '1472382896');
INSERT INTO `ab_member` VALUES ('19', '13542317542', '', '', '', '/upload/avatar/icon19.jpg', '弦宫', '', '', '0', '', '1472382885');
INSERT INTO `ab_member` VALUES ('20', '17772336422', '', '', '', '/upload/avatar/icon20.jpg', '暖男', '', '', '0', '', '1472382874');
INSERT INTO `ab_member` VALUES ('21', '15866423320', '', '', '', '/upload/avatar/icon21.jpg', '曼曼', '', '', '0', '', '1472382863');
INSERT INTO `ab_member` VALUES ('22', '13652145247', '', '', '', '/upload/avatar/icon22.jpg', '可沉', '', '', '0', '', '1472382852');

-- ----------------------------
-- Table structure for `ab_menu`
-- ----------------------------
DROP TABLE IF EXISTS `ab_menu`;
CREATE TABLE `ab_menu` (
  `menuId` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `menuName` varchar(40) NOT NULL DEFAULT '' COMMENT '名称',
  `parentId` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '父键id',
  `accessUrl` char(20) NOT NULL DEFAULT '' COMMENT '方法',
  `iconfont` char(10) NOT NULL DEFAULT '',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '50',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1 显示（默认） 2 隐藏',
  PRIMARY KEY (`menuId`,`menuName`),
  KEY `parentid` (`parentId`),
  KEY `module` (`accessUrl`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of ab_menu
-- ----------------------------
INSERT INTO `ab_menu` VALUES ('1', '网站配置', '0', 'index', '&#xe605;', '50', '1');
INSERT INTO `ab_menu` VALUES ('2', '用户管理', '0', 'index', '&#xe677;', '50', '1');
INSERT INTO `ab_menu` VALUES ('3', '广告管理', '0', 'index', '&#xe60a;', '50', '1');
INSERT INTO `ab_menu` VALUES ('4', '广告位', '3', 'position', '&#xe751;', '50', '1');
INSERT INTO `ab_menu` VALUES ('5', '文章管理', '0', 'index', '&#xec40;', '50', '1');
INSERT INTO `ab_menu` VALUES ('7', '管理员列表', '1', 'index', '&#xe740;', '50', '1');
INSERT INTO `ab_menu` VALUES ('9', '日志管理', '0', 'index', '&#xe68e;', '50', '1');
INSERT INTO `ab_menu` VALUES ('10', '日志列表', '9', 'index', '&#xe63e;', '50', '1');
INSERT INTO `ab_menu` VALUES ('12', '网站信息', '1', 'index', '&#xe6ce;', '50', '1');
INSERT INTO `ab_menu` VALUES ('13', '平台账号', '1', 'weixin', '', '50', '1');
INSERT INTO `ab_menu` VALUES ('14', '文章分类', '5', 'category', '', '50', '1');
INSERT INTO `ab_menu` VALUES ('15', '文章列表', '5', 'index', '', '50', '1');
INSERT INTO `ab_menu` VALUES ('16', '广告列表', '3', 'index', '', '50', '1');
INSERT INTO `ab_menu` VALUES ('17', '用户列表', '2', 'index', '', '50', '1');

-- ----------------------------
-- Table structure for `ab_migration`
-- ----------------------------
DROP TABLE IF EXISTS `ab_migration`;
CREATE TABLE `ab_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ab_migration
-- ----------------------------
INSERT INTO `ab_migration` VALUES ('m000000_000000_base', '1506392421');
INSERT INTO `ab_migration` VALUES ('m130524_201442_init', '1506392461');

-- ----------------------------
-- Table structure for `ab_position`
-- ----------------------------
DROP TABLE IF EXISTS `ab_position`;
CREATE TABLE `ab_position` (
  `positionId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '广告类型(0:文字 1:图片 2:自定义代码)',
  `title` varchar(255) NOT NULL DEFAULT '0' COMMENT '广告位名',
  `content` text NOT NULL COMMENT '自定义广告代码',
  `createAt` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '广告位添加时间',
  PRIMARY KEY (`positionId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='广告位表';

-- ----------------------------
-- Records of ab_position
-- ----------------------------
INSERT INTO `ab_position` VALUES ('1', '0', '首页文字', '', '0');
INSERT INTO `ab_position` VALUES ('2', '2', '首页banner123', 'wefdsfsf', '0');
INSERT INTO `ab_position` VALUES ('3', '0', '这个广告位', '', '0');
INSERT INTO `ab_position` VALUES ('4', '0', '这个广告位123', '', '0');
INSERT INTO `ab_position` VALUES ('5', '1', '发动反攻', '', '0');

-- ----------------------------
-- Table structure for `ab_program`
-- ----------------------------
DROP TABLE IF EXISTS `ab_program`;
CREATE TABLE `ab_program` (
  `programId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '项目ID',
  `programName` varchar(128) NOT NULL DEFAULT '' COMMENT '项目名称',
  `memberId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `createAt` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '项目简介',
  PRIMARY KEY (`programId`) COMMENT '项目ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
-- Records of ab_program
-- ----------------------------

-- ----------------------------
-- Table structure for `ab_restapi`
-- ----------------------------
DROP TABLE IF EXISTS `ab_restapi`;
CREATE TABLE `ab_restapi` (
  `apiId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '接口ID',
  `programId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '项目ID',
  `method` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '请求方式默认0-GET,1-POST',
  `params` varchar(255) NOT NULL DEFAULT '' COMMENT '参数说明',
  `resultData` text COMMENT '返回报文',
  `createAt` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间戳',
  PRIMARY KEY (`apiId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='接口表';

-- ----------------------------
-- Records of ab_restapi
-- ----------------------------

-- ----------------------------
-- Table structure for `ab_storefront`
-- ----------------------------
DROP TABLE IF EXISTS `ab_storefront`;
CREATE TABLE `ab_storefront` (
  `storeId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '店铺ID',
  `storeName` varchar(20) NOT NULL DEFAULT '' COMMENT '店铺名称',
  `memberId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `categoryId` smallint(4) unsigned NOT NULL DEFAULT '0' COMMENT '店铺类别',
  `createAt` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`storeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='店面表';

-- ----------------------------
-- Records of ab_storefront
-- ----------------------------

-- ----------------------------
-- Table structure for `ab_user`
-- ----------------------------
DROP TABLE IF EXISTS `ab_user`;
CREATE TABLE `ab_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ab_user
-- ----------------------------
INSERT INTO `ab_user` VALUES ('1', 'admin', 'oYd7GNxpVsj6v5LDMMyltxDBo8jRz39V', '$2y$13$bBvyG/s6X/OgL.79mhYhxOCiOdB7upgSBVum8.T8eEHG/nLSCRjI6', null, 'admin@admin.com', '10', '1506392512', '1506392512');

-- ----------------------------
-- Table structure for `ab_wxuser`
-- ----------------------------
DROP TABLE IF EXISTS `ab_wxuser`;
CREATE TABLE `ab_wxuser` (
  `unionid` varchar(32) NOT NULL DEFAULT '' COMMENT '跨项目unionid',
  `openid` varchar(32) NOT NULL DEFAULT '' COMMENT 'WEB端微信openid',
  `nickname` varchar(32) NOT NULL DEFAULT '' COMMENT '昵称',
  `headimgurl` varchar(255) NOT NULL DEFAULT '' COMMENT '头像',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-未设置性别,1-男,2-女',
  `country` varchar(32) NOT NULL DEFAULT '' COMMENT '国家',
  `province` varchar(32) NOT NULL DEFAULT '' COMMENT '省份',
  `city` varchar(32) NOT NULL DEFAULT '' COMMENT '城市',
  `subscribe` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subscribe_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关注时间',
  PRIMARY KEY (`unionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='微信信息表';

-- ----------------------------
-- Records of ab_wxuser
-- ----------------------------
