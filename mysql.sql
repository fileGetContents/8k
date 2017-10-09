/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : banan

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-08-14 17:09:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for banan_travel
-- ----------------------------
DROP TABLE IF EXISTS `banan_travel`;
CREATE TABLE `banan_travel` (
  `travel_id` int(11) NOT NULL AUTO_INCREMENT,
  `travel_image` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT '图片路径序列化',
  `travel_host_image` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '主图',
  `travel_venue` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '集合地点',
  `travel_notice` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '须知',
  `travel_voyage` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '航程',
  `travel_expense` int(11) DEFAULT NULL COMMENT '费用',
  `travel_bourn` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '目的地',
  `travel_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `travel_tag` int(3) DEFAULT '0' COMMENT '0:待审核 10:审核失败 20:审核成功',
  `travel_recommend` int(5) DEFAULT NULL COMMENT '推荐位置(10:香蕉小发现  20:周末不浪费:30 :香蕉精选 )',
  `travel_sort` int(11) DEFAULT NULL COMMENT '排序:越小越排在前面',
  PRIMARY KEY (`travel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of banan_travel
-- ----------------------------
INSERT INTO `banan_travel` VALUES ('2','四川-成都-九寨沟','img/s1.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('3','四川-成都-九寨沟','img/s1.jpg',  'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('4','四川-成都-九寨沟','img/s1.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('5','四川-成都-九寨沟', 'img/s2.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('6', '四川-成都-九寨沟','img/s2.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('7','四川-成都-九寨沟', 'img/s2.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('8','四川-成都-九寨沟', 'img/s2.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('9','北京-九寨沟','img/s2.jpg',  'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('10', '北京-九寨沟','img/s1.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('11','北京-九寨沟', 'img/s1.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('12','北京-九寨沟','img/s5.jpg',  'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('13', '北京-九寨沟','img/s5.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('14','浙江-杭州-九寨沟','img/s4.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('15','浙江-杭州-九寨沟','img/s4.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');
INSERT INTO `banan_travel` VALUES ('16', '浙江-杭州-九寨沟','img/s5.jpg', 'a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}', '浙江省 杭州', '游客须知', '航程', '100', '杭州', '1502701691', '0', '1502701691', '1502701691');

a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}

a:3:{i:0;s:10:"img/s1.jpg";i:1;s:10:"img/s1.jpg";i:2;s:10:"img/s1.jpg";}