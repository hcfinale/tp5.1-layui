/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : tp5

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-04-04 14:59:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for my_admin_access
-- ----------------------------
DROP TABLE IF EXISTS `my_admin_access`;
CREATE TABLE `my_admin_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin_access
-- ----------------------------
INSERT INTO `my_admin_access` VALUES ('1', '1');
INSERT INTO `my_admin_access` VALUES ('2', '1');
INSERT INTO `my_admin_access` VALUES ('3', '1');

-- ----------------------------
-- Table structure for my_admin_department
-- ----------------------------
DROP TABLE IF EXISTS `my_admin_department`;
CREATE TABLE `my_admin_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin_department
-- ----------------------------
INSERT INTO `my_admin_department` VALUES ('1', '行政部', '行政部', '1', '1478228668', '1478228668');
INSERT INTO `my_admin_department` VALUES ('2', '技术部', '技术部', '1', '1478228705', '1478228705');

-- ----------------------------
-- Table structure for my_admin_integral
-- ----------------------------
DROP TABLE IF EXISTS `my_admin_integral`;
CREATE TABLE `my_admin_integral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT '1' COMMENT '部门id',
  `jobs_id` int(11) DEFAULT '1' COMMENT '职位ID',
  `integral_value` int(11) NOT NULL COMMENT 'Integral value',
  `validation` int(11) NOT NULL DEFAULT '0' COMMENT '验证方法',
  `desc` varchar(100) DEFAULT NULL COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin_integral
-- ----------------------------

-- ----------------------------
-- Table structure for my_admin_jobs
-- ----------------------------
DROP TABLE IF EXISTS `my_admin_jobs`;
CREATE TABLE `my_admin_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desc` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin_jobs
-- ----------------------------
INSERT INTO `my_admin_jobs` VALUES ('1', '班长', '', '1', '1478245107', '1478245107');
INSERT INTO `my_admin_jobs` VALUES ('2', '组长', '', '1', '1478245170', '1478245170');

-- ----------------------------
-- Table structure for my_admin_node
-- ----------------------------
DROP TABLE IF EXISTS `my_admin_node`;
CREATE TABLE `my_admin_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `node_name` varchar(155) DEFAULT '' COMMENT '节点名称',
  `module_name` varchar(155) DEFAULT '' COMMENT '模块名',
  `control_name` varchar(155) DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) DEFAULT NULL COMMENT '方法名',
  `is_menu` tinyint(1) DEFAULT '0' COMMENT '是否是菜单项 0不是 1是',
  `pid` int(11) DEFAULT NULL COMMENT '父级节点id',
  `icon` varchar(155) DEFAULT '' COMMENT '菜单样式',
  `sort` tinyint(3) unsigned DEFAULT '255',
  `status` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `group` varchar(64) DEFAULT NULL,
  `condition` char(100) NOT NULL DEFAULT '',
  `type` char(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin_node
-- ----------------------------
INSERT INTO `my_admin_node` VALUES ('1', '1', '我的组织', '#', '#', '#', '1', '0', 'fa fa-globe', '255', '1', null, null, null, '', '');
INSERT INTO `my_admin_node` VALUES ('2', '1', '员工管理', 'admin', 'User', 'user', '1', '1', '', '3', '1', null, '1478489017', '', '', '');
INSERT INTO `my_admin_node` VALUES ('3', '1', '用户修改', 'admin', 'User', 'useredit', '0', '2', '', '255', '1', null, null, null, '', '');
INSERT INTO `my_admin_node` VALUES ('4', '1', '还原密码', 'admin', 'User', 'password', '0', '2', '', '2', '1', '1479705083', '1479707835', '', '', '');
INSERT INTO `my_admin_node` VALUES ('5', '1', '修改状态', 'admin', 'User', 'setStatus', '0', '2', '', '3', '1', '1479707901', '1479707901', '', '', '');
INSERT INTO `my_admin_node` VALUES ('6', '1', '部门管理', 'admin', 'System', 'departmentlist', '1', '1', '', '255', '1', null, '1478489154', '', '', '');
INSERT INTO `my_admin_node` VALUES ('7', '1', '部门修改', 'admin', 'System', 'DepartmentEdit', '0', '6', '', '2', '1', '1479708131', '1479708131', '', '', '');
INSERT INTO `my_admin_node` VALUES ('8', '1', '状态设置', 'admin', 'System', 'setStatus', '0', '6', '', '3', '1', '1479708149', '1479708149', '', '', '');
INSERT INTO `my_admin_node` VALUES ('9', '1', '工作职位', 'admin', 'System', 'jobslist', '1', '1', '', '255', '1', null, '1478489697', '', '', '');
INSERT INTO `my_admin_node` VALUES ('10', '1', '职位修改', 'admin', 'System', 'JobsEdit', '0', '9', '', '1', '1', '1479708339', '1479708339', '', '', '');
INSERT INTO `my_admin_node` VALUES ('11', '1', '状态设置', 'admin', 'System', 'setStatus', '0', '9', '', '3', '1', '1479708373', '1479708373', '', '', '');
INSERT INTO `my_admin_node` VALUES ('12', '1', '系统管理', '#', '#', '#', '1', '0', 'fa fa-desktop', '255', '1', null, null, null, '', '');
INSERT INTO `my_admin_node` VALUES ('13', '1', '后台角色', 'admin', 'Role', 'role', '1', '12', '', '255', '1', null, '1478489392', '', '', '');
INSERT INTO `my_admin_node` VALUES ('14', '1', '添加角色', 'admin', 'Role', 'roleadd', '0', '13', '', '255', '1', null, null, null, '', '');
INSERT INTO `my_admin_node` VALUES ('15', '1', '编辑角色', 'admin', 'Role', 'roleedit', '0', '13', '', '255', '1', null, null, null, '', '');
INSERT INTO `my_admin_node` VALUES ('16', '1', '删除角色', 'admin', 'Role', 'roledel', '0', '13', '', '255', '1', null, null, null, '', '');
INSERT INTO `my_admin_node` VALUES ('17', '1', '分配权限', 'admin', 'Role', 'giveaccess', '0', '13', '', '255', '1', null, null, null, '', '');
INSERT INTO `my_admin_node` VALUES ('18', '1', '数据备份', 'admin', 'Data', 'index', '1', '12', '', '255', '1', null, '1478486078', null, '', '');
INSERT INTO `my_admin_node` VALUES ('19', '1', '备份数据', 'admin', 'Data', 'importdata', '1', '18', '', '255', '1', null, '1480673310', '', '', '');
INSERT INTO `my_admin_node` VALUES ('20', '1', '还原数据', 'admin', 'Data', 'backdata', '0', '18', '', '255', '1', null, '1478491159', '', '', '');
INSERT INTO `my_admin_node` VALUES ('21', '1', '后台权限', 'admin', 'Node', 'node', '1', '12', '', '255', '1', null, '1478489411', '', '', '');
INSERT INTO `my_admin_node` VALUES ('22', '1', '后台日志', 'admin', 'action', 'actionlog', '1', '12', '', '255', '1', '1475411492', '1478489442', '', '', '');
INSERT INTO `my_admin_node` VALUES ('23', '1', '微信管理', '#', '#', '#', '1', '0', 'fa fa-wechat', '255', '1', null, '1482715400', null, '', '');
INSERT INTO `my_admin_node` VALUES ('24', '1', '我的微信', 'admin', 'We', 'we', '1', '23', '', '255', '1', null, '1481959705', '', '', '');
INSERT INTO `my_admin_node` VALUES ('25', '1', '我的粉丝', 'admin', 'We', 'fans', '1', '23', '', '255', '1', null, '1481959716', '', '', '');
INSERT INTO `my_admin_node` VALUES ('26', '1', '微信菜单', 'admin', 'We', 'menu', '1', '23', '', '255', '1', null, '1481959724', '', '', '');
INSERT INTO `my_admin_node` VALUES ('27', '1', '微信菜单按钮', 'admin', 'We', 'menuButton', '0', '26', '', '1', '1', '1482284604', '1482715400', '', '', '');
INSERT INTO `my_admin_node` VALUES ('28', '1', '微信菜单编辑', 'admin', 'We', 'menuEdit', '0', '26', '', '255', '1', null, '1482715400', null, '', '');
INSERT INTO `my_admin_node` VALUES ('29', '1', '微信菜单同步推送', 'admin', 'We', 'sendMenu', '0', '26', '', '255', '1', null, '1482715400', null, '', '');
INSERT INTO `my_admin_node` VALUES ('30', '1', '微信菜单按钮编辑', 'admin', 'We', 'menuButtonEdit', '0', '26', '', '255', '1', null, '1482715400', null, '', '');
INSERT INTO `my_admin_node` VALUES ('31', '1', '会员管理', '#', '#', '#', '1', '0', 'fa fa-user', '1', '1', null, '1482715400', null, '', '');
INSERT INTO `my_admin_node` VALUES ('32', null, '会员管理列表', 'admin', 'User', 'member', '1', '31', '', '255', '1', null, '1482715400', null, '', '');
INSERT INTO `my_admin_node` VALUES ('33', null, '会员修改', 'admin', 'User', 'memberEdit', '0', '32', '', '255', '1', null, '1482715400', null, '', '');
INSERT INTO `my_admin_node` VALUES ('34', null, '会员等级', 'admin', 'User', 'memberGrade', '1', '31', '', '255', '1', null, '1482715400', null, '', '');
INSERT INTO `my_admin_node` VALUES ('35', null, '会员等级编辑', 'admin', 'User', 'memberGradeEdit', '0', '34', '', '255', '1', null, '1482715400', null, '', '');

-- ----------------------------
-- Table structure for my_admin_role
-- ----------------------------
DROP TABLE IF EXISTS `my_admin_role`;
CREATE TABLE `my_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `title` varchar(155) NOT NULL COMMENT '角色名称',
  `rules` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  `status` tinyint(4) DEFAULT '4',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin_role
-- ----------------------------
INSERT INTO `my_admin_role` VALUES ('1', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,23,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40', '1', null, null);
INSERT INTO `my_admin_role` VALUES ('2', '系统维护员', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,23,25', '1', null, null);
INSERT INTO `my_admin_role` VALUES ('3', '运营人员', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,22,23,25', '1', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_admin_user
-- ----------------------------
INSERT INTO `my_admin_user` VALUES ('1', '1', '1', 'oO059v39zsst76IkuiYV3yMvc4Sw', '55229586246', '2', '', 'mikkle', '', '系统维护员', 'b74ba7b7e2d0f1e7b9c834f52d84f04a', '', '0', '173', '14.153.203.45', '1485914301', '1', '1', '', '17092610050', '0', '', '', '', null, '', '0', '', '', '0', '0', '0', '0', '', null, '', '0.00', '1480426399', '0');
INSERT INTO `my_admin_user` VALUES ('2', '2', '1', '', '', '1', null, 'admin', null, '超级管理员', '21232f297a57a5a743894a0e4a801fc3', '', '0', '22', '219.134.109.157', '1486449550', '1', '1', '', '', '1', '', '', '', null, null, '0', '', '', '0', '0', '0', '0', '', null, '', '0.00', '1480673171', '1480673171');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_auth_rule
-- ----------------------------
INSERT INTO `my_auth_rule` VALUES ('1', 'admin/index/index', '超级管理', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('2', 'admin/index/form', '表单', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('3', 'admin/index/demo', '测试', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('4', 'move', '移动帖子', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('5', 'down', '下载附件', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('6', 'delete', '删除帖子', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('7', 'comment', '允许回复', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('8', 'create', '允许发帖', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('9', 'top', '置顶帖子', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('10', 'essence', '设置精华', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('11', 'update', '编辑帖子', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('12', 'message', '发送信息', '1', '1', '');
INSERT INTO `my_auth_rule` VALUES ('13', 'Ebook/Create', '发电子书', '1', '1', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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

-- ----------------------------
-- Table structure for my_detail
-- ----------------------------
DROP TABLE IF EXISTS `my_detail`;
CREATE TABLE `my_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id主建',
  `cid` int(11) NOT NULL COMMENT '和商品栏目表的id字段关联',
  `uid` smallint(5) NOT NULL COMMENT '用户id',
  `name` char(255) NOT NULL COMMENT '商品名称',
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `img` varchar(255) NOT NULL DEFAULT '/public/static/images/default.jpg' COMMENT '商品图片',
  `sum` int(255) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `price` char(255) DEFAULT NULL COMMENT '商品价格',
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `sort` char(5) NOT NULL DEFAULT '50',
  `status` smallint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`cid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_detail
-- ----------------------------

-- ----------------------------
-- Table structure for my_group
-- ----------------------------
DROP TABLE IF EXISTS `my_group`;
CREATE TABLE `my_group` (
  `gid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupName` varchar(30) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of my_group
-- ----------------------------
INSERT INTO `my_group` VALUES ('1', '管理员', '1', '1,2');
INSERT INTO `my_group` VALUES ('2', '注册会员', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13');
