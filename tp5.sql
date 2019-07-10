/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-07-10 17:25:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `my_admin_user`;
CREATE TABLE `my_admin_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL COMMENT '部门',
  `gid` int(10) DEFAULT NULL COMMENT '职位',
  `weixin_openid` char(64) DEFAULT NULL,
  `banding_code` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '微信绑定码',
  `role_id` int(11) NOT NULL,
  `aid_title` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '用户名',
  `simple_name` varchar(30) DEFAULT NULL COMMENT '用户简称',
  `nickname` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '密码',
  `birthday` varchar(10) DEFAULT NULL,
  `calendar` tinyint(4) DEFAULT '0' COMMENT '0阳历，1农历',
  `loginnum` int(11) DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) DEFAULT '0' COMMENT '最后登录时间',
  `status` int(1) DEFAULT '0' COMMENT '状态',
  `typeid` int(11) DEFAULT '1' COMMENT '用户角色id',
  `position` varchar(32) DEFAULT NULL,
  `mobile` char(15) NOT NULL COMMENT '用户手机',
  `gender` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `qq` char(32) NOT NULL,
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `weixinid` char(32) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `extattr` text,
  `marriage` tinyint(4) DEFAULT NULL,
  `idcard` varchar(18) DEFAULT NULL,
  `bankcard` varchar(25) DEFAULT NULL,
  `joinday` int(10) DEFAULT NULL,
  `join_from` tinyint(4) DEFAULT NULL,
  `leaveday` int(10) DEFAULT NULL,
  `leave_type` tinyint(4) DEFAULT NULL,
  `leave_why` varchar(100) DEFAULT NULL,
  `description` text,
  `address` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin_user
-- ----------------------------
INSERT INTO `my_admin_user` VALUES ('1', '1', '1', 'oO059v39zsst76IkuiYV3yMvc4Sw', '55229586246', '2', '', 'mikkle', '', '系统维护员', '21232f297a57a5a743894a0e4a801fc3', '', '0', '173', '14.153.203.45', '1485914301', '1', '1', '', '17092610050', '0', '', '3127176962@qq.com', '', '', '', '0', '', '', '0', '0', '0', '0', '', '', '', '0.00', '1480426399', '0');
INSERT INTO `my_admin_user` VALUES ('2', '2', '1', '', '', '1', '', 'admin', '', '超级管理员', '21232f297a57a5a743894a0e4a801fc3', '', '0', '22', '219.134.109.157', '1486449550', '1', '1', '', '13851752194', '1', '', '691301630@qq.com', '', '', '', '0', '', '', '0', '0', '0', '0', '', '', '', '0.00', '1480673171', '1480673171');
INSERT INTO `my_admin_user` VALUES ('3', null, '2', null, '', '0', null, '', null, '', 'beffc46e29d93a4b0ad3765c242d6fc8', null, '0', '0', '', '0', '0', '1', null, '13346673839', '0', '', '', '', null, null, null, null, null, null, null, null, null, null, null, null, '0.00', '0', '0');

-- ----------------------------
-- Table structure for my_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `my_auth_rule`;
CREATE TABLE `my_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_auth_rule
-- ----------------------------
INSERT INTO `my_auth_rule` VALUES ('1', 'admin/index/index', '超级管理', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('2', 'admin/index/form', '表单', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('3', 'admin/index/demo', '测试', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('4', 'admin/index/statistics', '控制台', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('5', 'admin/index/SendMailer', '发送邮件', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('6', 'admin/index/map', '地图', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('7', 'admin/users/index', '所有用户', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('8', 'admin/users/add', '添加用户', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('9', 'admin/users/edit', '编辑用户', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('10', 'admin/users/del', '删除用户', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('11', 'admin/users/cache', '清楚缓存', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('12', 'admin/column/index', '栏目首页', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('13', 'admin/column/edit', '编辑栏目', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('14', 'admin/column/del', '删除栏目', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('15', 'admin/column/add', '栏目添加', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('16', 'admin/column/columnUpImg', '上传栏目图片', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('17', 'admin/column/status', '状态修改', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('18', 'admin/column/sort', '栏目排序', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('19', 'admin/detail/index', '后台所有商品', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('20', 'admin/detail/edit', '商品编辑', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('21', 'admin/detail/del', '商品删除', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('22', 'admin/detail/add', '商品添加', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('23', 'admin/detail/columnUpImg', '商品图片上传', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('24', 'admin/detail/status', '商品状态', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('25', 'admin/detail/sort', '商品排序', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('26', 'admin/ShopCart/cart', '购物车首页', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('27', 'admin/ShopCart/add', '购物车添加', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('28', 'admin/ShopCart/edit', '购物车修改', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('29', 'admin/ShopCart/del', '购物车删除', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('30', 'admin/ShopCart/pay', '商品购买', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('31', 'admin/ShopCart/order', '购物车订单', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('32', 'admin/ShopCart/setAddress', '收货地址修改', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('33', 'admin/ShopCart/status', '购物车状态', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('34', 'admin/ShopCart/sort', '购物车排序', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('35', 'admin/rules/index', '权限首页', '1', '1', '');

-- ----------------------------
-- Table structure for my_column
-- ----------------------------
DROP TABLE IF EXISTS `my_column`;
CREATE TABLE `my_column` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品栏目id主建',
  `pid` int(10) NOT NULL DEFAULT '0' COMMENT '父级栏目',
  `uid` smallint(5) NOT NULL COMMENT '用户id',
  `title` char(50) NOT NULL COMMENT '栏目名',
  `img` varchar(255) DEFAULT NULL,
  `keyword` char(255) DEFAULT NULL COMMENT '栏目关键词',
  `description` char(255) DEFAULT NULL COMMENT '栏目描述',
  `create_time` int(11) unsigned NOT NULL,
  `sort` char(5) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` smallint(3) NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`,`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_column
-- ----------------------------
INSERT INTO `my_column` VALUES ('1', '0', '2', '奶粉辅食', '', '奶粉辅食关键词', '奶粉辅食描述', '1554281403', '1', '1');
INSERT INTO `my_column` VALUES ('2', '0', '2', '纸尿裤', '', '纸尿裤', '纸尿裤', '1554281512', '2', '1');
INSERT INTO `my_column` VALUES ('3', '0', '2', '洗护用品', '', '洗护用品关键词', '洗护用品描述', '1554281602', '3', '1');
INSERT INTO `my_column` VALUES ('4', '0', '2', '儿童玩具', '', '儿童玩具关键词', '儿童玩具描述', '1554281796', '4', '1');
INSERT INTO `my_column` VALUES ('5', '0', '2', '车窗座椅', '', '车窗座椅关键词', '车窗座椅描述', '1554281889', '5', '1');
INSERT INTO `my_column` VALUES ('6', '0', '2', '儿童童鞋', '', '儿童童鞋', '儿童童鞋', '1554281935', '6', '1');
INSERT INTO `my_column` VALUES ('7', '0', '2', '儿童图片', '', '儿童图片', '儿童图片', '1554281955', '7', '1');
INSERT INTO `my_column` VALUES ('8', '0', '2', '孕妈专区', '', '孕妈专区', '孕妈专区', '1554281972', '8', '1');
INSERT INTO `my_column` VALUES ('9', '1', '2', '奶粉', '', '奶粉', '奶粉', '1554282642', '50', '1');
INSERT INTO `my_column` VALUES ('10', '1', '2', '辅食', '', '辅食', '辅食', '1554282659', '50', '1');
INSERT INTO `my_column` VALUES ('11', '1', '2', '营养品', '', '营养品', '营养品', '1554282681', '50', '1');
INSERT INTO `my_column` VALUES ('12', '2', '2', '纸尿裤', '\\public\\uploads\\20190403\\8c3884293e972b9c07f86bb2c2ecd2af.jpg', '纸尿裤', '纸尿裤', '1554282934', '50', '1');
INSERT INTO `my_column` VALUES ('13', '2', '2', '婴儿湿巾', '\\public\\uploads\\20190403\\eba3ac6a7ecec4f4c76b3f22632aa6a8.jpg', '婴儿湿巾', '婴儿湿巾', '1554283050', '50', '1');
INSERT INTO `my_column` VALUES ('14', '3', '2', '母婴洗护用品', '', '母婴洗护用品', '母婴洗护用品', '1554467900', '50', '1');
INSERT INTO `my_column` VALUES ('15', '3', '2', '孕婴童用品', '', '孕婴童用品', '孕婴童用品', '1554467913', '50', '1');
INSERT INTO `my_column` VALUES ('16', '4', '2', '婴幼玩具', '', '婴幼玩具', '婴幼玩具', '1554467935', '50', '1');
INSERT INTO `my_column` VALUES ('17', '4', '2', '遥控玩具', '', '遥控玩具', '遥控玩具', '1554467946', '50', '1');
INSERT INTO `my_column` VALUES ('18', '4', '2', '积木拼插', '', '积木拼插', '积木拼插', '1554467959', '50', '1');
INSERT INTO `my_column` VALUES ('19', '5', '2', '婴儿推车', '', '婴儿推车', '婴儿推车', '1554467980', '50', '1');
INSERT INTO `my_column` VALUES ('20', '5', '2', '儿童安全座骑', '', '儿童安全座骑', '儿童安全座骑', '1554467992', '50', '1');
INSERT INTO `my_column` VALUES ('21', '6', '2', '童装', '', '童装', '童装', '1554468029', '50', '1');
INSERT INTO `my_column` VALUES ('22', '6', '2', '童鞋', '', '童鞋', '童鞋', '1554468039', '50', '1');
INSERT INTO `my_column` VALUES ('23', '6', '2', '婴童内衣及配饰', '', '婴童内衣及配饰', '婴童内衣及配饰', '1554468049', '50', '1');
INSERT INTO `my_column` VALUES ('24', '7', '2', '0-2岁', '', '0-2岁', '0-2岁', '1554468066', '50', '1');
INSERT INTO `my_column` VALUES ('25', '7', '2', '早教启蒙', '', '早教启蒙', '早教启蒙', '1554468076', '50', '1');
INSERT INTO `my_column` VALUES ('26', '7', '2', '孕产育儿', '', '孕产育儿', '孕产育儿', '1554468086', '50', '1');
INSERT INTO `my_column` VALUES ('27', '8', '2', '孕妇装', '', '孕妇装', '孕妇装', '1554468100', '50', '1');
INSERT INTO `my_column` VALUES ('28', '8', '2', '背婴带', '', '背婴带', '背婴带', '1554468110', '50', '1');
INSERT INTO `my_column` VALUES ('29', '8', '2', '母婴服务', '', '母婴服务', '母婴服务', '1554468119', '50', '1');

-- ----------------------------
-- Table structure for my_detail
-- ----------------------------
DROP TABLE IF EXISTS `my_detail`;
CREATE TABLE `my_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id主建',
  `cid` int(11) NOT NULL COMMENT '和商品栏目表的id字段关联',
  `uid` smallint(5) NOT NULL COMMENT '用户id',
  `name` varchar(255) NOT NULL COMMENT '商品名称',
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `img` varchar(255) NOT NULL DEFAULT '/public/static/images/default.jpg' COMMENT '商品图片',
  `sum` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `new_price` float(6,2) NOT NULL DEFAULT '0.00' COMMENT '活动之后的价格',
  `price` float(6,2) NOT NULL DEFAULT '1.00' COMMENT '商品价格',
  `payman` smallint(8) NOT NULL DEFAULT '0' COMMENT '付款人数',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `sort` char(5) NOT NULL DEFAULT '50',
  `status` smallint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`cid`,`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_detail
-- ----------------------------
INSERT INTO `my_detail` VALUES ('1', '21', '2', '宝宝五彩袜棉质舒服', '宝宝五彩袜棉质舒服', '宝宝五彩袜棉质舒服', null, '\\public\\uploads\\20190405\\829aa4b62b9de6c8d3905d00b81e06be.jpg', '37', '2.00', '49.00', '33', '1554468256', '1557130763', '50', '1');
INSERT INTO `my_detail` VALUES ('2', '21', '2', '小白兔童装', '小白兔童装', '小白兔童装', null, '\\public\\uploads\\20190405\\07d5229a5a9b63547fc2661556850cc9.jpg', '23', '1.00', '388.00', '23', '1554468350', '1557130765', '50', '1');
INSERT INTO `my_detail` VALUES ('3', '9', '2', '黄色衣服', '黄色衣服', '黄色衣服', '<p><strong>狗蛋</strong></p>', '\\public\\uploads\\20190411\\12b3ae6381b3865fb73cf331fac1bed5.png', '98', '3.00', '0.01', '47', '1554948742', '1557130766', '50', '1');
INSERT INTO `my_detail` VALUES ('4', '21', '2', '黄色小鸭童装', '黄色童装', '黄色童装', '<p>妈卖批，就是不加进去。<strong>我也不小的啦</strong></p>', '\\public\\uploads\\20190411\\12b3ae6381b3865fb73cf331fac1bed5.png', '22', '3.01', '99.00', '40', '1554949357', '1557896723', '50', '1');
INSERT INTO `my_detail` VALUES ('5', '23', '2', '黑色童鞋', '灰色的童鞋，灰色的童装，傻傻的孩子，宽宽的胸膛。', '灰色的童鞋，灰色的童装，傻傻的孩子，宽宽的胸膛。', '<p style=\"text-align: center;\"><strong>商品详情：</strong></p><p style=\"text-align: center;\"><strong><img src=\"/ueditor/php/upload/image/20190506/1557126608104851.jpg\" title=\"1557126608104851.jpg\" alt=\"1557126608104851.jpg\" width=\"800\" height=\"322\"/></strong></p><p>春季换新装，新鞋先穿上。</p><p><img src=\"/ueditor/php/upload/image/20190506/1557126656137490.jpg\" title=\"1557126656137490.jpg\" alt=\"1557126656137490.jpg\" width=\"300\" height=\"230\"/><img src=\"/ueditor/php/upload/image/20190506/1557126697841185.jpg\" title=\"1557126697841185.jpg\" alt=\"1557126697841185.jpg\" width=\"300\" height=\"276\"/></p><p><br/></p><p>不知道好不好，试试就知道。</p><p style=\"text-align: center;\"><img src=\"/ueditor/php/upload/image/20190506/1557126745707528.jpg\" title=\"1557126745707528.jpg\" alt=\"1557126745707528.jpg\" width=\"800\" height=\"430\"/></p>', '\\public\\uploads\\20190506\\f8af55e474aeca9e8afd140dddcbbdb5.jpg', '100', '0.00', '99.00', '0', '1557126803', '1557130768', '50', '1');
INSERT INTO `my_detail` VALUES ('6', '21', '2', '黄色小鸭童装', '黄色童装', '黄色童装', '<p>妈卖批，就是不加进去。<strong>我也不小的啦</strong></p>', '\\public\\uploads\\20190411\\12b3ae6381b3865fb73cf331fac1bed5.png', '100', '0.00', '99.00', '4', '1554949357', '1557130768', '50', '1');

-- ----------------------------
-- Table structure for my_group
-- ----------------------------
DROP TABLE IF EXISTS `my_group`;
CREATE TABLE `my_group` (
  `gid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupName` varchar(30) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `rules` char(200) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_group
-- ----------------------------
INSERT INTO `my_group` VALUES ('1', '管理员', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40');
INSERT INTO `my_group` VALUES ('2', '注册会员', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40');

-- ----------------------------
-- Table structure for my_order
-- ----------------------------
DROP TABLE IF EXISTS `my_order`;
CREATE TABLE `my_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `uid` int(11) NOT NULL,
  `ispay` enum('2','1','0') NOT NULL DEFAULT '0' COMMENT '订单支付状态值字段名，0支付准备，1支付成功，2支付失败',
  `amount` float(10,2) NOT NULL COMMENT '订单金额值字段名',
  `create_time` int(11) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of my_order
-- ----------------------------
INSERT INTO `my_order` VALUES ('1', '1562578720KJMlFTQn6LIG2Ood3qD5gr', '2', '0', '0.01', null, '1');
INSERT INTO `my_order` VALUES ('2', '1562578749ekqHxBOFWN8vplYZh4Cf6L', '2', '2', '0.02', null, '1');

-- ----------------------------
-- Table structure for my_shop_address
-- ----------------------------
DROP TABLE IF EXISTS `my_shop_address`;
CREATE TABLE `my_shop_address` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '主建',
  `uid` smallint(5) unsigned NOT NULL COMMENT '用户id',
  `address` varchar(255) DEFAULT NULL COMMENT '收货地址',
  `action` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0为否，1为师',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_shop_address
-- ----------------------------
INSERT INTO `my_shop_address` VALUES ('1', '2', '长远', '0');
INSERT INTO `my_shop_address` VALUES ('2', '2', '郑州', '0');
INSERT INTO `my_shop_address` VALUES ('3', '2', '新乡', '1');
INSERT INTO `my_shop_address` VALUES ('4', '1', '西藏', '1');

-- ----------------------------
-- Table structure for my_shop_cart
-- ----------------------------
DROP TABLE IF EXISTS `my_shop_cart`;
CREATE TABLE `my_shop_cart` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `order_id` varchar(50) DEFAULT NULL COMMENT '订单id，默认为空',
  `name` varchar(255) NOT NULL COMMENT '商品名字',
  `is_pay` enum('-2','-1','1','0') NOT NULL DEFAULT '0' COMMENT '是否付款,-2是没有货，-1是付款失败，1为成功，0为加入购物车',
  `price` float(6,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `sum` smallint(5) NOT NULL DEFAULT '1' COMMENT '商品购买个数',
  `create_time` int(11) DEFAULT NULL,
  `sort` char(5) NOT NULL DEFAULT '50' COMMENT '排序',
  `status` smallint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_shop_cart
-- ----------------------------
INSERT INTO `my_shop_cart` VALUES ('1', '2', '1562578720KJMlFTQn6LIG2Ood3qD5gr', '黄色衣服', '-2', '0.01', '1', '1562578719', '50', '1');
INSERT INTO `my_shop_cart` VALUES ('2', '2', '1562578749ekqHxBOFWN8vplYZh4Cf6L', '黄色衣服', '0', '0.01', '2', '1562578748', '50', '1');
